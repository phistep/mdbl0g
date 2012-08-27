<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo BLOG_TITLE; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>theme/css/style.css" media="all and (min-width: 840px)">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL ?>theme/css/mobile.css" media="only screen and (max-width: 839px)">
	<link href='http://fonts.googleapis.com/css?family=Average' rel='stylesheet' type='text/css'>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>theme/js/showdown.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>theme/js/showdown-gui.js"></script>
	<script type="text/javascript" src="<?php echo BASE_URL; ?>theme/js/php-date-format.js"></script>
</head>
<body>
<div class="newpost-wrapper">
	<div class="content newpost input">
		<form method="post">
				<?php echo $STR["post_title"]; ?><br><input type="text" name="title" size="50" onKeyUp="document.getElementById('preview-title').innerHTML = this.value;"<?php if($type == 'edit') echo ' value="'.$post['title'].'"';?>><br><br>
				<?php echo $STR["post_content"]; ?><br>
				<textarea name="content" id="inputPane" rows="20" cols="60"><?php if($type == 'edit') echo $post['content'];?></textarea><br><br>
				<?php foreach(glob(BASE_PATH."plugins/*/html_admin-new-edit-after-textarea.php") as $filename){include $filename;} ?>
				<?php if($type == 'edit') echo '<input type="hidden" name="id" value="'.$post['id'].'">'; ?>
				<input type="hidden" name="type" value="<?php echo $type; ?>">
				<input type="submit" name="action" value="<?php echo $STR["post_submit"]; ?>" class="button">
		</form>
	</div>

	<div class="content newpost preview">
		<article class="post">
			<h1 class="post-title"><a href="#" id="preview-title"><?php if($type == 'edit') echo $post['title'];?></a></h1>
			<ul class="post-info">
				<li class="post-date"><?php echo $STR["post_label_posted"]; ?> <span><script type="text/javascript">var now = new Date();document.write(now.format('<?php echo DATE_FORMAT; ?>'));</script></span></li>
			</ul>
			<div class="post-content">
				<div id="previewPane" class="previewpane"><noscript><h2><?php echo $STR["post_noscript"]; ?></h2></noscript></div>
			</div>
		</article>
	</div>
</div>
</body>
</html>