<?php

switch($_POST['save_roles']){
	
	case 'ADD':
		
		if(isset($_POST['title']) && !empty($_POST['title'])){

			$title = strip_tags($_POST['title']);
			
			$status = $_POST['status'];
			
			$created_date = date("Y-m-d H:i:s",time());
			$created_user = $_SESSION['user'];
			
			$sql = "INSERT INTO `ap_roles` 
					(`title`,`status`,`created_date`,`created_user`) 
					VALUES 
					('".$title."','".$status."','".$created_date."','".$created_user."')";
			
			if(mysqli_query($conn,$sql)) echo 'Role saved';
			
		}else $error = 'Please enter title';
		
		
		break;
		
	case 'UPDATE':
		
		if(isset($_POST['title']) && !empty($_POST['title'])){
		
			$id = $_POST['role_id'];
			
			$title = strip_tags($_POST['title']);
			
			$status = $_POST['status'];
			
			$changed_date = date("Y-m-d H:i:s",time());
			$changed_user = $_SESSION['user'];
			
			$sql="UPDATE 
					`ap_roles` 
				  SET 
				  	`title` = '".$title."', 
				  	`status` = '".$status."',
				  	`changed_date` = '".$changed_date."',
				  	`changed_user` = '".$changed_user."'
				  WHERE  
				  	`id` = '".$id."'";
			
			if(mysqli_query($conn,$sql)) echo 'Role updated';
			
		}else $error = 'Please enter title';
		
		break;	
	
	case 'DELETE':
		
		$id = $_POST['role_id'];

		$sql= " DELETE FROM `ap_roles` WHERE `id` = '".$id."'";
		
		if(mysqli_query($conn,$sql)) echo 'Role deleted';
		
		
		break;	
}

?>