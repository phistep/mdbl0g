<form action="<?php echo BASE_URL."admin/".(PRETTY_URLS ? "edit/".$post['date']['year']."/".$post['date']['month']."/".$post['date']['day']."/".$post['date']['hour']."/".$post['date']['minute']."/".to_url($post['title'])
 : "?edit=".$post['id']);?>" method="post">
		Title<br><input type="text" name="title" size="50" value="<?php echo $post['title'];?>"><br><br>
		Content:<br>
		<textarea name="content" rows="20" cols="60"><?php echo $post['content'];?></textarea><br><br>
		<input type="hidden" name="type" value="edit">
		<input type="hidden" name="id" value="<?php echo $post['id'];?>">
		<input type="submit" name="action" value="Submit" class="button">
		<input type="reset" name="reset" value="Reset" class="button">
</form>