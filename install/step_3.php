<?php
function isValidTimezone($timezone) {
	$zoneList = timezone_identifiers_list();
	return in_array($timezone, $zoneList);
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['settings'])){
	if(	$_POST['timezone'] == ""
		|| !isValidTimezone($_POST['timezone'])
		|| $_POST['base_url'] == ""
		|| !filter_var($_POST['base_url'], FILTER_VALIDATE_URL)
		|| $_POST['posts_per_page'] == ""
		|| !is_numeric($_POST['posts_per_page'])
		|| $_POST['date_format'] == ""
		|| ($_POST['date_format'] == "custom" && $_POST['date_format_custom'] == "")
		){
		echo "<h3>Please fill out all fields correctly!</h3>";
		exit();
	}
	else{
		if(!is_writable('../core'))
			chmod("../core", 0775) or die("error set permissions .");

		$include = file_get_contents("include.php.tmp") or die("error read include template");
		
		$include = preg_replace("/%TIMEZONE/", '"'.$_POST['timezone'].'"', $include);
		if(substr($_POST['base_url'], -1) != '/') 
		    $_POST['base_url'] .= '/';
		$include = preg_replace("/%BASE_URL/", '"'.$_POST['base_url'].'"', $include);
		$include = preg_replace("/%POSTS_PER_PAGE/", $_POST['posts_per_page'], $include);
		$include = preg_replace("/%PRETTY_URLS/", ($_POST['pretty_urls'] == "on" ? "true" : "false"), $include);
		$date_format_custom = preg_replace('/"/', '\\"', $_POST['date_format_custom']);
		$include = preg_replace("/%DATE_FORMAT/", '"'.($_POST['date_format'] != "custom" ? $_POST['date_format'] : $date_format_custom).'"', $include);
		file_put_contents("../core/include.php", $include) or die("error write include");
		@chmod("../core", 0755);
		
		
		if(!is_writable('../'))
			chmod("../", 0775) or die("error set permissions .");
			
		$rewritepath = explode("/", parse_url($_POST['base_url'], PHP_URL_PATH));
		array_pop($rewritepath);
		$rewritepath = implode("/", $rewritepath);
		if(substr($rewritepath, -1) != '/') 
		    $rewritepath .= '/';
		
		$htaccess = file_get_contents("blog.htaccess.template") or die("error read blog htaccess template");
		$htaccess = preg_replace("/%REWRITE_BASE/", $rewritepath, $htaccess);
		$htaccess = preg_replace("/%PRETTY_URLS/", ($_POST['pretty_urls'] == "on" ? "" : "#"), $htaccess);
		file_put_contents("../.htaccess", $htaccess) or die("error write blog htaccess");
		@chmod("../.htaccess", 0604);
		@chmod("../", 0755);
		
		
		if(!is_writable('../admin'))
			chmod(".", 0775) or die("error set permissions .");
		
		$pwdpath = explode("/", __DIR__);
		array_pop($pwdpath);
		$pwdpath = implode("/", $pwdpath);
		
		$htaccess = file_get_contents("admin.htaccess.template") or die("error read admin htaccess template");
		$htaccess = preg_replace("/%PATH/", $pwdpath."/admin/.htpasswd", $htaccess);
		$htaccess = preg_replace("/%REWRITE_BASE/", $rewritepath."admin/", $htaccess);
		$htaccess = preg_replace("/%PRETTY_URLS/", ($_POST['pretty_urls'] == "on" ? "" : "#"), $htaccess);
		file_put_contents("../admin/.htaccess", $htaccess) or die("error write admin htaccess");
		@chmod("../admin/.htaccess", 0604);
		@chmod("../admin", 0755);
		
		if(!is_writable('../posts'))
			@chmod("../posts", 0755);
		
		header('location:index.php?step=4');
		exit();
	}
}
?>
<h2>Set your settings</h2>
Now we can configure your settings. First type in some general information. Then define the behavior of your blog.

<form method="post" action="step_3.php">
	<fieldset>
		<legend>General</legend>
		<label for="timezone">Timezone <small>(<a href="ttp://php.net/manual/en/timezones.php" target="_blank">Info</a>)</small>:</label>
			<select name="timezone" id="timezone">
				<?php
				foreach(timezone_identifiers_list() as $timezone)
					echo "<option value=\"".$timezone."\"".($timezone == "Europe/Berlin" ? " selected" : "").">".$timezone."</option>\n";
				?>
			</select><br>
		<label for="base_url">URL:<br><small>(<code>http://example.com/</code>)</small></label>
			<input name="base_url" id="base_url" type="text" value="http://">
			<script type="text/javascript">
				// gets current URL and cuts off the "install/?step=3" part and assigns it to the base_url field
				document.getElementById("base_url").value = /(.*\/)(install\/\?step=3)/.exec(document.URL)[1];
			</script>
	</fieldset>
	
	<fieldset>
		<legend>Blog</legend>
		<label for="posts_per_page">Posts per page:</label>
			<input name="posts_per_page" id="posts_per_page" type="number" value="5"><br>
		<label for="pretty_urls">Pretty URLs*:</label>
			<input name="pretty_urls" id="pretty_urls" type="checkbox" checked><br>
		<label for="date_format">Date format:</label>
			<select name="date_format" id="date_format" onchange="javascript:
				if(this.value == 'custom'){
					document.getElementById('date_format_custom').style.display = 'inline';
					document.getElementById('date_format_custom_label').style.display = 'inline';
				}
				else {
					document.getElementById('date_format_custom').style.display = 'none';
					document.getElementById('date_format_custom_label').style.display = 'none';
				}">
				<option value="j.n.Y G:i">German (<?php echo date("j.n.Y G:i"); ?>)</option>
				<option value="n/j/Y g:i A">American (<?php echo date("n/j/Y g:i A"); ?>)</option>
				<option value="custom">Custom</option>
			</select><br>
		<label for="date_format_custom" id="date_format_custom_label" style="display:none;">Cutsom <small>(<a href="http://php.net/manual/en/function.date.php" target="_blank">Refernece</a>)</small>:</label>
			<input name="date_format_custom" id="date_format_custom" type="text" value="" style="display:none;">
	</fieldset>
	<br>
	<input class="button" value="Save" name="settings" type="submit">
</form>
<br><br>
* Pretty URLs Examples:<br>
<strong>On:</strong> <code>http://example.com/<?php echo date("Y/m/d/H/i"); ?>/post-title</code><br>
<strong>Off:</strong> <code>http://example.com/?p=<?php echo date("Y-m-d_H-i"); ?></code><br><br>
<strong>On:</strong> <code>http://example.com/search/foobar</code><br>
<strong>Off:</strong> <code>http://example.com/?s=foobar</code>