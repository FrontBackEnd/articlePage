<?php

session_start();

$database_host = 'localhost';
$database_user = 'root';
$database_password = '';
$database_name = 'frontbac_article_page';

$conn = mysqli_connect($database_host, $database_user, $database_password, $database_name);

if ($conn){

	mysqli_query($conn, "SET names 'utf8'");	

}else{

	echo "Connect error: " . mysqli_connect_error();
	die();
	
}

$error = '';

$article_status = array( '0' => 'No',
						 '1' => 'Yes'
					   );

$article_extract = array( '0' => 'No',
						  '1' => 'Yes'
					    );

$categories_status = array( '0' => 'No',
						 	'1' => 'Yes'
					   	  );			    
$users_status = array( '0' => 'No',
					   '1' => 'Yes'
					  );	

$roles_status	 = array( '0' => 'No',
					   '1' => 'Yes'
					  );				  
					  
					  
$permission = array();

$sql_permission = "SELECT * FROM `ap_permission`";
$result_permission = mysqli_query($conn,$sql_permission);

if(mysqli_num_rows($result_permission)){
	
	while($row_permission = mysqli_fetch_assoc($result_permission)){
		
		$permission[$row_permission['cms_part']]['view'] = explode(', ',$row_permission['view']);
		$permission[$row_permission['cms_part']]['add'] = explode(', ',$row_permission['add']);
		$permission[$row_permission['cms_part']]['update'] = explode(', ',$row_permission['update']);
		$permission[$row_permission['cms_part']]['delete'] = explode(', ',$row_permission['delete']);
	}
	
}



					  
					  		    
?>