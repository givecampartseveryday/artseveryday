var jQuery = jQuery || {}; 


/*
$.Reports
        , spreadSheetTitle: 'AED Test'
        , workSheetTitle: 'Work Sheet'
        , rowsCount: '2'
        , colsCount: '2'
        , header: ['head1', 'head2']
        , rows: [
                    ['r2c1', 'r2c2' ] 
                    , ['r3c1','r3c2' ] 
        ]
*/
    
( function($) {


//    debugger; 
    $.Reports = {
        ssid: null
        , wsid: null
        , token: null 
        , spreadSheetTitle: null
        , workSheetTitle: null
        , rowsCount: null
        , colsCount: null
        , header: null
        , colno: null
        , rows: null
        , createSpreadSheet: function(){
            var createLocation = "https://www.googleapis.com/drive/v2/files"
            return  webCreate = $.ajax( {
                    url: createLocation
                    , type: "POST"
                    , contentType:"application/json;"
                    , beforeSend: function (request) {
                        request.setRequestHeader("Authorization",  "Bearer " + $.Reports.token);
                    }                    
                    //, data:  "{'mimeType': 'application/vnd.google-apps.spreadsheet', 'title': 'AED Test Upload'}" 
                    , data: "{'mimeType': 'application/vnd.google-apps.spreadsheet', 'title': '" + $.Reports.spreadSheetTitle + "'}" 
                } )              
        }
        , createWorkSheet: function(){
            ssUrl = '../_worksheet.php?token={0}&ssid={1}'.format($.Reports.token, $.Reports.ssid)
            // return webContent = $.get(ssUrl )                      
            //console.log('Create Worksheet', $.Reports.workSheetTitle, $.Reports.rowsCount,$.Reports.colsCount  )
            //debugger; 
            return webContent = $.post( ssUrl, { workSheet: $.Reports.workSheetTitle, rows: $.Reports.rowsCount, cols: $.Reports.colsCount } )      
        }
        , addSheetHeader: function(){
            ssUrl = '../_worksheetHeader.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
            // return webContent = $.get(ssUrl )    

            //console.log('Create Header', $.Reports.token, $.Reports.ssid, $.Reports.wsid )
            //debugger; 

            var deferred = []
            //set rowcount, colcount

            $.each($.Reports.header, function(i,el){
                //$.Reports.colno = i+1
                //debugger; 
                deferred.push( $.post(ssUrl, { sheetHeader: el.toLowerCase(), colNumber: i+1 } ) )
            })
            return $.when( deferred );
            
        }        
        , addRows: function(){
            ssUrl = '../_worksheetRows.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
            //debugger; 
            var deferred = []
            $.each($.Reports.rows, function(rowIndex, row){
                var xml = ''
                $.each(row, function(colIndex,cell){
                    var head = $.Reports.header[colIndex].toLowerCase()
                    xml += '<gsx:' + head +'>' + cell + '</gsx:'+ head +'>'
                })
                //debugger; 
                deferred.push( $.post(ssUrl, { 'row': xml } ) )
                console.log('add row', xml)
                //$.post(ssUrl, { 'row': xml } ).done(function(data){
                //    console.log('add row', data)
                //})
            })
            return $.when( deferred );
        }
        , makeThisReport: function(table, spreadSheetTitle, workSheetTitle, header, where){
    
            var url = "https://www.googleapis.com/fusiontables/v1/query"
            url += "?access_token={0}".format($.Hash["access_token"]) 
        
            var sql = "SELECT  '" + header.join("','")+ "' "
            sql += "FROM " + table
            sql += where
            url += "&sql=" + sql

            var xhr = $.get(url)
            .done(function(data){
                if (typeof(data.rows) === 'undefined') {
                    return false; 
                }
                var query = {
                    spreadSheetTitle: spreadSheetTitle
                    , workSheetTitle: workSheetTitle
                    , rowsCount: data.rows.length +1
                    , colsCount: data.columns.length
                    , header:  header.map(function(el){return el.replace(/\s+/g, '').toLowerCase()})
                    , rows: data.rows      
                }
                $.extend( $.Reports, query ) 
                $.Reports.makeReport();    
            })
        }        
        , makeReport: function(){
            $.Reports.token = $.Hash["access_token"]
            var token = $.Reports.token
            
            if(! $.Reports.spreadSheetTitle )
                $.Reports.spreadSheetTitle = 'AED'
            if(! $.Reports.workSheetTitle )
                $.Reports.workSheetTitle = 'AED'

           //$.Reports.workSheetTitle = $.Reports.workSheetTitle 
            $.Reports.spreadSheetTitle = 'AED ' + $.Reports.spreadSheetTitle 
                
            $.Reports.createSpreadSheet().done(function(ssdata){
                $.Reports.ssid = ssdata.id
                //console.log('Spreadsheet added', ssdata) 
                $.Reports.createWorkSheet().done(function(wsdata){
                    var idstart = wsdata.indexOf("<id")
                    var idend = wsdata.indexOf( "</id>", idstart)
                    var idUri = wsdata.substring(idstart, idend).replace('<id>', '')
                    var istart = idUri.indexOf('/full/')
                    var iend = idUri.indexOf('/private/')

                    $.Reports.wsid =  idUri.substring(istart, idUri.length).replace("/full/", '')
                    
                    console.log('Worksheet added', wsdata) 
                    setTimeout(function(){return true},1000)
                   $.Reports.addSheetHeader().done(function(headData){
                       console.log('header added', headData) 
            //       //debugger; 
                        setTimeout(function(){return true},1000)

                        $.Reports.addRows()
                         //  $.Reports.ssid= null
                         //  $.Reports.wsid= null
                         //  $.Reports.token= null 
                         //  $.Reports.spreadSheetTitle= null
                         //  $.Reports.workSheetTitle= null
                         //  $.Reports.rowsCount= null
                         //  $.Reports.colsCount= null
                         //  $.Reports.header= null
                         //  $.Reports.colno= null
                         //  $.Reports.rows= null

                    // $.Reports.addRows().done(function(rowdata){
                    //       console.log('rows added', rowdata) 
                    //       //debugger; 
                    //   })
                    
                   })
                 })
            })


        }
    }
})(jQuery);

