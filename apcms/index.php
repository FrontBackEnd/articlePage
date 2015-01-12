<?php 
// DATABASE CONNECTION
require("../database_connect.php");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Article app</title>
	
	<meta charset="utf-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	
</head>
<body>
	<div class="container">
	<?php
		// LOGIN OPERATIONS
		include("ap_cms_login.php");
		
		// LOGIN FORMS
		include("ap_cms_login_form.php");
		
		// PRINT
		if(isset($_SESSION['user']) && !empty($_SESSION['user'])){ 
		
			$sql_role = "SELECT `role` FROM `ap_users` WHERE `email` = '".$_SESSION['user']."' LIMIT 1";
			$result_role = mysqli_query($conn,$sql_role);
			if(mysqli_num_rows($result_role)){
				$role = mysqli_fetch_assoc($result_role);
				$user_role = $role['role'];
				
			}else $user_role = '0';
			
			$menu = array(  'permission' => 'Permission' , 
							'users' => 'Users' , 
							'roles' => 'Roles',
							'categories' => 'Categories',
							'articles' => 'Articles'
						 );
			
			foreach($menu AS $cms_part => $name){
				if(isset($permission[$cms_part]['view']) && !empty($permission[$cms_part]['view']) && !in_array($user_role,$permission[$cms_part]['view'])){
					unset($menu[$cms_part]);
				}
			}
		 
			echo '
				
				<ul class="nav nav-tabs nav-justified" role="tablist">';
					foreach($menu AS $key => $name){
						if(isset($_GET['menu']) && !empty($_GET['menu']) && $_GET['menu'] == $key) $sel = ' class="active"';
						else $sel = '';
						
						echo '<li'.$sel.'><a href="?menu='.$key.'" >'.$name.'</a></li>';
					}
			echo '
				</ul>
				';
			
			
			if(isset($_GET['menu']) && !empty($_GET['menu'])){
				switch($_GET['menu']){
					
					case 'permission': include("permission/permission_view.php"); break;
					
					case 'users': include("users/users_view.php"); break;
					
					case 'roles': include("roles/roles_view.php"); break;
					
					case 'articles': include("articles/articles_view.php"); break;
					
					case 'categories': include("categories/categories_view.php"); break;
					
					case 'change_password': include("ap_change_password.php"); break;
					
				}
			}	
		}
	?>
	</div>
</body>