@extends('layouts.procuraduria')
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
                        <ul id="tabs1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" data-toggle="tab" aria-expanded="true" onclick="actualizar_grilla();">
                                    EXPEDIENTES
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                   ADJUNTAR DOCUMENTOS
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>                            
                        </ul>
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                        <div id="s1" class="tab-pane fade active in">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 0px">
                                        <div class="col-xs-12">                                            
                                        <h1 ><b>MANTENIMIENTO DE EXPEDIENTES</b></h1>
                                        <div class="text-right" style=" padding-top: 20px">

                                             <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_exp_procuraduria();">
                                                     <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                             </button>
                                             <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_exp_procuraduria();">
                                                 <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                             </button>
                                             <button  type="button" class="btn btn-labeled btn-danger" onclick="del_exp_procuraduria();">
                                                 <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                             </button>
                                             <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                 <article class="col-xs-12" style=" padding: 0px !important">
                                                         <table id="table_expedientes"></table>
                                                         <div id="pager_table_expedientes"></div>
                                                 </article>
                                             </div>

                                        </div>
                                        </div>
                                        
                                    </section>
                                    
                                </div>
                                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                    <article class="col-xs-12" style=" padding: 0px !important">
                                            <table id="table_recdocumentos"></table>
                                            <div id="pager_table_recdocumentos"></div>
                                    </article>
                                </div>
                            </div>
                           </div>
                        </section>
                        
                      </div>
                        
                        <div id="s2" class="tab-pane fade" style="height: auto">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 ><b>ADJUNTAR DOCUMENTOS</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                                   <input  id="fec_ini_asignacion" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('01/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; ">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                    <input id="fec_fin_asignacion" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                    
                                        <div class="col-lg-3" style="padding-right: 0px; padding-top: 20px; ">
                                            <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="seleccionafecha_asignacion();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span> BUSCAR
                                            </button>
                                        </div>
                                    
                                       <div class="text-right" style=" padding-top: 20px">

                                           <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nueva_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                           </button>

                                           <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                           </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_exp_asignacion();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>
                                           
                                       </div>
                                        </div>
                                        
                                    </section>
                                    
                                    </div>
                                        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                            <article class="col-xs-11" style=" padding: 0px !important">
                                                    <table id="table_asignacion"></table>
                                                    <div id="pager_table_asignacion"></div>
                                            </article>
                                        </div>
                                    </div>
                                </div>
                        </section>
                        </div>
                    </div> 
                        
                   </section>
                </div>
            </div>            
        </div>       
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function (){
        
        jQuery("#table_recdocumentos").jqGrid({
            url: 'get_documentos',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'NUMERO EXPEDIENTE','FASE','GESTOR','FECHA INICIO TRAMITE','FECHA REGISTRO'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'RECEPCION DE DOCUMENTOS', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'nro_exp', index: 'nro_exp', align: 'left', width: 20},
                {name: 'fase', index: 'fase', align: 'left', width: 10},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 20},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 20}
            ],
            pager: '#pager_table_table_recdocumentos',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_recdocumentos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_recdocumentos').jqGrid('getDataIDs')[0];
                            $("#table_recdocumentos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_documento();}
        });
        
        fecha_inicio_verif_tec = $('#fec_ini_verif_tecnica').val();
        fecha_fin_verif_tec = $('#fec_fin_verif_tecnica').val();
        jQuery("#table_verif_tecnica").jqGrid({
            url: 'get_verif_tecnica?fecha_inicio='+fecha_inicio_verif_tec+'&fecha_fin='+fecha_fin_verif_tec,
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID', 'CODIGO INTERNO','FECHA REGISTRO','DOC. GESTOR','GESTOR','MODALIDAD'],
            rowNum: 50, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'VERIFICACION TECNICA', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', align: 'left',width: 20, hidden: true},
                {name: 'cod_interno', index: 'nro_exp', align: 'left', width: 150},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 120},
                {name: 'nro_doc_gestor', index: 'nro_doc_gestor', align: 'left', width: 100},
                {name: 'gestor', index: 'gestor', align: 'left', width: 150},
                {name: 'descr_procedimiento', index: 'descr_procedimiento', align: 'left', width: 480}
            ],
            pager: '#pager_table_verif_tecnica',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_verif_tecnica').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_verif_tecnica').jqGrid('getDataIDs')[0];
                            $("#table_verif_tecnica").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_verif_tecnica()}
        });
        
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/procuraduria/procuraduria.js') }}"></script>

