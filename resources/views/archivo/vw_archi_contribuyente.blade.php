@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Archivo - Contribuyentes...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">
                            <section class="col-lg-5" style="padding-left:2px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Contribuyente<i class="icon-append fa fa-male" style="margin-left: 5px;"></i></span>
                                    <input type="text" id="vw_contrib_buscar" class="form-control text-uppercase">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="button" onclick="busqueda(2);" title="BUSCAR">
                                            <i class="glyphicon glyphicon-search"></i>&nbsp;Buscar
                                        </button>
                                    </span>
                                </div>                                            
                            </section>
                            @if( $permisos[0]->btn_new ==1 )
                                <button onclick="fn_new_archi_contrib();"  type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                </button>
                            @else
                                <button onclick="sin_permiso();" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                </button>
                            @endif
                            @if( $permisos[0]->btn_edit ==1 )
                                <button onclick="modificar_contrib();" id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                </button>
                            @else
                                <button onclick="sin_permiso();" id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                </button>
                            @endif
                            @if( $permisos[0]->btn_imp ==1 )
                                <button onclick="dlg_new_reporte();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                                </button>
                            @else
                                <button onclick="sin_permiso();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                                </button>
                            @endif
                        </div>                        
                    </div>
                </div> 
            </div>
            <div class="well well-sm well-light" style="margin-top:-20px;">                
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="row">
                            <section id="content_2" class="col-lg-12">
                                <table id="table_Contribuyentes"></table>
                                <div id="pager_table_Contribuyentes"></div>
                            </section>                            
                        </div>                                                
                    </div>
                </div> 
            </div>
        </div>       
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_archivo").show();
        $("#li_archi_contrib").addClass('cr-active');
        jQuery("#table_Contribuyentes").jqGrid({
            url: 'list_arch_contrib?name=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_contrib','tip_documento', ' Tip. Doc', 'N°. Documento', 'Contribuyente o Razon Social', 'Fec. Nac', 'Domicilio', 'Nro Exp'],
            rowNum: 20, sortname: 'id_contrib', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE CONTRIBUYENTES REGISTRADOS', align: "center",
            colModel: [                
                {name: 'id_contrib', index: 'id_contrib', hidden:true},
                {name: 'tip_documento', index: 'tip_documento', hidden:true},
                {name: 'documento', index: 'documento', align: 'center', width: 90},
                {name: 'nro_documento', index: 'nro_documento', align: 'center', width: 90},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'fch_nac', index: 'fch_nac', align: 'center', width: 60},
                {name: 'domicilio', index: 'domicilio', width: 130},
                {name: 'nro_expediente', index: 'nro_expediente', width: 80},
                
            ],
            pager: '#pager_table_Contribuyentes',
            rowList: [20, 30, 50],
            onSelectRow: function (Id) { },
            ondblClickRow: function (Id) {
            },
            gridComplete: function () {
                var rows = $("#table_Contribuyentes").getDataIDs();
                for (var i = 0; i < rows.length; i++) {
                    var tipo_doc = $("#table_Contribuyentes").getCell(rows[i], "tipo_doc");
                }
                if (rows.length > 0) {
                    var firstid = jQuery('#table_Contribuyentes').jqGrid('getDataIDs')[0];
                    $("#table_Contribuyentes").setSelection(firstid);    
                }
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Contribuyentes").jqGrid('setGridWidth', $("#content_2").width());
        });
        $("#vw_contrib_buscar").keypress(function (e) {
            if (e.which == 13) {
                busqueda(2);
            }
        });
       
             
    });
</script>
@stop
<script src="{{ asset('archivos_js/archivo/archi_contri.js') }}"></script>
<div id="dlg_new_contri" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>LLenado de Información::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-8" style="padding: 0px;">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon"  style="width: 165px" >Tipo Documento &nbsp;<i class="fa fa-file"></i></span>
                        <div class="icon-addon addon-md">
                            <select id='seltipdoc' class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($tip_doc as $docs)
                            <option value='{{$docs->id_tip}}' >{{$docs->documento}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px"></div>
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Número Documento &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_nro_doc" type="text"  class="form-control" style="height: 32px;" maxlength="20">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Contribuyente &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_contrib" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="200">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Fecha Nac. &nbsp;<i class="fa fa-calendar"></i></span>
                        <div>
                            <input id="dlg_fec_nac" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Domicilio &nbsp;<i class="fa fa-home"></i></span>
                        <div>
                            <input id="dlg_domicilio" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="150">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Observaciones &nbsp;<i class="fa fa-eye"></i></span>
                        <div>
                            <input id="dlg_obs" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="250">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">N° de Expediente &nbsp;<i class="fa fa-file-archive-o"></i></span>
                        <div>
                            <input id="dlg_num_exp" type="text"  class="form-control" style="height: 32px;" maxlength="30">
                        </div>
                    </div>
                </div>
                
            </div>
          
        </div>
    </div>
</div> 



@endsection




