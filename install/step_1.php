<?php
if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create-acc'])){
	if($_POST['username'] == "" || $_POST['password'] == "" || $_POST['password-repeat'] == "" || $_POST['password'] != $_POST['password-repeat']){
		header('location:index.php?step=1&error');
		exit();
	}
	else{
		if(!is_writable('../admin'))
		   chmod("../admin", 0775) or die("error set permissions ../admin");
		
		file_put_contents("../admin/.htpasswd", $_POST['username'].':'.crypt($_POST['password'], base64_encode($_POST['password']))) or die("error write htpasswd");
		chmod("../admin/.htpasswd", 0604);
		
		header('location:index.php?step=2');
		exit();
	}
}
?>
<h2>Create an account</h2>
First you need to create an Admin Account. It is used to post, edit and delete posts and to manage plugins. Choose a secure password.

<form method="post" action="step_1.php">
	<fieldset>
		<legend>Admin Account</legend>
		<label for="username">Username:</label>
			<input name="username" id="username" type="text" value=""><br>
		<label for="password">Password:</label></td>
			<input name="password" id="password" type="password" value="" onkeyup="javascript:
				if(this.value == document.getElementById('password-repeat').value && this.value.length != 0){
					this.style.borderColor = '#00b450';
					this.style.boxShadow = '0px 0px 2px #00b450'
					document.getElementById('password-repeat').style.borderColor = '#00b450';
					document.getElementById('password-repeat').style.boxShadow = '0px 0px 2px #00b450';
				}
				else{
					this.style.borderColor = 'grey';
					this.style.boxShadow = 'none'
					document.getElementById('password-repeat').style.borderColor = 'red';
					document.getElementById('password-repeat').style.boxShadow = '0px 0px 2px red';
					
				}
			"><br>
		<label for="sql-db">Repeat Password:</label></td>
			<input name="password-repeat" id="password-repeat" type="password" value="" onkeyup="javascript:
				if(this.value == document.getElementById('password').value && this.value.length != 0){
					this.style.borderColor = '#00b450';
					this.style.boxShadow = '0px 0px 2px #00b450'
					document.getElementById('password').style.borderColor = '#00b450';
					document.getElementById('password').style.boxShadow = '0px 0px 2px #00b450';
				}
				else{
					this.style.borderColor = 'red';
					this.style.boxShadow = '0px 0px 2px red'
					document.getElementById('password').style.borderColor = 'grey';
					document.getElementById('password').style.boxShadow = 'none';
				}
			"><br>
		<input class="button" value="Create Account" name="create-acc" type="submit">
	</fieldset>
</form>
