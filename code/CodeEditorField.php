<?php

class CodeEditorField extends TextareaField {

	public static $allowed_actions = array (
		'iframe'
	);

	static $default_mode = 'html';
	
	var $mode = false;

	/**
	 * @var int Visible number of text lines.
	 */
	protected $rows = 8;


	public function getAttributes() {
		return array_merge(
			parent::getAttributes(),
			array(
				'data-mode' => $this->getMode(),
				'data-ace-path' => $this->getAcePath()
			)
		);
	}


	function Field($properties = array()) {

		$acePath = $this->getAcePath();

		Requirements::javascript($acePath . "ace.js");
		Requirements::javascript($acePath . "mode-" . $this->getMode() . ".js");
	//	Requirements::javascript($acePath . "worker-" . $this->getMode() . ".js");



		Requirements::javascript("codeeditorfield/javascript/CodeEditorField.js");
		Requirements::css("codeeditorfield/css/CodeEditorField.css");
		
		return parent::Field($properties);
	}



	
	function setMode($mode) {
		$this->mode = $mode;
	}
	
	function getMode() {
		if ($this->mode) {
			return $this->mode;
		} else {
			return self::$default_mode;
		}
	}



	function getAcePath() {
		return basename(dirname(__DIR__)) . '/thirdparty/ace/src-noconflict/';
	}




}