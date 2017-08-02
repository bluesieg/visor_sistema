@extends('layouts.app')
@section('content')
<style>    
    .smart-form fieldset {    
        padding: 5px 8px 0px;   
    }
    .smart-form section {
        margin-bottom: 5px;    
    }
    .smart-form .label {  
        margin-bottom: 0px;   
    }    
</style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Mantenimiento de Contribuyentes...</b></h1>
                <ul id="sparks">                                        
                    <button onclick="open_dialog_new_edit_Contribuyente('NUEVO');" id="btn_vw_contribuyentes_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                    </button>
                    <button id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                    </button>
                    <button id="btn_vw_contribuyentes_Eliminar" type="button" class="btn btn-labeled btn-danger">
                        <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                    </button> 
                    <button onclick="report_pdf();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                    </button>
                </ul>
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="table_Contribuyentes"></table>
            <div id="pager_table_Contribuyentes"></div>
        </article>
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_admtri").show();
        $("#li_config_contribuyentes").addClass('cr-active');
        jQuery("#table_Contribuyentes").jqGrid({
            url: 'grid_contribuyentes',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers', 'Codigo', ' Tip. Doc', 'N°. Documento', 'Contribuyente o Razon Social', 'Cod. Via', 'Calle / Via', 'Fono. Fijo', 'Celular'],
            rowNum: 20, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE CONTRIBUYENTES REGISTRADOS', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_persona', index: 'id_persona', align: 'left', width: 80},
                {name: 'tipo_doc', index: 'tipo_doc', align: 'center', width: 60},
                {name: 'nro_doc', index: 'nro_doc', align: 'center', width: 90},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'cod_via', index: 'cod_via', align: 'center', width: 60},
                {name: 'nom_via', index: 'nom_via', width: 130},
                {name: 'tlfno_fijo', index: 'tlfno_fijo', width: 80},
                {name: 'tlfono_celular', index: 'tlfono_celular', width: 80}
            ],
            pager: '#pager_table_Contribuyentes',
            rowList: [20, 30, 50],
            onSelectRow: function (Id) {
                $('#btn_vw_contribuyentes_Editar').attr('onClick', 'open_dialog_new_edit_Contribuyente("' + 'EDITAR' + '",' + Id + ')');
                $('#btn_vw_contribuyentes_Eliminar').attr('onClick', 'eliminar_contribuyente(' + Id + ')');
            },
            ondblClickRow: function (Id) {
                $("#btn_vw_contribuyentes_Editar").click();
            },
            gridComplete: function () {
                var rows = $("#table_Contribuyentes").getDataIDs();
                for (var i = 0; i < rows.length; i++) {
                    var tipo_doc = $("#table_Contribuyentes").getCell(rows[i], "tipo_doc");
                    if (tipo_doc == '02') {                        
                        $("#table_Contribuyentes").jqGrid('setCell', rows[i],'tipo_doc', 'DNI');
                    }
                }
                if (rows.length > 0) {
                    var firstid = jQuery('#table_Contribuyentes').jqGrid('getDataIDs')[0];
                    $("#table_Contribuyentes").setSelection(firstid);    
                }
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Contribuyentes").jqGrid('setGridWidth', $("#content").width());
        });
        $("#txt_nro_doc").keypress(function (e) {
            if (e.which == 13) {                
                fn_consultar_dni();
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/adm_tributaria.js') }}"></script>


<div id="dialog_new_edit_Contribuyentes" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos del Contribuyente ::.</div>
                    <div class="panel-body cr-body">
                        <fieldset>
                            <div class="row">
                                <section class="col col-2">
                                    <label class="label">Tipo Documento:</label>                                   
                                    <label class="select">
                                        <select id="cb_tip_doc_1" onchange="filtro_tipo_doc(this.value);" name="input_form_contribuyentel" class="input-sm">
                                            <option value="select" selected="" disabled="">Documento</option>                                           
                                        </select><i></i> </label>                        
                                </section>
                                <section class="col col-2">
                                    <label class="label">Nro. Documento:</label>
                                    <label class="input">
                                        <input id="txt_nro_doc" type="text" onkeypress="return soloDNI(event);"  placeholder="00000000" class="input-sm">
                                    </label>                      
                                </section>
                                <section class="col col-2"> 
                                    <label class="label">Reniec/Sunat</label>
                                    <label class="input">
                                        <a id="vw_contrib_btn_con_dni" onclick="fn_consultar_dni();">
                                            <img src="{{asset('img/reniec.png')}}" width="61" title="RENIEC" style="border: 1px solid #fff; outline: 1px solid #bfbfbf;" />                                            
                                        </a>
                                        <a id="vw_contrib_btn_con_ruc" onclick="fn_consultar_ruc();">
                                            <img src="{{asset('img/sunat.png')}}" width="64" title="SUNAT" style="border: 1px solid #fff; outline: 1px solid #bfbfbf;"/>                                            
                                        </a>                                        
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="label">Tipo de Persona:</label>
                                    <div class="inline-group">
                                        <label class="radio">
                                            <input type="radio" onclick="filtro_tipo_doc(this.value);"  name="radio_tip_per" value="1">
                                            <i></i>Persona Natural</label>
                                        <label class="radio">
                                            <input type="radio" onclick="filtro_tipo_doc(this.value);"  name="radio_tip_per" value="2">
                                            <i></i>Persona Juridica</label>                                       
                                    </div>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-3">
                                    <label class="label">Apellido Paterno:</label>
                                    <label class="input">
                                        <input id="contrib_ape_pat" type="text" placeholder="Apellido Paterno" class="input-sm">
                                    </label>                        
                                </section>
                                <section class="col col-3">
                                    <label class="label">Apellido Materno:</label>
                                    <label class="input">
                                        <input id="contrib_ape_mat" type="text" placeholder="Apellido Materno" class="input-sm">
                                    </label>                      
                                </section>
                                <section class="col col-6">
                                    <label class="label">Nombres:</label>
                                    <label class="input">
                                        <input id="contrib_nombres" type="text" placeholder="Nombres" class="input-sm">
                                    </label>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-2">
                                    <label class="label">Sexo:</label>
                                    <label class="select">
                                        <select id="contrib_sexo" class="input-sm">
                                            <option value="select" selected="" disabled="">Sexo</option>
                                            <option value="1">Masculino</option>
                                            <option value="0">Femenino</option>                                            
                                        </select><i></i> </label>                        
                                </section>
                                <section class="col col-2">
                                    <label class="label">Fch.Nacimiento:</label>
                                    <label class="input">
                                        <input id="contrib_fch_nac" type="text" data-mask="99/99/9999" data-mask-placeholder="-" placeholder="dd-mm-yy" class="input-sm">
                                    </label>                      
                                </section>
                                <section class="col col-2">
                                    <label class="label">Est.Civil:</label>
                                    <label class="select">
                                        <select id="contrib_est_civil" class="input-sm">
                                            <option value="select" selected="" disabled="">Est.Civil</option>
                                            <option value="0">Soltero</option>
                                            <option value="1">Casado</option>
                                            <option value="2">Viudo</option>
                                            <option value="3">Divorciado</option>
                                            <option value="4">Conviviente</option>
                                        </select><i></i> </label>
                                </section>
                                <section class="col col-3">
                                    <label class="label">Telefono Fijo:</label>
                                    <label class="input">
                                        <input id="contrib_tlfno_fijo" type="text" placeholder="Telefono Fijo" class="input-sm">
                                    </label>                      
                                </section>
                                <section class="col col-3">
                                    <label class="label">Telefono Celular:</label>
                                    <label class="input">
                                        <input id="contrib_tlfono_celular" type="text" placeholder="Telefono Celular" class="input-sm">
                                    </label>                      
                                </section>
                            </div>
                            <div class="row">
                                <div class="col col-6">
                                    <label class="label">Correo Electronico:</label>
                                    <label class="input">
                                        <input id="contrib_email" type="text" placeholder="Correo Electronico" class="input-sm">
                                    </label>   
                                </div>
                                <div class="col col-6">
                                    <label class="label">Razon Social:</label>
                                    <label class="input">
                                        <input id="contrib_raz_soc" type="text" placeholder="Razon Social" class="input-sm">
                                    </label> 
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </div>

                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Domicilio Fiscal en la Provincia ::.</div>
                    <div class="panel-body">
                        <fieldset>
                            <div class="row">
                                <section class="col col-4">
                                    <label class="label">Departamento:</label>
                                    <label class="select">
                                        <select id="contrib_dpto" name="input_form_contribuyentel" class="input-sm" onchange="llenar_combo_prov('contrib_prov', this.value);">
                                            <option value="select" selected="" disabled="">Departamento</option>                                           
                                        </select><i></i> </label>                        
                                </section>
                                <section class="col col-4">
                                    <label class="label">Provincia:</label>
                                    <label class="select">
                                        <select id="contrib_prov" name="input_form_contribuyentel" class="input-sm" onchange="llenar_combo_dist('contrib_dist', this.value);">
                                            <option value="select" selected="" disabled="">Provincia</option>                                            
                                        </select><i></i> </label>                     
                                </section>
                                <section class="col col-4">
                                    <label class="label">Distrito:</label>
                                    <label class="select">
                                        <select id="contrib_dist" name="input_form_contribuyentel" class="input-sm">
                                            <option value="select" selected="" disabled="">Distrito</option>                                            
                                        </select><i></i> </label>   
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-4">
                                    <label class="label">Avenida, Jiron, Calle o Pasaje.:</label>
                                    <label class="input">
                                        <input type="hidden" id="hiddentxt_av_jr_calle_psje">
                                        <input id="txt_av_jr_calle_psje" type="text" placeholder="Avenida, Jiron, Calle o Pasaje." class="input-sm">
                                    </label>
                                </section>
                                <section class="col col-2">
                                    <label class="label">N°Muni:</label>
                                    <label class="input">
                                        <input id="contrib_nro_mun" type="text" placeholder="N°. Municipal" class="input-sm">
                                    </label>
                                </section>
                                <section class="col col-2">
                                    <label class="label">Dpto:</label>
                                    <label class="input">
                                        <input id="contrib_dpto_depa" type="text" placeholder="Dpto." class="input-sm">
                                    </label>
                                </section>
                                <section class="col col-2">
                                    <label class="label">Mzna:</label>
                                    <label class="input">
                                        <input id="contrib_manz" type="text" placeholder="Mzna." class="input-sm">
                                    </label>
                                </section>
                                <section class="col col-2">
                                    <label class="label">Lote:</label>
                                    <label class="input">
                                        <input id="contrib_lote" type="text" placeholder="Lote" class="input-sm">
                                    </label>
                                </section>
                            </div>
                            <section>
                                <label class="label">Referencia del Domicilio Fiscal:</label>
                                <label class="input">
                                    <input id="contrib_dom_fiscal" type="text" placeholder="Referencia del Domicilio Fiscal" class="input-sm">
                                </label>                        
                            </section>
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos del Conyugue o Representante Legal ::.</div>
                    <div class="panel-body">
                        <fieldset>
                            <div class="row">
                                <section class="col col-3">
                                    <label class="label">Tipo Documento:</label>
                                    <label class="select">
                                        <select id="cb_tip_doc_2" name="input_form_contribuyentel" class="input-sm">
                                            <option value="select" selected="" disabled="">Documento</option>                                           
                                        </select><i></i></label>                        
                                </section>                                
                                <section class="col col-3">
                                    <label class="label">Nro.Documento:</label>
                                    <label class="input">
                                        <input id="contrib_nro_doc_conv" type="text" placeholder="Nro. Documento" maxlength="8" class="input-sm">
                                    </label>
                                </section>
                                <section class="col col-6">
                                    <label class="label">Apellidos y Nombres del Conyugue / Representante Legal:</label>
                                    <label class="input">
                                        <input id="contrib_conviviente" type="text" placeholder="Apellidos y Nombres del Conyugue / Representante Legal" class="input-sm">
                                    </label>
                                </section>
                            </div>    
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Condicion Especial del Contribuyente ::.</div>
                    <div class="panel-body">
                        <fieldset>
                            <section class="col col-2"><label class="label">Condicion:</label></section>
                            <section class="col col-10">                                
                                <label class="select">
                                    <select id="contrib_id_cond_exonerac" name="input_form_contribuyentel" class="input-sm">
                                        <option value="select" selected="" disabled="">Condicion</option>                                            
                                    </select><i></i> </label>                        
                            </section>                               
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dialog_captcha_reniec" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <center><img id="captcha_reniec" src="" width="150"></center>
                <section>
                    <label class="label">Codigo:</label>
                    <label class="input">
                        <input id="txt_captcha_reniec" type="text" class="input-sm">
                    </label>                        
                </section> 

            </div>
        </div>
    </div>
</div>
@endsection




