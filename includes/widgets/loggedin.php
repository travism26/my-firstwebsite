<div>
	<p>Here is where you can search for users.</p>
	<center>
	<input style="width: 90%;" class="search_bar" type="text" id="name" onkeyup="getUsername(this.value)" autocomplete='off'>
	</center>
	<div id="results">			
	</div>
	<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<script src ="js/global.js"></script>
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
			echo '<img src= "', $user->data()->profile_pic, '" alt="'. $user->data()->first_name .'-Profile">';
		}

		?>
		<form action="" method="post" enctype="multipart/form-data">
			<input type="file" name="profile">
			<input type="submit">
		</form>
	</div>
</div>