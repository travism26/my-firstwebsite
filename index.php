

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
		if(Input::exists()){
			if(Token::check(Input::get('post_token'))){

				$validate = new Validate();
				$validation = $validate->check($_POST, array(
					'message' => array(
					'required' => true,
					'min' => 6,
					)
				));

				if($validation->passed()){
					//if the validation passes we need to post the message
					try{
						//This is where we get the input values from the form
						$user->createPost(array(
							'message' => Input::get('message'),
							'user_id' => $user->data()->id,
							'receiver_id' => $user->data()->id,
							'active' => 0
						));
					?><script>window.location = "index.php";</script><?php
					//Redirect::to('index.php');
					} catch(Exception $e){
						die($e->getMessage());
					}
				} else {
					echo "Error no input avaiable";
				}
			}//token::check
		}//input::exists
?>
	<div class="post_input">
		<form method="post" action="index.php">
			<div>
				<label for="message" class="post_label">Message:</label>
			</div>
			<div>
				<textarea type="textarea" name="message" class="post_input_text" value=""><?PHP echo escape(Input::get('message'));?></textarea>
			</div>
			<div>
				<input type="submit" value="Post" class="post_submit">
				<input type="hidden" name="post_token" value="<?php echo Token::generate(); ?>">
			</div>
		</form>
	</div>

		<?php
		//If the user is loggedin we want to display some post data.
		//this creates the SQL script to load the post data as an object.
		$postDataSql = DB::getInstance()->get_orderBy('post', array('receiver_id','=',$user->data()->id), "ORDER BY post_id DESC");
		foreach ($postDataSql->results() as $postDataSql) {
			$username = DB::getInstance()->get('users', array('id','=',$postDataSql->user_id));
			//$post_user_data = $username->results();
			if($postDataSql->active ==1){
				echo "Message not active";
			}else{
		 ?>
			<div class="post">
				<div class="post_header">
					<a href="profile.php?user=<?php echo escape($username->first()->username); ?>" class = "register_link"><?php echo escape($username->first()->username); ?></a> says:
					<input type="image" src="images/icons/delete.png" style="float:right;" name="deletePost" onclick="deletePost()">
					<input type="hidden" id="post_id1" value="<?php echo escape($postDataSql->post_id); ?>">
				</div>
				<div class="post_message">
					<p>
					<?php
						echo $postDataSql->message, '<br>';
					?>
					</p>
				</div>
			</div>
			<div class="comment">
				<div class="comment_header">
					This is a comment!
				</div>
			</div>
<?php
} 
}
?>
<?php
}
?>

<?php include 'includes/overall/overallFooter.php'; ?>