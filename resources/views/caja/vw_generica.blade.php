@extends('layouts.app')
@section('content')
<style>
    .panel-success>.panel-heading {
        color: white;
        background-color: #80B23E;
        border-color: #80B23E;
        text-align: center;
        height: 20px;
        padding-top: 3px;
    }

</style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h3 class="txt-color-green"><b>Clasificador de Ingresos - GENÉRICA / SUB GENÉRICA</b></h3>

            </div>                   
        </div>
    </div>
    <div class="row">
        <div  class="smart-form">
            <div class="panel-group">
                <section class="col col-6" id="content_caja_gen"  style="padding-right:2px;">
                    <div class="panel panel-success">
                        <div class="panel-heading bg-color-success" >.:: GENÉRICA ::.</div>
                        <div class="panel-body cr-body">
                            <div class="col-xs-12" style="margin-top: 5px;">                        
                                <div class="text-right">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <label>Filtrar Por:</label>
                                        <select id="vw_val_arancel_cb_anio" onchange="click_btn_buscar();" class="input-sm">
                                            <option value="select" selected="" disabled="">- Año -</option>
                                        </select><i></i>                                
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i>Nuevo</a>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i>Editar</a>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i>Eliminar</a>
                                </div>
                                <br>
                                <hr style="background-color: #80B23E; height: 1px; border: 0;margin-top: -12px;">
                            </div>                            
                            <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <table id="table_caja_generica"></table>
                                <div id="pager_table_caja_generica"></div>
                            </article>
                        </div>
                    </div>         
                </section>
                <section class="col col-6" style="padding-left:2px;">
                    <div class="panel panel-success">
                        <div class="panel-heading bg-color-success" >.:: GENÉRICA ::.</div>
                        <div class="panel-body cr-body">
                            <div class="col-xs-12" style="margin-top: 5px;">                        
                                <div class="text-right">
                                    <div class="col-xs-3 col-sm-3 col-md-3 col-lg-3">
                                        <label>Filtrar Por:</label>
                                        <select id="vw_val_arancel_cb_anio" onchange="click_btn_buscar();" class="input-sm">
                                            <option value="select" selected="" disabled="">- Año -</option>
                                        </select><i></i>                                
                                    </div>
                                    <a href="javascript:void(0);" class="btn btn-success btn-sm"><i class="glyphicon glyphicon-plus"></i>Nuevo</a>
                                    <a href="javascript:void(0);" class="btn btn-primary btn-sm"><i class="glyphicon glyphicon-pencil"></i>Editar</a>
                                    <a href="javascript:void(0);" class="btn btn-danger btn-sm"><i class="glyphicon glyphicon-trash"></i>Eliminar</a>
                                </div>
                                <br>
                                <hr style="background-color: #80B23E; height: 1px; border: 0;margin-top: -12px;">
                            </div>
                        </div>
                    </div>                
                </section>
            </div>
        </div>
    </div>
</section>
<!--                    <section> 
                        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                            <table id="table_caja_generica"></table>
                            <div id="pager_table_caja_generica"></div>
                        </article>                      
                    </section>         -->
@section('page-js-script')

<script type="text/javascript">
    $(document).ready(function () {
        var d = new Date();
        anio = d.getFullYear();
        $("#menu_mod_caja").show();
        $("#li_mod_caja_gen").addClass('cr-active');
        jQuery("#table_caja_generica").jqGrid({
            url: 'get_clas_ing_generica?anio=' + anio,
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gener', 'Codigo', ' Descripcion - Generica', 'anio'],
            rowNum: 15, sortname: 'id', sortorder: 'desc', viewrecords: true, 
            colModel: [
                {name: 'id_gener', index: 'id_gener', hidden: true},
                {name: 'cod_generica', index: 'cod_generica', align: 'left', width: 30},
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
            $("#table_caja_generica").jqGrid('setGridWidth', $("#content_caja_gen").width());
        });

    });
</script>
@stop
<script src="{{ asset('archivos_js/tesoreria/emision_rec_pago.js') }}"></script>
@endsection
