@extends('layouts.map')
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
                                            
                                        <h1 ><b>MANTENIMIENTO DE INSPECTORES</b></h1>
                                        
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_inspector();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_insp();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                               </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_insp();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>

                                           <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_inspectores"></table>
                                                        <div id="pager_table_inspectores"></div>
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
        $("#menu_fisca").show();
        $("#li_fisca_carta").addClass('cr-active')
        fecha_desde = $("#dlg_fec_desde_inspec").val(); 
        fecha_hasta = $("#dlg_fec_hasta_inspec").val(); 
        
        jQuery("#table_inspectores").jqGrid({
            url: 'getInspectores',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_inspector', 'DNI', 'INSPECTOR'],
            rowNum: 200, sortname: 'id_inspector', sortorder: 'desc', viewrecords: true, caption: 'INSPECTORES', align: "center",
            colModel: [
                {name: 'id_inspector', index: 'id_inspector', hidden: true},
                {name: 'dni', index: 'dni', align: 'left', width: 20},
                {name: 'apenom', index: 'apenom', align: 'left', width: 80},
                
            ],
            pager: '#pager_table_inspectores',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_inspectores').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_inspectores').jqGrid('getDataIDs')[0];
                            $("#table_inspectores").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){actualizar_insp();}
        });
        
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/mantenimiento_inspectores.js') }}"></script>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/control_calidad.js') }}"></script>

<div id="dlg_nuevo_inspec" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">DNI: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_dni_inspec" type="text" class="form-control" style="height: 30px;" maxlength="8" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Nombre: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_nombre_inspec" type="text" class="form-control" style="height: 30px;" maxlength="30">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

