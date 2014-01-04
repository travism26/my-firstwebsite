<section id = "updates">

<?php
//in here i want to check if the user is logged in and if so show their updates. else get them to log in!
$basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);
if($user->isLoggedIn()){
	include 'includes/widgets/loggedin.php';
} else if($basename != "register"){
	include 'includes/widgets/login.php';
} else if(!empty($validation) && $basename === "register"){
		echo "<div class='error'>";
		foreach ($validation->errors() as $error) {
			echo $error, '<br>';
		}
		echo "</div>";
	}
?>
</section>