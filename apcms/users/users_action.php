<?php

switch($_POST['save_users']){
	
	case 'ADD':
		
		if(isset($_POST['email']) && !empty($_POST['email'])){

			$email = strip_tags($_POST['email']);
			
			$status = $_POST['status'];
			$password = $_POST['password'];
			
			$role = $_POST['role'];
			
			$created_date = date("Y-m-d H:i:s",time());
			$created_user = $_SESSION['user'];
			
			$sql = "INSERT INTO `ap_users` 
					(`email`,`password`,`role`,`status`,`created_date`,`created_user`) 
					VALUES 
					('".$email."','".$password."','".$role_id."','".$status."','".$created_date."','".$created_user."')";
			
			if(mysqli_query($conn,$sql)) echo 'User saved';
			
		}else $error = 'Please enter title';
		
		
		break;
		
	case 'UPDATE':
		
		if(isset($_POST['email']) && !empty($_POST['email'])){
		
			$id = $_POST['user_id'];
			
			$email = strip_tags($_POST['email']);
			
			$status = $_POST['status'];
			if(isset($_POST['password']) && !empty($_POST['password'])) $password = $_POST['password'];
			
			$role = $_POST['role'];
			
			$changed_date = date("Y-m-d H:i:s",time());
			$changed_user = $_SESSION['user'];
			
			$sql="UPDATE 
					`ap_users` 
				  SET 
				  	`email` = '".$email."', 
				  	".(isset($password) && !empty($password) ? "`password` = '".$password."'," : '')."
				  	`status` = '".$status."',
				  	`role` = '".$role."',
				  	`changed_date` = '".$changed_date."',
				  	`changed_user` = '".$changed_user."'
				  WHERE  
				  	`id` = '".$id."'";
			
			if(mysqli_query($conn,$sql)) echo 'User updated';
			
		}else $error = 'Please enter title';
		
		break;	
	
	case 'DELETE':
		
		$id = $_POST['user_id'];

		$sql= " DELETE FROM `ap_users` WHERE `id` = '".$id."'";
		
		if(mysqli_query($conn,$sql)) echo 'User deleted';
		
		
		break;	
}

?>