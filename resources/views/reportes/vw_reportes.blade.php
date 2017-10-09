@extends('layouts.app')
@section('content')

    <section id="widget-grid" class="">
        <div class='cr_content col-xs-12'>
            <div class="col-xs-12">
                <div class="col-lg-9">
                    <h1 class="txt-color-green"><b>Listado de Reportes</b></h1>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12">
                </div>

            </div>
            <div class="col-lg-3 col-md-6 col-xs-12">
            </div>

            <div class="col-lg-3 col-md-6 col-xs-12">
            </div>
            <div class="col-lg-6 col-md-12 col-xs-12">
                <!--
                <ul class="text-right" style="margin-top: 22px !important; margin-bottom: 0px !important">
                    <button onclick="open_dialog_new_edit_Contribuyente('NUEVO');" id="btn_vw_contribuyentes_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                    </button>
                    <button onclick="modificar_contrib();" id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                    </button>
                    <button id="btn_vw_contribuyentes_Eliminar" type="button" class="btn btn-labeled btn-danger">
                        <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                    </button>
                    <button onclick="dlg_new_reporte();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                    </button>
                    <button onclick="reniec();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Reniec
                    </button>
                </ul>
                -->
            </div>
        </div>
        <!-- row -->
        <div class="row">

            <div class="col-sm-12">

                <div class="well">

                    <table class="table table-striped table-forum">
                        <thead>
                        <tr>
                            <th colspan="2" style="width: 60%;">Contribuyentes</th>
                            <th class="text-center hidden-xs hidden-sm" style="width: 10%;">Visto</th>
                            <th class="hidden-xs hidden-sm"style="width: 30%;">Última vez</th>
                        </tr>
                        </thead>
                        <tbody>

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte_0(0);" id="titulo_r1">
                                        Listado de Contribuyentes(Pricos,Mecos,Pecos)
                                    </a>
                                    <small>Descripción reporte 0</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->


                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte(1);" id="titulo_r1">
                                        Listado de datos de los contribuyentes.
                                    </a>
                                    <small>Descripción reporte 1</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte(2);" id="titulo_r2">
                                        Listado de datos Contribuyentes  y predios.
                                    </a>
                                    <small>Descripción reporte 2</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte_4(4);" id="titulo_r2">
                                        Reporte de cantidad de contribuyentes y predios por zonas.
                                    </a>
                                    <small>Descripción reporte 2</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte_5(5);" id="titulo_r2">
                                        Reporte de cantidad de contribuyentes exonerados.
                                    </a>
                                    <small>Descripción reporte 5</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte_6(6);" id="titulo_r2">
                                        Reporte número de Predios de la emision predial por Usos.
                                    </a>
                                    <small>Descripción reporte 5</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte_6(6);" id="titulo_r2">
                                        Reporte del monto de la emisión predial afecto y exonerado.
                                    </a>
                                    <small>Descripción reporte 5</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->

                        <!-- TR -->
                        <tr>
                            <td class="text-center" style="width: 40px;"><i class="fa fa-group fa-2x text-muted"></i></td>
                            <td>
                                <h4><a href="#" onclick="dlg_new_reporte_7(7);" id="titulo_r2">
                                        Reporte de cantidad de contribuyentes con deducción de 50 UIT(Pensionista y adulto mayor) y monto de la base imponible.
                                    </a>
                                    <small>Descripción reporte 5</small>
                                </h4>
                            </td>
                            <td class="text-center hidden-xs hidden-sm">
                                <a href="javascript:void(0);">431 veces</a>
                            </td>
                            <td class="hidden-xs hidden-sm">Por
                                <a href="javascript:void(0);">{{ Auth::user()->ape_nom }}</a>
                                <br>
                                <small><i>January 1, 2014</i></small>
                            </td>
                        </tr>
                        <!-- end TR -->

                        </tbody>
                    </table>

                </div>
            </div>

        </div>

        <!-- end row -->
    </section>
@section('page-js-script')

