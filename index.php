

<?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php'; ?>
<?php
if(Session::exists('home')){
	echo '<p>'.Session::flash('home') .'</p>';
}
?>

<span>Please use Google Chrome, Since I am using a -webkits in CSS that has not yet been 
integrated into Firefox, IE, and other browsers some of the settings will not display properly.
</span>

<?php
	//If the user is logged in we will display some data
	if($user->isLoggedIn()){

		//If the user is loggedin we want to display some post data.
	}

?>

<?php include 'includes/overall/overallFooter.php'; ?>