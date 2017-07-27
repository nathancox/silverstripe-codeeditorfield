<?php

class TinyMCECodeEditor extends LeftAndMain {

	public static $allowed_actions = array (
		'PopupForm'
	);


	function PopupForm() {

		$form = new Form(
			$this,
			"{$this->name}/PopupForm",
			new FieldList(
				$headerWrap = new CompositeField(
					new LiteralField(
						'Heading',
						sprintf('<h3 class="htmleditorfield-mediaform-heading insert">%s</h3>',
							'Edit Source'
						)
					)

				),
				$codeField = new CodeEditorField('TinyMCESource', '')

			),
			new FieldList(
				ResetFormAction::create('cancel', 'Cancel')
					->addExtraClass('ss-ui-action-destructive')
					->setUseButtonTag(true)
				,
				FormAction::create('update', 'Update')
					->addExtraClass('ss-ui-action-constructive')
					->setAttribute('data-icon', 'accept')
					->setUseButtonTag(true)
			)
		);

		$headerWrap->addExtraClass('CompositeField composite cms-content-header nolabel ');
	//	$contentComposite->addExtraClass('tinymce-codeeditor-field content');

		$codeField->addExtraClass('nolabel stacked');

		$form->unsetValidator();
		$form->loadDataFrom($this);
		$form->addExtraClass('htmleditorfield-form htmleditorfield-codeform cms-dialog-content');

	//	$this->extend('updateLinkForm', $form);

		return $form;

	}

}
