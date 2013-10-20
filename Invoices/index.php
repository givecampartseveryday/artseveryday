<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script src="../_stub.php"></script>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script>



    $(function () {
    
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
     $("#schoolSelect").append("<option> Select One </option>");
         for (var i in response.rows) {
             //console.log(response.rows[i]);

             $("#schoolSelect").append("<option>"+response.rows[i]+"</option>");
         }
     }
 );
 console.log(xhr);
console.log(xhr.responseJSON);


     url = "https://www.googleapis.com/fusiontables/v1/query";
 //token = $.Hash["access_token"];
    url += "?access_token=" + token;


 sql = "&sql=";
    sql += "SELECT 'Organization Name' ";

    sql += "FROM ";
    sql += $.AEDtables["Vendors"];

url += sql;
console.log(url);

 xhr = $.get(url, 
     function(response) {
     $("#schoolSelect").append("<option> Select One </option>");
         for (var i in response.rows) {
             //console.log(response.rows[i]);

             $("#vendorSelect").append("<option>"+response.rows[i]+"</option>");
         }
     }
 );
 console.log(xhr);
console.log(xhr.responseJSON);


    $('#btn_search').click(function () {

//    $.FusionSearchTable(
//            $.AEDtables['Invoices'],
//            'Invoice Name',
//            $('#txt_InvoiceNumber').val()
//            , function (data) {
//                debugger;
//                $.Form.KOSetup(data, function () { $.Form.SetupSingle() })
//            }
//        )

    event.preventDefault();
    return false;
})
        //$.currentNode; 
        //debugger; 
        $.extend(
            $.Form
            , {

            }
        );
        $.extend(
            $.Table
            , {
                 Key: $.AEDtables['Invoices']
                , Map: function (field) {
                    var map = {
                        date: "Date"
                        , "Date": "date"
                        , invoiceNumber: "Invoice Number"
                        , "Invoice Number": "invoiceNumber"
                        , vendorID: "VendorID"
                        , "VendorID": "vendorID"
                        , vendorName: "Vendor Name"
                        , "Vendor Name": "vendorName"
                        , schooID: "SchooID"
                        , "SchooID": "schooID"
                        , schoolName: "School Name"
                        , "School Name": "schoolName"
                        , artistName: "Artist Name"
                        , "Artist Name": "artistName"
                        , programName: "Program Name"
                        , "Program Name": "programName"
                        , programType: "Program Type"
                        , "Program Type": "programType"
                        , artFormType: "Art Form Type"
                        , "Art Form Type": "artFormType"
                        , totalCostofEvent: "Total Cost of Event"
                        , "Total Cost of Event": "totalCostofEvent"
                        , aedPayment: "AED Payment"
                        , "AED Payment": "aedPayment"
                        , paymentDate: "Payment Date"
                        , "Payment Date": "paymentDate"
                        , numberOfStudentsServed: "Number of Students Served"
                        , "Number of Students Served": "numberOfStudentsServed"
                        , numberOfTeachersAttending: "Number of Teachers Attending"
                        , "Number of Teachers Attending": "numberOfTeachersAttending"
                        , numberOfParents: "Number of Parents"
                        , "Number of Parents": "numberOfParents"
                    }
                    if (field) {
                        return map[field] || field;
                    }
                    return map;
                }
            }
        );
        $.Form.KO.AfterAddItem = function () {
            $.Form.Navigate.last(null)
        }
        $.Auth(function () {
            $.FusionGetTable(
                $.AEDtables['Invoices']
                , function (data) {
                    $.Form.KO.Model.AEDartforms = ko.observableArray( $.AEDartforms )
                    
                    $.Form.KO.Model.AEDprogramtypes = ko.observableArray( $.AEDprogramtypes )                
                    
                    // Get School Name and School Names from DB
                
                    //$.FusionGetTable($.AEDtables['Schools'],function(data){
                     //var schoolDetails = data.schoolName
                     //$.Form.KO.Model.Schools=
                    //debugger;
                    
                    //})
                    //debugger;
                    
                    //$.FusionGetTable($.AEDtables['Vendors'],function(data){debugger;})
                    
            
                    $.Form.KOSetup(data, function () { $.Form.SetupSingle() })
                }
            )
        });
    });

</script>
    
</head>
<body>
<?php include '../_header.html'; ?>

    <div class="container">

      <h1>Invoices</h1>
      
     
      
