@extends('layouts.gerencia_seg_ciud')
@section('content')
<style>
        
        .ol-touch .rotate-north {
            top: 80px;
        }
        .ol-mycontrol {
            background-color: rgba(255, 255, 255, 0.4);
            border-radius: 4px;
            padding: 2px;
            position: absolute;
            width:300px;
            top: 5px;
            left:40px;
        }
        #legend{
        right:10px; 
        top:20px; 
        z-index:10000; 
        width:130px; 
        height:370px; 
        background-color:#FFFFFF;
        display: none;
        }
    </style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <div class="row">                    
                    
                    <section class="col col-lg-12">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                        <div class="col-xs-12">
                                            
                                        <h1 ><b>MANTENIMIENTO DE COMISARIAS</b></h1>
                                        
                                       <div class="text-right" style=" padding-top: 20px">

                                           <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_comisaria();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nueva Comisaria
                                           </button>

                                           <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_comisarias();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar Comisaria
                                           </button>

                                          
                                           <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_comisarias"></table>
                                                        <div id="pager_table_comisarias"></div>
                                                </article>
                                            </div>


                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                            </div>
                           </div>
                        </section>
                    </section>
                </div>
            </div>            
        </div>       
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function (){
        
        jQuery("#table_comisarias").jqGrid({
            url: 'comisarias/0?grid=comisarias',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_inspector', 'COMISARIA', 'UBICACION', 'TEL.COMISARIA','COMISARIO','TEL. COMISARIO'],
            rowNum: 10, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE COMISARIAS REGISTRADAS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id', index: 'id', hidden: true},
                {name: 'nombre', index: 'nombre', align: 'left', width: 30},
                {name: 'ubicacion', index: 'ubicacion', align: 'left', width: 50},
                {name: 'tlfno_comsaria', index: 'tlfno_comsaria', align: 'left', width: 14},
                {name: 'comisario', index: 'ubicacion', align: 'left', width: 20},
                {name: 'tlefno_comisario', index: 'tlfno_comsaria', align: 'left', width: 15}
            ],
            pager: '#pager_table_comisarias',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_comisarias').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_comisarias').jqGrid('getDataIDs')[0];
                            $("#table_comisarias").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_comisarias();}
        });
        
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_seg_ciud/comisarias.js') }}"></script>

<div id="dlg_nuevo_comisarias" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <form id="FormularioComisarias" name="FormularioComisarias" method="post" enctype="multipart/form-data">
            <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
            <div class="col-xs-8" style="padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 175px">NOMBRE COMISARIA: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="dlg_nombre_comisaria" name="dlg_nombre_comisaria" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 165px">TEL. COMISARIA: &nbsp;<i class="fa fa-phone"></i></span>
                    <div> 
                        <input id="dlg_telefono_comisaria" name="dlg_telefono_comisaria" type="text" class="form-control" style="height: 30px;" maxlength="20" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
                
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">UBICACION: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input id="dlg_ubicacion" type="text" name="dlg_ubicacion" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>

            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE COMISARIO: &nbsp;<i class="fa fa-user-secret"></i></span>
                    <div>
                        <input id="dlg_nombre_comisario" type="text" name="dlg_nombre_comisario" maxlength="150" class="form-control text-uppercase" style="height: 30px;"  >
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 165px">TEL. COMISARIO: &nbsp;<i class="fa fa-phone"></i></span>
                    <div>
                        <input id="dlg_telefono_comisario" type="text" name="dlg_telefono_comisario" maxlength="20" class="form-control" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-6" style="padding: 0px; margin-top:10px"> 
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">Nº EFECTIVOS: &nbsp;<i class="fa fa-user-plus"></i></span>
                    <div>
                        <input id="dlg_nro_efectivos" type="text" name="dlg_nro_efectivos" class="form-control" maxlength="20" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>

            <div class="col-xs-6" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 160px">Nº VEHICULOS: &nbsp;<i class="fa fa-car"></i></span>
                    <div>
                        <input id="dlg_nro_vehiculos" type="text" name="dlg_nro_vehiculos" class="form-control" style="height: 30px;" maxlength="20" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FOTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_foto_comisario" name="dlg_foto_comisario" type="file" class="form-control" style="height: 30px;">
                    </div>
                </div>
            </div>

            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-search"></i></span>
                    <div>
                        <textarea id="dlg_observaciones" name="dlg_observaciones" type="text" class="form-control text-uppercase" style="height: 60px;" row="4"></textarea>
                    </div>
                </div> 
            </div>
            
            <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">OBSERVACIONES: &nbsp;<i class="fa fa-search"></i></span>
                    <div id="imagen">
                        <img id="foto_comisario" style="max-height:250px; max-width:400px">
                    </div>
                </div> 
            </div>
            
            
            
            </form>        
        </div>
    </div>
    </div>
</div>


@endsection

