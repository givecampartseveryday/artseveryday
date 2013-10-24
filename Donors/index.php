<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script src="../_stub.php"></script>
<script src="../_reports.js"></script>
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
                            , "MI": "mI"
                            , "mI": "MI"
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
            $.Form.KO.AfterAddItem = function(){ 
                $.Form.Navigate.last(null)
            }
            $.Auth(function(){ 
                $.FusionGetTable( 
                    $.Table.Key
                    , function(data){ 
                        $.Form.KOSetup(data, function(){ 
                            $.Form.SetupSingle()
                            $('.donorKey').each(function(i,el){
                                var donorKey = $(el).val() 
                                //console.log('Set', donorKey)
                                $(el).next().addClass( donorKey ).hide()
                            }) 
                            $.FusionGetTable( $.AEDtables['Donations'], function(data){
                                $.each( data, function(i, row){
                                    var donorKey = row['Donor Last Name'].noSpace() + '-'+ row['Donor First Name'].noSpace() + '-'+ row['Donor MI'].noSpace() 
                                    //console.log('Get', donorKey)
                                    $('.'+donorKey).show()
                                })
                            })                                 
                            $('.byDonor').click(function(ev){
                                ev.preventDefault();
                                self = $(ev.target)
                                var donorKey = self.attr('class').replace('byDonor ', '')
                                var header = ['Donor Last Name', 'Donor First Name', 'Check Amount', 'Check Received'] 
                                var table = $.AEDtables['Donations']
                            
                                var donorNameArray= donorKey.split('-')
                                var spreadSheetTitle= 'AED Donations by Donor'
                                var workSheetTitle= 'Donor {0} {1}'.format(donorNameArray[0], donorNameArray[1])
                            
                                var sql = " WHERE "
                                sql += "'Donor Last Name' = '{0}'".format(donorNameArray[0].replace(/\_/g, ' ') )
                                sql += "AND 'Donor First Name' = '{0}'".format(donorNameArray[1].replace(/\_/g, ' ') )
                                sql += "AND 'Donor MI' = '{0}'".format(donorNameArray[2].replace(/\_/g, ' ') )
                            
                                $.Reports.makeThisReport( table, spreadSheetTitle, workSheetTitle, header, sql )
                            })                             
                    }) 
                })
            });
        });

        $(function(){
            $.FusionGetTable( $.AEDtables['Donors'], function(data){
                $.each( data, function(i, row){
                
                    var donorKey = row['Last Name'].noSpace() + '-'+ row['First Name'].noSpace() + '-'+ row['MI'].noSpace() 
                    var donorName = row['Last Name']+ ', ' + row['First Name']
                    var opt = '<option value="'+ donorKey+'">' + donorName + '</option>'
        
                    if( row['Last Name'].toLowerCase() !== "null" )
                        $('.donor-choose').append( opt )
                })
            })        
    


            $('.donor-choose').change(function(ev){
                var self = $( ev.target )
                var lookupDonorKey  = self.val()

                $.each($(".donorKey"), function(i, el){ 
                if( $(el).val() === lookupDonorKey ){
                        $.Form.Navigate.goto(i) 
                    }
                })
            })
            
            

    
           
        })
</script>
    
</head>
<body>
<?php include '../_header.html'; ?>

    <div class="container">

      <h1>Donors</h1>
