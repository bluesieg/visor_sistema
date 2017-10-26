@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Procedimientos...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-6 text-left">
                                <label>Filtro Año:</label>
                                <select id="vw_procedim_anio"  class="input-sm">
                                    @foreach ($anio as $anio)
                                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                    @endforeach
                                </select><i></i>
                            </div>
                            <button onclick="dlg_procedimiento();" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                            </button>
                            <button onclick="" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                            </button>
                            <button onclick="" type="button" class="btn btn-labeled btn-danger">
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
    $("#li_pres_proced").addClass('cr-active');
    jQuery("#table_Procedimiento").jqGrid({
        url: 'get_procedimientos?anio='+$("#vw_procedim_anio").val(),
        datatype: 'json', mtype: 'GET',
        height: 'auto', autowidth: true,
        toolbarfilter: true,
        colNames: ['Codigo', 'Descripción - Procedimiento'],
        rowNum: 15, sortname: 'id_proced', sortorder: 'asc', viewrecords: true, caption: 'Procedimientos', align: "center",
        colModel: [            
            {name: 'cod_proc', index: 'cod_proc', align: 'center', width: 50},
            {name: 'desc_proc', index: 'desc_proc', align: 'left', width: 300}            
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
        ondblClickRow: function (Id) {}
    });
    $(window).on('resize.jqGrid', function () {
        $("#table_Procedimiento").jqGrid('setGridWidth', $("#content_2").width());
    });
});
</script>
@stop
<script src="{{ asset('archivos_js/presupuesto/procedimientos.js') }}"></script>
<div id="dlg_proced" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important">                    
                    <div class="panel-body cr-body">
                        <fieldset>
                            <section>
                                <label class="label">Específica Detalle:</label>
                                <label class="input">
                                    <input id="proced_esp_det" type="text" placeholder="Específica Detalle" class="input-sm text-uppercase">
                                </label>                        
                            </section>
                            <section>
                                <label class="label">Oficina:</label>
                                <label class="input">
                                    <input id="proced_ofi" type="text" placeholder="Escriba el nombre de de la oficina" class="input-sm text-uppercase">
                                </label>                        
                            </section>
                            <section>
                                <label class="label">Código:</label>
                                <label class="input">
                                    <input id="proced_cod" onkeypress="return soloDNI(event);" type="text" placeholder="0" class="input-sm" style="width:80px;">
                                </label>                        
                            </section>
                            <section>
                                <label class="label">Descripción:</label>
                                <label class="input">
                                    <input id="proced_desc" type="text" placeholder="Descripción" class="input-sm text-uppercase">
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
