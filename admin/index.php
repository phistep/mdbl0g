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
				alert($STR["alert_delete_success"], "success");
			else{
				$post = post_details(BASE_PATH."posts/".$_GET['delete'].".md");
				alert($STR["alert_delete_error"], "error", BASE_URL.(PRETTY_URLS ? $post['prettyid'] : "?p=".$post['id']));
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
			$successmessage = $STR["alert_new_success"];
			$errormessage = $STR["alert_new_error"];
		}
		else{ // edit
			$filename = BASE_PATH."posts/".$_POST['id'].".md";
			$successmessage = $STR["alert_edit_success"];
			$errormessage = $STR["alert_edit_error"];
		}
		
		if(!($_POST['title'] && $_POST['content'])){
			if ($_POST['type'] == 'new')
				$returnurl = BASE_URL."admin/".(PRETTY_URLS ? "new/" : "?new");
			else
				$returnurl = BASE_URL."admin/?edit=".$_POST['id'];
			alert($STR["alert_new_error_fields"], "error", $returnurl);
		}
		
		 // in case we don't have write access on the file
		if(file_exists($filename))
			if(!unlink($filename))
				alert($errormessage, "error");

		$filecontent = $_POST['title']."\n".$_POST['content'];
		
		foreach(glob(BASE_PATH."plugins/*/php_admin-before-write-post.php") as $pluginfilename){include $pluginfilename;}

		if(file_put_contents($filename, $filecontent))
			alert($successmessage, "success");
		else
			alert($errormessage, "error");
	}
}
?>
