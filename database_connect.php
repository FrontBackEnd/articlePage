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
					  		    
?>