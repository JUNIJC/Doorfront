CKEditor 4 Changelog
====================

## CKEditor 4.5.11

**Security Updates:**

* [Severity: minor] Fixed the target="_blank" vulnerability reported by James Gaskell.

	Issue summary: If a victim had access to a spoofed version of ckeditor.com via HTTP (e.g. due to DNS spoofing, using a hacked public network or mailicious hotspot), then when using a link to the ckeditor.com website it was possible for the attacker to change the current URL of the opening page, even if the opening page was protected with SSL.

  An upgrade is recommended.

New Features:

* [#14747](http://dev.ckeditor.com/ticket/14747): The [Enhanced Image](http://ckeditor.com/addon/image2) caption now supports the link `target` attribute.
* [#7154](http://dev.ckeditor.com/ticket/7154): Added support for the "Display Text" field to the [Link](http://ckeditor.com/addon/link) dialog. Thanks to [Ryan Guill](https://github.com/ryanguill)!

Fixed Issues:

* [#13362](http://dev.ckeditor.com/ticket/13362): [Blink, WebKit] Fixed: Active widget element is not cached when it is losing focus and it is inside an editable element.
* [#13755](http://dev.ckeditor.com/ticket/13755): [Edge] Fixed: Pasting images does not work.
* [#13548](http://dev.ckeditor.com/ticket/13548): [IE] Fixed: Clicking the [elements path](http://ckeditor.com/addon/elementspath) disables Cut and Copy icons.
* [#13812](http://dev.ckeditor.com/ticket/13812): Fixed: When aborting file upload the placeholder for image is left.
* [#14659](http://dev.ckeditor.com/ticket/14659): [Blink] Fixed: Content scrolled to the top after closing the dialog in a [`<div>`-based editor](http://ckeditor.com/addon/divarea).
* [#14825](http://dev.ckeditor.com/ticket/14825): [Edge] Fixed: Focusing the editor causes unwanted scrolling due to dropped support for the `setActive` method.

## CKEditor 4.5.10

Fixed Issues:

* [#10750](http://dev.ckeditor.com/ticket/10750): Fixed: The editor does not escape the `font-style` family property correctly, removing quotes and whitespace from font names.
* [#14413](http://dev.ckeditor.com/ticket/14413): Fixed: The [Auto Grow](http://ckeditor.com/addon/autogrow) plugin with the [`config.autoGrow_onStartup`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-autoGrow_onStartup) option set to `true` does not work properly for an editor that is not visible.
* [#14451](http://dev.ckeditor.com/ticket/14451): Fixed: Numeric element ID not escaped properly. Thanks to [Jakub Chalupa](https://github.com/chaluja7)!
* [#14590](http://dev.ckeditor.com/ticket/14590): Fixed: Additional line break appearing after inline elements when switching modes. Thanks to [dpidcock](https://github.com/dpidcock)!
* [#14539](https://dev.ckeditor.com/ticket/14539): Fixed: JAWS reads "selected Blank" instead of "selected <widget name>" when selecting a widget.
* [#14701](http://dev.ckeditor.com/ticket/14701): Fixed: More precise labels for [Enhanced Image](http://ckeditor.com/addon/image2) and [Placeholder](http://ckeditor.com/addon/placeholder) widgets.
* [#14667](http://dev.ckeditor.com/ticket/14667): [IE] Fixed: Removing background color from selected text removes background color from the whole paragraph.
* [#14252](http://dev.ckeditor.com/ticket/14252): [IE] Fixed: Styles drop-down list does not always reflect the current style of the text line.
* [#14275](http://dev.ckeditor.com/ticket/14275): [IE9+] Fixed: `onerror` and `onload` events are not used in browsers it could have been used when loading scripts dynamically.

## CKEditor 4.5.9

Fixed Issues:

* [#10685](http://dev.ckeditor.com/ticket/10685): Fixed: Unreadable toolbar icons after updating to the new editor version. Fixed with [6876179](https://github.com/ckeditor/ckeditor-dev/commit/6876179db4ee97e786b07b8fd72e6b4120732185) in [ckeditor-dev](https://github.com/ckeditor/ckeditor-dev) and [6c9189f4](https://github.com/ckeditor/ckeditor-presets/commit/6c9189f46392d2c126854fe8889b820b8c76d291) in [ckeditor-presets](https://github.com/ckeditor/ckeditor-presets).
* [#14573](https://dev.ckeditor.com/ticket/14573): Fixed: Missing [Widget](http://ckeditor.com/addon/widget) drag handler CSS when there are multiple editor instances.
* [#14620](https://dev.ckeditor.com/ticket/14620): Fixed: Setting both the `min-height` style for the `<body>` element and the `height` style for the `<html>` element breaks the [Auto Grow](http://ckeditor.com/addon/autogrow) plugin.
* [#14538](http://dev.ckeditor.com/ticket/14538): Fixed: Keyboard focus goes into an embedded `<iframe>` element.
* [#14602](http://dev.ckeditor.com/ticket/14602): Fixed: The [`dom.element.removeAttribute()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.element-method-removeAttribute) method does not remove all attributes if no parameter is given.
* [#8679](http://dev.ckeditor.com/ticket/8679): Fixed: Better focus indication and ability to style the selected color in the [color picker dialog](http://ckeditor.com/addon/colordialog).
* [#11697](http://dev.ckeditor.com/ticket/11697): Fixed: Content is replaced ignoring the letter case setting in the [Find and Replace](http://ckeditor.com/addon/find) dialog window.
* [#13886](http://dev.ckeditor.com/ticket/13886): Fixed: Invalid handling of the [`CKEDITOR.style`](http://docs.ckeditor.com/#!/api/CKEDITOR.style) instance with the `styles` property by [`CKEDITOR.filter`](http://docs.ckeditor.com/#!/api/CKEDITOR.filter).
* [#14535](http://dev.ckeditor.com/ticket/14535): Fixed: CSS syntax corrections. Thanks to [mdjdenormandie](https://github.com/mdjdenormandie)!
* [#14312](http://dev.ckeditor.com/ticket/14312): [IE] Fixed: Artifact is visible after pasting any text.

## CKEditor 4.5.8

New Features:

* [#12440](http://dev.ckeditor.com/ticket/12440): Added the [`config.colorButton_enableAutomatic`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-colorButton_enableAutomatic) option to allow hiding the "Automatic" option in the [color picker](http://ckeditor.com/addon/colorbutton).

Fixed Issues:

* [#10448](http://dev.ckeditor.com/ticket/10448): Fixed: Lack of scrollbar in the [right-to-left text direction](http://ckeditor.com/addon/bidi).
* [#12707](http://dev.ckeditor.com/ticket/12707): Fixed: The order of table elements does not comply with the HTML specification.
* [#13756](http://dev.ckeditor.com/ticket/13756): [Edge] Fixed: Context menus are cut-off.

## CKEditor 4.5.7

New Features:

* [#14327](http://dev.ckeditor.com/ticket/14327): Added Swiss German localization. Thanks to [Miro Grenda](https://twitter.com/mirogrenda)!

Fixed Issues:

* [#13816](http://dev.ckeditor.com/ticket/13816): Introduced a new strategy for Filling Character handling to avoid changes in DOM. This fixes the following issues:
	* [#12727](http://dev.ckeditor.com/ticket/12727): [Blink] `IndexSizeError` when using the [Div Editing Area](http://ckeditor.com/addon/divarea) and [Content Templates](http://ckeditor.com/addon/templates) plugins.
	* [#13377](http://dev.ckeditor.com/ticket/13377): [Widget](http://ckeditor.com/addon/widget) plugin issue when typing in Korean.
	* [#13389](http://dev.ckeditor.com/ticket/13389): [Blink] [`editor.getData()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData) fails when the cursor is next to an `<hr>` tag.
	* [#13513](http://dev.ckeditor.com/ticket/13513): [Blink, WebKit] [Div Editing Area](http://ckeditor.com/addon/divarea) and [`editor.getData()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData) throw an error when an image is the only data in the editor.
* [#13884](http://dev.ckeditor.com/ticket/13884): [Firefox] Fixed: Copying and pasting a table results in just the first cell being pasted.
* [#14234](http://dev.ckeditor.com/ticket/14234): Fixed: URL input field is not marked as required in the [Media Embed](http://ckeditor.com/addon/embed) dialog.

## CKEditor 4.5.6

New Features:

* Introduced the [`CKEDITOR.tools.getCookie()`](http://docs.ckeditor.com/#!/api/CKEDITOR.tools-method-getCookie) and [`CKEDITOR.tools.setCookie()`](http://docs.ckeditor.com/#!/api/CKEDITOR.tools-method-setCookie) methods for accessing cookies.
* Introduced the [`CKEDITOR.tools.getCsrfToken()`](http://docs.ckeditor.com/#!/api/CKEDITOR.tools-method-getCsrfToken) method. The CSRF token is now automatically sent by the [File Browser](http://ckeditor.com/addon/filebrowser) and [File Tools](http://ckeditor.com/addon/filetools) plugins during file uploads. The server-side upload handlers may check it and use it to additionally secure the communication.

Other Changes:

* Updated [SCAYT](http://ckeditor.com/addon/scayt) (Spell Check As You Type):
	- New features:
		- CKEditor [Language](http://ckeditor.com/addon/language) plugin support.
		- CKEditor [Placeholder](http://ckeditor.com/addon/placeholder) plugin support.
		- [Drag&Drop](http://sdk.ckeditor.com/samples/fileupload.html) support.
		- **Experimental** [GRAYT](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-grayt_autoStartup) (Grammar As You Type) functionality.
	- Fixed issues:
		* [#98](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/98): SCAYT affects dialog double-click. Fixed in SCAYT core.
		* [#102](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/102): SCAYT core performance enhancements.
		* [#104](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/104): SCAYT's spans leak into the clipboard and after pasting.
		* [#105](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/105): A JavaScript error fired in case of multiple instances of CKEditor on one page.
		* [#107](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/107): SCAYT should not check non-editable parts of content.
		* [#108](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/108): Latest SCAYT copies the ID of the editor element to the iframe.
		* SCAYT stops working when CKEditor [Undo plugin](http://ckeditor.com/addon/undo) not enabled.
		* Issue with pasting SCAYT markup in CKEditor.
		* SCAYT stops working after pressing the *Cancel* button in the WSC dialog.

## CKEditor 4.5.5

Fixed Issues:

* [#13887](https://dev.ckeditor.com/ticket/13887): Fixed: [Link](http://ckeditor.com/addon/link) plugin alters the `target` attribute value. Thanks to [SamZiemer](https://github.com/SamZiemer)!
* [#12189](http://dev.ckeditor.com/ticket/12189): Fixed: The [Link](http://ckeditor.com/addon/link) plugin dialog does not display the subject of email links if the subject parameter is not lowercase.
* [#9192](http://dev.ckeditor.com/ticket/9192): Fixed: An `undefined` string is appended to an email address added with the [Link](http://ckeditor.com/addon/link) plugin if subject and email body are empty and [`config.emailProtection`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-emailProtection) is set to `encode`.
* [#13790](https://dev.ckeditor.com/ticket/13790): Fixed: It is not possible to destroy the editor `<iframe>` after the editor was detached from DOM. Thanks to [Stefan Rijnhart](https://github.com/StefanRijnhart)!
* [#13803](https://dev.ckeditor.com/ticket/13803): Fixed: The editor cannot be destroyed before being fully initialized. Thanks to [Cyril Fluck](https://github.com/cyril-sf)!
* [#13867](http://dev.ckeditor.com/ticket/13867): Fixed: CKEditor does not work when the `classList` polyfill is used.
* [#13885](http://dev.ckeditor.com/ticket/13885): Fixed: [Enhanced Image](http://ckeditor.com/addon/image2) requires the [Link](http://ckeditor.com/addon/link) plugin to link an image.
* [#13883](http://dev.ckeditor.com/ticket/13883): Fixed: Copying a table using the context menu strips off styles.
* [#13872](http://dev.ckeditor.com/ticket/13872): Fixed: Cutting is possible in the [read-only](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-property-readOnly) mode.
* [#12848](http://dev.ckeditor.com/ticket/12848): [Blink] Fixed: Opening the [Find and Replace](http://ckeditor.com/addon/find) dialog window in the [read-only](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-property-readOnly) mode throws an exception.
* [#13879](http://dev.ckeditor.com/ticket/13879): Fixed: It is not possible to prevent the [`editor.drop`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-drop) event.
* [#13361](http://dev.ckeditor.com/ticket/13361): Fixed: Skin images fail when the site path includes parentheses because the `background-image` path needs single quotes around the URL value.
* [#13771](http://dev.ckeditor.com/ticket/13771): Fixed: The `contents.css` style is not used if the [IFrame Editing Area](http://ckeditor.com/addon/wysiwygarea) plugin is missing.
* [#13782](http://dev.ckeditor.com/ticket/13782): Fixed: Unclear log messages.
* [#13919](http://dev.ckeditor.com/ticket/13919): [Edge] Fixed: Browser window crashes when accessing the `isContentEditable` property of an `<input>` DOM element.

Other Changes:

* [#13859](http://dev.ckeditor.com/ticket/13859): Test cases created with `bender.tools.createTestsForEditors` will also receive editor bot as a second parameter.

## CKEditor 4.5.4

New Features:

* [#13632](http://dev.ckeditor.com/ticket/13632): Introduce error logging mechanism.
* [#13730](http://dev.ckeditor.com/ticket/13730): Switch to the new error logging mechanism.

Fixed Issues:

* [#9856](http://dev.ckeditor.com/ticket/9856): Fixed: Cannot use the native context menu together with the [Div Editing Area](http://ckeditor.com/addon/divarea) plugin. Thanks to [Mark Wade](https://github.com/mark-wade)!
* [#12733](http://dev.ckeditor.com/ticket/12733): [IE9+] Fixed: Radio button `onChange` does not work. Thanks to [Iliya Kostadinov](https://github.com/iliyakostadinov)!
* [#13142](http://dev.ckeditor.com/ticket/13142): [Edge] Fixed: *Ctrl+A* and then *Backspace* result in an empty `<div>` element.
* [#13599](http://dev.ckeditor.com/ticket/13599): Fixed: Cross-editor drag and drop of an inline widget results in error/artifacts.
* [#13640](http://dev.ckeditor.com/ticket/13640): [IE] Fixed: Dropping a widget outside the `<body>` element is not handled correctly.
* [#13533](http://dev.ckeditor.com/ticket/13533): Fixed: No progress during upload.
* [#13680](http://dev.ckeditor.com/ticket/13680): Fixed: The parser should allow the `<h1-6>` element to be a child of the `<summary>` element.
* [#11724](http://dev.ckeditor.com/ticket/11724): [Touch devices] Fixed: Drop-downs often hide right after opening them.
* [#13690](http://dev.ckeditor.com/ticket/13690): Fixed: Copying content from IE to Chrome adds an extra paragraph.
* [#13284](http://dev.ckeditor.com/ticket/13284): Fixed: Cannot drag and drop a widget if the text caret is placed just after the widget instance.
* [#13516](http://dev.ckeditor.com/ticket/13516): Fixed: CKEditor removes empty HTML5 anchors without the `name` attribute.
* [#13765](http://dev.ckeditor.com/ticket/13765): [Safari 9] Fixed: Problems with rendering samples.

Other Changes:

* [#11725](http://dev.ckeditor.com/ticket/11725): Marked [`CKEDITOR.env.mobile`](http://docs.ckeditor.com/#!/api/CKEDITOR.env-property-mobile) as deprecated. The reason is that it is no longer clear what "mobile" means.
* [#13737](http://dev.ckeditor.com/ticket/13737): Upgraded [Bender.js](https://github.com/benderjs/benderjs) to 0.4.1.

## CKEditor 4.5.3

New Features:

* [#13501](http://dev.ckeditor.com/ticket/13501): Added the [`config.fileTools_defaultFileName`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-fileTools_defaultFileName) option to allow setting a default file name for paste uploads.
* [#13603](http://dev.ckeditor.com/ticket/13603): Added support for uploading dropped BMP images.

Fixed Issues:

* [#13590](http://dev.ckeditor.com/ticket/13590): Fixed: Various issues related to the [Paste from Word](http://ckeditor.com/addon/pastefromword) feature. Fixes also:
  * [#11215](http://dev.ckeditor.com/ticket/11215),
  * [#8780](http://dev.ckeditor.com/ticket/8780),
  * [#12762](http://dev.ckeditor.com/ticket/12762).
* [#13386](http://dev.ckeditor.com/ticket/13386): [Edge] Fixed: Issues with selecting and editing images.
* [#13568](http://dev.ckeditor.com/ticket/13568): Fixed: The [`editor.getSelectedHtml()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getSelectedHtml) method returns invalid results for entire content selection.
* [#13453](http://dev.ckeditor.com/ticket/13453): Fixed: Drag&drop of entire editor content throws an error.
* [#13465](http://dev.ckeditor.com/ticket/13465): Fixed: Error is thrown and the widget is lost on drag&drop if it is the only content of the editor.
* [#13414](http://dev.ckeditor.com/ticket/13414): Fixed: Content auto paragraphing in a nested editable despite editor configuration.
* [#13429](http://dev.ckeditor.com/ticket/13429): Fixed: Incorrect selection after content insertion by the [Auto Embed](http://ckeditor.com/addon/autoembed) plugin.
* [#13388](http://dev.ckeditor.com/ticket/13388): Fixed: [Table Resize](http://ckeditor.com/addon/tableresize) integration with [Undo](http://ckeditor.com/addon/undo) is broken.

Other Changes:

* [#13637](https://dev.ckeditor.com/ticket/13637): Several icons were refactored.
* Updated [Bender.js](https://github.com/benderjs/benderjs) to 0.3.0 and introduced the ability to run tests via HTTPs ([#13265](https://dev.ckeditor.com/ticket/13265)).

## CKEditor 4.5.2

Fixed Issues:

* [#13609](http://dev.ckeditor.com/ticket/13609): [Edge] Fixed: The browser crashes when switching to the source mode. Thanks to [Andrew Williams and Mark Smeed](http://webxsolution.com/)!
* [PR#201](https://github.com/ckeditor/ckeditor-dev/pull/201): Fixed: Buttons in the toolbar configurator cause form submission. Thanks to [colemanw](https://github.com/colemanw)!
* [#13422](http://dev.ckeditor.com/ticket/13422): Fixed: A monospaced font should be used in the `<textarea>` element storing editor configuration in the toolbar configurator.
* [#13494](http://dev.ckeditor.com/ticket/13494): Fixed: Error thrown in the toolbar configurator if plugin requirements are not met.
* [#13409](http://dev.ckeditor.com/ticket/13409): Fixed: List elements incorrectly merged when pressing *Backspace* or *Delete*.
* [#13434](http://dev.ckeditor.com/ticket/13434): Fixed: Dialog state indicator broken in Right–To–Left environments.
* [#13460](http://dev.ckeditor.com/ticket/13460): [IE8] Fixed: Copying inline widgets is broken when [Advanced Content Filter](http://docs.ckeditor.com/#!/guide/dev_acf) is disabled.
* [#13495](http://dev.ckeditor.com/ticket/13495): [Firefox, IE] Fixed: Text is not word-wrapped in the Paste dialog window.
* [#13528](http://dev.ckeditor.com/ticket/13528): [Firefox@Windows] Fixed: Content copied from Microsoft Word and other external applications is pasted as a plain text. Removed the `CKEDITOR.plugins.clipboard.isHtmlInExternalDataTransfer` property as the check must be dynamic.
* [#13583](http://dev.ckeditor.com/ticket/13583): Fixed: [`DataTransfer.getData()`](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.clipboard.dataTransfer-method-getData) should work consistently in all browsers and should not strip valuable content. Fixed pasting tables from Microsoft Excel on Chrome.
* [#13468](http://dev.ckeditor.com/ticket/13468): [IE] Fixed: Binding drag&drop `dataTransfer` does not work if `text` data was set in the meantime.
* [#13451](http://dev.ckeditor.com/ticket/13451): [IE8-9] Fixed: One drag&drop operation may affect following ones.
* [#13184](http://dev.ckeditor.com/ticket/13184): Fixed: Web page reloaded after a drop on editor UI.
* [#13129](http://dev.ckeditor.com/ticket/13129) Fixed: Block widget blurred after a drop followed by an undo.
* [#13397](http://dev.ckeditor.com/ticket/13397): Fixed: Drag&drop of a widget inside its nested widget crashes the editor.
* [#13385](http://dev.ckeditor.com/ticket/13385): Fixed: [`editor.getSnapshot()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getSnapshot) may return a non-string value.
* [#13419](http://dev.ckeditor.com/ticket/13419): Fixed: The [Auto Link](http://ckeditor.com/addon/autolink) plugin does not encode double quotes in URLs.
* [#13420](http://dev.ckeditor.com/ticket/13420): Fixed: The [Auto Embed](http://ckeditor.com/addon/autoembed) plugin ignores encoded characters in URL parameters.
* [#13410](http://dev.ckeditor.com/ticket/13410): Fixed: Error thrown in the [Auto Embed](http://ckeditor.com/addon/autoembed) plugin when undoing right after pasting a link.
* [#13566](http://dev.ckeditor.com/ticket/13566): Fixed: Suppressed notifications in the [Media Embed Base](http://ckeditor.com/addon/embedbase) plugin.
* [#11616](http://dev.ckeditor.com/ticket/11616): [Chrome] Fixed: Resizing the editor while it is not displayed breaks the editable. Fixes also [#9160](http://dev.ckeditor.com/ticket/9160) and [#9715](http://dev.ckeditor.com/ticket/9715).
* [#11376](http://dev.ckeditor.com/ticket/11376): [IE11] Fixed: Loss of text when pasting bulleted lists from Microsoft Word.
* [#13143](http://dev.ckeditor.com/ticket/13143): [Edge] Fixed: Focus lost when opening the panel.
* [#13387](http://dev.ckeditor.com/ticket/13387): [Edge] Fixed: "Permission denied" error thrown when loading the editor with developer tools open.
* [#13574](http://dev.ckeditor.com/ticket/13574): [Edge] Fixed: "Permission denied" error thrown when opening editor dialog windows.
* [#13441](http://dev.ckeditor.com/ticket/13441): [Edge] Fixed: The [Clipboard](http://ckeditor.com/addon/clipboard) plugin breaks the state of [Undo](http://ckeditor.com/addon/undo) commands after a paste.
* [#13554](http://dev.ckeditor.com/ticket/13554): [Edge] Fixed: Paste dialog's iframe does not receive focus on show.
* [#13440](http://dev.ckeditor.com/ticket/13440): [Edge] Fixed: Unable to paste a widget.

Other Changes:

* [#13421](http://dev.ckeditor.com/ticket/13421): UX improvements to notifications in the [Auto Embed](http://ckeditor.com/addon/autoembed) plugin.

## CKEditor 4.5.1

Fixed Issues:

* [#13486](http://dev.ckeditor.com/ticket/13486): Fixed: The [Upload Image](http://ckeditor.com/addon/uploadimage) plugin should log an error, not throw an error when upload URL is not set.

## CKEditor 4.5

New Features:

* [#13304](http://dev.ckeditor.com/ticket/13304): Added support for passing DOM elements to [`config.sharedSpaces`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-sharedSpaces). Thanks to [Undergrounder](https://github.com/Undergrounder)!
* [#13215](http://dev.ckeditor.com/ticket/13215): Added ability to cancel fetching a resource by the Embed plugins.
* [#13213](http://dev.ckeditor.com/ticket/13213): Added the [`dialog#setState()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dialog-method-setState) method and used it in the [Embed](http://ckeditor.com/addon/embed) dialog to indicate that a resource is being loaded.
* [#13337](http://dev.ckeditor.com/ticket/13337): Added the [`repository.onWidget()`](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.widget.repository-method-onWidget) method &mdash; a convenient way to listen to [widget](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.widget) events through the [repository](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.widget.repository).
* [#13214](http://dev.ckeditor.com/ticket/13214): Added support for pasting links that convert into embeddable resources on the fly.

Fixed Issues:

* [#13334](http://dev.ckeditor.com/ticket/13334): Fixed: Error after nesting widgets and playing with undo/redo.
* [#13118](http://dev.ckeditor.com/ticket/13118): Fixed: The [`editor.getSelectedHtml()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getSelectedHtml) method throws an error when called in the source mode.
* [#13158](http://dev.ckeditor.com/ticket/13158): Fixed: Error after canceling a dialog when creating a widget.
* [#13197](http://dev.ckeditor.com/ticket/13197): Fixed: Linked inline [Enhanced Image](http://ckeditor.com/addon/image2) alignment class is not transferred to the widget wrapper.
* [#13199](http://dev.ckeditor.com/ticket/13199): Fixed: [Semantic Embed](http://ckeditor.com/addon/embedsemantic) does not support widget classes.
* [#13003](http://dev.ckeditor.com/ticket/13003): Fixed: Anchors are uploaded when moving them by drag and drop.
* [#13032](http://dev.ckeditor.com/ticket/13032): Fixed: When upload is done, notification update should be marked as important.
* [#13300](http://dev.ckeditor.com/ticket/13300): Fixed: The `internalCommit` argument in the [Image](http://ckeditor.com/addon/image) dialog seems to be never used.
* [#13036](http://dev.ckeditor.com/ticket/13036): Fixed: Notifications are moved 10px to the right.
* [#13280](http://dev.ckeditor.com/ticket/13280): [IE8] Fixed: Undo after inline widget drag&drop throws an error.
* [#13186](http://dev.ckeditor.com/ticket/13186): Fixed: Content dropped into a nested editable is not filtered by [Advanced Content Filter](http://docs.ckeditor.com/#!/guide/dev_acf).
* [#13140](http://dev.ckeditor.com/ticket/13140): Fixed: Error thrown when dropping a block widget right after itself.
* [#13176](http://dev.ckeditor.com/ticket/13176): [IE8] Fixed: Errors on drag&drop of embed widgets.
* [#13015](http://dev.ckeditor.com/ticket/13015): Fixed: Dropping an image file on [Enhanced Image](http://ckeditor.com/addon/image2) causes a page reload.
* [#13080](http://dev.ckeditor.com/ticket/13080): Fixed: Ugly notification shown when the response contains HTML content.
* [#13011](http://dev.ckeditor.com/ticket/13011): [IE8] Fixed: Anchors are duplicated on drag&drop in specific locations.
* [#13105](http://dev.ckeditor.com/ticket/13105): Fixed: Various issues related to [`CKEDITOR.tools.htmlEncode()`](http://docs.ckeditor.com/#!/api/CKEDITOR.tools-method-htmlEncode) and [`CKEDITOR.tools.htmlDecode()`](http://docs.ckeditor.com/#!/api/CKEDITOR.tools-method-htmlDecode) methods.
* [#11976](http://dev.ckeditor.com/ticket/11976): [Chrome] Fixed: Copy&paste and drag&drop lists from Microsoft Word.
* [#13128](http://dev.ckeditor.com/ticket/13128): Fixed: Various issues with cloning element IDs:
  * Fixed the default behavior of [`range.cloneContents()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.range-method-cloneContents) and [`range.extractContents()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.range-method-extractContents) methods which now clone IDs similarly to their native counterparts.
  * Added `cloneId` arguments to the above methods, [`range.splitBlock()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.range-method-splitBlock) and [`element.breakParent()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.element-method-breakParent). Mind the default values and special behavior in the `extractContents()` method!
  * Fixed issues where IDs were lost on copy&paste and drag&drop.
* Toolbar configurators:
  * [#13185](http://dev.ckeditor.com/ticket/13185): Fixed: Wrong position of the suggestion box if there is not enough space below the caret.
  * [#13138](http://dev.ckeditor.com/ticket/13138): Fixed: The "Toggle empty elements" button label is unclear.
  * [#13136](http://dev.ckeditor.com/ticket/13136): Fixed: Autocompleter is far too intrusive.
  * [#13133](http://dev.ckeditor.com/ticket/13133): Fixed: Tab leaves the editor.
  * [#13173](http://dev.ckeditor.com/ticket/13173): Fixed: [`config.removeButtons`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-removeButtons) is ignored by the advanced toolbar configurator.

Other Changes:

* [#13119](http://dev.ckeditor.com/ticket/13119): Improved compatibility of editor skins ([Moono](http://ckeditor.com/addon/moono) and [Kama](http://ckeditor.com/addon/kama)) with external web page style sheets.
* Toolbar configurators:
  * [#13147](http://dev.ckeditor.com/ticket/13147): Added buttons to the sticky toolbar.
  * [#13207](http://dev.ckeditor.com/ticket/13207): Used modal window to display toolbar configurator help.
* [#13316](http://dev.ckeditor.com/ticket/13316): Made [`CKEDITOR.env.isCompatible`](http://docs.ckeditor.com/#!/api/CKEDITOR.env-property-isCompatible) a blacklist rather than a whitelist. More about the change in the [Browser Compatibility](http://docs.ckeditor.com/#!/guide/dev_browsers) guide.
* [#13398](http://dev.ckeditor.com/ticket/13398): Renamed `CKEDITOR.fileTools.UploadsRepository` to [`CKEDITOR.fileTools.UploadRepository`](http://docs.ckeditor.com/#!/api/CKEDITOR.fileTools.uploadRepository) and changed all related properties.
* [#13279](http://dev.ckeditor.com/ticket/13279): Reviewed CSS vendor prefixes.
* [#13454](http://dev.ckeditor.com/ticket/13454): Removed unused `lang.image.alertUrl` token from the [Image](http://ckeditor.com/addon/image) plugin.

## CKEditor 4.5 Beta

New Features:

* Clipboard (copy&paste, drag&drop) and file uploading features and improvements ([#11437](http://dev.ckeditor.com/ticket/11437)).

  * Major features:
    * Support for dropping and pasting files into the editor was introduced. Through a set of new facades for native APIs it is now possible to easily intercept and process inserted files.
    * [File upload tools](http://docs.ckeditor.com/#!/api/CKEDITOR.fileTools) were introduced in order to simplify controlling the loading, uploading and handling server response, properly handle [new upload configuration](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-uploadUrl) options, etc.
    * [Upload Image](http://ckeditor.com/addon/uploadimage) widget was introduced to upload dropped images. A base class for the [upload widget](http://docs.ckeditor.com/#!/api/CKEDITOR.fileTools.uploadWidgetDefinition) was exposed, too, to make it simple to create new types of upload widgets which can handle any type of dropped file, show the upload progress and update the content when the process is done. It also handles editing and undo/redo operations when a file is being uploaded and integrates with the [notification aggregator](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.notificationAggregator) to show progress and success or error.
    * All drag and drop operations were integrated with the editor. All dropped content is passed through the [`editor#paste`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-paste) event and a set of new editor events was introduced &mdash; [`dragstart`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-dragstart), [`drop`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-drop), [`dragend`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-dragend).
    * The [Data Transfer](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.clipboard.dataTransfer) facade was introduced to unify access to data in various types and files. [Data Transfer](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.clipboard.dataTransfer) is now always available in the [`editor#paste`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-paste) event.
    * Switched from the pastebin to using the native clipboard access whenever possible. This solved many issues related to pastebin such as unnecessary scrolling or data loss. Additionally, on copy and cut from the editor the clipboard data is set. Therefore, on paste the editor has access to clean data, undisturbed by the browsers.
    * Drag and drop of inline and block widgets was integrated with the standard clipboard APIs. By listening to drag events you will thus be notified about widgets, too. This opens a possibility to filter pasted and dropped widgets.
    * The [`editor#paste`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-paste) event can have the `range` parameter so it is possible to change the paste position in the listener or paste in the not selectable position. Also the [`editor.insertHtml()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml) method now accepts `range` as an additional parameter.
    * [#11621](http://dev.ckeditor.com/ticket/11621): A configurable [paste filter](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-pasteFilter) was introduced. The filter is by default turned to `'semantic-content'` on Webkit and Blink for all pasted content coming from external sources because of the low quality of HTML that these engines put into the clipboard. Internal and cross-editor paste is safe due to the change explained in the previous point.

  * Other changes and related fixes:
    * [#12095](http://dev.ckeditor.com/ticket/12095): On drag and copy of widgets [the same method](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getSelectedHtml) is used to get selected HTML as in the normal case. Thanks to that styles applied to inline widgets are not lost.
    * [#11219](http://dev.ckeditor.com/ticket/11219): Fixed: Dragging a [captioned image](http://ckeditor.com/addon/image2) does not fire the [`editor#paste`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-paste) event.
    * [#9554](http://dev.ckeditor.com/ticket/9554): [Webkit Mac] Fixed: Editor scrolls on paste.
    * [#9898](http://dev.ckeditor.com/ticket/9898): [Webkit&Divarea] Fixed: Pasting causes undesirable scrolling.
    * [#11993](http://dev.ckeditor.com/ticket/11993): [Chrome] Fixed: Pasting content scrolls the document.
    * [#12613](http://dev.ckeditor.com/ticket/12613): Show the user that they can not drop on editor UI (toolbar, bottom bar).
    * [#12851](http://dev.ckeditor.com/ticket/12851): [Blink/Webkit] Fixed: Formatting disappears when pasting content into cells.
    * [#12914](http://dev.ckeditor.com/ticket/12914): Fixed: Copy/Paste of table broken in `div`-based editor.

  * Browser support.<br>Browser support for related features varies significantly (see http://caniuse.com/clipboard).
    * File APIs needed to operate and file upload is not supported in Internet Explorer 9 and below.
    * Only Chrome and Safari on Mac OS support setting custom data items in the clipboard, so currently it is possible to recognize the origin of the copied content in these browsers only. All drag and drop operations can be identified thanks to the new Data Transfer facade.
    * No Internet Explorer browser supports the standard clipboard API which results in small glitches like where only plain text can be dropped from outside the editor. Thanks to the new Data Transfer facade, internal and cross-editor drag and drop supports the full range of data.
    * Direct access to clipboard could only be implemented in Chrome, Safari on Mac OS, Opera and Firefox. In other browsers the pastebin must still be used.

* [#12875](http://dev.ckeditor.com/ticket/12875): Samples and toolbar configuration tools.
  * The old set of samples shipped with every CKEditor package was replaced with a shiny new single-page sample. This change concluded a long term plan which started from introducing the [CKEditor SDK](http://sdk.ckeditor.com/) and [CKEditor Functionality Overview](http://docs.ckeditor.com/#!/guide/dev_features) section in the documentation which essentially redefined the old samples.
  * Toolbar configurators with live previews were introduced. They will be shipped with every CKEditor package and are meant to help in configuring toolbar layouts.

* [#10925](http://dev.ckeditor.com/ticket/10925): The [Media Embed](http://ckeditor.com/addon/embed) and [Semantic Media Embed](http://ckeditor.com/addon/embedsemantic) plugins were introduced. Read more about the new features in the [Embedding Content](http://docs.ckeditor.com/#!/guide/dev_media_embed) article.
* [#10931](http://dev.ckeditor.com/ticket/10931): Added support for nesting widgets. It is now possible to insert one widget into another widget's nested editable. Note that unless nested editable's [allowed content](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.widget.nestedEditable.definition-property-allowedContent) is defined precisely, starting from CKEditor 4.5 some widget buttons may become enabled. This feature is not supported in IE8. Included issues:
  * [#12018](http://dev.ckeditor.com/ticket/12018): Fixed and reviewed: Nested widgets garbage collection.
  * [#12024](http://dev.ckeditor.com/ticket/12024): [Firefox] Fixed: Outline is extended to the left by unpositioned drag handlers.
  * [#12006](http://dev.ckeditor.com/ticket/12006): Fixed: Drag and drop of nested block widgets.
  * [#12008](http://dev.ckeditor.com/ticket/12008): Fixed various cases of inserting a single non-editable element using the [`editor.insertHtml()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-insertHtml) method. Fixes pasting a widget with a nested editable inside another widget's nested editable.

* Notification system:
  * [#11580](http://dev.ckeditor.com/ticket/11580): Introduced the [notification system](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.notification).
  * [#12810](http://dev.ckeditor.com/ticket/12810): Introduced a [notification aggregator](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.notificationAggregator) for the [notification system](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.notification) which simplifies displaying progress of many concurrent tasks.
* [#11636](http://dev.ckeditor.com/ticket/11636): Introduced new, UX-focused, methods for getting selected HTML and deleting it &mdash; [`editor.getSelectedHtml()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getSelectedHtml) and [`editor.deleteSelectedHtml()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getSelectedHtml).
* [#12416](http://dev.ckeditor.com/ticket/12416): Added the [`widget.definition.upcastPriority`](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.widget.definition-property-upcastPriority) property which gives more control over widget upcasting order to the widget author.
* [#12036](http://dev.ckeditor.com/ticket/12036): Initialize the editor in [read-only](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-property-readOnly) mode when the `<textarea>` element has a `readonly` attribute.
* [#11905](http://dev.ckeditor.com/ticket/11905): The [`resize` event](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-resize) passes the current dimensions in its data.
* [#12126](http://dev.ckeditor.com/ticket/12126): Introduced [`config.image_prefillDimensions`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-image_prefillDimensions) and [`config.image2_prefillDimensions`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-image2_prefillDimensions) to make pre-filling `width` and `height` configurable for the [Enhanced Image](http://ckeditor.com/addon/image2).
* [#12746](http://dev.ckeditor.com/ticket/12746): Added a new configuration option to hide the [Enhanced Image](http://ckeditor.com/addon/image2) resizer.
* [#12150](http://dev.ckeditor.com/ticket/12150): Exposed the [`getNestedEditable()`](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.widget-static-method-getNestedEditable) and `is*` [widget helper](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.widget) functions (see the static methods).
* [#12448](http://dev.ckeditor.com/ticket/12448): Introduced the [`editable.insertHtmlIntoRange`](http://docs.ckeditor.com/#!/api/CKEDITOR.editable-method-insertHtmlIntoRange) method.
* [#12143](http://dev.ckeditor.com/ticket/12143): Added the [`config.floatSpacePreferRight`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-floatSpacePreferRight) configuration option that switches the alignment of the floating toolbar. Thanks to [InvisibleBacon](http://github.com/InvisibleBacon)!
* [#10986](http://dev.ckeditor.com/ticket/10986): Added support for changing dialog input and textarea text directions by using the *Shift+Alt+Home/End* keystrokes. The direction is stored in the value of the input by prepending the [`\u202A`](http://unicode.org/cldr/utility/character.jsp?a=202A) or [`\u202B`](http://unicode.org/cldr/utility/character.jsp?a=202B) marker to it. Read more in the [documentation](http://docs.ckeditor.com/#!/api/CKEDITOR.dialog.definition.textInput-property-bidi). Thanks to [edithkk](https://github.com/edithkk)!
* [#12770](http://dev.ckeditor.com/ticket/12770): Added support for passing [widget](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.widget)'s startup data as a widget command's argument. Thanks to [Rebrov Boris](https://github.com/zipp3r) and [Tieme van Veen](https://github.com/tiemevanveen)!
* [#11583](http://dev.ckeditor.com/ticket/11583): Added support for the HTML5 `required` attribute in various form elements. Thanks to [Steven Busse](https://github.com/sbusse)!

Changes:

* [#12858](http://dev.ckeditor.com/ticket/12858): Basic [Spartan](http://blogs.windows.com/bloggingwindows/2015/03/30/introducing-project-spartan-the-new-browser-built-for-windows-10/) browser compatibility. Full compatibility will be introduced later, because at the moment Spartan is still too unstable to be used for tests and we see many changes from version to version.
* [#12948](http://dev.ckeditor.com/ticket/12948): The [`config.mathJaxLibrary`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-mathJaxLib) option does not default to the MathJax CDN any more. It needs to be configured to enable the [Mathematical Formulas](http://ckeditor.com/addon/mathjax) plugin now.
* [#13069](http://dev.ckeditor.com/ticket/13069): Fixed inconsistencies between [`editable.insertHtml()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editable-method-insertElement) and [`editable.insertElement()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editable-method-insertElement) when the `range` parameter is used. Now, the `editor.insertElement()` method works on a higher level, which means that it saves undo snapshots and sets the selection after insertion. Use the [`editable.insertElementIntoRange()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editable-method-insertElementIntoRange) method directly for the pre 4.5 behavior of `editable.insertElement()`.
* [#12870](http://dev.ckeditor.com/ticket/12870): Use [`editor.showNotification()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-showNotification) instead of `alert()` directly whenever possible. When the [Notification plugin](http://ckeditor.com/addon/notification) is loaded, the notification system is used automatically. Otherwise, the native `alert()` is displayed.
* [#8024](http://dev.ckeditor.com/ticket/8024): Swapped behavior of the Split Cell Vertically and Horizontally features of the [Table Tools](http://ckeditor.com/addon/tabletools) plugin to be more intuitive. Thanks to [kevinisagit](https://github.com/kevinisagit)!
* [#10903](http://dev.ckeditor.com/ticket/10903): Performance improvements for the [`dom.element.addClass()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.element-method-addClass), [`dom.element.removeClass()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.element-method-removeClass) and [`dom.element.hasClass()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.element-method-hasClass) methods. Note: The previous implementation allowed passing multiple classes to `addClass()` although it was only a side effect of that implementation. The new implementation does not allow this.
* [#11856](http://dev.ckeditor.com/ticket/11856): The jQuery adapter throws a meaningful error if CKEditor or jQuery are not loaded.

Fixed issues:

* [#11586](http://dev.ckeditor.com/ticket/11586): Fixed: [`range.cloneContents()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.range-method-cloneContents) should not change the DOM in order not to affect selection.
* [#12148](http://dev.ckeditor.com/ticket/12148): Fixed: [`dom.element.getChild()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.element-method-getChild) should not modify a passed array.
* [#12503](http://dev.ckeditor.com/ticket/12503): [Blink/Webkit] Fixed: Incorrect result of Select All and *Backspace* or *Delete*.
* [#13001](http://dev.ckeditor.com/ticket/13001): [Firefox] Fixed: The `<br />` filler is placed in the wrong position by the [`range.fixBlock()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.range-method-fixBlock) method due to quirky Firefox behavior.
* [#13101](http://dev.ckeditor.com/ticket/13101): [IE8] Fixed: Colons are prepended to HTML5 element names when cloning them.

## CKEditor 4.4.8

**Security Updates:**

* Fixed XSS vulnerability in the HTML parser reported by [Dheeraj Joshi](https://twitter.com/dheerajhere) and [Prem Kumar](https://twitter.com/iAmPr3m).

	Issue summary: It was possible to execute XSS inside CKEditor after persuading the victim to: (i) switch CKEditor to source mode, then (ii) paste a specially crafted HTML code, prepared by the attacker, into the opened CKEditor source area, and (iii) switch back to WYSIWYG mode.

**An upgrade is highly recommended!**

Fixed Issues:

* [#12899](http://dev.ckeditor.com/ticket/12899): Fixed: Corrected wrong tag ending for horizontal box definition in the [Dialog User Interface](http://ckeditor.com/addon/dialogui) plugin. Thanks to [mizafish](https://github.com/mizafish)!
* [#13254](http://dev.ckeditor.com/ticket/13254): Fixed: Cannot outdent block after indent when using the [Div Editing Area](http://ckeditor.com/addon/divarea) plugin. Thanks to [Jonathan Cottrill](https://github.com/jcttrll)!
* [#13268](http://dev.ckeditor.com/ticket/13268): Fixed: Documentation for [`CKEDITOR.dom.text`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.text) is incorrect. Thanks to [Ben Kiefer](https://github.com/benkiefer)!
* [#12739](http://dev.ckeditor.com/ticket/12739): Fixed: Link loses inline styles when edited without the [Advanced Tab for Dialogs](http://ckeditor.com/addon/dialogadvtab) plugin. Thanks to [Віталій Крутько](https://github.com/asmforce)!
* [#13292](http://dev.ckeditor.com/ticket/13292): Fixed: Protection pattern does not work in attribute in self-closing elements with no space before `/>`. Thanks to [Віталій Крутько](https://github.com/asmforce)!
* [PR#192](https://github.com/ckeditor/ckeditor-dev/pull/192): Fixed: Variable name typo in the [Dialog User Interface](http://ckeditor.com/addon/dialogui) plugin which caused [`CKEDITOR.ui.dialog.radio`](http://docs.ckeditor.com/#!/api/CKEDITOR.ui.dialog.radio) validation to not work. Thanks to [Florian Ludwig](https://github.com/FlorianLudwig)!
* [#13232](http://dev.ckeditor.com/ticket/13232): [Safari] Fixed: The [`element.appendText()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.element-method-appendText) method does not work properly for empty elements.
* [#13233](http://dev.ckeditor.com/ticket/13233): Fixed: [HTMLDataProcessor](http://docs.ckeditor.com/#!/api/CKEDITOR.htmlDataProcessor) can process `foo:href` attributes.
* [#12796](http://dev.ckeditor.com/ticket/12796): Fixed: The [Indent List](http://ckeditor.com/addon/indentlist) plugin unwraps parent `<li>` elements. Thanks to [Andrew Stucki](https://github.com/andrewstucki)!
* [#12885](http://dev.ckeditor.com/ticket/12885): Added missing [`editor.getData()`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-method-getData) parameter documentation.
* [#11982](http://dev.ckeditor.com/ticket/11982): Fixed: Bullet added in a wrong position after the *Enter* key is pressed in a nested list.
* [#13027](http://dev.ckeditor.com/ticket/13027): Fixed: Keyboard navigation in dialog windows with multiple tabs not following IBM CI 162 instructions or [ARIA Authoring Practices](http://www.w3.org/TR/2013/WD-wai-aria-practices-20130307/#tabpanel).
* [#12256](http://dev.ckeditor.com/ticket/12256): Fixed: Basic styles classes are lost when pasting from Microsoft Word if [basic styles](http://ckeditor.com/addon/basicstyles) were configured to use classes.
* [#12729](http://dev.ckeditor.com/ticket/12729): Fixed: Incorrect structure created when merging a block into a list item on *Backspace* and *Delete*.
* [#13031](http://dev.ckeditor.com/ticket/13031): [Firefox] Fixed: No more line breaks in source view since Firefox 36.
* [#13131](http://dev.ckeditor.com/ticket/13131): Fixed: The [Code Snippet](http://ckeditor.com/addon/codesnippet) plugin cannot be used without the [IFrame Editing Area](http://ckeditor.com/addon/wysiwygarea) plugin.
* [#9086](http://dev.ckeditor.com/ticket/9086): Fixed: Invalid ARIA property used on paste area `<iframe>`.
* [#13164](http://dev.ckeditor.com/ticket/13164): Fixed: Error when inserting a hidden field.
* [#13155](http://dev.ckeditor.com/ticket/13155): Fixed: Incorrect [Line Utilities](http://ckeditor.com/addon/lineutils) positioning when `<body>` has a margin.
* [#13351](http://dev.ckeditor.com/ticket/13351): Fixed: Link lost when editing a linked image with the Link tab disabled. This also fixed a bug when inserting an image into a fully selected link would throw an error ([#12847](https://dev.ckeditor.com/ticket/12847)).
* [#13344](http://dev.ckeditor.com/ticket/13344): [WebKit/Blink] Fixed: It is possible to remove or change editor content in [read-only mode](http://docs.ckeditor.com/#!/guide/dev_readonly).

Other Changes:

* [#12844](http://dev.ckeditor.com/ticket/12844) and [#13103](http://dev.ckeditor.com/ticket/13103): Upgraded the [testing environment](http://docs.ckeditor.com/#!/guide/dev_tests) to [Bender.js](https://github.com/benderjs/benderjs) `0.2.3`.
* [#12930](http://dev.ckeditor.com/ticket/12930): Because of licensing issues, `truncated-mathjax/` is now removed from the `tests/` directory. Now `bender.config.mathJaxLibPath` must be configured manually in order to run [Mathematical Formulas](http://ckeditor.com/addon/mathjax) plugin tests.
* [#13266](http://dev.ckeditor.com/ticket/13266): Added more shades of gray in the [Color Dialog](http://ckeditor.com/addon/colordialog) window. Thanks to [mizafish](https://github.com/mizafish)!


## CKEditor 4.4.7

Fixed Issues:

* [#12825](http://dev.ckeditor.com/ticket/12825): Fixed: Preventing the [Table Resize](http://ckeditor.com/addon/tableresize) plugin from operating on elements outside the editor. Thanks to [Paul Martin](https://github.com/Paul-Martin)!
* [#12157](http://dev.ckeditor.com/ticket/12157): Fixed: Lost text formatting on pressing *Tab* when the [`config.tabSpaces`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-tabSpaces) configuration option value was greater than zero.
* [#12777](http://dev.ckeditor.com/ticket/12777): Fixed: The `table-layout` CSS property should be reset by skins. Thanks to [vita10gy](https://github.com/vita10gy)!
* [#12812](http://dev.ckeditor.com/ticket/12812): Fixed: An uncaught security exception is thrown when [Line Utilities](http://ckeditor.com/addon/lineutils) are used in an inline editor loaded in a cross-domain `iframe`. Thanks to [Vitaliy Zurian](https://github.com/thecatontheflat)!
* [#12735](http://dev.ckeditor.com/ticket/12735): Fixed: [`config.fillEmptyBlocks`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-fillEmptyBlocks) should only apply when outputting data.
* [#10032](http://dev.ckeditor.com/ticket/10032): Fixed: [Paste from Word](http://ckeditor.com/addon/pastefromword) filter is executed for every paste after using the button.
* [#12597](http://dev.ckeditor.com/ticket/12597): [Blink/WebKit] Fixed: Multi-byte Japanese characters entry not working properly after *Shift+Enter*.
* [#12387](http://dev.ckeditor.com/ticket/12387): Fixed: An error is thrown if a skin does not have the [`chameleon`](http://docs.ckeditor.com/#!/api/CKEDITOR.skin-method-chameleon) property defined and [`config.uiColor`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-uiColor) is defined.
* [#12747](http://dev.ckeditor.com/ticket/12747): [IE8-10] Fixed: Opening a drop-down for a specific selection when the editor is maximized results in incorrect drop-down panel position.
* [#12850](http://dev.ckeditor.com/ticket/12850): [IEQM] Fixed: An error is thrown after focusing the editor.

## CKEditor 4.4.6

**Security Updates:**

* Fixed XSS vulnerability in the HTML parser reported by [Maco Cortes](https://www.facebook.com/Maaacoooo).

	Issue summary: It was possible to execute XSS inside CKEditor after persuading the victim to: (i) switch CKEditor to source mode, then (ii) paste a specially crafted HTML code, prepared by the attacker, into the opened CKEditor source area, and (iii) switch back to WYSIWYG mode.

**An upgrade is highly recommended!**

New Features:

* [#12501](http://dev.ckeditor.com/ticket/12501): Allowed dashes in element names in the [string format of allowed content rules](http://docs.ckeditor.com/#!/guide/dev_allowed_content_rules-section-string-format).
* [#12550](http://dev.ckeditor.com/ticket/12550): Added the `<main>` element to the [`CKEDITOR.dtd`](http://docs.ckeditor.com/#!/api/CKEDITOR.dtd).

Fixed Issues:

* [#12506](http://dev.ckeditor.com/ticket/12506): [Safari] Fixed: Cannot paste into inline editor if the page has `user-select: none` style. Thanks to [shaohua](https://github.com/shaohua)!
* [#12683](http://dev.ckeditor.com/ticket/12683): Fixed: [Filter](http://docs.ckeditor.com/#!/guide/dev_acf) fails to remove custom tags. Thanks to [timselier](https://github.com/timselier)!
* [#12489](http://dev.ckeditor.com/ticket/12489) and [#12491](http://dev.ckeditor.com/ticket/12491): Fixed: Various issues related to restoring the selection after performing operations on filler character. See the [fixed cases](http://dev.ckeditor.com/ticket/12491#comment:4).
* [#12621](http://dev.ckeditor.com/ticket/12621): Fixed: Cannot remove inline styles (bold, italic, etc.) in empty lines.
* [#12630](http://dev.ckeditor.com/ticket/12630): [Chrome] Fixed: Selection is placed outside the paragraph when the [New Page](http://ckeditor.com/addon/newpage) button is clicked. This patch significantly simplified the way how the initial selection (a selection after the content of the editable is overwritten) is being fixed. That might have fixed many related scenarios in all browsers.
* [#11647](http://dev.ckeditor.com/ticket/11647): Fixed: The [`editor.blur`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-blur) event is not fired on first blur after initializing the inline editor on an already focused element.
* [#12601](http://dev.ckeditor.com/ticket/12601): Fixed: [Strikethrough](http://ckeditor.com/addon/basicstyles) button tooltip spelling.
* [#12546](http://dev.ckeditor.com/ticket/12546): Fixed: The Preview tab in the [Document Properties](http://ckeditor.com/addon/docprops) dialog window is always disabled.
* [#12300](http://dev.ckeditor.com/ticket/12300): Fixed: The [`editor.change`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-change) event fired on first navigation key press after typing.
* [#12141](http://dev.ckeditor.com/ticket/12141): Fixed: List items are lost when indenting a list item with content wrapped with a block element.
* [#12515](http://dev.ckeditor.com/ticket/12515): Fixed: Cursor is in the wrong position when undoing after adding an image and typing some text.
* [#12484](http://dev.ckeditor.com/ticket/12484): [Blink/WebKit] Fixed: DOM is changed outside the editor area in a certain case.
* [#12688](http://dev.ckeditor.com/ticket/12688): Improved the tests of the [styles system](http://docs.ckeditor.com/#!/api/CKEDITOR.style) and fixed two minor issues.
* [#12403](http://dev.ckeditor.com/ticket/12403): Fixed: Changing the [font](http://ckeditor.com/addon/font) style should not lead to nesting it in the previous style element.
* [#12609](http://dev.ckeditor.com/ticket/12609): Fixed: Incorrect `config.magicline_putEverywhere` name used for a [Magic Line](http://ckeditor.com/addon/magicline) all-encompassing [`config.magicline_everywhere`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-magicline_everywhere) configuration option.


## CKEditor 4.4.5

New Features:

* [#12279](http://dev.ckeditor.com/ticket/12279): Added a possibility to pass a custom evaluator to [`node.getAscendant()`](http://docs.ckeditor.com/#!/api/CKEDITOR.dom.node-method-getAscendant).

Fixed Issues:

* [#12423](http://dev.ckeditor.com/ticket/12423): [Safari7.1+] Fixed: *Enter* key moved cursor to a strange position.
* [#12381](http://dev.ckeditor.com/ticket/12381): [iOS] Fixed: Selection issue. Thanks to [Remiremi](https://github.com/Remiremi)!
* [#10804](http://dev.ckeditor.com/ticket/10804): Fixed: `CKEDITOR_GETURL` is not used with some plugins where it should be used. Thanks to [Thomas Andraschko](https://github.com/tandraschko)!
* [#9137](http://dev.ckeditor.com/ticket/9137): Fixed: The `<base>` tag is not created when `<head>` has an attribute. Thanks to [naoki.fujikawa](https://github.com/naoki-fujikawa)!
* [#12377](http://dev.ckeditor.com/ticket/12377): Fixed: Errors thrown in the [Image](http://ckeditor.com/addon/image) plugin when removing preview from the dialog window definition. Thanks to [Axinet](https://github.com/Axinet)!
* [#12162](http://dev.ckeditor.com/ticket/12162): Fixed: Auto paragraphing and *Enter* key in nested editables.
* [#12315](http://dev.ckeditor.com/ticket/12315): Fixed: Marked [`config.autoParagraph`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-autoParagraph) as deprecated.
* [#12113](http://dev.ckeditor.com/ticket/12113): Fixed: A [code snippet](http://ckeditor.com/addon/codesnippet) should be presented in the [elements path](http://ckeditor.com/addon/elementspath) as "code snippet" (translatable).
* [#12311](http://dev.ckeditor.com/ticket/12311): Fixed: [Remove Format](http://ckeditor.com/addon/removeformat) should also remove `<cite>` elements.
* [#12261](http://dev.ckeditor.com/ticket/12261): Fixed: Filter has to be destroyed and removed from [`CKEDITOR.filter.instances`](http://docs.ckeditor.com/#!/api/CKEDITOR.filter-static-property-instances) on editor destroy.
* [#12398](http://dev.ckeditor.com/ticket/12398): Fixed: [Maximize](http://ckeditor.com/addon/maximize) does not work on an instance without a [title](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-title).
* [#12097](http://dev.ckeditor.com/ticket/12097): Fixed: JAWS not reading the number of options correctly in the [Text Color and Background Color](http://ckeditor.com/addon/colorbutton) button menu.
* [#12411](http://dev.ckeditor.com/ticket/12411): Fixed: [Page Break](http://ckeditor.com/addon/pagebreak) used directly in the editable breaks the editor.
* [#12354](http://dev.ckeditor.com/ticket/12354): Fixed: Various issues in undo manager when holding keys.
* [#12324](http://dev.ckeditor.com/ticket/12324): [IE8] Fixed: Undo steps are not recorded when changing the caret position by clicking below the body.
* [#12332](http://dev.ckeditor.com/ticket/12332): Fixed: Lowered DOM events listeners' priorities in undo manager in order to avoid ambiguity.
* [#12402](http://dev.ckeditor.com/ticket/12402): [Blink] Fixed: Workaround for Blink bug with `document.title` which breaks updating title in the full HTML mode.
* [#12338](http://dev.ckeditor.com/ticket/12338): Fixed: The CKEditor package contains unoptimized images.


## CKEditor 4.4.4

Fixed Issues:

* [#12268](http://dev.ckeditor.com/ticket/12268): Cleanup of [UI Color](http://ckeditor.com/addon/uicolor) YUI styles. Thanks to [CasherWest](https://github.com/CasherWest)!
* [#12263](http://dev.ckeditor.com/ticket/12263): Fixed: [Paste from Word](http://ckeditor.com/addon/pastefromword) filter does not properly normalize semicolons style text. Thanks to [Alin Purcaru](https://github.com/mesmerizero)!
* [#12243](http://dev.ckeditor.com/ticket/12243): Fixed: Text formatting lost when pasting from Word. Thanks to [Alin Purcaru](https://github.com/mesmerizero)!
* [#111739](http://dev.ckeditor.com/ticket/11739): Fixed: `keypress` listeners should not be used in the undo manager. A complete rewrite of keyboard handling in the undo manager was made. Numerous smaller issues were fixed, among others:
  * [#10926](http://dev.ckeditor.com/ticket/10926): [Chrome@Android] Fixed: Typing does not record snapshots and does not fire the [`editor.change`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-change) event.
  * [#11611](http://dev.ckeditor.com/ticket/11611): [Firefox] Fixed: The [`editor.change`](http://docs.ckeditor.com/#!/api/CKEDITOR.editor-event-change) event is fired when pressing Arrow keys.
  * [#12219](http://dev.ckeditor.com/ticket/12219): [Safari] Fixed: Some modifications of the [`UndoManager.locked`](http://docs.ckeditor.com/#!/api/CKEDITOR.plugins.undo.UndoManager-property-locked) property violate strict mode in the [Undo](http://ckeditor.com/addon/undo) plugin.
* [#10916](http://dev.ckeditor.com/ticket/10916): Fixed: [Magic Line](http://ckeditor.com/addon/magicline) icon in Right-To-Left environments.
* [#11970](http://dev.ckeditor.com/ticket/11970): [IE] Fixed: CKEditor `paste` event is not fired when pasting with *Shift+Ins*.
* [#12111](http://dev.ckeditor.com/ticket/12111): Fixed: Linked image attributes are not read when opening the image dialog window by doubleclicking.
* [#10030](http://dev.ckeditor.com/ticket/10030): [IE] Fixed: Prevented "Unspecified Error" thrown in various cases when IE8-9 does not allow access to `document.activeElement`.
* [#12273](http://dev.ckeditor.com/ticket/12273): Fixed: Applying block style in a description list breaks it.
* [#12218](http://dev.ckeditor.com/ticket/12218): Fixed: Minor syntax issue in CSS files.
* [#12178](http://dev.ckeditor.com/ticket/12178): [Blink/WebKit] Fixed: Iterator does not return the block if the selection is located at the end of it.
* [#12185](http://dev.ckeditor.com/ticket/12185): [IE9QM] Fixed: Error thrown when moving the mouse over focused editor's scrollbar.
* [#12215](http://dev.ckeditor.com/ticket/12215): Fixed: Basepath resolution does not recognize semicolon as a query separator.
* [#12135](http://dev.ckeditor.com/ticket/12135): Fixed: [Remove Format](http://ckeditor.com/addon/removeformat) does not work on widgets.
* [#12298](http://dev.ckeditor.com/ticket/12298): [IE11] Fixed: Clicking below `<body>` in Compatibility Mode will no longer reset selection to the first line.
* [#12204](http://dev.ckeditor.com/ticket/12204): Fixed: Editor's voice label is not affected by [`config.title`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-title).
* [#11915](http://dev.ckeditor.com/ticket/11915): Fixed: With [SCAYT](http://ckeditor.com/addon/scayt) enabled, cursor moves to the beginning of the first highlighted, misspelled word after typing or pasting into the editor.
* [SCAYT](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/69): Fixed: Error thrown in the console after enabling [SCAYT](http://ckeditor.com/addon/scayt) and trying to add a new image.


Other Changes:

* [#12296](http://dev.ckeditor.com/ticket/12296): Merged `benderjs-ckeditor` into the main CKEditor repository.

## CKEditor 4.4.3

**Security Updates:**

* Fixed XSS vulnerability in the Preview plugin reported by Mario Heiderich of [Cure53](https://cure53.de/).

**An upgrade is highly recommended!**

New Features:

* [#12164](http://dev.ckeditor.com/ticket/12164): Added the "Justify" option to the "Horizontal Alignment" drop-down in the Table Cell Properties dialog window.

Fixed Issues:

* [#12110](http://dev.ckeditor.com/ticket/12110): Fixed: Editor crash after deleting a table. Thanks to [Alin Purcaru](https://github.com/mesmerizero)!
* [#11897](http://dev.ckeditor.com/ticket/11897): Fixed: *Enter* key used in an empty list item creates a new line instead of breaking the list. Thanks to [noam-si](https://github.com/noam-si)!
* [#12140](http://dev.ckeditor.com/ticket/12140): Fixed: Double-clicking linked widgets opens two dialog windows.
* [#12132](http://dev.ckeditor.com/ticket/12132): Fixed: Image is inserted with `width` and `height` styles even when they are not allowed.
* [#9317](http://dev.ckeditor.com/ticket/9317): [IE] Fixed: [`config.disableObjectResizing`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-disableObjectResizing) does not work on IE. **Note**: We were not able to fix this issue on IE11+ because necessary events stopped working. See a [last resort workaround](http://dev.ckeditor.com/ticket/9317#comment:16) and make sure to [support our complaint to Microsoft](https://connect.microsoft.com/IE/feedback/details/742593/please-respect-execcommand-enableobjectresizing-in-contenteditable-elements).
* [#9638](http://dev.ckeditor.com/ticket/9638): Fixed: There should be no information about accessibility help available under the *Alt+0* keyboard shortcut if the [Accessibility Help](http://ckeditor.com/addon/a11yhelp) plugin is not available.
* [#8117](http://dev.ckeditor.com/ticket/8117) and [#9186](http://dev.ckeditor.com/ticket/9186): Fixed: In HTML5 `<meta>` tags should be allowed everywhere, including inside the `<body>` element.
* [#10422](http://dev.ckeditor.com/ticket/10422): Fixed: [`config.fillEmptyBlocks`](http://docs.ckeditor.com/#!/api/CKEDITOR.config-cfg-fillEmptyBlocks) not working properly if a function is specified.

## CKEditor 4.4.2

Important Notes:

* The CKEditor testing environment is now publicly available. Read more about how to set up the environment and execute tests in the [CKEditor Testing Environment](http://docs.ckeditor.com/#!/guide/dev_tests) guide.
	Please note that the [`tests/`](https://github.com/ckeditor/ckeditor-dev/tree/master/tests) directory which contains editor tests is not available in release packages. It can only