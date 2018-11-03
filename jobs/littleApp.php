<?php 
    require_once('TwitterAPIExchange.php');
    
    echo "<h2>Simple Twitter API Test</h2>";
    
    /** Set access tokens here - see: https://dev.twitter.com/apps/ **/
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
    
    //Connet to Twitter
    $twitter = new TwitterAPIExchange($settings);
    $string = json_decode($twitter->setGetfield($getfield_lookup)
        ->buildOauth($url_lookup, $requestMethod)
        ->performRequest(),$assoc = TRUE);
    
    if(array_key_exists("errors", $string)) {
        echo "<h3>Sorry, there was a problem.</h3>" .
             "<p>Twitter returned the following error message:</p>" .
             "<p><em>".$string[errors][0]["message"]."</em></p>";
        
        exit();
    }
    echo "<pre>";
    print_r($string);
    echo "</pre>";

?>