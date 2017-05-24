// $('#dialog_link').click(function() {
//            $('#dialog_simple').dialog('open');
//            return false;
//
//});

function open_dialog(){
    $("#dialog_simple").dialog({
        autoOpen: false, modal: true, height: 400, width: 1000, show: { effect: "fade", duration: 300 },resizable : false,
        title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Empty the recycle bin?</h4></div>",
        buttons : [{
                html : "<i class='fa fa-trash-o'></i>&nbsp; Delete all items",
                "class" : "btn btn-primary bg-color-green",
                click : function() {
                    $(this).dialog("close");
                }
        }, {
                html : "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class" : "btn btn-primary bg-color-green",
                click : function() {
                    $(this).dialog("close");
                }
        }]
    }).dialog('open');
}

function load_list_Usuarios(){
//    alert(5);
    jQuery("#table_Usuarios").jqGrid({ 
        url: 'list_usuarios',
        datatype: 'json', mtype: 'GET',        
        width: '100%', height: '150',
        colNames:['id',' Nombres','Email'], 
        rowNum: 11, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE USUARIOS REGISTRADOS',  align: "center",
        colModel:[ 
            {name:'id',index:'id', hidden:true}, 
            {name:'name',index:'name', width:165, align:'left'}, 
            {name:'email',index:'email', width:165}           
        ],        
        pager: '#pager_table_Usuarios',
        rowList: [11, 22],
        onSelectRow: function(Id){
            
        }
    });
}


