<?php

	$servername = 'localhost';
    $username 	= "johnroar_admin";
    $password 	= "jacob2006";
    $dbname 	= "johnroar_collegeData";
	$response = null;
    		
    $conn = new mysqli($servername, $username, $password, $dbname);
	// check connection
    if ($conn->connect_error) {
   		trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
    }
	
	$deactivateToken = "update tokens set used = 1 where used = 0 and created < ?";
	$dt = new DateTime();
			
	/* Prepare statement */
	$stmt = $conn->prepare($deactivateToken);
	if($stmt === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
		      
	//Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
	$stmt->bind_param("s", $dt->format('Y-m-d H:i:s'));
		      
	/* Execute Query */
	$stmt->execute();
	
?>