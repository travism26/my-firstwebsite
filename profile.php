<?php
require_once 'core/init.php';

include 'includes/overall/overallHeader.php';
if(!$username = Input::get('user')){
	Redirect::to('index.php');
} else {
	$other_user = new User($username);
	if(!$other_user->exists()){
		Redirect::to(404);
	} else {
		$data = $other_user->data();
	}
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
							'receiver_id' => $data->id
						));
					
					Session::flash('home', 'You registered successfully!');
					$login = $user->login(Input::get('username'), Input::get('password'), $remember);
					Redirect::to('index.php');
					} catch(Exception $e){
						die($e->getMessage());
					}
				} else {
					echo "Error no input avaiable";
				}
			}//token::check
		}//input::exists
?>

	<h3><?php echo escape($data->username); ?></h3>

	<p>Full name: <?php echo escape($data->first_name); ?></p>
	<p>id: <?php echo escape($data->id); ?></p>
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
}//else
?>

<?php include 'includes/overall/overallFooter.php'; ?>