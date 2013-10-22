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

/*
function noSpace(val){
    return val.toString().replace(/\s+/g, "")
}
*/
$(function(){

    $.FusionGetTable( $.AEDtables['Donations'], function(data){
        $.each( data, function(i, row){
        
            var donorKey = row['Donor Last Name'] + '|'+ row['Donor First Name'] + '|'+ row['Donor MI'] 
            var donorName = row['Donor Last Name'] + ', ' + row['Donor First Name'] 
            var opt = '<option value="'+ donorKey+'">' + donorName + '</option>'

            if( row['Donor Last Name'].toLowerCase() !== "null" )
                $('.donor').append( opt )
        })
    })
    
    
    function makeThisReport(table, spreadSheetTitle, workSheetTitle, header, where){

        var url = "https://www.googleapis.com/fusiontables/v1/query"
        url += "?access_token={0}".format($.Hash["access_token"]) 
    
        var sql = "SELECT  '" + header.join("','")+ "' "
        sql += "FROM " + table
        sql += where
        url += "&sql=" + sql

        var xhr = $.get(url)
        .done(function(data){
            var query = {
                spreadSheetTitle: spreadSheetTitle
                , workSheetTitle: workSheetTitle
                , rowsCount: data.rows.length +1
                , colsCount: data.columns.length
                , header:  header.map(function(el){return el.replace(/\s+/g, '').toLowerCase()})
                , rows: data.rows      
            }
            $.extend( $.Reports, query ) 
            $.Reports.makeReport();    
        })
    }
    
    $('.byDonor').submit(function(ev){
        ev.preventDefault();
        var header = ['Donor Last Name', 'Donor First Name', 'Check Amount', 'Check Received'] 
        var table = $.AEDtables["Donations"]

        var donorNameArray= $('.donor').val().split('|')
        var spreadSheetTitle= 'AED Donations by Donor'
        var workSheetTitle= 'Donor {0} {1}'.format(donorNameArray[0], donorNameArray[1])

        var sql = " WHERE "
        sql += "'Donor Last Name' = '{0}'".format(donorNameArray[0])
        sql += "AND 'Donor First Name' = '{0}'".format(donorNameArray[1])
        sql += "AND 'Donor MI' = '{0}'".format(donorNameArray[2])

        DonorsReport( table, spreadSheetTitle, workSheetTitle, header, sql )

    })

})



</script>
<body>
<?php include '_header.html'; ?>

    <div class="container">

    <h1>Donor Reports</h1>
    <p>
       Generate reports.
    </p>

    

            <form id=byDonor class="byDonor">
                <label for="donor">by Donor</label> <select class="donor" name=donor id=donor ></select> <br/>
                <input type="submit" text="Go!" >
            </form>
            
            
            <hr>


    </div>
    
<?php include '_footer.html'; ?>
</body>
