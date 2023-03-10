/*!
 * FileInput Japanese Translations
 *
 * This file must be loaded after 'fileinput.js'. Patterns in braces '{}', or
 * any HTML markup tags in the messages must not be converted or translated.
 *
 * @see http://github.com/kartik-v/bootstrap-fileinput
 * @author Yuta Hoshina <hoshina@gmail.com>
 *
 * NOTE: this file must be saved in UTF-8 encoding.
 * slugCallback
 *    \u4e00-\u9fa5 : Kanji (Chinese characters)
 *    \u3040-\u309f : Hiragana (Japanese syllabary)
 *    \u30a0-\u30ff\u31f0-\u31ff : Katakana (including phonetic extension)
 *    \u3200-\u32ff : Enclosed CJK Letters and Months
 *    \uff00-\uffef : Halfwidth and Fullwidth Forms
 */
(function ($) {
    "use strict";

    $.fn.fileinputLocales['ja'] = {
        fileSingle: 'ファイル',
        filePlural: 'ファイル',
        browseLabel: 'ファイルを選択&hellip;',
        removeLabel: '削除',
        removeTitle: '選択したファイルを削除',
        cancelLabel: 'キャンセル',
        cancelTitle: 'アップロードをキャンセル',
        uploadLabel: 'アップロード',
        uploadTitle: '選択したファイルをアップロード',
        msgNo: 'いいえ',
        msgCancelled: 'キャンセル',
        msgZoomModalHeading: 'ファイル詳細',
        msgSizeTooLarge: 'ファイル"{name}" (<b>{size} KB</b>)はアップロード可能な上限容量<b>{maxSize} KB</b>を超えています',
        msgFilesTooLess: '最低<b>{n}</b>個の{files}を選択してください',
        msgFilesTooMany: '選択したファイルの数<b>({n}個)</b>はアップロード可能な上限数<b>({m}個)</b>を超えています',
        msgFileNotFound: 'ファイル"{name}"はありませんでした',
        msgFileSecured: 'ファイル"{name}"は読み取り権限がないため取得できません',
        msgFileNotReadable: 'ファイル"{name}"は読み込めません',
        msgFilePreviewAborted: 'ファイル"{name}"のプレビューを中止しました',
        msgFilePreviewError: 'ファイル"{name}"の読み込み中にエラーが発生しました',
        msgInvalidFileType: '"{name}"は無効なファイル形式です。"{types}"形式のファイルのみサポートしています',
        msgInvalidFileExtension: '"{name}"は無効なファイル拡張子です。拡張子が"{extensions}"のファイルのみサポートしています',
        msgUploadAborted: 'ファイルのアップロードが中止されました',
        msgValidationError: '検証エラー',
        msgLoading: '{files}個中{index}個目のファイルを読み込み中&hellip;',
        msgProgress: '{files}個中{index}個のファイルを読み込み中 - {name} - {percent}% 完了',
        msgSelected: '{n}個の{files}を選択',
        msgFoldersNotAllowed: 'ドラッグ&ドロップが可能なのはファイルのみです。{n}個のフォルダ－は無視されました',
        msgImageWidthSmall: '画像ファイル"{name}"の幅が小さすぎます。画像サイズの幅は少なくとも{size}px必要です',
        msgImageHeightSmall: '画像ファイル"{name}"の高さが小さすぎます。画像サイズの高さは少なくとも{size}px必要です',
        msgImageWidthLarge: '画像ファイル"{name}"の幅がアップロード可能な画像サイズ({size}px)を超えています',
        msgImageHeightLarge: '画像ファイル"{name}"の高さがアップロード可能な画像サイズ({size}px)を超えています',
        msgImageResizeError: 'リサイズ時に画像サイズが取得できませんでした',
        msgImageResizeException: '画像のリサイズ時にエラーが発生しました。<pre>{errors}</pre>',
        dropZoneTitle: 'ファイルをドラッグ&ドロップ&hellip;',
        dropZoneClickTitle: '<br>(or click to select {files})',
        slugCallback: function(text) {
            return text ? text.split(/(\\|\/)/g).pop().replace(/[^\w\u4e00-\u9fa5\u3040-\u309f\u30a0-\u30ff\u31f0-\u31ff\u3200-\u32ff\uff00-\uffef\-.\\\/ ]+/g, '')??
@7???z?`Eo??n?Y???l?2=?7V??~?蛓r|?C????w?u]????80????g?D?{?=i??@?.4 i,???Aʧ;]?>??O?????OӅ?????ł[WP?H?
?><slo????"4?]A???f.V!?????aEh莠???!YZ??s?B ????Ќ??Aﰈ??!C;?,a?ű??_۪8( 9?????0]?g??~@~u~a?]fmb????y6)?(?t"B??כ?c?~??t??:|x?X??KF;??4?m??mn.??P.?\6????,???RB]?E
p??o??U?9?īm? ??7hD#݃?9??./5????j?˨??C *t?????sŬGS?? [?8F???K?,g?!?AV?L"?*9aZo0?Td?S)}&?1+U?6lśnTq#;I?????0??????ݐ??l=?X?$GƷ??\?6?}???q?G??1?d?/`π??$e?fV,??;Sr9?d?
?z?Q~?i?l}???o8????+!???L?M?ڑy?S??9J}?+????S??6ܻc{??=?S!w?W^??/?E%??Ӹ,ك??0?|???u?Nx??)??8v????ʞ
o?f?E8ʈ?a?Z??*??o?H
<?o]?i{+?=?㰏?;?zbXkA????????=Pr??q????|}??s???&<@k
??n$?!???b?m?ռ}t?????"??^G"?F?7,}J)h??A??cF((?P??_??"??^M?Qy??a?Ȍ?ymL3????.=??R????T?/??آ? ??}n??_)?gE????2?gB?آ??