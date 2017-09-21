@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
    <div class='cr_content col-xs-12 '>
        <div class="col-xs-9">
            <h1 class="txt-color-green"><b>Ingreso de Fichas de Verificación...</b></h1>
        </div>
        <div class="col-xs-3" style="margin-top: 5px; padding-right: 23px;">
            <div class="input-group input-group-md">
                <span class="input-group-addon">Año de Tramite <i class="fa fa-cogs"></i></span>
                <div class="icon-addon addon-md">
                    <select id='selantra' class="form-control col-lg-8" style="height: 32px;" onchange="call_list_contrib_carta(0)">
                    @foreach ($anio_tra as $anio)
                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xs-12 cr-body" >
            
            <div class="col-xs-4" style="padding: 0px; margin-top: 5px">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 0px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                <h2>Busqueda de Cartas por Contribuyente</h2>
                        </header>
                    </div>
                </section>
            </div>
            <div class="col-xs-8" style="padding: 0px; margin-top: 5px">
                
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Contribuyente &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_contri_hidden" type="hidden" value="0">
                            <input id="dlg_contri" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 102% !important" autofocus="focus" >
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="fn_bus_contrib_carta('dlg_contri')">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                
            </div>
            
            <div class="col-xs-12"></div>
            <div class="col-xs-4" style="padding: 0px; margin-top: 5px">
                <div>
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px; padding: 0px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                <h2>Busqueda Por Número Carta de Requerimiento</h2>
                        </header>
                    </div>
                </section>
                </div>
            </div>
            <div class="col-xs-8" style="padding: 0px; margin-top: 5px">
                <div class="col-xs-10" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Número Carta Requerimiento &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div class=""  >
                            <input id="dlg_bus_num" type="text"  class="form-control" style="height: 32px; " maxlength="7" onkeypress="return soloNumeroTab(event);" >
                        </div>
                    </div>
                </div>
                <div class='col-lg-2'style="padding: 0px;" >
                    <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="call_list_contrib_carta(3)">
                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                    </button>
                </div>
            </div>
            <div class="col-xs-12"></div>
            <div class="col-xs-4" style="padding: 0px; margin-top: 5px">
                <div>
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px; padding: 0px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                <h2>Busqueda de Carta Por Fechas</h2>
                        </header>
                    </div>
                </section>
                </div>
            </div>
            <div class="col-xs-8" style="padding: 0px; margin-top: 5px">
                <div class="col-xs-5" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Desde &nbsp;<i class="fa fa-calendar"></i></span>
                        <div class=""  >
                            <input id="dlg_bus_fini" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
                <div class="col-xs-5" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Hasta &nbsp;<i class="fa fa-calendar"></i></span>
                        <div class=""  >
                            <input id="dlg_bus_ffin" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
                <div class='col-lg-2'style="padding: 0px;" >
                    <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="call_list_contrib_carta(2)">
                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class='cr_content col-xs-12'>
       
        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
            <article class="col-xs-12" style=" padding: 0px !important">
                <table id="table_cartas" class="col-xs-12"></table>
                    <div id="pager_table_cartas"></div>
            </article>
        </div>
    </div>
    
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function (){
        $("#menu_fisca").show();
        $("#li_ficha_ver").addClass('cr-active')
        jQuery("#table_cartas").jqGrid({
            url: 'trae_cartas/'+$("#selantra").val()+'/0/0/0/0',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_car', 'Nro', 'contribuyente', 'Registro','Fiscalizacion','Estado','Ver','Ingresar Ficha'],
            rowNum: 20, sortname: 'id_car', sortorder: 'desc', viewrecords: true, caption: 'Cartas de Requerimiento', align: "center",
            colModel: [
                {name: 'id_car', index: 'id_gen_fis', hidden: true},
                {name: 'nro_car', index: 'nro_car', align: 'center', width: 5},
                {name: 'contribuyente', index: 'contribuyente', align: 'center', width: 30},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 8},
                {name: 'fec_fis', index: 'fec_fis', align: 'center', width: 15},
                {name: 'flg_est', index: 'flg_est', align: 'center', width: 10},
                {name: 'ver', index: 'ver', align: 'center', width: 8},
                {name: 'fis', index: 'fis', align: 'center', width: 10},
            ],
            pager: '#pager_table_cartas',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_cartas').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_cartas').jqGrid('getDataIDs')[0];
                            $("#table_cartas").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        contrib_global=0;
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers','codigo','DNI/RUC','contribuyente','Dom Fiscal'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center',width: 100},
                {name: 'nro_doc', index: 'nro_doc', align: 'center',width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left',width: 260},
                {name: 'dom_fiscal', index: 'dom_fiscal', align: 'left',width: 260},
                
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                            $("#table_contrib").setSelection(firstid);    
                        }
                    if(contrib_global==0)
                    {   contrib_global=1;    
                        jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list_carta(rowid);} } ); 
                    }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){fn_bus_contrib_list(Id)}
        });
        jQuery("#table_predios_contri").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pred_anio','codigo','Ubicaciób'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Predios a Fiscalizar', align: "center",
            colModel: [
                {name: 'id_pred_anio', index: 'id_pred_anio', hidden: true},
                {name: 'cod_cat', index: 'cod_cat', align: 'center',width: 100},
                {name: 'dir', index: 'dir', align: 'left',width: 400},
                
            ],
            pager: '#pager_table_predios_contri',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_predios_contri').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_predios_contri').jqGrid('getDataIDs')[0];
                            $("#table_predios_contri").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        
        
        
        var globalvalidador=0;
        $("#dlg_contri").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_bus_contrib_carta("dlg_contri");
                    globalvalidador=1;
                }
                else
                {
                    globalvalidador=0;
                }
                
            }
        });
        $("#dlg_contri_carta").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_bus_contrib_carta("dlg_contri_carta");
                    globalvalidador=1;
                }
                else
                {
                    globalvalidador=0;
                }
            }
        });
        $("#dlg_bus_num").keypress(function (e) {
            if (e.which == 13) {
                call_list_contrib_carta(3);
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/fiscalizacion/ficha_ver.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div> 
<div id="dlg_vista_carta" style="display: none;">
    
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" style="padding-left: 0px;padding-right: 10px;" >
            <div class="col-xs-6" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>Información Carta de Requerimiento::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-12" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">N° Carta Requerimiento. &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div class=""  >
                            <input id="dlg_nro_car" type="text"  class="form-control" style="height: 32px; " disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Contribuyente &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_contri_carta" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 100% !important" disabled="" >
                        </div>
                       
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Domicilio Fiscal &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_contri_carta_dom" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Fecha Fiscalización &nbsp;<i class="fa fa-calendar"></i></span>
                        <div>
                            <input id="dlg_fec_fis" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Hora Fiscalización &nbsp;<i class="fa fa-clock-o"></i></span>
                        <div>
                            <input id="dlg_hor_fis" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6" style="padding: 0px; margin-top: 0px;">
                <article class="col-xs-12" style=" padding-left: 0px !important">
                    <table id="table_predios_contri"></table>
                    <div id="pager_table_predios_contri"></div>
                </article>
            </div>

          
        </div>
    </div>
</div> 



@endsection




