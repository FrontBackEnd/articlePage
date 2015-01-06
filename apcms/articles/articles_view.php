<?php


if(isset($_POST['save_article']) && !empty($_POST['save_article'])) include("articles_action.php");
	
if(isset($_POST['action']) && !empty($_POST['action'])) include("articles_forms.php");
else{
	
	echo'
		<h1 class="text-center">Articles</h1>
			<div class="panel panel-default">
				<div class="panel-heading">
					<form method="POST" action="">
						<input type="submit" name="action" value="ADD" class="btn btn-success">
					</form>
				</div>';
				
				$sql = " SELECT * FROM `ap_articles`";
				$result = mysqli_query($conn,$sql);
				
				if(mysqli_num_rows($result)){
		
					echo '
				<table class="table">
					<thead>
						<tr>
						<th>ID</th>
						<th>Created date</th>
						<th>Title</th>
						<th>Active</th>
						<th>Actions</th>
					</thead>
					<tbody>';
		
					while($row = mysqli_fetch_assoc($result)){
						
						echo '
						<tr>
							<td>'.$row['id'].'</td>
							<td>'.$row['created_date'].'</td>
						 	<td>'.$row['title'].'</td>
						 	<td>'.$article_status[$row['status']].'</td>
							<td>
								<form method="POST" action="">
									<input type="hidden" name="article_id" value="'.$row['id'].'"> 
									<input type="submit" name="action" value="UPDATE" class="btn btn-default">
									<input type="submit" name="action" value="DELETE" class="btn btn-danger">
								</form>
							</td>
						</tr>';
					}
					
				}else echo '<p class="text-center"> Not found any articles </p>';
				
	echo '</div>';
	
}
	
	
?>