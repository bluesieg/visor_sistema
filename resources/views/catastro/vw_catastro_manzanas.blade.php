@extends('layouts.app')
@section('content')

            <section id="widget-grid" class="">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
                        <div class="well well-sm well-light">
                            <h1 class="txt-color-green"><b>
                                    <h1 class="txt-color-green"><b>Manzanas Catastrales...</b></h1>
                            <div class="row">

                                <div class="col-xs-4">
                                    <label>Sector:</label>
                                    <label class="select">
                                        <select onchange="mzns_por_sector(this.value);" id="select_sectores" class="input-sm">
                                            @foreach ($sectores as $sector)
                                                <option value='{{$sector->id_sec}}' >{{$sector->sector}}</option>
                                            @endforeach
                                        </select><i></i>
                                    </label>
                                </div>

                                <div class="col-xs-8">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="clicknewmzna();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                        </button>
                                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="clickmodmzna();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                        </button>
                                        <button type="button" class="btn btn-labeled bg-color-greenDark txt-color-white" onclick="clicknewmznamasivo();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Crear masivo
                                        </button>
                                        <button  type="button" class="btn btn-labeled btn-danger" onclick="delete_mzna();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                        </button>



                                        <!--
                                        <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                                        </button>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="hidden" id="current_id" value="0">
                        <table id="tabla_manzanas"></table>
                        <div id="pager_tabla_manzanas"></div>
                    </article>
                </div>
            </section>


</section>

@section('page-js-script')
<script type="text/javascript">

    $(document).ready(function () {
        $("#menu_configuracion_catastro").show();
        $("#conf_cat_mzna").addClass('cr-active');
        id_sec = $("#select_sectores").val();

        var pageWidth = $("#tabla_manzanas").parent().width() - 100;

        jQuery("#tabla_manzanas").jqGrid({
            url: 'list_mzns_sector?id_sec=' + id_sec,
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['Código','Sector','cod_mzna','mzna_dist','id_codigo'],
            rowNum: 20,sortname: 'id_mzna',sortorder: 'asc', viewrecords: true, caption: 'Manzanas', align: "center",
            colModel: [
                {name: 'id_mzna', index: 'id_mzna', align: 'center',width:(pageWidth*(10/100))},
                {name: 'sector', index: 'sector', align: 'center', width:(pageWidth*(20/100))},
                {name: 'codi_mzna', index: 'codi_mzna', align: 'center', width:(pageWidth*(10/100))},
                {name: 'mzna_dist', index: 'mzna_dist', align: 'center', width:(pageWidth*(30/100))},
                {name: 'id_codigo', index: 'sector', align: 'center', width:(pageWidth*(20/100))},
            ],
            pager: '#pager_tabla_manzanas',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#tabla_manzanas').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_manzanas').jqGrid('getDataIDs')[0];
                            $("#tabla_manzanas").setSelection(firstid);
                        }
                },
            onSelectRow: function (Id){
                $('#current_id').val($("#tabla_manzanas").getCell(Id, "id_mzna"));

            },
            ondblClickRow: function (Id){
                $('#current_id').val($("#tabla_manzanas").getCell(Id, "id_mzna"));
                clickmodmzna();}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_manzanas").jqGrid('setGridWidth', $("#content").width());
        });

    });

</script>
@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/catastro/cat_mznas.js') }}"></script>
<div id="dlg_manzana" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos de la Manzana ::.</div>
                    <div class="panel-body">
                        <input type="hidden" id="id_mzna" value="0">
                        <fieldset>
                            <div class="row">
                            <section class="col col-2" style="padding-right: 5px; text-align: center">
                                <label class="label" style="text-align: center">Sector:</label>
                                <select id="id_sector_nuevo_editar" class="input-sm">
                                    @foreach ($sectores as $sector)
                                        <option value='{{$sector->id_sec}}' >{{$sector->sector}}</option>
                                    @endforeach
                                </select><i></i>
                            </section>

                                <section class="col col-5" style="padding-left: 5px">
                                    <label class="label">Código Mzna:</label>
                                    <label class="input">
                                        <input id="codi_mzna" type="text" placeholder="" class="input-sm">
                                    </label><i></i>
                                </section>

                                <section class="col col-5" style="padding-left: 5px">
                                    <label class="label">Mzna Dist:</label>
                                    <label class="input">
                                        <input id="mzna_dist" type="text" placeholder="" class="input-sm">
                                    </label><i></i>
                                </section>
                                </div>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div id="dlg_manzana_masivo" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos de la creación ::.</div>
                    <div class="panel-body">
                        <input type="hidden" id="id_mzna" value="0">
                        <fieldset>
                            <div class="row">
                                <section class="col col-2" style="padding-right: 5px; text-align: center">
                                    <label class="label" style="text-align: center">Sector:</label>
                                    <select id="id_sector_masivo" class="input-sm">
                                        @foreach ($sectores_vacios as $sector)
                                            <option value='{{$sector->id_sec}}' >{{$sector->sector}}</option>
                                        @endforeach
                                    </select><i></i>
                                </section>

                                <section class="col col-5" style="padding-left: 5px">
                                    <label class="label">Inicio:</label>
                                    <label class="input">
                                        <input id="inicio" type="text" placeholder="" class="input-sm">
                                    </label><i></i>
                                </section>

                                <section class="col col-5" style="padding-left: 5px">
                                    <label class="label">Fin:</label>
                                    <label class="input">
                                        <input id="fin" type="text" placeholder="" class="input-sm">
                                    </label><i></i>
                                </section>
                            </div>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection




