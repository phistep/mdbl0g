<?php
include('../static/include.php');

if('GET' == $_SERVER['REQUEST_METHOD']){
	if(isset($_GET['new'])){
		include('../static/templates/new.php');
	}
	if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['edit'])){
		$post = post_details("../posts/".$_GET['edit'].".md");
		include('../static/templates/edit.php');
	}
	if(preg_match('/^\d\d\d\d-\d\d-\d\d_\d\d-\d\d$/', $_GET['delete'])){
		if(isset($_GET['really'])){
			unlink("../posts/".$_GET['delete'].".md");
			echo "success!";
		}
		else
			include('../static/templates/really.php');
	}
}
if('POST' == $_SERVER['REQUEST_METHOD']){
	if($_POST['type'] == "new" || $_POST['type'] == "edit"){
		if($_POST['type'] == "new")
			$filename = "../posts/".date("Y-m-d_G-i").".md";
		else
			$filename = "../posts/".$_POST['id'].".md";
			
		// in case we don't have write access on the file
		if (file_exists($filename))
			unlink($filename);
		file_put_contents($filename, $_POST['title']."\n".$_POST['content']);
		echo "success!";
	}
}
?>
