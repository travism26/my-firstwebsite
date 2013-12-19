
<?php

require_once 'core/init.php';

if(Input::exists()){
echo "Submitted";
	if(Token::check(Input::get('token'))){

		echo "This code was no run";
		echo "Submitted";
		//echo Input::get('username');
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
				'min' => 6,
			), 
			'password_again' => array(
				'required'=> true,
				'matches' => 'password'
			), 
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));

		if($validation->passed()){
			$user = new User();
			
			$salt = Hash::salt(32);
			//die();

			try{

				$user->create(array(
					'username' => Input::get('username') ,
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'name' => Input::get('name'),
					'joined' => date('Y-m-d H:i:d'),
					'group' => 1
				));
			
			Session::flash('home', 'You registered successfully!');
			Redirect::to('index.php');

			} catch(Exception $e){
				die($e->getMessage());
			}
			
		}else{
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}
include 'includes/overall/overallHeader.php';
//this var dump was used to check if my token on this page
//return false if i tried to do CSRF
//var_dump(Token::check(Input::get('token')));
?>
<form action="register.php" method="post" name ="register">
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
		<label for="name">Enter your name</label>
		<input type="text" name="name" id="name" value="<?PHP echo escape(Input::get('name'));?>">
	</div>
	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	<input type="submit" value="Register">
</form>

<?php include 'includes/overall/overallFooter.php'; ?>