<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_reportes").show();
        $("#li_ver_reportes").addClass('cr-active');

        $("#range-slider-1").ionRangeSlider({
            min: 0,
            max: 100000,
            from: 0,
            to: 50000,
            type: 'double',
            step: 1,
            postfix: "Soles",
            prettify: false,
            grid: true,
            inputValuesSeparator: ';',
            onFinish: function(data) {
                console.log(data);
                $("#min").val(data.from);
                $("#max").val(data.to);
            }
        });

        var $range = $("#range-slider-1"),
                $from = $("#min"),
                $to = $("#max"),
                range,
                min = 0,
                max = 100000,
                from,
                to;

        var updateValues = function () {
            $from.prop("value", from);
            $to.prop("value", to);
        };

        $range.ionRangeSlider({
            type: "double",
            min: min,
            max: max,
            prettify_enabled: false,
            grid: true,
            grid_num: 10,
            onChange: function (data) {
                from = data.from;
                to = data.to;

                updateValues();
            }
        });

        range = $range.data("ionRangeSlider");

        var updateRange = function () {
            range.update({
                from: from,
                to: to
            });
        };

        $from.on("change", function () {
            from = +$(this).prop("value");
            if (from < min) {
                from = min;
            }
            if (from > to) {
                from = to;
            }

            updateValues();
            updateRange();
        });

        $to.on("change", function () {
            to = +$(this).prop("value");
            if (to > max) {
                to = max;
            }
            if (to < from) {
                to = from;
            }

            updateValues();
            updateRange();
        });


    });
</script>
@stop
<script src="{{ asset('Js/plugin/ion-slider/ion.rangeSlider.min.js')}}"></script>
<script src="{{ asset('archivos_js/reportes/reportes.js') }}"></script>

<div id="dialog_reporte_contr" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <p id="descripcion_subtitulo">

                        </p>
                        <hr class="simple">
                        <ul id="myTab1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" onclick="current_tab(1);" data-toggle="tab">Año-Sector-Manzana</a>
                            </li>
                            <li>
                                <a href="#s2" onclick="current_tab(2);" data-toggle="tab">Habilitación Urbana</a>
                            </li>

                        </ul>

                        <div id="myTabContent1" class="tab-content padding-10">
                            <div class="tab-pane fade in active" id="s1">
                                <div class="row">
                                    <section class="col col-4" style="padding-right:5px;">
                                        <label class="label">AÑO:</label>
                                        <label class="select">
                                            <select id='selantra' class="form-control col-lg-8">
                                                @foreach ($anio_tra as $anio)
                                                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                                @endforeach
                                            </select><i></i> </label>
                                    </section>
                                    <section class="col col-4" style="padding-left:5px;padding-right:5px;">
                                        <label class="label">SECTOR:</label>
                                        <label class="select">
                                            <select id='selsec' class="form-control col-lg-8" onchange="callpredtab();">
                                                @foreach ($sectores as $sect)
                                                    <option value='{{$sect->id_sec}}' >{{$sect->sector}}</option>
                                                @endforeach
                                            </select><i></i> </label>
                                    </section>
                                    <section class="col col-4" id="div_mzna" style="padding-left:5px;padding-right:5px">
                                        <label class="label">MANZANA:</label>
                                        <label class="select">
                                            <select id="selmnza" class="form-control" >
                                                <option value='0'>-- TODOS --</option>
                                                @foreach ($manzanas as $mzna)
                                                    <option value='{{$mzna->codi_mzna}}'>{{$mzna->codi_mzna}}</option>
                                                @endforeach
                                            </select><i></i> </label>
                                    </section>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="s2">

                                <div class="row">
                                <section class="col col-2" style="padding-right:5px;">
                                    <label class="label">AÑO:</label>
                                    <label class="select">
                                        <select id='selec_hab_urb' class="form-control col-lg-8">
                                            @foreach ($anio_tra as $anio)
                                                <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                            @endforeach
                                        </select><i></i> </label>
                                </section>

                                <section class="col col-10">
                                    <label class="label">Habilitación Urbana:</label>
                                    <label class="input">
                                        <input type="hidden" id="hiddentxt_hab_urb">
                                        <input id="hab_urb" type="text" placeholder="Avenida, Jiron, Calle o Pasaje." class="input-sm">
                                       <!-- <input type="text" list="list" id="hab_urb" name="hab_urb" placeholder="Habilitación Urbana">
                                        <datalist id="list">
                                            @foreach ($hab_urb as $hab)
                                                <option data-xyz ="{{$hab->id_hab_urb}}" value="{{$hab->nomb_hab_urba}}">{{$hab->id_hab_urb}}</option>
                                            @endforeach
                                        </datalist> -->
                                        </label>
                                </section>
                                    </div>

                            </div>
                        </div>

                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->
            </div>
        </div>
    </div>
</div>

