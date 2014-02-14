	<nav>
		<ul id = "topnav">
			<li><a href="index.php">Home</a></li>
			<li><a href="">Current Projects</a>
				<ul id = "subnav">
					<li class = ""><a href="workout.php">Workout Manager</a></li>
					<li><a href="user_settings.php">User Settings</a></li>
					<li><a href="admin_page.php">All Users</a></li>
					<li><a href="changepassword.php">Change Password</a></li>
				</ul>
			</li>
			<li><a href="">Web Templates</a>
				<ul id = "subnav">
					<li><a href="#">Template1</a></li>
					<li><a href="#">Template2</a></li>
					<li><a href="#">Template3</a></li>
				</ul>
			</li>
			<li><a href="">Web Applications</a></li>
			<li><a href="">Contact Me</a></li>
			<div class="search">	
				<input style="width: 90%;" class="search_bar" type="text" id="name" onkeyup="getUsername(this.value)" autocomplete='off'>
				<div id="results">			
				</div>
			</div>
				<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
				<script src ="js/global.js"></script>
		</ul>
	</nav>