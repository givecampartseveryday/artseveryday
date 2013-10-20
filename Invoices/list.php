<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script>
        $(function(){
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
                    Key: '1NK0EXbnAI5kRC2pY-cqT76660fxlAwUiHXH2Hgc'
                    , Map: function( field ){
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
                        if( field ){
                            return map[field] || field; 
                        }
                        return map; 
                    }
                }
            );

            $.Auth(function(){ 
                $.FusionGetTable( 
                    $.Table.Key
                    , function(data){ 
                        $.Form.KOSetup(data,  function(){$.Form.Setup()} ) 
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
<div id='InvoicesList' class='col-lg-20'>
        <a href="index.php">Item View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>
      <div  class='invoicesEditor Editor' >
      <fieldset class="col-lg-18 editgrid"  >     
            <legend>Invoice's List </legend>




            <table class='horizontalTbl'>
            <tr>          
                <th>  id                                </th>         
                <th>  Date                              </th>      
                <th>  Invoice Number                    </th>        
                <th>  Vendor Name                       </th>    
                <th>  School Name                       </th>  
                <th>  Artist Name                       </th>           
                <th>  Program Name                      </th>          
                <th>  Program Type                      </th>           
            <!--    <th>  Art Form Type                     </th>     
                <th>  Total Cost of Event               </th> 
                <th>  AED Payment                       </th>        
                <th>  Payment Date                      </th> 
                <th>  Number of Students Served         </th> 
                <th>  Number of Teachers Attending      </th>        
                <th>  Number of Parents                 </th> -->
            </tr> 
            <tbody data-bind="foreach: { data:  $.Form.KO.Model.items }" class="Binder">
                <tr>            
                    <td>  
                        <input class="form-control col-lg-6" data-bind='value: rowid' />
                        <input type="text" class="dirty" data-bind='value: dirty' />
                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: date' />                   </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: invoiceNumber' />                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: vendorName' />                </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: schoolName' />                </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: artistName' />                        </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: programName' />                       </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: programType' />                         </td>
                    <!-- <td>  <input class="form-control col-lg-6" data-bind='value: artFormType' />                 </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: totalCostofEvent' />             </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: aedPayment' />      </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: paymentDate' />        </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: numberOfStudentsServed' />             </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: numberOfTeachersAttending' />      </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: numberOfParents' />        </td> -->
                    <td>  <button data-bind='click: $root.removeItem'>Delete</button>                            </td>
                     
                </tr>
            </tbody>
            </table>
           <br/>

      </fieldset>

      </div><!-- invoicesEditor databinder -->

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
    
    </div><!-- InvoicesList -->
    </div><!-- container -->
    
<?php include '../_footer.html'; ?>
</body>

</html>