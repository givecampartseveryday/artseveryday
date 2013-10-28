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
            var DonorKey = $.QueryString('DonorKey')
             $.Hash.access_token = $.QueryString('access_token')
            var lastName = DonorKey.split('--')[0].replace(/\_/g, ' ') || ''
            var firstName = DonorKey.split('--')[1].replace(/\_/g, ' ') || ''
            var middle = DonorKey.split('--')[2].replace(/\_/g, ' ') || ''

            var sql = " WHERE "
            sql += " 'Donor Last Name' = '{0}'".format( lastName )
            sql += " AND 'Donor First Name' = '{0}'".format( firstName )
            sql += " AND 'Donor MI' = '{0}'".format( middle )

            // debugger; 
            $.extend( 
                $.Form
                , {

                }
            );
            $.extend( 
                $.Table
                , {
                    Key: $.AEDtables['Donations']
                    , Map: function( field ){
                        var map = {
                            donorID: "DonorID"
                            , "DonorID": "donorID"
                            , donorType: "Donor Type"  
                            , "Donor Type": "donorType"
                            , donorFirstName: "Donor First Name"  
                            , "Donor First Name": "donorFirstName"
                            , donorLastName: "Donor Last Name"  
                            , "Donor Last Name": "donorLastName"
                            , donorOrganization: "Donor Organization"  
                            , "Donor Organization": "donorOrganization"
                            , typeOfGift: "Type of Gift"
                            , "Type of Gift": "typeOfGift"
                            , askAmount: "Ask Amount"
                            , "Ask Amount": "askAmount"
                            , pledgeRecieved: "Pledge Recieved" 
                            , "Pledge Recieved": "pledgeRecieved" 
                            , pledgeAmount: "Pledge Amount" 
                            , "Pledge Amount": "pledgeAmount" 
                            , checkAmount: "Check Amount"
                            , "Check Amount": "checkAmount"
                            , checkReceived: "Check Received" 
                            , "Check Received": "checkReceived"
                            , checkNumber: "Check Number"
                            , "Check Number": "checkNumber"
                            , completeCertificateReceived: "Complete Certificate Received"
                            , "Complete Certificate Received": "completeCertificateReceived"
                            , acknowledgementLetterSendDate: "Acknowledgement Letter Send Date"
                            , "Acknowledgement Letter Send Date": "acknowledgementLetterSendDate"
                            , dhcdCertificationSendDate: "DHCD Certification Send Date"
                            , "DHCD Certification Send Date": "dhcdCertificationSendDate"
                            , dateOnCheck: "Date on Check"
                            , "Date on Check": "dateOnCheck"
                            , fiscalYear: "Fiscal Year"
                            , "Fiscal Year": "fiscalYear"
                            , isTaxCredit: "isTaxCredit"
                            , "isTaxCredit": "isTaxCredit"
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
            //$.Auth(function(){ 
            //debugger; 
                $.FusionGetTable( 
                    $.Table.Key
                    , function(data){ 
                        var afterSetup = function(){
                            
                            $.Form.Setup()
                        }
                    
                        $.Form.KOSetup(data, function(){ }) 
                    } 
                    , sql
                )
            //});
        });
        
</script>
    
</head>
<body>

    <div class="container">

<div id='DonorsList' class='col-lg-12'>
        <!-- <a href="list.php">List View</a> &nbsp; &nbsp; -->

      <div  class='donorsEditor Editor Binder' data-bind="foreach: { data:  $.Form.KO.Model.items }">
      <fieldset class="col-lg-10 editgrid" data-bind=" attr: {'id': 'fieldset_' + rowid}">     
            <legend data-bind='html: donorLastName'> </legend>

        <button data-bind='click: $root.removeItem'>Delete</button><br/>

        <table>
            <tr>                                                                                                                 
            <th><label for="rowid" class="control-label">id</label>                                                           </th>
            <th><label for="donorID" class="control-label">Donor ID</label>                                                   </th>
            <th><label for="donorType" class="control-label">Donor Type</label>                                               </th>
            <th><label for="donorFirstName" class="control-label">Donor First Name</label>                                    </th>
            <th><label for="donorLastName" class="control-label">Donor Last Name</label>                                      </th>
            <th><label for="donorOrganization" class="control-label">Donor Organization</label>                               </th>
            <th><label for="typeOfGift" class="control-label">Type of Gift</label>                                            </th>
            <th><label for="askAmount" class="control-label">Amount Requested</label>                                         </th>
            <th><label for="pledgeRecieved" class="control-label">Date Pledge Recieved</label>                                </th>
            <th><label for="pledgeAmount" class="control-label">Pledge Amount</label>                                         </th>
            <th><label for="checkAmount" class="control-label">Check Amount</label>                                           </th>
            <th><label for="checkReceived" class="control-label">Date Check Received</label>                                  </th>
            <th><label for="checkNumber" class="control-label">Check Number</label>                                           </th>
            <th><label for="completeCertificateReceived" class="control-label">Complete Certificate Received</label>          </th>
            <th><label for="acknowledgementLetterSendDate" class="control-label">Date Acknowledgement Letter sent</label>     </th>
            <th><label for="dhcdCertificationSendDate" class="control-label">DHCD Certification SendDate</label>              </th> 
            <th><label for="dateOnCheck" class="control-label">Date on Check</label>                                          </th>
            <th><label for="fiscalYear" class="control-label">Fiscal Year</label>                                             </th>
            <th><label for="isTaxCredit" class="control-label">Is Tax Credit</label>                                          </th>
            </tr>
            
            <tr>           
             <td><input class="form-control col-lg-6" data-bind='value: rowid' />                                                                                                                                                          </td>
             <td><input class="form-control col-lg-6" data-bind='value: donorID' />                                                                                                                                                        </td>
             <td><input class="form-control col-lg-6" data-bind='value: donorType' />                                                                                                                                                      </td>
             <td><input class="form-control col-lg-6" data-bind='value: donorFirstName' />                                                                                                                                                 </td>
             <td><input class="form-control col-lg-6" data-bind='value: donorLastName' />                                                                                                                                                  </td>
             <td><input class="form-control col-lg-6" data-bind='value: donorOrganization' />                                                                                                                                              </td>
             <td><input class="form-control col-lg-6" data-bind='value: typeOfGift' />                                                                                                                                                     </td>
             <td><input class="form-control col-lg-6" data-bind='value: askAmount' />                                                                                                                                                      </td>
             <td><input class="form-control col-lg-6" data-bind='value: pledgeRecieved' />                                                                                                                                                 </td>
             <td><input class="form-control col-lg-6" data-bind='value: pledgeAmount' />                                                                                                                                                   </td>
             <td><input class="form-control col-lg-6" data-bind='value: checkAmount' />                                                                                                                                                    </td>
             <td><input class="form-control col-lg-6" data-bind='value: checkReceived' />                                                                                                                                                  </td>
             <td><input class="form-control col-lg-6" data-bind='value: checkNumber' />                                                                                                                                                    </td>
             <td><input class="form-control col-lg-6" data-bind='value: completeCertificateReceived' /><input title="Check for yes" type="checkbox" class="form-control col-lg-6" data-bind='checked: completeCertificateReceived' />      </td>
             <td><input class="form-control col-lg-6" data-bind='value: acknowledgementLetterSendDate' />                                                                                                                                  </td>
             <td><input class="form-control col-lg-6" data-bind='value: dhcdCertificationSendDate' />                                                                                                                                      </td>
             <td><input class="form-control col-lg-6" data-bind='value: dateOnCheck' />                                                                                                                                                    </td>
             <td><input class="form-control col-lg-6" data-bind='value: fiscalYear' />                                                                                                                                                     </td>
             <td><input class="form-control col-lg-6" data-bind='value: isTaxCredit' /><input title="Check for yes" type="checkbox" class="form-control col-lg-6" data-bind='checked: isTaxCredit' />                                      </td>
            </tr>
      
      
      </table>
      <input type="text" class="dirty" data-bind='value: dirty' />

      </fieldset>

      </div><!-- donorsEditor databinder -->

    <br />      

    <div style="clear: both">  
          <button data-bind='click: addItem'>Add a Donation</button>
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
    
</body>

</html>