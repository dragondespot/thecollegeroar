<?php
   /*
        Search for colleges that are within a certain distance from the user.
        return an array of id numbers that will be used to create links on the website (left hand side)
   */
  
    if (empty($_GET)) {
        $lat = 40;
        $long = -75;
    }else {
        $lat = $_GET['lat'];
        $long = $_GET['long'];
        //$long = $long * -1;
       
    }
    
    $range = 1;
    
    $uplat = $lat + $range;
    $lowlat = $lat - $range;
    
    $uplong = $long + $range;
    $lowlong = $long - $range;
    
    $servername = 'localhost';
    $username 	= "johnroar_admin";
	$password 	= "jacob2006";
    $dbname     = "johnroar_collegeData";
    
    /*
    $sql =  "select INSTITUTIONS.unitid, INSTITUTIONS.name " .
            "from INSTITUTIONS, ENROLLMENT " .
            "where INSTITUTIONS.unitid = ENROLLMENT.unitid and " .
            "ENROLLMENT.EFALEVEL = '1' and " .
            "CAST(longitud AS DECIMAL) > CAST(" . $lowlong . " AS DECIMAL) and " .
            "CAST(longitud AS DECIMAL) < CAST(" . $uplong . " AS DECIMAL) and ".
            "CAST(latitude AS DECIMAL) > CAST(" . $lowlat . " AS DECIMAL) and " .
            "CAST(latitude AS DECIMAL) < CAST(" . $uplat . " AS DECIMAL) " .
            "ORDER BY ENROLLMENT.EFTOTLT DESC";
    
    $sql =  "select INSTITUTIONS.unitid " .
            "from INSTITUTIONS " .
            "where CAST(longitud AS DECIMAL) > CAST(" . $lowlong . " AS DECIMAL) and " .
            "CAST(longitud AS DECIMAL) < CAST(" . $uplong . " AS DECIMAL) and ".
            "CAST(latitude AS DECIMAL) > CAST(" . $lowlat . " AS DECIMAL) and " .
            "CAST(latitude AS DECIMAL) < CAST(" . $uplat . " AS DECIMAL)";
    */
    $sql =  "select INSTITUTIONS.unitid, school_name " .
            "from INSTITUTIONS, postal_code, ENROLLMENT " .
            "where INSTITUTIONS.zip = postal_code and " .
            "INSTITUTIONS.unitid = ENROLLMENT.unitid and " .
            "ENROLLMENT.EFALEVEL = '1' and " .
            "lng > CAST(" . $lowlong . " AS DECIMAL) and " .
            "lng < CAST(" . $uplong . " AS DECIMAL) and ".
            "lat > CAST(" . $lowlat . " AS DECIMAL) and " .
            "lat < CAST(" . $uplat . " AS DECIMAL) " .
            "ORDER BY ENROLLMENT.EFTOTLT DESC limit 25";
    
    /*$sql =  "select * " .
        "from INSTITUTIONS " .
        "where unitid = 186131 or unitid = 190150 or unitid = 166027 or unitid = 144050";*/
    
    //echo $sql;
   
    $link = mysqli_connect($servername, $username, $password, $dbname);
    
    /* check connection */
    if (mysqli_connect_errno()) {
        printf("Connect failed: %s\n", mysqli_connect_error());
        exit();
    }
    
    $query = "SELECT Name, CountryCode FROM City ORDER by ID LIMIT 3";
    $result = mysqli_query($link, $sql);
    
    /* numeric array 
    $row = mysqli_fetch_array($result, MYSQLI_NUM);
    printf ("%s (%s)\n", $row[0], $row[1]);
    
        associative array 
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    printf ("%s (%s)\n", $row["unitid"], $row["school_name"]);
    echo json_encode($row);
    
    associative and numeric array
    $row = mysqli_fetch_array($result, MYSQLI_BOTH);
    printf ("%s (%s)\n", $row[0], $row["school_name"]);
    */
    
    $rows = array();
    
    // output data of each row
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        //echo "Process row";
        $rows[] = $row;
        //echo json_encode($row);
        
     }
   
    echo json_encode($rows);
    
    /* free result set */
    mysqli_free_result($result);
    
    /* close connection */
    mysqli_close($link);
    
   
?>	