<?php

switch($_POST['save_categories']){
	
	case 'ADD':
		
		if(isset($_POST['title']) && !empty($_POST['title'])){

			$title = strip_tags($_POST['title']);
			
			$status = $_POST['status'];
			$position = $_POST['position'];
			
			$created_date = date("Y-m-d H:i:s",time());
			$created_user = $_SESSION['user'];
			
			$sql = "INSERT INTO `ap_categories` 
					(`title`,`position`,`status`,`created_date`,`created_user`) 
					VALUES 
					('".$title."','".$position."','".$status."','".$created_date."','".$created_user."')";
			
			if(mysqli_query($conn,$sql)) echo 'Category saved';
			
		}else $error = 'Please enter title';
		
		
		break;
		
	case 'UPDATE':
		
		if(isset($_POST['title']) && !empty($_POST['title'])){
		
			$id = $_POST['category_id'];
			
			$title = strip_tags($_POST['title']);
			
			$status = $_POST['status'];
			$position = $_POST['position'];
			
			$changed_date = date("Y-m-d H:i:s",time());
			$changed_user = $_SESSION['user'];
			
			$sql="UPDATE 
					`ap_categories` 
				  SET 
				  	`title` = '".$title."', 
				  	`position` = '".$position."',
				  	`status` = '".$status."',
				  	`changed_date` = '".$changed_date."',
				  	`changed_user` = '".$changed_user."'
				  WHERE  
				  	`id` = '".$id."'";
			
			if(mysqli_query($conn,$sql)) echo 'Category updated';
			
		}else $error = 'Please enter title';
		
		break;	
	
	case 'DELETE':
		
		$id = $_POST['category_id'];

		$sql= " DELETE FROM `ap_categories` WHERE `id` = '".$id."'";
		
		if(mysqli_query($conn,$sql)) echo 'Category deleted';
		
		
		break;	
}

?>