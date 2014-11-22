<h2>Welcome</h2>
<?php
if (version_compare(PHP_VERSION, MIN_VER, '<')){
	echo "I'm sorry, but you need PHP version <code>".MIN_VER."</code> to run ".POWERED_BY.".<br>You have version <code>".PHP_VERSION."</code>.";
	exit();
}
?>
Thank you for trying <?php echo POWERED_BY; ?>! I hope you'll enjoy it. The installation requires you to fill in some information but is completed in <?php echo $numsteps; ?> short steps.

<br><br><a href="?step=1">Get me started!</a>
