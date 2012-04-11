<!DOCTYPE html><html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"></head><body>
<?php
if(!defined(BASE_PATH)) define('BASE_PATH', './');
include('static/include.php');

if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['p'])){
	$type = "post";
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

$entryCount = count($files);
$maxPages = ceil($entryCount / POSTS_PER_PAGE);

if($_GET['s'] > 0 && $_GET['s'] <= $maxPages)
	$page = $_GET['s'];
else
	$page = 1;
	
$files = array_slice($files, (($page - 1) * POSTS_PER_PAGE), POSTS_PER_PAGE);

echo "<a href=\"".(PRETTY_URLS ? BASE_URL."/rss/" : BASE_URL."rss.php")."\">RSS</a><br>\nPage: ".$page."/".$maxPages."<br>\nNumber of entries: ".$entryCount."<br>\n<a href=\"".BASE_URL."admin/".(PRETTY_URLS ? "new/" : "?new")."\">new</a><br>\n\n";

foreach($files as $filename){
	$post = post_details("posts/".$filename);
	$html = to_html($post['content']);
	
	$postlink = PRETTY_URLS
		? BASE_URL.$post['date']['year']."/".$post['date']['month']."/".$post['date']['day']."/".$post['date']['hour']."/".$post['date']['minute']."/".to_url($post['title'])
		: BASE_URL."?p=".$post['id'];
	
	$editlink = PRETTY_URLS
		? BASE_URL."admin/edit/".$post['date']['year']."/".$post['date']['month']."/".$post['date']['day']."/".$post['date']['hour']."/".$post['date']['minute']."/".to_url($post['title'])
		: BASE_URL."admin/?edit=".$post['id'];
	
	$deletelink = PRETTY_URLS
		? BASE_URL."admin/delete/".$post['date']['year']."/".$post['date']['month']."/".$post['date']['day']."/".$post['date']['hour']."/".$post['date']['minute']."/".to_url($post['title'])
		: BASE_URL."admin/?delete=".$post['id'];

	echo "\n<h1><a href=\"".$postlink."\">".htmlspecialchars($post['title'])."</a></h1>\n";
	echo "Posted: <span>".$post['date']['day'].".".$post['date']['month'].".".$post['date']['year']." ".$post['date']['hour'].":".$post['date']['minute']."</span>\n";
	echo "<a href=\"".$editlink."\">edit</a> / <a href=\"".$deletelink."\">delete</a>\n\n";
	echo $html."\n";
}
?>
</body></html>
