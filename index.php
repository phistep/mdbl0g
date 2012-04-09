<?php
include('static/include.php');

if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['p'])){
	$files[0] = $_GET['p'].".md";
}
else if($_GET['q']){
	$files = search_posts('posts', $_GET['q']);
}
else{
	$files = list_posts('posts');
}

$entryCount = count($files);
$maxPages = ceil($entryCount / POSTS_PER_PAGE);

if($_GET['s'] > 0 && $_GET['s'] <= $maxPages)
	$page = $_GET['s'];
else
	$page = 1;
	
$files = array_slice($files, (($page - 1) * POSTS_PER_PAGE), POSTS_PER_PAGE);

echo "Page: ".$page."/".$maxPages."<br>\nNumber of entries: ".$entryCount."<br>\n\n";

foreach($files as $filename){
	$post = post_details("posts/".$filename);
	$html = to_html($post['content']);
	echo $safetitle = to_url($post['title']);
	$link = PRETTY_URLS ? BASE_URL.$post['date']['year']."/".$post['date']['month']."/".$post['date']['day']."/".$post['date']['hour']."/".$post['date']['minute']."/".$post['title'] : BASE_URL."?p=".$post['id'];
	echo "\n<h1><a href=\"".$link."\">".$post['title']."</a></h1>\n";
	echo "Posted: <span>".$post['date']['day'].".".$post['date']['month'].".".$post['date']['year']." ".$post['date']['hour'].":".$post['date']['minute']."</span>\n\n";
	echo $html."\n";
}
?>
