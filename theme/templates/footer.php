	</div>
	
	<footer>
		<a href="http://validator.w3.org/check?uri=referer">HTML5 valid</a>
		<span class="seperator"> | </span>
		<?php echo $STR["powered_by"]; ?> <a href="<?php echo POWERED_BY_LINK; ?>"><?php echo POWERED_BY; ?></a>
	</footer>
</div>

<?php foreach(glob(BASE_PATH."plugins/*/html_footer-bottom.php") as $filename){include $filename;} ?>
</body>
</html>
