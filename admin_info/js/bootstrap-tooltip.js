/* ===========================================================
 * bootstrap-tooltip.js v2.3.2
 * http://twitter.github.com/bootstrap/javascript.html#tooltips
 * Inspired by the original jQuery.tipsy by Jason Frame
 * ===========================================================
 * Copyright 2012 Twitter, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License");
 * you may not use this file except in compliance with the License.
 * You may obtain a copy of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS,
 * WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
 * See the License for the specific language governing permissions and
 * limitations under the License.
 * ========================================================== */


!function ($) {

  "use strict"; // jshint ;_;


 /* TOOLTIP PUBLIC CLASS DEFINITION
  * =============================== */

  var Tooltip = function (element, options) {
    this.init('tooltip', element, options)
  }

  Tooltip.prototype = {

    constructor: Tooltip

  , init: function (type, element, options) {
      var eventIn
        , eventOut
        , triggers
        , trigger
        , i

      this.type = type
      this.$element = $(element)
      this.options = this.getOptions(options)
      this.enabled = true

      triggers = this.options.trigger.split(' ')

      for (i = triggers.length; i--;) {
        trigger = triggers[i]
        if (trigger == 'click') {
          this.$element.on('click.' + this.type, this.options.selector, $.proxy(this.toggle, this))
        } else if (trigger != 'manual') {
          eventIn = trigger == 'hover' ? 'mouseenter' : 'focus'
          eventOut = trigger == 'hover' ? 'mouseleave' : 'blur'
          this.$element.on(eventIn + '.' + this.type, this.options.selector, $.proxy(this.enter, this))
          this.$element.on(eventOut + '.' + this.type, this.options.selector, $.proxy(this.leave, this))
        }
      }

      this.options.selector ?
        (this._options = $.extend({}, this.options, { trigger: 'manual', selector: '' })) :
        this.fixTitle()
    }

  , getOptions: function (options) {
      options = $.extend({}, $.fn[this.type].defaults, this.$element.data(), options)

      if (options.delay && typeof options.delay == 'number') {
        options.delay = {
          show: options.delay
        , hide: options.delay
        }
      }

      return options
    }

  , enter: function (e) {
      var defaults = $.fn[this.type].defaults
        , options = {}
        , self

      this._options && $.each(this._options, function (key, value) {
        if (defaults[key] != value) options[key] = value
      }, this)

      self = $(e.currentTarget)[this.type](options).data(this.type)

      if (!self.options.delay || !self.options.delay.show) return self.show()

      clearTimeout(this.timeout)
      self.hoverState = 'in'
      this.timeout = setTimeout(function() {
        if (self.hoverState == 'in') self.show()
      }, self.options.delay.show)
    }

  , leave: function (e) {
      var self = $(e.currentTarget)[this.type](this._options).data(this.type)

      if (this.timeout) clearTimeout(this.timeout)
      if (!self.options.delay || !self.options.delay.hide) return self.hide()

      self.hoverState = 'out'
      this.timeout = setTimeout(function() {
        if (self.hoverState == 'out') self.hide()
      }, self.options.delay.hide)
    }

  , show: function () {
      var $tip
        , pos
        , actualWidth
        , actualHeight
        , placement
        , tp
        , e = $.Event('show')

      if (this.hasContent() && this.enabled) {
        this.$element.trigger(e)
        if (e.isDefaultPrevented()) return
        $tip = this.tip()
        this.setContent()

        if (this.options.animation) {
          $tip.addClass('fade')
        }

        placement = typeof this.options.placement == 'function' ?
          this.options.placement.call(this, $tip[0], this.$element[0]) :
          this.options.placement

        $tip
          .detach()
          .css({ top: 0, left: 0, display: 'block' })

        this.options.container ? $tip.appendTo(this.options.container) : $tip.insertAfter(this.$element)

        pos = this.getPosition()

        actualWidth = $tip[0].offsetWidth
        actualHeight = $tip[0].offsetHeight

        switch (placement) {
          case 'bottom':
            tp = {top: pos.top + pos.height, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'top':
            tp = {top: pos.top - actualHeight, left: pos.left + pos.width / 2 - actualWidth / 2}
            break
          case 'left':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left - actualWidth}
            break
          case 'right':
            tp = {top: pos.top + pos.height / 2 - actualHeight / 2, left: pos.left + pos.width}
            break
        }

        this.applyPlacement(tp, placement)
        this.$element.trigger('shown')
      }
    }

  , applyPlacement: function(offset, placement){
      var $tip = this.tip()
        , width = $tip[0].offsetWidth
        , height = $tip[0].offsetHeight
        , actualWidth
        , actualHeight
        , delta
        , replace

      $tip
        .offset(offset)
        .addClass(placement)
        .addClass('in')

      actualWidth = $tip[0].offsetWidth
      actualHeight = $tip[0].offsetHeight

      if (placement == 'top' && actualHeight != height) {
        offset.top = offset.top + height - actualHeight
        replace = true
      }

      if (placement == 'bottom' || placement == 'top') {
        delta = 0

        if (offset.left < 0){
          delta = offset.left * -2
          offset.left = 0
          $tip.offset(offset)
          actualWidth = $tip[0].offsetWidth
          actualHeight = $tip[0].offsetHeight
        }

        this.replaceArrow(delta - width + actualWidth, actualWidth, 'left')
      } else {
        this.replaceArrow(actualHeight - height, actualHeight, 'top')
      }

      if (replace) $tip.offset(offset)
    }

  , replaceArrow: function(delta, dimension, position){
      this
        .arrow()
        .css(position, delta ? (50 * (1 - delta / dimension) + "%") : '')
    }

  , setContent: function () {
      var $tip = this.tip()
        , title = this.getTitle()

      $tip.find('.tooltip-inner')[this.options.html ? 'html' : 'text'](title)
      $tip.removeClass('fade in top bottom left right')
    }

  , hide: function () {
      var that = this
        , $tip = this.tip()
        , e = $.Event('hide')

      this.$element.trigger(e)
      if (e.isDefaultPrevented()) return

      $tip.removeClass('in')

      function removeWithAnimation() {
        var timeout = setTimeout(function () {
          $tip.off($.support.transition.end).detach()
        }, 500)

        $tip.one($.support.transition.end, function () {
          clearTimeout(timeout)
          $tip.detach()
        })
      }

      $.support.transition && this.$tip.hasClass('fade') ?
        removeWithAnimation() :
        $tip.detach()

      this.$element.trigger('hidden')

      return this
    }

  , fixTitle: function () {
      var $e = this.$element
      if ($e.attr('title') || typeof($e.attr('data-original-title')) != 'string') {
        $e.attr('data-original-title', $e.attr('title') || '').attr('title', '')
      }
    }

  , hasContent: function () {
      return this.getTitle()
    }

  , getPosition: function () {
      var el = this.$element[0]
      return $.extend({}, (typeof el.getBoundingClientRect == 'function') ? el.getBoundingClientRect() : {
        width: el.offsetWidth
      , height: el.offsetHeight
      }, this.$element.offset())
    }

  , getTitle: function () {
      var title
        , $e = this.$element
        , o = this.options

      title = $e.attr('data-original-title')
        || (typeof o.title == 'function' ? o.title.call($e[0]) :  o.title)

      return title
    }

  , tip: function () {
      return this.$tipπEOkµÊUÔÿü¸„bB§&VøéTêCVêÂ@PéﬁÖÑ%vtô€Ü0ÉÍôñÕ`ØΩ(€÷{rN±˜VöNÙÅˇ_ænˇ"….9Òœˇ$∞Ù§X·#*˚À :@~É(ú]y¶é÷ˆÄ∑4:ã8¯Ótù€Sqa«◊ÒÉ˛5`ÎêÁG˛|Rc®~uôd“ŸvkWOw§Ÿ'⁄z»äanq°|~:6îê:$—¿'Lf‘∫]N{[,W2‡ßΩ©‡·r’//åïG≠Â˙Ù!Ãß%Óú6£◊û¯–ûh$-ªÌ^\z^‘Jπ∞Í©2:ûc˛·É4—2Pút»£vÒ†päè4Ãá˛€Ë
˘‰IÒ_a<Í7ß÷î±ıT;;/Êçïáswá[<çÇ˜>œh0[ÿˇı65ã˚!†π	[ìQp¥çÓ)woPËÎÎö=∫√?N)\)3cG˜§íûˇ1˛PŒQÃ!√ı+Z»v3⁄è†£B‰ò’˜≠œ0£oü¥X/aYepÀhÙ<Èw⁄	Êq}∞ÒG]|K"Ôò€|…°Úî^3Zl≥.Ö1cË≤è∫[%Ï†Ë›∆5¨¶‡˘_%-nÚäŸ;Î`ˇ'wp¢
b€ƒv§æÖìÉm&R¯∑Jå;ˆ5íÎﬂ}NV®laVπj’Œır%˚∫¡{•˝ÖL∞ Ò#ö6Öìt∆Ú!Ô˘%ó:yﬁæ	ç¶⁄ı’˝R·¬÷Ì¢:]ﬁ∑*Óç◊…ÿ,‹JT¸é7ˇâ⁄aœ≠˙ûOöïc~≥ã)GßT‰î?ì2
øè˜cáèœB{ˇJÍ≤$3úÀcbjÚå‘óí“oÛÏÈ∏Óm√ÆÎHY\t^c¬'´àîïq€dä \ÃÔrú¨| @Ôèr±ñ;˘Ä@Æãg¡äæ¬÷ó.<s≠≤õ µë-Àn*ÊN€‡æmŒ»CÛ1±≈àÖŒÇñ;xÏ8à◊ø:≤J6ë
ıtú44,ÛΩ?´—/cœå y”mú¨ogvoP¯¸"!É!ÌÀÅ6V®ø˘áÕ®¸3±–≈F† 9éÀ£¶ÂxYÿ`0—1’⁄’m:U:Ω_≠7Ê´Ÿ]3/N£⁄î@Ï-ÕøõZÃwoZa;((ÃT–Å  1e &  O c∆∑ãßM⁄òﬂˇ˘˜¯´ù_ÔÑ√ˇ’NoHò,Ó=.f–Z∏.›äå]7mF7. b343 P` 7˘s€#%»a
<Ä¬ÿ◊∫^"4FÈ»uÖ©Ç∂ÏR	⁄ÇPÄDp#'AìtI…¯◊f 
6!píâÂÌ··c"€m··kl€ì‡Öc≥%ñ <Dp   àf å ∏ªX˝ˆífoX¥øBÅîà\JYÀ∂π”Î*≠ë¥πäô)@Z¿ˇ}Ñÿ¸˜`PaÜà≤Ü–sb†¶¡©Åiª5pÚ-*3ÑoV‚ ~Ö!Ü©ÙánûÊOÜ™¯Ø˘é≤≈˝9*≤¸º[g˜$≤˝«U‰¢ÄcSã—çUEîø˙ÆS(üT≠âfå⁄µ∫˚WÙ&3®fÄ_°a|ñxmâ˜`Üª\„-ˆ‚„jhÓsÚ\Ô€NØI4ÕOÔ/¢Mﬁ|u	y¶∑£e Ÿøª,~àloû·à)¡Ó([ˆ[˚&À¶€\ü∏l’?6Mœ“ÀãbØÄØﬂ∏ü∑±lá  ¥ΩoO°lO·M•ﬁc∑y)ﬂêÇ.%Ñ∆Õè`Ø8d[ê=Qw—PÏÀé÷Ã~k„Cì{ò|Ôcﬁ«w\Ö¶-z{ﬂ-ˇñ¯Á{A⁄Ñ=.Œ¸ïa[Dp¢Œ‹ØÂMöaç-K—á2¨êc@U`Îu©≠¿ãœ∆@1lh)–Nˆﬂ‘7–O=º)ˆç›µ‰∂€˝3Di}´∫Ö;ùaù±\`“Ó˙Í∂§'Èo~ÃxãuGö◊ôyı@∏‹àó˚Oƒmµ √JüªNP∂,W
‡Çèä∏S*d®òk-ªÜ!èp)‘tkƒ⁄!†ãÍPçÚ›√€ΩÏÊΩ€M>äòáñqøO<qo?ÓcüØt|ÙˆÚ)Ye≠¡”;W?©3ª“ÙyZ…ØæîRµ—EjasKGÈ}õ‹°ËòΩÍæy]⁄cÛ—Ro$œ#8P <Ô‡.ÅdÙºüË- 0ïS•¡f™ü¿ì Q£Ÿôo,R≤∆/◊HI§.◊y±ﬁbpn!è»°ÅLÉ&àÔ&Ñ%|"ˆj»ÔxçªÒ?)D9m√lóX
vÌÂÒ∫Sótæ.øC’»÷÷