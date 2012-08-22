<?php
function list_posts($dir){
	
	foreach(glob(BASE_PATH."plugins/*/php_functions-list_posts.php") as $pluginfilename){include $pluginfilename;}
	
	$files = array();
	if ($handle = opendir($dir)) {
	    while (false !== ($entry = readdir($handle))) {
	        if (preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d\.md$/', $entry))
				$files[] = $entry;
	    }
	    closedir($handle);
	}
	else return 0;
	sort($files);
	return array_reverse($files);
}

function post_details($filename){
	if(!file_exists($filename))
		return false;
		
	$post = array();
	
	preg_match('/((\d\d\d\d)-(\d\d)-(\d\d)_(\d\d)-(\d\d))\.md$/', $filename, $matches);
	
	$post['id'] = $matches[1];

	$post['timestamp'] = mktime($matches[5], $matches[6], 0, $matches[3], $matches[4], $matches[2]);
	
	$content = file($filename);
	$post['title'] = trim($content[0], "\n");
	
	$post['prettyid'] = date('Y/m/d/H/i/', $post['timestamp']).to_url($post['title']);
	
	$trimmedcontent = array_slice($content, 1);
	$post['content'] = '';
	foreach($trimmedcontent as $line)
		$post['content'] .= $line;

	foreach(glob(BASE_PATH."plugins/*/php_functions-post_details.php") as $filename){include $filename;}

	return $post;
}

function to_html($markdown){
	foreach(glob(BASE_PATH."plugins/*/php_functions-to_html-md.php") as $filename){include $filename;}
	
	$html = Markdown($markdown);
	
	foreach(glob(BASE_PATH."plugins/*/php_functions-to_html-html.php") as $filename){include $filename;}

	return $html;
}

function search_posts($dir, $query){
	$i = -1;
	$results = array();
	$files = list_posts($dir);

	// escape special characters in the query
	$pattern = preg_quote($query, '/');
	$pattern = "/^.*$pattern.*\$/m";

	foreach($files as $filename){
		$md = file_get_contents("posts/".$filename);

		if(preg_match($pattern, $md)){
			$i++;
			$results[$i] = $filename;
		}
	}
	
	foreach(glob(BASE_PATH."plugins/*/php_functions-search_posts.php") as $pluginfilename){include $pluginfilename;}
	
	return $results;
}

function to_url($string){
	
	foreach(glob(BASE_PATH."plugins/*/php_functions-to_url.php") as $filename){include $filename;}
	
	$string = strtolower($string);
	$string = preg_replace('/\s+/','-', $string);
	$string = preg_replace('/[^A-Za-z0-9\-]+/','', $string);
	return $string;
}

function alert($alert_message, $alert_type, $alert_return_url = BASE_URL, $alert_delay = DEFAULT_ALERT_DELAY){
	foreach(glob(BASE_PATH."plugins/*/php_functions-alert.php") as $filename){include $filename;}
	include(BASE_PATH.'/static/templates/alert.php');
	exit();
}
?>
