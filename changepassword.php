<?php
require_once 'core/init.php';
include 'includes/overall/overallHeader.php';
$user = new User();

if(!$user->isLoggedIn()){
	//Redirect::to('index.php');
}

if (Input::exists()) {	
		$validate = new Validate();
		$validation = $validate->check($_POST, array( 
			'password_new' => array(
				'required' => true,
				'min' => 6
			), 
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new'
			)
		));
		if ($validation->passed()) {
			//change the password. check if the password match.

			 
				//this is where we change our password
/*

'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,

*/
				$salt = Hash::salt(32);
				$user->changepassword(array(
					'password' => Hash::make(Input::get('password_new'), $salt),
					'salt' => $salt
				), array('username', '=' , Input::get('username')));

				Session::flash('home', 'Your password have been changed!');
				Redirect::to('index.php');
			//get('post', array('receiver_id','=',$user->data()->id));
		} else {
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
}
?>
<form action="" method="post">
	<div>
		<label for="username">What is your username</label>
		<input type="text" name="username">
	</div>
	<div class="field">
		<label for="password_new"> New password</label>
		<input type="password" name="password_new" id="password_new">
	</div>
	<div class="field">
		<label for="password_new_again">New password again</label>
		<input type="password" name="password_new_again" id="password_new_again">
	</div>
	<div>
		<label for="question">What is the answer to you secret question?</label>
		<input type="text" name="question">
	</div>
	<input type="submit" value="Change">
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
</form>

<?php include 'includes/overall/overallFooter.php'; ?>