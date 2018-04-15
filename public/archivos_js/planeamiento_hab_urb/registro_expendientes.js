 function limpiar_datos(){
    $('#inp_cod_exp').val("");
}

 function autocompletar_haburb(textbox){
    $.ajax({
        type: 'GET',
        url: 'autocomplete_hab_urba',
        success: function (data) {
            
            var $datos = data;
            $("#"+ textbox).autocomplete({
                source: $datos,
                focus: function (event, ui) {
                    $("#" + textbox).val(ui.item.label);
                    return false;
                },
                select: function (event, ui) {
                    $("#" + textbox).val(ui.item.label);
                    $("#hidden_"+ textbox).val(ui.item.value);
                    return false;
                }
            });
        }
    });
}
function crear_nuevo_exp()
{
    limpiar_datos();
    $("#dlg_nuevo_exp").dialog({
        autoOpen: false, modal: true, width: 500, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  NUEVO EXPEDIENTE :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    obtener_exp();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_exp").dialog('open');
}

function obtener_exp()
{
    codigo_exp = $("#inp_cod_exp").val();

    if (codigo_exp == '') {
        mostraralertasconfoco('* El campo Codigo de Expediente es obligatorio...', '#inp_cod_exp');
        return false;
    }
    MensajeDialogLoadAjax('dlg_nuevo_exp', '.:: Cargando ...');
        $.ajax({url: 'registro_expedientes/create',
        type: 'GET',
        data:{cod:$("#inp_cod_exp").val()},
        success: function(data) 
        {
                if (data.msg === 'no'){
                    mostraralertasconfoco("Mensaje del Sistema, NO EXISTE EL NUMERO DE EXPEDIENTE");
                    limpiar_datos();
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                }else if(data.msg === 'repetido'){
                    mostraralertasconfoco("Mensaje del Sistema, EL NUMERO DE EXPEDIENTE YA FUE REGISTRADO");
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                }else{
                    MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                    fn_actualizar_grilla('table_expedientes');
                    dialog_close('dlg_nuevo_exp');
                    MensajeExito('Nuevo Expediente Creado', 'El Expediente se ha creado correctamente.');
                }
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
        }
        }); 
}

function actualizar_exp()
{
    //limpiar_dl_ipm(1);
    $("#dlg_nuevo_exp_edit").dialog({
        autoOpen: false, modal: true, width: 600, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  EDITAR EXPEDIENTE :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                modificar_exp();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    $("#dlg_nuevo_exp_edit").dialog('open');


    MensajeDialogLoadAjax('dlg_nuevo_exp_edit', '.:: Cargando ...');

    id = $('#table_expedientes').jqGrid ('getGridParam', 'selrow');
    $.ajax({url: 'traer_datos/'+id,
        type: 'GET',
        success: function(r)
        {
            $("#nro_expediente").val(r[0].nro_expediente);
            $("#gestor_tramite").val(r[0].gestor);
            $("#fecha_inicio").val(r[0].fecha_inicio_tramite);
            $("#fecha_registro").val(r[0].fecha_registro);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit');

        },
        error: function(data) {
            mostraralertas("Hubo un Error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit');
        }
    });
    
}

function modificar_exp(){
    
    nro_expediente = $("#nro_expediente").val();
    gestor = $("#gestor_tramite").val();
    f_inicio = $("#fecha_inicio").val();
    f_registro = $("#fecha_registro").val();

    if (nro_expediente == '') {
        mostraralertasconfoco('* El campo Numero de Expediente es obligatorio...', '#nro_expediente');
        return false;
    }
    if (gestor == '') {
        mostraralertasconfoco('* El campo Gestor del Tramite es obligatorio...', '#gestor_tramite');
        return false;
    }
    if (f_inicio == '') {
        mostraralertasconfoco('* El campo Fecha Inicio es obligatorio...', '#fecha_inicio');
        return false;
    }
    if (f_registro == '') {
        mostraralertasconfoco('* El campo Fecha Registro es obligatorio...', '#fecha_registro');
        return false;
    }
    
    id = $('#table_expedientes').jqGrid ('getGridParam', 'selrow');
    MensajeDialogLoadAjax('dlg_nuevo_exp_edit', '.:: CARGANDO ...');
    
    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'registro_expedientes/'+id+'/edit',
                    type: 'GET',
                    data: {
                        id_reg_exp:id,
                        nro_expediente: nro_expediente,
                        gestor: gestor,
                        fecha_inicio_tramite: f_inicio,
                        fecha_registro: f_registro
                    },
                    success: function (data) {
                        if (data.msg === 'repetido'){
                            mostraralertasconfoco("Mensaje del Sistema, EL NUMERO DE EXPEDIENTE YA FUE REGISTRADO");
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp');
                        }else{
                             MensajeExito('Editar Registro Expediente', 'EXPEDIENTE: '+ id + '  -  Ha sido Modificado.');
                            fn_actualizar_grilla('table_expedientes');
                            dialog_close('dlg_nuevo_exp_edit');
                            MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit', '.:: CARGANDO ...');
                        }
                    },
                    error: function (data) {
                        mostraralertas('* Contactese con el Administrador...');
                        MensajeAlerta('Editar Registro Expediente','Ocurrio un Error en la Operacion.');
                        dialog_close('dlg_nuevo_exp_edit');
                        MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit', '.:: CARGANDO ...');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Editar Registro Expediente','Operacion Cancelada.');
                MensajeDialogLoadAjaxFinish('dlg_nuevo_exp_edit', '.:: CARGANDO ...');

            }
        }
    });
}

function eliminar_exp(){
    id = $('#table_expedientes').jqGrid ('getGridParam', 'selrow');

    $.confirm({
        title: '.:Cuidado... !',
        content: 'Los Cambios no se podran revertir...',
        buttons: {
            Confirmar: function () {
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url: 'registro_expedientes/destroy',
                    type: 'POST',
                    data: {_method: 'delete', id_reg_exp: id},
                    success: function (data) {
                        fn_actualizar_grilla('table_expedientes');
                        MensajeExito('Eliminar Registro Expediente', id + ' - Ha sido Eliminado');
                    },
                    error: function (data) {
                        MensajeAlerta('Eliminar Registro Expediente', id + ' - No se pudo Eliminar.');
                    }
                });
            },
            Cancelar: function () {
                MensajeAlerta('Eliminar Registro Expediente','Operacion Cancelada.');
            }

        }
    });
    
}

