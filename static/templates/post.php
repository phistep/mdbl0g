<article class="post">
	<h1 class="post-title"><a href="<?php echo $data['postLink']; ?>"><?php echo $data['postTitle']; ?></a></h1>
	<ul class="post-info">
		<li class="post-date"><?php echo $STR["post_label_posted"]; ?> <span><?php echo $data['time']; ?></span></li>
		<li class="post-admin"><a href="<?php echo $data['editLink']; ?>"><?php echo $STR["post_label_edit"]; ?></a></li>
		<li class="post-admin"><a href="<?php echo $data['deleteLink']; ?>"><?php echo $STR["post_label_delete"]; ?></a></li>
	</ul>
	<div class="post-content">
<?php echo $data['contentHtml']; ?>
	</div>
	<?php foreach(glob(BASE_PATH."plugins/*/html_post-bottom.php") as $filename){include $filename;} ?>
</article>

<hr>