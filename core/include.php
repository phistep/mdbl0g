<?php
error_reporting(E_ALL ^ E_NOTICE);
date_default_timezone_set("Europe/Berlin");

require_once('functions/markdown.php');
require_once('functions/functions.php');

// Check for language
if(preg_match("/^de.*/", $_SERVER['HTTP_ACCEPT_LANGUAGE']))
	$lang = 'de_DE';
else // fallback
	$lang = 'en_US';
require_once('strings/'.$lang.'.php');


define('POWERED_BY', 'mdbl0g');

define('POSTS_PER_PAGE', 5);
define('PRETTY_URLS', true);
define('DEFAULT_ALERT_DELAY', 3);
define('BASE_URL', 'http://localhost/~ps0ke/mdbl0g/mdbl0g/');

// Like http://php.net/manual/en/function.date.php
define('DATE_FORMAT', 'j.n.Y G:i'); // German
//define('DATE_FORMAT', 'n/j/Y g:i A'); // U.S.

define('BLOG_TITLE', 'mdbl0g Test Blog');
define('BLOG_DESCRIPTION', 'Blog to test the functionality during development.');
?>
