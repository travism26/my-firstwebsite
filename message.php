<?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php';


	if(Token::check(Input::get('message_token'))){
		/*
			I will be adding in some security with the token class to prevent SQL injection!
		*/
	}

	//_POST['action2']=== 'No' $_GET['action']
	$message_id = $_GET['post_id'];
	if (is_numeric($message_id) !==true) {
		echo "This is not a valid message!";
		die();
	}
	$editMessage = DB::getInstance()->get('post', array('post_id','=',$message_id));
	
?>


			<div class="post">
				<div class="post_header">
					<a href="#" class = "register_link">Travis: </a> says:
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