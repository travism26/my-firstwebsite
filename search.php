<?php
	require_once 'core/init.php';
	//echo $_POST['partialName'];

/*

//print_r($user);
	$usernames = $_POST['partialName'];
	$usernameQuery = mysql_query("
		SELECT *
		FROM users
		WHERE username like '%".mysql_real_escape_string(trim($usernames))."%'
	");
	print_r($usernameQuery);
	$test = "
		SELECT * 
		FROM `users` 
		WHERE `username` like '%tr%'";
	//echo $test;
	$result2 = mysql_query($test) or die($test."<br/><br/>".mysql_error());
	while ($username = mysql_fetch_array($usernameQuery)) {
		echo "<div class = 'search_results'>".$username['username']."<div>";
	}

 * This is my first search bar dont be too critical :)
 */
//echo "SELECT *
	//	FROM `users`
	//	WHERE `username` like '%".mysql_real_escape_string(trim($_POST['partialName']))."%'";


if (isset($_POST['partialName']) === true && empty($_POST) === false) {
	$usernames = $_POST['partialName'];
	//echo $usernames;
	$search_username = DB::getInstance()->get('users', array('username','like',$usernames));
		foreach ($search_username->results() as $name) {
			//$username = DB::getInstance()->get('users', array('username','like',$usernames));
			echo $name->username;
			//$post_user_data = $username->results();
		}//foreach loop
}
?>