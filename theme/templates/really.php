<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>theme/css/style.css" media="all">
	<title><?php echo BLOG_TITLE; ?></title>
</head>
<body>
	<form class="alert error" action="<?php echo BASE_URL."admin/";?>" method="get">
	<?php echo $STR["alert_delete_really"]; ?>
	<input type="hidden" name="delete" value="<?php echo $_GET['delete'];?>">
	<input type="submit" name="really" class="alert error" value="<?php echo $STR["post_label_delete"]; ?>">
</form>
</body>
</html>

