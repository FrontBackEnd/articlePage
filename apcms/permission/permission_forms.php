<?php
switch($_POST['action']){
		
	case 'UPDATE':
		
		if(isset($_POST['permission_id']) && !empty($_POST['permission_id'])){
			$id = $_POST['permission_id'];
		
			$sql="SELECT * FROM `ap_permission` WHERE `id` = '$id'";
			$result = mysqli_query($conn,$sql);
			if(mysqli_num_rows($result)){
				$row = mysqli_fetch_assoc($result);
				
				$sql_role = " SELECT * FROM `ap_roles` WHERE `status` = '1'";
				$result_role = mysqli_query($conn,$sql_role);
				if(mysqli_num_rows($result_role)){
					while($role = mysqli_fetch_assoc($result_role)){
						$all_roles[$role['id']] = $role;
					}
				}
				
				if(isset($row['view']) && !empty($row['view'])) $view = explode(', ',$row['view']);
				else $view = '';
				
				if(isset($row['add']) && !empty($row['add'])) $add = explode(', ',$row['add']);
				else $add = '';
				
				if(isset($row['update']) && !empty($row['update'])) $update = explode(', ',$row['update']);
				else $update = '';
				
				if(isset($row['delete']) && !empty($row['delete'])) $delete = explode(', ',$row['delete']);
				else $delete = '';
				
				echo '
				
						<div class="panel panel-default">
							<div class="panel-heading">
							<h4 class="pull-right">'.ucfirst($row['cms_part']).'</h4>
								<form method="POST" action="">
									<input type="submit" name="save_permission" value="UPDATE" class="btn btn-default">
									<input type="hidden" name="permission_id" value="'.$row['id'].'" class="btn btn-default">
								
							</div>
							
							<table class="table">
								<thead>
									<tr>
									<th>VIEW</th>
									<th>ADD</th>
									<th>UPDATE</th>
									<th>DELETE</th>
								</thead>
								<tbody>
									<tr>
										<td>';
				
									if(isset($all_roles) && !empty($all_roles)){
										
										foreach($all_roles AS $role){
											if(is_array($view) && in_array($role['id'],$view)) $check = 'checked="checked"';
											else $check = '';
											
											echo '<div class="checkbox">
												    <label>
												      <input type="checkbox" name="view[]" value="'.$role['id'].'"'.$check.'> '.$role['title'].'
												    </label>
												  </div>';
										}
									}	
				
								echo '
										</td>
									 	<td>';
								
								if(isset($all_roles) && !empty($all_roles)){
									
									foreach($all_roles AS $role){
										if(is_array($add) && in_array($role['id'],$add)) $check = 'checked="checked"';
										else $check = '';
										
										echo '<div class="checkbox">
											    <label>
											      <input type="checkbox" name="add[]" value="'.$role['id'].'"'.$check.'> '.$role['title'].'
											    </label>
											  </div>';
									}
									
								}
								
								echo '
										</td>
									 	<td>';
								
									if(isset($all_roles) && !empty($all_roles)){
										
										foreach($all_roles AS $role){
											if(is_array($update) && in_array($role['id'],$update)) $check = 'checked="checked"';
											else $check = '';
										
											echo '<div class="checkbox">
												    <label>
												      <input type="checkbox" name="update[]" value="'.$role['id'].'"'.$check.'> '.$role['title'].'
												    </label>
												  </div>';
										}
										
									}
								echo '
										</td>
									 	<td>';							
									if(isset($all_roles) && !empty($all_roles)){
										
										foreach($all_roles AS $role){
											if(is_array($delete) && in_array($role['id'],$delete)) $check = 'checked="checked"';
											else $check = '';
											
											echo '<div class="checkbox">
												    <label>
												      <input type="checkbox" name="delete[]" value="'.$role['id'].'"'.$check.'> '.$role['title'].'
												    </label>
												  </div>';
										}
										
									}						
								echo '
										</td>
									</tr>
								</tbody>
							</table>
							</form>
						</div>
				';
				
				
			}else echo 'Not found permission with ID'.$_POST['user_id'];
		}
		
		
		break;
	
}
?>