<section id = "updates">

<?php
//in here i want to check if the user is logged in and if so show their updates. else get them to log in!

if($user->isLoggedIn()){
	include 'includes/widgets/loggedin.php';
} else{
	include 'includes/widgets/login.php';
}
?>
</section>