<?php
if(!defined('BASE_PATH')) define('BASE_PATH', '../');
include(BASE_PATH.'core/include.php');

if('GET' == $_SERVER['REQUEST_METHOD']){
	foreach(glob(BASE_PATH."plugins/*/php_admin-request-get.php") as $filename){include $filename;}
	
	if(isset($_GET['new'])){
		$type = 'new';
		require(BASE_PATH.'static/templates/new-edit.php');
	}
	else if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['edit'])){
		$type = 'edit';
		$post = post_details(BASE_PATH."posts/".$_GET['edit'].".md");
		require(BASE_PATH.'/static/templates/new-edit.php');
	}
	else if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['delete'])){
		if(isset($_GET['really'])){
			if(unlink(BASE_PATH."posts/".$_GET['delete'].".md"))
				alert("deleted successfully", "success");
			else{
				$post = post_details(BASE_PATH."posts/".$_GET['delete'].".md");
				alert("error - could not delete", "error", BASE_URL.(PRETTY_URLS ? $post['prettyid'] : "?p=".$post['id']));
			}
		}
		else
			require(BASE_PATH.'static/templates/really.php');
	}
	else{
	    require(BASE_PATH.'static/templates/admin.php');
	}
}
if('POST' == $_SERVER['REQUEST_METHOD']){
	foreach(glob(BASE_PATH."plugins/*/php_admin-request-post.php") as $filename){include $filename;}
	
	if($_POST['type'] == "new" || $_POST['type'] == "edit"){
		if($_POST['type'] == "new"){
			$filename = BASE_PATH."posts/".date("Y-m-d_H-i").".md";
			$successmessage = "created successfully";
			$errormessage = "error - could not create";
		}
		else{ // edit
			$filename = BASE_PATH."posts/".$_POST['id'].".md";
			$successmessage = "edited successfully";
			$errormessage = "error - could not update";
		}
		
		if(!($_POST['title'] && $_POST['content'])){
			if ($_POST['type'] == 'new')
				$returnurl = BASE_URL."admin/".(PRETTY_URLS ? "new/" : "?new");
			else
				$returnurl = BASE_URL."admin/?edit=".$_POST['id'];
			alert("Fill out all filds!", "error", $returnurl);
		}
		
		 // in case we don't have write access on the file
		if(file_exists($filename))
			if(!unlink($filename))
				alert($errormessage, "error");

		if(file_put_contents($filename, $_POST['title']."\n".$_POST['content']))
			alert($successmessage, "success");
		else
			alert($errormessage, "error");
	}
}
?>
