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
	if($_POST['type'] == "new"){
		$date = date("Y-m-d_G-i");
		$file = fopen("../posts/".$date.".md", 'w')
			or die('error creating file');
		fwrite($file, $_POST['title']."\n".$_POST['content']);
		echo "success!";
		fclose($file);
	}
	if($_POST['type'] == "edit"){
		echo "editing";
	}
}
?>