<?php

namespace NathanCox\CodeEditorField;

use SilverStripe\Forms\TextareaField;
use SilverStripe\View\Requirements;


class CodeEditorField extends TextareaField {

	private static $allowed_actions = array (
		'iframe'
	);

	/**
	 * @var string default_mode
	 */
	private static $default_mode = 'html';

	/**
	 * @var string default_theme
	 */
	private static $default_theme = null;

	/**
	 * @var string default_dark_theme
	 */
	private static $default_dark_theme = 'monokai';

	/**
	 * @var string default_light_theme
	 */
	private static $default_light_theme = 'github';

	/**
	 * @var string mode
	 */
	protected $mode;

	/**
	 * @var string dark_theme
	 */
	protected $dark_theme;

	/**
	 * @var string light_theme
	 */
	protected $light_theme;

	/**
	 * @var string theme
	 */
	protected $theme;

	/**
	 * @var int Visible number of text lines.
	 */
	protected $rows = 8;

	public function getAttributes() {
		return array_merge(
			parent::getAttributes(),
			array(
				'data-mode' => $this->getMode(),
				'data-ace-path' => $this->getAcePath(),
				'data-theme' => $this->getTheme(),
				'data-dark' => $this->getDarkTheme(),
				'data-light' => $this->getLightTheme()
			)
		);
	}

	function Field($properties = array()) {

		$acePath = $this->getAcePath();

		Requirements::javascript($acePath . "ace.js");
		Requirements::javascript($acePath . "mode-" . $this->getMode() . ".js");
		Requirements::javascript("codeeditorfield/client/javascript/CodeEditorField.js");
		Requirements::css("codeeditorfield/client/css/CodeEditorField.css");

		return parent::Field($properties);
	}

	function setMode($mode) {
		$this->mode = $mode;
		return $this;
	}

	function getMode() {
		return $this->mode ? $this->mode : $this->config()->get('default_mode');
	}

	function setTheme($theme) {
		$this->theme = $theme;
		return $this;
	}

	function getTheme() {
		if ($this->getDefaultTheme()){
			return $this->theme ? $this->theme : $this->config()->get('default_theme');
		} else {
			return $this->theme ? $this->theme : $this->config()->get('default_dark_theme');
		}
	}

	function getDefaultTheme() {
		return $this->config()->get('default_theme');
	}

	function getDarkTheme() {
		return $this->dark_theme ? $this->dark_theme : $this->config()->get('default_dark_theme');
	}

	function getLightTheme() {
		return $this->light_theme ? $this->light_theme : $this->config()->get('default_light_theme');
	}

	function getAcePath() {
		return '_resources/' . basename(dirname(__DIR__)) . '/thirdparty/ace/src-min-noconflict/';
	}


}

