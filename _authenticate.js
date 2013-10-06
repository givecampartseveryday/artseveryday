/*jshint asi:true, supernew:true */
//depends on JQuery

var jQuery = jQuery || {}; 
(function($) {
/*If no access token is in the QueryString then go the to google page. telling the google page what page to return to.*/
    $.Auth = (function( callback ) { 
        var token = $.Hash.access_token
        if(! token  ){
                //get token from Google...
            console.log('retrieving token from google')
                
            var href = 'https://accounts.google.com/o/oauth2/auth'
            href += "?client_id=23165663826-6pta7osd3gp5dnhf5epkli8eo8f4nub0.apps.googleusercontent.com"
            //href += "&redirect_uri=http://artseveryday.gdirlam.c9.io/Donors/" + 
            href += "&redirect_uri=" + window.location.href
            href += "&response_type=token"
            href += "&scope=https://www.googleapis.com/auth/fusiontables https://spreadsheets.google.com/feeds https://docs.google.com/feeds"
            window.location = href 
        }else{        
            callback();    
        }
        
    })
           
})(jQuery);
