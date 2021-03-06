<?php
require_once 'core/init.php';

if(Input::exists()){
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
				?><script>window.location = "index.php";</script><?php
				//Redirect::to('index.php');
			} else {
				$validation->addError("Sorry, username or password are incorrect please try again");
			}

		} else {
			//errors exist and output errors
		}

	}
}
include 'includes/overall/overallHeader.php'
?>


<?php
	include 'includes/overall/overallFooter.php';
?>