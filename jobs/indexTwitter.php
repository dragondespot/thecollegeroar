<?php
	ini_set('display_errors', 1);
	require_once('TwitterAPIExchange.php');
	
	/** Set access tokens here - see: https://dev.twitter.com/apps/ **/
	/*$settings = array(
	    'oauth_access_token' => "3192468470-qWPHyls5VOuRpBm4ZQsdOCrWjIp0fEcpKLclFq7",
	    'oauth_access_token_secret' => "ksJADW7uFoFnHxG3cxEk2R6YEXhkJI7RN9FX5PhIUy0TQ",
	    'consumer_key' => "XChdNEUr5Uu0te5ctxLAqTXmb",
	    'consumer_secret' => "U4Rvz0i7wzGQNpNdyKMj9Hwbt39R4aeoTbjLB8RQH8RDX4GU32"
	);*/
	
	$settings = array(
	    'oauth_access_token' => "3192468470-qWPHyls5VOuRpBm4ZQsdOCrWjIp0fEcpKLclFq7",
	    'oauth_access_token_secret' => "ksJADW7uFoFnHxG3cxEk2R6YEXhkJI7RN9FX5PhIUy0TQ",
	    'consumer_key' => "XChdNEUr5Uu0te5ctxLAqTXmb",
	    'consumer_secret' => "U4Rvz0i7wzGQNpNdyKMj9Hwbt39R4aeoTbjLB8RQH8RDX4GU32"
	);
	
	$count = "select max(last_count) from twitter_count"; 
	
	$insertTwitter = "insert twitter_data " .
  				  	 "(unitid, name, screen_name, url, display_url, " .
  				  	 "expanded_url, location, description, verified, percent_match) values " .
				  	 "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
	
	$servername = 'localhost';
	$username 	= "johnroar_admin";
	$password 	= "jacob2006";
	$dbname 	= "johnroar_collegeData";
	$response = null;
	
	$connCount = new mysqli($servername, $username, $password, $dbname);
	// check connection
	if ($connCount->connect_error) {
		trigger_error('Database connection failed: '  . $connCount->connect_error, E_USER_ERROR);
	}
	   
	/* Prepare statement */
	$stmtCount = $connCount->prepare($count);
	if($stmtCount === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $connCount->error, E_USER_ERROR);
	}
	    
	$stmtCount->execute();	
    	$stmtCount->bind_result($max_value);
    	$stmtCount->fetch();
    
    	echo $max_value;
    
    	$max_value += 100;
        /*
    	$selectSchools = "Select unitid, webaddress from INSTITUTIONS  LIMIT " . $max_value . ", 100";
    	
    	$selectSchools = "select INSTITUTIONS.unitid, INSTITUTIONS.webaddress " . 
				  "from INSTITUTIONS left join twitter_data " .
				  "on INSTITUTIONS.unitid = twitter_data.unitid " . 
				  "where twitter_data.unitid IS NULL " .
				  "ORDER BY INSTITUTIONS.unitid DESC " . 
				  "LIMIT " . $max_value . ", 100";
    	*/
    	$selectSchools =   "select DISTINCT INSTITUTIONS.unitid, INSTITUTIONS.webaddress, " .
    	                   "twitter_data.t_name, twitter_data.accepted " .
    	                   "from INSTITUTIONS " .
    	                   "LEFT JOIN twitter_data on INSTITUTIONS.unitid = twitter_data.unitid " .
    	                   "LEFT JOIN ENROLLMENT on INSTITUTIONS.unitid = ENROLLMENT.unitid " .
    	                   "where ENROLLMENT.EFTOTLT > 10000 and twitter_data.accepted is null " .
    	                   "ORDER by ENROLLMENT.EFTOTLT DESC LIMIT 100"; 
    	
			
	$conn = new mysqli($servername, $username, $password, $dbname);
	// check connection
	if ($conn->connect_error) {
		trigger_error('Database connection failed: '  . $conn->connect_error, E_USER_ERROR);
	}
	   
	/* Prepare statement */
	$stmt = $conn->prepare($selectSchools);
	if($stmt === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
	}
	    
	$stmt->execute();
		
		/* Iterate over results*/
    $stmt->bind_result($universityID, $universityURL);
    
    $connInsert = new mysqli($servername, $username, $password, $dbname);
	// check connection
	if ($connInsert->connect_error) {
		trigger_error('Database connection failed: '  . $connInsert->connect_error, E_USER_ERROR);
	}
                                 
    while ($stmt->fetch()){
    	
    	echo($universityURL . "</br>");
    	
    	/* Prepare statement */
		$stmtInsert = $connInsert->prepare($insertTwitter);
		if($stmtInsert === false) {
			trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $conn->error, E_USER_ERROR);
		}
		
		$parseURL = parse_url($universityURL);
		//var_dump($parseURL);
		$universityURL = $parseURL["path"];
		$universityURL = strtolower($universityURL);
		
		if (substr($universityURL, 0, 4) === 'www.')
			
			$universityURL = substr($universityURL, 4);
			
		}
		
		$univOriginalURL = $universityURL;
		$universityURL = str_replace(".", "%2E", $universityURL);
		
    	$url = 'https://api.twitter.com/1.1/users/search.json';
		$getfield = '?q=' . $universityURL . '&page=1&count=7';
		$requestMethod = 'GET';
	
		$twitter = new TwitterAPIExchange($settings);
		$json = $twitter->setGetfield($getfield)
		   		  		->buildOauth($url, $requestMethod)
	        		 	->performRequest();	
	        		 	
		//var_dump($json);
		$array = json_decode($json, TRUE);
		var_dump($array);
		echo($university . '</br>');
		
		$detailsMessage .= '<p>';
		
		foreach($array as $name => $value)
		{
			if ($value['name'] != 'EDUCAUSE'){
				$twitterScreenName = (string)$value['screen_name'];
				$twitterName = (string)$value['name'];
				$twitterURL = (string)$value['entities']['url']['urls'][0]['url'];
				$twitterDisplayURL = (string)$value['entities']['url']['urls'][0]['display_url'];
				$twitterExpandedURL = (string)$value['entities']['url']['urls'][0]['expanded_url'];
				$location = (string)$value['location'];
				$description = (string)$value['description'];
				$verified = $value['verified'];
				
				similar_text($twitterDisplayURL, $univOriginalURL, $percent); 
				
				if $percent > 95 {
				    //Bind parameters. TYpes: s = string, i = integer, d = double,  b = blob
	    			$stmtInsert->bind_param(	"isssssssid", 
	    									$universityID, $twitterScreenName, $twitterName, $twitterURL,
	    									$twitterDisplayURL, $twitterExpandedURL, $location, $description, 
	    									$verified, $percent);
	    									
				    $stmtInsert->execute();
				
    				$detailsMessage .= $universityID . ' - ' . $universityURL . ' - ';
    				$detailsMessage .= $value['name'] . ' - ' . $value['screen_name'] . ' - ';
    				$detailsMessage .= $twitterURL . ' - ';
    				$detailsMessage .= $twitterDisplayURL . ' - ';
    				$detailsMessage .= $twitterExpandedURL . ' - ';
    				$detailsMessage .= $location . ' - ';
    				$detailsMessage .= $description . ' - ' . $verified . ' - ' . $percent;
				}
			}//if educase
		}//for loop twitter response

		$detailsMessage .= '</p>';
	}//for loop colleges
	
	$stmtCount->close();
	$insertCount = "insert twitter_count " .
  				  	 "(last_count) values " .
				  	 "(" . $max_value . ")";
	
	/* Prepare statement */
	$stmtCount = $connCount->prepare($insertCount);
	if($stmtCount === false) {
		trigger_error('Wrong SQL: ' . $sql . ' Error: ' . $connCount->error, E_USER_ERROR);
	}
	    
	$stmtCount->execute();
	
	$subject = "Twitter Update on theCollegeRoar.com";
	$uri = 'http://'. $_SERVER['HTTP_HOST'] ;
	$beginMessage = '
		<html>
			<head>
				<title>Results from Twitter Search on theCollegeRoar.com</title>
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
	
	$message = $beginMessage . $detailsMessage . $endMessage;
    	
  	$to = 'Admin<webmaster@thecollegeroar.com>';
    
    mail($to,$subject,$message,$headers);	

    function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
?>	



