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
                <h1 class="txt-color-green"><b>Valores Arancelarios...</b></h1>
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-6 text-left">
                                <label>Filtro Año:</label>
                                <select id="vw_val_arancel_cb_anio" onchange="click_btn_buscar();" class="input-sm">
                                    <option value="select" selected="" disabled="">Año.</option>
                                </select><i></i>
                                <label>Sector:</label>
                                <select id="vw_val_arancel_cb_sector" onchange="llenar_combo_mzna(this.value);" class="input-sm">
                                    <option value="select" selected="" disabled="">Sector.</option>
                                    @foreach ($sector as $sector)                                        
                                    <option value='{{$sector->id_sec}}' >{{$sector->sector}}</option>
                                    @endforeach 
                                </select><i></i>
                                <label> Manzana:</label>
                                <select id="vw_val_arancel_cb_mzna" onchange="click_btn_buscar();" class="input-sm">
                                    <option value="select" selected="" disabled="">Mzna.</option>                                    
                                </select><i></i>
                            </div>
                            <button onclick="buscar_val_arancel();" style="display: none;" id="btn_vw_valores_arancelarios_Buscar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="fa fa-search"></i></span>Buscar
                            </button>
                            <button onclick="open_dialog_new_edit_Val_Arancel('NUEVO');" id="btn_vw_valores_arancelarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                            </button>
                            <button id="btn_vw_valores_arancelarios_Editar" onclick="open_dialog_new_edit_Val_Arancel('EDITAR');" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                            </button>
                            <button id="btn_vw_valores_arancelarios_Eliminar" onclick="eliminar_val_arancel();" type="button" class="btn btn-labeled btn-danger">
                                <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                            </button> 
                            <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                            </button>
                        </div>
                    </div>
                </div>              
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="table_Val_Arancel"></table>
            <div id="pager_table_Val_Arancel"></div>
        </article>
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_configuracion").show();
        $("#li_config_val_ara").addClass('cr-active');
        MensajeDialogLoadAjax('content', '.:: CARGANDO ...');

        var filtro = 0;
        var global_filtro = 0;
        get_global_anio_uit('vw_val_arancel_cb_anio');
        var sector_global = 0;


        var mzna_global = 0;
        var d = new Date();
        if (mzna_global == 0) {
            mzna_global = 1;
            llenar_combo_mzna(1);
            $("#vw_val_arancel_cb_mzna").prop("selectedIndex", 1);
        }
        if (global_filtro == 0) {
            global_filtro = 1;
            filtro = d.getFullYear() + '01001';
        }

        jQuery("#table_Val_Arancel").jqGrid({
            url: 'grid_val_arancel?anio='+$("#vw_val_arancel_cb_anio").val()+'&sec='+$("#vw_val_arancel_cb_sector option:selected").text()+'&mzna='+$("#vw_val_arancel_cb_mzna option:selected").text(),
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_arancel', 'Sector', 'Manzana', 'Cod. Via', 'Nombre de Via', 'Arancel S/.', 'id_via'],
            rowNum: 13, sortname: 'id_arancel', sortorder: 'asc', viewrecords: true, caption: 'Lista de Valores Arancelarios', align: "center",
            colModel: [
                {name: 'id_arancel', index: 'id_arancel', hidden: true},
                {name: 'sec', index: 'sec', align: 'center', width: 50},
                {name: 'mzna', index: 'mzna', align: 'center', width: 50},
                {name: 'cod_via', index: 'cod_via', align: 'center', width: 60},
                {name: 'nom_via', index: 'nom_via', align: 'left', width: 300},
                {name: 'val_ara', index: 'val_ara', align: 'right', width: 60},
                {name: 'id_via', index: 'id_via', hidden: true}
            ],
            pager: '#pager_table_Val_Arancel',
            rowList: [13, 20],
            onSelectRow: function (Id) {},
            ondblClickRow: function (Id) {
                open_dialog_new_edit_Val_Arancel('EDITAR',Id);
            },
            gridComplete: function () {
                var idarray = jQuery('#table_Val_Arancel').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                    var firstid = jQuery('#table_Val_Arancel').jqGrid('getDataIDs')[0];
                    $("#table_Val_Arancel").setSelection(firstid);
                }
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Val_Arancel").jqGrid('setGridWidth', $("#content").width());
        });
        $("#val_arancel_cod_via").keypress(function (e) {
            if (e.which == 13) {
                cod_via = ponerCeros(5,$("#val_arancel_cod_via").val());
                
                $('#val_arancel_cod_via').val(cod_via);
                get_global_cod_via('val_arancel_nom_via',cod_via,'val_arancel_cod_via');
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/configuracion/valores_arancelarios.js') }}"></script>
<div id="dialog_new_edit_Val_Arancel" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important">
                    <div class="panel-heading bg-color-success" >.:: Valores Arancelarios ::.</div>
                    <div class="panel-body cr-body">
                        <fieldset>                           
                            <div class="row">
                                <section class="col col-6">
                                    <label class="label">Sector:</label>
                                    <label class="input">
                                        <input id="val_arancel_sec" type="text" placeholder="Sector" class="input-sm" disabled="disabled">
                                    </label>                        
                                </section>
                                <section class="col col-6">
                                    <label class="label">Manzana:</label>
                                    <label class="input">
                                        <input id="val_arancel_mzna" type="text" placeholder="Manzana" class="input-sm" disabled="disabled">
                                    </label>                      
                                </section>                               
                            </div>
                            <div class="row">
                                <section class="col col-4">
                                    <label class="label">Cod. Via:</label>
                                    <label class="input">
                                        <input id="val_arancel_cod_via" onkeypress="return soloDNI(event);" type="text" placeholder="000000" class="input-sm">
                                    </label>                        
                                </section>
                                <section class="col col-8">
                                    <label class="label">.</label>
                                    <label class="input">
                                        <input id="val_arancel_nom_via" type="text" placeholder="Nombre Via." class="input-sm" disabled="disabled">
                                    </label>                      
                                </section>                               
                            </div>        
                            <section> 
                                <label class="label">Arancel:</label>
                                <label class="input">
                                    <input id="val_arancel_val_ara" onkeypress="return soloNumeroTab(event);" type="text" placeholder="0.00" class="input-sm text-right">
                                </label>                      
                            </section>         
                        </fieldset>
                    </div>
                </div>               
            </div>
        </div>
    </div>
</div>
@endsection

