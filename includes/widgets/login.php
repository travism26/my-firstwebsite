	<div class = "login">
		<form action = "login.php" method = "post" name = "login">
			<div class = "login">
				<label for="username">Login:</label>
				<input type = "text" name = "username" id ="username">
			</div>
			
			<div>
				<label for="password">Password:</label>
				<input type="password" name="password" id="password" autocomplete = "off">
			</div>
			<div class="field">
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