@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
    <div class='cr_content col-xs-12 '>
        <h1 class="txt-color-green"><b>Mantenimiento Parametros de Calculo Alcabala...</b></h1>

        <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Mantenimiento de Deducción</h2>
                    </header>
                </div>
            </section>
            <article class="col-xs-10" style=" padding: 0px !important">
                    <table id="table_deduccion"></table>
                    <div id="pager_table_deduccion"></div>
            </article>
            <div class="col-xs-2">
                <button class="btn bg-color-green txt-color-white cr-btn-big" onclick="fn_new(1);" >
                    <span style="left: -28px;" >
                        <i class="glyphicon glyphicon-plus-sign"></i>
                    </span>
                    <label>Nuevo</label>
                </button>
            </div>
            
            
        </div>
        <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Mantenimiento de Tasas, Porcentajes de Aplicación</h2>
                    </header>
                </div>
            </section>
            <article class="col-xs-10" style=" padding: 0px !important">
                    <table id="table_tasas"></table>
                    <div id="pager_table_tasas"></div>
            </article>
            <div class="col-xs-2">
                <button class="btn bg-color-green txt-color-white cr-btn-big" onclick="fn_new(2)" >
                    <span style="left: -28px;" >
                        <i class="glyphicon glyphicon-plus-sign"></i>
                    </span>
                    <label>Nuevo</label>
                </button>
            </div>
        </div>
    </div>
    
    
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function (){
        $("#menu_alcabala").show();
        $("#li_alcala_conf").addClass('cr-active')
        jQuery("#table_deduccion").jqGrid({
            url: 'grid_deduc',
            datatype: 'json', mtype: 'GET',
            height: '100px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_dec', 'N° UITs', 'Fec.ini', 'Fec.fin','ley', 'Activo'],
            rowNum: 20, sortname: 'id_dec', sortorder: 'desc', viewrecords: true, caption: 'Lista de Deducciones', align: "center",
            colModel: [
                {name: 'id_dec', index: 'id_dec', hidden: true},
                {name: 'nro_uit', index: 'nro_uit', align: 'center', width: 80},
                {name: 'fec_ini', index: 'fec_ini', align: 'center', width: 80},
                {name: 'fec_fin', index: 'fec_fin', align: 'center', width: 80},
                {name: 'act_ley', index: 'act_ley', align: 'center', width: 80},
                {name: 'flg_act', index: 'flg_act', align: 'center', width: 150},
            ],
            pager: '#pager_table_deduccion',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_deduccion').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_deduccion').jqGrid('getDataIDs')[0];
                            $("#table_deduccion").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#table_tasas").jqGrid({
            url: 'grid_tasas',
            datatype: 'json', mtype: 'GET',
            height: '100px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_tas', 'Porcentaje', 'Fec.ini', 'Fec.fin','ley', 'Activo'],
            rowNum: 20, sortname: 'id_tas', sortorder: 'desc', viewrecords: true, caption: 'Lista de Tasas', align: "center",
            colModel: [
                {name: 'id_tas', index: 'id_tas', hidden: true},
                {name: 'nro_uit', index: 'nro_uit', align: 'center', width: 80},
                {name: 'fec_ini', index: 'fec_ini', align: 'center', width: 80},
                {name: 'fec_fin', index: 'fec_fin', align: 'center', width: 80},
                {name: 'act_ley', index: 'act_ley', align: 'center', width: 80},
                {name: 'flg_act', index: 'flg_act', align: 'center', width: 150},
            ],
            pager: '#pager_table_tasas',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_tasas').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_tasas').jqGrid('getDataIDs')[0];
                            $("#table_tasas").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
       
        
     
        
    });
</script>
@stop
<script src="{{ asset('archivos_js/alcabala/mante_alcabala.js') }}"></script>

<div id="dlg_new_deduc" style="display: none;">
    <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Registrar Nueva Deducción::..</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-3" style="padding: 0px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">N° UITs</span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_nro_uit" type="text"  class="form-control" style="height: 32px; " onkeypress="return soloNumeroTab(event);" >
                    </div>
                    
                </div>
            </div>
            <div class="col-xs-4" style="padding: 0px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Fec.Ini <i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_dedu_fec" type="text" name="request" placeholder="Ingresar Fecha" class="datepicker" data-dateformat='dd/mm/yy' style="height: 32px; padding-left: 5px;">
                     </div>
                    
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Nro Ley o Decreto</span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_dedu_ley" type="text"  class="form-control" style="height: 32px; " maxlength="20">
                    </div>
                    
                </div>
            </div>
            
            
            
        </div>
</div> 
<div id="dlg_new_tasas" style="display: none;">
    <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Registrar Nueva Tasa del impuesto de Alcabala::..</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-3" style="padding: 0px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Porcentaje</span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_tas_por" type="text"  class="form-control" style="height: 32px; " onkeypress="return soloNumeroTab(event);" >
                    </div>
                    
                </div>
            </div>
            <div class="col-xs-4" style="padding: 0px;">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Fec.Ini <i class="icon-append fa fa-calendar" style="margin-left: 5px;"></i></span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_tas_fec" type="text" name="request" placeholder="Ingresar Fecha" class="datepicker" data-dateformat='dd/mm/yy' style="height: 32px; padding-left: 5px;">
                     </div>
                    
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Nro Ley o Decreto</span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_tas_ley" type="text"  class="form-control" style="height: 32px; " maxlength="20">
                    </div>
                    
                </div>
            </div>
            
            
            
        </div>
</div> 




@endsection




