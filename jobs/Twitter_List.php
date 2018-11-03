<?php
    require_once('TwitterAPIExchange.php');
    require_once('states_abbrev.php');
    
    //Twitter statistics
    $holdScreenName = '';
    $holdPercent = 0.00;
    
    //Twitter API Setup
    $settings = array(
        'oauth_access_token' => "3192468470-qWPHyls5VOuRpBm4ZQsdOCrWjIp0fEcpKLclFq7",
        'oauth_access_token_secret' => "ksJADW7uFoFnHxG3cxEk2R6YEXhkJI7RN9FX5PhIUy0TQ",
        'consumer_key' => "XChdNEUr5Uu0te5ctxLAqTXmb",
        'consumer_secret' => "U4Rvz0i7wzGQNpNdyKMj9Hwbt39R4aeoTbjLB8RQH8RDX4GU32"
    );

    //URL for Twitter API
    $url_timeline = "https://api.twitter.com/1.1/statuses/user_timeline.json";
    $url_search = 'https://api.twitter.com/1.1/users/search.json';
    $url_lookup = 'https://api.twitter.com/1.1/users/lookup.json';
    
    //Using Get methond, could also use Post
    $requestMethod = "GET";
    
    //API Parameters
    $getfield_timeline = '?screen_name=iagdotme&count=20';
    $getfield_search = '?q=thecollegeroar&page=1&count=7';
    $getfield_lookup = '?screen_name=thecollegeroar';
    $getfield_lookup = '?screen_name=stanford';
    
    $twitter = new TwitterAPIExchange($settings);
    
    //Database Connection Setup
    $servername = 'localhost';
    $username 	= "johnroar_admin";
	$password 	= "jacob2006";
    $dbname     = "johnroar_collegeData";
    
    $date = new DateTime('30 days ago');
    //echo $date->format('Y-m-d');
    
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    connectionCheck($conn);
    
    // Create connection
    $connInsert = new mysqli($servername, $username, $password, $dbname);
    connectionCheck($ConnInsert);
    
    // Create connection
    $connUpdate = new mysqli($servername, $username, $password, $dbname);
    connectionCheck($ConnUpdate);
    
    $selectSchools =   "select DISTINCT INSTITUTIONS.unitid, INSTITUTIONS.webaddress, " .
        "INSTITUTIONS.state, INSTITUTIONS.city, " .
        "INSTITUTIONS.school_name, twitter_data.t_name, twitter_data.accepted, ENROLLMENT.EFTOTLT " .
        "from INSTITUTIONS " .
        "LEFT JOIN twitter_data on INSTITUTIONS.unitid = twitter_data.unitid " .
        "LEFT JOIN ENROLLMENT on INSTITUTIONS.unitid = ENROLLMENT.unitid " .
        "where ENROLLMENT.EFALEVEL = 1 and twitter_data.accepted is null and " .
        "(INSTITUTIONS.last_update < '" . $date->format('Y-m-d') . "' or INSTITUTIONS.last_update is null) " .
        "ORDER by ENROLLMENT.EFTOTLT DESC LIMIT 200"; 
    
    $insertTwitter = "insert twitter_data " .
        "(unitid, t_name, screen_name, url, display_url, " .
        "expanded_url, location, description, verified, official, state_match, " .
        "city_match, percent_web_match, description_match, num_followers, percent_match) values " .
        "(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $updateInstitutions = "update INSTITUTIONS " .
        "set INSTITUTIONS.last_update = now() " .
        "where INSTITUTIONS.unitid = ? ";
    
    $stmtInsert = $connInsert->prepare($insertTwitter);
    if($stmtInsert === false) {
        trigger_error('Wrong SQL: ' . $insertTwitter . ' Error: ' . $connInsert->error, E_USER_ERROR);
    }
    
    $stmtUpdate = $connUpdate->prepare($updateInstitutions);
    if($stmtUpdate === false) {
        trigger_error('Wrong SQL: ' . $updateInstitutions . ' Error: ' . $connUpdate->error, E_USER_ERROR);
    }
    
    $result = $conn->query($selectSchools);
    $rows = array();
   
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            //echo "Name: " . $row["name"]. " - Address: " . $row["address"]. " " . $row["city"]. "<br>";
            
            //Set University ID
            $universityID = $row[unitid];
            
            //Make string Lower Case
            $row[webaddress] = strtolower($row[webaddress]);
            
            //Strip off 'WWW.'
            if (startsWith($row[webaddress], 'www.')){
                
                $row[webaddress] = substr($row[webaddress], 4);
                
            }
            
            //Strip Spaces and Hypens from School Name
            $row[school_name] = StringCleanup($row[school_name]);
            
            $getfield_lookup = '?screen_name=stanford';
            //$getfield_search = '?q=' . $row[webaddress] . '&page=1&count=7';
            $getfield_search = '?q=' . str_replace(' ', '%20', $row[school_name]) . '&page=1&count=7';
            
            /*
            echo "<pre>";
            echo $row[school_name] . ", " . $row[webaddress] . ", " . $row[EFTOTLT];
            echo $url_search . $getfield_search;
            echo "</pre>";
           */
            
            $string = json_decode($twitter->setGetfield($getfield_search)
                ->buildOauth($url_search, $requestMethod)
                ->performRequest(),$assoc = TRUE);
            
            if(array_key_exists("errors", $string)) {
                echo "<h3>Sorry, there was a problem.</h3>" .
                    "<p>Twitter returned the following error message:</p>" .
                    "<p><em>".$string[errors][0]["message"]."</em></p>";
                
                exit();
            }
            
            //Set hold variables
            
            //Clear Percentages
            $holdPercent = 0.00;
            $percent = 0.00;
            $percent_ScreenName = 0.00;
            $percent_Web = 0.00;
            $percent_Description = 0.00;
            
            //Temp Variables
            $temp_ScreenName = '';
            $temp_TwitterName = '';
            $temp_DisplayURL = '';
            $temp_verified = -1;
            $temp_Description = '';
            $temp_followers = 0;
            $temp_location = '';
            $temp_state = '';
            $temp_city = '';
            $temp_official = 0;
            $temp_state_match = 0;
            $temp_city_match = 0;
            $temp_num_followers = 0;
            
            //Set strings to nothing
            $twitterScreenName = '';
            $verified = -1;
            $twitterName = '';
            $twitterURL = '';
            $twitterDisplayURL = '';
            $twitterExpandedURL = '';
            $location = '';
            $description = '';
            $final_percent_web = 0.00;
            $final_percent_screenname = 0.00;
            $final_percent_description = 0.00;
            $final_percent = 0.00;
            $final_official = 0;
            $final_state_match = 0;
            $final_city_match = 0;
            $final_num_followers = 0;
            
            
            foreach($string as $item){
                $temp_ScreenName = (string)$item['screen_name'];
                $temp_twitterName = (string)$item['name'];
                $temp_verified = $item['verified'];
                $temp_DisplayURL = $item[entities][url][urls][0][display_url];
                $temp_Description = (string)$item['description'];
                $temp_location = $item['location'];
                $pieces = explode(",", $temp_location);
                $temp_city = trim($pieces[0]);
                $temp_state = trim($pieces[1]);
                /*
                 * If State two characters check against Institutions Table
                 */
                
                /*Add additional logic to check city and state match from Institutions table and
                 *Twitter location.
                 *1) Will need to separate Twitter Location into two parts if Comma exists
                 *2) Will need to check if state is abbreviated.
                 *   database has abbreviations
                 *If data mataches add more points to percent match
                 */
                
                /*
                echo "<pre>";
                echo $temp_location . ", " . $temp_city . ", " .  $temp_state;
                echo "</pre>";
                echo "<pre>";
                echo 'Database ' . $row[city] . ", " .  $row[state];
                echo "</pre>";
                */
                
                $percent = 0.00;
                $percent_ScreenName = 0.00;
                $percent_Description = 0.00;
                $percent_Web = 0.00;
                
                if ($temp_ScreenName and $temp_verified == 1) {
                    similar_text($temp_ScreenName, $row[school_name], $percent_ScreenName);
                    
                    //See if School name is in description
                    if (strpos($temp_Description, $row[school_name]) !== false) {
                        $percent_Description = 100;
                    }
                    //similar_text($temp_Description, $row[school_name], $percent_Description);
                    
                    similar_text($temp_DisplayURL, $row[webaddress], $percent_Web);
                    
                    if ($percent_Description = 100) {
                        $temp_percent = ($percent_ScreenName + $percent_Web + $percent_Description)/3;
                        
                    }
                    else {
                        $temp_percent = ($percent_ScreenName + $percent_Web)/2;
                        
                    }
                    
                    //Increase percent match by 5 percent if Cities match
                    if ($temp_city and strcmp($row[city], $temp_city) == 0){
                        /*
                        echo "<pre>";
                        echo "City matches " . $row[city] . ", " . $temp_city;
                        echo "</pre>";
                        */
                        //Cities match, Add five points
                        $temp_percent += 20;
                        $temp_city_match = 1;
                    }
                    
                    /*
                    echo "<pre>";
                    echo "State Count " . strlen($temp_state) . ", " .strlen($row[state]);                    
                    echo "</pre>";
                    */
                    
                    //Increase percent match by 5 percent if States match
                    if ($temp_state and strlen($temp_state) === strlen($row[state]) and 
                        strcmp($row[state],$temp_state) == 0){
                        /*
                        echo "<pre>";
                        echo "State matches " . $row[state] . ", " . $temp_state;
                        echo "</pre>";
                        */
                        //States match, Add two points
                        $temp_percent += 10;
                        $temp_state_match = 1;
                    }
                    else if(strlen($temp_state) > 2){
                        //Twitter may have full state name
                        //Lookup full state name for Abbrev in Database
                        //Then compare to twitter state
                        
                        /*
                         echo "<pre>";
                         echo $row[state] . ", ". $us_abbrevs_state_names[$row[state]] . ", " . $temp_state;
                         echo "</pre>";
                         */
                        
                         $temp_state = strtoupper($temp_state); 
                        
                         if (strcmp($temp_state, $us_abbrevs_state_names[$row[state]]) == 0 ){
                            //Full State names match, Add two points 
                            /*
                             echo "<pre>";
                             echo "Full State matches " . $us_abbrevs_state_names[$row[state]] . ", " . $temp_state;
                             echo "</pre>";
                             */
                            $temp_percent += 10;
                            $temp_state_match = 1;
                        }
                    }
                    
                    if ($temp_state_match == 1 and $temp_city_match == 1){
                        if($item['followers_count'] != 0){
                            $temp_followers = $item['followers_count']/10000;
                        }
                    }
                    else {
                        if($item['followers_count'] != 0){
                            $temp_followers = $item['followers_count']/1000000;
                        }
                    }
                    
                     //Increase percent match by 1 percent per 1000,000 followers
                    $temp_percent += $temp_followers;
                    
                    //Increase percent by 5 percent if official in description
                    if (strpos($temp_Description, 'official') !== false) {
                        $temp_percent += 5;
                        $temp_official = 1;
                    }
                    
                    if ($temp_percent >= 60.0 and $temp_percent > $holdPercent){
                        $holdPercent = $temp_percent;
                        $twitterScreenName = (string)$item['screen_name'];
                        $twitterName = (string)$item['name'];
                        $twitterURL = (string)$item['entities']['url']['urls'][0]['url'];
                        $twitterDisplayURL = (string)$item['entities']['url']['urls'][0]['display_url'];
                        $twitterExpandedURL = (string)$item['entities']['url']['urls'][0]['expanded_url'];
                        $location = (string)$item['location'];
                        $description = (string)$item['description'];
                        $verified = $item['verified'];
                        $final_percent_web = $percent_Web;
                        $final_percent_screenname = $percent_ScreenName;
                        $final_percent_description = $percent_Description;
                        $final_percent = $temp_percent;
                        $final_official = $temp_official;
                        $final_state_match = $temp_state_match;
                        $final_city_match = $temp_city_match;
                        $final_num_followers = $item['followers_count'];
                    }
                }
            }//end for each Twitter data
            
            if ($holdPercent >= 60.0){
                
                echo "<pre>";
                echo $row[school_name] . ", " . $row[webaddress] . ", " . $row[EFTOTLT] . "; ";
                echo $url_search . $getfield_search;
                echo "</pre>";
                
                //Display Twittter data
                echo "<pre>";
                echo "Twitter Record Final:";
                echo $twitterScreenName . ", " . $twitterName . ", " . $twitterDisplayURL . ", " . $final_percent .
                ", " . $final_percent_screenname . ", " . $final_percent_description . ", " . $final_percent_web . 
                ", " . $holdPercent;
                echo "</pre>";
                
                //add Insert to write data to twitter table
                $stmtInsert->bind_param(	"isssssssiiiidddd",
                    $universityID, $twitterScreenName, $twitterName, $twitterURL,
                    $twitterDisplayURL, $twitterExpandedURL, $location, $description,
                    $verified, $final_official, $final_state_match, $final_city_match, 
                    $final_percent_web, $final_percent_description, $final_num_followers, $final_percent);
                
                $stmtInsert->execute();
                
            }
            
            //Update last update date
            $stmtUpdate->bind_param("s", $universityID);
            $stmtUpdate->execute();
            
        }//End While Loop SQL Institutions
    } //Institution Results IF 
    else {
        echo "0 results";
    }
    
    //Close all connections
    $conn->close();
    $connInsert->close();
    $connUpdate->close();
    
    function startsWith($haystack, $needle)
    {
        $length = strlen($needle);
        return (substr($haystack, 0, $length) === $needle);
    }
    
    function StringCleanup($data)
    {
        //$temp = str_replace('of', '', $data);
        $temp = str_replace('the', '', $data);
        $temp = str_replace('-', ' ', $temp);
        $temp = preg_replace('!\s+!', '%20', $temp);
        //$temp = str_replace(' ', '%20', $temp);
        
        return ($temp);
    }
    
    function connectionCheck(&$connDB){
        if ($connDB->connect_error) {
            die("Connection failed: " . $connDB->connect_error);
        } 
    }
?>	