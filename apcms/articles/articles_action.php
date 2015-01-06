<?php

switch($_POST['save_article']){
	
	case 'ADD':
		
		if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['intro_text']) && !empty($_POST['intro_text'])){

			$title = strip_tags($_POST['title']);
			$intro_text = strip_tags($_POST['intro_text']);
			$content = strip_tags($_POST['content']);
			
			$category_id = $_POST['category_id'];
			
			$status = $_POST['status'];
			$extract = $_POST['extract'];
			
			$created_date = date("Y-m-d H:i:s",time());
			$created_user = $_SESSION['user'];
			
			$sql = "INSERT INTO `ap_articles` 
					(`title`,`intro_text`,`content`,`category_id`,`status`,`extract`,`created_date`,`created_user`) 
					VALUES 
					('".$title."','".$intro_text."','".$content."','".$category_id."','".$status."','".$extract."','".$created_date."','".$created_user."')";
			
			if(mysqli_query($conn,$sql)) echo 'Article saved';
			
		}else $error = 'Please enter title and intro text';
		
		
		break;
		
	case 'UPDATE':
		
		if(isset($_POST['title']) && !empty($_POST['title']) && isset($_POST['intro_text']) && !empty($_POST['intro_text'])){
		
			$id = $_POST['article_id'];
			
			$title = strip_tags($_POST['title']);
			$intro_text = strip_tags($_POST['intro_text']);
			$content = strip_tags($_POST['content']);
			
			$category_id = $_POST['category_id'];
			
			$status = $_POST['status'];
			$extract = $_POST['extract'];
			
			$changed_date = date("Y-m-d H:i:s",time());
			$changed_user = $_SESSION['user'];
			
			$sql="UPDATE 
					`ap_articles` 
				  SET 
				  	`title` = '".$title."', 
				  	`intro_text` = '".$intro_text."', 
				  	`content` = '".$content."',
				  	`category_id` = '".$category_id."',
				  	`status` = '".$status."',
				  	`extract` = '".$extract."',
				  	`changed_date` = '".$changed_date."',
				  	`changed_user` = '".$changed_user."'
				  WHERE  
				  	`id` = '{$id}'";
			
			if(mysqli_query($conn,$sql)) echo 'Article updated';
			
		}else $error = 'Please enter title and intro text';
		
		break;	
	
	case 'DELETE':
		
		$id = $_POST['article_id'];

		$sql= " DELETE FROM `ap_articles` WHERE `id` = '{$id}'";
		
		if(mysqli_query($conn,$sql)) echo 'Article deleted';
		
		
		break;	
}

?>