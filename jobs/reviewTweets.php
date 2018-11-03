<html>
	<head>
		 <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    	<title>The College Roar - Twitter data</title>
    	
 		<?php 
            $INC_DIR = $_SERVER["DOCUMENT_ROOT"];
            require $INC_DIR . '/loadLinks.php';
            //echo $INC_DIR;
        ?> 
        
        <script type="text/javascript">

			function deleteTweetData(element, iUnivID, strScreenName){
				var URL = "deleteTweetData.php";
				var queryString = "universityID=" + iUnivID + "&screenName=" + strScreenName;
				var xhrDelete = new XMLHttpRequest();

				xhrDelete.onreadystatechange = function () {
		          if (xhrDelete.readyState == 4 && xhrDelete.status == 200) {
		            //var jsonResponse = JSON.parse(xhrDelete.responseText);
		            element.value = "Deleted";
		            var mytable = element.parentNode.parentNode;
         			  mytable.parentNode.removeChild(mytable);
		          }
		        }  
		        //*** open up the asynchronous request to server
		        xhrDelete.open("POST", URL, true);
				//*** send the finalized request
		        xhrDelete.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		        xhrDelete.send(queryString);
		      }

			function acceptTweetData(element, iUnivID, strScreenName){
				var URL = "acceptTweetData.php";
				var queryString = "universityID=" + iUnivID + "&screenName=" + strScreenName;
				var xhrAccepted = new XMLHttpRequest();
				xhrAccepted.onreadystatechange = function () {
		          if (xhrAccepted.readyState == 4 && xhrAccepted.status == 200) {
		            //var jsonResponse = JSON.parse(xhrAccepted.responseText);
		            element.value = "Accepted";
		            document.getElementById(iUnivID + "_" + strScreenName +"_" + "block").disabled = true; 
		            document.getElementById(iUnivID + "_" + strScreenName +"_" + "delete").disabled = true; 
		            document.getElementById(iUnivID + "_" + strScreenName +"_" + "accept").disabled = true; 
		          }
		        }  

		        //*** open up the asynchronous request to server
		        xhrAccepted.open("POST", URL, true);
		        //*** send the finalized request
		        xhrAccepted.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		        xhrAccepted.send(queryString);
		      }

			function blockTweetData(element, iUnivID, strScreenName){
				var URL = "blockTweetData.php";
				var queryString = "universityID=" + iUnivID + "&screenName=" + strScreenName;
				var xhrBlocked = new XMLHttpRequest();
				xhrBlocked.onreadystatechange = function () {
		          if (xhrBlocked.readyState == 4 && xhrBlocked.status == 200) {
		            //var jsonResponse = JSON.parse(xhrBlocked.responseText);
		            element.value = "Blocked";
		            var mytable = element.parentNode.parentNode;
         			  mytable.parentNode.removeChild(mytable);
		          }
		        }  

		        //*** open up the asynchronous request to server
		        xhrBlocked.open("POST", URL, true);

		        //*** send the finalized request
		        xhrBlocked.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		        xhrBlocked.send(queryString);
		      }
		</script>
	</head>
	<body>
		<?php 
            $INC_DIR = $_SERVER["DOCUMENT_ROOT"];
            require $INC_DIR .  '/header.php'; 
        ?>
		<div id="main">
    		<div id="article66">
    			<?php
                    //***		Author:      John Booz
                    //***		Date:        11/01/2018
                    //***		Filename:    reviewTwitter.php
                    //***		Description: PHP file to display college / university data.-->
                    
                    //Database Connection Setup
                    $servername = 'localhost';
                    $username 	= "johnroar_admin";
                    $password 	= "jacob2006";
                    $dbname     = "johnroar_collegeData";
                    
                    // Create connection
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    
                    if ($conn->connect_error) {
                        echo "connection failed";
                        //die("Connection failed: " . $conn->connect_error);
                    }
                    else {
                        //echo "Connection Made";
                    }
                    
                    $selectSchools =   "select INSTITUTIONS.unitid, INSTITUTIONS.state, INSTITUTIONS.city, " .
                        "INSTITUTIONS.school_name, INSTITUTIONS.webaddress, " .
                        "twitter_data.screen_name, twitter_data.t_name, twitter_data.location, " .
                        "twitter_data.description, twitter_data.display_url " .
                        "from INSTITUTIONS, twitter_data, ENROLLMENT " .
                        "where INSTITUTIONS.unitid = ENROLLMENT.unitid and " .
                        "INSTITUTIONS.unitid = twitter_data.unitid and " .
                        "INSTITUTIONS.unitid > 0 and twitter_data.accepted = 0 and " .
                        "ENROLLMENT.EFALEVEL = 1 " .
                        "ORDER by ENROLLMENT.EFTOTLT DESC LIMIT 30";
                    
                    //echo $selectSchools;
                    
                    $dbresult = $conn->query($selectSchools);
                    $rows = array();
                    
                    if ($dbresult->num_rows > 0) {
                        $i = 0;        
                        $result = "<table>";
                        
                        // output data of each row
                        while($row = $dbresult->fetch_assoc()) {
                            
                            $inputID = "twitter_" . $i;
                            $result .= "<tr>";
                            $result .= "<td>";
                            $result .= '<input class="delete_$inputID" id="' . $row[unitid] . '_' . $row[t_name] . '_delete" type="button"';
                            $result .= 'onClick="deleteTweetData(this, \'' . $row[unitid] . '\', \'' . $row[t_name] . '\')" value="Remove">';
                            $result .= "</td>";
                            $result .= "<td>";
                            $result .= '<input class="accept_$inputID" id="' . $row[unitid] . '_' . $row[t_name] . '_accept" type="button"';
                            $result .= 'onClick="acceptTweetData(this, \'' . $row[unitid] . '\', \'' . $row[t_name] . '\')" value="Accept">';
                            $result .= "</td>";
                            $result .= "<td>";
                            $result .= '<input class="block_$inputID" id="' . $row[unitid] . '_' . $row[t_name] . '_block" type="button"';
                            $result .= 'onClick="blockTweetData(this, \'' . $row[unitid] . '\', \'' . $row[t_name] . '\')" value="Block">';
                            $result .= "</td>";
                            
                            $result .= "<tr>";
                            $result .= "<td>$row[unitid]</td>";
                            $result .= "<td>$row[school_name]</td>";
                            $result .= "<td>$row[city], $row[state]</td>";
                            $result .= "<td>$row[webaddress]</td>";
                            $result .= "<td>$row[screen_name]</td>";
                            $result .= "<td>$row[t_name]</td>";
                            $result .= "<td>$row[display_url]</td>";
                            $result .= "<td>$row[location]</td>";
                            $result .= "<td>$row[description]</td>";
                            $result .= "</tr>";
                        }
                    }
                    
                    $result .= "</table>";
                    
                    echo $result;
                ?>	
    		</div>
    
    		<div id="news">
    			<div class="panel-heading">
                	<h3 class="panel-title">
                		<ul>
                			<li><img 	src="http://thecollegeroar.com/Images/Social/Twitter_570625.png" 
    							width="50px"
    							height="auto"></li>
    						<li>The College Roar Live</li>	
    					</ul>
                	</h3>
                </div>
                <div class="panel-body">
                	<div class="twitter">
    			        <a  class="twitter-timeline" 
        					href="https://twitter.com/thecollegeroar?ref_src=twsrc%5Etfw"
        					data-tweet-limit='5'>
          					Tweets by thecollegeroar
    					</a> 
    		      	</div>
    			</div>
             </div>
		</div>
	</body>
</html>
