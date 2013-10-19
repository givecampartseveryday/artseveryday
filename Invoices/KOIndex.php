<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script>
        $(function(){
            $.Auth(function(){ 
                 $.FusionGetTable('1NK0EXbnAI5kRC2pY-cqT76660fxlAwUiHXH2Hgc', function(data){
                    console.clear()
                    console.log('Start Knockout with', data)
                    var InvoicesModel = function( invoices ) {
                        var self = this;
                        self.invoices = ko.observableArray(
                            ko.utils.arrayMap(
                                invoices
                                , function( invoice ) {
                                return { 
                                    firstName: invoice["First Name"]
                                    , lastName: invoice["Last Name"]  
                                    , preferredName: invoice["Preferred Name"]  
                                    , salutation: invoice["Salutation"]  
                                };
                        }));
                    //debugger; 

                        self.addInvoice = function() {
                            self.invoices.push({
                                firstName: ""
                                , lastName: ""
                            });
                        };
                     
                        self.removeInvoice = function( invoice ) {
                            self.invoices.remove( invoice );
                        };
                     
                        self.save = function() {
                            self.lastSavedJson(JSON.stringify(ko.toJS(self.invoices), null, 2));
                        };
                     
                        self.lastSavedJson = ko.observable("")
                    };
                     
                    ko.applyBindings(
                        new InvoicesModel(data)
                    );                    
                    
                 })
            })
         })
</script>
    
</head>
<body>
<?php include '../_header.html'; ?>

    <div class="container">

      <h1>Invoices</h1>
<div id='InvoicesList' class='col-lg-12'>
    <div class='invoicesEditor well'>
      <div data-bind="foreach: invoices">
      <fieldset class="col-lg-10">     
      <legend data-bind='html: preferredName'> </legend>
      <button data-bind='click: $root.removeInvoice'>Delete</button><br/>
      <label for="salutation" class="col-lg-2 control-label">salutation</label><input class="form-control col-lg-6" data-bind='value: salutation' /><br/>
      <label for="firstName" class="col-lg-2 control-label">First Name</label><input class="form-control col-lg-6" data-bind='value: firstName' /><br/>
      <label for="lastName" class="col-lg-2 control-label">Last Name</label><input class="form-control col-lg-6" data-bind='value: lastName' /><br/>
      <fieldset>
      </div>
      <div><button data-bind='click: addInvoice'>Add a contact</button></div>
    </div>
    </div>
    </div>
    
<?php include '../_footer.html'; ?>
</body>

</html>