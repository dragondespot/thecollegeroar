<?php
   
    $universityID = $_GET['id'];

    $servername = 'localhost';
    $username 	= "johnroar_admin";
	$password 	= "jacob2006";
    $dbname     = "johnroar_collegeData";
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    /*
    $sql =  "select * " .
            "from INSTITUTIONS, twitter_data, ENROLLMENT, Admission " .
            "where INSTITUTIONS.unitid = twitter_data.unitid and " .
            "INSTITUTIONS.unitid = ENROLLMENT.unitid and " .
            "INSTITUTIONS.unitid = Admission.unitid and " .
            "INSTITUTIONS.unitid = " . $universityID .
            " ORDER BY twitter_data.percent_match DESC limit 1";
    */
    
    $sql =  "select * " .
        "from INSTITUTIONS " .
        "LEFT JOIN twitter_data on INSTITUTIONS.unitid = twitter_data.unitid " .
        "LEFT JOIN ENROLLMENT on INSTITUTIONS.unitid = ENROLLMENT.unitid " .
        "LEFT JOIN Admission on INSTITUTIONS.unitid = Admission.unitid " .
        "where INSTITUTIONS.unitid = " . $universityID .
        " ORDER BY twitter_data.percent_match DESC limit 1";
    
    
    $result = $conn->query($sql);
    //$resultArray = $result->fetch_all(MYSQLI_ASSOC);
    $rows = array();
   
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            //echo "Name: " . $row["name"]. " - Address: " . $row["address"]. " " . $row["city"]. "<br>";
            $rows[] = $row;
        }
        echo json_encode($rows);
    } else {
        echo "0 results";
    }
    
    //echo json_encode($resultArray);
    $conn->close();
    
?>	