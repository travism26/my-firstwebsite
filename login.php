<?php
require_once 'core/init.php';

if(Input::exists()){
	echo "in the input exists ";
	echo Token::check(Input::get('token'));
	if (Token::check(Input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
			));
		if($validation->passed()){
			//log user in
			$user = new User();

			$remember = (Input::get('remember') =='on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login){
				Redirect::to('index.php');
			} else {
				echo "<p>Sorry, logging in failed.</p>";
			}

		} else {
			
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}

	}
}
include 'includes/overall/overallHeader.php'
?>


<?php
	include 'includes/overall/overallFooter.php';
?>