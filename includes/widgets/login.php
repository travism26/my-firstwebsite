	<div id="login_form">
		<form action = "login.php" method = "post" name = "login">
			<div class = "login">
				<label for="username">Login:</label>
				<input type = "text" name = "username" id ="username">
			</div>
			
			<div class = "login">
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" autocomplete = "off">
			</div>
			<div class = "login">
				<label for="remember">
					<input type="checkbox" name="remember" id="remember" >Remember me
				</label>
			</div>
			<div class = "login">
				<input type ="submit" value = "Login">
				<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				<span> or <a href = "register.php" class = "register_link">Register</a></span>
			</div>
		</form>
	</div>
	
	<?php
//the following errors will be for the login / register forms only when the user is NOT loggedin
	if(!empty($validation)){
		echo "<div class='error'>";
		foreach ($validation->errors() as $error) {
			echo $error, '<br>';
		}
		echo "</div>";
	}
	?>
	