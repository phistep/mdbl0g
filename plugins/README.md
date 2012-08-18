# mdbl0g Plugins
You can get plugins from the [mdbl0g Plugin GitHub repo](https://github.com/Ps0ke/mdbl0g-plugins)!

# The mdbl0g Plugin API

## General
The plugin system lets you inject `PHP`, `HTML`, `JS` and `CSS` code into the running system. The points of injection are predefined and are called `hook points`. At hook points all code in the `plugins/` directory, that assigns itself to hook in that point, will be loaded. When multiple plugins hook the same point, they get loaded alphabetically. All variables that are available to native code at that point are also available for the loaded plugin code. Plugins are 'installed' by dropping a folder containing the plugin code into the `plugins/` directory. The folder does not matter, but it is recommended that it fits the plugin name and does not contain spaces or special characters.

## Hook points
The hook points are grouped in two sections: `html` and `php` and the the name of the hook point is prefixed with ether of those for better orientation. But don't be confused: PHP code execution is available in both scopes. The difference is, that the `php` hook points are built in the core code of mdbl0g where as the `html` ones are built into the theme, which may not be the default one. Themers are strongly encouraged to include the hook points into the themes because otherwise, the plugins depending on `html` hooking will obviously not work.

## Creating a plugin
Creating a plugin is easy: Create a folder and put your code files in it. Each one named with the hook point it aims to hook and `.php` as suffix.

### Security when using a `php_admin*` hook
Since the `plugins/*/` directory has to be readable by public for many plugins to work correctly, your plugins using admin features could be called publicly, if the URL is known (and if the plugin is openly available it will not be too hard to figure that out). To prevent unwanted access to admin plugins you have to check wether the code is called from inside the `admin/index.php` or not. This can be easily achieved by wrapping all the functionality in a conditional statement like this one:
```php
<?php
    if(preg_match("/admin/", getcwd())){
        // admin code here
    }
?>
```

## List of available hook points
* `php_main-post-before-include` - Hooks into the `index.php` before the `static/templates/post.php` gets included, so it enables you to modify the `$data[]` of the post before it gets rendered.
* `php_main-post-before-set-data` - Hooks into the `index.php` before the `$data][]` array is filled, markdown text is rendered, etc.
* `php_functions-to_html-md` - Hooks into the `core/functions/functions.php to_html()` function, before the conversion, `$markdown` is available for modification.
* `php_functions-to_html-html` - Hooks into the `core/functions/functions.php to_html()` function, after the conversion, `$html` is available for modification.
* `php_functions-post_details` - Hooks in at the end of the `core/functions/functions.php post_details()` function and lets you modify the $post[] data. It is suitable to modify the file format and add extensions to it.
* `php_rss-channel.php` - Hooks into the `<channel>` element of the RSS feed and lets you modify the meta data of the feed. The list of files -- `$files` -- is also visible and can be modified.
* `php_rss-item-before-output` - Hooks into the `foreach` loop of every `<item>` and lets you manipulate the available variables.
* `php_rss-item-output.php` - Hooks into the output part of each `<item>` to display more meta data. Please stay standards-compliant.
* `php_admin-request-get` - Hooks into the `admin/index.php` in the `if('GET' == $_SERVER['REQUEST_METHOD'])` before all other `if`s. When using `php_admin*` hooks please read the section about security!
* `php_admin-request-get` - Hooks into the `admin/index.php` in the `if('POST' == $_SERVER['REQUEST_METHOD'])` before all other `if`s. When using `php_admin*` hooks please read the section about security!
* `php_admin-before-write-post` - Hooks into the `admin.index.php` and lets you modify the `$filecontent` directly before it gets written. `$_POST[]` is available. You can use this to to modify the file format and add extensions to it. Do checks for form fields to be non-empty if they are required (not recommended!) and throw suitable `alert();`s with predefined strings (so they are localized) like `$STR["alert_new_error_fields"]`.

* `html_head-top` - Hooks into the very top of the `<head>` element in `static/templates/header.php` before all other tags. This enables you to load recourses e.g. frameworks that are taken advantage of by other plugins and thus have to be strictly included _before_ the all other resources.
* `html_head` - Hooks into the `<head>` element in `static/templates/header.php` after all other tags to load assets and overwrite previously loaded files.
* `html_aside` - Hooks in the end of the `<aside>` element. Used to display, widgets etc.
* `html_aside-list` - Hooks into the `<aside>` but in a list element. May not be supported by all themes. The corresponding `<li> </li>` are already wrapped around.
* `html_post-info` - Hooks into the info section of the post, after the publishing date and the admin links. Use it to add custom information
* `html_post-bottom` - Hooks in at the end of the post element in `static/templates/post.php` to add html after the post. Add links or other short information here. For very long content use `html_post-bottom-last` so it won't interfere with other plugins right after the post content.
* `html_post-bottom-last` - Hooks in at the end of the post element in `static/templates/post.php` to add html after the post. In contradiction to`html_post-bottom` it is the very last hook point in the post so its suitable for long content like a comments section.
* `html_footer-bottom` - Hooks in right before `</body>`. It's purpose is to be home to javascript code that need to parse the whole `<body>`.
* `html_admin` - Hooks into the admin interface and lets you present options/links/information etc. to the admin. Headline and style should be provided by the theme, just put html to present the actual user interface here.
* `html_admin-new-edit-after-textarea` - Hooks in the input form of the `static/templates/new-edit.php` and lets you add custom form fields after the `content` field. 
