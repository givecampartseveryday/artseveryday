<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script src="../stub.js"></script>
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
                    Key: '1GnUdMYtzBt6vXOZS777KIjesQ4eRZdQToEKaIag'
                    , Map: function( field ){
                        var map = {
                            firstName: "First Name"
                            , "First Name": "firstName"
                            , lastName: "Last Name"  
                            , "Last Name": "lastName"
                            , preferredName: "Preferred Name"
                            , "Preferred Name": "preferredName"
                            , title: "Title"
                            , "Title": "title"
                            , addressLine1: "Street Address Line 1"
                            , "Street Address Line 1": "addressLine1"
                            , addressLine2: "Street Address Line 2" 
                            , "Street Address Line 2": "addressLine2" 
                            , city: "City"
                            , "City": "city"
                            , state: "State" 
                            , "State": "state"
                            , zip: "ZIP"
                            , "ZIP": "ZIP"
                            , emailAdress: "Email"
                            , "Email": "emailAdress"
                            , contactType: "Contact Type"
                            , "Contact Type": "contactType"
                            , boardMemberName: "Board Member Name"
                            , "Board Member Name": "boardMemberName"
                            , donationAmountReceived: "Donation Amount Received"
                            , "Donation Amount Received": "donationAmountReceived"
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
             <tr><th>   <label for="preferredName" class="control-label">Preferred Name</label>                      </th><td>  <input class="form-control col-lg-6" data-bind='value: preferredName' />               </td></tr>
             <tr><th>   <label for="title" class="control-label">Title</label>                                       </th><td>  <input class="form-control col-lg-6" data-bind='value: title' />                       </td></tr>
             <tr><th>   <label for="addressLine1" class="control-label">Address Line 1</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: addressLine1' />                </td></tr>
             <tr><th>   <label for="addressLine2" class="control-label">Address Line 2</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: addressLine2' />                </td></tr>
             <tr><th>   <label for="city" class="control-label">City</label>                                         </th><td>  <input class="form-control col-lg-6" data-bind='value: city' />                        </td></tr>
             <tr><th>   <label for="state" class="control-label">State</label>                                       </th><td>  <input class="form-control col-lg-6" data-bind='value: state' />                       </td></tr>
             <tr><th>   <label for="ZIP" class="control-label">Zip</label>                                           </th><td>  <input class="form-control col-lg-6" data-bind='value: ZIP' />                         </td></tr>
             <tr><th>   <label for="emailAddress" class="control-label">Email Address</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: emailAdress' />                  </td></tr>
             <tr><th>   <label for="donorType" class="control-label">Contact Type</label>                          </th><td>  <input class="form-control col-lg-6" data-bind='value: donorType' />                     </td></tr>
             <tr><th>   <label for="areBoardMember" class="control-label">Board Member?</label>                 </th><td>  <input class="form-control col-lg-6" data-bind='value: areBoardMember' />                   </td></tr>
             <tr><th>   <label for="donationAmountReceived" class="control-label">Donation Amount Received</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: donationAmountReceived' />      </td></tr>
      </table>

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