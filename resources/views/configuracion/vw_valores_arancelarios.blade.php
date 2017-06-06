@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Valores Arancelarios...</b></h1>
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-2">
                                <label>Filtro Año:</label>
                                <select id="vw_val_arancel_cb_anio" class="input-sm">
                                    <option value="select" selected="" disabled="">Año.</option>
                                </select><i></i>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-2">
                                <label>Sector:</label>
                                <select id="vw_val_arancel_cb_sector" class="input-sm">
                                    <option value="select" selected="" disabled="">Sector.</option>                                    
                                </select><i></i>
                            </div>
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-2">
                                <label> Manzana:</label>
                                <select id="vw_val_arancel_cb_mzna" class="input-sm">
                                    <option value="select" selected="" disabled="">Mzna.</option>                                    
                                </select><i></i>
                            </div>
                            <button onclick="open_dialog_new_edit_Val_Arancel('NUEVO');" id="btn_vw_valores_arancelarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                            </button>
                            <button id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                            </button>
                            <button id="btn_vw_contribuyentes_Eliminar" type="button" class="btn btn-labeled btn-danger">
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
        jQuery("#table_Val_Arancel").jqGrid({
            url: 'grid_val_arancel',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_arancel', 'Sector', 'Manzana', 'Cod. Via', 'Nombre de Via', 'Arancel S/.'],
            rowNum: 13, sortname: 'id_arancel', sortorder: 'desc', viewrecords: true, caption: 'Lista de Valores Arancelarios', align: "center",
            colModel: [
                {name: 'id_arancel', index: 'id_arancel', hidden: true},
                {name: 'sec', index: 'sec', align: 'left', width: 90},
                {name: 'mzna', index: 'mzna', align: 'center', width: 60},
                {name: 'nro_doc', index: 'nro_doc', align: 'center', width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'cod_via', index: 'cod_via', align: 'center', width: 70},
                {name: 'nom_via', index: 'nom_via', width: 100},
                {name: 'tlfno_fijo', index: 'tlfno_fijo', width: 80},
                {name: 'tlfono_celular', index: 'tlfono_celular', width: 80}
            ],
            pager: '#pager_table_Val_Arancel',
            rowList: [13, 20],
            onSelectRow: function (Id) {
                $('#btn_vw_contribuyentes_Editar').attr('onClick', 'open_dialog_new_edit_Contribuyente("' + 'EDITAR' + '",' + Id + ')');
                $('#btn_vw_contribuyentes_Eliminar').attr('onClick', 'eliminar_contribuyente(' + Id + ')');
            },
            ondblClickRow: function (Id) {
                $("#btn_vw_contribuyentes_Editar").click();
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#pager_table_Val_Arancel").jqGrid('setGridWidth', $("#content").width());
        });

        $.ajax({
            url: 'get_anio_val_arancel',
            type: 'GET',
            success: function (data) {
                for (i = 0; i <= data.length - 1; i++) {                   
                    $('#vw_val_arancel_cb_anio').append('<option value=' + data[i].anio + '>' + data[i].anio + '</option>');
                }
            },
            error: function (data) {
                alert(' Error al llenar combo Año...');
            }
        });
        var sector_global =0;
        $.ajax({
            url: 'get_sector_val_arancel',
            type: 'GET',
            success: function (data) {
                for (i = 0; i <= data.length - 1; i++) {                   
                    $('#vw_val_arancel_cb_sector').append('<option value=' + data[i].id_sec + '>' + data[i].sector + '</option>');
                }
                if(sector_global == 0 ){
                    $('#vw_val_arancel_cb_sector').
                }
                
            },
            error: function (data) {
                alert(' Error al llenar combo Sector...');
            }
        });
        $.ajax({
            url: 'get_mzna_val_arancel',
            type: 'GET',
            success: function (data) {
                for (i = 0; i <= data.length - 1; i++) {                   
                    $('#vw_val_arancel_cb_mzna').append('<option value=' + data[i].id_mzna + '>' + data[i].codi_mzna + '</option>');
                }
            },
            error: function (data) {
                alert(' Error al llenar combo Sector...');
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/configuracion/valores_arancelarios.js') }}"></script>
@endsection

