<html>
<head>
<?php include '_scripts.html'; ?>
<script src="_extends.js"></script>
<script src="_authenticate.js"></script>
<script src="_reports.js"></script>
<script src="_stub.php"></script>

<link href="style.css" rel="stylesheet" type="text/css" />

</head>
<script>
$(function(){
     $('.logout').click(function(e){
            $.LogOut()
     })
    $.Auth(function(){ 
         var token = $.Hash.access_token
         $( '.token' ).text( token )
    })
})
$(function(){})
</script>
<body>
<?php include '_header.html'; ?>

    <div class="container">

    <h1>Donor Reports</h1>
    <p>
       Generate reports.
    </p>

    

            <form id=byDonor>
                <label for="artForm">By Art Form</label> <select name=donor id=donor ></select> 
                <input type="submit" text="Go!" >
            </form>
            
            
            <hr>


    </div>
    
<?php include '_footer.html'; ?>
</body>

</html>