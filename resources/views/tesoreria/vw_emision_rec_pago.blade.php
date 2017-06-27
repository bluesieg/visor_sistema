@extends('layouts.app')
@section('content')
<style>
    .smart-form fieldset {    
        padding: 5px 8px 0px;   
    }
    .smart-form section {
        margin-bottom: 5px;    
    }
    .smart-form .label {  
        margin-bottom: 0px;   
    }
</style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Emision de Recibos de Pago...</b></h1>
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-3">
                                <label>Filtro Fecha:</label>
                                <select id="vw_val_arancel_cb_anio" onchange="click_btn_buscar();" class="input-sm">
                                    <option value="select" selected="" disabled="">- Fecha -</option>
                                </select><i></i>                                
                            </div>
                            <button onclick="buscar_val_arancel();" style="display: none;" id="btn_vw_valores_arancelarios_Buscar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="fa fa-search"></i></span>Buscar
                            </button>
                            <button onclick="open_dialog_new_edit_Val_Arancel('NUEVO');" id="btn_vw_valores_arancelarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Rec. Impuesto Predial
                            </button>
                            <button id="btn_vw_valores_arancelarios_Editar" onclick="open_dialog_new_edit_Val_Arancel('EDITAR');" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-folder-close"></i></span>Fraccionamiento
                            </button>
                            <button onclick="dialog_emi_rec_pag_varios();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-tasks"></i></span>Varios
                            </button>
                            <button id="btn_vw_valores_arancelarios_Eliminar" onclick="eliminar_val_arancel();" type="button" class="btn btn-labeled btn-danger">
                                <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Anular
                            </button>
                        </div>
                    </div>
                </div> 
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<!--            <table id="table_Contribuyentes"></table>
            <div id="pager_table_Contribuyentes"></div>-->
        </article>
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">
    $(document).ready(function () {
        $("#menu_tesoreria").show();
        $("#li_tesoreria_emi_rec_pag").addClass('cr-active');

    });
</script>
@stop
<div id="vw_emision_rec_pag_varios" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Datos de Recibo ::.</div>
                    <div class="panel-body cr-body">
                        <fieldset>
                            <div class="row">
                                <section class="col col-3">
                                    <input type="hidden">
                                    <label class="label">Cod. Tributo:</label>
                                    <label class="input">
                                        <input id="contrib_ape_pat" type="text" placeholder="000000" class="input-sm">
                                    </label>                        
                                </section>
                                <section class="col col-9">
                                    <label class="label">Descripcion:</label>
                                    <label class="input">
                                        <input id="contrib_ape_mat" type="text" placeholder="Descripcion." class="input-sm">
                                    </label>                      
                                </section>                                
                            </div> 
                            <section>
                                <label class="label">Tributo:</label>
                                <label class="input">
                                    <input id="contrib_ape_mat" type="text" placeholder="Tributo" class="input-sm">
                                </label>                      
                            </section>
                            <div class="row">
                                <section class="col col-6">
                                    <input type="hidden">
                                    <label class="label">Cantidad:</label>
                                    <label class="input">
                                        <input id="contrib_ape_pat" type="text" placeholder="00" class="input-sm">
                                    </label>                        
                                </section>
                                <section class="col col-6">
                                    <label class="label">Valor S/.:</label>
                                    <label class="input">
                                        <input id="contrib_ape_mat" type="text" placeholder="000.00" class="input-sm">
                                    </label>                      
                                </section>                                
                            </div>
                            <section>
                                <label class="label">Glosa:</label>
                                <label class="textarea">
                                    <textarea id="contrib_ape_mat" rows="2" placeholder="descripcion de recibo" class="custom-scroll"></textarea>                                    
                                </label>                      
                            </section>
                        </fieldset>
                    </div>
                </div>
                <div class="panel panel-success">
                    <div class="panel-heading bg-color-success">.:: Detalle de Recibo ::.</div>
                    <div class="panel-body cr-body">
                        <fieldset>                            
                            <section>
                                <label class="label">Glosa:</label>
                                <label class="textarea">
                                    <textarea id="contrib_ape_mat" rows="2" placeholder="descripcion de recibo" class="custom-scroll"></textarea>                                    
                                </label>                      
                            </section>
                        </fieldset>
                    </div>
                </div>
            </div>                   
        </div>        
    </div>
</div>

<script src="{{ asset('archivos_js/tesoreria/emision_rec_pago.js') }}"></script>
@endsection
