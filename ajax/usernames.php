<?php
	//echo "content";
require_once 'core/init.php';
if (isset($_POST['username']) === true &&empty($_POST['username']) ===false) {
	
	$query = mysql_query("
		SELECT `users.username`
		FROM `users`
		WHERE `users`.`username` ='".mysql_real_escape_string(trim($_POST['username']))."'
		");

	echo (mysql_num_rows($query) !==0) ? mysql_result($query, 0, 'username') : 'user not found!';
}
?>