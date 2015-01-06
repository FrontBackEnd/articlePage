<?php

if(isset($_POST['user_login']) && !empty($_POST['user_login']) && $_POST['user_login'] == 'LOGIN'){

	if(isset($_POST['email']) && !empty($_POST['email'])){
		
		if(isset($_POST['password']) && !empty($_POST['password'])){
		
			$email = strip_tags($_POST['email']);
			$password = strip_tags($_POST['password']);
			
			$sql = "SELECT `email`,`password` FROM `ap_users` WHERE `status` = '1' AND `email` = '".$email."'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				
				if($row['password']  == $password){
				
					echo 'Loged in!!';
					$_SESSION['user'] = $row['email'];
					
				}else $error =  'Wrong pasword';
				
			}else $error =  'User not found';
			
		}else $error =  'Please enter password';
		
	}else $error =  'Please enter email';
	
}elseif(isset($_POST['user_logout']) && !empty($_POST['user_logout']) && $_POST['user_logout'] == 'LOGOUT'){
	
	unset($_SESSION['user']);

}

?>