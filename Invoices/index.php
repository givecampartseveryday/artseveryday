<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script src="../_stub.php"></script>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script>
    $(function () {
    
        //debugger;
        $("#datepicker").datepicker();
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
                $.Table.Key
                , function (data) {
                    $.Form.KO.Model.AEDartforms = ko.observableArray( $.AEDartforms )
                    $.Form.KO.Model.AEDprogramtypes = ko.observableArray( $.AEDprogramtypes )                
                
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
        <a href="list.php">List View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>

      <div  class='invoicesEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
      <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}" style="display: none">     
            <legend data-bind='html: invoiceNumber'> </legend>

            <button data-bind='click: $root.removeItem'>Delete</button><br/>

<table>
         <tr><th>   <label for="rowid" class="control-label">id</label>                                          </th><td>  <input class="form-control col-lg-6" data-bind='value: rowid' />                       </td></tr>
         <tr><th>   <label for="date" class="control-label">Event Date</label>                              </th><td>  <input class="form-control col-lg-6"  data-bind='value: date' />                   </td></tr>
         <tr><th>   <label for="schoolName" class="control-label">School Name</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: schoolName' />                </td></tr>
         <tr><th>   <label for="invoiceNumber" class="control-label">Invoice Number</label>                                </th><td>  <input class="form-control col-lg-6" data-bind='value: invoiceNumber' />                    </td></tr>
         <tr><th>   <label for="vendorName" class="control-label">Vendor Name</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: vendorName' />                
         <!-- <select data-bind="options: Vendors"></select>        -->
         </td></tr>
         <tr><th>   <label for="artistName" class="control-label">Artist Name</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: artistName' />                </td></tr>
         <tr><th>   <label for="programName" class="control-label">Program Name</label>                                         </th><td>  <input class="form-control col-lg-6" data-bind='value: programName' />                        </td></tr>
         <tr><th>   <label for="programType" class="control-label">Program Type</label>                                           </th><td>  <input class="form-control col-lg-6" data-bind='value: programType' />
          <select class="form-control col-lg-6" data-bind="options: programType">
            <option value="ft">Field Trip</option>
            <option value="osp">Out of School Performance</option>
            <option value="trp">Transportation</option>
            <option value="res">Residency</option>
            <option value="isp">In-School performance</option>
            <option value="isw">In-school Workshop</option>
         </select> 
         <tr><th>   <label for="artFormType" class="control-label">Art Form Type</label>                                       </th><td>  <input class="form-control col-lg-6" data-bind='value: artFormType' />                       
         
          <select class="form-control col-lg-6" data-bind="options: $.Form.KO.Model.AEDartforms, selectedOptions: artFormType">
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
          <button data-bind='click: addItem'>Add a contact</button>
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