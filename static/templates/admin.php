<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo BLOG_TITLE; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/css/style.css" media="all and (min-width: 840px)">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>static/css/mobile.css" media="only screen and (max-width: 839px)">
	<link href='http://fonts.googleapis.com/css?family=Average' rel='stylesheet' type='text/css'>
	<title>Admin Interface <?php echo BLOG_TITLE; ?></title>
</head>
<body>
	<div class="wrapper">
		<aside class="infobox">
			<h1><a href="<?php echo BASE_URL; ?>"><?php echo BLOG_TITLE; ?></a></h1>
			<span class="description"><?php echo $STR["admin_link"]; ?></span>
			<ul class="info">
				<li class="new-post"><a href="<?php echo BASE_URL; ?>"><?php echo $STR["admin_back"]; ?></a></li>
			</ul>
			<span class="generator"><a href="http://validator.w3.org/check?uri=referer">HTML5 valid</a> | Powered by <a href="<?php echo POWERED_BY_LINK; ?>"><?php echo POWERED_BY; ?></a></span>
		</aside>
		<div class="content">
			<h2><?php echo $STR["admin_new_headline"]; ?></h2>
			<a href="<?php echo BASE_URL."admin/".(PRETTY_URLS ? "new/" : "?new") ?>"><?php echo $STR["admin_new_desc"]; ?></a>
			<hr class="thin">

			<h2><?php echo $STR["admin_plugins"]; ?></h2>
			<ul>
		<?php
			if(count(glob(BASE_PATH."plugins/*", GLOB_ONLYDIR)) == 0)
				echo $STR["admin_plugins_none"];
			foreach(glob(BASE_PATH."plugins/*", GLOB_ONLYDIR) as $filename){
				preg_match("/.+\/(.+)$/", $filename, $result);
				echo '<li>'.$result[1].'</li>';
			}
		?>
			</ul>
			<hr class="thin">
	
		<?php
			foreach(glob(BASE_PATH."plugins/*/html_admin.php") as $filename){
				preg_match("/.+\/(.+)\/html_admin.php$/", $filename, $result);
				echo '<h2>'.$result[1].' <small>(Plugin)</small></h2>';
				include $filename;
				echo '<hr class="thin">';
			}
		?>
		</div>
	</div>
</body>
</html>

