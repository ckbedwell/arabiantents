function setPopupCookie() {
    
    var date = new Date();
    var today = date.getTime();
    var popup = new Date(today + (1000*60*3)); // 3 minutes
    var expires = new Date(today + (1000*60*60*1)); // one hour
    var unixPopup = popup.getTime();
    document.cookie = "firstVisit=" + today + "; expires=" + expires;
    document.cookie = "unixPopup=" + unixPopup + "; expires=" + expires;
    }

function getPopupCookie(cookieName) {
    var name = cookieName + "=";
    var cookieArray = document.cookie.split(';'); // get cookies and split them into an array
    
    for(var i = 0; i<cookieArray.length; i++) { //loop through each cookie
        var cookie = cookieArray[i]; //save the cookie details
        while (cookie.charAt(0) == " ") { // if any cookies start with a space remove it 
            cookie = cookie.substring(1); 
            }
        
        if (cookie.indexOf(name) == 0) { //if cookie name starts with cookie name passed to function...
            console.log("Correct cookie value: " + cookie.substring(name.length, cookie.length));
            return cookie.substring(name.length, cookie.length) //return only the value of the cookie (substring function removes the name)
            }
        }
        return ""; // if no cookies which match the description are found return nothing
    
    }

function checkCookie() {
    var popupTime = getPopupCookie("unixPopup");
    if (popupTime != "") {
        //set timeout for popup
        var date = new Date();
        var today = date.getTime();
        var difference = popupTime - today;
        if (difference > 0) {
            var timeLeft = difference / 1000;
            setTimeout(function(){
                jQuery('.newsletter-form').removeClass('hide').addClass('fade-in');
                jQuery('html').addClass('active-overlay');
                jQuery('.overlay').removeClass('hide').addClass('active');
                }, difference);
            } // endif
        console.log(difference);
        console.log("holy potatoes, a popup cookie! " + popupTime);
        }
    else {
        setPopupCookie();
        }
    }

// Uncomment below for pop-up to appear
// checkCookie();