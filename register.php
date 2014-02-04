
<?php

require_once 'core/init.php';
if(Input::exists()){
	if(Token::check(Input::get('register_token'))){

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6
			), 
			'password_again' => array(
				'required'=> true,
				'matches' => 'password'
			), 
			'first_name' => array(
				'min' => 2,
				'max' => 25
			),
			'last_name' => array(
				'min' => 2,
				'max' => 25
			),
			'email' => array(
				'min' => 2,
				'max' => 55
			)		
		));

		if($validation->passed()){
			$user = new User();
			$salt = Hash::salt(32);

			try{
				//This is where we get the input values from the form
				$user->create(array(
					'username' => Input::get('username') ,
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'first_name' => Input::get('first_name'),
					'last_name' => Input::get('last_name'),
					'email' => Input::get('email'),
					'joined' => date('Y-m-d H:i:d'),
					'group' => 1
				));
			Session::flash('home', 'You registered successfully!');
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);
			?><script>window.location = "index.php";</script><?php
			//Redirect::to('index.php');

			} catch(Exception $e){
				die($e->getMessage());
			}
			
		}else{
			//there are errors and output them
		}
	}
}
include 'includes/overall/overallHeader.php';
?>
<div>
	<form action="" method="post" name ="register">
		<div class="field">
			<label for="username">Username</label>
			<input type="text" name="username" id="username" value="<?PHP echo escape(Input::get('username'));?>" autocomplete = "off">
		</div>

		<div class="field">
			<label for="password">Choose a password</label>
			<input type="password" name="password" id="password">
		</div>

		<div class="field">
			<label for="password_again">Password again</label>
			<input type="password" name="password_again" id="password_again">
		</div>
		<div class="field">
			<label for="first_name">First Name</label>
			<input type="text" name="first_name" id="name" value="<?PHP echo escape(Input::get('first_name'));?>">
		</div>
		<div class="field">
			<label for="last_name">Last Name</label>
			<input type="text" name="last_name" id="name" value="<?PHP echo escape(Input::get('last_name'));?>">
		</div>
		<div class="field">
			<label for="email">Email</label>
			<input type="text" name="email" id="name" value="<?PHP echo escape(Input::get('email'));?>">
		</div>		
		<input type="hidden" name="register_token" value="<?php echo Token::generate(); ?>">
		<input type="submit" value="Register">
	</form>
</div>
<?php include 'includes/overall/overallFooter.php'; ?>
