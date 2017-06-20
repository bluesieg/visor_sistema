@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h4 class="txt-color-green"><b>Clasificador de Ingresos - GENERICA</b></h4>
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
            <table id="table_caja_generica"></table>
            <div id="pager_table_caja_generica"></div>
        </article>
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">
    $(document).ready(function () {
        var d = new Date();
        anio = d.getFullYear();
        $("#menu_mod_caja").show();
        $("#li_mod_caja_gen").addClass('cr-active');
        jQuery("#table_caja_generica").jqGrid({
            url: 'get_clas_ing_generica?anio='+anio,
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gener', 'Codigo', ' Descripcion - Generica', 'anio'],
            rowNum: 15, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE USUARIOS REGISTRADOS', align: "center",
            colModel: [
                {name: 'id_gener', index: 'id_gener', hidden: true},
                {name: 'cod_generica', index: 'cod_generica', align: 'left'},
                {name: 'descr_gen', index: 'descr_gen', align: 'left'},
                {name: 'anio', index: 'anio', align: 'left'}                
            ],
            pager: '#pager_table_caja_generica',
            rowList: [15, 25],
            onSelectRow: function (Id) {
                
            },
            ondblClickRow: function (Id) {
                
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_caja_generica").jqGrid('setGridWidth', $("#content").width());
        });

    });
</script>
@stop
<script src="{{ asset('archivos_js/tesoreria/emision_rec_pago.js') }}"></script>
@endsection
