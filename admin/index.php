<?php
if(!defined(BASE_PATH)) define('BASE_PATH', '../');
include(BASE_PATH.'static/include.php');

if('GET' == $_SERVER['REQUEST_METHOD']){
	if(isset($_GET['new'])){
		include(BASE_PATH.'static/templates/new.php');
	}
	if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['edit'])){
		$post = post_details(BASE_PATH."posts/".$_GET['edit'].".md");
		include(BASE_PATH.'/static/templates/edit.php');
	}
	if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['delete'])){
		if(isset($_GET['really'])){
			if(unlink(BASE_PATH."posts/".$_GET['delete'].".md"))
				alert("deleted successfully", "success", BASE_URL);
			else{
				$post = post_details(BASE_PATH."posts/".$_GET['delete'].".md");
				alert("error - could not delete", "error", PRETTY_URLS ? BASE_URL.$post['date']['year']."/".$post['date']['month']."/".$post['date']['day']."/".$post['date']['hour']."/".$post['date']['minute']."/".to_url($post['title']) : BASE_URL."?p=".$post['id']);
			}
		}
		else
			include(BASE_PATH.'static/templates/really.php');
	}
}
if('POST' == $_SERVER['REQUEST_METHOD']){
	if($_POST['type'] == "new" || $_POST['type'] == "edit"){
		if($_POST['type'] == "new"){
			$filename = BASE_PATH."posts/".date("Y-m-d_H-i").".md";
			$successmessage = "created successfully";
			$errormessage = "error - could not create";
		}
		else{
			$filename = BASE_PATH."posts/".$_POST['id'].".md";
			$successmessage = "edited successfully";
			$errormessage = "error - could not update";
		}
			
		 // in case we don't have write access on the file
		if(file_exists($filename))
			if(!unlink($filename))
				alert($errormessage, "error", BASE_URL);

		if(file_put_contents($filename, $_POST['title']."\n".$_POST['content']))
			alert($successmessage, "success", BASE_URL);
		else
			alert($errormessage, "error", BASE_URL);
	}
}
?>
