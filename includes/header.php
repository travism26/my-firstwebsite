

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
	<div id = 'logo' class="profile_header">
	<?php
	if($user->isLoggedIn()){
		if(file_exists($user->data()->profile_pic)){
			echo '<img src= "', $user->data()->profile_pic, '" alt="'. $user->data()->first_name .'-Profile" class = "profile_picture">';	
		}
	}
	?>
	</div>
	
	<?php include 'includes/navigation.php'; ?>
</header>