/*
$(document).ready(function(){
    var artForms = $.AEDartforms;
    var programTypes = $.AEDprogramtypes;
    
    
    //Fill the Art Forms and Program Types <select> elements from the
    //global $.AEDartforms and $.AEDprogramtypes variables. These are defined
    //in _stub.php. These are not dynamic.
    for (var i = 0; i < artForms.length; i++) {
        $("#artFormSelect").append("<option>"+artForms[i]+"</option>");
        $("#programTypeSelect").append("<option>"+programTypes[i]+"</option>");
    }
    
    //Fill the Schools <select> element. Since the list of schools can change,
    //this element is filled by querying the Schools Fusion Table and getting
    //all the School Names
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'School Name' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Schools"];
        
    url += sql;
    console.log(url);
    
    var xhr = $.get(url, 
        function(response) {
            for (var i in response.rows) {
                $("#schoolSelect").append("<option>"+response.rows[i]+"</option>");
            }
        }
    );
    //console.log(xhr);
    //console.log(xhr.responseJSON);
    
})
*/

function objectSerialize(form) {
    var o = {};
    var a = form.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

function packJSONforInvoiceSpreadsheet (json, reportType, start, end) {
    var title = "Invoices for " + reportType + ' over ' + start + '-' + end;
    var worksheetTitle = "Invoices for " + reportType;
    
    console.log("json.rows = " + json.rows, json.rows !== null);
    console.log(json);
    if (typeof(json.rows) != 'undefined') {
        var rows = json.rows.length;
    } else {
        alert("The report of " + reportType + " from " + start + " to " + end + " contains no data.");
        return;
    }
    var cols = json.columns.length;
    var header = json.columns;
    var data = []

    $.each( json.rows, function(rowIndex, row){
        var _row = []
            $.each(row, function(colIndex,cell){
                    _row.push(cell.toString().toLowerCase() )
                })
                data.push(_row)
            })

    
    //Strip spaces out of header names
    for (var i = 0; i < cols; i++ ) {
        header[i] = header[i].replace(/\s+/g, "");
    }
    
    

    var packed = {"spreadSheetTitle":title, "worksheetTitle": worksheetTitle,
        "rowsCount":rows, "colsCount":cols, "header":header, "rows": data};
        
    return packed;
}

function packJSONforDonationSpreadsheet (json, reportType, start, end) {
    var title = "Donations for " + reportType + ' over ' + start + '-' + end;
    var worksheetTitle = "Donations for " + reportType;
    
    if (typeof(data.rows) != 'undefined') {
        var rows = json.rows.length;
    } else {
        alert("The report of " + reportType + " from " + start + " to " + end + " contains no data.");
    }
    
    var cols = json.columns.length;
    var header = json.columns;
    var data = []

    $.each( json.rows, function(rowIndex, row){
        var _row = []
            $.each(row, function(colIndex,cell){
                    _row.push(cell.toString().toLowerCase() )
                })
                data.push(_row)
            })

    
    //Strip spaces out of header names
    for (var i = 0; i < cols; i++ ) {
        header[i] = header[i].replace(/\s+/g, "");
    }
    
    

    var packed = {"spreadSheetTitle":title, "worksheetTitle": worksheetTitle,
        "rowsCount":rows, "colsCount":cols, "header":header, "rows": data};
        
    return packed;
}

function generateJSONByArtForm(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Date', 'Vendor Name', 'VendorID', 'Invoice Number', 'School Name' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Invoices"];
        
        sql += " WHERE ";
        sql += "'Art Form Type' = ";
        sql += "'" + inputs["artForm"] + "'";
        sql += " AND 'Date' >= " 
        sql += "'" + inputs["start"] + "'";
        sql += " AND 'Date' <= " 
        sql += "'" + inputs["end"] + "'";
        
    url += sql
    console.log(url);
    
    var xhr = $.get(url, 
    
        function(response) {
            var packed = packJSONforInvoiceSpreadsheet(response, inputs["artForm"], inputs["start"], inputs["end"]);
            
            //If `packed` is not undefined, it means the data selection contains some data. packJSONforInvoiceSpreadsheet
            //will return a correctly-packed JSON object if data is available. If it isn't, it simply returns undefined.
            //packJSONforInvoiceSpreadsheet will alert the user with an alert() if no data is available.
            if (typeof(packed) != 'undefined') {

                $.Reports.spreadSheetTitle = packed.spreadSheetTitle
                $.Reports.workSheetTitle = packed.worksheetTitle
                $.Reports.rowsCount = packed.rowsCount
                $.Reports.colsCount = packed.colsCount
                $.Reports.header = packed.header
                $.Reports.rows = packed.rows
           
                $.Reports.makeReport();
            } else {
                return;
            }
    });
}

function generateJSONByProgramType(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Date', 'Vendor Name', 'VendorID', 'Invoice Number', 'School Name' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Invoices"];
        
        sql += " WHERE ";
        sql += "'Program Type' = ";
        sql += "'" + inputs["programType"] + "'";
        sql += " AND 'Date' >= " 
        sql += "'" + inputs["start"] + "'";
        sql += " AND 'Date' <= " 
        sql += "'" + inputs["end"] + "'";
        
    url += sql
    
    var xhr = $.get(url, 
    
        function(response) {
            var packed = packJSONforInvoiceSpreadsheet(response, inputs["programType"], inputs["start"], inputs["end"]);

            if (typeof(packed) != 'undefined') {

                $.Reports.spreadSheetTitle = packed.spreadSheetTitle
                $.Reports.workSheetTitle = packed.worksheetTitle
                $.Reports.rowsCount = packed.rowsCount
                $.Reports.colsCount = packed.colsCount
                $.Reports.header = packed.header
                $.Reports.rows = packed.rows
           
                $.Reports.makeReport();
            } else {
                return;
            }
    });
}

function generateJSONBySchoolName(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Date', 'Vendor Name', 'VendorID', 'Invoice Number', 'School Name' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Invoices"];
        
        sql += " WHERE ";
        sql += "'School Name' = ";
        sql += "'" + inputs["school"] + "'";
        sql += " AND 'Date' >= " 
        sql += "'" + inputs["start"] + "'";
        sql += " AND 'Date' <= " 
        sql += "'" + inputs["end"] + "'";
        
    url += sql
    console.log(url);
    
    var xhr = $.get(url, 
    
        function(response) {
            var packed = packJSONforInvoiceSpreadsheet(response, inputs["school"], inputs["start"], inputs["end"]);

            if (typeof(packed) != 'undefined') {

                $.Reports.spreadSheetTitle = packed.spreadSheetTitle
                $.Reports.workSheetTitle = packed.worksheetTitle
                $.Reports.rowsCount = packed.rowsCount
                $.Reports.colsCount = packed.colsCount
                $.Reports.header = packed.header
                $.Reports.rows = packed.rows
           
                $.Reports.makeReport();
            } else {
                return;
            }
        
    });
}

function generateJSONByDonorName(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Donor Name', 'Vendor Name', 'VendorID', 'Invoice Number', 'School Name' ";
        
        sql += "FROM ";
        sql += $.AEDtables["Invoices"];
        
        sql += " WHERE ";
        sql += "'School Name' = ";
        sql += "'" + inputs["school"] + "'";
        sql += " AND 'Date' >= " 
        sql += "'" + inputs["start"] + "'";
        sql += " AND 'Date' <= " 
        sql += "'" + inputs["end"] + "'";
        
    url += sql
    console.log(url);
}

function generateJSONByBoardContact(inputs) {
    
}

function generateJSONByFiscalYear(inputs){
    
}
    
