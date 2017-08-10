@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
    <div class='cr_content col-xs-12 '>
        <h1 class="txt-color-green"><b>Generación de Ordenes de Pago (OP)</b></h1>

        <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Busqueda por Sector y Manzana</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-2" style="padding: 0px;">
                <label class="control-label col-lg-5" style="margin-top: 3px">Sector:</label>
                <div class='col-lg-7'>
                    <select id='selsec' class="form-control" onchange="callpredtab()" style="height: 32px;" >
                    @foreach ($sectores as $sectores)
                    <option value='{{$sectores->id_sec}}' >{{$sectores->sector}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="col-xs-2" style="padding: 0px;">
            <label class="control-label col-lg-5" style="margin-top: 3px">Manzana:</label>
            <div class='col-lg-7' id="dvselmnza">
                <select id="selmnza" class="form-control" style="height: 32px;" >
                @foreach ($manzanas as $manzanas)
                <option value='{{$manzanas->id_mzna}}'>{{$manzanas->codi_mzna}}</option>
                @endforeach
                </select>
            </div>
        </div>
            <div class='col-lg-3' >
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="call_list_contrib(2)">
                    <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                </button>
            </div>
        </div>
        <div class="col-xs-12 cr-body" >
            <section>
                <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                    <header>
                            <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                            <h2>Busqueda por Contribuyente</h2>
                    </header>
                </div>
            </section>
            <div class="col-xs-4" style="padding: 0px;">
                <label class="control-label col-lg-5" style="padding-right: 0px;margin-top: 3px;">Código Contribuyente:</label>
                <div class='col-lg-7'>
                    <input id="dlg_contri_hidden" type="hidden" value="0">
                    <input id="dlg_dni" type="text"  class="form-control" style="height: 32px;" >
                </div>
            </div>
            <div class="col-xs-8">
                <label class="control-label col-lg-2" style="margin-top: 3px;">Contribuyente:</label>
                <div class='col-lg-7' style="padding: 0px;">
                    <input id="dlg_contri" type="text"  class="form-control" style="height: 32px;" autofocus="focus" >
                </div>
                <div class='col-lg-3' style="padding: 0px;">
                    <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="fn_bus_contrib()">
                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class='cr_content col-xs-12'>
        <div class="col-xs-12" style="padding: 0px; margin-top: 5px;">
            <ul style="padding: 0px;">                                        
                        <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="generar_op(1);">
                            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir Contribuyente Seleccionado
                        </button>
                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="generar_op(2);">
                            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir Todo
                        </button>
            </ul>
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; padding: 0px !important">
            <table id="table_personas"></table>
            <div id="pager_table_personas"></div>
        </article>
        
    </div>
    
</section>

@section('page-js-script')
<script type="text/javascript">
    
    $(document).ready(function (){
        $("#menu_fisca").show();
        $("#li_fis_op").addClass('cr-active')
        jQuery("#table_personas").jqGrid({
            url: 'obtiene_cotriop?dat=0&sec=0&manz=0',
            datatype: 'json', mtype: 'GET',
            height: '200px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers', 'Codigo', ' Tip. Doc', 'N°. Documento', 'Contribuyente o Razon Social'],
            rowNum: 20, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'Lista de Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_persona', index: 'id_persona', align: 'left', width: 80},
                {name: 'tipo_doc', index: 'tipo_doc', align: 'center', width: 60},
                {name: 'nro_doc', index: 'nro_doc', align: 'center', width: 90},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 250}
               
            ],
            pager: '#pager_table_personas',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_personas').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_personas').jqGrid('getDataIDs')[0];
                            $("#table_personas").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers','codigo','DNI/RUC','contribuyente'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center',width: 100},
                {name: 'nro_doc', index: 'nro_doc', align: 'center',width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left',width: 260},
                
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                            $("#table_contrib").setSelection(firstid);    
                        }
                    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list(rowid);} } ); 
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){fn_bus_contrib_list(Id)}
        });
        $("#dlg_dni").keypress(function (e) {
            if (e.which == 13) {
                traer_contri_cod("dlg_contri",$("#dlg_dni").val());
            }
        });
        var globalvalidador=0;
        $("#dlg_contri").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_bus_contrib();
                    globalvalidador=1;
                }
                else
                {
                    globalvalidador=0;
                }
                
            }
        });
       
        
    });
    
</script>
@stop
<script src="{{ asset('archivos_js/fiscalizacion/fiscalizacion.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div> 



@endsection




