<?php
require_once 'core/init.php';

include 'includes/overall/overallHeader.php';

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()){
	//echo "in the input exists ";
	//echo Token::check(Input::get('token'));
	if (Token::check(Input::get('token'))) {
		
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));
		if($validation->passed()){	
			//update function for updating the users full name
			try{
				$user->update('users', array(
					'first_name' => Input::get('name')
				), array('id','=',$user->data()->id));

				Session::flash('home', 'Your Details have been updated!');
				Redirect::to('index.php');
			} catch(Exception $e) {
				die($e->getMessage());
			}
		} else {
			foreach ($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}

	}
}
?>

<form action="" method="post">
	<div class="field">
		<label for="name">Name</label>
		<input type="text" name="name" value="<?php echo escape($user->data()->first_name); ?>">
		<input type="submit" value="Update">
		<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
	</div>
</form>

<?php include 'includes/overall/overallFooter.php'; ?>