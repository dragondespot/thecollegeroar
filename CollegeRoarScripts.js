

    $(document).ready(function() {
      $('.toggle:not(.toggle-open)') .addClass('toggle-closed') .parents('li') .children('ul') .hide();
      $('.toggle_a:not(.toggle-open)') .addClass('toggle-closed') .parents('li') .children('ul') .hide();
    	
    	if($.browser.msie){
    		$('#menu ul.navmenu li:last-child .menutop') .css('border-bottom','1px solid #CCC');
    	}
    							
    	$('.toggle') .click(function(){
    		if ($(this) .hasClass('toggle-open')) {
    			$(this) .removeClass('toggle-open') .addClass('toggle-closed') .empty('') .append('<img src="arrow_next2.gif" />') .parents('li') .children('ul') .slideUp(250);
    			$(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
    		}else{
    			$(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
    			$(this) .removeClass('toggle-closed') .addClass('toggle-open') .empty('') .append('<img src="downgreen.gif" />') .parents('li') .children('ul') .slideDown(250);
    		}
    	})   
      
      $('.toggle_a') .click(function(){
        if ($(this) .hasClass('toggle-open')) {		
          $(this) .removeClass('toggle-open') .addClass('toggle-closed') .parents('li') .children('ul') .slideUp(250);
          $(this) .parent('.menutop') .removeClass('menutop-open') .addClass('menutop-closed');
    		}else{
          $(this) .parent('.menutop') .removeClass('menutop-closed') .addClass('menutop-open');
          $(this) .removeClass('toggle-closed') .addClass('toggle-open') .parents('li') .children('ul') .slideDown(250);
        }
    		
    		var src = ($(this).children("img:first").attr('src') === '/images/arrow_next2.gif')
			            ? '/images/downgreen.gif'
			            : '/images/arrow_next2.gif';
		    $(this).children("img:first").attr('src', src);
    	})     
                                                            
    })
    
    $(document).ready(function() {
      /*
      * In-Field Label jQuery Plugin
      * http://fuelyourcoding.com/scripts/infield.html
      *
      * Copyright (c) 2009 Doug Neiner
      * Dual licensed under the MIT and GPL licenses.
      * Uses the same license as jQuery, see:
      * http://docs.jquery.com/License
      *
      * @version 0.1
      */
      (
      function($) { 
        $.InFieldLabels = 
          function(label, field, options) { 
            var base = this; 
            base.$label = $(label); 
            base.$field = $(field); 
            base.$label.data("InFieldLabels", base); 
            base.showing = true; 
            
            base.init = 
              function() { 
                base.options = $.extend({}, $.InFieldLabels.defaultOptions, options); 
                base.$label.css('position', 'absolute'); 
                var fieldPosition = base.$field.position(); 
                base.$label.css({ 'left': fieldPosition.left, 'top': fieldPosition.top }).addClass(base.options.labelClass); 
                if (base.$field.val() != "") { 
                  base.$label.hide(); 
                  base.showing = false; 
                }; 
                
                base.$field.focus(
                  function() { 
                    base.fadeOnFocus(); 
                  }).blur(function() { 
                    base.checkForEmpty(true); 
                  }).bind('keydown.infieldlabel', 
                    function(e) { 
                      base.hideOnChange(e); 
                    }).change(
                      function(e) { 
                        base.checkForEmpty(); 
                      }).bind('onPropertyChange', 
                        function() { 
                          base.checkForEmpty(); 
                        }); 
              }; 
              base.fadeOnFocus = 
                function() { 
                  if (base.showing) { 
                    base.setOpacity(base.options.fadeOpacity); 
                  }; 
                }; 
              base.setOpacity = 
                function(opacity) { 
                  base.$label.stop().animate({ opacity: opacity }, 
                  base.options.fadeDuration); 
                  base.showing = (opacity > 0.0); 
                }; 
              base.checkForEmpty = 
                function(blur) { 
                  if (base.$field.val() == "") { 
                    base.prepForShow(); 
                    base.setOpacity(blur ? 1.0 : base.options.fadeOpacity); 
                  } 
                  else { 
                    base.setOpacity(0.0); 
                  }; 
                }; 
              base.prepForShow = 
                function(e) { 
                  if (!base.showing) { 
                    base.$label.css({ opacity: 0.0 }).show(); 
                    base.$field.bind('keydown.infieldlabel', 
                      function(e) { 
                        base.hideOnChange(e); 
                      }); 
                    }; 
                  }; 
                base.hideOnChange = 
                  function(e) { 
                    if ((e.keyCode == 16) || (e.keyCode == 9)) return; 
                    if (base.showing) { 
                      base.$label.hide(); 
                      base.showing = false; 
                    }; 
                    base.$field.unbind('keydown.infieldlabel'); 
                  }; 
                base.init(); 
              }; 
              
              $.InFieldLabels.defaultOptions = { fadeOpacity: 0.5, fadeDuration: 300, labelClass: 'infield' }; 
              $.fn.inFieldLabels = 
                function(options) { 
                  return this.each(
                    function() { 
                      var for_attr = $(this).attr('for'); 
                      if (!for_attr) return; 
                      var $field = $("input#" + for_attr + "[type='text']," + "input#" + for_attr + "[type='password']," + "input#" + for_attr + "[type='tel']," + "input#" + for_attr + "[type='email']," + "textarea#" + for_attr); 
                      if ($field.length == 0) return; 
                      (new $.InFieldLabels(this, $field[0], options)); 
                    }); 
                  }; 
            })(jQuery);
        $("#RegisterUserForm label").inFieldLabels();
        $("#LoginUserForm label").inFieldLabels();
		});
    
    function showmore(){
      if ($(this).parent('.show-more-snippet')) {
        var obj = $(this).parent('.show-more-snippet');	
        if (obj.css('height') != '35px'){
          obj.stop().animate({height: '35px'}, 200);
          $(this).text('More...');
        }
        else{
          obj.css({height:'100%'});
          var xx = $(this).parent.height();
          obj.css({height:'35px'});
          obj.stop().animate({height: xx}, 400);
            // ^^ The above is beacuse you can't animate css 
            //to 100% (or any percentage).  
            //So I change it to 100%, get the value, change it back, then animate 
            //it to the value. If you don't want animation, you can ditch all of 
            //it and just leave: $('.show-more-snippet').css({height:'100%'});^^ 
          $(this).text('Less...');
        }	
      }
    }
    
    //*** In this example university data is read from MySql DB
    var xmlhttp = new XMLHttpRequest();
  
    //*** the event handler begins here *****************************
    xmlhttp.onreadystatechange=function() {
  
      //*** response is ready
      if ((xmlhttp.readyState == 4) && (xmlhttp.status == 200)) {
        //*** results return as a table 
      	//***that is plugged into myDiv
        //document.getElementById("displaySearchResults").innerHTML = xmlhttp.responseText;
            
        var jsonResponse = JSON.parse(xmlhttp.responseText);
        document.getElementById(jsonResponse['divID']).innerHTML = jsonResponse['results'];
            
        if(jsonResponse['divID'] == "displaySearchResults"){
          lookupTwitter();
        }
        else if(jsonResponse['divID'] == "displayBrowse") {
              
        }
            
      }
  
    } // onreadystatechange ******************************************
    
  //*** In this example university data is read from MySql DB
    var xmlhttpResetPassword = new XMLHttpRequest();
  
    //*** the event handler begins here *****************************
    xmlhttpResetPassword.onreadystatechange=function() {
  
      //*** response is ready
      if ((xmlhttpResetPassword.readyState == 4) && (xmlhttpResetPassword.status == 200)) {
        //*** results return as a table 
      	//***that is plugged into myDiv
        document.getElementById("registration").innerHTML += xmlhttpResetPassword.responseText;
            
      }
  
    } // onreadystatechange ******************************************
    
    var twitter_xmlhttp = new XMLHttpRequest();
  
      //*** the event handler begins here *****************************
      twitter_xmlhttp.onreadystatechange=function() {
  
        //*** response is ready
        if ((twitter_xmlhttp.readyState == 4) && (twitter_xmlhttp.status == 200)) {
          //*** results return as a table 
    			//***that is plugged into myDiv
          //document.getElementById("displaySearchResults").innerHTML = xmlhttp.responseText;
          
          //var twitterjsonResponse = JSON.parse(twitter_xmlhttp.responseText);
          
          document.getElementById("displayTwitter").innerHTML = twitter_xmlhttp.responseText
          twttr.widgets.load(document.getElementById("displayTwitter"));
          
        }
  
      } // Twitter onreadystatechange ******************************************
    
    function stateSearch(passState, lowerLimit, upperLimit) {
                                                                 
        //*** prepare the server URL and query string
        var URL = "universitySearchbyStateData.php";
                
        var queryString = "state=" + passState;
            queryString += "&divID=displayStateResults";
            queryString += "&output=json";
            queryString += "&lowerLimit=" + lowerLimit;
            queryString += "&upperLimit=" + upperLimit;
  				  
  			//URL = URL + "?" + queryString;
        //*** open up the asynchronous request to server
        xmlhttp.open("POST", URL, true);
  
  
        //*** send the finalized request
        xmlhttp.setRequestHeader("Content-Type", 
  				  									   "application/x-www-form-urlencoded");
        xmlhttp.send(queryString);
        
      } // stateSearch
      
      function regionSearch(passRegionID, lowerLimit, upperLimit) {
                                                                 
        //*** prepare the server URL and query string
        var URL = "universitySearchbyRegionData.php";
                
        var queryString = "region=" + passRegionID;
            queryString += "&divID=displayStateResults";
            queryString += "&output=json";
            queryString += "&lowerLimit=" + lowerLimit;
            queryString += "&upperLimit=" + upperLimit;
  				  
  			//URL = URL + "?" + queryString;
        //*** open up the asynchronous request to server
        xmlhttp.open("POST", URL, true);
  
  
        //*** send the finalized request
        xmlhttp.setRequestHeader("Content-Type", 
  				  									   "application/x-www-form-urlencoded");
        xmlhttp.send(queryString);
        
      } // regionSearch
      
      //*** initiate the asynchronous request
      function ajaxSearch(passID) {
                                                                 
        //*** prepare the server URL and query string
        var URL = "universitySearch.php";
                
        //var queryString = "id=" + document.getElementById('search').value;
        //var queryString = "id=" + passID;
        
        var queryString = "id=" + passID;
            queryString += "&divID=displayStateResults";
            queryString += "&output=json";
  				  
  			//URL = URL + "?" + queryString;
        //*** open up the asynchronous request to server
        xmlhttp.open("POST", URL, true);
  
  
        //*** send the finalized request
        xmlhttp.setRequestHeader(	"Content-Type", 
  				  					"application/x-www-form-urlencoded");
        xmlhttp.send(queryString);
        
        document.getElementById("univerity_id").value = passID;
        
        //Call Twitter function
        lookupTwitter(passID);
        
      } // ajaxFunction
      
      function lookupEnrollment(passID, passEnrollmentID) {
  
        //*** prepare the server URL and query string
        var URL = "EnrollmentSearch.php";
                
        //var queryString = "id=" + document.getElementById('search').value;
        var queryString = "id=" + passID + "&enrollmentid=" + passEnrollmentID;
  				  
  			//URL = URL + "?" + queryString;
        //*** open up the asynchronous request to server
        xmlhttp.open("POST", URL, true);
  
  
        //*** send the finalized request
        xmlhttp.setRequestHeader("Content-Type", 
  				  									   "application/x-www-form-urlencoded");
        xmlhttp.send(queryString);
        
        //var selectEnrollment = document.getElementById('titleEnrollmentDescription')
        //$( "#myselect option:selected" ).text();
        //var enrollmentDesc = $( "#searchEnrollment option:selected" ).text();
        //selectEnrollment.innerHTML = "<h2>Enrollment: " + enrollmentDesc + "</h2>";
  
      } // lookupEnrollment
      
      function lookupTwitter(passID) {
  
        //*** prepare the server URL and query string
        var URL = "twitter.php";
                
        //var queryString = "id=" + document.getElementById('search').value;
        var queryString = "id=" + passID;
  				  
  			//URL = URL + "?" + queryString;
        //*** open up the asynchronous request to server
        twitter_xmlhttp.open("POST", URL, true);
  
  
        //*** send the finalized request
        twitter_xmlhttp.setRequestHeader("Content-Type", 
  				  									   "application/x-www-form-urlencoded");
        twitter_xmlhttp.send(queryString);
  
      } // ajaxFunction
      
      function forgotPassword(passEmail) {
    	  
          //*** prepare the server URL and query string
          var URL = "forgotPassword.php";
                  
          //var queryString = "id=" + document.getElementById('search').value;
          var queryString = "id=" + passEmail;
    				  
    			//URL = URL + "?" + queryString;
          //*** open up the asynchronous request to server
          xmlhttpResetPassword.open("GET", URL, true);
    
    
          //*** send the finalized request
          xmlhttpResetPassword.setRequestHeader(	"Content-Type", 
    				  								"application/x-www-form-urlencoded");
          xmlhttpResetPassword.send(queryString);
    
        } // forgotPassword
      
      function validate() {
    
        //validate Email
        var input_email = document.getElementById("rf_email").value; 
        if (!validateEmail(input_email)){
          return(false);
        }
        
        //Verify Passwords match
        if (!validate_passwords()){
          return(false);
        }
          
      }
    
      function validateEmail(email) {
        var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
        return re.test(email);
      }
      
      function validate_passwords(){
        var input_psw1 = document.getElementById("rf_password1").value;
        var input_psw2 = document.getElementById("rf_password2").value;
          
        if (input_psw1 != input_psw2){
          alert("Passwords must match");
          document.getElementById("rf_password1").value = "";
          document.getElementById("rf_password2").value = "";
          document.getElementById("rf_password1").focus();
          return (false);
        }
        
        return(true);
      }
    
      function validate_sat(){
        var input_sat_verbal = Number(document.getElementById("rf_sat_verbal").value);
        var input_sat_math = Number(document.getElementById("rf_sat_verbal").value);
          
        if (isNaN(input_sat_verbal) || input_sat_verbal > 800 || input_sat_verbal <= 0) 
        {
          alert("SAT verbal must be a number between 0 to 800");
          document.getElementById("rf_sat_verbal").focus();
          document.getElementById("rf_sat_verbal").select();
          return false;
        }
        
        if (isNaN(input_sat_math) || input_sat_math > 800 || input_sat_math <= 0) 
        {
          alert("SAT math must be a number between 0 to 800");
          document.getElementById("rf_sat_math").focus();
          document.getElementById("rf_sat_math").select();
          return false;
        }
        
        return(true);
      }
    
      function validate_gpa(){
        var input_gpa = Number(document.getElementById("rf_gpa").value);
          
        if (isNaN(input_gpa) || input_gpa > 4 || input_gpa < 0) 
        {
          alert("GPA must be a number between 0.00 to 4.00");
          document.getElementById("rf_gpa").focus();
          document.getElementById("rf_gpa").select();
          return false;
        }
        
        return(true);
      }
      
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
      
      function loadEditProfile(){
        populateSelectYear();
        populateSelectState();
      }
      
      function populateSelectYear(){
      
        var select = document.getElementById('dob_year');
        var intYear = new Date().getFullYear();
        var i = 0;
        for (i=0; i<100; i++ ){
          var opt = document.createElement('option');
          opt.value = intYear - i;
          opt.innerHTML = intYear - i;
          select.appendChild(opt);
        }
      }
      
      function populateSelectState(){
        var statesArray = ["PA","NJ"];
        var arrayLength = statesArray.length;
        
        var select = document.getElementById('state');
        
        for (i=0; i<arrayLength; i++ ){
          var opt = document.createElement('option');
          opt.value = statesArray[i];
          opt.innerHTML = statesArray[i];
          select.appendChild(opt);
        }
      }
      
      function populateSelectDay(){
      
        var select = document.getElementById('dob_day');
        var monthSelected = document.getElementById('dob_month').value;
        var numberDays = 0;
        
        if (monthSelected == "04" || monthSelected == "06" || monthSelected == "09" || 
            monthSelected == "11"){
          numberDays = 30;
        }
        else if (monthSelected == "01" || monthSelected == "03" || 
                 monthSelected == "05" || monthSelected == "07" || 
                 monthSelected == "08" || monthSelected == "10" || 
                 monthSelected == "12"){
          numberDays = 31;
        }
        else{
          numberDays = 28;
        }
        
        select.options.length = 0;
        var opt = document.createElement('option');
        opt.value = "";
        opt.innerHTML = "Day";
        opt.default = true;
        select.appendChild(opt);
        
        for (var i=1; i<=numberDays; i++ ){
          var opt = document.createElement('option');
          opt.value = i;
          opt.innerHTML = i;
          select.appendChild(opt);
        }
      }
      
