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
                    Key: '1PNeqmJw9mkdo36s7UGcOWhSnNDFZNm_dflmRTzU'
                    , Map: function( field ){
                        var map = {
                            schoolname: "School Name"
                            , "School Name": "schoolname"
                            , schoolnum: "School Number"  
                            , "School Number": "schoolnum"  
                            , integrationCoach: "Arts Integration Coach"
                            , "Arts Integration Coach": "integrationCoach"
                            , enrollment: "Student Enrollment" 
                            , "Student Enrollment": "enrollment" 
                            , title1: "Title 1"
                            , "Title 1": "title1"
                            , targetedAssistance: "Targeted Assistance" 
                            , "Targeted Assistance": "targetedAssistance"
                            , farmsRate: "FARMS Rate"
                            , "FARMS Rate": "farmsRate"
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
         <tr><th>   <label for="schoolname" class="control-label">School Name</label>                          </th><td>  <input class="form-control col-lg-6" data-bind='value: schoolname' />                       </td></tr>
         <tr><th>   <label for="schoolnum" class="control-label">School #</label>                              </th><td>  <input pattern="[0-9]{,3}" class="form-control col-lg-6" data-bind='value: schoolnum' />                   </td></tr>
         <tr><th>   <label for="integrationCoach" class="control-label">Arts Integration Coach</label>         </th><td>  <input class="form-control col-lg-6" data-bind='value: integrationCoach' />                    </td></tr>
         <tr><th>   <label for="enrollment" class="control-label">Student Enrollment</label>                   </th><td>  <input pattern="\d+" class="form-control col-lg-6" data-bind='value: enrollment' />                </td></tr>
         <tr><th>   <label for="title1" class="control-label">Title 1?</label>                                 </th><td>  <input type="checkbox" class="form-control col-lg-6" data-bind='value: title1' />                </td></tr>
         <tr><th>   <label for="targetedAssistance" class="control-label">Targeted Assistance?</label>         </th><td>  <input type="checkbox" class="form-control col-lg-6" data-bind='value: targetedAssistance' />                        </td></tr>
         <tr><th>   <label for="farmsRate" class="control-label">FARMS Rate</label>                            </th><td>  <input pattern="\d+" class="form-control col-lg-6" data-bind='value: farmsRate' />                       </td></tr>
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