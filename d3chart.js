
function createpie() {
	var data = [10, 20, 100];
	
			var width = 960,
			    height = 500,
			    radius = Math.min(width, height) / 2;
	
			var color = d3.scaleOrdinal()
			    .range(["#98abc5", "#8a89a6", "#7b6888"]);
	
			var arc = d3.arc()
			    .outerRadius(radius - 10)
			    .innerRadius(0);
	
			var labelArc = d3.arc()
			    .outerRadius(radius - 40)
			    .innerRadius(radius - 40);
	
			var pie = d3.pie()
			    .sort(null)
			    .value(function(d) { return d; });
	
			var svg = d3.select("#chart").append("svg")
			    .attr("width", width)
			    .attr("height", height)
			  .append("g")
			    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
	
			  var g = svg.selectAll(".arc")
			      .data(pie(data))
			      .enter().append("g")
			      .attr("class", "arc");
	
			  g.append("path")
			      .attr("d", arc)
			      .style("fill", function(d) { return color(d.data); });
	
			  g.append("text")
			  	.attr("text-anchor", "middle")
			  	.attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
			  	.attr("dy", ".35em")
			  	.text(function(d) { return d.data; });
}

function createpie(d, data) {
	//var data = [10, 20, 100];
	
			var width = 960,
			    height = 500,
			    radius = Math.min(width, height) / 2;
	
			var color = d3.scaleOrdinal()
			    .range(["#98abc5", "#8a89a6", "#7b6888"]);
			
	
			var arc = d3.arc()
			    .outerRadius(radius - 10)
			    .innerRadius(0);
	
			var labelArc = d3.arc()
			    .outerRadius(radius - 40)
			    .innerRadius(radius - 40);
	
			var pie = d3.pie()
			    .sort(null)
			    .value(function(d) { return d; });
	
			var svg = d3.select("#" + d).append("svg")
			    .attr("width", width)
			    .attr("height", height)
			  .append("g")
			    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
	
			  var g = svg.selectAll(".arc")
			      .data(pie(data))
			      .enter().append("g")
			      .attr("class", "arc");
	
			  g.append("path")
			      .attr("d", arc)
			      .style("fill", function(d) { return color(d.data); });
	
			  g.append("text")
			      .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
			      .attr("dy", ".35em")
			      .text(function(d) { return d.data; });
}

function createpie(d, data, width, height) {
	//var data = [10, 20, 100];
	
			/*var width = 960,
			    height = 500,*/
			    
			var radius = Math.min(width, height) / 2;
	
			var color = d3.scaleOrdinal()
			    .range(["#98abc5", "#8a89a6", "#7b6888"]);
			
	
			var arc = d3.arc()
			    .outerRadius(radius - 10)
			    .innerRadius(0);
	
			var labelArc = d3.arc()
			    .outerRadius(radius - 40)
			    .innerRadius(radius - 40);
	
			var pie = d3.pie()
			    .sort(null)
			    .value(function(d) { return d; });
	
			var svg = d3.select("#" + d).append("svg")
			    .attr("width", width)
			    .attr("height", height)
			  .append("g")
			    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
	
			  var g = svg.selectAll(".arc")
			      .data(pie(data))
			      .enter().append("g")
			      .attr("class", "arc");
	
			  g.append("path")
			      .attr("d", arc)
			      .style("fill", function(d) { return color(d.data); });
	
			  g.append("text")
			      .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
			      .attr("dy", ".35em")
			      .text(function(d) { return d.data; });
}

function createpie_labels(d, data, colors, width, height) {
			//var data = [10, 20, 100];
	
			/*var width = 960,
			    height = 500,*/
			    
			var radius = Math.min(width, height) / 2;
	
			/*ar color = d3.scaleOrdinal()
			    .range(["#98abc5", "#8a89a6", "#7b6888"]);*/
			
			/*var color = d3.scaleOrdinal().domain(["banana", "cherry", "blueberry"])
            								.range(["#eeff00", "#ff0022", "#2200ff"]);*/
			
			/*var color = d3.scaleOrdinal()
				.range([ '#FFC0CB', '#0080FF']);*/
			
			var color = d3.scaleOrdinal()
			.range(colors);
	
			var arc = d3.arc()
			    .outerRadius(radius - 10)
			    .innerRadius(0);
	
			var labelArc = d3.arc()
			    .outerRadius(radius - 40)
			    .innerRadius(radius - 40);
	
			var pie = d3.pie()
			    .sort(null)
			    .value(function(d) { return d.percent; });	/*Enter Field from array*/
	
			var svg = d3.select("#" + d).append("svg")
			    .attr("width", width)
			    .attr("height", height)
			  .append("g")
			    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");
	
			  var g = svg.selectAll(".arc")
			      .data(pie(data))
			      .enter().append("g")
			      .attr("class", "arc");
	
			  g.append("path")
			      .attr("d", arc)
			      .style("fill", function(d, i) { return color(i); });
	
			  g.append("text")
			      .attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
			      .attr("dy", ".35em")
			      .text(function(d) { return d.data.name + " (" + d.data.percent + "%)"; });
}

