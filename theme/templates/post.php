<article class="post">
	<h1 class="post-title"><a href="<?php echo $DATA['postLink']; ?>"><?php echo $DATA['postTitle']; ?></a></h1>
	<ul class="post-info">
		<li class="post-date"><?php echo $STR["post_label_posted"]; ?> <span><?php echo $DATA['time']; ?></span></li>
		<li class="post-admin"><a href="<?php echo $DATA['editLink']; ?>"><?php echo $STR["post_label_edit"]; ?></a></li>
		<li class="post-admin"><a href="<?php echo $DATA['deleteLink']; ?>"><?php echo $STR["post_label_delete"]; ?></a></li>
		<li class="post-admin"><?php foreach(glob(BASE_PATH."plugins/*/html_post-info.php") as $filename){include $filename;} ?></li>
	</ul>
	<div class="post-content">
<?php echo $DATA['contentHtml']; ?>
	</div>
	<?php foreach(glob(BASE_PATH."plugins/*/html_post-bottom.php") as $filename){include $filename;} ?>
	<?php foreach(glob(BASE_PATH."plugins/*/html_post-bottom-last.php") as $filename){include $filename;} ?>
</article>

<hr>