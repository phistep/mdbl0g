<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title><?php echo BLOG_TITLE; ?></title>
	 
	<!-- Refresh -->
	<meta http-equiv="refresh" content="<?php echo $alert_delay; ?>;URL=<?php echo $alert_return_url; ?>">
</head>
<body>
	<div class="alert <?php echo $alert_type; ?>">
		<?php echo $alert_message; ?>
	</div>
</body>
</html>