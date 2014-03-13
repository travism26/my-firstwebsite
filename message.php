<?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php';


<<<<<<< HEAD
	if(Token::check(Input::get('message_token')) || isset($_GET['post_id']) ===false) {
		/*
			I will be adding in some security with the token class to prevent SQL injection!
		*/
			?><script>window.location.replace("index.php")</script><?php
=======
	if(Token::check(Input::get('message_token'))){
		/*
			I will be adding in some security with the token class to prevent SQL injection!
		*/
>>>>>>> 10b0c37fd00a89e41df4071226544a6631bd0e02
	}

	//_POST['action2']=== 'No' $_GET['action']
	$message_id = $_GET['post_id'];
	if (is_numeric($message_id) !==true) {
		echo "This is not a valid message!";
		die();
	}
	$editMessage = DB::getInstance()->get('post', array('post_id','=',$message_id));
<<<<<<< HEAD
	$user_id_message = $editMessage->first()->user_id;
	echo $user_id_message;
	$userMessageData = DB::getInstance()->get('users', array('id','=',$user_id_message));
=======
>>>>>>> 10b0c37fd00a89e41df4071226544a6631bd0e02
	
?>


			<div class="post">
				<div class="post_header">
<<<<<<< HEAD
					<a href="#" class = "register_link"><?php escape($userMessageData->first()->username); ?>: </a> says:
=======
					<a href="#" class = "register_link">Travis: </a> says:
>>>>>>> 10b0c37fd00a89e41df4071226544a6631bd0e02
					<form action="message.php" method="GET" style="margin:0; padding:0; display: inline;">
					<input type="image" src="images/icons/delete.png" style="float:right;" name="deletePost">
					<input type="hidden" name="message_token" value="<?php echo Token::generate(); ?>">
					</form>
					
				</div>
				<div class="post_message">
					<p>
					<?php
						echo escape($editMessage->first()->message, '<br>');
					?>
					</p>
				</div>
			</div>
			<div class="comment">
				<div class="comment_header">
					This is a comment!
				</div>
			</div>



<?php include 'includes/overall/overallFooter.php'; ?>