<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/css/style.css" media="all">
	<title>Admin Interface <?php echo BLOG_TITLE; ?></title>
</head>
<body>
	<h1><a href="<?php echo BASE_URL; ?>"><?php echo BLOG_TITLE; ?></a></h1>
	<h2 class="description">Admin Interface</h2>
	<hr class="thin">
	
	<h3>New Post</h3>
	<a href="<?php echo BASE_URL."admin/".(PRETTY_URLS ? "new/" : "?new") ?>">New Post</a>
	<hr class="thin">

<?php
	foreach(glob(BASE_PATH."plugins/*/html_admin.php") as $filename){
		preg_match("/.+\/(.+)\/html_admin.php/", $filename, $result);
		echo '<h3>'.$result[1].' <small>(Plugin)</small></h3>';
		include $filename;
		echo '<hr class="thin">';
	}
?>
</body>
</html>

