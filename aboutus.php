<!DOCTYPE html 
	PUBLIC 	"-//W3C//DTD XHTML 1.0 Transitional//EN" 
			"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>The College Roar</title>
    <?php require 'loadLinks.php'; ?>
</head>
<body>
	<?php require 'header.php'; ?>

	<div id="main">
		<div id="links">
			<?php require 'collegeLinks.php'; ?>
		</div>

		<div id="article">
			<h1>About us</h1>
	        <p id="indent">	We are the College Roar, a website dedicated to providing
	        	students, prospective students and their parents with a unique and inventive 
	        	resource for statistical data for US colleges and universities.  We have 
	        	acceptance rates, tuition costs, demographic details for all the major
	        	US colleges and Universities.
	        </p>
	        </br>
	        <img id="me" src="Images/emoji/myemoji.png" 
				width="250px"
				height="auto">
	  
	        <p id="indent">	We also collect social media data and contact 
	        	details for colleges and universities.  Users can follow and unfollow
	        	schools on various social media platforms such as Twitter, Instagram 
	        	and Facebook right from our website.
	        </p>
	        </br>
	        <p id="indent">	Users can also create their own account and we will work to 
	        	match respective students with schools threw out the US based on the
	        	students demographics, education and interests.  We have access to 
	        	hundreds of data points for school large to small, public to private
	        	and junior college to the major universities.
	        </p>
	        <p><a href="registration.php">Sign Up Today!</a></p>
	        <!--  Comment out for Now, 08/08/2018
	  		<h2>Education:</h2>
	        <div id="p">
	        	<ul>
	        		<li>
	        			Bachelor's Degree from 
	        			<a href="https://www.jefferson.edu/">Philadelphia University</a>
	        		</li>
	        		<li>
	        			Master's Degree in Computer Science from 
	        			<a href="http://cs.sju.edu/">Saint Joseph's University</a>
	        		</li>
	        	</ul>
	        </div>	
	       	</br>
	       	<h2>Interests:</h2>
	        <p>Amatuer portrait and landscape photograpy</p>
	  		<p>Avid Sports Ethusiasts</p>
	  		</br>
	  		<h2>Volunteer:</h2>
	        <p>Support local athletic organization as coach for baseball, football and soccer</p>
	  		</br>
	        -->
	        <p>
    	        Please bookmark our site and come back often for updated content.<br/>
    	        John - Webmaster at thecollegeroar.com<br/>
    	        <a href="mailto:john@thecollegeroar.com?subject=Comments about The College Roar website">Contact Us</a> 
	        </p> 
		</div>

		<div id="news">
			<div class="panel-heading">
            	<h3 class="panel-title">
            		<ul>
            			<li><img 	src="Images/Social/Twitter_570625.png" 
							width="50px"
							height="auto"></li>
						<li>The College Roar Live</li>	
					</ul>
            	</h3>
            </div>
            <div class="panel-body">
            	<div class="twitter">
			        <a class="twitter-timeline"
			          href="https://twitter.com/thecollegeroar"
			          data-widget-id="597082223712608257"
			          data-screen-name="thecollegeroar"
			          data-show-replies="false"
			          data-tweet-limit="5">
			          Tweets by @thecollegeroar
			        </a>
			        <script>
			          !function(d,s,id){
			            var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';
			            if(!d.getElementById(id)){
			              js=d.createElement(s);
			              js.id=id;
			              js.src=p+"://platform.twitter.com/widgets.js";
			              fjs.parentNode.insertBefore(js,fjs);
			            }
			          }
			          
			          (document,"script","twitter-wjs");
			        </script>
		      	</div>
			</div>
         </div>
	</div>
	<div id="footer">Copyright information</div>

</body>
</html>