function selecciona_fecha(){

    fecha_desde = $("#dlg_fec_desde").val(); 
    fecha_hasta = $("#dlg_fec_hasta").val(); 

    jQuery("#table_expedientes").jqGrid('setGridParam', {
         url: 'getExpedientes?fecha_desde='+fecha_desde +'&fecha_hasta='+fecha_hasta
    }).trigger('reloadGrid');

}

aux=0;
function crear_reg_datos_lote()
{
    $("#dlg_nuevo_reg_datos_lote").dialog({
        autoOpen: false, modal: true, width: 800, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  Registrar Datos del Lote :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {

                guardar_editar_datos_lote();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
    if(aux==0)
    {
        autocompletar_haburb('inp_zona_exp_lote');
        aux=1;
    }
    $("#dlg_nuevo_reg_datos_lote").dialog('open');
}
function traer_cod_expediente()
{
    MensajeDialogLoadAjax('dlg_nuevo_reg_datos_lote', '.:: Cargando ...');
        $.ajax({url: 'registro_expedientes/0',
        type: 'GET',
        data:{cod:$("#inp_cod_exp_lote").val()},
        success: function(r) 
        {
            if(r==0)
            {
                 mostraralertas("El Código de Expedienteno existe");
                 $('#hidden_inp_cod_exp_lote').val(0);
                 $('#inp_posesionario_exp_lote').val("");
            }
            else
            {
                $('#hidden_inp_cod_exp_lote').val(r.id_reg_exp);
                $('#inp_posesionario_exp_lote').val(r.gestor);
            }
            MensajeDialogLoadAjaxFinish('dlg_nuevo_reg_datos_lote');
            //jQuery("#table_instal").jqGrid('setGridParam', {url: 'gridinsta/'+Id}).trigger('reloadGrid');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
}
function guardar_editar_datos_lote()
{
    if($("#hidden_inp_cod_exp_lote").val()==0||$("#inp_cod_exp_lote").val()=="")
    {
        mostraralertasconfoco("Seleccione Codigo de Expediente","#inp_cod_exp_lote");
        return false;
    }
    if($("#hidden_inp_zona_exp_lote").val()==0||$("#inp_zona_exp_lote").val()=="")
    {
        mostraralertasconfoco("Seleccione Zona","#inp_zona_exp_lote");
        return false;
    }
    MensajeDialogLoadAjax('dlg_nuevo_reg_datos_lote', '.:: Cargando ...');
        $.ajax({url: 'datos_predio/create',
        type: 'GET',
        data:{  cod:$("#hidden_inp_cod_exp_lote").val(),
                sector:$("#inp_sector_exp_lote").val(),
                zona:$("#hidden_inp_zona_exp_lote").val(),
                sup_mzna:$("#inp_super_mzna_exp_lote").val(),
                mzna:$("#inp_mzna_exp_lote").val(),
                lote:$("#inp_lote_exp_lote").val(),
                sub_lote:$("#inp_sub_lote_exp_lote").val(),
                anio:$("#inp_anio_ini_exp_lote").val(),
                area:$("#inp_area_exp_lote").val(),
                frente:$("#inp_frente_exp_lote").val(),
                frente_con:$("#inp_con_frente_exp_lote").val(),
                derecho:$("#inp_derecho_exp_lote").val(),
                derecho_con:$("#inp_con_derecho_exp_lote").val(),
                izquierda:$("#inp_izquierdo_exp_lote").val(),
                izquierda_con:$("#inp_con_izquierdo_exp_lote").val(),
                fondo:$("#inp_fondo_exp_lote").val(),
                fondo_con:$("#inp_con_fondo_exp_lote").val(),
                tip_sol:$("#select_tip_sol_exp_lote").val()
        },
        success: function(r) 
        {
            MensajeExito("Insertó Correctamente","Su Registro Fue Insertado con Éxito...",4000);
            MensajeDialogLoadAjaxFinish('dlg_nuevo_reg_datos_lote');
            $("#dlg_nuevo_reg_datos_lote").dialog('close');
            jQuery("#table_datos_predio").jqGrid('setGridParam', {url: 'datos_predio?grid=1'}).trigger('reloadGrid');
        },
        error: function(data) {
            mostraralertas("hubo un error, Comunicar al Administrador");
            console.log('error');
            console.log(data);
            MensajeDialogLoadAjaxFinish('dlg_reg_dj');
        }
        }); 
}
ins=0;
function crear_ins_campo()
{
    limpiar_datos();
    $("#dlg_nuevo_acta_ins").dialog({
        autoOpen: false, modal: true, width: 1000, show: {effect: "fade", duration: 300}, resizable: false,
        title: "<div class='widget-header'><h4>.:  ACTA DE INSPECCIÓN EFECTIVA :.</h4></div>",
        buttons: [{
            html: "<i class='fa fa-save'></i>&nbsp; Guardar",
            "class": "btn btn-success bg-color-green",
            click: function () {
                    guardar_acta_ins_campo();
            }
        }, {
            html: "<i class='fa fa-sign-out'></i>&nbsp; Salir",
            "class": "btn btn-danger",
            click: function () {
                $(this).dialog("close");
            }
        }],
    });
   
    if(ins==0)
    {
        autocompletar_haburb('inp_hab_urb_ins');
        ins=1;
    }
     $("#dlg_nuevo_acta_ins").dialog('open');
}

function imprimir_constancia()
{    window.open('reporte_constancia'+'');
}