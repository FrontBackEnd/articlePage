<?php

switch($_POST['action']){
	
	case 'ADD':
		
			echo '
				<form method="POST" action="">
					
					<p>Title</p>
					<input type="text" name="title" required="required">
					
					<p>Active</p>
					<select name="status">
					';
					foreach($roles_status AS $key => $name){
						echo '<option value="'.$key.'">'.$name.'</option>';
					}
			echo'
					</select>
					
					<p><input type="submit" name="save_roles" value="ADD"></p>
				</form>
			';
		
		break;
		
	case 'UPDATE':
		
		if(isset($_POST['role_id']) && !empty($_POST['role_id'])){
			$id = $_POST['role_id'];
			
			$sql="SELECT * FROM `ap_roles` WHERE `id` = '$id'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				
				echo '
					<form method="POST" action="">
						<input type="hidden" name="role_id" value="'.$id.'">
						
						<p>Title</p>
						<input type="text" name="title" value="'.$row['title'].'">
						
						<p>Active</p>
						<select name="status">
						';
						foreach($roles_status AS $key => $name){
							if($key == $row['status']) $sel = ' selected="selected"';
							else $sel = '';
							
							echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
						}
				echo'
						</select>
						
						<p><input type="submit" name="save_roles" value="UPDATE"> </p>
					</form>';
				
			}else echo 'Not found role with ID'.$_POST['role_id'];
		}
		
		
		break;
		
	case 'DELETE':
		
		if(isset($_POST['role_id']) && !empty($_POST['role_id'])){
			
			$id = $_POST['role_id'];
			echo '
				<form method="POST" action="">
					<input type="hidden" name="role_id" value="'.$id.'">
					<p>Do you realy wont to delete this role ?</p>
					<p><input type="submit" name="save_roles" value="DELETE"></p>
					<p><input type="submit" name="no" value="NO"></p>
				</form>';
			
		}else echo 'Not found role with ID'.$_POST['role_id'];
			
		break;
	
}
?>