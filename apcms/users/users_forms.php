<?php
switch($_POST['action']){
	
	case 'ADD':
		
			$sql_role = " SELECT * FROM `ap_roles` WHERE `status` = '1'";
			$result_role = mysqli_query($conn,$sql_role);

			echo '
				<h1 class="text-center">Add user</h1>
				<form method="POST" action="">
				
					<div class="form-group">
						<label for="email">E-mail</label>
						<input id="email" type="email" name="email" required="required" class="form-control">
					</div>
								
					<div class="form-group">
						<label for="password">Password</label>
						<input id="password" type="password" name="password" required="required" class="form-control">		
					</div>
					
					<div class="form-group">
						<label for="role">Role</label>
						<select id="role" name="role" class="form-control">
							<option value="0">Not selected</option>
							';
							if(mysqli_num_rows($result_role)){
								while($role = mysqli_fetch_assoc($result_role)){
									echo '<option value="'.$role['id'].'">'.$role['title'].'</option>';
								}
							}
			echo	'
						</select>
					</div>
					
					<div class="form-group">
						<label for="status">Active</label>
						<select id="status" name="status" class="form-control">
					';
						foreach($users_status AS $key => $name){
							echo '<option value="'.$key.'">'.$name.'</option>';
						}
			echo'
						</select>
					</div>	
					
					<input type="submit" name="save_users" value="ADD" class="btn btn-success">
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
					<h1 class="text-center">Update user</h1>
					<form method="POST" action="">
						<input type="hidden" name="user_id" value="'.$id.'">
					
						<div class="form-group">
							<label for="email">E-mail</label>
							<input id="email" type="email" name="email" required="required" value="'.$row['email'].'" class="form-control">
						</div>
									
						<div class="form-group">
							<label for="password">Password</label>
							<input id="password" type="password" name="password" class="form-control">		
						</div>
						
						<div class="form-group">
							<label for="role">Role</label>
							<select id="role" name="role" class="form-control">
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
						</div>
						
						<div class="form-group">
							<label for="status">Active</label>
							<select id="status" name="status" class="form-control">
						';
							foreach($users_status AS $key => $name){
								if($key == $row['status']) $sel = ' selected="selected"';
								else $sel = '';
								
								echo '<option value="'.$key.'"'.$sel.'>'.$name.'</option>';
							}
				echo'
							</select>
						</div>	
						
						<input type="submit" name="save_users" value="UPDATE" class="btn btn-default">
					</form>
				';
				
				
			}else echo 'Not found user with ID'.$_POST['user_id'];
		}
		
		
		break;
		
	case 'DELETE':
		
		if(isset($_POST['user_id']) && !empty($_POST['user_id'])){
			
			$id = $_POST['user_id'];
			echo '
				<h1 class="text-center">Do you realy wont to delete this user ?</h1>
				<form method="POST" action="">
					<input type="hidden" name="user_id" value="'.$id.'">
					<input type="submit" name="save_users" value="DELETE" class="btn btn-danger">
					<input type="submit" name="no" value="NO" class="btn btn-default">
				</form>';
			
		}else echo 'Not found user with ID'.$_POST['user_id'];
			
		break;
	
}
?>