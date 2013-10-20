<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script src="../_tables.js"></script>
<link href="../style.css" rel="stylesheet" type="text/css" />
<script>
    function setAsDeleted(name) {
        name += ' will be deleted upon "Save"';
    }

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
                    Key: $.AEDtables["Schools"]
                    , Map: function( field ){
                        var map = {
                            schoolname: "School Name"
                            , "School Name": "schoolname"
                            , integrationCoachTitle: "Arts Integration Coach Title"
                            , "Arts Integration Coach Title": "integrationCoachTitle"
                            , integrationCoachFirstName: "Arts Integration Coach First Name"
                            , "Arts Integration Coach First Name": "integrationCoachFirstName"
                            , integrationCoachLastName: "Arts Integration Coach Last Name"
                            , "Arts Integration Coach Last Name": "integrationCoachLastName"
                            , integrationCoachEmail: "Arts Integration Coach Email"
                            , "Arts Integration Coach Email": "integrationCoachEmail"
                            , enrollment: "Student Enrollment" 
                            , "Student Enrollment": "enrollment" 
                            , title1: "Title 1"
                            , "Title 1": "title1"
                            , targetedAssistance: "Targeted Assistance" 
                            , "Targeted Assistance": "targetedAssistance"
                            , farmsRate: "FARMS Rate"
                            , "FARMS Rate": "farmsRate"
                            , schoolCode: "School Code"
                            , "School Code": "schoolCode"
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
                            , phone: "Phone"
                            , "Phone": "phone"
                            , gradeRanges: "Grade Ranges"
                            , "Grade Ranges": "gradeRanges"
                            , numberOfTeachers: "Number of Teachers"
                            , "Number of Teachers": "numberOfTeachers"
                            , numberOfArtTeachersFullTime: "Number of Art Teachers Full Time"
                            , "Number of Art Teachers Full Time": "numberOfArtTeachersFullTime"
                            , yearJoined: "Year Joined"
                            , "Year Joined": "yearJoined"
                            , other: "Other"
                            , "Other": "other"
                            , principalTitle: "Principal Title"
                            , "Principal Title": "principalTitle"
                            , principalFirstName: "Principal First Name"
                            , "Principal First Name": "principalFirstName"
                            , principalLastName: "Principal Last Name"
                            , "Principal Last Name": "principalLastName"
                            , principalEmail: "Principal Email"
                            , "Principal Email": "principalEmail"
                        
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

      <h1>Schools</h1>
<div id='SchoolsList' class='col-lg-12'>
        <a href="list.php">List View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>

      <div  class='donorsEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
      <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}" style="display:none">     
            <legend data-bind='html: schoolname'> </legend>

            <button data-bind='click: $root.removeItem'>Delete</button><br/>

<table>
         <tr><th>   <label for="schoolname" class="control-label">School Name</label>                          </th><td>  <input size="60" class="form-control col-lg-6" data-bind='value: schoolname' />                       </td></tr>
         <tr><th>   <label for="schoolCode" class="control-label">School Code</label>                          </th><td>  <input class="form-control col-lg-6" data-bind='value: schoolCode' />                   </td></tr>
         <tr><th>   <label for="integrationCoachTitle" class="control-label">Integration Coach Title</label>         </th><td>  <input class="form-control col-lg-6" data-bind='value: integrationCoachTitle' />                    </td></tr>
         <tr><th>   <label for="integrationCoachFirstName" class="control-label">Integration Coach First Name</label>         </th><td>  <input class="form-control col-lg-6" data-bind='value: integrationCoachFirstName' />                    </td></tr>
         <tr><th>   <label for="integrationCoachLastName" class="control-label">Integration Coach Last Name</label>         </th><td>  <input class="form-control col-lg-6" data-bind='value: integrationCoachLastName' />                    </td></tr>
         <tr><th>   <label for="integrationCoachEmail" class="control-label">Integration Coach Email</label>                          </th><td>  <input class="form-control col-lg-6" data-bind="value: integrationCoachEmail" /></td></tr>
         <tr><th>   <label for="principalTitle" class="control-label">Principal Title</label>                                     </th><td>  <input class="form-control col-lg-6" data-bind='value: principalTitle' /> </td></tr>
         <tr><th>   <label for="principalFirstName" class="control-label">Principal First Name</label>                                     </th><td>  <input class="form-control col-lg-6" data-bind='value: principalFirstName' /> </td></tr>
         <tr><th>   <label for="principalLastName" class="control-label">Principal Last Name</label>                                     </th><td>  <input class="form-control col-lg-6" data-bind='value: principalLastName' /> </td></tr>
         <tr><th>   <label for="principalEmail" class="control-label">Principal Email</label>                  </th><td>  <input class="form-control col-lg-6" data-bind="value: principalEmail" /></td></tr>
         <tr><th>   <label for="enrollment" class="control-label">Student Enrollment</label>                   </th><td>  <input class="form-control col-lg-6" data-bind='value: enrollment' />                </td></tr>
         <tr><th>   <label for="title1" class="control-label">Title 1?</label>                                 </th><td>  <input title="Check for yes" type="checkbox" class="form-control col-lg-6" data-bind='value: title1' />                </td></tr>
         <tr><th>   <label for="targetedAssistance" class="control-label">Targeted Assistance?</label>         </th><td>  <input title="Check for yes" type="checkbox" class="form-control col-lg-6" data-bind='value: targetedAssistance' />                     </td></tr>
         <tr><th>   <label for="farmsRate" class="control-label">FARMS Rate</label>                            </th><td>  <input class="form-control col-lg-6" data-bind='value: farmsRate' placeholder='Enter as decimal 0-1.00' />                       </td></tr>
         <tr><th>   <label for="streetLine1" class="control-label">Street Address Line 1</label>               </th><td>  <input class="form-control col-lg-6" data-bind='value: streetLine1' />                       </td></tr>
         <tr><th>   <label for="streetLine2" class="control-label">Street Address Line 2</label>               </th><td>  <input class="form-control col-lg-6" data-bind='value: streetLine2' />                       </td></tr>
         <tr><th>   <label for="city" class="control-label">City</label>                                       </th><td>  <input class="form-control col-lg-6" data-bind='value: city' />                       </td></tr>
         <tr><th>   <label for="state" class="control-label">State</label>                                     </th><td>  <input class="form-control col-lg-6" data-bind='value: state' />                       </td></tr>
         <tr><th>   <label for="zip" class="control-label">ZIP</label>                                         </th><td>  <input class="form-control col-lg-6" data-bind='value: zip' placeholder='XXXXX' />                         </td></tr>
         <tr><th>   <label for="phone" class="control-label">Phone</label>                                     </th><td>  <input class="form-control col-lg-6" data-bind='value: phone' placeholder='XXX-XXX-XXXX' /> </td></tr>
         <tr><th>   <label for="gradeRanges" class="control-label">Grade Ranges</label>                        </th><td>  <input class="form-control col-lg-6" data-bind='value: gradeRanges' /> </td></tr>
         <tr><th>   <label for="numberOfTeachers" class="control-label">Number Of Teachers</label>             </th><td>  <input class="form-control col-lg-6" data-bind='value: numberOfTeachers' /> </td></tr>
         <tr><th>   <label for="numberOfArtTeachersFullTime" class="control-label">Number Of Art Teachers Full Time</label>               </th><td>  <input class="form-control col-lg-6" data-bind='value: numberOfArtTeachersFullTime' /> </td></tr>
         <tr><th>   <label for="yearJoined" class="control-label">Year Joined</label>                          </th><td>  <input class="form-control col-lg-6" data-bind="value: yearJoined" /></td></tr>
         <tr><th>   <label for="other" class="control-label">Other</label>                                     </th><td>  <input class="form-control col-lg-6" data-bind='value: other' /> </td></tr>
</table>

            <input type="text" class="dirty" data-bind='value: dirty' />
      </fieldset>

      </div><!-- donorsEditor databinder -->

    <br />      

    <div style="clear: both">  
          <button data-bind='click: addItem'>Add a school</button>
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
    
    </div><!-- SchoolsList -->
    </div><!-- container -->
    
<?php include '../_footer.html'; ?>
</body>

</html>