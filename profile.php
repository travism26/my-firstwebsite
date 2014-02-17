<?php
require_once 'core/init.php';
if(!$user->isLoggedIn()){
Session::flash('home', 'You must login before you can view peoples pages!');
?><script>window.location = "index.php";</script><?php
//Redirect::to('index.php');
}
include 'includes/overall/overallHeader.php';

if(!$username = Input::get('user')){
	?><script>window.location = "index.php";</script><?php
	//Redirect::to('index.php');
} elseif (Input::get('user') === $user->data()->username) {
	?><script>window.location = "index.php";</script><?php
	//Redirect::to('index.php');
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

					//print_r($data);
					//die();
					//if the validation passes we need to post the message
					try{
						//This is where we get the input values from the form
						$user->createPost(array(
							'message' => Input::get('message'),
							'user_id' => $user->data()->id,
							'receiver_id' => $data->id
						));
						?><script>window.location.replace("<?php echo "profile.php?user=".$data->username; ?>")</script><?php
					//Redirect::to("profile.php?user=".$data->username);
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
	<h3><?php echo "profile.php?user=".$data->username; ?></h3>

	<p>Full name: <?php echo escape($data->first_name); ?></p>
	<p>id: <?php echo escape($data->id); ?></p>
	<div class="post_input">
		<form method="post" action="">
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

		/*

SELECT * 
FROM  `post` 
WHERE receiver_id =35
ORDER BY post_id DESC 
		*/
		$postDataSql = DB::getInstance()->get_orderBy('post', array('receiver_id','=',$data->id), "ORDER BY post_id DESC");
		foreach ($postDataSql->results() as $postDataSql) {
			$username = DB::getInstance()->get('users', array('id','=',$postDataSql->user_id));
		 ?>
			<div class="post">
				<div class="post_header">
					<a href="profile.php?user=<?php echo escape($username->first()->username); ?>" class = "register_link"><?php echo escape($username->first()->username); ?></a> says:
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
}//foreach() 
}//else
?>

<?php include 'includes/overall/overallFooter.php'; ?>