<div id='InvoicesList' class='col-lg-12'>
        <!-- <a href="list.php">List View</a> &nbsp; &nbsp; -->
        <a class="openInDrive" href="#">Open in Google Drive</a>
 <br/>
      <!-- <label for="txt_InvoiceNumber">Invoice Number</label> <input type ='text' id="txt_InvoiceNumber"/> <br/>
      <input type='submit' value="Search by Invoice" id='btn_search' /> -->
      <div  class='invoicesEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
      
      <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}" style="display: none">     
            <legend data-bind='html: invoiceNumber'> </legend><br/>

            <button data-bind='click: $root.removeItem'>Delete</button><br/>

<table>
         <tr><th>   <label for="rowid" class="control-label">id</label>                                          </th><td>  <input class="form-control col-lg-6" data-bind='value: rowid' />                       </td></tr>
         <tr><th>   <label for="date" class="control-label">Event Date</label>                              </th><td>  <input class="form-control col-lg-6"  data-bind='value: date' />                   </td></tr>
         <tr><th>   <label for="schoolName" class="control-label">School Name</label>                       </th><td> <!--  <input class="form-control col-lg-6" data-bind='value: schoolName' /> -->                
            <select class='form-control col-lg-6' data-bind='value:schoolName' id='schoolSelect'>
                
            </select>
         </td></tr>
         <tr><th>   <label for="invoiceNumber" class="control-label">Invoice Number</label>                                </th><td>  <input class="form-control col-lg-6" data-bind='value: invoiceNumber' />                    </td></tr>
         <tr><th>   <label for="vendorName" class="control-label">Vendor Name</label>                       </th><td>  <!-- <input class="form-control col-lg-6" data-bind='value: vendorName' /> -->                
         <select class='form-control col-lg-6' data-bind="value: vendorName" id='vendorSelect'>
         
         </select>
         </td></tr>
         <tr><th>   <label for="artistName" class="control-label">Artist Name</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: artistName' />                </td></tr>
         <tr><th>   <label for="programName" class="control-label">Program Name</label>                                         </th><td>  <input class="form-control col-lg-6" data-bind='value: programName' />                        </td></tr>
         <tr><th>   <label for="programType" class="control-label">Program Type</label>                                           </th><td>  <!-- <input class="form-control col-lg-6" data-bind='value: programType' />-->
          <select class="form-control col-lg-6" data-bind="options: $.Form.KO.Model.AEDprogramtypes, value: programType">
            
         </select> 
         <tr><th>   <label for="artFormType" class="control-label">Art Form Type</label>                                       </th><td>  <!-- <input class="form-control col-lg-6" data-bind='value: artFormType' /> -->                    
         
          <select class="form-control col-lg-6" data-bind="options: $.Form.KO.Model.AEDartforms, value: artFormType">
         </select> 
         
         </td></tr>
         <tr><th>   <label for="totalCostofEvent" class="control-label">Total Cost of Event</label>                          </th><td>  <input class="form-control col-lg-6" data-bind='value: totalCostofEvent' />                 </td></tr>
         <tr><th>   <label for="aedPayment" class="control-label">AED Payment</label>                 </th><td>  <input class="form-control col-lg-6" data-bind='value: aedPayment' />             </td></tr>
         <tr><th>   <label for="paymentDate" class="control-label">Payment Date</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: paymentDate' />      </td></tr>
         <tr><th>   <label for="numberOfStudentsServed" class="control-label">Number of Students Served</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: numberOfStudentsServed' />        </td></tr>
         <tr><th>   <label for="numberOfTeachersAttending" class="control-label">Number of Teachers Attending</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: numberOfTeachersAttending' />      </td></tr>
         <tr><th>   <label for="numberOfParents" class="control-label">Number of Parents</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: numberOfParents' />        </td></tr>
</table>

            <input type="text" class="dirty" data-bind='value: dirty' />
      </fieldset>

      </div><!-- Invoice Editor databinder -->

    <br />      

    <div style="clear: both">  
          <button data-bind='click: addItem'>Add an Invoice</button>
          <button data-bind='click: save'>Save</button>
            <ul class="navigate">
        <li class="ui-state-default ui-corner-all">
            <a class="ui-icon ui-icon-seek-first"></a>
        </li>  
        <li class="ui-state-default ui-corner-all">
            <a class="ui-icon ui-icon-triangle-1-w"></a>
        </li>      
        <li class="ui-state-default ui-corner-all">
            <a class="ui-icon ui-icon-play" href="#"></a>
        </li>      
        <li class="ui-state-default ui-corner-all">
            <a class="ui-icon ui-icon-seek-end"></a>
        </li>    
      </ul>
    </div>
    
    </div><!-- Invoice List -->
    </div><!-- container -->
    
<?php include '../_footer.html'; ?>
</body>

</html>