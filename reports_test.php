<html>
<head>
<?php include '_scripts.html'; ?>
<script src="_extends.js"></script>
<script src="_authenticate.js"></script>
<script src="_reports.js"></script>
<script src="_stub.php"></script>

<link href="style.css" rel="stylesheet" type="text/css" />
<script>
$(document).ready(function(){
    var artForms = $.AEDartforms;
    var programTypes = $.AEDprogramtypes;
    
    
    //Fill the Art Forms and Program Types <select> elements from the
    //global $.AEDartforms and $.AEDprogramtypes variables. These are defined
    //in _stub.php. These are not dynamic.
    for (var i = 0; i < artForms.length; i++) {
        $("#artFormSelect").append("<option>"+artForms[i]+"</option>");
        $("#programTypeSelect").append("<option>"+programTypes[i]+"</option>");
    }
    
    //Fill the Schools <select> element. Since the list of schools can change,
    //this element is filled by querying the Schools Fusion Table and getting
    //all the School Names
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'School Name' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Schools"];
        
    url += sql;
    console.log(url);
    
    var xhr = $.get(url, 
        function(response) {
            for (var i in response.rows) {
                $("#schoolSelect").append("<option>"+response.rows[i]+"</option>");
            }
        }
    );
    console.log(xhr);
    //console.log(xhr.responseJSON);
    
})

function objectSerialize(form) {
    var o = {};
    var a = form.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function packJSONforSpreadsheet (json, reportType, start, end) {
    var title = "Invoices for " + reportType + ' over ' + start + '-' + end;
    var worksheetTitle = "Invoices for " + reportType;
    var rows = json.rows.length;
    var cols = json.columns.length;
    var header = json.columns;
    var data = json.rows;

    var packed = {"title":title, "worksheetTitle": worksheetTitle,
        "rows":rows, "cols":cols, "header":header, "data": data};
        
    //$.Reports
        
    return packed;
}


function generateJSONByArtForm(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Invoice Number', 'Total Cost of Event' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Invoices"];
        
        sql += " WHERE ";
        sql += "'Art Form Type' = ";
        sql += "'" + inputs["artForm"] + "'";
        sql += " AND 'Date' > " 
        sql += "'" + inputs["start"] + "'";
        sql += " AND 'Date' < " 
        sql += "'" + inputs["end"] + "'";
        
    url += sql
    console.log(url);
    
    var xhr = $.get(url, 
    
        function(response) {
            console.log(packJSONforSpreadsheet(response, inputs["artForm"], inputs["start"], inputs["end"]));
    });
}

function generateJSONByProgramType(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Invoice Number', 'Total Cost of Event' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Invoices"];
        
        sql += " WHERE ";
        sql += "'Program Type' = ";
        sql += "'" + inputs["programType"] + "'";
        sql += " AND 'Date' > " 
        sql += "'" + inputs["start"] + "'";
        sql += " AND 'Date' < " 
        sql += "'" + inputs["end"] + "'";
        
    url += sql
    
    var xhr = $.get(url, 
    
        function(response) {
            console.log(response);
            console.log(packJSONforSpreadsheet(response, inputs["programType"], inputs["start"], inputs["end"]));
    });

}

function generateJSONBySchoolName(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Invoice Number', 'Total Cost of Event' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Invoices"];
        
        sql += " WHERE ";
        sql += "'School Name' = ";
        sql += "'" + inputs["school"] + "'";
        sql += " AND 'Date' > " 
        sql += "'" + inputs["start"] + "'";
        sql += " AND 'Date' < " 
        sql += "'" + inputs["end"] + "'";
        
    url += sql
    console.log(url);
    
    var xhr = $.get(url, 
    
        function(response) {
            console.log(packJSONforSpreadsheet(response, inputs["school"], inputs["start"], inputs["end"]));
    });
}

$(function(){
     $('.logout').click(function(e){
            $.LogOut()
     })
    $.Auth(function(){ 
         var token = $.Hash.access_token
         $( '.token' ).text( token )
         //debugger;
         //$.Reports.Header = ""
         $.Reports.List()
    })
})
</script>
</head>
<body>
<?php include '_header.html'; ?>

    <div class="container">

    <h1>Reports</h1>
    <p>
       Generate reports.
    </p>

    
      <br/>
      <a href="#" class="logout">Lout Out of Google</a>
    <pre class="token">
    </pre>
    
        <div id=byArtForm>
            <form id=generateReportByArtForm>
            <table id=artFormTable>
                <tr><th>   <label>By Art Form</label> </th><td>  <select name=artForm id=artFormSelect ></select> </td></tr>
                <tr><td><label>Start Date</label> <input name=start placeholder="MM/DD/YYYY" /></td>  <td><label>End Date</label> <input name=end placeholder="MM/DD/YYYY" /></td></tr>
            </table>
            
            <button type=button onClick="generateJSONByArtForm(objectSerialize($('#generateReportByArtForm')))">Go!</button>
            </form>
            
            
            <hr>
        </div>
        
        <div id=byProgramType>
            <form id=generateReportByProgramType>
            <table id=programTypeTable>
                <tr><th>   <label>By Program Type</label> </th><td>  <select name=programType id=programTypeSelect ></select> </td></tr>
                <tr><td><label>Start Date</label> <input name=start placeholder="MM/DD/YYYY" /></td>  <td><label>End Date</label> <input name=end placeholder="MM/DD/YYYY" /></td></tr>
            </table>
            
            <button type=button onClick="generateJSONByProgramType(objectSerialize($('#generateReportByProgramType')))">Go!</button>
            </form>
            
            <hr>
        </div>
        
        <div id=bySchool>
            <form id=generateReportBySchool>
            <table>
                <tr><th>    <label>By School</label> </th><td> <select name=school id=schoolSelect></select> </td></tr>
                <tr><td><label>Start Date</label> <input name=start placeholder="MM/DD/YYYY" /></td>  <td><label>End Date</label> <input name=end placeholder="MM/DD/YYYY" /></td></tr>
            </table>
            
            <button type=button onClick="generateJSONBySchoolName(objectSerialize($('#generateReportBySchool')))">Go!</button>
            
            <hr>
        </div>
        

    </div>
    
<?php include '_footer.html'; ?>
</body>

</html>