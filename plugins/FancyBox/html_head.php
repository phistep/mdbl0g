<!-- Fancybox -->
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>plugins/FancyBox/fancybox/jquery.mousewheel-3.0.2.pack.js"></script>
<script type="text/javascript" src="<?php echo BASE_URL; ?>plugins/FancyBox/fancybox/jquery.fancybox-1.3.1.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo BASE_URL; ?>plugins/FancyBox/fancybox/jquery.fancybox-1.3.1.css" media="screen">
<script type="text/javascript">
	$(document).ready(function() {
		$("a.fancybox").fancybox({
			'titleShow'		: true,
			'transitionIn'	: 'elastic',
			'transitionOut'	: 'elastic'
		});
	});
</script>
<!-- end fancybox -->