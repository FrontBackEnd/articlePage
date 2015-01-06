<?php

switch($_POST['action']){
	
	case 'ADD':
		
			echo '
				<form method="POST" action="">
					
					<p>Title</p>
					<input type="text" name="title" required="required">
								
					<p>Position</p>
					<input type="text" name="position" required="required">		
					
					<p>Active</p>
					<select name="status">
					';
					foreach($categories_status AS $key => $name){
						echo '<option value="'.$key.'">'.$name.'</option>';
					}
			echo'
					</select>
					
					<p><input type="submit" name="save_categories" value="ADD"></p>
				</form>
			';
		
		break;
		
	case 'UPDATE':
		
		if(isset($_POST['category_id']) && !empty($_POST['category_id'])){
			$id = $_POST['category_id'];
			
			$sql="SELECT * FROM `ap_categories` WHERE `id` = '$id'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				
				echo '
					<form method="POST" action="">
						<input type="hidden" name="category_id" value="'.$id.'">
						
						<p>Title</p>
						<input type="text" name="title" value="'.$row['title'].'">
						
						<p>Position</p>
						<input type="text" name="position" value="'.$row['position'].'" required="required">	

						<p>Active</p>
						<select name="status">
						';
						foreach($categories_status AS $key => $name){
							if($key == $row['status']) $sel = ' selected="selected"';
							else $sel = '';
							
							echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
						}
				echo'
						</select>
						
						<p><input type="submit" name="save_categories" value="UPDATE"> </p>
					</form>';
				
			}else echo 'Not found category with ID'.$_POST['category_id'];
		}
		
		
		break;
		
	case 'DELETE':
		
		if(isset($_POST['category_id']) && !empty($_POST['category_id'])){
			
			$id = $_POST['category_id'];
			echo '
				<form method="POST" action="">
					<input type="hidden" name="category_id" value="'.$id.'">
					<p>Do you realy wont to delete this category ?</p>
					<p><input type="submit" name="save_categories" value="DELETE"></p>
					<p><input type="submit" name="no" value="NO"></p>
				</form>';
			
		}else echo 'Not found category with ID'.$_POST['category_id'];
			
		break;
	
}
?>