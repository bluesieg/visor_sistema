@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
    <div class='cr_content col-xs-12 ' style="padding-bottom: 5px;">
        <h1 class="txt-color-green" style="margin-bottom: 0px;"><b>Arbítrios Municipales...</b></h1>

        <div class="col-xs-12 cr-body" style="margin-top: 10px;">
            <label class="control-label col-lg-2">Código Contribuyente:</label>
            <div class='col-lg-2'>
                <input id="dlg_contri_hidden" type="hidden" value="0">
                <input id="dlg_dni" type="text"  class="form-control" >
            </div>
            <label class="control-label col-lg-1">Periodo:</label>
            <div class='col-lg-2'>
                <select id='selantra' class="form-control col-lg-8" onchange="callfilltab()">
                @foreach ($anio_tra as $anio)
                <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                @endforeach
                </select>
            </div>
            <div class="col-xs-12" style="margin-bottom: 5px;"></div>
            <label class="control-label col-lg-2">Contribuyente:</label>
            <div class='col-lg-7' style="padding-right: 0px;">
                <input id="dlg_contri" type="text"  class="form-control" style="height: 32px;" autofocus="focus" >
            </div>
            <div class='col-lg-3' style="padding: 0px;">
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="fn_bus_contrib()">
                    <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                </button>
            </div>
        </div>
    </div>
    <div class='cr_content col-xs-12'>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:0px; padding: 0px !important">
            <table id="table_predios"></table>
            <div id="pager_table_predios"></div>
        </article>
        <div class="col-xs-12" style="padding: 0px; margin-top: 5px;">
            <ul style="padding: 0px;">                                        
                        <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="new_arb();">
                            <span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Crear Arbítrio
                        </button>
            </ul>
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:0px; padding: 0px !important">
            <table id="table_arbitrios"></table>
            <div id="pager_table_arbitrios"></div>
        </article>
    </div>
</section>

@section('page-js-script')
<script type="text/javascript">
    
    $(document).ready(function (){
        $("#menu_admtri").show();
        $("#li_arbmun").addClass('cr-active')
        jQuery("#table_predios").jqGrid({
            url: 'gridpredio?mnza=0&ctr=0&tpre=0',
            datatype: 'json', mtype: 'GET',
            height: '100px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pred','t_pred', 'Lote Cat', 'Código Predial', 'Mz Dist', 'Lt Dist', 'N° Munic', 'Est. Construcción', 'Contribuyente o Razon Social', 'Calle/Vía','A.Terreno','id_via','S/.Terreno','S/.Construct'],
            rowNum: 20, sortname: 'id_pred', sortorder: 'desc', viewrecords: true, caption: 'Lista De Predios Urbanos', align: "center",
            colModel: [
                {name: 'id_pred', index: 'id_pred', hidden: true},
                {name: 'tp', index: 'tp', align: 'center', width: 50},
                {name: 'lote', index: 'lote', align: 'center', width: 50},
                {name: 'cod_cat', index: 'cod_cat', align: 'center', width: 80},
                {name: 'mzna_dist', index: 'mzna_dist', align: 'center', width: 40},
                {name: 'lote_dist', index: 'lote_dist', align: 'center', width: 40},
                {name: 'nro_mun', index: 'nro_mun', width: 40,align: "right"},
                {name: 'descripcion', index: 'descripcion', width: 100},
                {name: 'contribuyente', index: 'contribuyente', width: 150},
                {name: 'nom_via', index: 'nom_via', width: 100},
                {name: 'id_via', index: 'id_via', hidden: true},
                {name: 'are_terr', index: 'are_terr', width: 60,align: "right"},
                {name: 'val_ter', index: 'val_ter', width: 60,align: "right"},
                {name: 'val_const', index: 'val_const', width: 60, align: "right"},
               
            ],
            pager: '#pager_table_predios',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_predios').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_predios').jqGrid('getDataIDs')[0];
                            $("#table_predios").setSelection(firstid); 
                            llenararbitrios();
                        }
                },
            onSelectRow: function (Id){llenararbitrios();},
            ondblClickRow: function (Id){new_arb();}
        });
        jQuery("#table_arbitrios").jqGrid({
            url: 'gridarbitrios?pre=0&an=0',
            datatype: 'json', mtype: 'GET',
            height: '50px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_arb','Cod. Predio', 'Año', 'Frec. Barrido', 'Costo Barrido','Frecu. Recojo Residuos',
                'Costo Recojo Residuos','Cat. Parques y Jadines',
            'Costo Parq. y Jard.','Cat. Serenazgo','Costo Serenazgo'],
            rowNum: 20, sortname: 'id_pred', sortorder: 'desc', viewrecords: true, caption: 'Lista De Predios Urbanos', align: "center",
            colModel: [
                {name: 'id_arb', index: 'id_arb', hidden: true},
                {name: 'cod_cat', index: 'cod_cat', align: 'center', width: 50},
                {name: 'anio', index: 'anio', align: 'center', width: 50},
                {name: 'frecu_bar', index: 'frecu_bar', align: 'center', width: 50},
                {name: 'cos_bar', index: 'cos_bar', align: 'center', width: 50},
                {name: 'frecu_rrs', index: 'frecu_rrs', align: 'center', width: 50},
                {name: 'cos_rrs', index: 'cos_rrs', align: 'center', width: 50},
                {name: 'par_cat_des', index: 'par_cat_des', align: 'center', width: 50},
                {name: 'cos_jar', index: 'cos_jar', align: 'center', width: 50},
                {name: 'des_cat_seren', index: 'des_cat_seren', align: 'center', width: 50},
                {name: 'cos_seren', index: 'cos_seren', align: 'center', width: 50},
            ],
            pager: '#pager_table_arbitrios',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_arbitrios').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_arbitrios').jqGrid('getDataIDs')[0];
                            $("#table_arbitrios").setSelection(firstid); 
                        }
                        
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){new_arb();}
        });
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers','codigo','DNI/RUC','contribuyente'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center',width: 100},
                {name: 'nro_doc', index: 'nro_doc', align: 'center',width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left',width: 260},
                
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                            $("#table_contrib").setSelection(firstid);    
                        }
                    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list(rowid);} } ); 
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){fn_bus_contrib_list(Id)}
        });
        $("#dlg_dni").keypress(function (e) {
            if (e.which == 13) {
                traer_contri_cod("dlg_contri",$("#dlg_dni").val());
            }
        });
        var globalvalidador=0;
        $("#dlg_contri").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_bus_contrib();
                    globalvalidador=1;
                }
                else
                {
                    globalvalidador=0;
                }
                
            }
        });
       
        
    });
    
