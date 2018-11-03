<?php
	//include("connect.php");
	
	$resetPass = "select name, email " .
                 "from user_account " .
                 "where regdate between ? and ? ";
	
	//Connect to Database
	//connect();
	
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
	
	/* Prepare statement */
    $stmt = $conn->prepare($resetPass);
    if($stmt === false) {
    	trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
    }

    // subtract 3 days from date
	//$startDate = Date('y:m:d', strtotime("-3 days"));
	$endDate = new DateTime();
	$startDate = new DateTime($endDate->format('Y-m-d') . ' - 10 days');
	
    //Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob */
    $stmt->bind_param("ss", $startDate->format('Y-m-d'), $endDate->format('Y-m-d'));
      
    $stmt->execute();
      
   	/* bind result variables */
   	$stmt->bind_result($name, $email);
  	
   	$subject = "New Registered Users on theCollegeRoar.com";
	$uri = 'http://'. $_SERVER['HTTP_HOST'] ;
	$beginMessage = '
		<html>
			<head>
				<title>New Users For theCollegeRoar.com</title>
			</head>
			<body>
	';
	
	$endMessage = '
			</body>
		</html>
	';
	
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= 'From: Admin<webmaster@thecollegeroar.com>' . "\r\n";
	
	$count = 0;
	
    /* fetch values */
    while($stmt->fetch()) {
		$detailsMessage .= '<p>	Name: ' . $name . ' | Email: ' . $email. '</p>';
		$count++;
    }
   
    if ($count > 0){
    	
    	$message = $beginMessage . $detailsMessage . $endMessage;
    	echo ($message);
    	$to = 'Admin<webmaster@thecollegeroar.com>';
    
    	mail($to,$subject,$message,$headers);	
    	
    }
    else {
    	echo ("No Records found");	
    	
    }
    
    mysqli_close($conn); // Closing Connection
    
?>
