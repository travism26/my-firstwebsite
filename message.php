<?php 
require_once 'core/init.php';

include 'includes/overall/overallHeader.php'; ?>


			<div class="post">
				<div class="post_header">
					<a href="#" class = "register_link">Travis: </a> says:
					<input type="image" src="images/icons/delete.png" style="float:right;" name="deletePost">
					<input type="hidden" id="" value="">
					
				</div>
				<div class="post_message">
					<p>
					<?php
						echo "Hello", '<br>';
					?>
					</p>
				</div>
			</div>
			<div class="comment">
				<div class="comment_header">
					This is a comment!
				</div>
			</div>



<?php include 'includes/overall/overallFooter.php'; ?>