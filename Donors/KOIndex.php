<html>
<head>
<?php include '../_scripts.html'; ?>
<script src="../_extends.js"></script>
<script src="../_authenticate.js"></script>
<script>
        $(function(){
            $.Auth(function(){ 
                 $.FusionGetTable('19RuwwJStqOBbPigLx--Lv3m6JpYvgbb7wj3AEV4', function(data){
                    console.clear()
                    console.log('Start Knockout with', data)
                    var DonorsModel = function( donors ) {
                        var self = this;
                        self.donors = ko.observableArray(
                            ko.utils.arrayMap(
                                donors
                                , function( donor ) {
                                return { 
                                    firstName: donor["First Name"]
                                    , lastName: donor["Last Name"]  
                                    , preferredName: donor["Preferred Name"]  
                                    , salutation: donor["Salutation"]  
                                };
                        }));
                    //debugger; 

                        self.addDonor = function() {
                            self.donors.push({
                                firstName: ""
                                , lastName: ""
                            });
                        };
                     
                        self.removeDonor = function( donor ) {
                            self.donors.remove( donor );
                        };
                     
                        self.save = function() {
                            self.lastSavedJson(JSON.stringify(ko.toJS(self.donors), null, 2));
                        };
                     
                        self.lastSavedJson = ko.observable("")
                    };
                     
                    ko.applyBindings(
                        new DonorsModel(data)
                    );                    
                    
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
    <div class='donorsEditor well'>
      <div data-bind="foreach: donors">
      <fieldset class="col-lg-10">     
      <legend data-bind='html: preferredName'> </legend>
      <button data-bind='click: $root.removeDonor'>Delete</button><br/>
      <label for="salutation" class="col-lg-2 control-label">salutation</label><input class="form-control col-lg-6" data-bind='value: salutation' /><br/>
      <label for="firstName" class="col-lg-2 control-label">First Name</label><input class="form-control col-lg-6" data-bind='value: firstName' /><br/>
      <label for="lastName" class="col-lg-2 control-label">Last Name</label><input class="form-control col-lg-6" data-bind='value: lastName' /><br/>
      <fieldset>
      </div>
      <div><button data-bind='click: addDonor'>Add a contact</button></div>
    </div>
    </div>
    </div>
    
<?php include '../_footer.html'; ?>
</body>

</html>