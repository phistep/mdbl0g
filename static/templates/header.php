<!DOCTYPE html>
<html>
	<head>
		<?php foreach(glob(BASE_PATH."plugins/*/html_head-top.php") as $filename){include $filename;} ?>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<meta name="generator" content="<?php echo POWERED_BY ?>">
		<link rel="alternate" type="application/rss+xml" title="<?php echo BLOG_TITLE; ?> Feed" href="<?php echo $data['rssLink']; ?>">
		<title><?php echo BLOG_TITLE; ?></title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/css/style.css" media="all and (min-width: 610px)">
		<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>static/css/mobile.css" media="only screen and (max-width: 609px)">
		<?php foreach(glob(BASE_PATH."plugins/*/html_head.php") as $filename){include $filename;} ?>
	</head>
<body>
<div class="wrapper">
	<aside class="infobox">
		<h1><a href="<?php echo BASE_URL; ?>"><?php echo BLOG_TITLE; ?></a></h1>
		<span class="description"><?php echo BLOG_DESCRIPTION; ?></span>
		<ul class="info">
			<li><form method="get" action="<?php echo BASE_URL; ?>">
				<input type="search" placeholder="Search..." name="q"<?php if($data['type'] == 'search') echo ' value="'.$_GET['q'].'"';?>>
			</form></li>
			<li><a href="<?php echo $data['rssLink']; ?>">Subscribe via RSS</a></li>
<?php
	if($data['type'] == 'search')
		echo '<li class="result">Search Results: <span class="result-count">'.$data['entryCount'].'</span></li>';
	if($data['maxPages'] > 1){
		echo '<li class="pages">Page: ';
		if($data['previousPageLink'])
			echo '<span class="pages previous"><a href="'.$data['previousPageLink'].'">&lt;</a></span> ';

		echo '<span class="pages current">'.$data['currentPage'].'/'.$data['maxPages'].'</span>';

		if($data['nextPageLink'])
			echo ' <span class="pages next"><a href="'.$data['nextPageLink'].'">&gt;</a></span>';
		echo '</li>';
	}
?>
			<li class="new-post"><a href="<?php echo $data['newPostLink']; ?>">New Post</a></li>
		</ul>
		<span class="generator"><a href="http://validator.w3.org/check?uri=referer">HTML5 valid</a> | Powered by <a href="<?php echo POWERED_BY_LINK; ?>"><?php echo POWERED_BY; ?></a></span>
	</aside>
	<div class="content">
