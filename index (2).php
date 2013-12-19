<?PHP
require_once 'core/init.php';
//var_dump(config::get('mysql/host'));
//echo config::get('mysql/host');


$user = DB::getInstance()->get('users', array('username', '=', 'travis'));
$user = DB::getInstance()->query("SELECT * FROM users");

//if($users->count()){
//	foreach ($users as $user) {
//		echo $user ->$username;
//	}
//}

//$user = DB::getInstance()->query("SELECT username FROM users WHERE username = ?", array('travis'));

//if(!$user ->count()){
	//echo 'No user';
//}else{
	//echo "Ok!";
//	foreach($user->results() as $user){
	//	echo $user->username, '<br>';
//	}

//$user = DB::getInstance()->insert('users', array(
	//'username' => 'Dale',
//	'password' => 'password',
//	'salt' => 'salt'
//	));
	//echo $user->_results->username;


?>



<?php
//<a href="register.php">Register</a>
if(Session::exists('home')){
	echo '<p>'.Session::flash('home') .'</p>';
}
$user = new User();
//print_r(Config::get('remember/cookie_expiry'));
if($user->isLoggedIn()){
	?>
<p>Hello <a href="profile.php?user=<?php echo escape($user->data()->username); ?>"><?php echo escape($user->data()->username); ?></a>!</p>

	<ul>
		<li><a href="logout.php">Log out</a></li>
		<li><a href="update.php">Profile</a></li>
		<li><a href="changepassword.php">Change password</a></li>
	</ul>
	<?php
	if($user->hasPermission('admin')){
		echo "<p> you are an admin</p>";
	} else if($user->hasPermission('moderator')){
		echo "<p> you are an moderator</p>";
	}
} else {
	?>
<p>you need to <a href="register.php">Register</a> or <a href="login.php">login</a></p>
	<?php
}
?>