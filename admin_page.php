?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php'; ?>
<?php
if(Session::exists('home')){
	echo '<p>'.Session::flash('home') .'</p>';
}
?>











<?php include 'includes/overall/overallFooter.php'; ?>