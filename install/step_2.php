<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['set-title'])){
	if($_POST['title'] == "" || $_POST['description'] == ""){
		echo "<h3>Please fill out all fields correctly!</h3>";
		exit();
	}
	else{
		if(!is_writable('.'))
			chmod(".", 0775) or die("error set permissions .");

		$include = file_get_contents("include.php.template") or die("error read include template");
		
		$title = preg_replace('/"/', '\\"', $_POST['title']);
		$include = preg_replace("/%BLOG_TITLE/", '"'.$title.'"', $include);
		$desc = preg_replace('/"/', '\\"', $_POST['description']);
		$include = preg_replace("/%BLOG_DESCRIPTION/", '"'.$desc.'"', $include);
		file_put_contents("include.php.tmp", $include) or die("error write include");

		header('location:index.php?step=3');
		exit();
	}
}
?>
<h2>Give it a name</h2>
Your blog needs a name. Give it a catchy title and a meaningful description. This will get readers interested!

<form method="post" action="step_2.php">
	<fieldset>
		<legend>Blog Details</legend>
		<label for="title">Title:</label>
			<input name="title" id="title" type="text" value=""><br>
		<label for="description">Description:</label></td>
			<input name="description" id="description" type="text" value=""><br>
		<input class="button" value="Save" name="set-title" type="submit">
	</fieldset>
</form>