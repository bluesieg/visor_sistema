@extends('layouts.gerencia_obras_pub_infra')
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
                                            
                                        <h1><b>MODULO DE APOYO</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">SOLICITUD:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_solicitud" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR SOLICITUD">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_solicitud();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                            <div class="col-xs-5 text-center">

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="nuevo_apoyo();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>NUEVO
                                                </button>
                                                
                                                 <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_apoyo();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>MODIFICAR
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_apoyo"></table>
                                                        <div id="pager_table_apoyo"></div>
                                                </article>
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
        
        jQuery("#table_apoyo").jqGrid({
            url: 'sub_geren_apoyo_matenimiento/0?grid=apoyo',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'SOLICITUD', 'NOMB. ASOCIACION','MONTO','FECHA EJECUCION'],
            rowNum: 50, sortname: 'id_apoyo', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE EXPEDIENTES APOYO - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_apoyo', index: 'id_apoyo', hidden: true},
                {name: 'solicitud', index: 'solicitud', align: 'center', width: 25},
                {name: 'nombre_asoc', index: 'nombre_asoc', align: 'center', width: 30},
                {name: 'monto', index: 'monto', align: 'center', width: 10},
                {name: 'fecha_ejecucion', index: 'fecha_ejecucion', align: 'center', width: 15}
            ],
            pager: '#pager_table_apoyo',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_apoyo').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_apoyo').jqGrid('getDataIDs')[0];
                            $("#table_apoyo").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_apoyo();}
        });
        
        $("#dlg_buscar_solicitud").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_solicitud();

            }
        });
        
        $("#dlg_dni_encargado").keypress(function (e) {
            if (e.which == 13) {
                consultar_dni($("#dlg_dni_encargado").val(),'hidden_dlg_encargado','dlg_encargado');
            }
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/gerencia_obras_pub_infra/apoyo.js') }}"></script>

<div id="dlg_nuevo_apoyo" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS PERSONA</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">DNI: &nbsp;<i class="fa fa-credit-card"></i></span>
                    <div>
                        <input id="dlg_dni_encargado" type="text" maxlength="8" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">RESPONSABLE ENCARGADO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_encargado" value="0">
                        <input id="dlg_encargado" type="text" maxlength="250" class="form-control text-uppercase" style="height: 30px;"  disabled="">
                    </div>
                </div>
            </div> 
        </div>
    </div>
    </div>
    
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">INFORMACION APOYO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">SOLICITUD: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_solicitud" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div> 
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE DE LA ASOC. VIV.: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_nomb_asoc" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DESCRIPCION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <textarea id="dlg_descripcion" rows="8" type="text" class="form-control text-uppercase" style="height: 120px;"></textarea>
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">MONTO: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_monto" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-4" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 192px">CONVENIO: &nbsp;<i class="fa fa-angle-up"></i></span>
                    <div>
                        <input id="chkbox_convenio" type="checkbox" class="form-control" style="height: 30px;">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">INVERSION DE LA MDCC: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_inversion" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;" onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">FECHA DE EJECUCION: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_fecha_ejecucion" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 30px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                    </div>
                </div>
            </div>
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DISPONIBILIDAD PRESUPUESTAL: &nbsp;<i class="fa fa-user"></i></span>
                    <div>
                        <input id="dlg_dispon_presupuestal" type="text" maxlength="255" class="form-control text-uppercase" style="height: 30px;">
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    </div>
    
</div>

@include('vw_personas')

@endsection

