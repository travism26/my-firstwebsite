<?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php'; ?>

	<div class="profile">
		<?php		
		if (isset($_FILES['profile']) === true) {
			if (empty($_FILES['profile']['name']) === true){
				echo "Please choose a file";
			}else{
				$allow = array('jpg', 'jpeg','gif', 'png');
				
				$file_name = $_FILES['profile']['name'];  //biginner.png
				$file_extn = strtolower(end(explode('.', $file_name)));

				$file_temp = $_FILES['profile']['tmp_name'];

				if(in_array($file_extn, $allow)){
					//$user->update($user->data()->id, $file_temp);
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
		if (empty($user->data()->profile_pic) === false) {
			echo '<img src= "', $user->data()->profile_pic, '" alt="'. $user->data()->first_name .'-Profile" class = "profile_picture">';
		}

		?>
		<form action = "" method="post" enctype="multipart/form-data">
			<input type="file" name="profile">
			<input type="submit">
		</form>
	</div>

<?php include 'includes/overall/overallFooter.php'; ?>