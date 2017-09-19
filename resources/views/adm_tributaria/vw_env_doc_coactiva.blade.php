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
                <h1 class="txt-color-green"><b>Envio de OP a Ejecucion Coactiva...</b></h1>
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
                                                        <input type="radio" onchange="radio_click(this.value)" name="myradio" id="env_doc_chek2" value="1" checked="checked">
                                                        <i class="vl_check"  data-swchon-text="ON" data-swchoff-text="OFF"></i></label>
                                                </div>                                                
                                        </header>                                    
                                    </div>
                                </section>
                                <section class="col-lg-4" style="padding-right:5px;padding-left: 3px">
                                    <div class="input-group">
                                        <span class="input-group-addon">Desde<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_env_doc_fdesde" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-addon">Hasta<i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                                        <input placeholder="dd/mm/aaaa" id="vw_env_doc_fhasta" class="form-control datepicker" data-dateformat='dd/mm/yy' value="{{date('d/m/Y')}}" maxlength="10">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" id="vw_env_doc_btn1" type="button" onclick="fn_up_grid();" title="BUSCAR">
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
                                                        <input type="radio" onchange="radio_click(this.value)" name="myradio" id="env_doc_chek3" value="2">
                                                        <i class="vl_check"  data-swchon-text="ON" data-swchoff-text="OFF"></i></label>
                                                </div>
                                        </header>                                    
                                    </div>
                                </section>
                                <section class="col-lg-3" style="padding-left:3px;padding-right: 3px">                                            
                                    <div class="input-group">
                                        <span class="input-group-addon">Del</span>
                                        <input class="form-control" id="vw_env_doc_nrode" type="text" disabled="">
                                        <span class="input-group-addon">Al</span>
                                        <input class="form-control" id="vw_env_doc_nroa" type="text" disabled="">
                                        <span class="input-group-btn">
                                            <button class="btn btn-success" id="vw_env_doc_btn2" type="button" onclick="fn_up_grid();" title="BUSCAR" disabled="">
                                                <i class="glyphicon glyphicon-search"></i>&nbsp;Buscar
                                            </button>
                                        </span>
                                    </div>                                            
                                </section>
                                <section class="col-lg-1 text-right" style="padding-left:3px">
                                    <a onclick="print_op();" class="btn btn-labeled bg-color-magenta txt-color-white"> <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir</a>
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
                                    <h2>RECAUDACION</h2>
                            </header>                                    
                        </div>                       
                        <table id="tabla_Doc_OP"></table>
                        <div id="p_tabla_Doc_OP"></div>
                    </section>
                    <section class="col-lg-1 text-align-center" style="padding-right:0px;padding-left: 0px;">
                        <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 15px;"  >
                            <header style="background: #01a858 !important;color: white" >
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>Botones</h2>
                            </header>                                    
                        </div>
                        <a onclick="all_right();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-double-right"></i></a>
                        <br><br>
                        <a onclick="right();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-right"></i></a>
                        <br><br>
                        <a onclick="left();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-left"></i></a>
                        <br><br>
                        <a onclick="all_left();" class="btn btn-default btn-circle btn-lg"><i class="fa fa-angle-double-left"></i></a>
                    </section>
                    <section class="col-lg-6" id="content_3" style="padding-left: 5px;">
                       <div class="jarviswidget jarviswidget-color-white" style="margin-bottom: 0px;"  >
                            <header style="background: #01a858 !important;color: white" >
                                    <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                    <h2>COACTIVA</h2>
                            </header>                                    
                        </div>
                        <table id="tabla_Doc_OP_2"></table>
                        <div id="p_tabla_Doc_OP_2"></div>
                    </section>
                </div> 
            </div>
        </div>       
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_admtri").show();
        $("#li_env_doc_a_coac").addClass('cr-active');
        jQuery("#tabla_Doc_OP").jqGrid({
            url: 'recaudacion_get_op?env_op=1&tip_bus='+$("input:radio[name='myradio']:checked").val()+
                    '&desde='+$("#vw_env_doc_fdesde").val()+'&hasta='+$("#vw_env_doc_fhasta").val()+
                    '&del=0&al=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gen_fis', 'Nro', 'Fecha','Hora', 'Año','N° Documento', 'Contribuyente o Razon Social','estado','verif','Monto S/.'],
            rowNum: 15, sortname: 'id_gen_fis', sortorder: 'desc', viewrecords: true, align: "center",
            colModel: [
                {name: 'id_gen_fis', index: 'id_gen_fis', hidden: true},
                {name: 'nro_fis', index: 'nro_fis', align: 'center', width: 70},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 75},
                {name: 'hora', index: 'hora', hidden:true},
                {name: 'anio', index: 'anio', hidden: true},
                {name: 'nro_doc', index: 'nro_doc',hidden: true},                
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'estado', index: 'estado', hidden: true},
                {name: 'verif_env', index: 'verif_env', hidden: true},
                {name: 'monto', index: 'monto', width: 85,align:'center'}
            ],
            pager: '#p_tabla_Doc_OP',
            rowList: [15, 20],
            gridComplete: function () {},
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#tabla_Doc_OP_2").jqGrid({
            url: 'recaudacion_get_op?env_op=2&tip_bus='+$("input:radio[name='myradio']:checked").val()+
                    '&desde='+$("#vw_env_doc_fdesde").val()+'&hasta='+$("#vw_env_doc_fhasta").val()+'&grid=2',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_gen_fis', 'Nro', 'Fecha','Hora', 'Año','N° Documento', 'Contribuyente o Razon Social','estado','verif','Monto S/.'],
            rowNum: 15, sortname: 'id_gen_fis', sortorder: 'desc', viewrecords: true, align: "center",
            colModel: [
                {name: 'id_gen_fis', index: 'id_gen_fis', hidden: true},
                {name: 'nro_fis', index: 'nro_fis', align: 'center', width: 70},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 75},
                {name: 'hora', index: 'hora', width: 70,align:'center'},
                {name: 'anio', index: 'anio', hidden: true},
                {name: 'nro_doc', index: 'nro_doc',hidden: true},                
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250},
                {name: 'estado', index: 'estado', hidden: true},
                {name: 'verif_env', index: 'verif_env', hidden: true},
                {name: 'monto', index: 'monto', width: 85,align:'center'}                
            ],
            pager: '#p_tabla_Doc_OP_2',
            rowList: [15, 20],
            gridComplete: function () {},
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_Doc_OP").jqGrid('setGridWidth', $("#content_2").width());
        });
        $(window).on('resize.jqGrid', function () {
            $("#tabla_Doc_OP_2").jqGrid('setGridWidth', $("#content_3").width());
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
        $("#vw_env_doc_contrib").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0){
                    fn_bus_contrib_env_doc();
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
<script src="{{ asset('archivos_js/adm_tributaria/envio_doc_coactiva.js') }}"></script>
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
