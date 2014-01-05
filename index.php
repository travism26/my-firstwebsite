

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
?>
	<div class="post_input">
		<form method="post" action="index.php">
			<div>
				<label for="message" class="post_label">Message:</label>
			</div>
			<div>
				<textarea type="textarea" name="message" class="post_input_text"></textarea>
			</div>
			<div>
				<input type="submit" value="Post" class="post_submit">
			</div>
		</form>
	</div>

		<?php
		//If the user is loggedin we want to display some post data.
		//this creates the SQL script to load the post data as an object.
		$postDataSql = DB::getInstance()->get('post', array('user_id','=',$user->data()->id));
		foreach ($postDataSql->results() as $postDataSql) { 
		 ?>
			<div class="post">
				<div class="post_header">
					<a href="profile.php?user=<?php echo escape($user->data()->username); ?>" class = "register_link"><?php echo escape($user->data()->username); ?></a> says:
				</div>
				<div class="post_message">
					<p>
					<?php
						echo $postDataSql->message, '<br>';
					?>
					</p>
				</div>
			</div>
<?php 
} 
?>
<?php
	}
?>

<?php include 'includes/overall/overallFooter.php'; ?>