
function dlg_tributos(){
    $("#dlg_tributo").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: Sub-Procedimiento / Tributos :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-primary",
                click: function () { new_tributo(); }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){limpiar_form_trib();}       
    }).dialog('open');
}

function new_tributo(){
    desc = $("#trib_des").val();
    monto = parseFloat($("#trib_monto").val());    
    if(desc==""){
        mostraralertasconfoco('Ingrese Descripcion...','#trib_des');
        return false;
    }    
    if(isNaN(monto)){
        mostraralertasconfoco('Ingrese un Monto...','#trib_monto');
        return false;
    }
    id_proced = $('#table_Procedimiento').jqGrid ('getGridParam', 'selrow');
    $.ajax({
        url: 'tributos/create',
        type: 'GET',
        data: {
            id_proced:id_proced,
            desc:desc.toUpperCase(),            
            monto:monto
        },
        success: function (data) {
            if(data){
                MensajeExito('Operación','Guardado Correctamente...');
                fn_actualizar_grilla('table_Tributos','get_tributos?anio='+$("#vw_trib_anio").val()+'&id_proced='+id_proced);
                dialog_close('dlg_tributo');
            }
        },
        error: function (data) {
            MensajeAlerta('Error de Red.', 'Contactese con el Administrador');
        }
    });
}
function up_dlg_tributos(){
    $("#dlg_tributo").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.: Sub-Procedimiento / Tributos :.</h4></div>",
        buttons: [{
                html: "<i class='fa fa-save'></i>&nbsp; Guardar",
                "class": "btn btn-primary",
                click: function () { up_tributo(); }
            }, {
                html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class": "btn btn-danger",
                click: function () {$(this).dialog("close");}
            }],
        open: function(){limpiar_form_trib();}       
    }).dialog('open');    
    
    id_trib = $('#table_Tributos').jqGrid ('getGridParam', 'selrow');    
    $("#trib_des").val($("#table_Tributos").getCell(id_trib, 'descrip_tributo'));
    $("#trib_monto").val($("#table_Tributos").getCell(id_trib, 'soles'));
}
function up_tributo(){
    desc = $("#trib_des").val();
    monto = parseFloat($("#trib_monto").val());    
    if(desc==""){
        mostraralertasconfoco('Ingrese Descripcion...','#trib_des');
        return false;
    }    
    if(isNaN(monto)){
        mostraralertasconfoco('Ingrese un Monto...','#trib_monto');
        return false;
    }
    id_proced = $('#table_Procedimiento').jqGrid ('getGridParam', 'selrow');
    id_trib = $('#table_Tributos').jqGrid ('getGridParam', 'selrow');    
    $.ajax({
        url: 'tributos/'+id_trib+'/edit',
        type: 'GET',
        data: {
            desc:desc.toUpperCase(),            
            monto:monto
        },
        success: function (data) {
            if(data){
                MensajeExito('Operación','Guardado Correctamente...');
                fn_actualizar_grilla('table_Tributos','get_tributos?anio='+$("#vw_trib_anio").val()+'&id_proced='+id_proced);
                dialog_close('dlg_tributo');
            }
        },
        error: function (data) {
            MensajeAlerta('Error de Red.', 'Contactese con el Administrador');
        }
    });
}
function del_tributo(){
    id_proced = $('#table_Procedimiento').jqGrid ('getGridParam', 'selrow');
    id_trib = $('#table_Tributos').jqGrid ('getGridParam', 'selrow');    
    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        url: 'tributos/destroy',
        type: 'post',
        data: {_method: 'delete',id:id_trib},
        success: function(data){
            MensajeExito('Operación','Elemento Eliminado...');
            fn_actualizar_grilla('table_Tributos','get_tributos?anio='+$("#vw_trib_anio").val()+'&id_proced='+id_proced);
        },
        error: function(data) {
            MensajeAlerta('Error de Red.', 'Contactese con el Administrador');
            console.log('error');
            console.log(data);
        }
    });
}

function limpiar_form_trib(){
    $("#trib_des,#trib_monto").val('');    
}