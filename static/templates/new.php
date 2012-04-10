<form action="<?php echo BASE_URL."admin/".(PRETTY_URLS ? "new/" : "?new");?>" method="post">
		Title<br><input type="text" name="title" size="50"><br><br>
		Content:<br>
		<textarea name="content" rows="20" cols="60"></textarea><br><br>
		<input type="hidden" name="type" value="new">
		<input type="submit" name="action" value="Submit" class="button">
		<input type="reset" name="reset" value="Reset" class="button">
</form>