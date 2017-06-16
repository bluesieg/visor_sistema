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
                    <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
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
        $("#menu_tesoreria").show();
        $("#li_tesoreria_emi_rec_pag").addClass('cr-active');
        jQuery("#table_Contribuyentes").jqGrid({
            url: 'grid_contribuyentes',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers', 'Codigo', ' Tip. Doc', 'N°. Documento', 'Contribuyente o Razon Social', 'Cod. Via', 'Calle / Via', 'Fono. Fijo', 'Celular'],
            rowNum: 13, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE CONTRIBUYENTES REGISTRADOS', align: "center",
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
            rowList: [13, 20],
            onSelectRow: function (Id) { },
            ondblClickRow: function (Id) {
                
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Contribuyentes").jqGrid('setGridWidth', $("#content").width());
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/tesoreria/emision_rec_pago.js') }}"></script>
@endsection
