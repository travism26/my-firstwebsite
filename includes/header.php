

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
	<div id = 'logo'>This is where ill put contact info or maybe a pic / Logo</div>
	
	<?php include 'includes/navigation.php'; ?>
</header>