<div id="dialog_reporte_contr_4" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="row">
                    <section class="col col-3">

                    </section>
                    <section class="col col-6" style="padding-right:5px;">
                        <label class="label">AÑO:</label>
                        <label class="select">
                            <select id='selan_r4' class="form-control">
                                @foreach ($anio_tra as $anio_4)
                                    <option value='{{$anio_4->anio}}' >{{$anio_4->anio}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-3">

                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialog_reporte_contr_0" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">


                <div class="row" style="padding-left: 30px;padding-right: 35px">
                    <label class="label" style="text-align: center">RANGO:</label>

                                <input id="range-slider-1" type="text" name="range_1" value="">
                </div>

                <br>
                <div class="row" style="padding-left: 15px;padding-right: 35px">
                    <section class="col col-3" style="padding-right:5px;">
                        <label class="label">AÑO:</label>
                        <label class="select">
                            <select id='selantra_r0' class="form-control col-lg-8">
                                @foreach ($anio_tra as $anio)
                                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-3">
                        <label class="label">MIN:</label>
                        <label class="input">
                            <input id="min" type="text" placeholder="0" onkeypress="update_slider_min();" class="input-sm" value="0">
                        </label>
                    </section>
                    <section class="col col-3">
                        <label class="label">MAX:</label>
                        <label class="input">
                            <input id="max" type="text" onkeypress="update_slider_max();" placeholder="50 000" class="input-sm" value="50000">
                        </label>
                    </section>
                    <section class="col col-3">
                        <label class="label">REGISTROS:</label>
                        <label class="input">
                            <input id="num_reg" type="text" placeholder="10" class="input-sm">
                        </label>
                    </section>
                </div>

                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialog_reporte_contr_5" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="row">
                    <section class="col col-4" style="padding-right:5px;">
                        <label class="label">AÑO:</label>
                        <label class="select">
                            <select id='selantra_5' class="form-control col-lg-8">
                                @foreach ($anio_tra as $anio_5)
                                    <option value='{{$anio_5->anio}}' >{{$anio_5->anio}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-4" style="padding-left:5px;padding-right:5px;">
                        <label class="label">SECTOR:</label>
                        <label class="select">
                            <select id='selsec_5' class="form-control col-lg-8">
                                <option value='0'>-- TODOS --</option>
                                @foreach ($sectores as $sector_5)
                                    <option value='{{$sector_5->id_sec}}' >{{$sector_5->sector}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-4" id="div_condicion" style="padding-left:5px;padding-right:5px">
                        <label class="label">CONDICIÓN:</label>
                        <label class="select_5">
                            <select id="selcond_5" class="form-control" >
                                @foreach ($condicion as $cond)
                                    <option value='{{$cond->id_exo}}' >{{$cond->desc_exon}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialog_reporte_contr_6" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="row">
                    <section class="col col-3" style="padding-right:5px;">
                        <label class="label">AÑO:</label>
                        <label class="select">
                            <select id='selantra_6' class="form-control col-lg-8">
                                @foreach ($anio_tra as $anio_5)
                                    <option value='{{$anio_5->anio}}' >{{$anio_5->anio}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-3" style="padding-left:5px;padding-right:5px;">
                        <label class="label">SECTOR:</label>
                        <label class="select">
                            <select id='selsec_6' class="form-control col-lg-8">
                                <option value='0'>-- TODOS --</option>
                                @foreach ($sectores as $sector_5)
                                    <option value='{{$sector_5->id_sec}}' >{{$sector_5->sector}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-6" id="div_condicion">
                        <label class="label">USO:</label>
                        <label class="select_5">
                            <select id="seluso_6" class="form-control col-lg-12" >
                                <option value='0'>-- TODOS --</option>
                                @foreach ($usos_predio_arb as $usos)
                                    <option value='{{$usos->id_uso_arb}}' >{{$usos->uso_arbitrio}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="dialog_reporte_contr_7" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="row">
                    <section class="col col-6" style="padding-right:5px;">
                        <label class="label">AÑO:</label>
                        <label class="select">
                            <select id='selantra_7' class="form-control col-lg-8">
                                @foreach ($anio_tra as $anio_7)
                                    <option value='{{$anio_7->anio}}' >{{$anio_7->anio}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                    <section class="col col-6" style="padding-left:5px;padding-right:5px;">
                        <label class="label">SECTOR:</label>
                        <label class="select">
                            <select id='selsec_7' class="form-control col-lg-8">
                                <option value='0'>-- TODOS --</option>
                                @foreach ($sectores as $sector_7)
                                    <option value='{{$sector_7->id_sec}}' >{{$sector_7->sector}}</option>
                                @endforeach
                            </select><i></i> </label>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




