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
                                <select id="vw_gen_anio"  class="input-sm">
                                    @foreach ($anio as $anio)
                                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                                    @endforeach
                                </select><i></i>
                            </div>
                            <button onclick="" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
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
                                <table id="table_Generica"></table>
                                <div id="p_table_Generica"></div>
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
    jQuery("#table_Generica").jqGrid({
        url: 'get_generica?anio='+$("#vw_gen_anio").val(),
        datatype: 'json', mtype: 'GET',
        height: 'auto', autowidth: true,
        toolbarfilter: true,
        colNames: ['Codigo', 'Descripción - Genérica'],
        rowNum: 15, sortname: 'id_gener', sortorder: 'asc', viewrecords: true, caption: 'Generica', align: "center",
        colModel: [            
            {name: 'cod_generica', index: 'cod_generica', align: 'center', width: 50},
            {name: 'descr_gen', index: 'descr_gen', align: 'left', width: 300}            
        ],
        pager: '#p_table_Generica',
        rowList: [15, 20],
        gridComplete: function () {
            var idarray = jQuery('#table_Generica').jqGrid('getDataIDs');
            if (idarray.length > 0) {
                var firstid = jQuery('#table_Generica').jqGrid('getDataIDs')[0];
                $("#table_Generica").setSelection(firstid);
            }
        },
        onSelectRow: function (Id) {},
        ondblClickRow: function (Id) {up_dlg_generica();}
    });
    $(window).on('resize.jqGrid', function () {
        $("#table_Generica").jqGrid('setGridWidth', $("#content_2").width());
    });
});
</script>
@stop
<script src="{{ asset('archivos_js/presupuesto/generica.js') }}"></script>
<div id="dlg_gen" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important">                    
                    <div class="panel-body cr-body">
                        <fieldset>
                            <section>
                                <label class="label">Tipo. Transacción:</label>
                                <select id="gen_tip_trans" class="form-control input-sm">                                        
                                    
                                </select><i></i>                        
                            </section>
                            <section>
                                <label class="label">Código:</label>
                                <label class="input">
                                    <input id="gen_cod" onkeypress="return soloDNI(event);" type="text" placeholder="0" class="input-sm" style="width:80px;">
                                </label>                        
                            </section>
                            <section>
                                <label class="label">Descripción:</label>
                                <label class="input">
                                    <input id="gen_desc" type="text" placeholder="Descripción" class="input-sm text-uppercase">
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
