@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Tributos...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-6 text-left">
                                <label>Filtro Año:</label>
                                <select id="vw_trib_anio"  class="input-sm">
                                    @foreach ($anio as $anio)
                                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                    @endforeach
                                </select><i></i>
                            </div>
                            <button 
                                @if($permisos[0]->btn_new==1) onclick="dlg_tributos();"  @else onclick="sin_permiso();" @endif
                                 type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                            </button>
                            <button 
                                @if($permisos[0]->btn_edit==1) onclick="up_dlg_tributos();"  @else onclick="sin_permiso();" @endif
                                 type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                            </button>
                            <button 
                                @if($permisos[0]->btn_del==1) onclick="del_tributo();"  @else onclick="sin_permiso();" @endif
                                 type="button" class="btn btn-labeled btn-danger">
                                <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                            </button>
                        </div>                        
                    </div>
                </div> 
            </div>
            <div class="well well-sm well-light" style="margin-top:-20px;">                
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="row">
                            <section id="content_2" class="col-lg-12">
                                <table id="table_Procedimiento"></table>
                                <div id="p_table_Procedimiento"></div>
                            </section>
                            <section id="content_2" class="col-lg-12" style="margin-top: 5px">
                                <table id="table_Tributos"></table>
                                <div id="p_table_Tributos"></div>
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
    $("#menu_presupuesto").show();
    $("#li_pres_trib").addClass('cr-active');
    MensajeDialogLoadAjax('content','Cargando');
    jQuery("#table_Procedimiento").jqGrid({
        url: 'get_procedimientos?anio='+$("#vw_trib_anio").val(),
        datatype: 'json', mtype: 'GET',
        height: 125, autowidth: true,
        toolbarfilter: true,
        colNames: ['Codigo', 'Descripción - Procedimiento','id_esp_det','desc','id_ofi','nombre'],
        rowNum: 15, sortname: 'id_proced', sortorder: 'asc', viewrecords: true, caption: 'Procedimientos', align: "center",
        colModel: [            
            {name: 'cod_proc', index: 'cod_proc', align: 'center', width: 50},
            {name: 'desc_proc', index: 'desc_proc', align: 'left', width: 300},
            {name: 'id_espec_det', index: 'id_espec_det', hidden:true},
            {name: 'desc_espec_detalle', index: 'desc_espec_detalle', hidden:true},
            {name: 'id_ofic', index: 'id_ofic', hidden:true},
            {name: 'nombre', index: 'nombre', hidden:true},
        ],
        pager: '#p_table_Procedimiento',
        rowList: [15, 20],
        gridComplete: function () {
            var idarray = jQuery('#table_Procedimiento').jqGrid('getDataIDs');
            if (idarray.length > 0) {
                var firstid = jQuery('#table_Procedimiento').jqGrid('getDataIDs')[0];
                $("#table_Procedimiento").setSelection(firstid);
            }
        },
        onSelectRow: function (Id) {fn_actualizar_grilla('table_Tributos','get_tributos?anio='+$("#vw_trib_anio").val()+'&id_proced='+Id);}
    });
    
    setTimeout(function(){ 
        id_proced = $('#table_Procedimiento').jqGrid ('getGridParam', 'selrow');
        jQuery("#table_Tributos").jqGrid({
            url: 'get_tributos?anio='+$("#vw_trib_anio").val()+'&id_proced='+id_proced,
            datatype: 'json', mtype: 'GET',
            height: 150, autowidth: true,
            toolbarfilter: true,
            colNames: ['Codigo', 'Descripción - Tributo','Soles S/.'],
            rowNum: 15, sortname: 'id_tributo', sortorder: 'asc', viewrecords: true, caption: 'Tributos', align: "center",
            colModel: [            
                {name: 'cod_tributo', index: 'cod_tributo', align: 'center', width: 50},
                {name: 'descrip_tributo', index: 'descrip_tributo', align: 'left', width: 300},
                {name: 'soles', index: 'soles', align: 'right', width: 40}
            ],
            pager: '#p_table_Tributos',
            rowList: [15, 20],
            gridComplete: function () {
                var idarray = jQuery('#table_Tributos').jqGrid('getDataIDs');
                if (idarray.length > 0) {
                    var firstid = jQuery('#table_Tributos').jqGrid('getDataIDs')[0];
                    $("#table_Tributos").setSelection(firstid);
                }
            },
            ondblClickRow: function (Id) {            
                perms = {!! json_encode($permisos[0]->btn_edit) !!};
                if(perms==1){
                    up_dlg_tributos();
                }else sin_permiso();
            }
        });
        MensajeDialogLoadAjaxFinish('content');
    }, 500);
    $(window).on('resize.jqGrid', function () {
        $("#table_Procedimiento").jqGrid('setGridWidth', $("#content_2").width());
        $("#table_Tributos").jqGrid('setGridWidth', $("#content_2").width());
    });
});
</script>
@stop
<script src="{{ asset('archivos_js/presupuesto/tributos.js') }}"></script>
<div id="dlg_tributo" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important">                    
                    <div class="panel-body cr-body">
                        <fieldset>
                            <section>
                                <label class="label">Descripción:</label>
                                <label class="input textarea">                                    
                                    <textarea rows="2" id="trib_des" placeholder="Descripción" class="input-sm text-uppercase"></textarea>
                                </label>                      
                            </section>
                            <section class="col-2">
                                <label class="label">Monto S/.:</label>
                                <label class="input textarea">                                    
                                    <input type="text" id="trib_monto" class="input-sm" placeholder="0.00" onkeypress="return soloNumeroTab(event);">
                                </label>                      
                            </section>
                        </fieldset>
                    </div>
                </div>               
            </div>
        </div>
    </div>
</div>
@endsection
