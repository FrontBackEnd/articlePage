<?php

if(in_array($user_role,$permission[$_GET['menu']]['view'])){

	if(isset($_POST['save_users']) && !empty($_POST['save_users'])) include("users_action.php");
		
	if(isset($_POST['action']) && !empty($_POST['action'])) include("users_forms.php");
	else{
		
		echo'
			<h1 class="text-center">Users list</h1>
				<div class="panel panel-default">
					<div class="panel-heading">';
		
					if(in_array($user_role,$permission[$_GET['menu']]['add'])){
						echo '	<form method="POST" action="">
									<input type="submit" name="action" value="ADD" class="btn btn-success">
								</form>';
					}		
					
			echo ' </div>';
		
					$sql = " SELECT * FROM `ap_users`";
					$result = mysqli_query($conn,$sql);
					
					if(mysqli_num_rows($result)){
						
						echo '
					<table class="table">
						<thead>
							<tr>
							<th>ID</th>
							<th>E-mail</th>
							<th>Active</th>
							<th>Actions</th>
						</thead>
						<tbody>';	
			
		
						while($row = mysqli_fetch_assoc($result)){
							echo '
							<tr>
								<td>'.$row['id'].'</td>
							 	<td>'.$row['email'].'</td>
							 	<td>'.$users_status[$row['status']].'</td>
								<td>
									<form method="POST" action="">
										<input type="hidden" name="user_id" value="'.$row['id'].'">';
							
							if(in_array($user_role,$permission[$_GET['menu']]['update'])) echo '<input type="submit" name="action" value="UPDATE" class="btn btn-default">';
							if(in_array($user_role,$permission[$_GET['menu']]['delete'])) echo '<input type="submit" name="action" value="DELETE" class="btn btn-danger">';
										
							echo'	</form>
								</td>
							</tr>';
						}
					}else echo '<p class="text-center"> Not found any users </p>';
					
		echo '</div>';
	}
	
}else echo '<h1>Not allowed</h1>';
	
?>