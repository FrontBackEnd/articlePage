<?php

switch($_POST['action']){
	
	case 'ADD':

			$sql_cat = " SELECT * FROM `ap_categories` WHERE `status` = '1' ORDER BY `position`";
			$result_cat = mysqli_query($conn,$sql_cat);
			
			echo '
				<form method="POST" action="">
					
					<p>Title</p>
					<input type="text" name="title" required="required">
										
					<p>Intro text</p>
					<textarea name="intro_text" required="required"></textarea>
					
					<p>Content</p>
					<textarea name="content" required="required"></textarea>
					
					<p>Category</p>
					<select name="category_id">
						<option value="0">Not selected</option>
					';
					if(mysqli_num_rows($result_cat)){
						while($categ = mysqli_fetch_assoc($result_cat)){
							echo '<option value="'.$categ['id'].'">'.$categ['title'].'</option>';
						}
					}
			echo	'
					</select>
					
					<p>Active</p>
					<select name="status">
					';
					foreach($article_status AS $key => $name){
						echo '<option value="'.$key.'">'.$name.'</option>';
					}
			echo'
					</select>
					
					<p>Extract</p>
					<select name="extract">
					';
					foreach($article_extract AS $key => $name){
						echo '<option value="'.$key.'">'.$name.'</option>';
					}
			echo'
					</select>
					
					<p><input type="submit" name="save_article" value="ADD"></p>
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
					<form method="POST" action="">
						<input type="hidden" name="article_id" value="'.$id.'">
						
						<p>Title</p>
						<input type="text" name="title" value="'.$row['title'].'">
						
						<p>Intro text</p>
						<textarea name="intro_text" required="required">'.$row['intro_text'].'</textarea>
						
						<p>Content</p>
						<textarea name="content">'.$row['content'].'</textarea>
						
						<p>Category</p>
						<select name="category_id">
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
						
						<p>Active</p>
						<select name="status">
						';
						foreach($article_status AS $key => $name){
							if($key == $row['status']) $sel = ' selected="selected"';
							else $sel = '';
							
							echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
						}
				echo'
						</select>
						
						<p>Extract</p>
						<select name="extract">
						';
						foreach($article_extract AS $key => $name){
							if($key == $row['extract']) $sel = ' selected="selected"';
							else $sel = '';
							
							echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
						}
				echo'
						</select>
						
						
						<p><input type="submit" name="save_article" value="UPDATE"> </p>
					</form>';
				
			}else echo 'Not found article with ID'.$_POST['article_id'];
		}
		
		
		break;
		
	case 'DELETE':
		
		if(isset($_POST['article_id']) && !empty($_POST['article_id'])){
			
			$id = $_POST['article_id'];
			echo '
				<form method="POST" action="">
					<input type="hidden" name="article_id" value="'.$id.'">
					<p>Do you realy wont to delete this article ?</p>
					<p><input type="submit" name="save_article" value="DELETE"></p>
					<p><input type="submit" name="no" value="NO"></p>
				</form>';
			
		}else echo 'Not found article with ID'.$_POST['article_id'];
			
		break;
	
}
?>