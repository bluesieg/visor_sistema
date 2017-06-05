@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Valores Arancelarios...</b></h1>
                <ul id="sparks">                                        
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
                </ul>
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
            colNames: ['id_pers', 'Codigo', ' Tip. Doc', 'Nro. Documento', 'Contribuyente o Razon Social', 'Cod. Via', 'Calle / Via', 'Fono. Fijo', 'Celular'],
            rowNum: 13, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE CONTRIBUYENTES REGISTRADOS', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_persona', index: 'id_persona', align: 'left', width: 90},
                {name: 'tipo_doc', index: 'tipo_doc', align: 'center', width: 60},
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
    });
</script>
@stop
<script src="{{ asset('archivos_js/configuracion/valores_arancelarios.js') }}"></script>
@endsection