function createpie_colors(d, data, width, height) {
	//var data = [10, 20, 100];

	/*var width = 960,
	    height = 500,*/
	    
	var radius = Math.min(width, height) / 2;

	/*ar color = d3.scaleOrdinal()
	    .range(["#98abc5", "#8a89a6", "#7b6888"]);*/
	
	/*var color = d3.scaleOrdinal().domain(["banana", "cherry", "blueberry"])
    								.range(["#eeff00", "#ff0022", "#2200ff"]);*/
	
	var colorcodes = [];
	var labels = [];
	var color;
	
	var printError = function(error, explicit) {
	    console.log("[${explicit ? 'EXPLICIT' : 'INEXPLICIT'}] ${error.name}: ${error.message}");
	}

	try{
		var i;
		for (i = 0; i < data.length; i++) {
			colorcodes[i] = data[i].color;
			labels[i] = data[i].name;
		} 
		
		/*var color = d3.scaleOrdinal()
			.range(colorcodes);*/
		
		/*
		for (i = 0; i < colorcodes.length; i++) {
			document.getElementById('array').innerHTML += '<br>' + labels[i] + ", " + colorcodes[i];
		} */
		
		if (typeof(colorcodes[0]) == 'undefined') {
			color = d3.scaleOrdinal(d3.schemeCategory10);
		}
		else{
			color = d3.scaleOrdinal().domain(labels)
			.range(colorcodes);
		}
		
	} catch (e) {
		if (e instanceof RangeError) {
			color = d3.scaleOrdinal(d3.schemeCategory10);
		}
		else{
			printError(e, false);
		}
		
	}
	/*var color = d3.scaleOrdinal()
		.range(function(d) { return d.data.color; });*/

	var arc = d3.arc()
	    .outerRadius(radius - 10)
	    .innerRadius(0);

	var labelArc = d3.arc()
	    .outerRadius(radius - 40)
	    .innerRadius(radius - 40);

	var pie = d3.pie()
	    .sort(null)
	    .value(function(d) { return d.percent; });	/*Enter Field from array*/

	var svg = d3.select("#" + d).append("svg")
	    .attr("width", width)
	    .attr("height", height)
	    .append("g")
	    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

	  var g = svg.selectAll(".arc")
	      .data(pie(data))
	      .enter().append("g")
	      .attr("class", "arc");
	  /*
	  g.append("path")
	      .attr("d", arc)
	      .style("fill", function(d) { return data.color; });
	  */
	  g.append("path")
      .attr("d", arc)
      .style("fill", function(d, i) { return color(i); });

	  g.append("text")
	  	.attr("text-anchor", "middle")
	  	/*
	  	.attr("transform", function(d) { return "translate(" + labelArc.centroid(d) + ")"; })
	  	*/
	  	.attr("transform", function(d) {
	  		var c = arc.centroid(d),
	  		x = c[0],
	  		y = c[1],
	  		// pythagorean theorem for hypotenuse
	  		h = Math.sqrt(x*x + y*y);
	  		return "translate(" + (x/h * (radius*0.4)) +  ',' + (y/h * (radius*0.4)) +  ")"; 
	  	})
	  	
	  	.attr("dy", ".35em")
	  	.text(function(d) { return d.data.name + " (" + d.data.percent + "%)"; });
	  
}

function createpie_colors_border(d, data, width, height) {
	var border = 5;
	var radius = (Math.min(width, height) / 2) - border;
	var colorcodes = [];
	var labels = [];
	var color;
	
	var printError = function(error, explicit) {
	    console.log("[${explicit ? 'EXPLICIT' : 'INEXPLICIT'}] ${error.name}: ${error.message}");
	}

	try{
		var i;
		for (i = 0; i < data.length; i++) {
			colorcodes[i] = data[i].color;
			labels[i] = data[i].name;
		} 
		
		/*var color = d3.scaleOrdinal()
			.range(colorcodes);*/
		
		/*
		for (i = 0; i < colorcodes.length; i++) {
			document.getElementById('array').innerHTML += '<br>' + labels[i] + ", " + colorcodes[i];
		} */
		
		if (typeof(colorcodes[0]) == 'undefined') {
			color = d3.scaleOrdinal(d3.schemeCategory10);
		}
		else{
			color = d3.scaleOrdinal().domain(labels)
			.range(colorcodes);
		}
		
	} catch (e) {
		if (e instanceof RangeError) {
			color = d3.scaleOrdinal(d3.schemeCategory10);
		}
		else{
			printError(e, false);
		}
		
	}
	
	var arc = d3.arc()
	    .outerRadius(radius)
	    .innerRadius(0);

	var labelArc = d3.arc()
	    .outerRadius(radius * 0.85)
	    .innerRadius(radius * 0.85);
	
	var arcBorder = d3.arc()
		.outerRadius(radius + border)
		.innerRadius(radius);

	var pie = d3.pie()
	    .sort(null)
	    .value(function(d) { return d.percent; });	/*Enter Field from array*/

	var svg = d3.select("#" + d).append("svg")
	    .attr("width", width)
	    .attr("height", height)
	    .append("g")
	    .attr("transform", "translate(" + width / 2 + "," + height / 2 + ")");

	  var g = svg.selectAll(".arc")
	      .data(pie(data))
	      .enter().append("g")
	      .attr("class", "arc");
	  
	  g.append("path")
      	.attr("d", arc)
      	.style("fill", function(d, i) { return color(i); });
	  
	  g.append("path")
	    .attr("fill", "black")
	    .attr("d", arcBorder);

	  g.append("text")
	  	.attr("text-anchor", "middle")
	  	.attr("transform", function(d) {
	  		var c = arc.centroid(d),
	  		x = c[0],
	  		y = c[1],
	  		// pythagorean theorem for hypotenuse
	  		h = Math.sqrt(x*x + y*y);
	  		return "translate(" + (x/h * (radius*0.4)) +  ',' + (y/h * (radius*0.4)) +  ")"; 
	  	})
	  	
	  	.attr("dy", ".35em")
	  	.text(function(d) { return d.data.name + " (" + d.data.percent + "%)"; });
	
	
}

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(returnPosition);
    } else {
        
    }
}

function showPosition(position) {
    
}

function returnPosition(position) {
	var coordinates;
    coordinates.push({lat: position.coords.latitude, long: position.coords.longitude});
    console.log(coordinates);
    return(coordinates);
}