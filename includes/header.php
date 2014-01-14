

<header id = "top_header">
	<div class = "login">
		<?php 
			if($user->isLoggedIn()){
		
		?>
		<div class = 'login'>
			<p>Welcome <a href="profile.php?user=<?php echo escape($user->data()->username); ?>" class = "register_link"><?php echo escape($user->data()->username); ?></a>!</p>
			<a href = 'logout.php' class = "register_link">Log Out</a>
		</div>
<?php
}
?>
	</div>
	<div id = 'logo'>
		<input type="text" id="name" onkeyup="getUsername(this.value)" autocomplete='off'>
		<input type="submit" id="name-submit" value="search">
		<div id="results"></div>

		<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
		<script src ="js/global.js"></script>
	</div>
	
	<?php include 'includes/navigation.php'; ?>
</header>