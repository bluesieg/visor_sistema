
function MensajeDialogLoadAjax(Dialogo,Mensaje){
    $('#'+Dialogo).parent().block({
        message: "<p class='ClassMsgBlock'><img src='../img/cargando.gif' style='width: 18px;position: relative;top: -1px;'/>"+Mensaje+"</p>",
        css: { border: '2px solid #006000',background:'white',width: '62%'}
    });
}
function MensajeDialogLoadAjaxFinish(Dialogo){
     $('#'+Dialogo).parent().unblock();
}

function limpiar_ctrl(div) {
    $(':input', '#' + div).each(function () {
        if (this.type === 'text') {
            if ($(this).attr('disabled')) {
                //no hase nada
            } else {
                this.value = "";
            }
        } else if ($(this).is('select')) {
//                if ($(this).is(':hidden')) {            
            this.value = 'select';
//                }
        } else if (this.type === 'radio') {
            this.checked = false;
        } else if (this.type === 'textarea') {
            this.value = '';
        } else if (this.type === 'password') {
            this.value = '';
        }
    });
}
function valores_defaul_form(tip) {    
              
    switch (tip) {
        case 0://0 form contribuyentes 
            $("input[name=radio_tip_per][value='1']").prop('checked', true);
            $("#contrib_ape_mat").val('-');  
            $("#contrib_sexo").val('1');
            $("#contrib_tlfno_fijo").val('0');
            $("#contrib_tlfono_celular").val('0');
            $("#contrib_email").val('@');
            $("#contrib_raz_soc").val('-');
            $("#hiddentxt_av_jr_calle_psje").val('1');//id_via
            $("#contrib_nro_mun").val('0');
            $("#contrib_dpto_depa").val('0');            
            $("#contrib_manz").val('0');
            $("#contrib_lote").val('0');
            $("#contrib_dom_fiscal").val('-');           
            $("#contrib_nro_doc_conv").val('0');
            $("#contrib_conviviente").val('-');
            $("#contrib_id_cond_exonerac").val('1');            
           break
        case 1:///dialog insert update casas             
            $("#reg_casa_cas_des").css({ border: "1px solid #83CBFF"});
            $("#reg_casa_cas_dir").css({ border: "1px solid #83CBFF"});
            $("#reg_casa_cas_fono").css({ border: "1px solid #83CBFF"});         
            break;
        default:
    }
}

function soloDNI(evt){
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if((charCode > 45 && charCode < 58) || (charCode > 36 && charCode < 41) || charCode == 9 || charCode == 8 ){       
        if(charCode == 190 || charCode == 191 || charCode == 84 || charCode == 78 || charCode == 40 || charCode == 37 || charCode == 46 || charCode == 110){
            return false;
        }else{
            return true;
        }        
    }else{
        return false;
    }
}
function soloNumeroTab(evt) {// con guin y slash ( - / )
   
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if((charCode > 44 && charCode < 58) || (charCode > 36 && charCode < 41) || charCode == 9 || charCode == 8 || charCode == 110){
        if(charCode == 78 || charCode == 40 || charCode == 37 || charCode == 110){
            return false;
        }else{
            return true;
        }
        
    }else{
        return false;
    }           
}

function dialog_close(div){
    $('#'+div).dialog( "close" );
}

function get_fecha_actual(input){
    var f = new Date();
    $("#"+input).val(("0" + f.getDate()).slice(-2) + "/" + ("0" + (f.getMonth() + 1)).slice(-2) + "/" + f.getFullYear());
}


function llenar_combo_tipo_documento(tip){// 0 para llenar conbo contribuyentes 
    $.ajax({
        url: 'get_all_tipo_documento',
        type: 'GET',
        success: function(data) {
            for (i = 0; i <= data.length - 1; i++) {//carga el combo para seleccionar el seguro desde la BD
                if (tip == 0) {
                    $('#cb_tip_doc_1').append('<option value=' + data[i].tip_doc + '>' + data[i].tipo_documento + '</option>');
                    $('#cb_tip_doc_2').append('<option value=' + data[i].tip_doc + '>' + data[i].tipo_documento + '</option>');
                }
            }
        },
        error: function(data) {
            alert(' Error al traer Tipo de Documentos');
        }
    });
}
function llenar_combo_cond_exonerac(tip){// 0 form contribuyentes 
    $.ajax({
        url: 'get_all_cond_exonerac',
        type: 'GET',
        success: function(data) {
            for (i = 0; i <= data.length - 1; i++) {//carga el combo para seleccionar el seguro desde la BD
                if (tip == 0) {
                    $('#contrib_id_cond_exonerac').append('<option value=' + data[i].id_cond_exo + '>' + data[i].desc_cond_exon + '</option>');                    
                }
            }            
        },
        error: function(data) {
            alert(' Error al traer condicion exonerac');
            $(this).dialog("close");
        }
    });
}

