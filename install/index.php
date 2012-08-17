<?php
define('POWERED_BY', 'mdbl0g');
define('POWERED_BY_LINK', 'https://github.com/Ps0ke/mdbl0g/');
define('GET_PLUGINS_LINK', 'https://github.com/Ps0ke/mdbl0g-plugins/');
define('MIN_VER', '5.1.0');

$numsteps = 4;
if(isset($_GET['step']))
	$step = $_GET['step'];
else
	$step = '0';


?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title><?php echo POWERED_BY; ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<link rel="stylesheet" type="text/css" href="../static/css/style.css" media="all and (min-width: 840px)">
	<link rel="stylesheet" type="text/css" href="../static/css/mobile.css" media="only screen and (max-width: 839px)">
	<link href='http://fonts.googleapis.com/css?family=Average' rel='stylesheet' type='text/css'>
	<style>
		.progressbar.outer{
			margin-top: 25px;
			width:98%;
			height: 25px;
			border:1px dotted gray;
			padding:3px;
		}
		.progressbar.inner{
			height:25px;
			background: lightgray;
			width:<?php echo round($step/$numsteps, 2)*100; ?>%;
			text-align:center;
		}
		fieldset{
			border:1px dotted gray;
			padding: 5px;
			width: 370px;
			margin-top: 25px;
		}
		fieldset label, fieldset input{
			display: block;
			width: 135px !important;
			float: left;
			margin-bottom: 10px;
		}
		fieldset label{
			text-align: right;
			padding-right: 10px;
		}
		fieldset br{
			clear: left;
		}
		input[type=password], input[type=number]{
			border: 1px dotted gray;
			padding: 5px;
			width:100%;
		}
		small{
			font-size: 80%;
		}
	</style>
	<title>Admin Interface <?php echo BLOG_TITLE; ?></title>
</head>
<body>
	<div class="wrapper">
		<aside class="infobox">
			<h1><?php echo POWERED_BY; ?></h1>
			<span class="description">Installer</span>
			<div class="progressbar outer">
				<div class="progressbar inner"><?php if($step) echo $step."/".$numsteps; ?></div>
			</div>
		</aside>
		<div class="content">
<?php
include("step_".$step.".php");
?>
		</div>
		<footer>Powered by <a href="<?php echo POWERED_BY_LINK; ?>"><?php echo POWERED_BY; ?></a></footer>
	</div>
</body>
</html>