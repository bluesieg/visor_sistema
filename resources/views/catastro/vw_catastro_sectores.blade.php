@extends('layouts.app')
@section('content')

            <section id="widget-grid" class="">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
                        <div class="well well-sm well-light">
                            <h1 class="txt-color-green"><b>
                                    <h1 class="txt-color-green"><b>Sectores Catastrales...</b></h1>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="clicknewsector();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                        </button>
                                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="clickmodsector();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                        </button>
                                        <button  type="button" class="btn btn-labeled btn-danger" onclick="delete_sector();">
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
                        <input type="hidden" id="current_id" value="0">
                        <table id="tabla_sectores"></table>
                        <div id="pager_table_sectores"></div>
                    </article>
                </div>
            </section>


</section>

@section('page-js-script')
<script type="text/javascript">

    $(document).ready(function () {
        $("#menu_configuracion_catastro").show();
        $("#conf_cat_sect").addClass('cr-active');

        var pageWidth = $("#tabla_sectores").parent().width() - 100;

        jQuery("#tabla_sectores").jqGrid({
            url: 'list_sectores',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['Código','Sector'],
            rowNum: 20,sortname: 'id_sec', viewrecords: true, caption: 'Sectores', align: "center",
            colModel: [
                {name: 'id_sec', index: 'id_sec', align: 'center',width:(pageWidth*(30/100))},
                {name: 'sector', index: 'sector', align: 'center', width:(pageWidth*(70/100))},

            ],
            pager: '#pager_table_sectores',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#tabla_sectores').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_sectores').jqGrid('getDataIDs')[0];
                            $("#tabla_sectores").setSelection(firstid);
                        }
                },
            onSelectRow: function (Id){
                $('#current_id').val($("#tabla_sectores").getCell(Id, "id_sec"));

            },
            ondblClickRow: function (Id){
                $('#current_id').val($("#tabla_sectores").getCell(Id, "id_sec"));
                clickmodsector();}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_sectores").jqGrid('setGridWidth', $("#content").width());
        });

    });

</script>
@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/catastro/cat_sectores.js') }}"></script>
<div id="dlg_nuevo_sector" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Descripción Sector ::.</div>
                    <div class="panel-body cr-body">
                        <div class="col-xs-4"></div>
                        <div class="text-center col-xs-4" >
                            <input type="hidden" id="id_sector" value="0">
                            <input class="text-center col-xs-12 form-control" id="sector" type="text" name="sector">
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection




