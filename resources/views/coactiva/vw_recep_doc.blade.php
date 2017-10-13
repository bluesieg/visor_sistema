@extends('layouts.app')
@section('content')
<style>
    .icon-addon .form-control, .icon-addon.addon-md .form-control {
        padding-left: 10px; 
    }
    .vl_check{
        background: white !important;
        margin-top: 3px;
        margin-right: 5px;
    }
</style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Recepcion de Documentos...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">
                            <div class="row">
                                <section class="col-lg-3" style="padding-right:5px">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >                                
                                        <header style="background: #01a858 !important;color: white; padding-right: 15px !important" >
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>TIPO DE DOCUMENTO</h2>
                                        </header>
                                    </div>                                   
                                </section>
                                <section class="col-lg-3" style="padding-left:5px; padding-right: 5px">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                                        <header style="background: #01a858 !important;color: white; padding-right: 15px !important" >
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>FILTRAR POR NUMERO</h2>
                                            <div class="smart-form">
                                                <label class="toggle">
                                                    <input type="radio" onchange="radio_click_resep_doc(this.value)" name="myradio_resep_doc" value="2" checked="checked">
                                                    <i class="vl_check"  data-swchon-text="ON" data-swchoff-text="OFF"></i></label>
                                            </div>
                                        </header>
                                    </div>                                    
                                </section>                                
                                <section class="col-lg-5" style="padding-left:5px;">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon">Del <i class="icon-append fa fa-hashtag" style="margin-left: 5px;"></i></span>
                                        <input class="form-control" id="vw_resep_doc_nrode" type="text" disabled="">
                                        <span class="input-group-addon">Al <i class="icon-append fa fa-hashtag" style="margin-left: 5px;"></i></span>
                                        <input class="form-control" id="vw_resep_doc_nroa" type="text" disabled="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" id="vw_resep_doc_btn2" type="button" onclick="up_resep_doc(2);" title="BUSCAR" disabled="">
                                                <i class="glyphicon glyphicon-search"></i>&nbsp;Buscar
                                            </button>
                                        </span>
                                    </div>                                            
                                </section>
                            </div>                    
                            <div class="row" style="margin-top: 7px">
                                <section class="col-lg-3" style="padding-right: 5px;">
                                    <div class="input-group input-group-md">
                                        <span class="input-group-addon">Documento<i class="icon-append fa fa-file-text" style="margin-left: 5px;"></i></span>
                                        <div class="icon-addon addon-md">
                                            <select id="vw_recep_doc_tip_doc" class="form-control">
                                                <option value="2">(OP) Orden de Pago</option>
                                                <option value="1">(RD) Res. de Determin.</option>
                                            </select>
                                        </div>
                                    </div>
                                </section>
                                <section class="col-lg-3" style="padding-left:5px;padding-right: 5px;">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                                        <header style="background: #01a858 !important;color: white; padding-right: 15px !important" >
                                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                            <h2>FILTRAR POR FECHA</h2>
                                            <div class="smart-form">
                                                <label class="toggle">
                                                    <input type="radio" onchange="radio_click_resep_doc(this.value)" name="myradio_resep_doc" value="1" checked="checked">
                                                    <i class="vl_check"  data-swchon-text="ON" data-swchoff-text="OFF"></i></label>
                                            </div>
                                        </header>
                                    </div>                                    
                                </section>
                                <section class="col-lg-5" style="padding-left: 5px">
                                    <div class="input-group">
                                        <span class="input-group-addon">Desde<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_resep_doc_fdesde" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-addon">Hasta<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_resep_doc_fhasta" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" id="vw_resep_doc_btn1" type="button" onclick="up_resep_doc(1);" title="BUSCAR">
                                                <i class="glyphicon glyphicon-search"></i>&nbsp;Buscar
                                            </button>
                                        </span>
                                    </div>
                                </section>                                
                            </div>                            
                        </div>                        
                    </div>
                </div> 
            </div>
            <div class="well well-sm well-light" style="margin-top:-20px;">                
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="row">
                            <section id="content_2" class="col col-lg-10" style="padding-right:5px">
                                <table id="t_recep_doc"></table>
                                <div id="p_t_recep_doc"></div>
                            </section>
                            <section class="col col-lg-2" style="padding-left:5px"> 
                                <div style="background: #eee !important;padding:0px 7px; border: 1px solid #DDD;border-radius: 3px;margin-bottom: 8px;">
                                    <form class="smart-form">
                                        <label class="toggle" >
                                            <input type="checkbox" onclick="check_all_resep_doc();" id="chk_sel_todo_doc" disabled="">
                                            <i data-swchon-text="ON" data-swchoff-text="OFF"></i>Check Todo</label>
                                    </form>
                                </div>
                                <button class="btn bg-color-green txt-color-white cr-btn-big" onclick="recibir_doc();" >
                                    <span>
                                        <i class="glyphicon glyphicon-check"></i>
                                    </span>
                                    <label>Recibir Doc.</label>
                                </button>                                                                                             
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
        $("#menu_coactiva").show();
        $("#li_recep_doc").addClass('cr-active');
        tip_bus=$("input:radio[name='myradio_resep_doc']:checked").val();
        jQuery("#t_recep_doc").jqGrid({
            url: 'coactiva_recep_doc?tip_doc=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_contrib', 'Nro', 'Fecha','Hora', 'Año','N° Documento', 'Contribuyente o Razon Social','estado','verif','Monto S/.','Recibir'],
            rowNum: 15, sortname: 'id_gen_fis', sortorder: 'desc', viewrecords: true, caption:'Documentos Enviados', align: "center",
            colModel: [
                {name: 'id_contrib', index: 'id_contrib', hidden: true},
                {name: 'nro_fis', index: 'nro_fis', align: 'center', width: 80},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 60},
                {name: 'hora', index: 'hora', align: 'center', width: 60},
                {name: 'anio', index: 'anio', hidden: true},
                {name: 'nro_doc', index: 'nro_doc',hidden: true},                
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'estado', index: 'estado', hidden: true},
                {name: 'verif_env', index: 'verif_env', hidden: true},
                {name: 'monto', index: 'monto', width: 85,align:'center'},
                {name: 'recibir', index: 'recibir', width: 60,align:'center'}
            ],
            pager: '#p_t_recep_doc',
            rowList: [15, 20],
            gridComplete: function () {
                var idarray = jQuery('#t_recep_doc').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                        var firstid = jQuery('#t_recep_doc').jqGrid('getDataIDs')[0];
                        $("#t_recep_doc").setSelection(firstid);
                        $("#chk_sel_todo_doc").attr('disabled',false);    
                    }else{
                        $("#chk_sel_todo_doc").attr('disabled',true);
                    }
            },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        $(window).on('resize.jqGrid', function () {
            $("#t_recep_doc").jqGrid('setGridWidth', $("#content_2").width());
        });
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers', 'codigo', 'DNI/RUC', 'contribuyente'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center', width: 100},
                {name: 'nro_doc', index: 'nro_doc', align: 'center', width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 260}
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                    $("#table_contrib").setSelection(firstid);
                }                
            },
            onSelectRow: function (Id) {},
            ondblClickRow: function (Id) { fn_bus_contrib_list_env_doc(Id);}
        });
        var globalvalidador = 0;
        $("#vw_recep_doc_contrib").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0){
                    fn_bus_contrib_recep_doc();
                    $("#chk_sel_todo_doc").removeAttr('disabled');
                    globalvalidador=1;
                }else{
                    globalvalidador=0;
                }
            }
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/coactiva/resep_doc.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>
<div id="vw_coact_ver_doc" style="display: none;">
    <iframe id="vw_coa_iframe_doc" width="885" height="580"></iframe>
</div>

@endsection

