@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
    <div class='cr_content col-xs-12 '>
        <h1 class="txt-color-green"><b>Mantenimiento Tipos de Documentos para Alcabala...</b></h1>

        <div class="col-xs-6 cr-body" >
            <section style="padding: 0px;">
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px; padding: 0px;">
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Mantenimiento de Naturaleza del contrato</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-12 text-align-right" style="padding: 0px;">
                <button class="btn bg-color-green txt-color-white " onclick="fn_new(1);" >
                    <span >
                        <i class="glyphicon glyphicon-plus-sign"></i>
                    </span>
                    <label>Nuevo</label>
                </button>
            </div>
            <article class="col-xs-12" style=" padding: 0px !important; margin-top: 5px;">
                    <table id="table_nat_cotra"></table>
                    <div id="pager_table_nat_cotra"></div>
            </article>
            
            
            
        </div>
        <div class="col-xs-6 cr-body" >
            <section style="padding: 0px;">
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px; padding: 0px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Mantenimiento de Documentos de Transferencia</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-12 text-align-right" style="padding: 0px;">
                <button class="btn bg-color-green txt-color-white " onclick="fn_new(2);" >
                    <span >
                        <i class="glyphicon glyphicon-plus-sign"></i>
                    </span>
                    <label>Nuevo</label>
                </button>
            </div>
            <article class="col-xs-12" style=" padding: 0px !important; margin-top: 5px;">
                    <table id="table_doc_trans"></table>
                    <div id="pager_table_doc_trans"></div>
            </article>
        </div>
        <div class="col-xs-6 cr-body" >
            <section style="padding: 0px;">
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px; padding: 0px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Mantenimiento de Transferencias Inafectas</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-12 text-align-right" style="padding: 0px;">
                <button class="btn bg-color-green txt-color-white " onclick="fn_new(3);" >
                    <span >
                        <i class="glyphicon glyphicon-plus-sign"></i>
                    </span>
                    <label>Nuevo</label>
                </button>
            </div>
            <article class="col-xs-12" style=" padding: 0px !important; margin-top: 5px;">
                    <table id="table_trans_ina"></table>
                    <div id="pager_table_trans_ina"></div>
            </article>
        </div>
    </div>
    
    
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function (){
        $("#menu_alcabala").show();
        $("#li_alca_manten_doc").addClass('cr-active')
        jQuery("#table_nat_cotra").jqGrid({
            url: 'grid_nat_contra',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['Codigo', 'Descripción'],
            rowNum: 50, sortname: 'id_tip_cto', sortorder: 'asc', viewrecords: true, caption: 'Naturaleza de Contrato', align: "center",
            colModel: [
                {name: 'id_tip_cto', index: 'id_tip_cto', align: 'left', width: 20},
                {name: 'descrip_cto', index: 'descrip_cto', align: 'left', width: 200},
                
            ],
            pager: '#pager_table_nat_cotra',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_nat_cotra').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_nat_cotra').jqGrid('getDataIDs')[0];
                            $("#table_nat_cotra").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#table_doc_trans").jqGrid({
            url: 'grid_doc_trans',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['Codigo', 'Descripción'],
            rowNum: 50, sortname: 'id_doc_transf', sortorder: 'asc', viewrecords: true, caption: 'Documentos de Transferencia', align: "center",
            colModel: [
                {name: 'id_doc_transf', index: 'id_doc_transf', align: 'left', width: 20},
                {name: 'descrip_doc_transf', index: 'descrip_doc_transf', align: 'left', width: 200},
                
            ],
            pager: '#pager_table_doc_trans',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_doc_trans').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_doc_trans').jqGrid('getDataIDs')[0];
                            $("#table_doc_trans").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#table_trans_ina").jqGrid({
            url: 'grid_trans_ina',
            datatype: 'json', mtype: 'GET',
            height: '150px', autowidth: true,
            toolbarfilter: true,
            colNames: ['Codigo', 'Descripción'],
            rowNum: 50, sortname: 'id_trans_inaf', sortorder: 'asc', viewrecords: true, caption: 'Transferencias Inafectas', align: "center",
            colModel: [
                {name: 'id_trans_inaf', index: 'id_trans_inaf', align: 'left', width: 20},
                {name: 'descrip_trans_inaf', index: 'descrip_trans_inaf', align: 'left', width: 200},
                
            ],
            pager: '#pager_table_trans_ina',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_trans_ina').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_trans_ina').jqGrid('getDataIDs')[0];
                            $("#table_trans_ina").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
    });
</script>
@stop
<script src="{{ asset('archivos_js/alcabala/mante_doc_alcab.js') }}"></script>

<div id="dlg_new_natcontra" style="display: none;">
    <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Registrar Nuevo Contrato::..</h2>
                    </header>
                </div>
            </section>
          
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Descripción del Contrato</span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_des_contra" type="text"  class="form-control" style="height: 32px; " maxlength="100">
                    </div>
                    
                </div>
            </div>
        </div>
</div> 
<div id="dlg_new_doctrans" style="display: none;">
    <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Registrar Nuevo Documento Transferencia::..</h2>
                    </header>
                </div>
            </section>
          
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Descripción del Doc. Transferencia</span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_des_doctrans" type="text"  class="form-control" style="height: 32px; " maxlength="100">
                    </div>
                    
                </div>
            </div>
        </div>
</div> 
<div id="dlg_new_transina" style="display: none;">
    <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Registrar Nueva Transferencia Inafecta::..</h2>
                    </header>
                </div>
            </section>
          
            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                <div class="input-group input-group-md">
                    <span class="input-group-addon">Descripción del Doc. Transferencia</span>
                    <div class="icon-addon addon-md">
                        <input id="dlg_des_transina" type="text"  class="form-control" style="height: 32px; " maxlength="80">
                    </div>
                </div>
            </div>
        </div>
</div> 



@endsection




