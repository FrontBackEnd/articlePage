<?php

switch($_POST['action']){
	
	case 'ADD':
		
			echo '
				<h1 class="text-center">Add category</h1>
				<form method="POST" action="">
					
					<div class="form-group">
						<label for="title">Title</label>
						<input id="title" type="text" name="title" required="required" class="form-control">
					</div>

					<div class="form-group">
						<label for="position">Position</label>
						<input id="position" type="text" name="position" required="required" class="form-control">
					</div>
					
					<div class="form-group">
						<label for="status">Active</label>
						<select name="status" class="form-control">';
			
						foreach($categories_status AS $key => $name){
							echo '<option value="'.$key.'">'.$name.'</option>';
						}
			echo	'
						</select>
					</div>
					
					<input type="submit" name="save_categories" value="ADD" class="btn btn-success">
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
					<h1 class="text-center">Update category</h1>
					<form method="POST" action="">
						<input type="hidden" name="category_id" value="'.$id.'">	
					
					
						<div class="form-group">
							<label for="title">Title</label>
							<input id="title" type="text" name="title" value="'.$row['title'].'" required="required" class="form-control">
						</div>
	
						<div class="form-group">
							<label for="position">Position</label>
							<input id="position" type="text" name="position" value="'.$row['position'].'" required="required" class="form-control">
						</div>
						
						<div class="form-group">
							<label for="status">Active</label>
							<select name="status" class="form-control">';
				
							foreach($categories_status AS $key => $name){
								if($key == $row['status']) $sel = ' selected="selected"';
								else $sel = '';
								
								echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
							}
				echo	'
							</select>
						</div>
						
						<input type="submit" name="save_categories" value="UPDATE" class="btn btn-default">
					</form>
				';
				
			}else echo 'Not found category with ID'.$_POST['category_id'];
		}
		
		
		break;
		
	case 'DELETE':
		
		if(isset($_POST['category_id']) && !empty($_POST['category_id'])){
			
			$id = $_POST['category_id'];
			echo '
				<h1 class="text-center">Do you realy wont to delete this category ?</h1>
				<form method="POST" action="">
					<input type="hidden" name="category_id" value="'.$id.'">
					
					<input type="submit" name="save_categories" value="DELETE" class="btn btn-danger">
					<input type="submit" name="no" value="NO" class="btn btn-default">
				</form>';

			
		}else echo 'Not found category with ID'.$_POST['category_id'];
			
		break;
	
}
?>