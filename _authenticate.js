/*jshint asi:true, supernew:true */
//depends on JQuery

var jQuery = jQuery || {}; 
(function($) {
/*If no access token is in the QueryString then go the to google page. telling the google page what page to return to.*/
    $.Hash = (function(a) {
            var b = {};
            for (var i = 0; i < a.length; ++i)
            {
                var p=a[i].split('=');
                if (p.length != 2) continue;
                b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
            }
            return b;
        })(window.location.hash.substr(1).split('&')) //IEFE
    $.Auth = (function( callback ) { 
        var token = $.Hash.access_token
        if(! token  ){
                //get token from Google...
            //debugger; 
            console.log('retrieving token from google', window.location.href)
                
            var href = 'https://accounts.google.com/o/oauth2/auth'
            href += "?client_id=665230635444.apps.googleusercontent.com"
            //href += "&redirect_uri=http://artseveryday.gdirlam.c9.io/Donors/" + 
            href += "&redirect_uri=" + window.location.href
            href += "&response_type=token"
            href += "&scope=https://www.googleapis.com/auth/fusiontables https://spreadsheets.google.com/feeds/ https://spreadsheets.google.com/feeds/worksheets/  https://docs.google.com/feeds/ https://docs.googleusercontent.com/"
            window.location = href 
        }else{        
            callback();    
        }
    })
    $.QueryString = function (sVar) {
          return decodeURI(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + encodeURI(sVar).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));
        }
    $.LogOut = (function(){
        var success = false
        var url = 'https://accounts.google.com/Logout?continue='
        url += 'https://www.google.com'
        //url += '://' + window.location.hostname
        window.location.href = url
    })       
})(jQuery);
$(function(){
     $('.logout').click(function(e){
            $.LogOut()
     })
    /*
    $.Auth(function(){ 
         var token = $.Hash.access_token
         $( '.token' ).text( token )
         //debugger; 
         //$.Reports.List()
    })
    */
})