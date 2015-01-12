<?php
if(in_array($user_role,$permission[$_GET['menu']]['view'])){

	if(isset($_POST['save_permission']) && !empty($_POST['save_permission'])) include("permission_action.php");
		
	if(isset($_POST['action']) && !empty($_POST['action'])) include("permission_forms.php");
	else{
		
	echo'
		<h1 class="text-center">Permission</h1>';
	
		$sql = " SELECT * FROM `ap_permission`";
		$result = mysqli_query($conn,$sql);
		
		if(mysqli_num_rows($result)){
	
			while($row = mysqli_fetch_assoc($result)){
				
				$sql_role = " SELECT * FROM `ap_roles` WHERE `status` = '1'";
				$result_role = mysqli_query($conn,$sql_role);
				if(mysqli_num_rows($result_role)){
					while($role = mysqli_fetch_assoc($result_role)){
						$all_roles[$role['id']] = $role['title'];
					}
				}
				
				unset($view_roles);
				unset($add_roles);
				unset($update_roles);
				unset($delete_roles);
				
				if(isset($row['view']) && !empty($row['view'])){
					$view = explode(', ',$row['view']);
					
					foreach($view AS $role) $view_roles[] = $all_roles[$role];
					
					$view = implode(', ',$view_roles);
				}
				else $view = '';
				
				if(isset($row['add']) && !empty($row['add'])){
					$add = explode(', ',$row['add']);
					
					foreach($add AS $role) $add_roles[] = $all_roles[$role];
					
					$add = implode(', ',$add_roles);
				}
				else $add = '';
				
				if(isset($row['update']) && !empty($row['update'])){
					$update = explode(', ',$row['update']);
					
					foreach($update AS $role) $update_roles[] = $all_roles[$role];
					
					$update = implode(', ',$update_roles);
				}
				else $update = '';
				
				if(isset($row['delete']) && !empty($row['delete'])){
					$delete = explode(', ',$row['delete']);
					
					foreach($delete AS $role) $delete_roles[] = $all_roles[$role];
					
					$delete = implode(', ',$delete_roles);
				}
				else $delete = '';
				
				
				echo '
				<div class="panel panel-default">
					<div class="panel-heading">
					<h4 class="pull-right">'.ucfirst($row['cms_part']).'</h4>
						<form method="POST" action="">';
				
							if(in_array($user_role,$permission[$_GET['menu']]['update'])) echo '<input type="submit" name="action" value="UPDATE" class="btn btn-default">';
							
					echo'	<input type="hidden" name="permission_id" value="'.$row['id'].'" class="btn btn-default">
						</form>
						
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
								<td>'.$view.'</td>
							 	<td>'.$add.'</td>
							 	<td>'.$update.'</td>
							 	<td>'.$delete.'</td>
							</tr>
						</tbody>
					</table>
				</div>';
			}
		}else echo '<p class="text-center"> Not found any permissions </p>';
				
	}
	
}else echo '<h1>Not allowed</h1>';	
?>