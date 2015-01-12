<?php

if(isset($error) && !empty($error)) echo $error;

if(isset($_SESSION['user']) && !empty($_SESSION['user'])){
	
	echo '
		<form method="POST" method="" >
			<button type="button" class="btn btn-default">
				<span class="glyphicon glyphicon-user"></span><small style="margin-left:5px;">'.$_SESSION['user'].'</small>
			</button>
			<a class="btn btn-info" href="?menu=change_password">Change password</a>
			<input type="submit" class="btn btn-default" value="LOGOUT" name="user_logout">
		</form>
		';
	
	
}else{	
	
	echo '
			<h1 class="text-center" style="margin:60px 0;">Article page</h1>
			<form method="POST" action="">
				<div class="form-group">
					<label for="email">Email:</label>
					<input id="email" type="email" name="email"  class="form-control">
				</div>
				
				<div class="form-group">	
					<label for="password"> Password:</label> 
					<input id="password" type="password" name="password"  class="form-control">
				</div>
				
				<input type="submit" class="btn btn-default" value="LOGIN" name="user_login">
			</form>
		';

}

?>