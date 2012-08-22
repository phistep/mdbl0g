# mdbl0g Plugins
You can get plugins from the [mdbl0g Plugin GitHub repo](https://github.com/Ps0ke/mdbl0g-plugins)!

# The mdbl0g Plugin API

## General
The plugin system lets you inject `PHP`, `HTML`, `JS` and `CSS` code into the running system. The points of injection are predefined and are called `hook points`. At hook points all code in the `plugins/` directory, that assigns itself to hook in that point, will be loaded. When multiple plugins hook the same point, they get loaded alphabetically. All variables that are available to native code at that point are also available for the loaded plugin code. Plugins are 'installed' by dropping a folder containing the plugin code into the `plugins/` directory. The folder does not matter, but it is recommended that it fits the plugin name and does not contain spaces or special characters.

## Hook points
The hook points are grouped in two sections: `html` and `php` and the the name of the hook point is prefixed with ether of those for better orientation. But don't be confused: PHP code execution is available in both scopes. The difference is, that the `php` hook points are built in the core code of mdbl0g where as the `html` ones are built into the theme, which may not be the default one. Themers are strongly encouraged to include the hook points into the themes because otherwise, the plugins depending on `html` hooking will obviously not work.

## Creating a plugin
Creating a plugin is easy: Create a folder and put your code files in it. Each one named with the hook point it aims to hook and `.php` as suffix.

### Best Practices
To make it as easy as possible to develop the plugins you need, here are some good practices and hook points to use for common tasks:

* **Replacing some text/adding additional markup to markdown:** You should use the `php_functions-to_html-html` or the `php_functions-to_html-md` plugin hook and replace the content inside the `$html` or `$markdown` variables using something like `preg_replace()`. Examples are in the `YouTube` and `Vimeo` plugins.
* **Using a javascript library:** When your plugin needs a javascript lib like `jQuery` you should source that lib out as an separate plugin. Then use the  `html_head-top` hook to load that lib. As you can imagine, other plugins might use that library too and if it is loaded twice, that will cause problems. Also: you cannot directly tell, which plugin is loaded first if there are multiple plugins hooking the same hook point. So what if your js code is loaded before the lib is? You don't want that, so use `html_head` for plugin code (or custom css, etc.) and `html_head-top` for libraries. The library plugin `jQuery` and the client plugin `socialSharePrivacy` nad `FancyBox` are examples for that.
* **Adding an external service and the user has to give his username or set other settings:** You should use the `php_include` to define a global constant. Then check for that constant in `html_admin`: If it's not set, display a form for the user to fill out the information, else display some helpful tips or links. That form will send a `GET` or `POST` request to `php_admin-request-get` (or `-post`) where you can overwrite the `php_include` file. Use the `BASE_PATH` constant to write `BASE_PATH."plugins/PLUGIN/php_include.php"`. You should read the section about security when dealing with `php_admin*` hooks! Examples for this type of plugins are the `Twitter-sidebar`, `disqus` and `Piwik-analytics` plugins.
* **Extending the file format:** When you want to do that, you have to hook *a lot* of hook points. That's because there are a couple of spots where the file format is read, parsed or written. First, there is the `html_admin-new-edit-after-textarea`. This is the place where you want to add custom form fields like "tags" or "categories" or "draft" or whatever for the user to input. Then this form field has to be parsed and written correctly. Use the `php_admin-before-write-post` to hook in just before the file gets written. You can then reassign the `$filecontent` variable to fit your needs (`$_POST[]` is available). Now you have to modify the read process, so that you don't mess up the post contents. `php_functions-post_details` is your best friend here, letting you reassign values to the `$post[]` array before it is returned. You may have to re-implement the assignment of the other array elements if you want to tear things out of the `$post['content']`. Then add your data as an array element of `$post[]`. Next you have to display the information, so hook any `html_post*` hook point and deliver your `html`. You might also import a style sheet or some javascript, use `html_head` for that. Also consider displaying the information in the RSS-feed, if there is a standard-conform field that fits your case. The `tags` plugin is a good example of how to use all these hooks to extend the file format.
* **Replacing massive parts of the core code:** I have not yet tested it, but my assumption is, by hooking and overwriting all the `php_functions*` and `php_admin*` parts it should be able to replace all the file interaction with a database back end for example. I can't guarantee it, but the API is quite powerful and it should be possible to mod virtually any behavior in this software. When trying to do so, please consider to implement the API hook points you take apart to keep compatibility with other plugins.

There are a lot of scenarios I miss out here, but this should give you a good start. Always look at the list below to get an impression of all the hook points available and find the one that fits your use case best. And also: always take a look at the actual source code of *mdbl0g* around that hook point you want to hook, so you can see which variables are available for modification and what names are taken that you don't want to overwrite. Always try to use system functions such as `to_url()` or `post_details()` so that 1st you get the best out of future updates, 2nd you give other plugin developers the possibility to add their own data to the output of that functions. Be sure to test your plugins at edge cases like utf-8 input or hooking the same hook point as another plugin.

### Security when using a `php_admin*` hook
Since the `plugins/*/` directory has to be readable by public for many plugins to work correctly, your plugins using admin features could be called publicly, if the URL is known (and if the plugin is openly available it will not be too hard to figure that out). To prevent unwanted access to admin plugins you have to check wether the code is called from inside the `admin/index.php` or not. This can be easily achieved by wrapping all the functionality in a conditional statement like this one:
```php
<?php
    if(preg_match("/admin/", getcwd())){
        // admin code here
    }
?>
```

### Publishing the plugin
I would like it to keep all plugins in the [mdbl0g Plugin Directory](https://github.com/Ps0ke/mdbl0g-plugins) at GitHub. You can fork that repo, submit your plugin and file a pull-request. That also gives me the ability to look over the code harshly and see if there are any severe problems I can spot :)

## List of available hook points
* `php_main-after-type-selection` - Hooks into `index.php` after the conditionals which select the `$type` of the query and the `$files` that get rendered. This is the place to go if you want to mod these.
* `php_main-before-include-header` - Hooks into `index.php` after the `$data` has been set and before the `static/templates/header.php` is included.
* `php_main-post-before-include` - Hooks into the `index.php` before the `static/templates/post.php` gets included, so it enables you to modify the `$data[]` of the post before it gets rendered.
* `php_main-bottom-dev_mode` - Hooks the `if(DEV_MODE){}` conditional at the end of `index.php` so you can display debug information. Consider wrapping it up in html comments (`<!-- foobar -->`).
* `php_main-post-before-set-data` - Hooks into the `index.php` before the `$data[]` array is filled, markdown text is rendered, etc.
* `php_functions-to_html-md` - Hooks into the `core/functions/functions.php to_html()` function, before the conversion, `$markdown` is available for modification.
* `php_functions-list_posts` - Hooks into the `core/functions/functions.php list_posts()` function, before any code execution. This enables you to write a custom function and return the array, before any of the original code is executed.
* `php_functions-to_html-html` - Hooks into the `core/functions/functions.php to_html()` function, after the conversion, `$html` is available for modification.
* `php_functions-post_details` - Hooks in at the end of the `core/functions/functions.php post_details()` function and lets you modify the $post[] data. It is suitable to modify the file format and add extensions to it.
* `php_functions-search_posts` - Hooks into the `core/functions/functions.php search_posts()` function after the search code has been executed. `$dir` and `$query` have not been altered though and you can use them again to implement your own search implementation or alter the normal `$results` array.
* `php_functions-to_to_url` - Hooks into the `core/functions/functions.php to_url()` function, lets you implement an advanced "string-to-ascii"-function.
* `php_functions-alert` - Hooks into the `core/functions/functions.php alert()` function, before any other code execution. Use this carefully, it's a substantial mechanism for the admin user experience.
* `php_indclude-top` - Hooks into the `core/include.php` on the top, so you can overwrite *any* constants! Please leave `POWERED_BY`, `POWERED_BY_LINK` and `GET_PLUGINS_LINK` unchanged. Be vary careful what you change, it could ruin the user experience!
* `php_rss-channel.php` - Hooks into the `<channel>` element of the RSS feed and lets you modify the meta data of the feed. The list of files -- `$files` -- is also visible and can be modified.
* `php_rss-item-before-output` - Hooks into the `foreach` loop of every `<item>` and lets you manipulate the available variables.
* `php_rss-item-output.php` - Hooks into the output part of each `<item>` to display more meta data. Please stay standards-compliant.
* `php_admin-request-get` - Hooks into the `admin/index.php` in the `if('GET' == $_SERVER['REQUEST_METHOD'])` before all other `if`s. When using `php_admin*` hooks please read the section about security!
* `php_admin-request-get` - Hooks into the `admin/index.php` in the `if('POST' == $_SERVER['REQUEST_METHOD'])` before all other `if`s. When using `php_admin*` hooks please read the section about security!
* `php_admin-before-write-post` - Hooks into the `admin.index.php` and lets you modify the `$filecontent` directly before it gets written. `$_POST[]` is available. You can use this to to modify the file format and add extensions to it. Do checks for form fields to be non-empty if they are required (not recommended!) and throw suitable `alert();`s with predefined strings (so they are localized) like `$STR["alert_new_error_fields"]`. When using `php_admin*` hooks please read the section about security!


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
