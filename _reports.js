
var jQuery = jQuery || {}; 



    
( function($) {


//    debugger; 
    $.Reports = {
        ssid: null
        , wsid: null
        , token: null 
        , createSpreadSheet: function(){
            var createLocation = "https://www.googleapis.com/drive/v2/files"
            return  webCreate = $.ajax( {
                    url: createLocation
                    , type: "POST"
                    , contentType:"application/json;"
                    , beforeSend: function (request) {
                        request.setRequestHeader("Authorization",  "Bearer " + $.Reports.token);
                    }                    
                    , data:  "{'mimeType': 'application/vnd.google-apps.spreadsheet', 'title': 'AED Test Upload'}" 
                } )              
        }
        , createWorkSheet: function(){
            ssUrl = '_worksheet.php?token={0}&ssid={1}'.format($.Reports.token, $.Reports.ssid)
            return webContent = $.get(ssUrl )                         
        }
        , addSheetHeader: function(){
            ssUrl = '_worksheetHeader.php?token={0}&ssid={1}&wsid={2}'.format($.Reports.token, $.Reports.ssid, $.Reports.wsid)
            return webContent = $.get(ssUrl )                         
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
                    $.Reports.addSheetHeader().done(function(headData){
                        console.log('header added', headData) 
                    //debugger; 
                        $.Reports.addRows().done(function(rowdata){
                            console.log('rows added', rowdata) 
                            debugger; 
                        })
                    })
                 })
            })


            //    debugger; 
            //    $.Reports.ssid = ssdata.id
            //$.Reports.ssid = '0AlAwLfyKxW00dHFLb09jUnlTSGJuZXUwZHlYNE5rQmc'

            
            //        debugger; 
/*
            //Good
            //var ssId = '0AlAwLfyKxW00dEdXMW11bnNqbVFsTnNRZ0huWU9tLVE'  
            var ssId = '0AlAwLfyKxW00dDNiVGJjV1JUWjNqVjNwNlpacnlDLXc'          
            var ws = 'https://spreadsheets.google.com/feeds/worksheets/{0}/private/full/'.format(ssId)
            var webContent = $.ajax( {
                url: ws
                    , type: "GET"
                , beforeSend: function (request) {
                    request.setRequestHeader("Authorization",  "Bearer " + token);
                }  
            })     
            .done(function(data){ 
                debugger; 
                console.log(data) 
                })   
            .error(function(e){
                debugger; 
            })                 
        //END good     
*/
            //https://spreadsheets.google.com/feeds/cells/key/worksheetId/private/basic
            //GOOD

 //           var ssId = '0AlAwLfyKxW00dDNiVGJjV1JUWjNqVjNwNlpacnlDLXc'          

          
 /*           var createLocation = "https://www.googleapis.com/drive/v2/files"
            //createLocation+='?access_token=' + token                
            var webCreate = $.ajax( {
                    url: createLocation
                    , type: "POST"
                    , contentType:"application/json;"
                    , beforeSend: function (request) {
                        request.setRequestHeader("Authorization",  "Bearer " + token);
                        //request.setRequestHeader("mimeType ",  "application/vnd.google-apps.spreadsheet");
                    }                    
                    , data:  "{'mimeType': 'application/vnd.google-apps.spreadsheet', 'title': 'AED Test Upload'}" 
                } )     
                .done(function(data){ 
                    debugger; 
                    console.log('File Created', data) 
                    ssId = data.id




                    })
                .error(function(e){
                    debugger; 
                })          

 */ 

                //END GOOD
            //var ssId = '0B1AwLfyKxW00VUtDYzdUWk9wVkE'
//NOT GOOD BLOWS on CORS POST.
/*
            var ssId = '0AlAwLfyKxW00dDNiVGJjV1JUWjNqVjNwNlpacnlDLXc'          
            var ws = 'https://spreadsheets.google.com/feeds/worksheets/{0}/private/full/'.format(ssId)
            var xml =  '<entry xmlns="http://www.w3.org/2005/Atom" '
                xml +='xmlns:gs="http://schemas.google.com/spreadsheets/2006">'
                xml +='<title>Expenses</title> '
                xml +='<gs:rowCount>50</gs:rowCount>'
                xml +='<gs:colCount>10</gs:colCount>'
                xml +='</entry>'
                
            var webContent = $.ajax( {
                url: ws
                , type: "POST"
               //, contentType:"application/atom+xml"
                , beforeSend: function (request) {
                    request.setRequestHeader("Authorization",  "Bearer " + token);
                    request.setRequestHeader("Content-Type", "application/atom+xml");
                }  
                , data: xml
            })     
            .done(function(data){ 
                debugger; 
                console.log(data) 
            })   
            .error(function(e){
                    debugger; 
            })    
            */
//End not good

//working
/*
            var ssId = '0AlAwLfyKxW00dDNiVGJjV1JUWjNqVjNwNlpacnlDLXc'
            //debugger; 
            ssUrl = 'https://spreadsheets.google.com/feeds/worksheets/{0}/private/full/'.format(ssId)
            //ssUrl+='?access_token=' + token
            
            var xml =  '<entry xmlns="http://www.w3.org/2005/Atom" '
                xml +='xmlns:gs="http://schemas.google.com/spreadsheets/2006">'
                xml +='<title>Expenses</title> '
                xml +='<gs:rowCount>50</gs:rowCount>'
                xml +='<gs:colCount>10</gs:colCount>'
                xml +='</entry>'
            
           var webContent = $.ajax({
                    url: ssUrl
                    , type: "POST"
                    , contentType:"application/atom+xml"
                    , beforeSend: function (request) {
                        request.setRequestHeader("Authorization",  "Bearer " + token);
                    }                    
                    , data: xml
                    } )     
                .done(function(data){ 
                    debugger; 
                    console.log(data) 
                    })  
                .error(function(e){
                    debugger; 
                })                    
*/
                  
/*
//dubious....
            var ssId = '0AlAwLfyKxW00dDNiVGJjV1JUWjNqVjNwNlpacnlDLXc'

            ssUrl = '_worksheets.php?token={0}&sheetkey={1}'.format(token, ssId)
            //var ssUrl = '_test.php?token={0}&sheetkey={1}'.format(token, ssId)

           var webContent = $.get( 
                ssUrl
                )     
                .done(function(data){ 
                    debugger; 
                    console.log(data) 
                    })      
                .error(function(e){
                    debugger; 
                }) 
*/
/*
//Good
            var gdrive = "https://www.googleapis.com/drive/v2/files"
            //gdrive+='list/'
            gdrive+='?access_token=' + token
            //debugger; 
            var xhr = $.get( gdrive )
                .done( function( data ) {
                    var files = data.items
                    
                    var AEDFiles = $.grep(files, function(el, i){
                        return (el.title.indexOf('AED SS Test') ==0 )
                    })
                    debugger; 
                    
                    console.log('Files: ', files[0])
                    var file = files[0]
                    console.log('File', file.title, file.embedLink, file.alternateLink, file.selfLink, file.thumbnailLink, file.parents )
                    
                } )
                .error(function(e){
                    debugger; 
                })  
                
            var myspreadsheet = ''
*/




        }
    }
})(jQuery);
    