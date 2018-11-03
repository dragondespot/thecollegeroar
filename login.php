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
			<h2>Log In</h2>
			</Br>
			<div class="container" id="LoginUserForm">
            <form  action="login.php" method="post">
            		
            		<div class="row">
                   		<div class="col-25">
                       		<label for="fname">First Name</label>
                      	</div>
                    	<div class="col-75">
                        	<input type="text" id="fname" name="firstname" placeholder="Your name..">
                      	</div>
                    </div>
                    <div class="row">
                      	<div class="col-25">
                        	<label for="lname">Last Name</label>
                      	</div>
                      	<div class="col-75">
                        	<input type="text" id="lname" name="lastname" placeholder="Your last name..">
                      	</div>
                    </div>
                    <div class="row">
                   		<div class="col-25">
                       		<label for="fname">First Name</label>
                      	</div>
                    	<div class="col-75">
                        	<input type="text" id="fname" name="firstname" placeholder="Your name..">
                      	</div>
                    </div>
                    <div class="row">
                      	<div class="col-25">
                        	<label for="lname">Last Name</label>
                      	</div>
                      	<div class="col-75">
                        	<input type="text" id="lname" name="lastname" placeholder="Your last name..">
                      	</div>
                    </div>
                    <div class="row">
                   		<div class="col-25">
                       		<label for="fname">First Name</label>
                      	</div>
                    	<div class="col-75">
                        	<input type="text" id="fname" name="firstname" placeholder="Your name..">
                      	</div>
                    </div>
                    <div class="row">
                      	<div class="col-25">
                        	<label for="lname">Last Name</label>
                      	</div>
                      	<div class="col-75">
                        	<input type="text" id="lname" name="lastname" placeholder="Your last name..">
                      	</div>
                    </div>
                    
            		<!-- 
                	<p>
                    	<label for="email">Email</label>
                    	<input id="email" name="email" type="email" class="text" value="" />
                  	</p>
                      
                  	<p>
                    	<label for="password">Password</label>
                    	<input id="password" name="password" class="text" type="password" />
                  	</p>
                  	<p>
                  		<a href="forgotLogin.php">Forgot Login</a>
                    	<a href="password.php">Forgot Password?</a>
        		  	</p>	
                  	<p>
                    	<button id="loginNew" type="submit" name="submit">Login</button>
                  	</p>
                  	 -->
               
              </form>	
              </div>
             
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