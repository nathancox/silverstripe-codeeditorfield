SilverStripe CodeEditorField
===================================

This module adds a CodeEditorField that uses Ace Editor (http://ace.c9.io/) to let you edit code (mostly HTML or JavaScript). [Try it out here](https://ace.c9.io/build/kitchen-sink.html). It comes in two forms:

* A regular CodeEditorField that can be used on an HTMLText field similar to HTMLEditorField
* An optional replacement code view for TinyMCE that uses a CodeEditorField


Maintainer Contacts
-------------------
Nathan Cox (<me@nathan.net.nz>)

Requirements
------------
* SilverStripe 4+

Documentation
-------------
[GitHub](https://github.com/nathancox/silverstripe-codeeditorfield/wiki)

Installation Instructions
-------------------------

1. Place the files in a directory called codeeditorfield in the root of your SilverStripe installation. You can most easily do this with `composer require nathancox/codeeditorfield`
2. Configure your site's `config.yml` to define your defaults (optional).
3. Visit yoursite.com/dev/build to rebuild the database

Usage Overview
--------------

Configuration via `config.yml`:

```yaml

---
Name: codeeditorfield
---

CodeEditorField:
    # These are the pre-defined defaults for dark/light themes
    default_dark_theme: 'monokai'
    default_light_theme: 'github'

    # This will overwrite the above settings
    default_theme: 'tomorrow'

```

Using CodeEditorField in getCMSFields:

```php

$fields->addFieldToTab('Root.Content', $codeField = new CodeEditorField('Configuration', 'Configuration'));
// set the field to use the full width of the CMS (optional, not included in screenshot)
$codeField->addExtraClass('stacked');

// set the height of the field (defaults to 8)
$codeField->setRows(30);

// set the syntax mode to yaml (defaults to html)
$codeField->setMode('yaml');

// optional - set theme (see codeeditorfield/thirdparty/ace/src-noconflict/theme-xxx.js files for available themes)
$codeField->setTheme('twilight');

// optional - enabled wordwrap by default
$codeField->setWrap(true);
```

produces the following:

![example codeeditorfield](./screenshot.png)

__Note: If you opt not to set `default_theme` and don't set the theme specifically on the field, you will have the option to toggle between Dark and Light.__


To replace the code editor in TinyMCE:

```php

// copy this into your project's getCMSFields

HtmlEditorConfig::get('cms')->enablePlugins(array(
    'aceeditor' => sprintf('../../../codeeditorfield/javascript/tinymce/editor_plugin_src.js')
));
HtmlEditorConfig::get('cms')->insertButtonsBefore('fullscreen', 'aceeditor');
HtmlEditorConfig::get('cms')->removeButtons('code');

```



Known Issues
------------
[Issue Tracker](https://github.com/nathancox/silverstripe-codeeditorfield/issues)
