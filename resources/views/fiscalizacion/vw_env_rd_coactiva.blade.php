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
                <h1 class="txt-color-green"><b>Envio de RD a Ejecucion Coactiva...</b></h1>
                <div class="row">
                    <div class="col-xs-12">                       
                        <div class="text-right">
                            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12" style="padding-left:0px">
                                <section class="col-lg-2" style="padding-right: 0px;">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                                        <header style="background: #01a858 !important;color: white" >
                                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                                <h2>FECHA</h2>
                                                <div class="smart-form">
                                                    <label class="toggle">
                                                        <input type="radio" onchange="radio_click_rd(this.value)" name="myradio_rd" value="1" checked="checked">
                                                        <i class="vl_check"  data-swchon-text="ON" data-swchoff-text="OFF"></i></label>
                                                </div>                                                
                                        </header>                                    
                                    </div>
                                </section>
                                <section class="col-lg-5" style="padding-right:5px;padding-left: 3px">
                                    <div class="input-group">
                                        <span class="input-group-addon">Desde<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_env_rd_fdesde" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-addon">Hasta<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_env_rd_fhasta" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" id="vw_env_rd_btn1" type="button" onclick="fn_up_grid_rd();" title="BUSCAR">
                                                <i class="glyphicon glyphicon-search"></i>&nbsp;Buscar
                                            </button>
                                        </span>
                                    </div>                                            
                                </section>
                                <section class="col-lg-2" style="padding-right: 0px;padding-left: 25px">
                                    <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                                        <header style="background: #01a858 !important;color: white" >
                                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                                <h2>NUMERO</h2>
                                                <div class="smart-form">
                                                    <label class="toggle">
                                                        <input type="radio" onchange="radio_click_rd(this.value)" name="myradio_rd" value="2">
                                                        <i class="vl_check"  data-swchon-text="ON" data-swchoff-text="OFF"></i></label>
                                                </div>
                                        </header>                                    
                                    </div>
                                </section>
                                <section class="col-lg-3" style="padding-left:3px;padding-right: 3px">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon">Del</span>
                                        <input class="form-control" id="vw_env_rd_nrode" type="text" disabled="">
                                        <span class="input-group-addon">Al</span>
                                        <input class="form-control" id="vw_env_rd_nroa" type="text" disabled="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" id="vw_env_rd_btn2" type="button" onclick="fn_up_grid_rd();" title="BUSCAR" disabled="">
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
                    <section class="col-lg-5" id="content_2" style="padding-right:5px;">                        
                        <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;">
                            <header style="background: #01a858 !important;color: white" >
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>FISCALIZACION</h2>
                            </header>                                    
                        </div>                       
                        <table id="tabla_Doc_RD"></table>
                        <div id="p_tabla_Doc_RD"></div>
                    </section>
                    <section class="col-lg-1 text-align-center" style="padding-right:0px;padding-left: 0px;">
                        <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 15px;"  >
                            <header style="background: #01a858 !important;color: white" >
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>Botones</h2>
                            </header>                                    
                        </div>
                        <a onclick="rd_all_right();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-double-right"></i></a>
                        <br><br>
                        <a onclick="rd_right();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-right"></i></a>
                        <br><br>
                        <a onclick="rd_left();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-left"></i></a>
                        <br><br>
                        <a onclick="rd_all_left();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-double-left"></i></a>
                    </section>
                    <section class="col-lg-6" id="content_3" style="padding-left: 5px;">
                       <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                            <header style="background: #01a858 !important;color: white" >
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>COACTIVA</h2>
                            </header>                                    
                        </div>
                        <table id="tabla_Doc_RD_2"></table>
                        <div id="p_tabla_Doc_RD_2"></div>
                    </section>
                </div> 
            </div>
        </div>       
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_fisca").show();
        $("#li_env_rd_a_coac").addClass('cr-active');
        jQuery("#tabla_Doc_RD").jqGrid({
            url: 'fisca_get_rd?env_rd=1&tip_bus='+$("input:radio[name='myradio_rd']:checked").val()+
                    '&desde='+$("#vw_env_rd_fdesde").val()+'&hasta='+$("#vw_env_rd_fhasta").val()+
                    '&del=0&al=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['Nro', 'Fecha','Hora', 'Año', 'Contribuyente o Razon Social','estado','verif','Monto S/.'],
            rowNum: 15, sortname: 'id_rd', sortorder: 'desc', viewrecords: true, align: "center",
            colModel: [                
                {name: 'nro_rd', index: 'nro_rd', align: 'center', width: 70},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 75},
                {name: 'hora', index: 'hora', hidden:true},
                {name: 'anio', index: 'anio', hidden: true},                               
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'estado', index: 'estado', hidden: true},
                {name: 'verif_env', index: 'verif_env', hidden: true},
                {name: 'monto', index: 'monto', width: 85,align:'center'}
            ],
            pager: '#p_tabla_Doc_RD',
            rowList: [15, 20],
            gridComplete: function () {}            
        });
        jQuery("#tabla_Doc_RD_2").jqGrid({
            url: 'fisca_get_rd?env_rd=2&tip_bus='+$("input:radio[name='myradio_rd']:checked").val()+
                    '&desde='+$("#vw_env_rd_fdesde").val()+'&hasta='+$("#vw_env_rd_fhasta").val()+'&grid=2',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['Nro', 'Fecha','Hora', 'Año', 'Contribuyente o Razon Social','estado','verif','Monto S/.'],
            rowNum: 15, sortname: 'id_rd', sortorder: 'desc', viewrecords: true, align: "center",
            colModel: [                
                {name: 'nro_rd', index: 'nro_rd', align: 'center', width: 70},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 75},
                {name: 'hora', index: 'hora', width: 70,align:'center'},
                {name: 'anio', index: 'anio', hidden: true},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'estado', index: 'estado', hidden: true},
                {name: 'verif_env', index: 'verif_env', hidden: true},
                {name: 'monto', index: 'monto', width: 85,align:'center'}                
            ],
            pager: '#p_tabla_Doc_RD_2',
            rowList: [15, 20],
            gridComplete: function () {}
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_Doc_RD").jqGrid('setGridWidth', $("#content_2").width());
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_Doc_RD_2").jqGrid('setGridWidth', $("#content_3").width());
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
    });
</script>
@stop
<script src="{{ asset('archivos_js/fiscalizacion/envio_rd_coactiva.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>
<div id="dlg_iframe_op" style="display: none;">
    <iframe id="myIframe_op" width="885" height="580"></iframe>
</div>

@endsection
