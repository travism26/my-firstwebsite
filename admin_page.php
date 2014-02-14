<?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php'; ?>
<?php
if (!$user->isLoggedIn()) {
	?><script>window.location = "index.php";</script><?php
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
	$user_list = DB::getInstance()->get('users', array('id','is not',NULL));
	//this is where we will be creating <tr> with user data
	//$x = 3;
	foreach ($user_list->results() as $all_users) {
	?>
	<tr class="users_row">
		<td>
			<label><?php echo $all_users->username; ?></label>
		</td>
		<td>
			<label><?php echo $all_users->first_name; ?></label>
		</td>
		<td>
			<label><?php echo $all_users->last_name; ?></label>
		</td>
		<td>
			<label><?php echo $all_users->email; ?></label>
		</td>
		<td>
			<label><?php echo $all_users->active; ?></label>
		</td>
		<td>
			<label><?php echo $all_users->group; ?></label>
		</td>
		<td>
			<label><?php echo $all_users->joined; ?></label>
		</td>
		<td>
			<center><input type="button" value="Suspend"></center>
		</td>
	</tr>
<?php
	}
?>

</table>










<?php include 'includes/overall/overallFooter.php'; ?>