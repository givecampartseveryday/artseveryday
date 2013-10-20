<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script src="../_tables.js"></script>
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

      <h1>Schools</h1>
<div id='SchoolsList' class='col-lg-20'>
        <a href="index.php">Item View</a> &nbsp; &nbsp; <a class="openInDrive" href="#">Open in Google Drive</a>
      <div  class='SchoolsEditor Editor' >
      <fieldset class="col-lg-18 editgrid"  >     
            <legend>Schools List </legend>




            <table>
            <tr>    
                <th>  Row ID </th>
                <th>  School Name                                </th>         
                <th>  School Code                        </th>      
                <th>  Arts Integration Coach Title                         </th>
                <th>  Arts Integration Coach First Name                         </th>
                <th>  Arts Integration Coach Last Name                         </th>
                <th>  Arts Integration Coach Email                         </th>
                <th>  Principal Title                         </th>
                <th>  Principal First Name                         </th>
                <th>  Principal Last Name                         </th>
                <th>  Principal Email                         </th>
                <th>  Student Enrollment                    </th>    
                <th>  Title 1?                    </th>  
                <th>  Targeted Assistance?                              </th>           
                <th>  FARMS Rate                             </th>           
                <th>  Street Address Line 1                      </th>     
                <th>  Street Address Line 2                 </th> 
                <th>  City          </th>        
                <th>  State           </th>
                <th>  ZIP </th>
                <th>  Phone </th>
                <th>  Grade Ranges </th>
                <th>  Number Of Teachers </th>
                <th>  Number Of Art Teachers Full Time </th>
                <th>  Year Joined </th>
            </tr> 
            <tbody data-bind="foreach: { data:  $.Form.KO.Model.items }" class="Binder">
                <tr>            
                    <td>  
                        <input class="form-control col-lg-6" data-bind='value: rowid' />
                        <input type="text" class="dirty" data-bind='value: dirty' />
                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: schoolname' />                   </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: schoolCode' />                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: integrationCoachTitle' />                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: integrationCoachFirstName' />                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: integrationCoachLastName' />                    </td>
                    <td>  <input class="form-control col-lg-6" data-bind="value: integrationCoachEmail" /></td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: principalTitle' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: principalFirstName' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: principalLastName' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind="value: principalEmail" /></td>
         
                    <td>  <input class="form-control col-lg-6" data-bind='value: enrollment' />                </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: title1' />                        </td>
                    <td>  <input type="checkbox" class="form-control col-lg-6" data-bind='value: targetedAssistance' />                       </td>
                    <td>  <input type="checkbox" class="form-control col-lg-6" data-bind='value: farmsRate' />                         </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: streetLine1' />             </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: streetLine2' />      </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: city' />        </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: state' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: zip' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: phone' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: gradeRanges' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: numberOfTeachers' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: numberOfArtTeachersFullTime' /> </td>
                    <td>  <input class="form-control col-lg-6" data-bind='value: yearJoined' /> </td>
                    
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