
	//Create EU Cookie Law Banner v:2.4
    var dropCookie = true;                      // false disables the Cookie, allowing you to style the banner
    var cookieDuration = 14;                    // Number of days before the cookie expires, and the banner reappears
    var cookieName = 'complianceCookie1024';        // Name of our cookie
    var cookieValue = 'on';                     // Value of cookie
	var strMessage= 'This website uses cookies and other tracking technologies (also known as pixels or beacons) to aid your experience \
					(such as viewing videos), as well as “performance cookies” to analyze your use of this website and to assist with \
					marketing efforts.  If you click the "Accept All Cookies" button or continue navigating the website, you agree to \
					having those first and third-party cookies set on your device.  If you do not wish to accept cookies from this \
					website, you can choose to not allow cookies from this website by updating your browser preferences.  For more \
					information on how we use Cookies, please read our ';

    function createDiv(){
        var bodytag = document.getElementsByTagName('body')[0];

        var footerID = document.getElementById('footer');

        var divCookieConsent = document.createElement('div');
        divCookieConsent.setAttribute('id','cookieConsent');

        //var divCloseCookieConsent = document.createElement('div');
        //divCloseCookieConsent.setAttribute('id','closeCookieConsent');

        var aPrivacy = document.createElement('a');
        var linkText = document.createTextNode("Privacy Policy");
        aPrivacy.appendChild(linkText);
		aPrivacy.setAttribute('href', 'privacy_policy.php');

		var aTOS = document.createElement('a');
        var linkTextTOS = document.createTextNode("Terms of Service");
        aTOS.appendChild(linkTextTOS);
		aTOS.setAttribute('href', 'terms_of_use.php');

		var aCookie = document.createElement('a');
        var linkTextCookie = document.createTextNode("Cookie Policy");
        aCookie.appendChild(linkTextCookie);
		aCookie.setAttribute('href', 'terms_of_use.php');

        var aAccept = document.createElement('a');
        var linkText_Accept = document.createTextNode("Accept All Cookies");
        aAccept.appendChild(linkText_Accept);
        aAccept.setAttribute('class','cookieConsentOK');
        aAccept.setAttribute('onclick', 'createCookie(cookieName, cookieValue, cookieDuration)');

        var messageText = document.createTextNode(strMessage);

        divCookieConsent.appendChild(messageText);
        divCookieConsent.appendChild(aPrivacy);
		divCookieConsent.appendChild(document.createTextNode(", "));
		divCookieConsent.appendChild(aTOS);
		divCookieConsent.appendChild(document.createTextNode(" and "));
		divCookieConsent.appendChild(aCookie);
		divCookieConsent.appendChild(document.createTextNode("."));
        divCookieConsent.appendChild(aAccept);
        
        bodytag.appendChild(divCookieConsent); // Adds the Cookie Law Banner just before the closing </body> tag
       
        //createCookie(window.cookieName,window.cookieValue, window.cookieDuration); // Create the cookie
    }

    window.onload = function(){
        if(checkCookie(window.cookieName) != window.cookieValue){
            createDiv(); 
        }
    }

    function createCookie(name,value,days) {
        if (days) {
            var date = new Date();
            date.setTime(date.getTime()+(days*24*60*60*1000)); 
            var expires = "; expires="+date.toGMTString(); 
        }
        else var expires = "";
        
        if(window.dropCookie) { 
            document.cookie = name+"="+value+expires+"; path=/"; 
            document.getElementById('cookieConsent').style.display = 'none';
        }
    }

    function checkCookie(name) {
        var nameEQ = name + "=";
        var ca = document.cookie.split(';');
        for(var i=0;i < ca.length;i++) {
            var c = ca[i];
            while (c.charAt(0)==' ') c = c.substring(1,c.length);
            if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
        }
        return null;
    }
       
	function eraseCookie(name) {
        createCookie(name,"",-1);
    }
    
  	function removeMe(){
    	//var element = document.getElementById('cookie-law');
    	var element = document.getElementById('closeCookieConsent');
    	element.parentNode.removeChild(element);
    }
