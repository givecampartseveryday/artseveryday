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
                    Key: $.AEDtables["Vendors"]
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
            $.Form.KO.AfterAddItem = function(){ 
                $.Form.Navigate.last(null)
            }
            $.Auth(function(){ 
                $.FusionGetTable( 
                    $.Table.Key
                    , function(data){ 
                    //debugger; 
                        $.Form.KO.OnDataBind = function(){
                            $('.vendorType').each(function(i, el){
                            ////debugger; 
                                $parent = $(el).parents('table')
                                if( $(el).val() === 'ind' ){
                                    $('.orgHide', $parent).hide()
                                }else{
                                    $('.orgHide', $parent).show()
                                }
                                $(el).change(function(e){
                                    //alert('Event'); 
                                    ////debugger; 
                                    var ele = e.target;
                                    $parent = $(ele).parents('table');
                                    if( $(ele).val() === 'ind' ){
                                        $('.orgHide', $parent).hide();
                                    }else{
                                        $('.orgHide', $parent).show();
                                    }
                                })
                            })

                            $.Form.SetupSingle(); 
                        }
                        ////debugger; 
                        $.Form.KOSetup(data, $.Form.KO.OnDataBind ) 
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
<div id='vendorsList' class='col-lg-12'>
        <!-- <a href="list.php">List View</a> &nbsp; &nbsp; -->
        <a class="openInDrive" href="#">Open in Google Drive</a>

      <div  class='donorsEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
      <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}" style="display:none">     
            <legend data-bind='html: orgName'> </legend>

            <button data-bind='click: $root.removeItem'>Delete</button><br/>

<table>
         <!-- <tr><th>   <label for="rowid" class="control-label">id</label>                                          </th><td>  <input class="form-control col-lg-6" data-bind='value: rowid' />                       </td></tr> -->
         <tr><th>   <label for="vendorType" class="control-label">Vendor Type</label>                              </th><td>  <select class="form-control col-lg-6 vendorType" data-bind='value: vendorType' />                   
                                                                                                                                    <option value="ind">Individual</option>
                                                                                                                                    <option value="org">Organization</option>
                                                                                                                                    <option value="gov">Governmental</option>
                                                                                                                                </select>                                                                                   </td></tr>
         <tr class="orgHide"><th>   <label for="orgName" class="control-label">Organization Name?</label>                                </th><td>  <input class="form-control col-lg-6" data-bind='value: orgName' />                    </td></tr>
         <tr><th>   <label for="firstName" class="control-label">First Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: firstName' />        </td></tr>
         <tr><th>   <label for="lastName" class="control-label">Last Name</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: lastName' />        </td></tr>
         <tr><th>   <label for="title" class="control-label">Title</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: title' />      </td></tr>
         <tr><th>   <label for="streetLine1" class="control-label">Street Line 1</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: streetLine1' />                </td></tr>
         <tr><th>   <label for="streetLine2" class="control-label">Street Line 2</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: streetLine2' />                </td></tr>
         <tr><th>   <label for="city" class="control-label">City</label>                                         </th><td>  <input class="form-control col-lg-6" data-bind='value: city' />                        </td></tr>
         <tr><th>   <label for="state" class="control-label">State</label>                                       </th><td>  <select class="form-control col-lg-6" data-bind='value: state' />
                                                                                                                                	<option value=""></option>
                                                                                                                                	<option value="AL">AL</option>
                                                                                                                                	<option value="AK">AK</option>
                                                                                                                                	<option value="AZ">AZ</option>
                                                                                                                                	<option value="AR">AR</option>
                                                                                                                                	<option value="CA">CA</option>
                                                                                                                                	<option value="CO">CO</option>
                                                                                                                                	<option value="CT">CT</option>
                                                                                                                                	<option value="DE">DE</option>
                                                                                                                                	<option value="DC">DC</option>
                                                                                                                                	<option value="FL">FL</option>
                                                                                                                                	<option value="GA">GA</option>
                                                                                                                                	<option value="HI">HI</option>
                                                                                                                                	<option value="ID">ID</option>
                                                                                                                                	<option value="IL">IL</option>
                                                                                                                                	<option value="IN">IN</option>
                                                                                                                                	<option value="IA">IA</option>
                                                                                                                                	<option value="KS">KS</option>
                                                                                                                                	<option value="KY">KY</option>
                                                                                                                                	<option value="LA">LA</option>
                                                                                                                                	<option value="ME">ME</option>
                                                                                                                                	<option value="MD">MD</option>
                                                                                                                                	<option value="MA">MA</option>
                                                                                                                                	<option value="MI">MI</option>
                                                                                                                                	<option value="MN">MN</option>
                                                                                                                                	<option value="MS">MS</option>
                                                                                                                                	<option value="MO">MO</option>
                                                                                                                                	<option value="MT">MT</option>
                                                                                                                                	<option value="NE">NE</option>
                                                                                                                                	<option value="NV">NV</option>
                                                                                                                                	<option value="NH">NH</option>
                                                                                                                                	<option value="NJ">NJ</option>
                                                                                                                                	<option value="NM">NM</option>
                                                                                                                                	<option value="NY">NY</option>
                                                                                                                                	<option value="NC">NC</option>
                                                                                                                                	<option value="ND">ND</option>
                                                                                                                                	<option value="OH">OH</option>
                                                                                                                                	<option value="OK">OK</option>
                                                                                                                                	<option value="OR">OR</option>
                                                                                                                                	<option value="PA">PA</option>
                                                                                                                                	<option value="RI">RI</option>
                                                                                                                                	<option value="SC">SC</option>
                                                                                                                                	<option value="SD">SD</option>
                                                                                                                                	<option value="TN">TN</option>
                                                                                                                                	<option value="TX">TX</option>
                                                                                                                                	<option value="UT">UT</option>
                                                                                                                                	<option value="VT">VT</option>
                                                                                                                                	<option value="VA">VA</option>
                                                                                                                                	<option value="WA">WA</option>
                                                                                                                                	<option value="WV">WV</option>
                                                                                                                                	<option value="WI">WI</option>
                                                                                                                                	<option value="WY">WY</option>
                                                                                                                            </select>                                                                              </td></tr>
         <tr><th>   <label for="zip" class="control-label">ZIP</label>                                           </th><td>  <input class="form-control col-lg-6" data-bind='value: zip' />                         </td></tr>
         <tr><th>   <label for="homePhone" class="control-label">Home Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: homePhone' />        </td></tr>
         <tr><th>   <label for="cellPhone" class="control-label">Cell Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: cellPhone' />        </td></tr>
         <tr><th>   <label for="workPhone" class="control-label">Work Phone</label>      </th><td>  <input class="form-control col-lg-6" data-bind='value: workPhone' />        </td></tr>
         <tr><th>   <label for="w9" class="control-label">W9 Is On File</label>                 </th><td>  <input type="checkbox" class="form-control col-lg-6" data-bind='value: w9' />           </td></tr>
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
    
    </div><!-- VendorsList -->
    </div><!-- container -->
    
<?php include '../_footer.html'; ?>
</body>

</html>
