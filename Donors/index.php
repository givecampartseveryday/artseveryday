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
                    Key: '19RuwwJStqOBbPigLx--Lv3m6JpYvgbb7wj3AEV4'
                    , Map: function( field ){
                        var map = {
                            firstName: "First Name"
                            , "First Name": "firstName"
                            , lastName: "Last Name"  
                            , "Last Name": "lastName"  
                            , addressLine1: "Address Line 1"
                            , "Address Line 1": "addressLine1"
                            , addressLine2: "Address Line 2" 
                            , "Address Line 2": "addressLine2" 
                            , city: "City"
                            , "City": "city"
                            , state: "State" 
                            , "State": "state"
                            , zip: "Zip"
                            , "Zip": "zip"
                            , contactType: "Contact Type"
                            , "Contact Type": "contactType"
                            , boardMemberName: "Board Member Name"
                            , "Board Member Name": "boardMemberName"
                            , donationAmountReceived: "Donation Amount Received"
                            , "Donation Amount Received": "donationAmountReceived"
                            , boardAnnualTaxCredit: "Board Annual Tax Credit"
                            , "Board Annual Tax Credit": "boardAnnualTaxCredit"
                        }
                        if( field ){
                            return map[field] || field; 
                        }
                        return map; 
                    }
                }
            );
            $.Form.KO.AfterAddItem = function(){ 
                $.Form.Navigate.last(null)
            }
            $.Auth(function(){ 
                $.FusionGetTable( 
                    $.Table.Key
                    , function(data){ 
                        $.Form.KOSetup(data, function(){$.Form.SetupSingle()}) 
                    } 
                )
            });
        });
        
</script>
    
</head>
<body>
<?php include '../_header.html'; ?>

    <div class="container">

      <h1>Donors</h1>
<div id='DonorsList' class='col-lg-12'>
        <a href="list.php">List View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>

      <div  class='donorsEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
      <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}" style="display:none">     
            <legend data-bind='html: lastName'> </legend>

            <button data-bind='click: $root.removeItem'>Delete</button><br/>

<table>
         <tr><th>   <label for="rowid" class="control-label">id</label>                                          </th><td>  <input class="form-control col-lg-6" data-bind='value: rowid' />                       </td></tr>
         <tr><th>   <label for="firstName" class="control-label">First Name</label>                              </th><td>  <input class="form-control col-lg-6" data-bind='value: firstName' />                   </td></tr>
         <tr><th>   <label for="lastName" class="control-label">Last Name</label>                                </th><td>  <input class="form-control col-lg-6" data-bind='value: lastName' />                    </td></tr>
         <tr><th>   <label for="addressLine1" class="control-label">Address Line 1</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: addressLine1' />                </td></tr>
         <tr><th>   <label for="addressLine2" class="control-label">Address Line 2</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: addressLine2' />                </td></tr>
         <tr><th>   <label for="city" class="control-label">City</label>                                         </th><td>  <input class="form-control col-lg-6" data-bind='value: city' />                        </td></tr>
         <tr><th>   <label for="state" class="control-label">State</label>                                       </th><td>  <input class="form-control col-lg-6" data-bind='value: state' />                       </td></tr>
         <tr><th>   <label for="zip" class="control-label">Zip</label>                                           </th><td>  <input class="form-control col-lg-6" data-bind='value: zip' />                         </td></tr>
         <tr><th>   <label for="contactType" class="control-label">Contact Type</label>                          </th><td>  <input class="form-control col-lg-6" data-bind='value: contactType' />                 </td></tr>
         <tr><th>   <label for="boardMemberName" class="control-label">Board Member Name</label>                 </th><td>  <input class="form-control col-lg-6" data-bind='value: boardMemberName' />             </td></tr>
         <tr><th>   <label for="donationAmountReceived" class="control-label">Donation Amount Received</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: donationAmountReceived' />      </td></tr>
         <tr><th>   <label for="boardAnnualTaxCredit" class="control-label">Board Annual Tax Credit</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: boardAnnualTaxCredit' />        </td></tr>
</table>

            <input type="text" class="dirty" data-bind='value: dirty' />
      </fieldset>

      </div><!-- donorsEditor databinder -->

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
    
    </div><!-- DonorsList -->
    </div><!-- container -->
    
<?php include '../_footer.html'; ?>
</body>

</html>