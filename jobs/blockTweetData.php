<?php

	$universityID = $_POST['universityID'];
  	$screen_name = $_POST['screenName'];

  	$universityQuery = "DELETE FROM `twitter_data` WHERE unitid = ? and t_name = ? ";

	$blockInsert = "insert twitter_block " .
  				  	 "(name) values " .
				  	 "(?)";          
                               
	$servername = 'localhost';
	$username 	= "johnroar_admin";
	$password 	= "jacob2006";
	$dbname 	= "johnroar_collegeData";

	$conn = new mysqli($servername, $username, $password, $dbname);

	// check connection
	if ($conn->connect_error) {
		trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}

	/* Prepare statement */
	$stmt = $conn->prepare($universityQuery);
	if($stmt === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
	//Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob 
    $stmt->bind_param("ss", $universityID, $screen_name);
    
    /* Execute statement */
    $stmt->execute();
    $stmt->close();
    
    /* Prepare statement */
    $stmt = $conn->prepare($blockInsert);
    if($stmt === false) {
    		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	
		//Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob 
    $stmt->bind_param("s", $screen_name);
    
    /* Execute statement */
    $stmt->execute();
    $stmt->close();

?>          