<div id="dlg_nuevo_exp" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_cod_exp" type="text" class="form-control" style="height: 30px;" maxlength="20">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="dlg_new_exp_procuraduria" style="display: none;">
     <section class="col col-lg-12">
                        <ul id="tab_insp1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#insp1" data-toggle="tab" aria-expanded="true">
                                    Datos Expedientes
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#insp2" data-toggle="tab" aria-expanded="false">
                                   Datos mapa
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                        </ul>
        
                        <div id="myTabContent1" class="tab-content padding-1"> 
                            <input type="hidden" id="hidden_ide_inps" value="0">
                            <div id="insp1" class="tab-pane fade active in">
                                <section class="col col-lg-12">
                                  <div class="widget-body">
                                   <div  class="smart-form">
                                      <div>
                                           <section class="col-xs-12">
                                               <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;margin-right: 15px;">
                                                   <div class="col-xs-12 cr-body" style="padding-left:10px" >
                                                        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                                                                                                                         
                                                            <div class="col-xs-7" style="padding-left: 0px;">
                                                                <div class="input-group input-group-md">
                                                                   <span class="input-group-addon" style="width: 180px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                       <div>
                                                                           <input type="hidden"id="hidden_inp_cod_exp_lote" value="0"/>
                                                                           <input id="inp_cod_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="20" >
                                                                       </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-3" style="padding-left: 0px;">
                                                                <button style="width: 100%" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="map_reg_lote();">
                                                                    <span class="btn-label"><i class="glyphicon glyphicon-globe"></i></span>Buscar 
                                                                </button>
                                                            </div>
                                                            <div class="col-xs-12" style="padding: 0px; ">
                                                                   <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                                                                       <span class="input-group-addon" style="width: 180px">DNI/RUC: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                       <div>
                                                                           <input type="hidden"id="hidden_inp_cod_exp_lote" value="0"/>
                                                                           <input id="inp_cod_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="20" >
                                                                       </div>
                                                                       <span class="input-group-addon" style="width: 180px">Fecha Inicio: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                       <div>
                                                                           <input type="hidden"id="hidden_inp_cod_exp_lote" value="0"/>
                                                                           <input id="inp_cod_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="20" >
                                                                       </div>
                                                                   </div>
                                                                   <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                                                                       <span class="input-group-addon" style="width: 180px">Gestor: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                       <div>
                                                                           <input id="inp_posesionario_exp_lote" type="text" class="form-control" style="height: 30px;"  disabled="">
                                                                       </div>
                                                                   </div>                                                                
                                                               </div>
                                                           </div>    

                                               </div> 
    </div>
                                           </section>
                                          <section class="col-xs-12">
                                               <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;margin-right: 15px;">
                                                   <div class="col-xs-12 cr-body" style="padding-left:10px" >
                                                        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                                                              
                                                            <div class="col-xs-12" style="padding: 0px; ">
                                                                   <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                                                                       <span class="input-group-addon" style="width: 180px">Responsable: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                       <div>
                                                                           <input type="hidden"id="hidden_inp_cod_exp_lote" value="0"/>
                                                                           <input id="inp_cod_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="20" >
                                                                       </div>
                                                                       <span class="input-group-addon" style="width: 180px">Tipo: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                       <div>
                                                                           <input type="hidden"id="hidden_inp_cod_exp_lote" value="0"/>
                                                                           <input id="inp_cod_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="20" >
                                                                       </div>
                                                                   </div>
                                                                   <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                                                                       <span class="input-group-addon" style="width: 180px">Habilitación: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                       <div>
                                                                           <input id="inp_posesionario_exp_lote" type="text" class="form-control" style="height: 30px;"  >
                                                                       </div>
                                                                   </div> 
                                                                   <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                                                                      <span class="input-group-addon" style="width: 180px">Codigo: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                      <div>
                                                                          <input type="hidden"id="hidden_inp_cod_exp_lote" value="0"/>
                                                                          <input id="inp_cod_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="20" >
                                                                      </div>
                                                                      <span class="input-group-addon" style="width: 180px">Codigo: &nbsp;<i class="fa fa-hashtag"></i></span>
                                                                      <div>
                                                                          <input type="hidden"id="hidden_inp_cod_exp_lote" value="0"/>
                                                                          <input id="inp_cod_exp_lote" type="text" class="form-control" style="height: 30px;" maxlength="20" >
                                                                      </div>
                                                                  </div>
                                                               </div>
                                                           </div>    

                                               </div> 
    </div>
                                           </section>
                                     </div>
                                   </div>



                            </div>
                                </section>
                            </div>
                            <div id="insp2" class="tab-pane fade" style="height: auto">
                                <section class="col col-lg-12">
                                  <div class="widget-body">
                                   <div  class="smart-form">
                                    
                                     <div class='cr_content col-xs-12 ' style="padding-bottom:  1px;padding-bottom:  1px;">
                                         <section class="col-xs-12">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                   <div class="panel-heading bg-color-success">Vecino 01</div>
                                                        <div class="col col-xs-2">
                                                            <label class="label">DNI:</label>
                                                            <label class="input">
                                                                <input id="inp_dni_vec1" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-10">
                                                            <label class="label">Nombre y Apellidos:</label>
                                                            <label class="input">
                                                                <input id="inp_nom_vec1" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-12">
                                                            <label class="label">Dirección:</label>
                                                            <label class="input">
                                                                <input id="inp_dir_vec1" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                </div>  
                                               
                                              </div>  
                                         </section>
                                          <section class="col-xs-12">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                   <div class="panel-heading bg-color-success">Vecino 02</div>
                                                        <div class="col col-xs-2">
                                                            <label class="label">DNI:</label>
                                                            <label class="input">
                                                                <input id="inp_dni_vec2" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-10">
                                                            <label class="label">Nombre y Apellidos:</label>
                                                            <label class="input">
                                                                <input id="inp_nom_vec2" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-12">
                                                            <label class="label">Dirección:</label>
                                                            <label class="input">
                                                                <input id="inp_dir_vec2" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                </div>  
                                               
                                              </div>  
                                         </section>
                                          <section class="col-xs-12">
                                              <div class='cr_content col-xs-12 ' style="margin-top:5px; padding-bottom:  1px;padding-top:  0px">
                                                <div class="col-xs-12 cr-body panel-success" >
                                                   <div class="panel-heading bg-color-success">Vecino 03</div>
                                                        <div class="col col-xs-2">
                                                            <label class="label">DNI:</label>
                                                            <label class="input">
                                                                <input id="inp_dni_vec3" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-10">
                                                            <label class="label">Nombre y Apellidos:</label>
                                                            <label class="input">
                                                                <input id="inp_nom_vec3" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                        <div class="col col-xs-12">
                                                            <label class="label">Dirección:</label>
                                                            <label class="input">
                                                                <input id="inp_dir_vec3" type="text"  class="input-sm" autofocus="">
                                                            </label>
                                                        </div>
                                                </div>  
                                               
                                              </div>  
                                         </section>
                                     </div>
                                    <form id="FormularioFiles" name="FormularioFiles" method="post" enctype="multipart/form-data">
                                        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
                                        <div class='cr_content col-xs-12 ' style="padding-bottom:  1px;padding-bottom:  1px;">
                                           <section class="col-xs-4 ">
                                                   <div class="col-xs-12 cr-body panel-success"style="height: 161px;overflow-y: scroll;" >
                                                      <div class="panel-heading bg-color-success">Foto del Predio 1</div>
                                                         <div class="col col-xs-12">
                                                                  <div class="panel-body cr-body">
                                                                      <input type="hidden" id="hidden_inp_foto_pred1" name="hidden_inp_foto_pred1" value="0">
                                                                      <div id="inp_foto_pred1" style="padding: 5px; ">

                                                                      </div>
                                                                   </div>
                                                          </div>
                                                   </div>  
                                                   <div class="col-xs-12 cr-body panel-success" >
                                                       <div class="col col-xs-12" >
                                                           <section>
                                                               <div class="input input-file col-xs-10" style="padding: 0px">
                                                                   <span class="button " style="padding-top: 5px;padding-bottom: 5px"><input type="file" id="file1" name="file1">Subir imagen</span><input id="textfile1" type="text" placeholder="Incluir Archivo" readonly="" style="height: 39px">
                                                               </div>
                                                               <div class="col-xs-2"  style="padding: 0px">
                                                                   <button type="button" class="btn btn-danger btn-lg"style="margin-left:10px;"onclick="borrar_foto(1);">
                                                                       <span class="glyphicon glyphicon-trash"></span> 
                                                                   </button>
                                                               </div>
                                                           </section>

                                                          </div>  

                                                   </div> 
                                            </section>

                                           <section class="col-xs-4 ">
                                                   <div class="col-xs-12 cr-body panel-success"style="height: 161px;overflow-y: scroll;" >
                                                      <div class="panel-heading bg-color-success">Foto del Predio 2</div>
                                                         <div class="col col-xs-12">
                                                                      <input type="hidden" id="hidden_inp_foto_pred2" name="hidden_inp_foto_pred2" value="0">
                                                                  <div class="panel-body cr-body">
                                                                      <div id="inp_foto_pred2" style="padding: 5px; ">

                                                                      </div>
                                                                   </div>
                                                          </div>
                                                   </div>  
                                                   <div class="col-xs-12 cr-body panel-success" >
                                                       <div class="col col-xs-12" >
                                                           <section>
                                                               <div class="input input-file col-xs-10" style="padding: 0px">
                                                                   <span class="button " style="padding-top: 5px;padding-bottom: 5px"><input type="file" id="file2" name="file2">Subir imagen</span><input id="textfile2" type="text" placeholder="Incluir Archivo" readonly="" style="height: 39px">
                                                               </div>
                                                               <div class="col-xs-2"  style="padding: 0px">
                                                                   <button type="button" class="btn btn-danger btn-lg"style="margin-left:10px;"onclick="borrar_foto(2);">
                                                                       <span class="glyphicon glyphicon-trash"></span> 
                                                                   </button>
                                                               </div>
                                                           </section>

                                                          </div>  

                                                   </div> 
                                            </section>

                                           <section class="col-xs-4 ">
                                                   <div class="col-xs-12 cr-body panel-success"style="height: 161px;overflow-y: scroll;" >
                                                      <div class="panel-heading bg-color-success">Foto del Predio 3</div>
                                                         <div class="col col-xs-12">
                                                                      <input type="hidden" id="hidden_inp_foto_pred3" name="hidden_inp_foto_pred3" value="0">
                                                                  <div class="panel-body cr-body">
                                                                      <div id="inp_foto_pred3" style="padding: 5px;  ">

                                                                      </div>
                                                                   </div>
                                                          </div>
                                                   </div>  
                                                   <div class="col-xs-12 cr-body panel-success" >
                                                       <div class="col col-xs-12" >
                                                           <section>
                                                               <div class="input input-file col-xs-10" style="padding: 0px">
                                                                   <span class="button " style="padding-top: 5px;padding-bottom: 5px"><input type="file" id="file3" name="file3">Subir imagen</span><input id="textfile3" type="text" placeholder="Incluir Archivo" readonly="" style="height: 39px">
                                                               </div>
                                                               <div class="col-xs-2"  style="padding: 0px">
                                                                   <button type="button" class="btn btn-danger btn-lg"style="margin-left:10px;"onclick="borrar_foto(3);">
                                                                       <span class="glyphicon glyphicon-trash"></span> 
                                                                   </button>
                                                               </div>
                                                           </section>
                                                          </div>  
                                                   </div> 
                                            </section>

                                           <section class="col-xs-12 ">
                                                   <div class="col-xs-12 cr-body panel-success"style="height: 161px;overflow-y: scroll;" >
                                                      <div class="panel-heading bg-color-success">Subir Firma (.jpg)</div>
                                                         <div class="col col-xs-12">
                                                                      <input type="hidden" id="hidden_inp_foto_pred4" name="hidden_inp_foto_pred4" value="0">
                                                                  <div class="panel-body cr-body">
                                                                      <div id="inp_foto_pred4" style="padding: 5px;  ">

                                                                      </div>
                                                                   </div>
                                                          </div>
                                                   </div>  
                                                   <div class="col-xs-12 cr-body panel-success" >
                                                       <div class="col col-xs-12" >
                                                           <section>
                                                               <div class="input input-file col-xs-4" style="padding: 0px">
                                                                   <span class="button " style="padding-top: 5px;padding-bottom: 5px"><input type="file" id="file4" name="file4">Subir imagen</span><input id="textfile4" type="text" placeholder="Incluir Archivo" readonly="" style="height: 39px">
                                                               </div>
                                                               <div class="col-xs-1"  style="padding: 0px">
                                                                   <button type="button" class="btn btn-danger btn-lg"style="margin-left:10px;"onclick="borrar_foto(4);">
                                                                       <span class="glyphicon glyphicon-trash"></span> 
                                                                   </button>
                                                               </div>
                                                           </section>
                                                          </div>  
                                                   </div> 
                                            </section>
                                        </div>
                                    </form>
                                        
                                </div>



                            </div>
                                </section>
                            </div> 
                        </div>            
    </section>
</div>







@endsection