</script>
@stop
<script src="{{ asset('archivos_js/adm_tributaria/arbitrios.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div> 
<div id="dlg_new_arbi" style="display: none;">
    <input type="hidden" id="inp_hidd_arb" value="0" />
    <div class="jarviswidget jarviswidget-color-green" id="wid-id-10" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
        <header>
                <span class="widget-icon"> <i class="fa fa-list-alt"></i> </span>
                <h2>Lista de Arbítrios </h2>
        </header>
        <!-- widget div-->
        <div>
            <!-- widget content -->
            <div class="widget-body no-padding">
                <div class="panel-group smart-accordion-default" id="accordion-2">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseOne-1"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> (1) Barrido de Calles </a></h4>
                        </div>
                        <div id="collapseOne-1" class="panel-collapse collapse in cr_toogle">
                            <div class="panel-body" >
                            <div class="col-xs-2" style="padding: 0px">
                                <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Frentera(m)</label>
                                <label class="input col-xs-12">
                                    <input id="inp_bar_frent" type="text"  class="form-control text-align-right" onkeypress="return soloNumeroTab(event);" onkeyup="calculos(1)" placeholder="Metros de frentera" >
                                </label>
                            </div>
                            <div class="col-xs-2" style="padding: 0px">
                                <label class="label col-xs-12 text-align-left" >Frecuencia:</label> 
                                <select id="sel_bar_frecu"  class="form-control" onchange="change_select('sel_bar_frecu',1)">
                                    <option value="0" costo="0">-- Seleccione --</option>
                                    @foreach ($barrido as $bar)
                                    <option value='{{$bar->id_bar_cal}}' costo="{{$bar->costo}}" >{{$bar->frecuencia}}-Veces por Semana</option>
                                    @endforeach          
                                </select>
                            </div>
                            
                            <div class="col-xs-2" style="padding: 0px">
                                <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Anual por metro</label>
                                <label class="input col-xs-12">
                                    <input id="sel_bar_frecu_cos" type="text"  class="form-control text-align-right" disabled="" >
                                </label>
                            </div>
                            <div class="col-xs-2" style="padding: 0px" >
                                <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Anual Total</label>
                                <label class="input col-xs-12">
                                    <input id="inp_bar_costot" type="text"  class="form-control text-align-right" disabled="" >
                                </label>
                            </div>
                            <div class="col-xs-2" style="padding: 0px" >
                                <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Trimestral Total</label>
                                <label class="input col-xs-12">
                                    <input id="inp_bar_costri" type="text"  class="form-control text-align-right" disabled="" >
                                </label>
                            </div>
                            <div class="col-xs-2" style="padding: 0px" >
                                <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Mensual Total</label>
                                <label class="input col-xs-12">
                                    <input id="inp_bar_cosmes" type="text"  class="form-control text-align-right" disabled="" >
                                </label>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> (2) Recojo de Residuos Sólidos </a></h4>
                        </div>
                        <div id="collapseTwo-1" class="panel-collapse collapse cr_toogle">
                            <div class="panel-body">
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Tipo de Predio</label>
                                    
                                    <select id="sel_ressol_tp"  class="form-control" onchange="call_frec_rrs(0);">
                                        <option value="0" costo="0">-- Seleccione --</option>
                                        @foreach ($upa as $upa)
                                            <option value='{{$upa->id_uso_arb}}' >{{$upa->uso_arbitrio}}</option>
                                        @endforeach         
                                    </select>
                                </div>
                                <div class="col-xs-12"></div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Area Construida(m2)</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_ressol_area" type="text"  class="form-control text-align-right"  onkeypress="return soloNumeroTab(event);" disabled="">
                                    </label>
                                </div>
                                <div class="col-xs-2" style="padding: 0px">
                                    <label class="label col-xs-12 text-align-left" >Frecuencia:</label> 
                                    <select id="sel_ressol_frecu"  class="form-control" onchange="change_select('sel_ressol_frecu',2)">
                                        <option value="0" costo="0">-- Seleccione --</option>
                                    </select>
                                </div>
                                <div class="col-xs-2" style="padding: 0px">
                                    <label class="label col-xs-12 text-align-left" >Costo m2:</label> 
                                    <label class="input col-xs-12">
                                        <input id="sel_ressol_frecu_cos" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Anual</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_ressol_costot" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Trimestal</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_ressol_costri" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Mensual</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_ressol_cosmes" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseThree-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> (3) Seguridad Ciudadana </a></h4>
                        </div>
                        <div id="collapseThree-1" class="panel-collapse collapse">
                            <div class="panel-body cr_toogle">
                                <div class="col-xs-2" >
                                    <label class="label col-xs-12 text-align-left" >Categoría:</label> 
                                    <select id="sel_seren_cat"  class="form-control" onchange="change_select('sel_seren_cat',3)">
                                        <option value="0" costo="0">-- Seleccione --</option>
                                        @foreach ($seren as $ser)
                                        <option value='{{$ser->id_seren}}' costo="{{$ser->costo}}" >{{$ser->categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Anual</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_seren_costot" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Trimestral</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_seren_costri" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Mensual</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_seren_cosmes" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseFour-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> (4) Parques y Jardines </a></h4>
                        </div>
                        <div id="collapseFour-1" class="panel-collapse collapse">
                            <div class="panel-body cr_toogle">
                                <div class="col-xs-2" >
                                    <label class="label col-xs-12 text-align-left" >Categoría:</label> 
                                    <select id="sel_parq_cat"  class="form-control" onchange="change_select('sel_parq_cat',4)">
                                        <option value="0" costo="0">-- Seleccione --</option>
                                        @foreach ($parjar as $par)
                                        <option value='{{$par->id_par_jar}}' costo="{{$par->costo}}" >{{$par->categoria}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Anual</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_parq_costot" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Trimestral</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_parq_costri" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                                <div class="col-xs-2" style="padding: 0px" >
                                    <label class="label col-xs-12 text-align-left" style="padding-left: 15px;">Costo Total Mensual</label>
                                    <label class="input col-xs-12">
                                        <input id="inp_parq_mes" type="text"  class="form-control text-align-right" disabled="" >
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end widget content -->
        </div>
        <!-- end widget div -->
     </div>
    <div class="col-xs-12 text-align-right" style="padding: 0px; margin-top: 5px;">
        <ul style="padding: 0px;">                                        
            <button id="btnsavearb" type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="savearb()">
                <span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Grabar Arbítrios
            </button>
            <button id="btnupdatearb" type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="updatearb()">
                <span class="btn-label"><i class="glyphicon glyphicon-new-window"></i></span>Modificar Arbítrios
            </button>
        </ul>
    </div>
</div> 
@endsection




