
var jQuery = jQuery || {}; 



    
( function($) {


//    debugger; 
    $.Reports = {
        ssid: null
        , wsid: null
        , token: null 
        , sheetTitle: 'AED Test'
        , rowCount: '2'
        , colsCount: '1'
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
                    , data: "{'mimeType': 'application/vnd.google-apps.spreadsheet', 'title': '" + $.Reports.sheetTitle + "'}" 
                } )              
        }
        , createWorkSheet: function(){
            ssUrl = '_worksheet.php?token={0}&ssid={1}'.format($.Reports.token, $.Reports.ssid)
            // return webContent = $.get(ssUrl )                         
            return webContent = $.post( ssUrl, { rows: $.Reports.rowCount, cols: $.Reports.colsCount } )      
        }
        , addSheetHeader: function(){
            ssUrl = '_worksheetHeader.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
             return webContent = $.get(ssUrl )    
            //$.post( "test.php", { name: "John", time: "2pm" } );
            //return webContent = $.post( ssUrl, { data: $.Reports.Header } )      
        }        
        , addRows: function(){
            ssUrl = '_worksheetRows.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
            return webContent = $.get(ssUrl )                         
        }
        , List: function(){
            $.Reports.token = $.Hash["access_token"]
            var token = $.Reports.token
            
            $.Reports.createSpreadSheet().done(function(ssdata){
                $.Reports.ssid = ssdata.id
                console.log('Spreadsheet added', ssdata) 
                $.Reports.createWorkSheet().done(function(wsdata){
                    var idstart = wsdata.indexOf("<id")
                    var idend  =  wsdata.indexOf( "</id>", idstart)
                    var idUri = wsdata.substring(idstart, idend).replace('<id>', '')
                    var istart = idUri.indexOf('/full/')
                    var iend = idUri.indexOf('/private/')

                    $.Reports.wsid =  idUri.substring(istart, idUri.length).replace("/full/", '')
                    
                    console.log('Worksheet added', wsdata) 
                    
            //       $.Reports.addSheetHeader().done(function(headData){
            //           console.log('header added', headData) 
            //       //debugger; 

            //           $.Reports.addRows().done(function(rowdata){
            //               console.log('rows added', rowdata) 
            //               debugger; 
            //           })
            //       })
                 })
            })


        }
    }
})(jQuery);
    