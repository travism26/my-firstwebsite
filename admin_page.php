<?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php'; ?>
<?php
if(Session::exists('home')){
	echo '<p>'.Session::flash('home') .'</p>';
}
?>
<table class="users_table">
	<tr class="users_row">
		<td>
			<label>Username</label>
		</td>
		<td>
			<label>First Name</h3>
		</td>
		<td>
			<label>Last Name</label>
		</td>
		<td>
			<label>Email</label>
		</td>
		<td>
			<label>Locked Account</label>
		</td>
		<td>
			<label>Permissions</label>
		</td>
		<td>
			<label>Joined</label>
		</td>
		<td>
			<label>Suspend Account</label>
		</td>
	</tr>
	<?php
	//this is where we will be creating <tr> with user data
	//$x = 3;
	//foreach ($x as $xval) {
		
	?>
	<tr class="users_row">
		<td>
			<label>username</label>
		</td>
		<td>
			<label>First Name</label>
		</td>
		<td>
			<label>Last Name</label>
		</td>
		<td>
			<label>Email</label>
		</td>
		<td>
			<label>Locked Account</label>
		</td>
		<td>
			<label>Permissions</label>
		</td>
		<td>
			<label>Joined</label>
		</td>
		<td>
			<input type="button" value="Suspend">
		</td>
	</tr>
<?php
//}
?>

</table>










<?php include 'includes/overall/overallFooter.php'; ?>