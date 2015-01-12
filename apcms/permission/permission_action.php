<?php

switch($_POST['save_permission']){
			
	case 'UPDATE':
		
		if(isset($_POST['permission_id']) && !empty($_POST['permission_id'])){
		
			$id = $_POST['permission_id'];
			
			$changed_date = date("Y-m-d H:i:s",time());
			$changed_user = $_SESSION['user'];
			
			if(isset($_POST['view']) && !empty($_POST['view'])) $view = implode(', ',$_POST['view']);
			else $view = '';
			
			if(isset($_POST['add']) && !empty($_POST['add'])) $add = implode(', ',$_POST['add']);
			else $add = '';
			
			if(isset($_POST['update']) && !empty($_POST['update'])) $update = implode(', ',$_POST['update']);
			else $update = '';
			
			if(isset($_POST['delete']) && !empty($_POST['delete'])) $delete = implode(', ',$_POST['delete']);
			else $delete = '';
			
			$sql="UPDATE 
					`ap_permission` 
				  SET 
				  	`view` = '".$view."',
				  	`add` = '".$add."',
				  	`update` = '".$update."',
				  	`delete` = '".$delete."',
				  	`changed_date` = '".$changed_date."',
				  	`changed_user` = '".$changed_user."'
				  WHERE  
				  	`id` = '".$id."'";
			
			if(mysqli_query($conn,$sql)) echo 'User updated';
			
		}else $error = 'Please enter title';
		
		break;	

}

?>