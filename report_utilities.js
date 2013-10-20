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
    console.log(xhr);
    //console.log(xhr.responseJSON);
    
})

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

function packJSONforSpreadsheet (json, reportType, start, end) {
    var title = "Invoices for " + reportType + ' over ' + start + '-' + end;
    var worksheetTitle = "Invoices for " + reportType;
    var rows = json.rows.length;
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
        sql += "SELECT 'Invoice Number', 'Total Cost of Event' ";
        
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
            var packed = packJSONforSpreadsheet(response, inputs["artForm"], inputs["start"], inputs["end"]);

            $.Reports.spreadSheetTitle = packed.spreadSheetTitle
            $.Reports.workSheetTitle = packed.worksheetTitle
            $.Reports.rowsCount = packed.rowsCount
            $.Reports.colsCount = packed.colsCount
            $.Reports.header = packed.header
            $.Reports.rows = packed.rows
       
            $.Reports.makeReport();
    });
}

function generateJSONByProgramType(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Invoice Number', 'Total Cost of Event' ";
        
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
            var packed = packJSONforSpreadsheet(response, inputs["programType"], inputs["start"], inputs["end"]);

            $.Reports.spreadSheetTitle = packed.spreadSheetTitle
            $.Reports.workSheetTitle = packed.worksheetTitle
            $.Reports.rowsCount = packed.rowsCount
            $.Reports.colsCount = packed.colsCount
            $.Reports.header = packed.header
            $.Reports.rows = packed.rows
       
            $.Reports.makeReport();
    });
}

function generateJSONBySchoolName(inputs) {
    var url = "https://www.googleapis.com/fusiontables/v1/query";
    var token = $.Hash["access_token"];
        url += "?access_token=" + token;
    
    
    var sql = "&sql=";
        sql += "SELECT 'Invoice Number', 'Total Cost of Event' ";
        
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
            var packed = packJSONforSpreadsheet(response, inputs["artForm"], inputs["start"], inputs["end"]);

            $.Reports.spreadSheetTitle = packed.spreadSheetTitle
            $.Reports.workSheetTitle = packed.worksheetTitle
            $.Reports.rowsCount = packed.rowsCount
            $.Reports.colsCount = packed.colsCount
            $.Reports.header = packed.header
            $.Reports.rows = packed.rows
       
            $.Reports.makeReport();
        
    });
}