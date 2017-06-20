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
        <ul id="sparks" style="margin: 0px !important">                                        
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
        $("#menu_admtri").show();
        $("#li_preurb").addClass('cr-active')
        jQuery("#table_predios").jqGrid({
            url: 'gridpredio?mnza='+$("#selmnza").val(),
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pred','t_pred', 'Lote Cat', 'Código Predial', 'Mz Dist', 'Lt Dist', 'N° Munic', 'Est. Construcción', 'Contribuyente o Razon Social', 'Calle/Vía','A.Terreno','id_via','S/.Terreno','S/.Construct'],
            rowNum: 20, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'Predios Urbanos', align: "center",
            colModel: [
                {name: 'id_pred', index: 'id_pred', hidden: true},
                {name: 'tp', index: 'tp', align: 'center', width: 50},
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
            ondblClickRow: function (Id){clickmodgrid();}
        });
        $("#dlg_inp_cvia").keypress(function (e) {
            if (e.which == 13) {
                
                ajustar(5,'dlg_inp_cvia');
                cod_via=$('#dlg_inp_cvia').val();
                get_global_cod_via("dlg_inp_nvia",cod_via);
            }
        });
        $("#dlg_dni").keypress(function (e) {
            if (e.which == 13) {
                get_global_contri("dlg_contri",$("#dlg_dni").val());
            }
        });
        jQuery("#table_pisos").jqGrid({
            url: 'gridpisos/0',
            datatype: 'json', mtype: 'GET',
            height: '200px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pi','Piso', 'Fecha', 'MEP', 'ECS', 'ECC', 'Muro', 'Techo', 'Piso', 'Puerta','Reves','baños','I.Elect','Area Constr.'],
            rowNum: 20, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'Pisos del Predio', align: "center",
            colModel: [
                {name: 'id_pi', index: 'id_pi', hidden: true},
                {name: 'piso', index: 'piso', align: 'center', width: 80},
                {name: 'fech', index: 'fech', align: 'center', width: 90},
                {name: 'mep', index: 'mep', align: 'center', width: 70},
                {name: 'ecs', index: 'ecs', align: 'center', width: 70},
                {name: 'ecc', index: 'ecc', align: 'center', width: 70},
                {name: 'muro', index: 'muro', width: 70,align: "center"},
                {name: 'techo', index: 'techo', width: 70,align: 'center'},
                {name: 'piso', index: 'piso', width: 70,align: 'center'},
                {name: 'puerta', index: 'puerta', width: 70,align: 'center'},
                {name: 'reves', index: 'reves', width: 70,align: 'center'},
                {name: 'banio', index: 'banio', width: 70,align: 'center'},
                {name: 'I.Elect', index: 'I.Elect', width: 70,align: 'center'},
                {name: 'aconst', index: 'aconst', width: 80,align: 'center'},
            ],
            pager: '#pager_table_pisos',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_pisos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_pisos').jqGrid('getDataIDs')[0];
                            $("#table_pisos").setSelection(firstid);    
                        }
                },
            ondblClickRow: function (Id){clickmodpiso();}
        });
        jQuery("#table_condos").jqGrid({
            url: 'gridcondos/0',
            datatype: 'json', mtype: 'GET',
            height: '200px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_condom','dni/ruc', 'Nombre', 'Direccion', '% Condominio'],
            rowNum: 20, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'Condominios del Predio', align: "center",
            colModel: [
                {name: 'id_condom', index: 'id_condom', hidden: true},
                {name: 'dni_ruc', index: 'dni_ruc', align: 'center', width: 180},
                {name: 'nombre', index: 'nombre', align: 'center', width: 350},
                {name: 'direccion', index: 'direccion', align: 'center', width: 350},
                {name: 'porcent', index: 'porcent', align: 'center', width: 100},
               
            ],
            pager: '#pager_table_condos',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_condos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_condos').jqGrid('getDataIDs')[0];
                            $("#table_condos").setSelection(firstid);    
                        }
                },
            ondblClickRow: function (Id){clickmodcondos();}
        });
    });
    jQuery('#rpiso_inp_estruc').keypress(function(tecla) {
        $("#rpiso_inp_estruc").val($("#rpiso_inp_estruc").val().toUpperCase());
        if(tecla.charCode < 65 || tecla.charCode > 73)
        {
            if(tecla.charCode < 97 || tecla.charCode > 105) return false;
        }
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
                                <div class="panel-body cr-body">
                                    <div class="col-xs-4"></div>
                                    <div class="text-center col-xs-1" >
                                        <input type="hidden" id="dlg_idpre" value="0">
                                        <label class="label col-xs-12 text-center">Sector:</label>
                                        <input class="text-center col-xs-12 form-control" id="dlg_sec" type="text" name="dlg_sec" disabled="" >
                                    </div>
                                    <div class="text-center col-xs-1" >
                                        <label class="label col-xs-12 text-center">Manzana:</label>
                                        <input class="text-center col-xs-12 form-control" id="dlg_mzna" type="text" name="dlg_mzna" disabled="" >
                                    </div>
                                    <div class="text-center col-xs-1 " >
                                        <label class="label col-xs-12 text-center">Lote:</label>
                                        <input class="text-center col-xs-12 form-control" id="dlg_lot" type="text" name="dlg_lot" disabled="" maxlength="3" onkeypress="return soloDNI(event);" onBlur="ajustar(2,'dlg_lot')">
                                    </div>
                                </div>
                            </div>
                        </div>
                    
                        <div class="panel-group col-xs-8 " style="margin-top: 5px">                
                            <div class="panel panel-success">
                                <div class="panel-heading bg-color-success">.:: Datos del Propietario ::.</div>
                                <div class="panel-body cr-body">
                                    <div class="col col-3">
                                        <label class="label">Dni/Ruc:</label>
                                        <label class="input">
                                            <input id="dlg_contri_hidden" type="hidden" value="0">
                                            <input id="dlg_dni" onkeypress="return soloDNI(event);" type="text" placeholder="Nro. Documento" class="input-sm" disabled="">
                                        </label>
                                    </div>
                                    <div class="col col-9">
                                        <label class="label">Contribuyente/Razón Social:</label>
                                        <label class="input">
                                            <input id="dlg_contri" type="text"  class="input-sm" disabled="" >
                                        </label>
                                    </div>
                      
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-group col-xs-4 " style="margin-top: 5px">                
                            <div class="panel panel-success cr-panel-sep">
                                <div class="panel-heading bg-color-success">.:: Condicion de Propiedad ::.</div>
                                <div class="panel-body cr-body">
                                    <div class="col col-8">
                                        <label class="label">Condicion de Propiedad:</label>                                   
                                        <select id="dlg_sel_condpre"  class="form-control">
                                            @foreach ($condicion as $condicion)
                                            <option value='{{$condicion->id_cond}}' >{{$condicion->descripcion}}</option>
                                            @endforeach
                                        </select>                       
                                     </div>
                                    <div class="col col-4">
                                        <label class="label">Condominios</label>
                                        <label class="input">
                                            <input id="dlg_inp_condos" type="number"  class="input-sm" >
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="panel-group col-xs-8 " style="margin-top: 5px;  ">                
                            <div class="panel panel-success ">
                                <div class="panel-heading bg-color-success">.:: Ubicación del Predio ::.</div>
                                <div class="panel-body cr-body">
                                   
                                    <div class="col-xs-1" style="padding-left:15px !important">
                                        <label class="label">Cod. Via:</label>
                                        <label class="input">
                                            <input id="dlg_inp_cvia" type="text" onkeypress="return soloDNI(event);" class="input-sm" onblur="ajustar(5,'dlg_inp_cvia')" >
                                            <input type="hidden" id="id_via"/>
                                        </label>
                                    </div>
                                    <div class="col-xs-3">
                                        <label class="label">Avenidad,Jirón, Calle o Pasaje:</label>
                                        <label class="input">
                                            <input id="dlg_inp_nvia" type="text"  class="input-sm" disabled="" >
                                        </label>
                                    </div>
                                    
                                    <div class="col-xs-7 " style="padding: 0px !important; margin:0px !important">
                                        <table>
                                            <tr>
                                                <td>
                                                    <label class="label ">N°</label>
                                                    <label class="input">
                                                        <input id="dlg_inp_n" type="text"  class="input-sm" maxlength="19">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="label ">mz</label>
                                                    <label class="input">
                                                        <input id="dlg_inp_mz" type="text"  class="input-sm" maxlength="5">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="label ">LT</label>
                                                    <label class="input">
                                                        <input id="dlg_inp_lt" type="text"  class="input-sm" maxlength="5">
                                                    </label>
                                                </td>
                                        
                                                <td>
                                                    <label class="label ">ZN</label>
                                                    <label class="input">
                                                        <input id="dlg_inp_zn" type="text"  class="input-sm" maxlength="15">
                                                    </label>
                                                </td>
                                                <td>    
                                                    <label class="label ">SECC</label>
                                                    <label class="input">
                                                        <input id="dlg_inp_secc" type="text"  class="input-sm" maxlength="15">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="label ">PISO</label>
                                                    <label class="input">
                                                        <input id="dlg_inp_piso" type="text"  class="input-sm" maxlength="2">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="label ">DPTO</label>
                                                    <label class="input">
                                                        <input id="dlg_inp_dpto" type="text"  class="input-sm" maxlength="5">
                                                    </label>
                                                </td>
                                                <td>
                                                    <label class="label ">TDA/STAND</label>
                                                    <label class="input">
                                                        <input id="dlg_inp_tdastand" type="text"  class="input-sm">
                                                    </label>
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group col-xs-4 " style="margin-top: 5px; ">                
                            <div class="panel panel-success cr-panel-sep">
                                <div class="panel-heading bg-color-success">.:: Referencia ::.</div>
                                <div class="panel-body cr-body">
                                    <div class="pd_dlg_cr" >
                                        <label class="label">Referencia:</label>
                                        <label class="input">
                                            <input id="dlg_inp_refe" type="text"  class="input-sm" maxlength="150">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group col-xs-12 " style="margin-top: 5px; margin-bottom: 5px  ">                
                            <div class="panel panel-success">
                                <div class="panel-heading bg-color-success">.:: Datos Relativos del Predio ::.</div>
                                <div class="panel-body cr-body">
                                    <div class='col-lg-2 pd_dlg_cr'>
                                        <label class="label">Estado de Construccion:</label>
                                        <select id='dlg_sel_estcon' class="form-control" >
                                                @foreach ($ecc as $ecc)
                                                <option value='{{$ecc->id_ecc}}' >{{$ecc->descripcion}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class='col-lg-2 '>
                                        <label class="label">Tipo de Predio:</label>
                                        <select id='dlg_sel_tippre' class="form-control" >
                                            @foreach ($tpre as $tpre)
                                                <option value='{{$tpre->id_tip_p}}' >{{$tpre->descrip_tip_pre}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class='col-lg-1 '>
                                        <label class="label">Cod. Uso:</label>
                                        <label class="input">
                                            <input id="dlg_inp_usopre_cod" type="text"  class="input-sm" disabled="">
                                        </label>
                                    </div>
                                    <div class='col-lg-4 '>
                                        <label class="label">Uso Predio(catastro):</label>
                                        <label class="input">
                                            <input type="hidden" id="hidden_dlg_inp_usopre">
                                            <input id="dlg_inp_usopre" type="text"  class="input-sm" placeholder="Escribir Uso Predio">
                                        </label>
                                    </div>
                                    <div class='col-lg-2 '>
                                        <label class="label">Uso del Predio(Arbitrios):</label>
                                        <select id='dlg_sel_uspprearb' class="form-control" >
                                            @foreach ($upa as $upa)
                                            <option value='{{$upa->id_uso_arb}}' >{{$upa->uso_arbitrio}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group col-xs-3 " >                
                            <div class="panel panel-success">
                                <div class="panel-heading bg-color-success">.:: Foma de Adquisición ::.</div>
                                <div class="panel-body cr-body">
                                    <div class='col-lg-7 pd_dlg_cr'>
                                        <label class="label">Forma de Adquisición:</label>
                                        <select id='dlg_sel_foradq' class="form-control" >
                                                @foreach ($fadq as $fadq)
                                                <option value='{{$fadq->id_for}}' >{{$fadq->des_for_adq}}</option>
                                                @endforeach
                                        </select>
                                    </div>
                                    <div class='col-lg-4'>
                                        <label class="label">Fecha:</label>
                                        <label class="input">
                                            <input id="dlg_inp_fech" type="text"  class="input-sm"  data-mask="99/99/9999" data-mask-placeholder="-" >
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group col-xs-3 " >                
                            <div class="panel panel-success cr-panel-sep">
                                <div class="panel-heading bg-color-success">.:: Servicios Básicos ::.</div>
                                <div class="panel-body cr-body">
                                    <div class='col-lg-5 pd_dlg_cr' >
                                        <label class="label">Luz:</label>
                                        <label class="input">
                                            <input id="dlg_inp_luz" type="text"  class="input-sm" maxlength="10" >
                                        </label>
                                    </div>
                                    <div class='col-lg-5'>
                                        <label class="label">Agua:</label>
                                        <label class="input">
                                            <input id="dlg_inp_agua" type="text"  class="input-sm" maxlength="10">
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group col-xs-2 " >                
                            <div class="panel panel-success cr-panel-sep">
                                <div class="panel-heading bg-color-success">.:: Licencia de Construcción ::.</div>
                                <div class="panel-body cr-body">
                                    <div class="col-lg-1"></div>
                                    <div class='col-lg-5 '>
                                        <label class="col-xs-4 cr-lb-radio">Si:</label>
                                        <div class="col-xs-5">
                                            <input name="dlg_rd_lcons" type="radio" value="1" >
                                        </div>
                                    </div>
                                    <div class='col-lg-5 ' >
                                        <label class="col-xs-4 cr-lb-radio">No:</label>
                                        <div class="col-xs-5">
                                            <input name="dlg_rd_lcons" type="radio" checked="" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group col-xs-2 " >                
                            <div class="panel panel-success cr-panel-sep">
                                <div class="panel-heading bg-color-success">.:: Conformidad de Obra ::.</div>
                                <div class="panel-body cr-body">
                                    <div class="col-lg-1"></div>
                                    <div class='col-lg-5 '>
                                        <label class="col-xs-4 cr-lb-radio">Si:</label>
                                        <div class="col-xs-5">
                                        <input name="dlg_rd_confobr" type="radio" value="1" >
                                        </div>
                                    </div>
                                    <div class='col-lg-5 ' >
                                        <label class="col-xs-4 cr-lb-radio">No:</label>
                                        <div class="col-xs-5">
                                            <input name="dlg_rd_confobr" type="radio" checked="" value="0">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel-group col-xs-2 " >                
                            <div class="panel panel-success cr-panel-sep">
                                <div class="panel-heading bg-color-success">.:: Declaratoria de Fábrica ::.</div>
                                <div class="panel-body cr-body">
                                    <div class="col-lg-1"></div>
                                    <div class='col-lg-5 '>
                                        <label class="col-xs-4 cr-lb-radio">Si:</label>
                                        <div class="col-xs-5">
                                            <input name="dlg_rd_defra" type="radio" value="1" >
                                        </div>
                                    </div>
                                    <div class='col-lg-5 ' >
                                        <label class="col-xs-4 cr-lb-radio">No:</label>
                                        <div class="col-xs-5">
                                            <input name="dlg_rd_defra" type="radio" checked="" value="0" >
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                    <div class="col-xs-12 cr-body">
                            <ul id="sparks">                                        
                                        <button type="button" id="btnsavepre" class="btn btn-labeled bg-color-green txt-color-white" onclick="dlgSave();">
                                            <span class="cr-btn-label"><i class="glyphicon glyphicon-save"></i></span>Guardar Predio
                                        </button>
                                        <button  type="button" id="btnmodpre" class="btn btn-labeled bg-color-blue txt-color-white" onclick="dlgUpdate();">
                                            <span class="cr-btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar Predio
                                        </button>
                                        
                                        
                            </ul>
                    </div> 
                    <div class="col-xs-12" style="margin-top: 5px; margin-bottom: 10px">
                            <ul id="tabs1" class="nav nav-tabs bordered">
                                <li class="active">
                                    <a href="#s1" data-toggle="tab" aria-expanded="true">
                                        Construcciones
                                        <i class="fa fa-fw fa-lg fa-gear"></i>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#s2" data-toggle="tab" aria-expanded="false">
                                        Otras Instalaciones
                                        <i class="fa fa-fw fa-lg fa-gear"></i>
                                    </a>
                                </li>
                                <li class="">
                                    <a href="#s3" data-toggle="tab" aria-expanded="false">
                                        Condominios
                                        <i class="fa fa-fw fa-lg fa-gear"></i>
                                    </a>
                                </li>
                            </ul>
                            <div id="myTabContent1" class="tab-content padding-10">
                                <div id="s1" class="tab-pane fade active in" style="height: 300px">
                                        <div class="col-xs-10">
                                            <table id="table_pisos" ></table>
                                            <div id="pager_table_pisos"></div>
                                        </div>
                                        <div class="col-xs-2">
                                            <button class="btn bg-color-green txt-color-white cr-btn-big" onclick="clicknewpiso()" >
                                                <span>
                                                    <i class="glyphicon glyphicon-plus-sign"></i>
                                                </span>
                                                <label>Nuevo Piso</label>
                                            </button>
                                            <button class="btn bg-color-blue txt-color-white cr-btn-big" onclick="clickmodpiso()" >
                                                <span>
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </span>
                                                <label>Editar Piso</label>
                                            </button>
                                            <button class="btn bg-color-red txt-color-white cr-btn-big" >
                                                <span>
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </span>
                                                <label>Borrar Piso</label>
                                            </button>
                                        </div>
                                </div>
                                <div id="s2" class="tab-pane fade" style="height: 300px">s2</div>
                                <div id="s3" class="tab-pane fade" style="height: 300px">
                                    <div class="col-xs-10">
                                            <table id="table_condos" ></table>
                                            <div id="pager_table_condos"></div>
                                        </div>
                                        <div class="col-xs-2">
                                            <button class="btn bg-color-green txt-color-white cr-btn-big" onclick="clicknewcondo()" >
                                                <span>
                                                    <i class="glyphicon glyphicon-plus-sign"></i>
                                                </span>
                                                <label>Nuevo Cond</label>
                                            </button>
                                            <button class="btn bg-color-blue txt-color-white cr-btn-big" onclick="clickmodcondo()" >
                                                <span>
                                                    <i class="glyphicon glyphicon-edit"></i>
                                                </span>
                                                <label>Editar Cond</label>
                                            </button>
                                            <button class="btn bg-color-red txt-color-white cr-btn-big" >
                                                <span>
                                                    <i class="glyphicon glyphicon-trash"></i>
                                                </span>
                                                <label>Borrar Cond</label>
                                            </button>
                                        </div>
                                </div>
                            </div>
                    </div>    
                </div>
</div>
<div id="dlg_reg_piso" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important">
                    <div class="panel-heading bg-color-success">.:: Datos del piso ::.</div>
                    <div class="panel-body cr-body">
                        <div class='col-lg-3 pd_dlg_cr'>
                            <input type="hidden" id="dlg_idpiso" value="0">
                            <label class="label">N° Piso:</label>
                            <label class="input">
                                <input id="rpiso_inp_nro" type="text"  class="input-sm" maxlength="5" >
                            </label>
                        </div>
                        <div class='col-lg-3 '>
                            <label class="label">Fecha:</label>
                            <label class="input">
                                <input id="rpiso_inp_fech" type="text"  class="input-sm" data-mask="99/99/9999" data-mask-placeholder="-" >
                            </label>
                        </div>
                        <div class="col-xs-12"></div>
                        <div class='col-xs-3 pd_dlg_cr'>
                            <label class="label">Clasificación:</label>
                            <select id='rpiso_inp_clasi' class="form-control col-lg-8" onchange="callchangeoption('rpiso_inp_clasi')">
                                @foreach ($pisclasi as $pisclasi)
                                <option value='{{$pisclasi->id_cla_pre}}' descri="{{$pisclasi->desc_clasific}}" >{{$pisclasi->id_cla_pre}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class='col-xs-8'>
                            <label class="label">&nbsp;</label>
                            <label class="input">
                                <input id="rpiso_inp_clasi_des" type="text"  class="input-sm" disabled="">
                            </label>
                        </div>
                        <div class="col-xs-12"></div>
                        <div class='col-lg-3 pd_dlg_cr'>
                            <label class="label">Material:</label>
                            <select id='rpiso_inp_mat' class="form-control col-lg-8" onchange="callchangeoption('rpiso_inp_mat')">
                                @foreach ($pismat as $pismat)
                                <option value='{{$pismat->id_mep}}' descri="{{$pismat->mep}}" >{{$pismat->id_mep}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class='col-xs-8'>
                            <label class="label">&nbsp;</label>
                            <label class="input">
                                <input id="rpiso_inp_mat_des" type="text"  class="input-sm" disabled="">
                            </label>
                        </div>
                        <div class="col-xs-12"></div>
                        <div class='col-lg-3 pd_dlg_cr'>
                            <label class="label">Estado Conservación:</label>
                            <select id='rpiso_inp_econserv' class="form-control col-lg-8" onchange="callchangeoption('rpiso_inp_econserv')">
                                @foreach ($pisecs as $pisecs)
                                <option value='{{$pisecs->id_ecs}}' descri="{{$pisecs->ecs}}" >{{$pisecs->id_ecs}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class='col-xs-8'>
                            <label class="label">&nbsp;</label>
                            <label class="input">
                                <input id="rpiso_inp_econserv_des" type="text"  class="input-sm" disabled="">
                            </label>
                        </div>
                        <div class="col-xs-12"></div>
                        <div class='col-lg-3 pd_dlg_cr'>
                            <label class="label">Estado Construcción:</label>
                            <select id='rpiso_inp_econstr' class="form-control col-lg-8" onchange="callchangeoption('rpiso_inp_econstr')">
                                @foreach ($ecc2 as $ecc2)
                                <option value='{{$ecc2->id_ecc}}' descri="{{$ecc2->descripcion}}" >{{$ecc2->id_ecc}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                        <div class='col-xs-8'>
                            <label class="label">&nbsp;</label>
                            <label class="input">
                                <input id="rpiso_inp_econstr_des" type="text"  class="input-sm" disabled="">
                            </label>
                        </div>
                        <div class="col-xs-12"></div>
                        <div class='col-lg-5 pd_dlg_cr'>
                            <label class="label">Estructuras:</label>
                            <label class="input">
                                <input id="rpiso_inp_estruc" type="text"  class="input-sm" maxlength="7" placeholder="7 Letras Entre A-I">
                            </label>
                        </div>
                        
                        <div class='col-lg-3 '>
                            <label class="label">Area Construida:</label>
                            <label class="input">
                                <input id="rpiso_inp_aconst" type="text"  class="input-sm text-right" placeholder="0.00" onkeypress="return soloNumeroTab(event);" >
                            </label>
                        </div>
                        <div class='col-lg-3'>
                            <label class="label">Areas Comunes:</label>
                            <label class="input">
                                <input id="rpiso_inp_acomun" type="text"  class="input-sm text-right" placeholder="0.00" onkeypress="return soloNumeroTab(event);" >
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>             
<div id="dlg_reg_condo" style="display: none;">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important">
                    <div class="panel-heading bg-color-success">.:: Datos del piso ::.</div>
                    <div class="panel-body cr-body">
                        <div class='col-lg-3 pd_dlg_cr'>
                            <input type="hidden" id="dlg_idcondo" value="0">
                            <label class="label">DNI/RUC:</label>
                            <label class="input">
                                <input id="rcondo_inp_dni" type="text"  class="input-sm" maxlength="12" onkeypress="return soloDNI(event);" placeholder="DNI/RUC" >
                            </label>
                        </div>
                        <div class='col-lg-3 '>
                            <label class="label">Apellidos Nombres o Razon Social:</label>
                            <label class="input">
                                <input id="rcondo_inp_rsoc" type="text"  class="input-sm" disabled="" >
                            </label>
                        </div>
                        <div class="col-xs-12"></div>
                        <div class='col-xs-8 pd_dlg_cr'>
                            <label class="label">Dirección:</label>
                            <label class="input">
                                <input id="rcondo_inp_dir" type="text"  class="input-sm" placeholder="Ingresar Dirección" maxlength="150">
                            </label>
                            
                        </div>
                        <div class='col-xs-4'>
                            <label class="label">&nbsp;</label>
                            <label class="input">
                                <input id="rcondo_inp_porcent" type="text"  class="input-sm" >
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>             
@endsection




