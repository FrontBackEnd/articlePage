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
			
			$img_name = '';
			
			if(isset($_FILES["file"]) && !empty($_FILES["file"])){
				
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES["file"]["name"]);
				$extension = end($temp);
				
				if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				|| ($_FILES["file"]["type"] == "image/pjpeg")
				|| ($_FILES["file"]["type"] == "image/x-png")
				|| ($_FILES["file"]["type"] == "image/png"))
				&& ($_FILES["file"]["size"] < 2097152)
				&& in_array($extension, $allowedExts)) {
				  if ($_FILES["file"]["error"] > 0)  echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
				  else {
				    $img_name = $_FILES["file"]["name"];
				    if (file_exists("C:/xampp/htdocs/articlepage.front-back-end.com/apcms/upload/" . $_FILES["file"]["name"])) echo $_FILES["file"]["name"] . " already exists. ";
				    else  move_uploaded_file($_FILES["file"]["tmp_name"],"C:/xampp/htdocs/articlepage.front-back-end.com/apcms/upload/" . $_FILES["file"]["name"]);
				  }
				}else echo "Invalid file";
			}
			
			$sql = "INSERT INTO `ap_articles` 
					(`title`,`intro_text`,`content`,`category_id`,`status`,`extract`,`created_date`,`created_user`".(isset($img_name) && !empty($img_name) ? ',`image`' : '').") 
					VALUES 
					('".$title."','".$intro_text."','".$content."','".$category_id."','".$status."','".$extract."','".$created_date."','".$created_user."'".(isset($img_name) && !empty($img_name) ? "'".$img_name."'" : '').")";
			
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
			
			
			if(isset($_POST['delete_article_img']) && !empty($_POST['delete_article_img']) && $_POST['delete_article_img'] == 'delete'){
	
				$sql="SELECT `image` FROM `ap_articles` WHERE `id` = '$id'";
				$result = mysqli_query($conn,$sql);
					if(mysqli_num_rows($result)) $img = mysqli_fetch_assoc($result);
						unlink('C:/xampp/htdocs/articlepage.front-back-end.com/apcms/upload/'.$img['image']);
				
				$sql="UPDATE `ap_articles`   SET `image` ='' WHERE  `id` = '{$id}'";
				if(mysqli_query($conn,$sql)) echo '<p>Img deleted</p>';
				
			}
			
			$img_name = '';
			
			if(isset($_FILES["file"]) && !empty($_FILES["file"])){
				
				$allowedExts = array("gif", "jpeg", "jpg", "png");
				$temp = explode(".", $_FILES["file"]["name"]);
				$extension = end($temp);
			
				if ((($_FILES["file"]["type"] == "image/gif")
				|| ($_FILES["file"]["type"] == "image/jpeg")
				|| ($_FILES["file"]["type"] == "image/jpg")
				|| ($_FILES["file"]["type"] == "image/pjpeg")
				|| ($_FILES["file"]["type"] == "image/x-png")
				|| ($_FILES["file"]["type"] == "image/png"))
				&& ($_FILES["file"]["size"] < 2097152)
				&& in_array($extension, $allowedExts)) {
				  if ($_FILES["file"]["error"] > 0)  echo "Return Code: " . $_FILES["file"]["error"] . "<br>";
				  else {
				    $img_name = $_FILES["file"]["name"];
				    if (file_exists("C:/xampp/htdocs/articlepage.front-back-end.com/apcms/upload/" . $_FILES["file"]["name"])) echo $_FILES["file"]["name"] . " already exists. ";
				    else  move_uploaded_file($_FILES["file"]["tmp_name"],"C:/xampp/htdocs/articlepage.front-back-end.com/apcms/upload/" . $_FILES["file"]["name"]);
				  }
				}else echo "Invalid file";
			}
			
			
			
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
				  	".(isset($img_name) && !empty($img_name) ? ",`image` ='".$img_name."'" : '')."
				  	
				  WHERE  
				  	`id` = '".$id."'";
			
			if(mysqli_query($conn,$sql)) echo 'Article updated';
			
		}else $error = 'Please enter title and intro text';
		
		break;	
	
	case 'DELETE':
		
		$id = $_POST['article_id'];

		$sql="SELECT `image` FROM `ap_articles` WHERE `id` = '$id'";
		$result = mysqli_query($conn,$sql);
		if(mysqli_num_rows($result)){
			$img = mysqli_fetch_assoc($result);
			unlink('C:/xampp/htdocs/articlepage.front-back-end.com/apcms/upload/'.$img['image']);
		}
		
		$sql= " DELETE FROM `ap_articles` WHERE `id` = '{$id}'";
		
		if(mysqli_query($conn,$sql)) echo 'Article deleted';
		
		
		break;	
}

?>