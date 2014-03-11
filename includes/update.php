<?php
if (!$user->isLoggedIn()) {

?>
<section id = "updates">
	<div class="menu-side">
		This is a side menu
	</div>
<?php
//in here i want to check if the user is logged in and if so show their updates. else get them to log in / register!
$basename = substr(strtolower(basename($_SERVER['PHP_SELF'])),0,strlen(basename($_SERVER['PHP_SELF']))-4);
if($user->isLoggedIn()){
	include 'includes/widgets/loggedin.php';
} else if($basename != "register"){
	include 'includes/widgets/login.php';
} 
/* 
 * This else statement is to remove the login form which prevented me from
 * including some security features due to the token being over-written within the
 * config class and returning a false token.
 */
else if(!empty($validation) && $basename === "register"){
		echo "<div class='error'>";
		foreach ($validation->errors() as $error) {
			echo $error, '<br>';
		}
		echo "</div>";
	}
?>
</section>

<?php
}
?>