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
                    Key: '1frTYm1_6TH3sv3byQ0nx_GD1gUWBQ5W1VTWspd0'
                    , Map: function( field ){
                        var map = {
                            , vendorType: "Vendor Type"
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
                            , state: "State" 
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

      <h1>Venders</h1>
<div id='VendersList' class='col-lg-12'>
        <a href="list.php">List View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>

      <div  class='donorsEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
      <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}" style="display:none">     
            <legend data-bind='html: lastName'> </legend>

            <button data-bind='click: $root.removeItem'>Delete</button><br/>

<table>
         <tr><th>   <label for="rowid" class="control-label">id</label>                                          </th><td>  <input class="form-control col-lg-6" data-bind='value: rowid' />                       </td></tr>
         <tr><th>   <label for="org" class="control-label">Organization Name?</label>                              </th><td>  <input class="form-control col-lg-6" data-bind='value: org' />                   </td></tr>
         <tr><th>   <label for="web" class="control-label">Website?</label>                                </th><td>  <input class="form-control col-lg-6" data-bind='value: web' />                    </td></tr>
         <tr><th>   <label for="addressLine1" class="control-label">Address Line 1</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: addressLine1' />                </td></tr>
         <tr><th>   <label for="addressLine2" class="control-label">Address Line 2</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: addressLine2' />                </td></tr>
         <tr><th>   <label for="city" class="control-label">City</label>                                         </th><td>  <input class="form-control col-lg-6" data-bind='value: city' />                        </td></tr>
         <tr><th>   <label for="state" class="control-label">State</label>                                       </th><td>  <input class="form-control col-lg-6" data-bind='value: state' />                       </td></tr>
         <tr><th>   <label for="zip" class="control-label">Zip</label>                                           </th><td>  <input class="form-control col-lg-6" data-bind='value: zip' />                         </td></tr>
         <tr><th>   <label for="art" class="control-label">Art Form</label>                          </th><td>  <input class="form-control col-lg-6" data-bind='value: art' />                 </td></tr>
         <tr><th>   <label for="w9" class="control-label">W9 Reciept (Calendar Year)</label>                 </th><td>  <input class="form-control col-lg-6" data-bind='value: w9' />             </td></tr>
         <tr><th>   <label for="anyGive" class="control-label">"Any Given Child" Committee Team Member?</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: anyGive' />      </td></tr>
         <tr><th>   <label for="execFName" class="control-label">Executive Director First Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: execFName' />        </td></tr>
         <tr><th>   <label for="execLName" class="control-label">Executive Director Last Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: execLName' />        </td></tr>
         <tr><th>   <label for="execHPhone" class="control-label">Executive Director Home Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: execHPhone' />        </td></tr>
         <tr><th>   <label for="execWPhone" class="control-label">Executive Director Work Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: execWPhone' />        </td></tr>
         <tr><th>   <label for="execMPhone" class="control-label">Executive Director Mobile Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: execMPhone' />        </td></tr>
         <tr><th>   <label for="execEmail" class="control-label">Executive Director Email</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: execEmail' />        </td></tr>
         <tr><th>   <label for="eduFName" class="control-label">Educational Programmer First Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: eduFName' />        </td></tr>
         <tr><th>   <label for="eduLName" class="control-label">Educational Programmer Last Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: eduLName' />        </td></tr>
         <tr><th>   <label for="eduHPhone" class="control-label">Educational Programmer Home Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: eduHPhone' />        </td></tr>
         <tr><th>   <label for="eduWPhone" class="control-label">Educational Programmer Work Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: eduWPhone' />        </td></tr>
         <tr><th>   <label for="eduMPhone" class="control-label">Educational Programmer Mobile Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: eduMPhone' />        </td></tr>
         <tr><th>   <label for="eduEmail" class="control-label">Educational Programmer Email</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: eduEmail' />        </td></tr>
         <tr><th>   <label for="schedFName" class="control-label">Scheduling First Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: schedFName' />        </td></tr>
         <tr><th>   <label for="schedLName" class="control-label">Scheduling Last Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: schedLName' />        </td></tr>
         <tr><th>   <label for="schedHPhone" class="control-label">Scheduling Home Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: schedHPhone' />        </td></tr>
         <tr><th>   <label for="schedWPhone" class="control-label">Scheduling Work Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: schedWPhone' />        </td></tr>
         <tr><th>   <label for="schedMPhone" class="control-label">Scheduling Mobile Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: schedMPhone' />        </td></tr>
         <tr><th>   <label for="schedEmail" class="control-label">Scheduling Email</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: schedEmail' />        </td></tr>
         <tr><th>   <label for="contact1FName" class="control-label">Other Contact 1 First Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact1FName' />        </td></tr>
         <tr><th>   <label for="contact1LName" class="control-label">Other Contact 1 Last Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact1LName' />        </td></tr>
         <tr><th>   <label for="contact1HPhone" class="control-label">Other Contact 1 Home Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact1HPhone' />        </td></tr>
         <tr><th>   <label for="contact1WPhone" class="control-label">Other Contact 1 Work Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact1WPhone' />        </td></tr>
         <tr><th>   <label for="contact1MPhone" class="control-label">Other Contact 1 Mobile Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact1MPhone' />        </td></tr>
         <tr><th>   <label for="contact1Email" class="control-label">Other Contact 1 Email</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact1Email' />        </td></tr>
         <tr><th>   <label for="contact2FName" class="control-label">Other Contact 2 First Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact2FName' />        </td></tr>
         <tr><th>   <label for="contact2LName" class="control-label">Other Contact 2 Last Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact2LName' />        </td></tr>
         <tr><th>   <label for="contact2HPhone" class="control-label">Other Contact 2 Home Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact2HPhone' />        </td></tr>
         <tr><th>   <label for="contact2WPhone" class="control-label">Other Contact 2 Work Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact2WPhone' />        </td></tr>
         <tr><th>   <label for="contact2MPhone" class="control-label">Other Contact 2 Mobile Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact2MPhone' />        </td></tr>
         <tr><th>   <label for="contact2Email" class="control-label">Other Contact 2 Email</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact2Email' />        </td></tr>
         <tr><th>   <label for="contact3FName" class="control-label">Other Contact 3 First Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact3FName' />        </td></tr>
         <tr><th>   <label for="contact3LName" class="control-label">Other Contact 3 Last Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact3LName' />        </td></tr>
         <tr><th>   <label for="contact3HPhone" class="control-label">Other Contact 3 Home Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact3HPhone' />        </td></tr>
         <tr><th>   <label for="contact3WPhone" class="control-label">Other Contact 3 Work Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact3WPhone' />        </td></tr>
         <tr><th>   <label for="contact3MPhone" class="control-label">Other Contact 3 Mobile Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact3MPhone' />        </td></tr>
         <tr><th>   <label for="contact3Email" class="control-label">Other Contact 3 Email</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: contact3Email' />        </td></tr>
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