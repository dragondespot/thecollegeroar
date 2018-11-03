
<a href="displayUniv.php?id=186131">Princeton University</a>
<a href="displayUniv.php?id=166027">Harvard University</a>
<a href="displayUniv.php?id=144050">The University of Chicago</a>
<a href="displayUniv.php?id=190150">Columbia University</a>
<a href="displayUniv.php?id=110422">Cal Poly</a>


<script>

	var links = [];

	d3.json("search_college_byLocation.php", function(data) {
		console.log(data);
		data.forEach(function(d) {
   			links.push("<a href='displayUniv.php?id=" + d.unitid + "'>" + d.school_name + "</a>");
   		
    	});	

	//console.log(links);

      	d3.select('#links')
       		.append('div')
           	.attr("class","school_links")
        	.html(links.join(''));
        	
 	});		
    
    /*
    if (navigator.geolocation) {
    	navigator.geolocation.getCurrentPosition(showPosition);
   	} 
	
    function showPosition(position) {
        x.innerHTML = "Latitude: " + position.coords.latitude + 
        "<br>Longitude: " + position.coords.longitude;

        var links = [];
       	/*
        d3.json("search_college_byLocation.php?lat=" + position.coords.latitude + "&long=" + position.coords.longitude, function(data) {
        	console.log(data);
        	data.forEach(function(d) {
           		links.push("<a href='displayUniv.php?id=" + d.unitid + "'>" + d.school_name + "</a>");
           		
            });
		
		
      	d3.json("search_college_byLocation.php, function(data) {
        	console.log(data);
          	data.forEach(function(d) {
            	links.push("<a href='displayUniv.php?id=" + d.unitid + "'>" + d.school_name + "</a>");
                		
         	});

        //console.log(links);

        d3.select('#links')
    	.append('div')
       	.attr("class","school_links")
    	.html(links.join(''));
    	
        });		
            
    }

    */
</script>