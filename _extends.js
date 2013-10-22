
var jQuery = jQuery || {}; 

(function($) {
//debugger; 
	    if (! String.prototype.format ) 
	        String.prototype.format = function(){
	            var txt = this;
	            for ( var i = 0; i < arguments.length; i++ ) {
	                var exp = new RegExp( '\\{' + (i) + '\\}', 'gm' )
	                txt = txt.replace(exp, arguments[i])
	            }
	            return txt   
	        };

	    if (! String.format ) 
	        String.format = function(){
	        for( var i = 1; i < arguments.length; i++ ) {
	            var exp = new RegExp( '\\{' + (i - 1) + '\\}', 'gm' )
	            arguments[0] = arguments[0].replace( exp, arguments[i] )
	        }
	        return arguments[0]
	        };
	        //"a a b".noSpace()
	    if (! String.prototype.noSpace ) 
	        String.prototype.noSpace = function(){
	            var txt = this
	            return txt.toString().replace(/\s+/g, '_')
	        };

    $.Form = { 
        $currentNode: null 
        , KO: { 
            Model: {
                Item: { dirty: null }
                , prototypical: { dirty: null }
                , items: []
            }
            , Data: null 
            , AfterAddItem: function(){}
            , addItem: function(fn){
                var Item = $.extend( {}, $.Form.KO.Model.prototypical ) 
                Item.dirty = 'new'
                $.Form.KO.Model.items.push(Item);
                //$.Form.Navigate.last(null);
                $.Form.KO.AfterAddItem()
            }
            , removeItem: function(item){
                console.log(item);
                item.dirty = 'delete';
            }
            
            , save: function() {
                $.each($.Form.KO.Model.items(), function(i, el){

                    if( el.dirty.toString().toLowerCase() === 'updated' ){
                        console.log('item update', el)
                        $.FusionUpdateRow( $.Table.Key, el, $.Table.Map() )
                    }
                    
                    if( el.dirty.toString().toLowerCase() === 'new' ){
                        console.log('item insert', el)
                        $.FusionInsertRow( $.Table.Key, el, $.Table.Map() )
                    } 
                    
                    if( el.dirty.toString().toLowerCase() === 'delete' ){
                        console.log('item delete', el)
                        $.FusionDeleteRow( $.Table.Key, el )
                    }
                })
                $('.dirty').val( false )
            }
        }
        , Navigate: {
            goto: function(i){
                $.Form.$currentNode = $('.Editor fieldset').eq(i)
                $('.Editor fieldset').hide()
                $.Form.$currentNode.show()
            }
            , forwards: function(){
                //debugger; 
                if( $.Form.$currentNode.next().length === 0)
                    return false
                $.Form.$currentNode = $.Form.$currentNode.next()
                $('.Editor fieldset').hide()
                $.Form.$currentNode.show()
            }
            , backwards: function(){
                if( $.Form.$currentNode.prev().length === 0)
                    return false
                $.Form.$currentNode = $.Form.$currentNode.prev()
                $('.Editor fieldset').hide()
                $.Form.$currentNode.show()
            }
            , first: function(){
                $.Form.$currentNode = $('.Editor fieldset').first()
                $('.Editor fieldset').hide()
                $.Form.$currentNode.show()
            }
            , last: function(){
                $.Form.$currentNode = $('.Editor fieldset').last()
                $('.Editor fieldset').hide()
                $.Form.$currentNode.show()
            }            
        }
        , doDirty: function(e){
            //debugger; 
            var self = e.target
            var $parent = $(self).parents('tr')
            if( $('.dirty', $parent).val() !== 'new' )
                $('.dirty', $parent).val( 'updated' ).change()            
        }
        , Setup: function(){
            window.onbeforeunload = function(e) {
                var isDirty = false
                $.each( 
                    $.Form.KO.Model.items()
                    , function(e,el){
                        //debugger; 
                        if( el.dirty !== false ){
                            isDirty = true
                        }
                    }
                )
                //isDirty = true
                if(! isDirty ){
                   return void(0); 
                }
                var retAlert = 'You have unsaved changes on this page, '
                retAlert += 'are you sure you want to continue and lose your changes.'
                return retAlert;
            };
            
            $('.openInDrive').click(function(e){
                var url = 'https://www.google.com/fusiontables/DataSource?docid='
                url += $.Table.Key
                window.open(url, 'fusion', '_blank')
                e.preventDefault() 
            })
            
            $('.Binder input:not(.dirty)').change(function(e){
                $.Form.doDirty(e)
            })
        }
        , SetupSingle: function(){

            $('.ui-icon-play').click(function(e){
                $.Form.Navigate.forwards(e)
                e.preventDefault()       
            })
            $('.ui-icon-triangle-1-w').click(function(e){
                $.Form.Navigate.backwards(e)
                e.preventDefault()       
            })
            $('.ui-icon-seek-first').click(function(e){
                $.Form.Navigate.first(e)
                e.preventDefault()       
            })
            $('.ui-icon-seek-end').click(function(e){
                $.Form.Navigate.last(e)
                e.preventDefault()       
            })
            $.Form.$currentNode = $('.Editor fieldset').first()
            $.Form.$currentNode.show()
            
            //replace dirty function with single, cause it has a differnt parent
            $.Form.doDirty = function(e){
                //debugger; 
                var self = e.target
                var $parent = $(self).parents('fieldset')
                if( $('.dirty', $parent).val() !== 'new' )
                    $('.dirty', $parent).val( 'updated' ).change()            
            }

            $.Form.Setup()
        }  
        , KOSetup: function(data, fn){

            var Model = function( items ) {
                var self = this; 
                //debugger;
                $.extend($.Form.KO.Model, self)
                //debugger
                $.Form.KO.Model.items = ko.observableArray(
                    ko.utils.arrayMap(
                        items
                        , function( item ) {
                            $.Form.KO.Model.Item = $.extend( {}, $.Form.KO.Model.prototypical )
                            $.Form.KO.Model.Item.dirty = false
                            for( var propName in item ){
                                $.Form.KO.Model.prototypical[ $.Table.Map( propName ) ] = null
                                $.Form.KO.Model.Item[ $.Table.Map( propName ) ] = item[ propName ] 
                            }
                            return $.Form.KO.Model.Item
                        }
                    )
                )
                
                $.Form.KO.Data = data
                self.addItem = $.Form.KO.addItem
                self.removeItem = $.Form.KO.removeItem
                self.save =  $.Form.KO.save

                $.Form.KO.Model.lastSavedJson = ko.observable('')
                //$.Form.KO.Model = this; 
            };
             
            ko.applyBindings(
                new Model( data ) 
            );  
            fn()
        }
       //, KOSearch: function(data, fn){

//    var Model = function( items ) {
//        var self = this; 
//        //debugger;
//        $.extend($.Form.KO.Model, self)
//        //debugger
//        $.Form.KO.Model.items = ko.observableArray(
//            ko.utils.arrayMap(
//                items
//                , function( item ) {
//                    $.Form.KO.Model.Item = $.extend( {}, $.Form.KO.Model.prototypical )
//                    $.Form.KO.Model.Item.dirty = false
//                    for( var propName in item ){
//                        $.Form.KO.Model.prototypical[ $.Table.Map( propName ) ] = null
//                        $.Form.KO.Model.Item[ $.Table.Map( propName ) ] = item[ propName ] 
//                    }
//                    return $.Form.KO.Model.Item
//                }
//            )
//        )
                
//        $.Form.KO.Data = data
//        self.addItem = $.Form.KO.addItem
//        self.removeItem = $.Form.KO.removeItem
//        self.save =  $.Form.KO.save

//        $.Form.KO.Model.lastSavedJson = ko.observable('')
//        //$.Form.KO.Model = this; 
//    };
             
//    ko.applyBindings(
//        new Model( data ) 
//    );  
//    fn()
//}
    }
    
    $.Table = {
    }
    $.Hash = (function(a) {
            if (a == "") return {};
            var b = {};
            for (var i = 0; i < a.length; ++i)
            {
                var p=a[i].split('=');
                if (p.length != 2) continue;
                b[p[0]] = decodeURIComponent(p[1].replace(/\+/g, " "));
            }
            return b;
        })(window.location.hash.substr(1).split('&')) //IEFE

    $.FusionUpdateRow = function(table, row, map, message){
        var retval = 'empty'
        var token = $.Hash["access_token"]
        var tableLocation = 'https://www.googleapis.com/fusiontables/v1/query'
            tableLocation += '?access_token=' + token

        var sql = "UPDATE " + table 
            sql += " SET " 
            for(var item in row){
                if(  map[item] != undefined )
                    sql += "'" + map[item] + "' = '" + row[item] + "',"
            }
            sql = sql.substring(0, sql.length -1 )
            sql += " WHERE ROWID = '" + row.rowid + "'" 
        var url = tableLocation + '&sql=' + sql
        var xhr = $.post( url ).done(function(response){
            retval = "DATA SAVED \n \n" +  JSON.stringify (response )
        }).fail(function(response){
            retval = "FAILED \n \n" +  JSON.stringify (response )
        })  
        message += retval 
        return retval 
            
    };
    
    $.FusionInsertRow = function(table, row, map, message){
        var retval = 'empty'
            , rowid = null
        var token = $.Hash["access_token"]
        var tableLocation = 'https://www.googleapis.com/fusiontables/v1/query'
            tableLocation += '?access_token=' + token
        
        var sql = "INSERT INTO " + table 
            sql += "(" 
            for(var item in row){
                if(  map[item] != undefined )
                    sql += "'" + map[item] + "',"
            }
            sql = sql.substring(0, sql.length -1 )
            sql += ")" 

            sql += "VALUES (" 
            for(var item in row){
                if(  map[item] != undefined )
                    sql += "'" + row[item] + "',"
            }            
            sql = sql.substring(0, sql.length -1 )
            sql += ")"

        var url = tableLocation + '&sql=' + sql
        var xhr = $.post( url ).done(function(response){
            rowid = ''
            debugger; 
            retval = "DATA Inserted \n \n" +  JSON.stringify (response )
        }).fail(function(response){
            retval = "FAILED \n \n" +  JSON.stringify (response )
        })  
        message += retval 
        return rowid 
    };
    
    $.FusionDeleteRow = function(table, row) {
        debugger;
        var retval = 'empty'
        var rowid = row["rowid"]
        var token = $.Hash["access_token"]
        var tableLocation = 'https://www.googleapis.com/fusiontables/v1/query'
            tableLocation += '?access_token=' + token
            
        var sql = "DELETE FROM " + table;
            sql += " WHERE ROWID = ";
            sql += ("'" + rowid + "'");
        debugger;
        
        var url = tableLocation + "&sql=" + sql   

        var xhr = $.post(url).done(function(response) {
            rowid = ''
            debugger;
            retval = "DATA deleted \n \n" + JSON.stringify(response);
        }).fail(function(response) {
            retval = "FAILED \n \n" + JSON.stringify(response);
        })
        
        return rowid;
    }
    
    $.FusionGetTable = (function( table, callback ) { 
        var token = $.Hash["access_token"]

        console.log('authorized', token)
        var sql = 'SELECT * FROM '
            sql += table 
            sql += ' LIMIT 1' 
        var tableLocation = 'https://www.googleapis.com/fusiontables/v1/query'
            tableLocation += '?access_token=' + token
           //tableLocation += '&sql=' + sql

        var metaXhr = $.get( tableLocation + '&sql=' + sql )
            .done( function( FusionTableMetaData ) {
                console.log('FusionGetTable Succeeded', FusionTableMetaData)
                var sql = "SELECT ROWID, '" + FusionTableMetaData.columns.join("', '") + "' FROM "
            sql += table 
                var xhr = $.get(  tableLocation + '&sql=' + sql )
                    .done( function( FusionTableData ) {
                        console.log('FusionGetTable Succeeded', FusionTableData)
                        //debugger; 
                        //Map Fusion Table Data to a more standard JSON format.
                        var KOObjects = $.map( FusionTableData.rows, function(row){ 
                             var object = {}
                              $.each(row, function(i, el){ 
                                var column = FusionTableData.columns[i]
                                object[column] = el 
                            })
                            return object;
                        })
                        callback( KOObjects )
                    })
                    .fail( function(e) { console.log("error", e) })                
                        
            })
            .fail( function(e) { console.log("error", e) })     
    })
    
    

})(jQuery);
