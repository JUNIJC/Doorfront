CKEditor 4 Changelog
====================

## CKEditor 4.14

**Security Updates:**

* Fixed XSS vulnerability in the HTML data processor reported by [Michał Bentkowski](https://twitter.com/securitymb) of Securitum.

	Issue summary: It was possible to execute XSS inside CKEditor after persuading the victim to: (i) switch CKEditor to source mode, then (ii) paste a specially crafted HTML code, prepared by the attacker, into the opened CKEditor source area, and (iii) switch back to WYSIWYG mode or (i) copy the specially crafted HTML code, prepared by the attacker and (ii) paste it into CKEditor in WYSIWYG mode.

* Fixed XSS vulnerability in the WebSpellChecker plugin reported by [Pham Van Khanh](https://twitter.com/rskvp93) from Viettel Cyber Security.

	Issue summary: It was possible to execute XSS using CKEditor after persuading the victim to: (i) switch CKEditor to source mode, then (ii) paste a specially crafted HTML code, prepared by the attacker, into the opened CKEditor source area, then (iii) switch back to WYSIWYG mode, and (iv) preview CKEditor content outside CKEditor editable area.

**An upgrade is highly recommended!**

New features:

* [#2374](https://github.com/ckeditor/ckeditor4/issues/2374): Added support for pasting rich content from LibreOffice Writer with the [Paste from LibreOffice](https://ckeditor.com/cke4/addon/pastefromlibreoffice) plugin.
* [#2583](https://github.com/ckeditor/ckeditor4/issues/2583): Changed [emoji](https://ckeditor.com/cke4/addon/emoji) suggestion box to show the matched emoji name instead of an ID.
* [#3748](https://github.com/ckeditor/ckeditor4/issues/3748): Improved the [color button](https://ckeditor.com/cke4/addon/colorbutton) state to reflect the selected editor content colors.
* [#3661](https://github.com/ckeditor/ckeditor4/issues/3661): Improved the [Print](https://ckeditor.com/cke4/addon/print) plugin to respect styling rendered by the [Preview](https://ckeditor.com/cke4/addon/preview) plugin.
* [#3547](https://github.com/ckeditor/ckeditor4/issues/3547): Active [dialog](https://ckeditor.com/cke4/addon/dialog) tab now has the `aria-selected="true"` attribute.
* [#3441](https://github.com/ckeditor/ckeditor4/issues/3441): Improved [`widget.getClipboardHtml()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_widget.html#method-getClipboardHtml) support for dragging and dropping multiple [widgets](https://ckeditor.com/cke4/addon/widget).

Fixed Issues:

* [#3587](https://github.com/ckeditor/ckeditor4/issues/3587): [Edge, IE] Fixed: [Widget](https://ckeditor.com/cke4/addon/widget) with form input elements loses focus during typing.
* [#3705](https://github.com/ckeditor/ckeditor4/issues/3705): [Safari] Fixed: Safari incorrectly removes blocks with the [`editor.extractSelectedHtml()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-extractSelectedHtml) method after selecting all content.
* [#1306](https://github.com/ckeditor/ckeditor4/issues/1306): Fixed: The [Font](https://ckeditor.com/cke4/addon/colorbutton) plugin creates nested HTML `<span>` tags when reapplying the same font multiple times.
* [#3498](https://github.com/ckeditor/ckeditor4/issues/3498): Fixed: The editor throws an error during the copy operation when a [widget](https://ckeditor.com/cke4/addon/widget) is partially selected.
* [#2517](https://github.com/ckeditor/ckeditor4/issues/2517): [Chrome, Firefox, Safari] Fixed: Inserting a new image when the selection partially covers an existing [enhanced image](https://ckeditor.com/cke4/addon/image2) widget throws an error.
* [#3007](https://github.com/ckeditor/ckeditor4/issues/3007): [Chrome, Firefox, Safari] Fixed: Cannot modify the editor content once the selection is released over a [widget](https://ckeditor.com/cke4/addon/widget).
* [#3698](https://github.com/ckeditor/ckeditor4/issues/3698): Fixed: Cutting the selected text when a [widget](https://ckeditor.com/cke4/addon/widget) is partially selected merges paragraphs.

API Changes:

* [#3387](https://github.com/ckeditor/ckeditor4/issues/3387): Added the [CKEDITOR.ui.richCombo.select()](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_ui_richCombo.html#method-select) method.
* [#3727](https://github.com/ckeditor/ckeditor4/issues/3727): Added new `textColor` and `bgColor` commands that apply the selected color chosen by the [Color Button](https://ckeditor.com/cke4/addon/colorbutton) plugin.
* [#3728](https://github.com/ckeditor/ckeditor4/issues/3728): Added new `font` and `fontSize` commands that apply the selected font style chosen by the [Font](https://ckeditor.com/cke4/addon/colorbutton) plugin.
* [#3842](https://github.com/ckeditor/ckeditor4/issues/3842): Added the [`editor.getSelectedRanges()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-getSelectedRanges) alias.
* [#3775](https://github.com/ckeditor/ckeditor4/issues/3775): Widget [mask](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_widget.html#property-mask) and [parts](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_widget.html#property-parts) can now be refreshed dynamically via API calls.

## CKEditor 4.13.1

Fixed Issues:

* [#875](https://github.com/ckeditor/ckeditor4/issues/875): Fixed: Pasting inside the editor that contains a table with the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin after selecting all content replaces only the table element instead of the entire content.
* [#3415](https://github.com/ckeditor/ckeditor4/issues/3415): [Firefox] Fixed: Pasting individual list elements fails. Thanks to [Jack Wickham](https://github.com/jackwickham)!
* [#3413](https://github.com/ckeditor/ckeditor4/issues/3413): Fixed: Menu items with labels containing double quotes are rendered incorrectly.
* [#3475](https://github.com/ckeditor/ckeditor4/issues/3475): [Firefox] Fixed: Pasting plain text over existing content fails and throws an error.
* [#2027](https://github.com/ckeditor/ckeditor4/issues/2027): Fixed: Incorrect email display text after reopening the [Link](https://ckeditor.com/cke4/addon/link) dialog for display names starting with `@`.
* [#3544](https://github.com/ckeditor/ckeditor4/issues/3544): Fixed: The [Special Characters](https://ckeditor.com/cke4/addon/specialchar) dialog read incorrectly by screen readers due to empty table cells at the end.
* [#1653](https://github.com/ckeditor/ckeditor4/issues/1653): Fixed: [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) is not repositioned when the editor is scrolled with the [Div Editing Area](https://ckeditor.com/cke4/addon/divarea) feature enabled.
* [#3559](https://github.com/ckeditor/ckeditor4/issues/3559): Fixed: [Color Dialog](https://ckeditor.com/cke4/addon/colordialog) is incorrectly positioned when used with another dialog.
* [#3593](https://github.com/ckeditor/ckeditor4/issues/3593): Fixed: Cannot access a text or comment node when replacing an element node with them via [`CKEDITOR.htmlParser.filter`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_htmlParser_filter.html).
* [#3524](https://github.com/ckeditor/ckeditor4/issues/3524): Fixed: The [Easy Image](https://ckeditor.com/cke4/addon/easyimage) plugin throws an error when any image with an unsupported data type is pasted into the editor.
* [#3552](https://github.com/ckeditor/ckeditor4/issues/3352): Fixed: Incorrect value of [`CKEDITOR.plugins.widget.repository#selected`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_widget_repository.html#property-selected) after selecting the whole editor content.
* [#3586](https://github.com/ckeditor/ckeditor4/issues/3586): Fixed: Content pasted from Microsoft Excel is not correctly recognised by the [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) plugin.
* [#3585](https://github.com/ckeditor/ckeditor4/issues/3585): [Firefox] Fixed: Microsoft Excel content is pasted as an image.
* [#3625](https://github.com/ckeditor/ckeditor4/issues/3625): [Firefox] Fixed: Microsoft PowerPoint content is pasted as an image.
* [#3474](https://github.com/ckeditor/ckeditor4/issues/3474): Fixed: Incorrect focus order after any tab in a [dialog](https://ckeditor.com/cke4/addon/dialog) was clicked.
* [#3689](https://github.com/ckeditor/ckeditor4/issues/3689): Fixed: Cannot change [dialog](https://ckeditor.com/cke4/addon/dialog) tabs with keyboard arrow keys after focusing any tab with a mouse click.

API Changes:

* [#3634](https://github.com/ckeditor/ckeditor4/issues/3634): Added the [`CKEDITOR.plugins.clipboard.dataTransfer#getTypes()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_clipboard_dataTransfer.html#method-getTypes) method.

## CKEditor 4.13

New Features:

* [#835](https://github.com/ckeditor/ckeditor4/issues/835): Extended support for pasting from external applications:
   * Added support for pasting rich content from Google Docs with the [Paste from Google Docs](https://ckeditor.com/cke4/addon/pastefromgdocs) plugin.
   * Added a new [Paste Tools](https://ckeditor.com/cke4/addon/pastetools) plugin for unified paste handling.
* [#3315](https://github.com/ckeditor/ckeditor4/issues/3315): Added support for strikethrough in the [BBCode](https://ckeditor.com/cke4/addon/bbcode) plugin. Thanks to [Alexander Kahl](https://github.com/akahl-owl)!
* [#3175](https://github.com/ckeditor/ckeditor4/issues/3175): Introduced selection optimization mechanism for handling incorrect selection behaviors in various browsers:
    * [#3256](https://github.com/ckeditor/ckeditor4/issues/3256): Triple-clicking in the last table cell and deleting content no longer pulls the content below into the table.
    * [#3118](https://github.com/ckeditor/ckeditor4/issues/3118): Selecting a paragraph with a triple-click and applying a heading applies the heading only to the selected paragraph.
    * [#3161](https://github.com/ckeditor/ckeditor4/issues/3161): Double-clicking a `<span>` element containing just one word creates a correct selection including the clicked `<span>` only.
* [#3359](https://github.com/ckeditor/ckeditor4/issues/3359): Improved [dialog](https://ckeditor.com/cke4/addon/dialog) positioning and behavior when the dialog is resized or moved, or the browser window is resized.
* [#2227](https://github.com/ckeditor/ckeditor4/issues/2227): Added the [`config.linkDefaultProtocol`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-linkDefaultProtocol) configuration option that allows setting the default URL protocol for the [Link](https://ckeditor.com/cke4/addon/link) plugin dialog.
* [#3240](https://github.com/ckeditor/ckeditor4/issues/3240): Extended the [`CKEDITOR.plugins.widget#mask`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_widget.html#property-mask) property to allow masking only the specified part of a [widget](https://ckeditor.com/cke4/addon/widget).
* [#3138](https://github.com/ckeditor/ckeditor4/issues/3138): Added the possibility to use the [`widgetDefinition.getClipboardHtml()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_widget.html#method-getClipboardHtml) method to customize the [widget](https://ckeditor.com/cke4/addon/widget) HTML during copy, cut and drag operations.

Fixed Issues:

* [#808](https://github.com/ckeditor/ckeditor4/issues/808): Fixed: [Widgets](https://ckeditor.com/cke4/addon/widget) and other content disappear on drag and drop in [read-only mode](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_readonly.html).
* [#3260](https://github.com/ckeditor/ckeditor4/issues/3260): Fixed: [Widget](https://ckeditor.com/cke4/addon/widget) drag handler is visible in [read-only mode](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_readonly.html).
* [#3261](https://github.com/ckeditor/ckeditor4/issues/3261): Fixed: A [widget](https://ckeditor.com/cke4/addon/widget) initialized using the dialog has an incorrect owner document.
* [#3198](https://github.com/ckeditor/ckeditor4/issues/3198): Fixed: Blurring and focusing the editor when a [widget](https://ckeditor.com/cke4/addon/widget) is focused creates an additional undo step.
* [#2859](https://github.com/ckeditor/ckeditor4/pull/2859): [IE, Edge] Fixed: Various editor UI elements react to right mouse button click:
	* [#2845](https://github.com/ckeditor/ckeditor4/issues/2845): [Rich Combo](https://ckeditor.com/cke4/addon/richcombo).
	* [#2857](https://github.com/ckeditor/ckeditor4/issues/2857): [List Block](https://ckeditor.com/cke4/addon/listblock).
	* [#2858](https://github.com/ckeditor/ckeditor4/issues/2858): [Menu](https://ckeditor.com/cke4/addon/menu).
* [#3158](https://github.com/ckeditor/ckeditor4/issues/3158): [Chrome, Safari] Fixed: [Undo](https://ckeditor.com/cke4/addon/undo) plugin breaks with the filling character.
* [#504](https://github.com/ckeditor/ckeditor4/issues/504): [Edge] Fixed: The editor's selection is collapsed to the beginning of the content when focusing the editor for the first time.
* [#3101](https://github.com/ckeditor/ckeditor4/issues/3101): Fixed: [`CKEDITOR.dom.range#_getTableElement()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_range.html#method-_getTableElement) returns `null` instead of a table element for edge cases.
* [#3287](https://github.com/ckeditor/ckeditor4/issues/3287): Fixed: [`CKEDITOR.tools.promise`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_promise.html) initializes incorrectly if an AMD loader is present.
* [#3379](https://github.com/ckeditor/ckeditor4/issues/3379): Fixed: Incorrect [`CKEDITOR.editor#getData()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-getData) call when inserting content into the editor.
* [#941](https://github.com/ckeditor/ckeditor4/issues/941): Fixed: An error is thrown after styling a table cell text selected using the native selection when the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin is enabled.
* [#3136](https://github.com/ckeditor/ckeditor4/issues/3136): [Firefox] Fixed: Clicking [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) items removes the native table selection.
* [#3381](https://github.com/ckeditor/ckeditor4/issues/3381): [IE8] Fixed: The [`CKEDITOR.tools.object.keys()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_object.html#method-keys) method does not accept non-objects.
* [#2395](https://github.com/ckeditor/ckeditor4/issues/2395): [Android] Fixed: Focused input in a [dialog](https://ckeditor.com/cke4/addon/dialog) is scrolled out of the viewport when the soft keyboard appears.
* [#453](https://github.com/ckeditor/ckeditor4/issues/453): Fixed: [Link](https://ckeditor.com/cke4/addon/link) dialog has an invalid width when the editor is maximized and the browser window is resized.
* [#2138](https://github.com/ckeditor/ckeditor4/issues/2138): Fixed: An email address containing a question mark is mishandled by the [Link](https://ckeditor.com/cke4/addon/link) plugin.
* [#14613](https://dev.ckeditor.com/ticket/14613): Fixed: Race condition when loading plugins for an already destroyed editor instance throws an error.
* [#2257](https://github.com/ckeditor/ckeditor4/issues/2257): Fixed: The editor throws an exception when destroyed shortly after it was created.
* [#3115](https://github.com/ckeditor/ckeditor4/issues/3115): Fixed: Destroying the editor during the initialization throws an error.
* [#3354](https://github.com/ckeditor/ckeditor4/issues/3354): [iOS] Fixed: Pasting no longer works on iOS version 13.
* [#3423](https://github.com/ckeditor/ckeditor4/issues/3423) Fixed: [Bookmarks](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_range.html#method-createBookmark) can be created inside temporary elements.

API Changes:

* [#3154](https://github.com/ckeditor/ckeditor4/issues/3154): Added the [`CKEDITOR.tools.array.some()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_array.html#method-some) method.
* [#3245](https://github.com/ckeditor/ckeditor4/issues/3245): Added the [`CKEDITOR.plugins.undo.UndoManager.addFilterRule()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_undo_UndoManager.html#method-addFilterRule) method that allows filtering undo snapshot contents.
* [#2845](https://github.com/ckeditor/ckeditor4/issues/2845): Added the [`CKEDITOR.tools.normalizeMouseButton()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-normalizeMouseButton) method.
* [#2975](https://github.com/ckeditor/ckeditor4/issues/2975): Added the [`CKEDITOR.dom.element#fireEventHandler()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_element.html#method-fireEventHandler) method.
* [#3247](https://github.com/ckeditor/ckeditor4/issues/3247): Extended the [`CKEDITOR.tools.bind()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-bind) method to accept arguments for bound functions.
* [#3326](https://github.com/ckeditor/ckeditor4/issues/3326): Added the [`CKEDITOR.dom.text#isEmpty()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_text.html#method-isEmpty) method.
* [#2423](https://github.com/ckeditor/ckeditor4/issues/2423): Added the [`CKEDITOR.plugins.dialog.getModel()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dialog.html#method-getModel) and [`CKEDITOR.plugins.dialog.getMode()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dialog.html#method-getMode) methods with their [`CKEDITOR.plugin.definition`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dialog_definition.html) counterparts, allowing to get the dialog subject of a change.
* [#3124](https://github.com/ckeditor/ckeditor4/issues/3124): Added the [`CKEDITOR.dom.element#isDetached()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_element.html#method-isDetached) method.

## CKEditor 4.12.1

Fixed Issues:

* [#3220](https://github.com/ckeditor/ckeditor4/issues/3220): Fixed: Prevent [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) filter from deleting [Page Break](https://ckeditor.com/cke4/addon/pagebreak) elements on paste.

## CKEditor 4.12

New Features:

* [#2598](https://github.com/ckeditor/ckeditor4/issues/2598): Added the [Page Break](https://ckeditor.com/cke4/addon/pagebreak) feature support for the [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) plugin.
* [#1490](https://github.com/ckeditor/ckeditor4/issues/1490): Improved the [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) plugin to retain table cell borders.
* [#2870](https://github.com/ckeditor/ckeditor4/issues/2870): Improved support for preserving the indentation of list items for nested lists pasted with the [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) plugin.
* [#2048](https://github.com/ckeditor/ckeditor4/issues/2048): New [`CKEDITOR.config.image2_maxSize`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-image2_maxSize) configuration option for the [Enhanced Image](https://ckeditor.com/cke4/addon/image2) plugin that allows setting a maximum size that an image can be resized to with the resizer.
* [#2639](https://github.com/ckeditor/ckeditor4/issues/2639): The [Color Dialog](https://ckeditor.com/cke4/addon/colordialog) plugin now shows the current selection's color when opened.
* [#2084](https://github.com/ckeditor/ckeditor4/issues/2084): The [Table Tools](https://ckeditor.com/cke4/addon/tabletools) plugin now allows to change the cell height unit type to either pixels or percent.
* [#3164](https://github.com/ckeditor/ckeditor4/issues/3164): The [Table Tools](https://ckeditor.com/cke4/addon/tabletools) plugin now accepts floating point values as the table cell width and height.

Fixed Issues:

* [#2672](https://github.com/ckeditor/ckeditor4/issues/2672): Fixed: When resizing an [Enhanced Image](https://ckeditor.com/cke4/addon/image2) to a minimum size with the resizer, the image dialog does not show actual values.
* [#1478](https://github.com/ckeditor/ckeditor4/issues/1478): Fixed: Custom colors added to [Color Button](https://ckeditor.com/cke4/addon/colorbutton) with the [`config.colorButton_colors`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-colorButton_colors) configuration option in the form of a label or code do not work correctly.
* [#1469](https://github.com/ckeditor/ckeditor4/issues/1469): Fixed: Trying to get data from a nested editable inside a freshly pasted widget throws an error.
* [#2235](https://github.com/ckeditor/ckeditor4/issues/2235): Fixed: An [Image](https://ckeditor.com/cke4/addon/image) in a table cell has an empty URL field when edited from the context menu opened by right-click when the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin is in use.
* [#3098](https://github.com/ckeditor/ckeditor4/issues/3098): Fixed: Unit pickers for table cell width and height in the [Table Tools](https://ckeditor.com/cke4/addon/tabletools) plugin have a different width.
* [#2923](https://github.com/ckeditor/ckeditor4/issues/2923): Fixed: The CSS `windowtext` color is not correctly recognized by the [`CKEDITOR.tools.style.parse`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_style_parse.html) methods.
* [#3120](https://github.com/ckeditor/ckeditor4/issues/3120): [IE8] Fixed: The [`CKEDITOR.tools.extend()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tool.html#method-extend) method does not work with the [`DontEnum`](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Data_structures#Properties) object property attribute.
* [#2813](https://github.com/ckeditor/ckeditor4/issues/2813): Fixed: Editor HTML insertion methods ([`editor.insertHtml()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-insertHtml), [`editor.insertHtmlIntoRange()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-insertHtmlIntoRange), [`editor.insertElement()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-insertElement) and [`editor.insertElementIntoRange()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-insertElementIntoRange)) pollute the editable with empty `<span>` elements.
* [#2751](https://github.com/ckeditor/ckeditor4/issues/2751): Fixed: An editor with [`config.enterMode`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-enterMode) set to [`ENTER_DIV`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR.html#property-ENTER_DIV) alters pasted content.

API Changes:

* [#1496](https://github.com/ckeditor/ckeditor4/issues/1496): The [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) plugin exposes the [`CKEDITOR.ui.balloonToolbar.reposition()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_ui_balloonToolbar.html#reposition) and [`CKEDITOR.ui.balloonToolbarView.reposition()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_ui_balloonToolbarView.html#reposition) methods.
* [#2021](https://github.com/ckeditor/ckeditor4/issues/2021): Added new [`CKEDITOR.dom.documentFragment.find()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_documentFragment.html#method-find) and [`CKEDITOR.dom.documentFragment.findOne()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_documentFragment.html#method-findOne) methods.
* [#2700](https://github.com/ckeditor/ckeditor4/issues/2700): Added the [`CKEDITOR.tools.array.find()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_array.html#method-find) method.
* [#3123](https://github.com/ckeditor/ckeditor4/issues/3123): Added the [`CKEDITOR.tools.object.keys()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_object.html#method-keys) method.
* [#3123](https://github.com/ckeditor/ckeditor4/issues/3123): Added the [`CKEDITOR.tools.object.entries()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_object.html#method-entries) method.
* [#3123](https://github.com/ckeditor/ckeditor4/issues/3123): Added the [`CKEDITOR.tools.object.values()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_object.html#method-values) method.
* [#2821](https://github.com/ckeditor/ckeditor4/issues/2821): The [`CKEDITOR.template#source`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_template.html#property-source) property can now be a function, so it can return the changed template values during the runtime. Thanks to [Jacek Pulit](https://github.com/jacek-pulit)!
* [#2598](https://github.com/ckeditor/ckeditor4/issues/2598): Added the [`CKEDITOR.plugins.pagebreak.createElement()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_pagebreak.html#method-createElement) method allowing to create a [Page Break](https://ckeditor.com/cke4/addon/pagebreak) plugin [`CKEDITOR.dom.element`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_element.html) instance.
* [#2748](https://github.com/ckeditor/ckeditor4/issues/2748): Enhanced error messages thrown when creating an editor on a non-existent element or when trying to instantiate the second editor on the same element. Thanks to [Byran Zaugg](https://github.com/blzaugg)!
* [#2698](https://github.com/ckeditor/ckeditor4/issues/2698): Added the [`CKEDITOR.htmlParser.element.findOne()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_htmlParser_element.html#method-findOne) method.
* [#2935](https://github.com/ckeditor/ckeditor4/issues/2935): Introduced the [`CKEDITOR.config.pasteFromWord_keepZeroMargins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-pasteFromWord_keepZeroMargins) configuration option that allows for keeping any `margin-*: 0` style that would be otherwise removed when pasting content with the [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) plugin.
* [#2962](https://github.com/ckeditor/ckeditor4/issues/2962): Added the [`CKEDITOR.tools.promise`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_promise.html) class.
* [#2924](https://github.com/ckeditor/ckeditor4/issues/2924): Added the [`CKEDITOR.tools.style.border`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_style_border.html) object wrapping CSS border style helpers under a single type.
* [#2495](https://github.com/ckeditor/ckeditor4/issues/2495): The [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin can now be disabled for the given table with the `data-cke-tableselection-ignored` attribute.
* [#2692](https://github.com/ckeditor/ckeditor4/issues/2692): Plugins can now expose information about the supported environment by implementing the [`pluginDefinition.isSupportedEnvironment()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_pluginDefinition.html#method-isSupportedEnvironment) method.

Other Changes:

* [#2741](https://github.com/ckeditor/ckeditor4/issues/2741): Replaced deprecated `arguments.callee` calls with named function expressions to allow the editor to work in strict mode.
* [#2924](https://github.com/ckeditor/ckeditor4/issues/2924): Marked [`CKEDITOR.tools.style.parse.border()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_style_parse.html#method-border) as deprecated in favor of the [`CKEDITOR.tools.style.border.fromCssRule()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_style_border.html#static-method-fromCssRule) method.
* [#3132](https://github.com/ckeditor/ckeditor4/issues/2924): Marked [`CKEDITOR.tools.objectKeys()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-objectKeys) as deprecated in favor of the [`CKEDITOR.tools.object.keys()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_object.html#method-keys) method.

## CKEditor 4.11.4

Fixed Issues:

* [#589](https://github.com/ckeditor/ckeditor4/issues/589): Fixed: The editor causes memory leaks in create and destroy cycles.
* [#1397](https://github.com/ckeditor/ckeditor4/issues/1397): Fixed: Using the dialog to remove headers from a [table](https://ckeditor.com/cke4/addon/table) with one header row only throws an error.
* [#1479](https://github.com/ckeditor/ckeditor4/issues/1479): Fixed: [Justification](https://ckeditor.com/cke4/addon/justify) for styled content in BR mode is disabled.
* [#2816](https://github.com/ckeditor/ckeditor4/issues/2816): Fixed: [Enhanced Image](https://ckeditor.com/cke4/addon/image2) resize handler is visible in [read-only mode](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_readonly.html).
* [#2874](https://github.com/ckeditor/ckeditor4/issues/2874): Fixed: [Enhanced Image](https://ckeditor.com/cke4/addon/image2) resize handler is not created when the editor is initialized in [read-only mode](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_readonly.html).
* [#2775](https://github.com/ckeditor/ckeditor4/issues/2775): Fixed: [Clipboard](https://ckeditor.com/cke4/addon/clipboard) paste buttons have wrong state when [read-only](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_readonly.html) mode is set by the mouse event listener with the [Div Editing Area](https://ckeditor.com/cke4/addon/divarea) plugin.
* [#1901](https://github.com/ckeditor/ckeditor4/issues/1901): Fixed: Cannot open the context menu over a [Widget](https://ckeditor.com/cke4/addon/widget) with the <kbd>Shift</kbd>+<kbd>F10</kbd> keyboard shortcut.

Other Changes:

* Updated [WebSpellChecker](https://ckeditor.com/cke4/addon/wsc) (WSC) and [SpellCheckAsYouType](https://ckeditor.com/cke4/addon/scayt) (SCAYT) plugins:
	* Language dictionary update: German language was extended with over 600k new words.
	* Language dictionary update: Swedish language was extended with over 300k new words.
	* Grammar support added for Australian and New Zealand English, Polish, Slovak, Slovenian and Austrian languages.
	* Changed wavy red and green lines that underline spelling and grammar errors to straight ones.
	* [#55](https://github.com/WebSpellChecker/ckeditor-plugin-wsc/issues/55): Fixed: WSC does not use [`CKEDITOR.getUrl()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR.html#method-getUrl) when referencing style sheets.
	* [#166](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/166): Fixed: SCAYT does not use [`CKEDITOR.getUrl()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR.html#method-getUrl) when referencing style sheets.
	* [#56](https://github.com/WebSpellChecker/ckeditor-plugin-wsc/issues/56): [Chrome] Fixed: SCAYT/WSC throws errors when running inside a  Chrome extension.
	* Fixed: After removing a dictionary, the words are not underlined and considered as incorrect.
	* Fixed: The Slovenian (`sl_SL`) language does not work.
	* Fixed: Quotes with code `U+2019` (Right single quotation mark) are considered separators.
	* Fixed: Wrong error message formatting when the service ID is invalid.
	* Fixed: Absent languages in the Languages tab when using SCAYT with the [Shared Spaces](https://ckeditor.com/cke4/addon/sharedspace) plugin.

## CKEditor 4.11.3

Fixed Issues:

* [#2721](https://github.com/ckeditor/ckeditor4/issues/2721), [#487](https://github.com/ckeditor/ckeditor4/issues/487): Fixed: The order of sublist items is reversed when a higher level list item is removed.
* [#2527](https://github.com/ckeditor/ckeditor4/issues/2527): Fixed: [Emoji](https://ckeditor.com/cke4/addon/emoji) autocomplete order does not prioritize emojis with the name starting from the used string.
* [#2572](https://github.com/ckeditor/ckeditor4/issues/2572): Fixed: Icons in the [Emoji](https://ckeditor.com/cke4/addon/emoji) dropdown navigation groups are not centered.
* [#1191](https://github.com/ckeditor/ckeditor4/issues/1191): Fixed: Items in the [elements path](https://ckeditor.com/cke4/addon/elementspath) are draggable.
* [#2292](https://github.com/ckeditor/ckeditor4/issues/2292): Fixed: Dropping a list with a link on the editor's margin causes a console error and removes the dragged text from editor.
* [#2756](https://github.com/ckeditor/ckeditor4/issues/2756): Fixed: The [Auto Link](https://ckeditor.com/cke4/addon/autolink) plugin causes an error when typing in the [source editing mode](https://ckeditor.com/docs/ckeditor4/latest/guide/dev_sourcearea.html).
* [#1986](https://github.com/ckeditor/ckeditor4/issues/1986): Fixed: The Cell Properties dialog from the [Table Tools](https://ckeditor.com/cke4/addon/tabletools) plugin shows styles that are not allowed through [`config.allowedContent`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-allowedContent).
* [#2565](https://github.com/ckeditor/ckeditor4/issues/2565): [IE, Edge] Fixed: Buttons in the [editor toolbar](https://ckeditor.com/cke4/addon/toolbar) are activated by clicking them with the right mouse button.
* [#2792](https://github.com/ckeditor/ckeditor4/pull/2792): Fixed: A bug in the [Copy Formatting](https://ckeditor.com/cke4/addon/copyformatting) plugin that caused the following issues:
    * [#2780](https://github.com/ckeditor/ckeditor4/issues/2780): Fixed: Undo steps disappear after multiple changes of selection.
    * [#2470](https://github.com/ckeditor/ckeditor4/issues/2470): [Firefox] Fixed: Widget's nested editable gets blurred upon focus.
    * [#2655](https://github.com/ckeditor/ckeditor4/issues/2655): [Chrome, Safari] Fixed: Widget's nested editable cannot be focused under certain circumstances.

## CKEditor 4.11.2

Fixed Issues:

* [#2403](https://github.com/ckeditor/ckeditor4/issues/2403): Fixed: Styling inline editor initialized inside a table with the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin is causing style leaks.
* [#2514](https://github.com/ckeditor/ckeditor4/issues/2403): Fixed: Pasting table data into inline editor initialized inside a table with the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin inserts pasted content into the wrapping table.
* [#2451](https://github.com/ckeditor/ckeditor4/issues/2451): Fixed: The [Remove Format](https://ckeditor.com/cke4/addon/removeformat) plugin changes selection.
* [#2546](https://github.com/ckeditor/ckeditor4/issues/2546): Fixed: The separator in the toolbar moves when buttons are focused.
* [#2506](https://github.com/ckeditor/ckeditor4/issues/2506): Fixed: [Enhanced Image](https://ckeditor.com/cke4/addon/image2) throws a type error when an empty `<figure>` tag with an `image` class is upcasted.
* [#2650](https://github.com/ckeditor/ckeditor4/issues/2650): Fixed: [Table](https://ckeditor.com/cke4/addon/table) dialog validator fails when the `getValue()` function is defined in the global scope.
* [#2690](https://github.com/ckeditor/ckeditor4/issues/2690): Fixed: Decimal characters are removed from the inside of numbered lists when pasting content using the [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) plugin.
* [#2205](https://github.com/ckeditor/ckeditor4/issues/2205): Fixed: It is not possible to add new list items under an item containing a block element.
* [#2411](https://github.com/ckeditor/ckeditor4/issues/2411), [#2438](https://github.com/ckeditor/ckeditor4/issues/2438) Fixed: Apply numbered list option throws a console error for a specific markup.
* [#2430](https://github.com/ckeditor/ckeditor4/issues/2430) Fixed: [Color Button](https://ckeditor.com/cke4/addon/colorbutton) and [List Block](https://ckeditor.com/cke4/addon/listblock) items are draggable.

Other Changes:

* Updated the [WebSpellChecker](https://ckeditor.com/cke4/addon/wsc) (WSC) plugin:
	* [#52](https://github.com/WebSpellChecker/ckeditor-plugin-wsc/issues/52) Fixed: Clicking "Finish Checking" without a prior action would hang the Spell Checking dialog.
* [#2603](https://github.com/ckeditor/ckeditor4/issues/2603): Corrected the GPL license entry in the `package.json` file.

## CKEditor 4.11.1

Fixed Issues:

* [#2571](https://github.com/ckeditor/ckeditor4/issues/2571): Fixed: Clicking the categories in the [Emoji](https://ckeditor.com/cke4/addon/emoji) dropdown panel scrolls the entire page.

## CKEditor 4.11

**Security Updates:**

* Fixed XSS vulnerability in the HTML parser reported by [maxarr](https://hackerone.com/maxarr).

	Issue summary: It was possible to execute XSS inside CKEditor after persuading the victim to: (i) switch CKEditor to source mode, then (ii) paste a specially crafted HTML code, prepared by the attacker, into the opened CKEditor source area, and (iii) switch back to WYSIWYG mode.

**An upgrade is highly recommended!**

New Features:

* [#2062](https://github.com/ckeditor/ckeditor4/pull/2062): Added the emoji dropdown that allows the user to choose the emoji from the toolbar and search for them using keywords.
* [#2154](https://github.com/ckeditor/ckeditor4/issues/2154): The [Link](https://ckeditor.com/cke4/addon/link) plugin now supports phone number links.
* [#1815](https://github.com/ckeditor/ckeditor4/issues/1815): The [Auto Link](https://ckeditor.com/cke4/addon/autolink) plugin supports typing link completion.
* [#2478](https://github.com/ckeditor/ckeditor4/issues/2478): [Link](https://ckeditor.com/cke4/addon/link) can be inserted using the <kbd>Ctrl</kbd>/<kbd>Cmd</kbd> + <kbd>K</kbd> keystroke.
* [#651](https://github.com/ckeditor/ckeditor4/issues/651): Text pasted using the [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) plugin preserves indentation in paragraphs.
* [#2248](https://github.com/ckeditor/ckeditor4/issues/2248): Added support for justification in the [BBCode](https://ckeditor.com/cke4/addon/bbcode) plugin. Thanks to [Matěj Kmínek](https://github.com/KminekMatej)!
* [#706](https://github.com/ckeditor/ckeditor4/issues/706): Added a different cursor style when selecting cells for the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin.
* [#2072](https://github.com/ckeditor/ckeditor4/issues/2072): The [UI Button](https://ckeditor.com/cke4/addon/button) plugin supports custom `aria-haspopup` property values. The [Menu Button](https://ckeditor.com/cke4/addon/menubutton) `aria-haspopup` value is now `menu`, the [Panel Button](https://ckeditor.com/cke4/addon/panelbutton) and [Rich Combo](https://ckeditor.com/cke4/addon/richcombo) `aria-haspopup` value is now `listbox`.
* [#1176](https://github.com/ckeditor/ckeditor4/pull/1176): The [Balloon Panel](https://ckeditor.com/cke4/addon/balloonpanel) can now be attached to a selection instead of an element.
* [#2202](https://github.com/ckeditor/ckeditor4/issues/2202): Added the `contextmenu_contentsCss` configuration option to allow adding custom CSS to the [Context Menu](https://ckeditor.com/cke4/addon/contextmenu).

Fixed Issues:

* [#1477](https://github.com/ckeditor/ckeditor4/issues/1477): Fixed: On destroy, [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) does not destroy its content.
* [#2394](https://github.com/ckeditor/ckeditor4/issues/2394): Fixed: [Emoji](https://ckeditor.com/cke4/addon/emoji) dropdown does not show up with repeated symbols in a single line.
* [#1181](https://github.com/ckeditor/ckeditor4/issues/1181): [Chrome] Fixed: Opening the context menu in a read-only editor results in an error.
* [#2276](https://github.com/ckeditor/ckeditor4/issues/2276): [iOS] Fixed: [Button](https://ckeditor.com/cke4/addon/button) state does not refresh properly.
* [#1489](https://github.com/ckeditor/ckeditor4/issues/1489): Fixed: Table contents can be removed in read-only mode when the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin is used.
* [#1264](https://github.com/ckeditor/ckeditor4/issues/1264) Fixed: Right-click does not clear the selection created with the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin.
* [#586](https://github.com/ckeditor/ckeditor4/issues/586) Fixed: The `required` attribute is not correctly recognized by the [Form Elements](https://ckeditor.com/cke4/addon/forms) plugin dialog. Thanks to [Roli Züger](https://github.com/rzueger)!
* [#2380](https://github.com/ckeditor/ckeditor4/issues/2380) Fixed: Styling HTML comments in a top-level element results in extra paragraphs.
* [#2294](https://github.com/ckeditor/ckeditor4/issues/2294) Fixed: Pasting content from Microsoft Outlook and then bolding it results in an error.
* [#2035](https://github.com/ckeditor/ckeditor4/issues/2035) [Edge] Fixed: `Permission denied` is thrown when opening a [Panel](https://ckeditor.com/cke4/addon/panel) instance.
* [#965](https://github.com/ckeditor/ckeditor4/issues/965) Fixed: The [`config.forceSimpleAmpersand`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-forceSimpleAmpersand) option does not work. Thanks to [Alex Maris](https://github.com/alexmaris)!
* [#2448](https://github.com/ckeditor/ckeditor4/issues/2448): Fixed: The [`Escape HTML Entities`] plugin with custom [additional entities](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-entities_additional) configuration breaks HTML escaping.
* [#898](https://github.com/ckeditor/ckeditor4/issues/898): Fixed: [Enhanced Image](https://ckeditor.com/cke4/addon/image2) long alternative text protrudes into the editor when the image is selected.
* [#1113](https://github.com/ckeditor/ckeditor4/issues/1113): [Firefox] Fixed: Nested contenteditable elements path is not updated on focus with the [Div Editing Area](https://ckeditor.com/cke4/addon/divarea) plugin.
* [#1682](https://github.com/ckeditor/ckeditor4/issues/1682) Fixed: Hovering the [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) panel changes its size, causing flickering.
* [#421](https://github.com/ckeditor/ckeditor4/issues/421) Fixed: Expandable [Button](https://ckeditor.com/cke4/addon/button) puts the `(Selected)` text at the end of the label when clicked.
* [#1454](https://github.com/ckeditor/ckeditor4/issues/1454): Fixed: The [`onAbort`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_fileTools_uploadWidgetDefinition.html#property-onAbort) method of the [Upload Widget](https://ckeditor.com/cke4/addon/uploadwidget) is not called when the loader is aborted.
* [#1451](https://github.com/ckeditor/ckeditor4/issues/1451): Fixed: The context menu is incorrectly positioned when opened with <kbd>Shift</kbd>+<kbd>F10</kbd>.
* [#1722](https://github.com/ckeditor/ckeditor4/issues/1722): [`CKEDITOR.filter.instances`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_filter.html#static-property-instances) is causing memory leaks.
* [#2491](https://github.com/ckeditor/ckeditor4/issues/2491): Fixed: The [Mentions](https://ckeditor.com/cke4/addon/mentions) plugin is not matching diacritic characters.
* [#2519](https://github.com/ckeditor/ckeditor4/issues/2519): Fixed: The [Accessibility Help](https://ckeditor.com/cke4/addon/a11yhelp) dialog should display all available keystrokes for a single command.

API Changes:

* [#2453](https://github.com/ckeditor/ckeditor4/issues/2453): The [`CKEDITOR.ui.panel.block.getItems`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_ui_panel_block.html#method-getItems) method now also returns `input` elements in addition to links.
* [#2224](https://github.com/ckeditor/ckeditor4/issues/2224):  The [`CKEDITOR.tools.convertToPx`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-convertToPx) function now converts negative values.
* [#2253](https://github.com/ckeditor/ckeditor4/issues/2253): The widget definition [`insert`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_widget_definition.html#property-insert) method now passes `editor` and `commandData`. Thanks to [marcparmet](https://github.com/marcparmet)!
* [#2045](https://github.com/ckeditor/ckeditor4/issues/2045): Extracted [`tools.eventsBuffer`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-eventsBuffer) and [`tools.throttle`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-throttle) functions logic into a separate namespace.
	* [`tools.eventsBuffer`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-eventsBuffer) was extracted into [`tools.buffers.event`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_buffers_event.html),
	* [`tools.throttle`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-throttle) was extracted into [`tools.buffers.throttle`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_buffers_throttle.html).
* [#2466](https://github.com/ckeditor/ckeditor4/issues/2466):  The [`CKEDITOR.filter`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-constructor) constructor accepts an additional `rules` parameter allowing to bind the editor and filter together.
* [#2493](https://github.com/ckeditor/ckeditor4/issues/2493):  The [`editor.getCommandKeystroke`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-getCommandKeystroke) method accepts an additional `all` parameter allowing to retrieve an array of all command keystrokes.
* [#2483](https://github.com/ckeditor/ckeditor4/issues/2483): Button's DOM element created with the [`hasArrow`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_ui.html#method-addButton) definition option can by identified by the `.cke_button_expandable` CSS class.

Other Changes:

* [#1713](https://github.com/ckeditor/ckeditor4/issues/1713): Removed the redundant `lang.title` entry from the [Clipboard](https://ckeditor.com/cke4/addon/clipboard) plugin.

## CKEditor 4.10.1

Fixed Issues:

* [#2114](https://github.com/ckeditor/ckeditor4/issues/2114): Fixed: [Autocomplete](https://ckeditor.com/cke4/addon/autocomplete) cannot be initialized before [`instanceReady`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#event-instanceReady).
* [#2107](https://github.com/ckeditor/ckeditor4/issues/2107): Fixed: Holding and releasing the mouse button is not inserting an [autocomplete](https://ckeditor.com/cke4/addon/autocomplete) suggestion.
* [#2167](https://github.com/ckeditor/ckeditor4/issues/2167): Fixed: Matching in [Emoji](https://ckeditor.com/cke4/addon/emoji) plugin is not case insensitive.
* [#2195](https://github.com/ckeditor/ckeditor4/issues/2195): Fixed: [Emoji](https://ckeditor.com/cke4/addon/emoji) shows the suggestion box when the colon is preceded with other characters than white space.
* [#2169](https://github.com/ckeditor/ckeditor4/issues/2169): [Edge] Fixed: Error thrown when pasting into the editor.
* [#1084](https://github.com/ckeditor/ckeditor4/issues/1084) Fixed: Using the "Automatic" option with [Color Button](https://ckeditor.com/cke4/addon/colorbutton) on a text with the color already defined sets an invalid color value.
* [#2271](https://github.com/ckeditor/ckeditor4/issues/2271): Fixed: Custom color name not used as a label in the [Color Button](https://ckeditor.com/cke4/addon/image2) plugin. Thanks to [Eric Geloen](https://github.com/egeloen)!
* [#2296](https://github.com/ckeditor/ckeditor4/issues/2296): Fixed: The [Color Button](https://ckeditor.com/cke4/addon/colorbutton) plugin throws an error when activated on content containing HTML comments.
* [#966](https://github.com/ckeditor/ckeditor4/issues/966): Fixed: Executing [`editor.destroy()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-destroy) during the [file upload](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_fileTools_uploadWidgetDefinition.html#property-onUploading) throws an error. Thanks to [Maksim Makarevich](https://github.com/MaksimMakarevich)!
* [#1719](https://github.com/ckeditor/ckeditor4/issues/1719): Fixed: <kbd>Ctrl</kbd>/<kbd>Cmd</kbd> + <kbd>A</kbd> inadvertently focuses inline editor if it is starting and ending with a list. Thanks to [theNailz](https://github.com/theNailz)!
* [#1046](https://github.com/ckeditor/ckeditor4/issues/1046): Fixed: Subsequent new links do not include the `id` attribute. Thanks to [Nathan Samson](https://github.com/nathansamson)!
* [#1348](https://github.com/ckeditor/ckeditor4/issues/1348): Fixed: [Enhanced Image](https://ckeditor.com/cke4/addon/image2) plugin aspect ratio locking uses an old width and height on image URL change.
* [#1791](https://github.com/ckeditor/ckeditor4/issues/1791): Fixed: [Image](https://ckeditor.com/cke4/addon/image) and [Enhanced Image](https://ckeditor.com/cke4/addon/image2) plugins can be enabled when [Easy Image](https://ckeditor.com/cke4/addon/easyimage) is present.
* [#2254](https://github.com/ckeditor/ckeditor4/issues/2254): Fixed: [Image](https://ckeditor.com/cke4/addon/image) ratio locking is too precise for resized images. Thanks to [Jonathan Gilbert](https://github.com/logiclrd)!
* [#1184](https://github.com/ckeditor/ckeditor4/issues/1184): [IE8-11] Fixed: Copying and pasting data in [read-only mode](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#property-readOnly) throws an error.
* [#1916](https://github.com/ckeditor/ckeditor4/issues/1916): [IE9-11] Fixed: Pressing the <kbd>Delete</kbd> key in [read-only mode](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#property-readOnly) throws an error.
* [#2003](https://github.com/ckeditor/ckeditor4/issues/2003): [Firefox] Fixed: Right-clicking multiple selected table cells containing empty paragraphs removes the selection.
* [#1816](https://github.com/ckeditor/ckeditor4/issues/1816): Fixed: Table breaks when <kbd>Enter</kbd> is pressed over the [Table Selection](https://ckeditor.com/cke4/addon/tableselection) plugin.
* [#1115](https://github.com/ckeditor/ckeditor4/issues/1115): Fixed: The `<font>` tag is not preserved when proper configuration is provided and a style is applied by the [Font](https://ckeditor.com/cke4/addon/font) plugin.
* [#727](https://github.com/ckeditor/ckeditor4/issues/727): Fixed: Custom styles may be invisible in the [Styles Combo](https://ckeditor.com/cke4/addon/stylescombo) plugin.
* [#988](https://github.com/ckeditor/ckeditor4/issues/988): Fixed: ACF-enabled custom elements prefixed with `object`, `embed`, `param` are removed from the editor content.

API Changes:

* [#2249](https://github.com/ckeditor/ckeditor4/issues/1791): Added the [`editor.plugins.detectConflict()`](https://ckeditor.com/docs/ckeditor4/latest/CKEDITOR_editor_plugins.html#method-detectConflict) method finding conflicts between provided plugins.

## CKEditor 4.10

New Features:

* [#1751](https://github.com/ckeditor/ckeditor4/issues/1751): Introduced the **Autocomplete** feature that consists of the following plugins:
	* [Autocomplete](https://ckeditor.com/cke4/addon/autocomplete) &ndash; Provides contextual completion feature for custom text matches based on user input.
	* [Text Watcher](https://ckeditor.com/cke4/addon/textWatcher) &ndash; Checks whether an editor's text change matches the chosen criteria.
	* [Text Match](https://ckeditor.com/cke4/addon/textMatch) &ndash; Allows to search [`CKEDITOR.dom.range`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_range.html) for matching text.
* [#1703](https://github.com/ckeditor/ckeditor4/issues/1703): Introduced the [Mentions](https://ckeditor.com/cke4/addon/mentions) plugin providing smart completion feature for custom text matches based on user input starting with a chosen marker character.
* [#1746](https://github.com/ckeditor/ckeditor4/issues/1703): Introduced the [Emoji](https://ckeditor.com/cke4/addon/emoji) plugin providing completion feature for emoji ideograms.
* [#1761](https://github.com/ckeditor/ckeditor4/issues/1761): The [Auto Link](https://ckeditor.com/cke4/addon/autolink) plugin now supports email links.

Fixed Issues:

* [#1458](https://github.com/ckeditor/ckeditor4/issues/1458): [Edge] Fixed: After blurring the editor it takes 2 clicks to focus a widget.
* [#1034](https://github.com/ckeditor/ckeditor4/issues/1034): Fixed: JAWS leaves forms mode after pressing the <kbd>Enter</kbd> key in an inline editor instance.
* [#1748](https://github.com/ckeditor/ckeditor4/pull/1748): Fixed: Missing [`CKEDITOR.dialog.definition.onHide`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dialog_definition.html#property-onHide) API documentation. Thanks to [sunnyone](https://github.com/sunnyone)!
* [#1321](https://github.com/ckeditor/ckeditor4/issues/1321): Fixed: Ideographic space character (`\u3000`) is lost when pasting text.
* [#1776](https://github.com/ckeditor/ckeditor4/issues/1776): Fixed: Empty caption placeholder of the [Image Base](https://ckeditor.com/cke4/addon/imagebase) plugin is not hidden when blurred.
* [#1592](https://github.com/ckeditor/ckeditor4/issues/1592): Fixed: The [Image Base](https://ckeditor.com/cke4/addon/imagebase) plugin caption is not visible after paste.
* [#620](https://github.com/ckeditor/ckeditor4/issues/620): Fixed: The [`config.forcePasteAsPlainText`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-forcePasteAsPlainText) option is not respected in internal and cross-editor pasting.
* [#1467](https://github.com/ckeditor/ckeditor4/issues/1467): Fixed: The resizing cursor of the [Table Resize](https://ckeditor.com/cke4/addon/tableresize) plugin appearing in the middle of a merged cell.

API Changes:

* [#850](https://github.com/ckeditor/ckeditor4/issues/850): Backward incompatibility: Replaced the `replace` dialog from the [Find / Replace](https://ckeditor.com/cke4/addon/find) plugin with a `tabId` option in the `find` command.
* [#1582](https://github.com/ckeditor/ckeditor4/issues/1582): The [`CKEDITOR.editor.addCommand()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#method-addCommand) method can now accept a [`CKEDITOR.command`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_command.html) instance as a parameter.
* [#1712](https://github.com/ckeditor/ckeditor4/issues/1712): The [`extraPlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-extraPlugins), [`removePlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-removePlugins) and [`plugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-plugins) configuration options allow whitespace.
* [#1802](https://github.com/ckeditor/ckeditor4/issues/1802): The [`extraPlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-extraPlugins), [`removePlugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-removePlugins) and [`plugins`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-plugins) configuration options allow passing plugin names as an array.
* [#1724](https://github.com/ckeditor/ckeditor4/issues/1724): Added an option to the [`getClientRect()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_element.html#method-getClientRect) function allowing to retrieve an absolute bounding rectangle of the element, i.e. a position relative to the upper-left corner of the topmost viewport.
* [#1498](https://github.com/ckeditor/ckeditor4/issues/1498) : Added a new [`getClientRects()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_dom_range.html#method-getClientRects) method to `CKEDITOR.dom.range`. It returns a list of rectangles for each selected element.
* [#1993](https://github.com/ckeditor/ckeditor4/issues/1993): Added the [`CKEDITOR.tools.throttle()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools.html#method-throttle) function.

Other Changes:

* Updated [SCAYT](https://ckeditor.com/cke4/addon/scayt) (Spell Check As You Type) and [WebSpellChecker](https://ckeditor.com/cke4/addon/wsc) (WSC) plugins:
	* Language dictionary update: Added support for the Uzbek Latin language.
	* Languages no longer supported as additional languages: Manx - Isle of Man (`gv_GB`) and Interlingua (`ia_XR`).
	* Extended and improved language dictionaries: Georgian and Swedish. Also added the missing word _"Ensure"_ to the American, British and Canada English language.
	* [#141](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/141) Fixed: SCAYT throws "Uncaught Error: Error in RangyWrappedRange module: createRange(): Parameter must be a Window object or DOM node".
	* [#153](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/153) [Chrome] Fixed: Correcting a word in the widget in SCAYT moves focus to another editable.
	* [#155](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/155) [IE8] Fixed: SCAYT throws an error and does not work.
	* [#156](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/156) [IE10] Fixed: SCAYT does not seem to work.
	* Fixed: After some text is dragged and dropped, the markup is not refreshed for grammar problems in SCAYT.
	* Fixed: Request to FastCGI fails when the user tries to replace a word with non-English characters with a proper suggestion in WSC.
	* [Firefox] Fixed: <kbd>Ctrl</kbd>+<kbd>Z</kbd> removes focus in SCAYT.
	* Grammar support for default languages was improved.
	* New application source URL was added in SCAYT.
	* Removed green marks and legend related to grammar-supported languages in the Languages tab of SCAYT. Grammar is now supported for almost all the anguages in the list for an additional fee.
	* Fixed: JavaScript error in the console: "Cannot read property 'split' of undefined" in SCAYT and WSC.
	* [IE10] Fixed: Markup is not set for a specific case in SCAYT.
	* Fixed: Accessibility issue: No `alt` attribute for the logo image in the About tab of SCAYT.

## CKEditor 4.9.2

**Security Updates:**

* Fixed XSS vulnerability in the [Enhanced Image](https://ckeditor.com/cke4/addon/image2) (`image2`) plugin reported by [Kyaw Min Thein](https://twitter.com/kyawminthein99).

	Issue summary: It was possible to execute XSS inside CKEditor using the `<img>` tag and specially crafted HTML. Please note that the default presets (Basic/Standard/Full) do not include this plugin, so you are only at risk if you made a custom build and enabled this plugin.

We would like to thank the [Drupal security team](https://www.drupal.org/drupal-security-team) for bringing this matter to our attention and coordinating the fix and release process!

## CKEditor 4.9.1

Fixed Issues:

* [#1835](https://github.com/ckeditor/ckeditor4/issues/1835): Fixed: Integration between [CKFinder](https://ckeditor.com/ckeditor-4/ckfinder/) and the [File Browser](https://ckeditor.com/cke4/addon/filebrowser) plugin does not work.

## CKEditor 4.9

New Features:

* [#932](https://github.com/ckeditor/ckeditor4/issues/932): Introduced Easy Image feature for inserting images that are automatically rescaled, optimized, responsive and delivered through a blazing-fast CDN. Three new plugins were added to support it:
    * [Easy Image](https://ckeditor.com/cke4/addon/easyimage),
    * [Cloud Services](https://ckeditor.com/cke4/addon/cloudservices)
    * [Image Base](https://ckeditor.com/cke4/addon/imagebase)
* [#1338](https://github.com/ckeditor/ckeditor4/issues/1338): Keystroke labels are displayed for function keys (like F7, F8).
* [#643](https://github.com/ckeditor/ckeditor4/issues/643): The [File Browser](https://ckeditor.com/cke4/addon/filebrowser) plugin can now upload files using XHR requests. This allows for setting custom HTTP headers using the [`config.fileTools_requestHeaders`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-fileTools_requestHeaders) configuration option.
* [#1365](https://github.com/ckeditor/ckeditor4/issues/1365): The [File Browser](https://ckeditor.com/cke4/addon/filebrowser) plugin uses XHR requests by default.
* [#1399](https://github.com/ckeditor/ckeditor4/issues/1399): Added the possibility to set [`CKEDITOR.config.startupFocus`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-startupFocus) as `start` or `end` to specify where the editor focus should be after the initialization.
* [#1441](https://github.com/ckeditor/ckeditor4/issues/1441): The [Magic Line](https://ckeditor.com/cke4/addon/magicline) plugin line element can now be identified by the `data-cke-magic-line="1"` attribute.

Fixed Issues:

* [#595](https://github.com/ckeditor/ckeditor4/issues/595): Fixed: Pasting does not work on mobile devices.
* [#869](https://github.com/ckeditor/ckeditor4/issues/869): Fixed: Empty selection clears cached clipboard data in the editor.
* [#1419](https://github.com/ckeditor/ckeditor4/issues/1419): Fixed: The [Widget Selection](https://ckeditor.com/cke4/addon/widgetselection) plugin selects the editor content with the <kbd>Alt+A</kbd> key combination on Windows.
* [#1274](https://github.com/ckeditor/ckeditor4/issues/1274): Fixed: [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) does not match a single selected image using the [`contextDefinition.cssSelector`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_plugins_balloontoolbar_contextDefinition.html#property-cssSelector) matcher.
* [#1232](https://github.com/ckeditor/ckeditor4/issues/1232): Fixed: [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) buttons should be registered as focusable elements.
* [#1342](https://github.com/ckeditor/ckeditor4/issues/1342): Fixed: [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) should be re-positioned after the [`change`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_editor.html#event-change) event.
* [#1426](https://github.com/ckeditor/ckeditor4/issues/1426): [IE8-9] Fixed: Missing [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) background in the [Kama](https://ckeditor.com/cke4/addon/kama) skin. Thanks to [Christian Elmer](https://github.com/keinkurt)!
* [#1470](https://github.com/ckeditor/ckeditor4/issues/1470): Fixed: [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) is not visible after drag and drop of a widget it is attached to.
* [#1048](https://github.com/ckeditor/ckeditor4/issues/1048): Fixed: [Balloon Panel](https://ckeditor.com/cke4/addon/balloonpanel) is not positioned properly when a margin is added to its non-static parent.
* [#889](https://github.com/ckeditor/ckeditor4/issues/889): Fixed: Unclear error message for width and height fields in the [Image](https://ckeditor.com/cke4/addon/image) and [Enhanced Image](https://ckeditor.com/cke4/addon/image2) plugins.
* [#859](https://github.com/ckeditor/ckeditor4/issues/859): Fixed: Cannot edit a link after a double-click on the text in the link.
* [#1013](https://github.com/ckeditor/ckeditor4/issues/1013): Fixed: [Paste from Word](https://ckeditor.com/cke4/addon/pastefromword) does not work correctly with the [`config.forcePasteAsPlainText`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#cfg-forcePasteAsPlainText) option.
* [#1356](https://github.com/ckeditor/ckeditor4/issues/1356): Fixed: [Border parse function](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_tools_style_parse.html#method-border) does not allow spaces in the color value.
* [#1010](https://github.com/ckeditor/ckeditor4/issues/1010): Fixed: The CSS `border` shorthand property was incorrectly expanded ignoring the `border-color` style.
* [#1535](https://github.com/ckeditor/ckeditor4/issues/1535): Fixed: [Widget](https://ckeditor.com/cke4/addon/widget) mouseover border contrast is insufficient.
* [#1516](https://github.com/ckeditor/ckeditor4/issues/1516): Fixed: Fake selection allows removing content in read-only mode using the <kbd>Backspace</kbd> and <kbd>Delete</kbd> keys.
* [#1570](https://github.com/ckeditor/ckeditor4/issues/1570): Fixed: Fake selection allows cutting content in read-only mode using the <kbd>Ctrl</kbd>/<kbd>Cmd</kbd> + <kbd>X</kbd> keys.
* [#1363](https://github.com/ckeditor/ckeditor4/issues/1363): Fixed: Paste notification is unclear and it might confuse users.


API Changes:

* [#1346](https://github.com/ckeditor/ckeditor4/issues/1346): [Balloon Toolbar](https://ckeditor.com/cke4/addon/balloontoolbar) [context manager API](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR.plugins.balloontoolbar.contextManager.html) is now available in the [`pluginDefinition.init()`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_pluginDefinition.html#method-init) method of the [requiring](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_pluginDefinition.html#property-requires) plugin.
* [#1530](https://github.com/ckeditor/ckeditor4/issues/1530): Added the possibility to use custom icons for [buttons](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_ui_button.html.html).

Other Changes:

* Updated [SCAYT](https://ckeditor.com/cke4/addon/scayt) (Spell Check As You Type) and [WebSpellChecker](https://ckeditor.com/cke4/addon/wsc) (WSC) plugins:
	* SCAYT [`scayt_minWordLength`](https://ckeditor.com/docs/ckeditor4/latest/api/CKEDITOR_config.html#scayt_minWordLength) configuration option now defaults to 3 instead of 4.
	* SCAYT default number of suggested words in the context menu changed to 3.
	* [#90](https://github.com/WebSpellChecker/ckeditor-plugin-scayt/issues/90): Fixed: S