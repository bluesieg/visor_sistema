@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Valores Unitarios...</b></h1>
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-2">
                                <label>Filtro Año:</label>
                                <select id="vw_val_unitarios_cb_anio" onchange="refresh_grilla_val_unit(this.value);" class="input-sm">
                                    <option value="select" selected="" disabled="">Año.</option>
                                </select><i></i>                                
                            </div>                            
                            <button onclick="crear_grid_por_anio();" id="btn_vw_valores_arancelarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="fa fa-list-alt"></i></span>Crear
                            </button>
                            <button id="btn_vw_valores_unitarios_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
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
            <table id="table_Val_Unitarios"></table>
            <div id="pager_table_Val_Unitarios"></div>
        </article>
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () { 
        $("#menu_configuracion").show();
        $("#li_config_val_unit").addClass('cr-active');
        get_global_anio_uit('vw_val_unitarios_cb_anio');
        var d = new Date();
        jQuery("#table_Val_Unitarios").jqGrid({
            url: 'grid_val_unitarios?anio=' + d.getFullYear(),
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_val', 'Codigo', 'Descripcion', 'Valor S/.'],
            rowNum: 13, sortname: 'id_val', sortorder: 'asc', viewrecords: true, caption: 'Lista de Valores Unitarios', align: "center",
            colModel: [
                {name: 'id_val', index: 'id_val', hidden: true},
                {name: 'cod_val', index: 'cod_val', align: 'center', width: 50},
                {name: 'des_cat', index: 'des_cat', align: 'left', width: 400},
                {name: 'valor', index: 'valor', align: 'right', width: 60}                
            ],
            pager: '#pager_table_Val_Unitarios',
            rowList: [13, 20],
            onSelectRow: function (Id) {
                $('#btn_vw_valores_unitarios_Editar').attr('onClick', 'open_dialog_new_edit_Val_Unitarios("' + 'EDITAR' + '","' + Id + '")');
//                $('#btn_vw_valores_arancelarios_Eliminar').attr('onClick', 'eliminar_val_arancel(' + Id + ')');
            },
            ondblClickRow: function (Id) {
                $("#btn_vw_valores_unitarios_Editar").click();
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Val_Unitarios").jqGrid('setGridWidth', $("#content").width());
        });
    });
    
</script>
@stop
<script src="{{ asset('archivos_js/configuracion/valores_unitarios.js') }}"></script>
<div id="dialog_new_edit_Val_Unitarios" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important;">
                    <div class="panel-heading bg-color-success">.:: Precio del Valor Unitario / Soles ::.</div>
                    <div class="panel-body">
                        <fieldset> 
                            <section> 
                                <label class="label">Ingrese Valor S/.</label>
                                <label class="input">
                                    <input id="vw_val_unitarios_valor" onkeypress="return soloNumeroTab(event);" type="text" placeholder="Arancel." class="input-sm text-right">
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

