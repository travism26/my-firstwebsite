<?php
require_once 'core/init.php';
$user = new User();
$user->logout();
?><script>window.location = "index.php";</script><?php
//Redirect::to('index.php');

?>