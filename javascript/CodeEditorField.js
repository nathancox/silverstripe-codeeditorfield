(function($) {

$.entwine('ss', function($) {
$('textarea.codeeditor').entwine({
	Editor: false,

	onmatch: function() {
		var textarea = this;

		// hide the textarea
		this.hide();

		// create the editor div
		var divID = this.attr('id') + '_Ace';
		var $div = this.getEditorEl();
		
		$div.insertAfter(this);


		ace.config.set('modePath', this.data('ace-path'));
		ace.config.set('workerPath', this.data('ace-path'));
		ace.config.set('themePath', this.data('ace-path'));

		// apply the editor to the div
		var editor = ace.edit(divID);

		// make the editor update the textarea content
		editor.getSession().setValue(textarea.val());
		editor.getSession().on('change', function(){
		  textarea.val(editor.getSession().getValue());
		});

		editor.setAutoScrollEditorIntoView(false);
		editor.getSession().setTabSize(2);
		editor.setShowPrintMargin(false);
		editor.session.setWrapLimitRange(null, null);

		// set the mode (ie syntax highlighting)
	//	ace.require("ace/mode/"+this.data('mode'));
		
    	editor.getSession().setMode("ace/mode/"+this.data('mode'));
		editor.setTheme('ace/theme/' + this.data('theme'));

		var lineHeight = (editor.renderer.lineHeight > 1 ? editor.renderer.lineHeight : 16)
		
		$div.css('min-height', lineHeight * textarea.attr('rows') + 35 + 'px');


		this.setEditor(editor);
		this.addClass('done');
	},

	getEditorEl: function() {
		return $('#' + this.attr('id') + '_Ace');
	},


	getWordWrapEl: function() {
		return $('#' + this.attr('id') + '_Ace_word_wrap');
	}

});

$('.codeeditor .ss-ui-button').entwine({
	onmatch: function() {
	//	this.button();
	},
	onmouseup: function() {
		this.blur();
	},
	getEditor: function() {
		return $(this.closest('.middleColumn').find('textarea').first()).getEditor();
	}
});


$('.codeeditor .ace-word-wrap-button').entwine({
	onclick: function() {
		var editor = this.getEditor();
		if (editor.session.getUseWrapMode()) {
			editor.session.setUseWrapMode(false);
			this.removeClass('active');
		} else {
			editor.session.setUseWrapMode(true);
			this.addClass('active');
		}
		return false;
	}
});
});

	
	
})(jQuery);
