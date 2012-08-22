<?php 
$TimeStart = microtime(true);
$TimeFirst = number_format(microtime(true)-$TimeStart, 5, '.', '');
function SpeedTest(){
   global $TimeStart,$TimeFirst;
   $TimeTemp = $TimeFirst;
   $TimeFirst = number_format(microtime(true)-$TimeStart, 5, '.', '');
   return number_format(($TimeFirst)-($TimeTemp), 5, '.', '');
}
SpeedTest();


if(!defined('BASE_PATH')) define('BASE_PATH', './');
@include(BASE_PATH.'core/include.php'); // @: If no include.php is found (not installed yet), no error will be printed and the headers can be set.
if(!defined(DEV_MODE))
	define("DEV_MODE", false);
if(!DEV_MODE){
	// Redirects users to the installer if the installation has not been completed
	if(file_exists("install") && ( !file_exists("core/include.php") || !file_exists(".htaccess") || !file_exists("./admin/.htaccess") || !file_exists("./admin/.htpasswd"))){
		header('location:install/index.php?step=0');
		exit();
	}
	else if(file_exists("install") && file_exists("core/include.php") && file_exists(".htaccess") && file_exists("./admin/.htaccess") && file_exists("./admin/.htpasswd")){
		header('location:install/index.php?step=4');
		exit();
	}
}

if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['p'])){
	$type = "post";
	if(file_exists(BASE_PATH."posts/".$_GET['p'].".md"))
		$files[0] = $_GET['p'].".md";
}
else if($_GET['q']){
	$type = "search";
	$files = search_posts('posts', $_GET['q']);
}
else{
	$type = "page";
	$files = list_posts('posts');
}

foreach(glob(BASE_PATH."plugins/*/php_main-after-type-selection.php") as $pluginfilename){include $pluginfilename;}

$entryCount = count($files);
$maxPages = ceil($entryCount / POSTS_PER_PAGE);
$page = 1;
if(isset($_GET['s']))
	if($_GET['s'] > 0 && $_GET['s'] <= $maxPages)
		$page = $_GET['s'];
	
	
if(is_array($files)) $files = array_slice($files, (($page - 1) * POSTS_PER_PAGE), POSTS_PER_PAGE);

$data = array();
$data['rssLink'] = BASE_URL."rss".(PRETTY_URLS ? "/" : ".php");
$data['currentPage'] = $page;

if($page < $maxPages){
	if($type == 'search'){
		$data['nextPageLink'] = BASE_URL.(PRETTY_URLS ? "search/".($page+1)."/".$_GET['q'] : "?s=".($page+1)."&q=".$_GET['q'] );
	}
	else{
		$data['nextPageLink'] = BASE_URL.(PRETTY_URLS ? "page/".($page+1) : "?s=".($page+1) );
	}
}
else
	$data['nextPageLink'] = false;
	
if($page > 1){
	if($type == 'search'){
		$data['previousPageLink'] = BASE_URL.(PRETTY_URLS ? "search/".($page-1)."/".$_GET['q'] : "?s=".($page-1)."&q=".$_GET['q'] );
	}
	else{
		$data['previousPageLink'] = BASE_URL.(PRETTY_URLS ? "page/".($page-1) : "?s=".($page-1) );
	}
}
else
	$data['previousPageLink'] = false;

$data['maxPages'] = $maxPages;
$data['type'] = $type;
$data['entryCount'] = $entryCount;
$data['newPostLink'] = BASE_URL."admin/".(PRETTY_URLS ? "new/" : "?new");

foreach(glob(BASE_PATH."plugins/*/php_main-before-include-header.php") as $pluginfilename){include $pluginfilename;}

include(BASE_PATH.'static/templates/header.php');

if($files)
	foreach($files as $filename){
		if($post = post_details(BASE_PATH."posts/".$filename)){
			foreach(glob(BASE_PATH."plugins/*/php_main-post-before-set-data.php") as $pluginfilename){include $pluginfilename;}
			
			$data['contentHtml'] = to_html($post['content']);
			$data['postTitle'] = htmlspecialchars($post['title']);
			$data['postLink'] = BASE_URL.(PRETTY_URLS ? $post['prettyid'] : "?p=".$post['id']);
			$data['editLink'] = BASE_URL."admin/".(PRETTY_URLS ? "edit/".$post['prettyid'] : "?edit=".$post['id']);
			$data['deleteLink'] = BASE_URL."admin/".(PRETTY_URLS ? "delete/".$post['prettyid'] : "?delete=".$post['id']);
			$data['time'] = date(DATE_FORMAT, $post['timestamp']);
			
			foreach(glob(BASE_PATH."plugins/*/php_main-post-before-include.php") as $pluginfilename){include $pluginfilename;}
			
			include(BASE_PATH.'static/templates/post.php');
		}
	}
else
	include(BASE_PATH.'static/templates/no-results.php');

include(BASE_PATH.'static/templates/footer.php');

if(DEV_MODE){
	echo "<!-- Execution Time: ".SpeedTest()."s -->";
	foreach(glob(BASE_PATH."plugins/*/php_main-bottom-dev_mode.php") as $pluginfilename){include $pluginfilename;}
}
?>
