?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php'; ?>
<?php
if(Session::exists('home')){
	echo '<p>'.Session::flash('home') .'</p>';
}
?>
<table>
	<tr>
		<td>
			<h3>Username</h3>
		</td>
		<td>
			<h3>First Name</h3>
		</td>
		<td>
			<h3>Last Name</h3>
		</td>
		<td>
			<h3>Email</h3>
		</td>
		<td>
			<h3>Locked Account</h3>
		</td>
		<td>
			<h3>Permissions</h3>
		</td>
		<td>
			<h3>Joined</h3>
		</td>
	</tr>

</table>










<?php include 'includes/overall/overallFooter.php'; ?>