<div id='DonorsList' class='col-lg-12'>
        <!-- <a href="list.php">List View</a> &nbsp; &nbsp; -->
       

                <label for="donor">Go to</label> <select class="donor-choose"></select> &nbsp; &nbsp;  <a class="openInDrive" href="#">Open in Google Drive</a>  <br/>
    <div style="clear: both">  
          <button data-bind='click: addItem'>Add a donor</button>

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
    <br/>
      <div  class='donorsEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
      <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}" style="display:none">     
            <legend data-bind='html: lastName'> </legend>

        <button data-bind='click: $root.removeItem'>Delete</button> 
        <input type="hidden" class="donorKey" data-bind="value: lastName.noSpace() + '-' + firstName.noSpace() + '-' + mI.noSpace() " />
        <a class="byDonor" href="#">Make Donor Report</a><br/>
        
        <table>
             <!-- <tr><th>   <label for="rowid" class="control-label">id</label>                                          </th><td>  <input class="form-control col-lg-6" data-bind='value: rowid' />                       </td></tr> -->
             <tr><th>   <label for="firstName" class="control-label">First Name</label>                              </th><td>  <input class="form-control col-lg-6 firstName" data-bind='value: firstName' />                   </td></tr>
             <tr><th>   <label for="lastName" class="control-label">Last Name</label>                                </th><td>  <input class="form-control col-lg-6 lastName" data-bind='value: lastName' />                    </td></tr>
             <tr><th>   <label for="preferredName" class="control-label">Preferred Name</label>                      </th><td>  <input class="form-control col-lg-6" data-bind='value: preferredName' />               </td></tr>
             <tr><th>   <label for="title" class="control-label">Title</label>                                       </th><td>  <input class="form-control col-lg-6" data-bind='value: title' />                       </td></tr>
             <tr><th>   <label for="addressLine1" class="control-label">Address Line 1</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: addressLine1' />                </td></tr>
             <tr><th>   <label for="addressLine2" class="control-label">Address Line 2</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: addressLine2' />                </td></tr>
             <tr><th>   <label for="city" class="control-label">City</label>                                         </th><td>  <input class="form-control col-lg-6" data-bind='value: city' />                        </td></tr>
             <tr><th>   <label for="state" class="control-label">State</label>                                       </th><td>  <input class="form-control col-lg-6" data-bind='value: state' />                       </td></tr>
             <tr><th>   <label for="zip" class="control-label">Zip</label>                                           </th><td>  <input class="form-control col-lg-6" data-bind='value: zip' />                         </td></tr>
             <tr><th>   <label for="emailAddress" class="control-label">Email Address</label>                       </th><td>  <input class="form-control col-lg-6" data-bind='value: emailAdress' />                  </td></tr>
             <tr><th>   <label for="donorType" class="control-label">Donor Type</label>                          </th><td>  <select class="form-control col-lg-6" data-bind='value: donorType' />                   
                                                                                                                                    <option value="ind">Individual</option>
                                                                                                                                    <option value="org">Foundation</option>
                                                                                                                                    <option value="gov">Government</option>
                                                                                                                            </select>                                                                                                                                                 </td></tr>
             <tr><th>   <label for="areBoardMember" class="control-label">Board Member?</label>                 </th><td>  <input type="checkbox" class="form-control col-lg-6" data-bind='value: areBoardMember' />                   </td></tr>
             <tr><th>   <label for="orgName" class="control-label">Organization Name</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: orgName' />      </td></tr>
             <tr><th>   <label for="hPhone" class="control-label">Home Phone</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: hPhone' />      </td></tr>
             <tr><th>   <label for="cPhone" class="control-label">Cell Phone</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: cPhone' />      </td></tr>
             <tr><th>   <label for="POCfirstName" class="control-label">POC First Name</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: POCfirstName' />      </td></tr>
             <tr><th>   <label for="POClastName" class="control-label">POC Last Name</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: POClastName' />      </td></tr>
             <tr><th>   <label for="donationAmountReceived" class="control-label">Donation Amount Received</label>   </th><td>  <input class="form-control col-lg-6" data-bind='value: donationAmountReceived' />      </td></tr>
             <tr><th>  </th><td></td></tr>
             <!-- <iframe src='../Donations/index.php' height='300' width='200' /> -->
             
             <!-- <div  class='donationsEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
                <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}" style="display:none">     
                
                </fieldset>
             </div> -->
             
      </table>
      <input type="text" class="dirty" data-bind='value: dirty' />

      </fieldset>

      </div><!-- donorsEditor databinder -->

          <button data-bind='click: save'>Save</button>
    <br />      


    
    </div><!-- DonorsList -->
    </div><!-- container -->
    
<?php include '../_footer.html'; ?>
</body>

</html>