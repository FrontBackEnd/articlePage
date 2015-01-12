<?php

if(isset($_POST['change_password']) && !empty($_POST['change_password']) && $_POST['change_password'] == 'Change password'){
	
	$sql="UPDATE `ap_users` 
		  SET `password` = '".$_POST['new_password']."'
		  WHERE  `email` = '".$_SESSION['user']."'";
				
	if(mysqli_query($conn,$sql)) echo '<p>Password changed</p>';	
	
}


echo '
		<h1 class="text-center">Change password</h1>
			<form method="POST" action="">
				<div class="form-group">
					<label for="new_password">New password</label>
					<input id="new_password" type="password" name="new_password" class="form-control">
				</div>	
				
				<input type="submit" class="btn btn-success dropdown-toggle" name="change_password" value="Change password">
				<a class="btn btn-danger dropdown-toggle" href="?menu=none">NO</a>
			</form>';

?>