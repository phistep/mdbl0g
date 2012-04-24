# The mdbl0g Plugin API

## General
The plugin system lets you inject `PHP`, `HTML`, `JS` and `CSS` code into the running system. The points of injection are predefined and are called `hook points`. At hook points all code in the `plugins/` directory, that assigns itself to hook in that point, will be loaded. When multiple plugins hook the same point, they get loaded alphabetically. All variables that are available to native code at that point are also available for the loaded plugin code. Plugins are 'installed' by dropping a folder containing the plugin code into the `plugins/` directory. The folder does not matter, but it is recommended that it fits the plugin name and does not contain spaces or special characters.

## Hook points
The hook points are grouped in two sections: `html` and `php` and the the name of the hook point is prefixed with ether of those for better orientation. But don't be confused: PHP code execution is available in both scopes. The difference is, that the `php` hook points are built in the core code of mdbl0g where as the `html` ones are built into the theme, which may not be the default one. Themers are strongly encouraged to include the hook points into the themes because otherwise, the plugins depending on `html` hooking will obviously not work.

## Creating a plugin
Creating a plugin is easy: Create a folder and put your code files in it. Each one named with the hook point it aims to hook and `.php` as suffix.

## List of available hook points
* `php_mdconverter-md` - Hooks into the `static/functions/functions.php to_html()` function, before the conversion, `$markdown` is available for modification.
* `php_mdconverter-html` - Hooks into the `static/functions/functions.php to_html()` function, after the conversion, `$html` is available for modification.

* `html_head` - Hooks into the `<head>` element of `static/templates/header.php` after all other tags to load assets and overwrite previously loaded files.