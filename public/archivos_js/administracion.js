

//$(document).ready(function(){
//   get_lista_Usuarios();
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
function get_lista_Usuarios(){
    jQuery("#table_Usuarios").jqGrid({ 
        url: 'list_usuarios',
        datatype: 'json', mtype: 'GET',        
        height: 'auto', autowidth : true,
        toolbarfilter : true,
        colNames:['id','DNI',' Nombres','Usuario','Nivel','Fecha Nac.'], 
        rowNum: 10, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTADO DE USUARIOS REGISTRADOS',  align: "center",
        colModel:[ 
            {name:'id',index:'id', hidden:true}, 
            {name:'dni',index:'dni', align:'left'}, 
            {name:'ape_nom',index:'ape_nom', align:'left'},
            {name:'usuario',index:'usuario'},
            {name:'nivel',index:'nivel'},
            {name:'fch_nac',index:'fch_nac'}
        ],        
        pager: '#pager_table_Usuarios',
        rowList: [10, 20],
        onSelectRow: function(Id){
            
        }
    });
    $(window).on('resize.jqGrid', function() {
            $("#table_Usuarios").jqGrid('setGridWidth', $("#content").width());
    });
//    
//    alert(5);
}

function load_list_Usuarios(){
//    alert(5);
    
}