function autocompletar_av_jr_calle(textbox,nom_via){
    $.ajax({
           type: 'GET',
           url: 'autocompletar_direccion?nom_via='+nom_via.toUpperCase(),
           success: function(data){               
                var $local_sourcedoctotodo=data;          
                 $("#"+textbox).autocomplete({
                      source: $local_sourcedoctotodo,
                      focus: function(event, ui) {
                             $("#"+textbox).val(ui.item.label);                             
                             $("#hidden"+textbox).val(ui.item.value);
                             $("#"+textbox).attr('maxlength', ui.item.label.length);
                             return false;
                      },
                      select: function(event, ui) {
                              $("#"+textbox).val(ui.item.label);
                              $("#hidden"+textbox).val(ui.item.value);
                              return false;
                      }   
                  });             
            }
    });
}
function autocompletar_av_jr_call(textbox){
    $.ajax({
           type: 'GET',
           url: 'autocompletar_direccion',
           success: function(data){               
                var $local_sourcedoctotodo=data;          
                 $("#"+textbox).autocomplete({
                      source: $local_sourcedoctotodo,
                      focus: function(event, ui) {
                             $("#"+textbox).val(ui.item.label);                             
                             $("#hidden"+textbox).val(ui.item.value);
                             $("#"+textbox).attr('maxlength', ui.item.label.length);
                             return false;
                      },
                      select: function(event, ui) {
                              $("#"+textbox).val(ui.item.label);
                              $("#hidden"+textbox).val(ui.item.value);
                              return false;
                      }   
                  });             
            }
    });
}
var global_id_via;
function get_global_cod_via(input,cod_via){
    $.ajax({
        url: 'autocomplete_nom_via?cod_via=' + cod_via,
        type: 'GET',
        success: function (data) {
            if (data.msg == 'si') {
                global_id_via = data.id_via;
                $("#"+input).val(data.via_compl);
                $("#"+input).attr('maxlength', data.via_compl.length);
            } else {
                mensaje_sis('mensajesis', '* El Codigo Ingresado no Existe ... !', ':. Mensaje del Sistema ...!!!');
            }

        },
        error: function (data) {
            alert(' Error Interno !  Comuniquese con el Administrador...');
        }
    });
}

function get_global_anio_uit(input){
    
    var d = new Date();
    $.ajax({
        url: 'get_anio_val_arancel',
        type: 'GET',
        success: function (data) {
            for (i = 0; i <= data.length - 1; i++) {                
                $('#'+input).append('<option value=' + data[i].anio + '>' + data[i].anio + '</option>');
            }
            $('#'+input).val(d.getFullYear());
        },
        error: function (data) {
            alert(' Error al llenar combo Año...');
            MensajeDialogLoadAjaxFinish('content', '.:: CARGANDO ...');
        }
    });
}

/*COMBOS DE DEPARTAMENTOS PROVINCIA Y DISTRITO*/

function llenar_combo_dpto(tip){// 0 form contribuyentes
    $.ajax({
        url: 'get_all_dpto',
        type: 'GET',
        success: function(data) {
            for (i = 0; i <= data.length - 1; i++) {
                if (tip == 0) {// form contribuyentes
                    $('#contrib_dpto').append('<option value=' + data[i].cod + '>' + data[i].dpto + '</option>');                    
                }
            }
            $('#contrib_dpto').val('04');
        },
        error: function(data) {
            alert(' Error al traer departamentos');           
        }
    });
}

global_prov = 0;
function llenar_combo_prov(tip,cod_dpto){// 0 form contribuyentes
    cod_dpto = cod_dpto || "04";
    document.getElementById('contrib_prov').options.length = 1;    
    $.ajax({
        url: 'get_all_prov?cod_pdto='+cod_dpto,
        type: 'GET',
        success: function(data) {
            for (i = 0; i <= data.length - 1; i++) {
                if (tip == 0) {// form contribuyentes
                    $('#contrib_prov').append('<option value=' + data[i].cod_prov + '>' + data[i].provinc + '</option>');                    
                }
            }
            if(global_prov==0){
                global_prov=1;$('#contrib_prov').val('0401');
            }else{
                setTimeout(function () {$('#contrib_prov').val('select');}, 1000);
            }            
        },
        error: function(data) {
            alert(' Error al traer  provincias');           
        }
    });    
}
global_dist=0;
function llenar_combo_dist(tip,cod_prov,tipo){// 0 form contribuyentes
    cod_prov = cod_prov || "0401";
    document.getElementById('contrib_dist').options.length = 1;
    $.ajax({
        url: 'get_all_dist?cod_prov='+cod_prov,
        type: 'GET',
        success: function(data) {
            for (i = 0; i <= data.length - 1; i++) {
                if (tip == 0) {// form contribuyentes
                    $('#contrib_dist').append('<option value=' + data[i].cod_dist + '>' + data[i].distrit + '</option>');                    
                }
            }
            if(global_dist==0){
                global_dist=1;$('#contrib_dist').val('040101');
            }else{
                if(tipo!='EDITAR'){
                    setTimeout(function () {$('#contrib_dist').val('select');}, 1000);
                }                
            }            
        },
        error: function(data) {
            alert(' Error al traer Distritos');           
        }
    });
}

function fn_actualizar_grilla(grilla,url) {
    jQuery("#"+grilla).jqGrid('setGridParam', {
        url: url
    }).trigger('reloadGrid');
    
}
/**********MENSAJES DEL SISTEMA*****************************************/

function mensaje_confirm(tit,texto,id) {
//    return true;
    $("#eliminar").dialog({
        autoOpen: false, modal: true, height: 180, width: 400, show: {effect: "fade", duration: 300},
        title:"<div class='widget-header'><h4>&nbsp&nbsp" + tit + "</h4></div>",
        buttons: [
            { text: "Aceptar", click: function() {  $(this).dialog("close"); } },
            { text: "Cancelar", click: function() { $(this).dialog("close"); return false; } }
        ]
    }).dialog('open');
    $("#eliminar").html('<p class="info"><b>' + texto + '</b></p>');
    
    
}
function mensaje_sis(div, texto, tit) {
    $("#" + div).dialog({
        autoOpen: false, modal: true, height: 180, width: 400, show: {effect: "fade", duration: 300},
        title:"<div class='widget-header'><h4>&nbsp&nbsp" + tit + "</h4></div>",
        buttons: [
            {text: "Aceptar",id:"msg_aceptar", click: function() {
                    $(this).dialog("close");
                }}
        ]
    }).dialog('open');
    $("#" + div).html('<p class="info"><b>' + texto + '</b></p>');
}