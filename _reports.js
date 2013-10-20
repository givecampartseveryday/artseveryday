
var jQuery = jQuery || {}; 



    
( function($) {


//    debugger; 
    $.Reports = {
        ssid: null
        , wsid: null
        , token: null 
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
            return webContent = $.post( ssUrl, { workSheet: $.Reports.workSheetTitle, rows: $.Reports.rowCount, cols: $.Reports.colsCount } )      
        }
        , addSheetHeader: function(){
            ssUrl = '_worksheetHeader.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
            // return webContent = $.get(ssUrl )    
            var deferred = {}
            $.each($.Reports.header, function(i,el){
                $.Reports.colno = i+1
                deferred.push = $.post(ssUrl, { sheetHeader: el, colNumber: $.Reports.colno } ) 
            })
            return $.when( deferred );
            
        }        
        , addRows: function(){
            ssUrl = '_worksheetRows.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
            
            var deferred = {}
            $.each($.Reports.rows, function(rowIndex, row){
                var xml = ''
                $.each(row, function(colIndex,cell){
                    var head = $.Reports.header[colIndex]
                    xml += '<gsx:' + head +'>' + cell + '</gsx:'+ head +'>'
                })
                //debugger; 
                deferred.push = $.post(ssUrl, { 'row': xml } ) 
            })
            return $.when( deferred );
        }
        , List: function(){
            $.Reports.token = $.Hash["access_token"]
            var token = $.Reports.token
            
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

                       $.Reports.addRows().done(function(rowdata){
                           console.log('rows added', rowdata) 
                           //debugger; 
                       })
                   })
                 })
            })


        }
    }
})(jQuery);
    