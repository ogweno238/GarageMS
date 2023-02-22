window.onload = function () { // wait for load in a dumb way because B-0
  var cw = '/*!\n * Bootstrap v3.0.0\n *\n * Copyright 2013 Twitter, Inc\n * Licensed under the Apache License v2.0\n * http://www.apache.org/licenses/LICENSE-2.0\n *\n * Designed and built with all the love in the world @twitter by @mdo and @fat.\n */\n\n'

  function showError(msg, err) {
    $('<div id="bsCustomizerAlert" class="bs-customizer-alert">\
        <div class="container">\
          <a href="#bsCustomizerAlert" data-dismiss="alert" class="close pull-right">&times;</a>\
          <p class="bs-customizer-alert-text"><span class="glyphicon glyphicon-warning-sign"></span>' + msg + '</p>' +
          (err.extract ? '<pre class="bs-customizer-alert-extract">' + err.extract.join('\n') + '</pre>' : '') + '\
        </div>\
      </div>').appendTo('body').alert()
    throw err
  }

  function showCallout(msg, showUpTop) {
    var callout = $('<div class="bs-callout bs-callout-danger">\
       <h4>Attention!</h4>\
      <p>' + msg + '</p>\
    </div>')

    if (showUpTop) {
      callout.appendTo('.bs-docs-container')
    } else {
      callout.insertAfter('.bs-customize-download')
    }
  }

  function getQueryParam(key) {
    key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, "\\$&"); // escape RegEx meta chars
    var match = location.search.match(new RegExp("[?&]"+key+"=([^&]+)(&|$)"));
    return match && decodeURIComponent(match[1].replace(/\+/g, " "));
  }

  function createGist(configData) {
    var data = {
      "description": "Bootstrap Customizer Config",
      "public": true,
      "files": {
        "config.json": {
          "content": JSON.stringify(configData, null, 2)
        }
      }
    }
    $.ajax({
      url: 'https://api.github.com/gists',
      type: 'POST',
      dataType: 'json',
      data: JSON.stringify(data)
    })
    .success(function(result) {
      history.replaceState(false, document.title, window.location.origin + window.location.pathname + '?id=' + result.id)
    })
    .error(function(err) {
      showError('<strong>Ruh roh!</strong> Could not save gist file, configuration not saved.', err)
    })
  }

  function getCustomizerData() {
    var vars = {}

    $('#less-variables-section input')
        .each(function () {
          $(this).val() && (vars[ $(this).prev().text() ] = $(this).val())
        })

    var data = {
      vars: vars,
      css: $('#less-section input:checked')  .map(function () { return this.value }).toArray(),
      js:  $('#plugin-section input:checked').map(function () { return this.value }).toArray()
    }

    if ($.isEmptyObject(data.vars) && !data.css.length && !data.js.length) return

    return data
  }

  function parseUrl() {
    var id = getQueryParam('id')

    if (!id) return

    $.ajax({
      url: 'https://api.github.com/gists/' + id,
      type: 'GET',
      dataType: 'json'
    })
    .success(function(result) {
      var data = JSON.parse(result.files['config.json'].content)
      if (data.js) {
        $('#plugin-section input').each(function () {
          $(this).prop('checked', ~$.inArray(this.value, data.js))
        })
      }
      if (data.css) {
        $('#less-section input').each(function () {
          $(this).prop('checked', ~$.inArray(this.value, data.css))
        })
      }
      if (data.vars) {
        for (var i in data.vars) {
          $('input[data-var="' + i + '"]').val(data.vars[i])
        }
      }
    })
    .error(function(err) {
      showError('Error fetching bootstrap config file', err)
    })
  }

  function generateZip(css, js, fonts, complete) {
    if (!css && !js) return showError('<strong>Ruh roh!</strong> No Bootstrap files selected.', new Error('no Bootstrap'))

    var zip = new JSZip()

    if (css) {
      var cssFolder = zip.folder('css')
      for (var fileName in css) {
        cssFolder.file(fileName, css[fileName])
      }
    }

    if (js) {
      var jsFolder = zip.folder('js')
      for (var fileName in js) {
        jsFolder.file(fileName, js[fileName])
      }
    }

    if (fonts) {
      var fontsFolder = zip.folder('fonts')
      for (var fileName in fonts) {
        fontsFolder.file(fileName, fonts[fileName])
      }
    }

    var content = zip.generate({type:"blob"})

    complete(content)
  }

  function generateCustomCSS(vars) {
    var result = ''

    for (var key in vars) {
      result += key + ': ' + vars[key] + ';\n'
    }

    return result + '\n\n'
  }

  function generateFonts() {
    var glyphicons = $('#less-section [value="glyphicons.less"]:checked')
    if (glyphicons.length) {
      return __fonts
    }
  }

  function generateCSS() {
    var $checked = $('#less-section input:checked')

    if (!$checked.length) return false

    var result = {}
    var vars = {}
    var css = ''

    $('#less-variables-section input')
        .each(function () {
          $(this).val() && (vars[ $(this).prev().text() ] = $(this).val())
        })

    css += __less['variables.less']
    if (vars) css += generateCustomCSS(vars)
    css += __less['mixins.less']
    css += __less['normalize.less']
    css += __less['scaffolding.less']
    css += $checked
      .map(function () { return __less[this.value] })
      .toArray()
      .join('\n')

    css = css.replace(/@import[^\n]*/gi, '') //strip any imports

    try {
      var parser = new less.Parser({
          paths: ['variables.less', 'mixins.less']
        , optimization: 0
        , filename: 'bootstrap.css'
      }).parse(css, function (err, tree) {
        if (err) {
          return showError('<strong>Ruh roh!</strong> Could not parse less files.', err)
        }
        result = {
          'bootstrap.css'     : cw + tree.toCSS(),
          'bootstrap.min.css' : cw + tree.toCSS({ compress: true })
        }
      })
    } catch (err) {
      return showError('<strong>Ruh roh!</strong> Could not parse less files.', err)
    }

    return result
  }

  function generateJavascript() {
    var $checked = $('#plugin-section input:checked')
    if (!$checked.length) return false

    var js = $checked
      .map(function () { return __js[this.value] })
      .toArray()
      .join('\n')

    return {
      'bootstrap.js': js,
      'bootstrap.min.js': cw + uglify(js)
    }
  }

  var inputsComponent = $('#less-section input')
  var inputsPlugin    = $('#plugin-section input')
  var inputsVariables = $('#less-variables-section input')

  $('#less-section .toggle').on('click', function (e) {
    e.preventDefault()
    inputsComponent.prop('checked', !inputsComponent.is(':checked'))
  })

  $('#plugin-section .toggle').on('click', function (e) {
    e.preventDefault()
    inputsPlugin.prop('checked', !inputsPlugin.is(':checked'))
  })

  $('#less-variables-section .toggle').on('click', function (e) {
    e.preventDefault()
    inputsVariables.val('')
  })

  $('[data-dependencies]').on('click', function () {
    if (!$(this).is(':checked')) return
    var dependencies = this.getAttribute('data-dependencies')
    if (!dependencies) return
    dependencies = dependencies.split(',')
    for (var i = 0; i < dependencies.length; i++) {
      var dependency = $('[value="' + dependencies[i] + '"]')
      dependency && dependency.prop('checked', true)
    }
  })

  $('[data-dependents]').on('click', function () {
    if ($(this).is(':checked')) return
    var dependents = this.getAttribute('data-dependents')
    if (!dependents) return
    dependents = dependents.split(',')
    for (var i = 0; i < dependents.length; i++) {
      var dependent = $('[value="' + dependents[i] + '"]')
      dependent && dependent.prop('checked', false)
    }
  })

  var $compileBtn = $('#btn-compile')
  var $downloadBtn = $('#btn-download')

  $compileBtn.on('click', function (e) {
    e.preventDefault()

    $compileBtn.attr('disabled', 'disabled')

    generateZip(generateCSS(), generateJavascript(), generateFonts(), function (blob) {
      $compileBtn.removeAttr('disabled')
      saveAs(blob, "bootstrap.zip")
      createGist(getCustomizerData())
    })
  })

  // browser support alerts
  if (!window.URL && navigator.userAgent.toLowerCase().indexOf('safari') != -1) {
    showCallout("Looks like you're usin���Q%����ʮ�{��^Z����^*��д��;|�ņq-��M]���7�-~#��.O�D��1V���O�^l���au�c�8��QE)�M����)(� ���&'a=��Xb���@vXc�B�㴩m�d_5M�n��0J8���y���Q<�@�q�Ǆ�< �Za��,��xN[�&;�2]8�k]G��G�Xų�9^5e�b�`b-�٣�����(��=�"N)�
+SBJ���*����0��#X��	]&Ģ�����Å��Zy�:h'��5 +�BL�� ����T�M_k��|�R�&OT�u
�T���0��=� �L�M�oI��N��"a�Y��ձd�.�	��uK~�L�6~�n"�=��p��b)�s-�������
a�W�|�䟁��͌���L���`}�A�)Zv�\�G���M�}�i[��m���d�`�X���A�t�l
�����-�e���8�B����I�Poz������r��Z"i�P����0�jH�SS����$���d�)�	ҥq�.Ka��p9�0׿	[�y�-�NegB����&�E��HF)O� �K��b4r���PI�?��#У}m��}�ҹ<7���\0�2r�m����☥��8ž��HI��9����1e��tymM��z\O����+��7���`�#wD���L���`��;kKOWO�+ʴD.{�Q����3�%�U26�B�JI�F7z���