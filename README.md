SilverStripe CodeEditorField
===================================

This module adds a CodeEditorField that uses Ace Editor (http://ace.c9.io/) to let you edit code (mostly HTML or JavaScript).  I comes in two forms:

# a regular CodeEditorField that can be used on an HTMLText field similar to HTMLEditorField
# An optional replacement code view for TinyMCE that uses a CodeEditorField


Maintainer Contacts
-------------------
Nathan Cox (<me@nathan.net.nz>)

Requirements
------------
* SilverStripe 3.1+

Documentation
-------------
[GitHub](https://github.com/nathancox/silverstripe-codeeditorfield/wiki)

Installation Instructions
-------------------------

1. Place the files in a directory called codeeditorfield in the root of your SilverStripe installation
2. Visit yoursite.com/dev/build to rebuild the database

Usage Overview
--------------

Using CodeEditorField in getCMSFields:

```php
	
	$fields->addFieldToTab('Root.Content', $codeField = new CodeEditorField('ExtraTags', 'Extra tags'));
	$codeField->addExtraClass('stacked');
	
	// set the height of the field (defaults to 8)
	$codeField->setRows(15);
	
	// set the syntax mode to javascript (defaults to html)
	$codeField->setMode('javascript');

```

![example codeeditorfield](http://static.flyingmonkey.co.nz/github/silverstripe-codeeditorfield/codeeditorfield-1.png)




Replace the code editor in TinyMCE:

```php

// copy this into your project's getCMSFields (you can find this code in codeeditorfield/_config.php)

	HtmlEditorConfig::get('cms')->enablePlugins(array(
		'aceeditor' => sprintf('../../../codeeditorfield/javascript/tinymce/editor_plugin_src.js')
	));
	HtmlEditorConfig::get('cms')->insertButtonsBefore('fullscreen', 'aceeditor');
	HtmlEditorConfig::get('cms')->removeButtons('code');


```



Known Issues
------------
[Issue Tracker](https://github.com/nathancox/silverstripe-codeeditorfield/issues)
