 <!DOCTYPE html>
	<!-- 	Author:      John Booz
	//***		Date:        01/06/2015
	//***		Filename:    universityDisplay.php
	//***		Description: PHP file to display college / university data.-->
	
  
  <html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <?php require 'loadLinks.php'; ?>
    </head>
    <body>
        <?php require 'header.php'; ?>
            <div id="main">
        		<div id="links">
        			<?php require 'collegeLinks.php'; ?>
    			</div>
    
        		<div id="article">
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
                    	<div class="twitter"></div>
        			</div>
                 </div>
        	</div>
    	<div id="footer">Copyright information</div>
    	<script>
    	   <?php
    			   
    		    $universityID = $_GET['id'];
    		    echo "var id = " . $universityID . ";";
    		?>
    		
    		var address = [];
    		var Univlinks = [];
    		var twitterLinks = [];
    		var admissions = [];
    		var test_Score_data = [];
    		var myObj, x;
    		var name, address, city, state, zip;
    		var dataset1 = [ 5, 10, 15, 20, 25 ];
    		d3.json("college_lookup_byID.php?id="+id, function(data) {

    			
        			data.forEach(function(d) {
        		   		address.push(d.school_name);
        		   		address.push(d.address);
        		   		address.push(d.city + ", " + d.state + " " + d.zip);
        		   		address.push("Phone: " + format_Phone(d.telephone));
        		   		address.push("Fax: " + format_Phone(d.fax));
    
        		   		/*
        		   		admissions.push({name: 'Male', percent: Math.round((d.EFTOTLM/d.EFTOTLT)*1000)/10, color: '#0080FF'});
        		   		admissions.push({name: 'Female', percent: Math.round((d.EFTOTLW/d.EFTOTLT)*1000)/10, color: '#FFC0CB'});
    					*/
    
    					/*
        		   		admissions.push({name: 'Male', percent: Math.round((d.EFTOTLM/d.EFTOTLT)*1000)/10, color: '#2EC4B6'});
        		   		admissions.push({name: 'Female', percent: Math.round((d.EFTOTLW/d.EFTOTLT)*1000)/10, color: '#944BBB'});
    					*/
    					
        		   		admissions.push({name: 'Male', percent: Math.round((d.EFTOTLM/d.EFTOTLT)*1000)/10, color: '#D9B310'});
        		   		admissions.push({name: 'Female', percent: Math.round((d.EFTOTLW/d.EFTOTLT)*1000)/10, color: '#375f7a'});
        		   		//Push Test Score Data; SAT and ACT
        		   		var sTestID = "Test ID";
        		   		var s25_Per_Value = "25 Percentile";
        		   		var s75_Per_Value = "75 Percentile";
        		   		
        		   		test_Score_data.push ({
            		   			"Description": "SAT Reading / Writing",	
            		   			"25 Percentile": d.SATVR25,	
            		   			"75 Percentile": d.SATVR75});
    		   			
        		   		test_Score_data.push ({
            		   			"Description": "SAT Math",
            		   			"25 Percentile": d.SATMT25,
            		   			"75 Percentile": d.SATMT75});
    		   			
        		   		test_Score_data.push ({
            		   			"Description": "ACT Composite",
            		   			"25 Percentile": d.ACTCM25,
            		   			"75 Percentile": d.ACTCM75});
    		   			
        		   		test_Score_data.push ({
            		   			"Description": "ACT English",
            		   			"25 Percentile": d.ACTEN25,
            		   			"75 Percentile": d.ACTEN75});
    		   			
        		   		test_Score_data.push ({
            		   			"Description": "ACT Math",
            		   			"25 Percentile": d.ACTMT25,
            		   			"75 Percentile": d.ACTMT75});
        		   		
        		   		/*
        		   		address.push(d.screen_name);
        		   		address.push(d.percent_match);
        		   		address.push(d.description);
        		   		*/
        		   		console.log(d);
        		   		console.log(admissions);
        		   		console.log(address);
    
        		   		Univlinks.push("<a href='https://" + d.webaddress + "'>Home</a>");
        		   		Univlinks.push("<a href='https://" + d.webadmissions + "'>Admissions</a>");
        		   		Univlinks.push("<a href='https://" + d.webfinaid + "'>Financial aid</a>");
        		   		Univlinks.push("<a href='https://" + d.netpriceurl + "'>Net price</a>");


        		   		if (d.screen_name !== null) {
            			 	d.screen_name = d.screen_name.replace(/\s+/g, '');
        
            			 	/*Can I validate Twitter handle?*/
            				twitterLinks.push("<a class='twitter-timeline' " + 
                    			"href='https://twitter.com/" + d.t_name + "?ref_src=twsrc%5Etfw' " +
                    		  	"data-tweet-limit='5'>" +
                    		  	"Tweets by " + d.t_name + "</a>");
        		   		}
        		   		else {
        		   			twitterLinks.push("<a  class='twitter-timeline' " + 
            								  "href='https://twitter.com/thecollegeroar?ref_src=twsrc%5Etfw' " +
            								  "data-tweet-limit='5'>" +
              								  "Tweets by thecollegeroar</a>"); 

        		   		}
            			
    					/*	Twitter Collection
    						Need to determine if I can make these dynamic
            		   		twitterLinks.push("<a class='twitter-grid' " + 
            		   				"href='https://twitter.com/thecollegeroar/timelines/1032301751104352257'>" +
                		   			"Tweets by " + d.screen_name + "</a>");
        		   		*/
        		    });
        		   
       				d3.select('#article')
                	.append('div')
                   	.attr("class","address")
                	.html(address.join('<br/>'));
    
       				d3.select('#article')
                	.append('div')
                   	.attr("class","school_links")
                	.html(Univlinks.join('<br/>'));
    
       				d3.select('#article')
                	.append('div')
                   	.attr("id","chart1")
                   	.html();
                	
       				//createpie_colors("chart1", admissions, 300, 300);	
    
       				createpie_colors_border("chart1", admissions, 300, 300);
    
                	d3.select('head')
                	.append('title')
                	.html("Display: " + address[0]);
    
                	d3.select('.twitter')
                	.html(twitterLinks[0]);

                	twttr.widgets.load();
    
                	var table_plot = makeTable()
            		.datum(test_Score_data)
            		.tableid('table1');
    
                	d3.select('#article')
                	.append('div')
                   	.attr("id","container")
                   	.html();
                   	
            		d3.select('#container').call(table_plot);
    			
   			
    		});		

			function format_Phone(data){
				var tempStr;
				if (data.length === 10){
					tempStr = data.substr(0,3) + "-" + data.substr(3,3) + "-" + data.substr(6,4);
				} else{
					tempStr = data;
				}
				return(tempStr); 
			}
    	</script>
	</body>
</html>