<html>
<head>
<?php include '_scripts.html'; ?>
    <script>

(function($) {
//debugger; 

    $.Hash = (function(a) {
            if (a == "") return {};
            var b = {};
            for (var i = 0; i < a.length; ++i)
            {
                var p=a[i].split('=');
                if (p.length != 2) continue;
                b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
            }
            return b;
        })(window.location.hash.substr(1).split('&'))
    })(jQuery);

        $(function(){


            var token = $.Hash["access_token"]
            if(! token ){
                $('input[name="token"]').val("retrieving token from google")
                //get token from Google...
                var href = 'https://accounts.google.com/o/oauth2/auth'
                href += "?client_id=23165663826-6pta7osd3gp5dnhf5epkli8eo8f4nub0.apps.googleusercontent.com"
                href += "&redirect_uri=http://artseveryday.gdirlam.c9.io"
                href += "&response_type=token"
                href += "&scope=https://www.googleapis.com/auth/fusiontables"
               window.location =  href 
            }else{
                $('input[name="token"]').val(token )
                var sql = 'SELECT * FROM '
                sql += '19RuwwJStqOBbPigLx--Lv3m6JpYvgbb7wj3AEV4'
                var tableLocation = 'https://www.googleapis.com/fusiontables/v1/query'
                tableLocation += '?access_token=' + token
                tableLocation += '&sql=' + sql
                console.log( tableLocation )
                var xhr = $.get( tableLocation )
                    .done( function( data ) {
                        console.log(data)
                    })
                    .fail(function() { alert("error"); })
            }
        })
    


</script>
</head>
<body>
<?php include '_header.html'; ?>

    <div class="container">

    <h1>Home</h1>
    <p>
        So my friend Sherwin is obviously a practitioner of the <a href="http://www.catb.org/jargon/html/magic-story.html" taget="_blank">dark arts</a> of computer science. 
        Anyone reading his code can tell that he uses <a target="_blank" href="http://www.catb.org/jargon/html/D/deep-magic.html">deep magic</a> as easily as us mere mortals 
        dimension variables. When Sherwin marks a section of code as “<a target="_blank" href="http://www.catb.org/jargon/html/D/deep-magic.html">Deep magic</a> begins here...”, 
        let lesser programmers quake, because true <a target="_blank" href="http://www.catb.org/jargon/html/B/black-magic.html">black magic</a>. will follow. 
    </p>
    <p>
        That being said, I intend on slinging some PureJS heavy wizardry in this solution.
    </p>
    <p>
        --gdirlam
    </p>
    
    
      <br/>
      <input type="text" name="token" />

    </div>
    
<?php include '_footer.html'; ?>
</body>

</html>