<?php

namespace NathanCox\CodeEditorField;

use SilverStripe\Forms;
use SilverStripe\View\Requirements;

class CodeEditorField extends Forms\TextareaField {

    /**
     * @config
     * @var string default_mode
     */
    private static $default_mode = 'html';

    /**
     * @config
     * @var string default_theme
     */
    private static $default_theme = null;

    /**
     * @config
     * @var string default_dark_theme
     */
    private static $default_dark_theme = 'monokai';

    /**
     * @config
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
     * @config
     * @var int Visible number of text lines.
     */
    protected $rows = 12;


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

    public function Field($properties = array()) {
        $acePath = $this->getAcePath();

        Requirements::javascript($acePath . "ace.js");
        Requirements::javascript($acePath . "mode-" . $this->getMode() . ".js");
        Requirements::javascript(basename(dirname(__DIR__)) . "/client/javascript/CodeEditorField.js");
        Requirements::css(basename(dirname(__DIR__)) . "/client/css/CodeEditorField.css");

        return parent::Field($properties);
    }

    public function setMode($mode) {
        $this->mode = $mode;
        return $this;
    }

    public function getMode() {
        return $this->mode ? $this->mode : $this->config()->get('default_mode');
    }

    public function setTheme($theme) {
        $this->theme = $theme;
        return $this;
    }

    public function getTheme() {
        if ($this->getDefaultTheme()) {
            return $this->theme ? $this->theme : $this->config()->get('default_theme');
        } else {
            return $this->theme ? $this->theme : $this->config()->get('default_dark_theme');
        }
    }

    public function getDefaultTheme() {
        return $this->config()->get('default_theme');
    }

    public function getDarkTheme() {
        return $this->dark_theme ? $this->dark_theme : $this->config()->get('default_dark_theme');
    }

    public function getLightTheme() {
        return $this->light_theme ? $this->light_theme : $this->config()->get('default_light_theme');
    }

    public function getAcePath() {
        return basename(dirname(__DIR__)) . '/thirdparty/ace/src-min-noconflict/';
    }
}


