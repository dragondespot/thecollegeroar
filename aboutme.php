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
			<h1>About me</h1>
	        <p id="indent">	My name is John Booz and I am full-time Computer Science professional
	        	and part-time web developer for the The College Roar.  This website 
	        	started as school project while studying for my Master's degree in 
	        	Computer Science at St. Joseph's University (SJU) in Philadelphia.
	        </p>
	        </br>
	        <img id="me" src="Images/emoji/me.png" 
				width="250px"
				height="auto">
	  		<p id="indent">	This project was intended to be an exercise to help me improve,
	  			expand and hone my website design and coding experience while continuing 
	  			to apply techniques taught at SJU.  To develop this site, I have used html, 
	  			css, jscript and php.
	        </p>
	        </br>
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