

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
    
//    
//    alert(5);
}

function load_list_Usuarios(){

    
       
    
}