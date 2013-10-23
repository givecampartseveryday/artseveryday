<html>
<head>
<?php include '_scripts.html'; ?>
<script src="_extends.js"></script>
<script src="_authenticate.js"></script>
<script src="_reports.js"></script>
<script src="_stub.php"></script>
<link href="style.css" rel="stylesheet" type="text/css" />
<script>
$(function(){
     $('.logout').click(function(e){
            $.LogOut()
     })
    $.Auth(function(){ 
         var token = $.Hash.access_token
         $( '.token' ).text( token )
         //debugger; 
         //$.Reports.List()
    })
})
</script>
</head>
<body>
<?php include '_header.html'; ?>

    <div class="container">

    <h1>Home</h1>
    <p>
        Arts Every Day Application.
    </p>

    
      <br/>
      <a href="#" class="logout">Lout Out of Google</a>
    <pre class="token">
    </pre>


    </div>
    
<?php include '_footer.html'; ?>
</body>

</html>