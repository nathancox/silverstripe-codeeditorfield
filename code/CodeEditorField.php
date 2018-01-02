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
     * @var string wrap
     */
    protected $wrap;

    /**
     * @var int Visible number of text lines.
     */
    protected $rows = 12;

    public function getAttributes()
    {
        return array_merge(
            parent::getAttributes(),
            array(
                'data-mode' => $this->getMode(),
                'data-ace-path' => '/resources/nathancox/codeeditorfield/thirdparty/ace/src-min-noconflict',
                'data-theme' => $this->getTheme(),
                'data-dark' => $this->getDarkTheme(),
                'data-light' => $this->getLightTheme(),
                'data-wrap' => $this->getWrap() ? '1' : ' 0',
            )
        );
    }

    public function Field($properties = array())
    {
        Requirements::javascript(
            'nathancox/codeeditorfield: /thirdparty/ace/src-min-noconflict/ace.js'
        );
        Requirements::javascript(
            'nathancox/codeeditorfield: /thirdparty/ace/src-min-noconflict/mode-' . $this->getMode() . '.js'
        );
        Requirements::javascript('nathancox/codeeditorfield: /client/javascript/CodeEditorField.js');
        Requirements::css('nathancox/codeeditorfield: /client/css/CodeEditorField.css');

        return parent::Field($properties);
    }

    public function setMode($mode)
    {
        $this->mode = $mode;
        return $this;
    }

    public function getMode()
    {
        return $this->mode ? $this->mode : $this->config()->get('default_mode');
    }

    public function setWrap($wrap)
    {
        $this->wrap = $wrap;
        return $this;
    }

    public function getWrap()
    {
        return $this->wrap;
    }

    public function setTheme($theme)
    {
        $this->theme = $theme;
        return $this;
    }

    public function getTheme()
    {
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

    /**
     * Returns a readonly version of this field
     */
    public function performReadonlyTransformation()
    {
        $field = new CodeEditorField($this->name, $this->title, $this->value);
        $field->setReadonly(true);
        return $field;
    }
}
