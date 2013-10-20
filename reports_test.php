<html>
<head>
<?php include '_scripts.html'; ?>
<script src="_extends.js"></script>
<script src="_authenticate.js"></script>
<script src="_reports.js"></script>
<script src="_stub.php"></script>
<link href="style.css" rel="stylesheet" type="text/css" />

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