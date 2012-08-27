<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>theme/css/style.css" media="all">
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