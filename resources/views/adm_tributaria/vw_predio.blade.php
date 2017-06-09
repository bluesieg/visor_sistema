@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
<div class='cr_content col-xs-12'>
    <h1 class="txt-color-green"><b>Predios Urbanos...</b></h1>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class='col-lg-4'>
            <label class="control-label col-lg-4">Sector</label>
        </div>
        <div class='col-lg-8'>
            <select id='selsec' class="form-control col-lg-8" onchange="callpredtab()">
            @foreach ($sectores as $sectores)
            <option value='{{$sectores->id_sec}}' >{{$sectores->sector}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-xs-12">
        <div class='col-lg-4'>
            <label class="control-label">Manzana</label>
        </div>
        <div class='col-lg-8' id="dvselmnza">
            <select id="selmnza" class="form-control" onchange="callfilltab()">
            @foreach ($manzanas as $manzanas)
            <option value='{{$manzanas->id_mzna}}'>{{$manzanas->codi_mzna}}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-lg-6 col-md-12 col-xs-12">
        <ul id="sparks">                                        
                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="clicknewgrid();">
                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                    </button>
                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="clickmodgrid();">
                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                    </button>
                    <button  type="button" class="btn btn-labeled btn-danger">
                        <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                    </button> 
                    <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                        <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                    </button>
        </ul>
    </div>
    
    
</div>
    <div class='cr_content col-xs-12'>
                
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; padding: 0px !important">
            <table id="table_predios"></table>
            <div id="pager_table_predios"></div>
        </article>
    </div>
</section>

@section('page-js-script')
<script type="text/javascript">
    
    $(document).ready(function () {
        
        jQuery("#table_predios").jqGrid({
            url: 'gridpredio?mnza='+$("#selmnza").val(),
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pred','t_pred', 'Lote Cat', 'Código Predial', 'Mz Dist', 'Lt Dist', 'N° Munic', 'Est. Construcción', 'Contribuyente o Razon Social', 'Calle/Vía','A.Terreno','id_via','S/.Terreno','S/.Construct','cpre','contrib','dni','cod_via','dpto','zona','secc','piso','nro_int','referencia','nro_condominios'],
            rowNum: 20, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'Predios Urbanos', align: "center",
            colModel: [
                {name: 'id_pred', index: 'id_pred', hidden: true},
                {name: 'tp', index: 'tp', align: 'left', width: 50},
                {name: 'lote', index: 'lote', align: 'center', width: 50},
                {name: 'cod_cat', index: 'cod_cat', align: 'center', width: 100},
                {name: 'mzna_dist', index: 'mzna_dist', align: 'left', width: 40},
                {name: 'lote_dist', index: 'lote_dist', align: 'center', width: 40},
                {name: 'nro_mun', index: 'nro_mun', width: 40,align: "right"},
                {name: 'descripcion', index: 'descripcion', width: 150},
                {name: 'contribuyente', index: 'contribuyente', width: 80},
                {name: 'nom_via', index: 'nom_via', width: 100},
                {name: 'id_via', index: 'id_via', hidden: true},
                {name: 'are_terr', index: 'are_terr', width: 60,align: "right"},
                {name: 'val_ter', index: 'val_ter', width: 60,align: "right"},
                {name: 'val_const', index: 'val_const', width: 60, align: "right"},
                {name: 'id_cond_prop', index: 'id_cond_prop', hidden: true},
                {name: 'id_contrib', index: 'id_contrib', hidden: true},
                {name: 'nro_doc', index: 'nro_doc', hidden: true},
                {name: 'cod_via', index: 'cod_via', hidden: true},
                {name: 'dpto', index: 'dpto', hidden: true},
                {name: 'zona', index: 'zona', hidden: true},
                {name: 'secc', index: 'secc', hidden: true},
                {name: 'piso', index: 'piso', hidden: true},
                {name: 'nro_int', index: 'nro_int', hidden: true},
                {name: 'referencia', index: 'referencia', hidden: true},
                {name: 'nro_condominios', index: 'nro_condominios', hidden: true}
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
            onSelectRow: function (Id) {
//                $('#btn_vw_contribuyentes_Editar').attr('onClick', 'open_dialog_new_edit_Contribuyente("' + 'EDITAR' + '",' + Id + ')');
//                $('#btn_vw_contribuyentes_Eliminar').attr('onClick', 'eliminar_contribuyente(' + Id + ')');
            },
            ondblClickRow: function (Id) 
            {
                clickmodgrid();
            }
        });
        $("#dlg_inp_cvia").keypress(function (e) {
            if (e.which == 13) {
                
                cod_via = ajustar(5,$('#dlg_inp_cvia').val());
                $('#dlg_inp_cvia').val(cod_via);
                get_global_cod_via("dlg_inp_nvia",cod_via);
            }
        });
        $("#dlg_dni").keypress(function (e) {
            if (e.which == 13) {
                
                get_global_contri("dlg_contri",$("#dlg_dni").val());
            }
        });

    });
    
</script>
@stop
<script src="{{ asset('archivos_js/adm_tributaria/predios.js') }}"></script>
<div id="dlg_reg_dj" style="display: none;">
    
            
                    <div class="widget-body">
                    <div  class="smart-form">
                        <div class="panel-group">                
                            <div class="panel panel-success">
                                <div class="panel-heading bg-color-success">.:: Codigo de Referencia ::.</div>
                                <div class="panel-body">
                                    <section class="col-xs-4"></section>
                                    <div class="text-center col-xs-1" style="padding: 5px">
                                        <input type="hidden" id="dlg_idpre" value="0">
                                        <label class="label col-xs-12 text-center">Sector:</label>
                                        <input class="text-center col-xs-12 form-control" id="dlg_sec" type="text" name="dlg_sec" disabled="" >
                                    </div>
                                    <div class="text-center col-xs-1" style="padding: 5px">
                                        <label class="label col-xs-12 text-center">Manzana:</label>
                                        <input class="text-center col-xs-12 form-control" id="dlg_mzna" type="text" name="dlg_mzna" disabled="" >
                                    </div>
                                    <div class="text-center col-xs-1 " style="padding: 5px">
                                        <label class="label col-xs-12 text-center">Lote:</label>
                                        <input class="text-center col-xs-12 form-control" id="dlg_lot" type="text" name="dlg_lot" disabled="" maxlength="3" onkeypress="return soloDNI(event);">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="panel-group " style="margin-top: 5px">                
                            <div class="panel panel-success">
                                <div class="panel-heading bg-color-success">.:: Datos del Propietario ::.</div>
                                <div class="panel-body">
                                    <section class="col col-3">
                                        <label class="label">Dni/Ruc:</label>
                                        <label class="input">
                                            <input id="dlg_contri_hidden" type="hidden" value="0">
                                            <input id="dlg_dni" onkeypress="return soloDNI(event);" type="text" placeholder="Nro. Documento" class="input-sm" disabled="">
                                        </label>
                                    </section>
                                    <section class="col col-9">
                                        <label class="label">Contribuyente/Razón Social:</label>
                                        <label class="input">
                                            <input id="dlg_contri" type="text"  class="input-sm" disabled="" >
                                        </label>
                                    </section>
                      
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-group col-xs-3 " style="margin-top: 5px">                
                            <div class="panel panel-success">
                                <div class="panel-heading bg-color-success">.:: Condicion de Propiedad ::.</div>
                                <div class="panel-body">
                                    <section class="col col-8" style="margin-bottom: 16px;">
                                        <label class="label">Condicion de Propiedad:</label>                                   
                                        <label class="select">
                                        <select id="dlg_sel_condpre"  class="input-sm">
                                            @foreach ($condicion as $condicion)
                                            <option value='{{$condicion->id_cond}}' >{{$condicion->descripcion}}</option>
                                            @endforeach
                                        </select> </label>                        
                                     </section>
                                    <section class="col col-4">
                                        <label class="label">Condominios</label>
                                        <label class="input">
                                            <input id="dlg_inp_condos" type="number"  class="input-sm" >
                                        </label>
                                    </section>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-group col-xs-9 " style="margin-top: 5px;  ">                
                            <div class="panel panel-success">
                                <div class="panel-heading bg-color-success">.:: Ubicación del Predio ::.</div>
                                <div class="panel-body">
                                   
                                    <section class="col-xs-1" style="padding: 0px 0px 0px 15px !important">
                                        <label class="label">Cod. Via:</label>
                                        <label class="input">
                                            <input id="dlg_inp_cvia" type="text" onkeypress="return soloDNI(event);" class="input-sm" >
                                            <input type="hidden" id="id_via"/>
                                        </label>
                                    </section>
                                    <section class="col-xs-3" style="padding: 0px 0px 0px 5px !important">
                                        <label class="label">Avenidad,Jirón, Calle o Pasaje:</label>
                                        <label class="input">
                                            <input id="dlg_inp_nvia" type="text"  class="input-sm" disabled="" >
                                        </label>
                                    </section>
                                    
                                    <section class="col-xs-7 " style="padding: 0px !important; margin:0px !important">
                                        <section class="col col-2" style="padding: 1px !important">
                                            <label class="label lb_cr">N°</label>
                                            <label class="input">
                                                <input id="dlg_inp_n" type="text"  class="input-sm" maxlength="19">
                                            </label>
                                        </section>
                                        
                                        <section class="col col-1" style="padding: 1px !important">
                                            <label class="label lb_cr">mz</label>
                                            <label class="input">
                                                <input id="dlg_inp_mz" type="text"  class="input-sm" maxlength="5">
                                            </label>
                                        </section>
                                        
                                        <section class="col col-1" style="padding: 1px !important">
                                            <label class="label lb_cr">LT</label>
                                            <label class="input">
                                                <input id="dlg_inp_lt" type="text"  class="input-sm" maxlength="5">
                                            </label>
                                        </section>
                                        
                                        <section class="col col-1" style="padding: 1px !important">
                                            <label class="label lb_cr">ZN</label>
                                            <label class="input">
                                                <input id="dlg_inp_zn" type="text"  class="input-sm" maxlength="15">
                                            </label>
                                        </section>
                                        
                                        <section class="col col-1" style="padding: 1px !important">
                                            <label class="label lb_cr">SECC</label>
                                            <label class="input">
                                                <input id="dlg_inp_secc" type="text"  class="input-sm" maxlength="15">
                                            </label>
                                        </section>
                                        <section class="col col-2" style="padding: 1px !important">
                                            <label class="label lb_cr">PISO</label>
                                            <label class="input">
                                                <input id="dlg_inp_piso" type="text"  class="input-sm" maxlength="2">
                                            </label>
                                        </section>
                                        <section class="col col-2" style="padding: 1px !important">
                                            <label class="label lb_cr">DPTO</label>
                                            <label class="input">
                                                <input id="dlg_inp_dpto" type="text"  class="input-sm" maxlength="5">
                                            </label>
                                        </section>
                                        <section class="col col-2" style="padding: 1px !important">
                                            <label class="label lb_cr">TDA/STAND</label>
                                            <label class="input">
                                                <input id="dlg_inp_tdastand" type="text"  class="input-sm">
                                            </label>
                                        </section>
                                        
                                    </section>
                                    
                                    
                                </div>
                            </div>
                        </div>
                       
                        <div class="panel-group col-xs-12 " style="margin-top: 5px; margin-bottom: 15px  ">                
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <section class="col col-10 pd_dlg_cr" >
                                        <label class="label">Referencia:</label>
                                        <label class="input">
                                            <input id="dlg_inp_refe" type="text"  class="input-sm" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-group col-xs-12 " style="margin-top: 5px; margin-bottom: 15px  ">                
                            <div class="panel panel-success">
                                <div class="panel-heading bg-color-success">.:: Datos Relativos del Predio ::.</div>
                                <div class="panel-body">
                                    <section class="col col-10 pd_dlg_cr" >
                                        <label class="label">Referencia:</label>
                                        <label class="input">
                                            <input id="dlg_inp_refe" type="text"  class="input-sm" maxlength="150">
                                        </label>
                                    </section>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                       
                </div>
</div>
             
@endsection




