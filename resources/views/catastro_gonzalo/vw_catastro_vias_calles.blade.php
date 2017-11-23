@extends('layouts.app')
@section('content')

            <section id="widget-grid" class="">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
                        <div class="well well-sm well-light">
                            <h1 class="txt-color-green"><b>
                                    <h1 class="txt-color-green"><b>VIAS - CALLES...</b></h1>
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="text-right">
                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="nuevo_via_calle();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                        </button>
                                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_via_calle();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                        </button>
                                        <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_via_calle();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                        <input type="hidden" id="current_id" value="0">
                        <table id="tabla_vias"></table>
                        <div id="pager_table_vias"></div>
                    </article>
                </div>
            </section>


</section>

@section('page-js-script')
<script type="text/javascript">

    $(document).ready(function () {
        $("#menu_configuracion_catastro").show();
        $("#conf_catastro_vc").addClass('cr-active');

        var pageWidth = $("#tabla_vias").parent().width() - 100;

        jQuery("#tabla_vias").jqGrid({
            url: 'listar_vias',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID','COD_VIA','NOMBRE VIA','TIPO VIA'],
            rowNum: 20,sortname: 'id_via', viewrecords: true, caption: 'VIAS', align: "center",
            colModel: [
                {name: 'id_via', index: 'id_via', align: 'center',width:(pageWidth*(30/100))},
                {name: 'cod_via', index: 'cod_via', align: 'center', width:(pageWidth*(70/100))}, 
                {name: 'nom_via', index: 'nom_via', align: 'center', width:(pageWidth*(70/100))},
                {name: 'tip_via', index: 'tip_via', align: 'center', width:(pageWidth*(70/100))},

            ],
            pager: '#pager_table_vias',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#tabla_vias').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#tabla_vias').jqGrid('getDataIDs')[0];
                            $("#tabla_vias").setSelection(firstid);
                        }
                },
            onSelectRow: function (Id){
                $('#current_id').val($("#tabla_vias").getCell(Id, "id_via"));

            },
            ondblClickRow: function (Id){
                $('#current_id').val($("#tabla_vias").getCell(Id, "id_via"));
                actualizar_via_calle();}
        });

        $(window).on('resize.jqGrid', function () {
            $("#tabla_vias").jqGrid('setGridWidth', $("#content").width());
        });

    });

</script>
@stop

<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/catastro_gonzalo/cat_vias_calles.js') }}"></script>
<div id="dlg_nuevo_cat_via_calle" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos de la creación ::.</div>
                    <div class="panel-body">
                        <input type="hidden" id="id_via_calle" value="0">
                        <fieldset>
                            <div class="row">
                                <section class="col col-xs-12" style="padding-right: 15px; text-align: center">
                                    <label class="label" style="text-align: center">Selecciona Tipo de Via:</label>
                                    <select id="select_tipo_via" class="input-sm col-xs-12">
                                        @foreach ($vias as $via)
                                            <option value='{{$via->id_tip_via}}' >{{$via->tip_via}}</option>
                                        @endforeach
                                    </select><i></i>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-xs-12" style="padding-right: 15px; text-align: center">
                                    <label class="label" style="text-align: center">Selecciona Habilitacion Urbana:</label>
                                    <select id="select_hab_urb" class="input-sm col-xs-12">
                                        @foreach ($hab_urbanas as $hab_urbana)
                                            <option value='{{$hab_urbana->id_tip_hab}}' >{{$hab_urbana->nomb_hab_urba}}</option>
                                        @endforeach
                                    </select><i></i>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-xs-12" style="padding-left: 15px">
                                    <label class="label" style="text-align: center">Codigo Via:</label>
                                    <input class="text-center col-xs-12 form-control" id="cod_via" type="text" name="cod_via" maxlength="6" onkeypress="return soloNumeroTab(event);" onchange="ponerCeros(this)">
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-xs-12" style="padding-left: 15px">
                                    <label class="label" style="text-align: center">Nombre Calle:</label>
                                    <input class="text-center col-xs-12 form-control text-uppercase" id="nom_calle" type="text" name="nom_calle" onkeyup="javascript:this.value=this.value.toUpperCase();" maxlength="100">
                                </section>
                            </div>
                        </div>
                        </fieldset>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection




