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

      <h1>Donors</h1>
<div id='DonorsList' class='col-lg-20'>
        <a href=".">Item View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>
      <div  class='donorsEditor Editor' >
      <fieldset class="col-lg-18 editgrid"  >     
            <legend>Donor's List </legend>




            <table>
            <tr>          
                <th>  id                                </th>         
                <th>  First Name                        </th>      
                <th>  Last Name                         </th>        
                <th>  Address Line 1                    </th>    
                <th>  Address Line 2                    </th>  
                <th>  City                              </th>           
                <th>  State                             </th>          
                <th>  Zip                               </th>           
                <th>  Contact Type                      </th>     
                <th>  Board Member Name                 </th> 
                <th>  Donation Amount Received          </th>        
                <th>  Board Annual Tax Credit           </th>     
            </tr> 
            <tbody data-bind="foreach: { data:  $.Form.KO.Model.items }" class="Binder">
                <tr>            
                    <td>  
                        <input class="form-control col-lg-6" data-bind='value: rowid' />
                        <input type="text" class="dirty" data-bind='value: dirty' />
                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: firstName' />                   </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: lastName' />                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: addressLine1' />                </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: addressLine2' />                </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: city' />                        </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: state' />                       </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: zip' />                         </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: contactType' />                 </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: boardMemberName' />             </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: donationAmountReceived' />      </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: boardAnnualTaxCredit' />        </td>
                    <td>  <button data-bind='click: $root.removeItem'>Delete</button>                            </td>
                     
                </tr>
            </tbody>
            </table>
           <br/>

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