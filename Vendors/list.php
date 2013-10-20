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
                    Key: $.AEDtables['Vendors']
                    , Map: function( field ){
                        var map = {
                            vendorType: "Vendor Type"
                            , "Vendor Type": "vendorType"
                            , orgName: "Organization Name"
                            , "Organization Name": "orgName"
                            , firstName: "First Name"
                            , "First Name": "firstName"
                            , lastName: "Last Name"  
                            , "Last Name": "lastName"  
                            , title: "Title"  
                            , "Title": "title"  
                            , streetLine1: "Street Line 1"
                            , "Street Line 1": "streetLine1"
                            , streetLine2: "Street Line 2" 
                            , "Street Line 2": "streetLine2" 
                            , city: "City"
                            , "City": "city"
                            , "state": "State" 
                            , "State": "state"
                            , zip: "ZIP"
                            , "ZIP": "zip"
                            , homePhone: "Home Phone"
                            , "Home Phone": "homePhone"
                            , cellPhone: "Cell Phone"
                            , "Cell Phone": "cellPhone"
                            , workPhone: "Work Phone"
                            , "Work Phone": "workPhone"
                            , w9: "W9 on file"
                            , "W9 on file": "w9"
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

      <h1>Vendors</h1>
<div id='VendorsList' class='col-lg-20'>
        <a href="index.php">Item View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>
      <div  class='vendorsEditor Editor' >
      <fieldset class="col-lg-18 editgrid"  >     
            <legend>Vendor's List </legend>




            <table>
            <tr>          
                <th>  id                                </th>
                <th>  Vendor Type                       </th>
                <th>  Organization Name?                </th>
                <th>  First Name                        </th>
                <th>  Last Name                         </th>
                <th>  Title                             </th>
                <th>  Street Line 1                     </th>
                <th>  Street Line 2                     </th>
                <th>  City                              </th>
                <th>  State                             </th>
                <th>  ZIP                               </th>
                <th>  Home Phone                        </th>
                <th>  Cell Phone                        </th>
                <th>  Work Phone                        </th>
                <th>  W9 On File?                       </th>
            </tr> 
            <tbody data-bind="foreach: { data:  $.Form.KO.Model.items }" class="Binder">
                <tr>            
                    <td>  
                        <input class="form-control col-lg-6" data-bind='value: rowid' />
                        <input type="text" class="dirty" data-bind='value: dirty' />
                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: vendorType' />                  </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: orgName' />                     </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: firstName' />                   </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: lastName' />                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: title' />                       </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: streetLine1' />                 </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: streetLine2' />                 </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: city' />                        </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: state' />                       </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: zip' />                         </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: homePhone' />                   </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: cellPhone' />                   </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: workPhone' />                   </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: w9' />                          </td>
                    <td>  <button data-bind='click: $root.removeItem'>Delete</button>                            </td>
                     
                </tr>
            </tbody>
            </table>
           <br/>

      </fieldset>

      </div><!-- vendorsEditor databinder -->

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
    
    </div><!-- VendorsList -->
    </div><!-- container -->
    
<?php include '../_footer.html'; ?>
</body>

</html>