<?php
switch($_POST['action']){
	
	case 'ADD':
		
			$sql_role = " SELECT * FROM `ap_roles` WHERE `status` = '1'";
			$result_role = mysqli_query($conn,$sql_role);
		
		
			echo '
				<form method="POST" action="">
					
					<p>Email</p>
					<input type="email" name="email" required="required">
								
					<p>Password</p>
					<input type="password" name="password" required="required">		
					
					<p>Role</p>
					<select name="role">
						<option value="0">Not selected</option>
					';
					if(mysqli_num_rows($result_role)){
						while($role = mysqli_fetch_assoc($result_role)){
							echo '<option value="'.$role['id'].'">'.$role['title'].'</option>';
						}
					}
			echo	'
					</select>
					
					<p>Active</p>
					<select name="status">
					';
					foreach($users_status AS $key => $name){
						echo '<option value="'.$key.'">'.$name.'</option>';
					}
			echo'
					</select>
					
					<p><input type="submit" name="save_users" value="ADD"></p>
				</form>
			';
		
		break;
		
	case 'UPDATE':
		
		if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
			$id = $_POST['user_id'];
		
			$sql="SELECT * FROM `ap_users` WHERE `id` = '$id'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				
				$sql_role = " SELECT * FROM `ap_roles` WHERE `status` = '1'";
				$result_role = mysqli_query($conn,$sql_role);
				
				echo '
					<form method="POST" action="">
						<input type="hidden" name="user_id" value="'.$id.'">
						
						<p>Email</p>
						<input type="email" name="email" value="'.$row['email'].'">
			
						<p>Password</p>
						<input type="password" name="password">	
						
						<p>Roles</p>
						<select name="role">
							<option value="0">Not selected</option>
						';
						if(mysqli_num_rows($result_role)){
							while($role = mysqli_fetch_assoc($result_role)){
								if($row['role'] == $role['id']) $sel = ' selected="selected"'; 
								else $sel = '';
								
								echo '<option value="'.$role['id'].'"'.$sel.'>'.$role['title'].'</option>';
							}
						}
				echo	'
						</select>
						
						<p>Active</p>
						<select name="status">
						';
						foreach($users_status AS $key => $name){
							if($key == $row['status']) $sel = ' selected="selected"';
							else $sel = '';
							
							echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
						}
				echo'
						</select>
						
						<p><input type="submit" name="save_users" value="UPDATE"> </p>
					</form>';
				
			}else echo 'Not found user with ID'.$_POST['user_id'];
		}
		
		
		break;
		
	case 'DELETE':
		
		if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
			
			$id = $_POST['user_id'];
			echo '
				<form method="POST" action="">
					<input type="hidden" name="user_id" value="'.$id.'">
					<p>Do you realy wont to delete this user ?</p>
					<p><input type="submit" name="save_users" value="DELETE"></p>
					<p><input type="submit" name="no" value="NO"></p>
				</form>';
			
		}else echo 'Not found user with ID'.$_POST['user_id'];
			
		break;
	
}
?>