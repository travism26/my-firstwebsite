<?php
	require_once 'core/init.php';
if (isset($_POST['partialName']) === true && empty($_POST) === false) {
	$usernames = $_POST['partialName'];
	//echo $usernames;
	$search_username = DB::getInstance()->getSearch('users', array('first_name','like', "%".$usernames ."%"));
	if ($_POST['partialName'] === "") {
		echo "";
	}else{
		foreach ($search_username->results() as $name) {
			//$username = DB::getInstance()->get('users', array('username','like',$usernames));
			?><div class="search_results" style="list-style:none;">
			<a href="profile.php?user=<?php echo $name->username; ?>">
			<?php 
			echo $name->first_name." ";
			echo $name->last_name;
			 ?>
			</a></div><?php
			//$post_user_data = $username->results();
		}//foreach loop
	}
} else {
	echo "hello";
}
?>
<style type="text/css">
	<?php include 'css/search.css'; ?>
</style>