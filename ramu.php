  <html>
  <head>
    <link href="/_bootstrap/bootstrap.min.css" rel="stylesheet" />
    <link href="/_bootstrap/bootswatch.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/_bootstrap/font-awesome.min.css">

    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>
    <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>

    <script src="/_bootstrap/bootstrap.min.js"></script>
    <script src="/_bootstrap/bootswatch.js"></script>

    <script>
    $(function(){
        $('.row input').hide(); 
        $('.editbutton').click(function(e){
            var $parent = $(this).parent('fieldset'); 
             $('span', $parent).hide();
             $('input', $parent).show();
             $('input', $parent).each(function(i, el){
                $(el).val(
                    $(el).next().text()
                )
             })
             $(this).hide();
             e.preventDefault();
        }); 
    })
    </script>
    <style>
    .row span{width: 150px; margin-right: 10px; display: block; float:left;  }
    .row input{width: 150px; margin-right: 10px;}
    </style>
  </head>
    
    <body>
    <fieldset class="row row1">
        <input name="fname" value="" /><span class="fname">fred</span>
        <input name="lname" value="" /><span class="lname">astair</span>
        <input name="email" value="" /><span class="email">fastair@hollywood.com</span>
        <a href="#" class="editbutton">edit</a>
    <fieldset>


    </body>
  <html>
