function grilla_control_calidad(){
        fecha_desde_cc = $("#dlg_fecha_desde_cc").val();
        fecha_hasta_cc = $("#dlg_fecha_hasta_cc").val();
        jQuery("#table_control_calidad").jqGrid({
            url: 'getExpedientes_ControlCalidad?fecha_desde='+0 +'&fecha_hasta='+0,
            datatype: 'json', mtype: 'GET',
            height: '280px', width: 1100,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE','GESTOR DEL TRAMITE','FECHA INICIO','FECHA REGISTRO','ESTADO'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 20},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 20},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 15},
                {name: 'fase', index: 'fase', align: 'left', width: 15}
            ],
            pager: '#pager_table_control_calidad',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_control_calidad').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_control_calidad').jqGrid('getDataIDs')[0];
                            $("#table_control_calidad").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){
                 $('#hidden_id').val($("#table_control_calidad").getCell(Id, "nro_expediente"));
            },
            ondblClickRow: function (Id){actualizar_expediente();}
        });
        
        
        jQuery("#table_inspeccion").jqGrid({
            url: '',
            datatype: 'json', mtype: 'GET',
            height: '280px', width: 1100,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE','GESTOR DEL TRAMITE','FECHA INICIO','FECHA REGISTRO','ESTADO'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'INSPECCION', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 20},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 20},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 15},
                {name: 'fase', index: 'fase', align: 'left', width: 15}
            ],
            pager: '#pager_table_inspeccion',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_control_calidad').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_control_calidad').jqGrid('getDataIDs')[0];
                            $("#table_control_calidad").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){
                 $('#hidden_id').val($("#table_control_calidad").getCell(Id, "nro_expediente"));
            },
            ondblClickRow: function (Id){actualizar_expediente();}
        });
}


function pasar_inspeccion(){
    id_control_calidad = $('#table_control_calidad').jqGrid ('getGridParam', 'selrow');
    inspector = $('#select_inspector').val();
    
    $.ajax({url: 'asignar_expediente',
        type: 'GET',
        data:{id_control_calidad:id_control_calidad,inspector:inspector},
        success: function(data) 
        {
            fn_actualizar_grilla('table_control_calidad');
            MensajeExito('Expediente', 'El Expediente Paso a Inspeccion.');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
        }
        }); 
}


function crear_nueva_notificacion()
{
    //limpiar_datos();
    $("#dlg_registrar_notificacion").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVA NOTIFICACION :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    registrar_notificacion();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_registrar_notificacion").dialog('open');
}

function registrar_notificacion(){
    
    nro_expediente = $('#hidden_id').val();
    notificacion = $('#inp_reg_noti').val();
    MensajeDialogLoadAjax('dlg_registrar_notificacion', '.:: Cargando ...');
        $.ajax({url: 'registrar_notificacion',
            type: 'GET',
            data:{nro_expediente:nro_expediente,notificacion:notificacion},
            success: function(data) 
            {
                MensajeDialogLoadAjaxFinish('dlg_registrar_notificacion');
                fn_actualizar_grilla('table_control_calidad');
                dialog_close('dlg_registrar_notificacion');
                MensajeExito('Expediente', 'Se Registro la Notificacion.');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                MensajeDialogLoadAjaxFinish('dlg_registrar_notificacion');
                console.log('error');
                console.log(data);
            }
        });
    
}

function check_cambiar_estado(val){
    if($(val).is(':checked')){
        jQuery("#table_control_calidad").jqGrid('setGridParam', {url: 'getExpedientes_ControlCalidad?check='+1+'&fecha_desde='+0 +'&fecha_hasta='+0 }).trigger('reloadGrid');
    } else {
        jQuery("#table_control_calidad").jqGrid('setGridParam', {url: 'getExpedientes_ControlCalidad?check='+2+'&fecha_desde='+0 +'&fecha_hasta='+0 }).trigger('reloadGrid');
    }
}


function actualizar_expediente(){
    
    id_control_calidad = $('#table_control_calidad').jqGrid ('getGridParam', 'selrow');
    
    $.ajax({url: 'actualizar_expediente',
            type: 'GET',
            data:{id_control_calidad:id_control_calidad},
            success: function(data) 
            {
                fn_actualizar_grilla('table_control_calidad');
                MensajeExito('Expediente', 'Se Restablecio el Expediente.');
            },
            error: function(data) {
                mostraralertas("hubo un error, Comunicar al Administrador");
                console.log('error');
                console.log(data);
            }
        });
}
