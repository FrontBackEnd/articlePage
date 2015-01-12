<?php

switch($_POST['action']){
	
	case 'ADD':

			$sql_cat = " SELECT * FROM `ap_categories` WHERE `status` = '1' ORDER BY `position`";
			$result_cat = mysqli_query($conn,$sql_cat);
			
			echo '
				<h1 class="text-center">Add article</h1>
				<form method="POST" action="" enctype="multipart/form-data">
					
					<div class="form-group">
						<label for="title">Title</label>
						<input id="title" type="text" name="title" required="required" class="form-control">
					</div>
						
					<div class="form-group">
						<label for="intro_text">Intro text</label>
						<textarea name="intro_text" required="required" class="form-control"></textarea>
					</div>
					
					<div class="form-group">
						<label for="content">Content</label>
						<textarea name="content" required="required" class="form-control"></textarea>
					</div>
					
					<div class="form-group">
						<label for="file">Image:</label> 
						<input type="file" name="file" id="file">
					</div>
					
					<div class="form-group">
						<label for="category_id">Category</label>
						<select name="category_id" class="form-control">
							<option value="0">Not selected</option>
							';
							if(mysqli_num_rows($result_cat)){
								while($categ = mysqli_fetch_assoc($result_cat)){
									echo '<option value="'.$categ['id'].'">'.$categ['title'].'</option>';
								}
							}
				echo	'
						</select>
					</div>
					
					
					<div class="form-group">
						<label for="status">Active</label>
						<select name="status" class="form-control">
							<option value="0">Not selected</option>
							';
							foreach($article_status AS $key => $name){
								echo '<option value="'.$key.'">'.$name.'</option>';
							}
				echo	'
						</select>
					</div>
					
					<div class="form-group">
						<label for="extract">Extract</label>
						<select name="extract" class="form-control">
							<option value="0">Not selected</option>
							';
					foreach($article_extract AS $key => $name){
						echo '<option value="'.$key.'">'.$name.'</option>';
					}
				echo	'
						</select>
					</div>
					
					<input type="submit" name="save_article" value="ADD" class="btn btn-success">
				</form>
			';
		
		break;
		
	case 'UPDATE':
		
		if(isset($_POST['article_id']) && !empty($_POST['article_id'])){
			$id = $_POST['article_id'];
			
			$sql="SELECT * FROM `ap_articles` WHERE `id` = '$id'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				
				$sql_cat = " SELECT * FROM `ap_categories` WHERE `status` = '1' ORDER BY `position`";
				$result_cat = mysqli_query($conn,$sql_cat);	
				
				
			echo '
				<h1 class="text-center">Add article</h1>
				<form method="POST" action="" enctype="multipart/form-data"enctype="multipart/form-data">
					<input type="hidden" name="article_id" value="'.$id.'">
					
					<div class="form-group">
						<label for="title">Title</label>
						<input id="title" type="text" name="title" value="'.$row['title'].'" required="required" class="form-control">
					</div>
						
					<div class="form-group">
						<label for="intro_text">Intro text</label>
						<textarea name="intro_text" required="required" class="form-control">'.$row['intro_text'].'</textarea>
					</div>
					
					<div class="form-group">
						<label for="content">Content</label>
						<textarea name="content" required="required" class="form-control">'.$row['content'].'</textarea>
					</div>';
					
					if(isset($row['image']) && !empty($row['image'])) 
						echo '<p><img src="http://localhost/articlepage.front-back-end.com/apcms/upload/'.$row['image'].'" alt="" style="width:200px;height:150px;"></p>
							  <p>DELETE IMG<input type="checkbox" name="delete_article_img" value="delete"></p>';
					else{
						echo '<div class="form-group">
								<label for="file">Image:</label> 
								<input type="file" name="file" id="file">
							</div>';
					}
					
					
				echo '	
					<div class="form-group">
						<label for="category_id">Category</label>
						<select name="category_id" class="form-control">
							<option value="0">Not selected</option>
							';
							if(mysqli_num_rows($result_cat)){
								while($categ = mysqli_fetch_assoc($result_cat)){
									if($row['category_id'] == $categ['id']) $sel = ' selected="selected"'; 
									else $sel = '';
									
									echo '<option value="'.$categ['id'].'"'.$sel.'>'.$categ['title'].'</option>';
								}
							}
				echo	'
						</select>
					</div>
					
					
					<div class="form-group">
						<label for="status">Active</label>
						<select name="status" class="form-control">
							<option value="0">Not selected</option>
							';
							foreach($article_status AS $key => $name){
								if($key == $row['status']) $sel = ' selected="selected"';
								else $sel = '';
								
								echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
							}
				echo	'
						</select>
					</div>
					
					<div class="form-group">
						<label for="extract">Extract</label>
						<select name="extract" class="form-control">
							<option value="0">Not selected</option>
							';
							foreach($article_extract AS $key => $name){
								if($key == $row['extract']) $sel = ' selected="selected"';
								else $sel = '';
								
								echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
							}
				echo	'
						</select>
					</div>
					
					<input type="submit" name="save_article" value="UPDATE" class="btn btn-default">
				</form>';
				
			}else echo 'Not found article with ID'.$_POST['article_id'];
		}
		
		
		break;
		
	case 'DELETE':
		
		if(isset($_POST['article_id']) && !empty($_POST['article_id'])){
			
			$id = $_POST['article_id'];
			
			echo '
				<h1 class="text-center">Do you realy wont to delete this article ?</h1>
				<form method="POST" action="">
					<input type="hidden" name="article_id" value="'.$id.'">
					<input type="submit" name="save_article" value="DELETE" class="btn btn-danger">
					<input type="submit" name="no" value="NO" class="btn btn-default">
				</form>';
			
		}else echo 'Not found article with ID'.$_POST['article_id'];
			
		break;
	
}
?>