@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Coactivas...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-xs-2 col-sm-12 col-md-12 col-lg-3">
                            <label class="select">Filtro Año:</label>
                            <select id="vw_conve_fracc_cb_anio" class="input-sm">
                                
                            </select><i></i>                                
                        </div>  
                        <div class="text-right">
                            <button id="btn_vw_conve_fracc_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                            </button>
                            <button id="btn_vw_conve_fracc_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-folder-close"></i></span>Editar
                            </button>                            
                            <button id="btn_vw_conve_fracc_Anular" type="button" class="btn btn-labeled btn-danger">
                                <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Anular
                            </button>
                        </div>
                    </div>
                </div> 
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="tsable_Convenios"></table>
            <div id="spager_table_Convenios"></div>
        </article>
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">    
    $(document).ready(function () {        
        $("#menu_coactiva").show();
        $("#li_coactiva").addClass('cr-active');
        
    });    
</script>
@stop

<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div>
<script src="{{ asset('archivos_js/fraccionamiento/convenio.js') }}"></script>
@endsection



