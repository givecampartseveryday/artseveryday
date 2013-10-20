<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script src="../_stub.php"></script>
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
                    Key: $.AEDtables['Donors']
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
                            , "ZIP": "zip"
                            , emailAdress: "Email"
                            , "Email": "emailAdress"
                            , donorType: "donorType"
                            , "donorType": "donorType"
                            , donationAmountReceived: "Donation Amount Received"
                            , "Donation Amount Received": "donationAmountReceived"
                            , areBoardMember: "areBoardMember"
                            , "areBoardMember": "areBoardMember"
                            , orgName: "Organization Name"
                            , "Organization Name": "orgName"
                            , hPhone: "Home Phone"
                            , "Home Phone": "hPhone"
                            , cPhone: "Cell Phone"
                            , "Cell Phone": "cPhone"
                            , POCfirstName: "POC First Name"
                            , "POC First Name": "POCfirstName"
                            , POClastName: "POC Last Name"
                            , "POC Last Name": "POClastName"
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
        <a href="index.php">Item View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>
      <div  class='donorsEditor Editor' >
      <fieldset class="col-lg-18 editgrid"  >     
            <legend>Donor's List</legend>




            <table class="list">
            <tr>          
                <th>  id                 </th>
                <th>  First Name                 </th>
                <th>  Last Name                 </th>
                <th>  Preferred Name                 </th>
                <th>  Title                 </th>
                <th>  Address Line 1                 </th>
                <th>  Address Line 2                 </th>
                <th>  City                 </th>
                <th>  State                 </th>
                <th>  Zip                 </th>
                <th>  Email Address                 </th>
                <th>  Donor Type                 </th>
                <th>  Board Member?                 </th>
                <th>  Organization Name                 </th>
                <th>  Home Phone                 </th>
                <th>  Cell Phone                 </th>
                <th>  POC First Name                 </th>
                <th>  POC Last Name                 </th>
                <th>  Donation Amount Received                 </th>
            </tr> 
            <tbody data-bind="foreach: { data:  $.Form.KO.Model.items }" class="Binder">
                <tr>            
                    <td>  
                        <input class="form-control col-lg-6" data-bind='value: rowid' />
                        <input type="text" class="dirty" data-bind='value: dirty' />
                    </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: firstName' />                   </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: lastName' />                    </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: preferredName' />               </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: title' />                       </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: addressLine1' />                </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: addressLine2' />                </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: city' />                        </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: state' />                       </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: zip' />                         </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: emailAdress' />                  </td>
                     <td>  <select class="form-control col-lg-6" data-bind='value: donorType' />                   
                                  <option value="ind">Individual</option>
                                  <option value="org">Foundation</option>
                                  <option value="gov">Government</option>
                           </select>                                                                               </td>
                     <td>  <input type="checkbox" class="form-control col-lg-6" data-bind='value: areBoardMember' /> </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: orgName' />      </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: hPhone' />      </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: cPhone' />      </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: POCfirstName' />      </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: POClastName' />      </td>
                     <td>  <input class="form-control col-lg-6" data-bind='value: donationAmountReceived' />      </td>
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