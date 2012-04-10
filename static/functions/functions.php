<?php
function list_posts($dir){
	$files = array();
	if ($handle = opendir($dir)) {
	    while (false !== ($entry = readdir($handle))) {
	        if (preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d\.md$/', $entry)) {
				$i++;
				$files[$i] = $entry;
	        }
	    }
	    closedir($handle);
	}
	else return 0;
	return array_reverse($files);
}

function post_details($filename){
	$post = array();
	
	preg_match('/((\d\d\d\d)-(\d\d)-(\d\d)_(\d\d)-(\d\d))\.md$/', $filename, $matches);
	
	$post['id'] = $matches[1];
	
	$post['date'] = array();
	$post['date']['year'] = $matches[2];
	$post['date']['month'] = $matches[3];
	$post['date']['day'] = $matches[4];
	$post['date']['hour'] = $matches[5];
	$post['date']['minute'] = $matches[6];
	
	$content = file($filename);
	$post['title'] = trim($content[0], "\n");
	
	$trimmedcontent = array_slice($content, 1);
	foreach($trimmedcontent as $line)
		$post['content'] .= $line;

	return $post;
}

function to_html($markdown){
	$html = Markdown($markdown);
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
	return $results;
}

function to_url($string){
	$string = strtolower($string);
	$string = preg_replace('/\s+/','-', $string);
	$string = preg_replace('/[^A-Za-z0-9\-]+/','', $string);
	return $string;
}
?>
