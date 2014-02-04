<?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php'; ?>

	<div class="profile">
		<?php		
		if (isset($_FILES['profile']) === true) {
			if(Input::get('delete') && file_exists($user->data()->profile_pic)===true) {
				echo $user->data()->profile_pic;
				unlink($user->data()->profile_pic);
					$user->update(array(
						'profile_pic' => ""
					));
					?><script>window.location = "index.php";</script><?php
			}else if (empty($_FILES['profile']['name']) === true){
				echo "Please choose a file";
			}else{
				$allow = array('jpg', 'jpeg','gif', 'png');
				$file_name = $_FILES['profile']['name'];  //biginner.png
				$file_extn = strtolower(end(explode('.', $file_name)));
				$file_temp = $_FILES['profile']['tmp_name'];
				if(in_array($file_extn, $allow)){
					//$user->update($user->data()->id, $file_temp);
					if(file_exists($user->data()->profile_pic)){
						echo "NOT EMPTY";
					}
					$user->change_profile_image(array(
							'profile_pic' => $file_temp,
							'file_extn' => $file_extn
						),$user->data()->id);
					echo "Success";
					//echo $file_temp;
				} else{
					echo "Incorrect file type. Allowed: ";
					echo implode(', ', $allow);
				}
			}
			
		}
		if (empty($user->data()->profile_pic) === false && file_exists($user->data()->profile_pic)) {
			echo '<img src= "', $user->data()->profile_pic, '" alt="'. $user->data()->first_name .'-Profile" class = "profile_picture">';
		}
		?>
		<form action = "" method="post" enctype="multipart/form-data">
			<input type="file" name="profile">
			<input type="submit">
			<input type="submit" name="delete" value="Delete">
		</form>
	</div>

<?php include 'includes/overall/overallFooter.php'; ?>