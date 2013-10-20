
var jQuery = jQuery || {}; 


/*
$.Reports
        , spreadSheetTitle: 'AED Test'
        , workSheetTitle: 'Work Sheet'
        , rowCount: '2'
        , colsCount: '2'
        , header: ['head1', 'head2']
        , colno: 1
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
            ssUrl = '_worksheet.php?token={0}&ssid={1}'.format($.Reports.token, $.Reports.ssid)
            // return webContent = $.get(ssUrl )                      
            //console.log('Create Worksheet', $.Reports.workSheetTitle, $.Reports.rowsCount,$.Reports.colsCount  )
            //debugger; 
            return webContent = $.post( ssUrl, { workSheet: $.Reports.workSheetTitle, rows: $.Reports.rowsCount, cols: $.Reports.colsCount } )      
        }
        , addSheetHeader: function(){
            ssUrl = '_worksheetHeader.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
            // return webContent = $.get(ssUrl )    

            //console.log('Create Header', $.Reports.token, $.Reports.ssid, $.Reports.wsid )
            //debugger; 

            var deferred = []
            //set rowcount, colcount
            $.each($.Reports.header, function(i,el){
                $.Reports.colno = i+1
                deferred.push( $.post(ssUrl, { sheetHeader: el.toLowerCase(), colNumber: $.Reports.colno } ) )
            })
            return $.when( deferred );
            
        }        
        , addRows: function(){
            ssUrl = '_worksheetRows.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
            //debugger; 
            var deferred = []
            $.each($.Reports.rows, function(rowIndex, row){
                var xml = ''
                $.each(row, function(colIndex,cell){
                    var head = $.Reports.header[colIndex].toLowerCase()
                    xml += '<gsx:' + head +'>' + cell + '</gsx:'+ head +'>'
                })
                //debugger; 
                //deferred.push( $.post(ssUrl, { 'row': xml } ) )
                $.post(ssUrl, { 'row': xml } ).done(function(data){
                    console.log('add row', data)
                })
            })
            return $.when( deferred );
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
                    
                   $.Reports.addSheetHeader().done(function(headData){
                       console.log('header added', headData) 
            //       //debugger; 

                        $.Reports.addRows()

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
    