@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
    <div class='cr_content col-xs-12 '>
        <h1 class="txt-color-green"><b>Impresión de Formatos...</b></h1>

        <div class="col-xs-12 cr-body" style="margin-top: 10px;">
            <label class="control-label col-lg-2">Código Contribuyente:</label>
            <div class='col-lg-2'>
                <input id="dlg_contri_hidden" type="hidden" value="0">
                <input id="dlg_dni" type="text"  class="form-control" >
            </div>
            <label class="control-label col-lg-1">Año:</label>
            <div class='col-lg-2'>
                <select id='selantra' class="form-control col-lg-8" onchange="callfilltab()">
                @foreach ($anio_tra as $anio)
                <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                @endforeach
                </select>
            </div>
            <div class="col-xs-12" style="margin-bottom: 5px;"></div>
            <label class="control-label col-lg-2">Contribuyente:</label>
            <div class='col-lg-7' style="padding-right: 0px;">
                <input id="dlg_contri" type="text"  class="form-control" style="height: 32px;" autofocus="focus" >
            </div>
            <div class='col-lg-3' style="padding: 0px;">
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="fn_bus_contrib()">
                    <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar
                </button>
            </div>
        </div>
    </div>
    <div class='cr_content col-xs-12'>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; padding: 0px !important">
            <table id="table_predios"></table>
            <div id="pager_table_predios"></div>
        </article>
        <div class="col-xs-12" style="padding: 0px; margin-top: 5px;">
            <ul style="padding: 0px;">                                        
                        <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="abrir_rep('HR');">
                            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir HR
                        </button>
                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="abrir_rep('PU');">
                            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir PU
                        </button>
                        <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white" onclick="abrir_rep('PR');">
                            <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir PR
                        </button>
            </ul>
        </div>
    </div>
    
</section>

@section('page-js-script')
<script type="text/javascript">
    
    $(document).ready(function (){
        $("#menu_admtri").show();
        $("#li_impform").addClass('cr-active')
        jQuery("#table_predios").jqGrid({
            url: 'gridpredio?mnza=0&ctr=0&tpre=0',
            datatype: 'json', mtype: 'GET',
            height: '200px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pred','t_pred', 'Sector','Manzana','Lote Cat', 'Código Predial', 'Mz Dist', 'Lt Dist', 'N° Munic', 'Est. Construcción', 'Contribuyente o Razon Social', 'Calle/Vía','A.Terreno','id_via','S/.Terreno','S/.Construct'],
            rowNum: 20, sortname: 'id_pred', sortorder: 'desc', viewrecords: true, caption: 'Predios Urbanos/Rusticos', align: "center",
            colModel: [
                {name: 'id_pred', index: 'id_pred', hidden: true},
                {name: 'tp', index: 'tp', align: 'center', width: 50},
                {name: 'sec', index: 'sec', align: 'center', width: 20},
                {name: 'mnza', index: 'mnza', align: 'center', width: 20},
                {name: 'lote', index: 'lote', align: 'center', width: 50},
                {name: 'cod_cat', index: 'cod_cat', align: 'center', width: 80},
                {name: 'mzna_dist', index: 'mzna_dist', align: 'center', width: 40},
                {name: 'lote_dist', index: 'lote_dist', align: 'center', width: 40},
                {name: 'nro_mun', index: 'nro_mun', width: 40,align: "right"},
                {name: 'descripcion', index: 'descripcion', width: 100},
                {name: 'contribuyente', index: 'contribuyente', width: 150},
                {name: 'nom_via', index: 'nom_via', width: 100},
                {name: 'id_via', index: 'id_via', hidden: true},
                {name: 'are_terr', index: 'are_terr', width: 60,align: "right"},
                {name: 'val_ter', index: 'val_ter', width: 60,align: "right"},
                {name: 'val_const', index: 'val_const', width: 60, align: "right"},
               
            ],
            pager: '#pager_table_predios',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_predios').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_predios').jqGrid('getDataIDs')[0];
                            $("#table_predios").setSelection(firstid);    
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
<script src="{{ asset('archivos_js/adm_tributaria/imp_rep.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div> 



@endsection




