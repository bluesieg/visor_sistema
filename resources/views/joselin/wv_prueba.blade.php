@extends('layouts.licencia_edificacion')
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

                                        <div class="row">
                                            <div class="col-xs-6">
                                                <label>AÑO:</label>
                                                <label class="select">

                                                </label>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_procedimiento();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>COMISARIAS
                                                    </button>
                                                    <button type="button" class="btn btn-labeled bg-color-pink txt-color-white" onclick="crear_nuevo_delito();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>MAPA DEL DELITO
                                                    </button>
                                                    <button  type="button" class="btn btn-labeled bg-color-purple txt-color-white" onclick="Ruta_Serenazgo();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Ruta Serenazgo
                                                    </button>



                                                    <button  type="button" style="background-color:#46181e;" onclick="Zona_Riesgo();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span><label style="color:white">Construsciones de Zona Riesgo</label>
                                                    </button>

                                                    <button  type="button" style="background-color:#46181e;" onclick="Atencion_Riesgo();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                        <label style="color:white">Atencion Riesgo</label>
                                                    </button>

                                                    <button  type="button" style="background-color:#46181e;" onclick="dlg_Seguridad_Vial();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                        <label style="color:white">Seguridad Vial</label>
                                                    </button>
                                                    <button  type="button" style="background-color:#46181e;" onclick="dlg_Controlde_Pantallas();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                        <label style="color:white">Control de Pantallas</label>
                                                    </button>

                                                    <button  type="button" style="background-color:#46181e;" onclick="dlg_Abogados();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                        <label style="color:white">Abogados</label>
                                                    </button>
                                                    <button  type="button" style="background-color:#46181e;" onclick="dlg_Tipos();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                        <label style="color:white">Tipos</label>
                                                    </button>
                                                    <button  type="button" style="background-color:#46181e;" onclick="dlg_Proceso();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                        <label style="color:white">Proceso</label>
                                                    </button>
                                                    <button  type="button" style="background-color:#46181e;" onclick="dlg_Sancion();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                        <label style="color:white">Sancion</label>
                                                    </button>

                                                    <button  type="button" style="background-color:#46181e;" onclick="dlg_Materia();">
                                                        <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                        <label style="color:white">Materia</label>
                                                    </button>

                                                      <button  type="button" style="background-color:#46181e;" onclick="dlg_Caso();">
                                                      <span class="btn-label" style="color:white"><i class="glyphicon glyphicon-trash"></i></span>
                                                      <label style="color:white">Caso</label>
                                                      </button>






                                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        ...
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
                                                </div>
                                            </div>

                                            <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_procedimientos"></table>
                                                        <div id="pager_table_procedimientos"></div>
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

        jQuery("#table_procedimientos").jqGrid({
            url: 'get_procedimientos',
            datatype: 'json', mtype: 'GET',
            height: '280px', autowidth: true,
            toolbarfilter: true,
            colNames: ['CODIGO', 'PROCEDIMIENTOS'],
            rowNum: 50, sortname: 'id_procedimiento', sortorder: 'desc', viewrecords: true, caption: 'PROCEDIMIENTOS', align: "center",
            colModel: [
                {name: 'id_procedimiento', index: 'id_procedimiento', align: 'left',width: 20},
                {name: 'descr_procedimiento', index: 'descr_procedimiento', align: 'left', width: 80}
            ],
            pager: '#pager_table_procedimientos',
            rowList: [10, 20, 30, 40, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_procedimientos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_procedimientos').jqGrid('getDataIDs')[0];
                            $("#table_procedimientos").setSelection(firstid);
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_procedimiento();}
        });


    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/joselin.js') }}"></script>

<div id="dlg_nuevo_comisarias" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">


                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">Nombre Comisario: &nbsp;<i class="fa fa-user-secret"></i></span>
                        <div>
                            <input id="dlg_nombre_comisario" type="text" class="form-control text-center" style="height: 30px;"  >
                        </div>
                    </div>
                </div>


                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">Telefono: &nbsp;<i class="fa fa-phone"></i></span>
                        <div>
                            <input id="dlg_telefono" type="text" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);" >
                        </div>
                    </div>
                </div>

                <div class="col-xs-6" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">Cantidad Efectivos: &nbsp;<i class="fa fa-money"></i></span>
                        <div>
                            <input id="dlg_C_Efectivos" type="text" class="form-control" style="height: 30px;" row="4">
                        </div>
                    </div>
                </div>


                <div class="col-xs-6" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">telefono comisaria &nbsp;<i class="fa fa-user-times"></i></span>
                        <div>
                            <input id="dlg_t_Comisaria" type="text" class="form-control" style="height: 30px;" row="4">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 160px">Cantidad de Vehiculos &nbsp;<i class="fa fa-car"></i></span>
                        <div>
                            <input id="dlg_c_Vehiculos" type="text" class="form-control" style="height: 30px;" row="4">
                        </div>
                    </div>

                </div>

                 <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">Observaciones &nbsp;<i class="fa fa-search"></i></span>
                        <div>
                            <textarea id="dlg_c_Observaciones" type="text" class="form-control" style="height: 60px;" row="4"></textarea>
                        </div>
                    </div>

                </div>


            </div>
        </div>
    </div>
</div>


<div id="dlg_nuevo_mapa_delito" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">


                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 170px">Ubicacion: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_1_Ubicacion" type="text" class="form-control text-center" style="height: 30px;" >
                        </div>
                    </div>
                </div>


                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 170px">Tipo Delito: &nbsp;<i class="fa fa-get-pocket"></i></span>
                        <div>
                            <select id="dlg_Delito" type="text" class="form-control" style="height: 30px;" >

                                <option value="1" >leve</option>
                                <option value="2" >Moderado</option>
                                <option value="3" >grave</option>


                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 170px">Persona y/o Infractor: &nbsp;<i class="fa fa-user-plus"></i></span>
                        <div>
                            <input id="dlg_Persona" type="text" class="form-control" style="height: 30px;" row="4">
                        </div>
                    </div>
                </div>


                <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 170px">Encargado&nbsp;<i class="fa fa-phone"></i></span>
                        <div>
                            <input id="dlg_Encargado" type="text" class="form-control" style="height: 30px;" row="4">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 170px">Vehiculo &nbsp;<i class="fa fa-car"></i></span>
                        <div>
                            <input id="dlg_c_Vehiculos" type="text" class="form-control" style="height: 30px;" row="4">
                        </div>
                    </div>

                </div>



            </div>
        </div>
    </div>
</div>


<div id="dlg_rutas_serenazgo" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">


                <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 100px">Ubicacion: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_Ubicacion" type="text" class="form-control text-center" style="height: 30px;" >
                        </div>
                    </div>
                </div>
                 <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 100px">Unidad: &nbsp;<i class="fa fa-user-plus"></i></span>
                        <div>
                            <input id="dlg_Unidad" type="text" class="form-control" style="height: 30px;" row="4">
                        </div>
                    </div>
                </div>





                <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 100px">Tipo: &nbsp;<i class="fa fa-get-pocket"></i></span>
                        <div>
                            <select id="dlg_Tipo" type="text" class="form-control" style="height: 30px;" >

                                <option value="1" >Vehiculos</option>
                                <option value="2" >Motos</option>
                                <option value="3" >Camionetas</option>


                            </select>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 100px">Placa: &nbsp;<i class="fa fa-user-plus"></i></span>
                        <div>
                            <input id="dlg_C_Placa" type="text" class="form-control" style="height: 30px;" row="4" maxlength="5">

                        </div>
                    </div>
                </div>




                <div class="col-xs-6" style="padding: 0px ;margin-top: 10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 100px">Personal: &nbsp;<i class="fa fa-car"></i></span>
                        <div>
                            <select id="dlg_Personal" type="text" class="form-control" style="height: 30px;" >

                                <option value="1" >Serenazgo</option>
                                <option value="2" >Integrado</option>

                            </select>
                        </div>
                    </div>

                </div>


                <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 100px">Persona: &nbsp;<i class="fa fa-user-plus"></i></span>
                        <div>
                            <input id="dlg_1_Persona" type="text" class="form-control" style="height: 30px;" row="4" disabled="">
                        </div>
                    </div>
                </div>

                <div class="col-xs-6" style="padding: 0px; margin-top: 10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 100px">Vehiculo: &nbsp;<i class="fa fa-user-plus"></i></span>
                        <div>
                            <input id="dlg_2_Vehiculo" type="text" class="form-control" style="height: 30px;" row="4" disabled="">
                        </div>
                    </div>
                </div>



            </div>
        </div>
    </div>
</div>

<div id="dlg_Zona_Riesgo" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">


                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">UBICACION: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_3_ubicacion" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="150" >
                        </div>
                    </div>
                </div>


                <div class="col-xs-12" style="padding: 0px; margin-top:10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">PROPIETARIO: &nbsp;<i class="fa fa-user"></i></span>
                        <div>
                            <input id="dlg_propietario" type="text" class="form-control text-uppercase" style="height: 30px" maxlengt"150">
                        </div>
                    </div>
                </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">TIPO RIESGO: &nbsp;<i class="fa fa-exclamation-circle"></i></span>
                        <div>
                          <select id="dlg_riesgo" type="text" class="form-control text-uppercase" style="height: 30px;" >

                              <option value="1" >LEVE</option>
                              <option value="2" >MODERADO</option>
                              <option value="2" >GRAVE</option>

                          </select>
                        </div>
                    </div>
                </div>

                              </div>
                <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">OBSERVACIONES &nbsp;<i class="fa fa-search"></i></span>
                        <div>
                            <textarea id="dlg_Observaciones" type="text" class="form-control text-uppercase" style="height: 60px;" row="4" maxlength="400">
                            </textarea>
                        </div>
                    </div>

                </div>

                    </div>

                </div>


            </div>
        </div>
    </div>
</div>

<div id="dlg_Atencion_Riesgo" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">


                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">UBICACION: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_4_ubicacion" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="150">
                        </div>
                    </div>
                </div>


                <div class="col-xs-12" style="padding: 0px; margin-top:10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">NOMBRE PERSONA: &nbsp;<i class="fa fa-child"></i></span>
                        <div>
                            <input id="dlg_n_persona" type="text" class="form-control text-uppercase" style="height: 30px" maxlengt"150">
                        </div>
                    </div>
                </div>


                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 175px">N°FALLECIDOS: &nbsp;<i class="fa fa-user-times"></i></span>
                        <div>

                            <input id="dlg_fallecidos" type="text" class="form-control" style="height: 30px"onkeypress="return soloNumeroTab(event)">
                        </div>
                    </div>
                </div>

                                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                                    <div class="input-group input-group-md" style="width: 100%">
                                        <span class="input-group-addon" style="width: 175px">N°ACCIDENTADOS: &nbsp;<i class="fa fa-exclamation-triangle"></i></span>
                                        <div>

                                        <input id="dlg_accidentados" type="text" class="form-control" style="height: 30px"onkeypress="return soloNumeroTab(event)">


                                                                                    </div>
                                    </div>
                                </div>
                                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                                    <div class="input-group input-group-md" style="width: 100%">
                                        <span class="input-group-addon" style="width: 175px">TIPO DESASTRE: &nbsp;<i class="fa fa-exclamation-circle"></i></span>
                                        <div>
                                            <select id="dlg_Accidentados" type="text" class="form-control" style="height: 30px;"onkeypress="return soloNumeroTab(event)">

                                                <option value="1" >LEVE</option>
                                                <option value="2" >MODERADO</option>
                                                <option value="2" >GRAVE</option>

                                            </select>

                                        </div>

                </div>

                    </div>

                                                                                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                                            <div class="input-group input-group-md" style="width: 100%">
                                                <span class="input-group-addon" style="width: 175px">OBSERVACIONES: &nbsp;<i class="fa fa-search"></i></span>
                                                <div>
                                                  <textarea id="dlg_6_Observaciones" type="text" class="form-control" style="height: 60px;" row="4" maxlength="400">
                                                  </textarea>
                                                </div>


                </div>


            </div>


        </div>
    </div>
</div>


<div id="dlg_Seguridad_Vial" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">


                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 285px">UBICACION: &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_7_ubicacion" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="150" >
                        </div>
                      </div>
                  </div>


                <div class="col-xs-12" style="padding: 0px; margin-top:10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 285px">TIPO: &nbsp;<i class="fa fa-user"></i></span>
                        <div>
                            <input id="dlg_3_tipo" type="text" class="form-control text-uppercase" style="height: 30px" maxlengt"150">
                        </div>
                      </div>
                    </div>

                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 285px">PEATONAL: &nbsp;<i class="fa fa-exclamation-circle"></i></span>
                        <div>
                          <input id="dlg_peatonal" type="text" class="form-control text-uppercase" style="height: 30px;" maxlengt"150" >

                          </div>
                        </div>
                      </div>

                              </div>
                <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 285px">UBICACION DEL CONTENADOR &nbsp;<i class="fa fa-search"></i></span>
                        <div>
                            <input id="dlg_ubicacion_centenador" type="text" class="form-control text-uppercase" style="height: 30px;" row="4" maxlength="150">
                          </div>
                          </div>

                          </div>

                                <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                                    <div class="input-group input-group-md" style="width: 100%">
                                        <span class="input-group-addon" style="width: 285px">ESTADO: &nbsp;<i class="fa fa-exclamation-circle"></i></span>
                                        <div>
                                          <select id="dlg_estado" type="text" class="form-control text-uppercase" style="height: 30px;" maxlengt"150" >

                                              <option value="1" >OPERATIVO</option>
                                              <option value="2" >MANTENIMIENTO</option>
                                            </select>

                                                  </div>
                                                  </div>

                                                  </div>



                                                  <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                                                    <div class="input-group input-group-md" style="width: 100%">
                                                        <span class="input-group-addon" style="width: 285px">OBSERVACIONES: &nbsp;<i class="fa fa-search"></i></span>
                                                        <div>
                                                          <textarea id="dlg_9_Observaciones" type="text" class="form-control" style="height: 60px;" row="4" maxlength="400">
                                                          </textarea>
                                                        </div>


                                                        </div>
                                                      </div>
                                                    </div>



                                                    <div id="dlg_Controlde_Pantallas" style="display: none;">
                                                        <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                        <div class="col-xs-12 cr-body" >
                                                                <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">


                                                                    <div class="col-xs-8" style="padding: 0px; margin-top:10px" >
                                                                        <div class="input-group input-group-md" style="width: 100%">
                                                                            <button type="button" class="btn btn-primary" onclick="dlg_abrir_alumnos();">Alumnos</button>
                                                                            </div>
                                                                        </div>

                                                                    <div class="col-xs-8" style="padding: 0px;margin-top:10px ">
                                                                        <div class="input-group input-group-md" style="width: 100%">
                                                                        <button type="button" class="btn btn-primary"onclick="dlg_abrir_Profesor();">Profesor</button>
                                                                        </div>
                                                                    </div>

                                                                    <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                                                                        <div class="input-group input-group-md" style="width: 100%">
                                                                          <button type="button" class="btn btn-primary" onclick="dlg_abrir_Curso()";>Curso</button>
                                                                            </div>
                                                                        </div>
                                                                      </div>

                                                                        </div>
                                                                        </div>
                                                                        </div>




                                                                        <div id="dlg_nuevo_alumnos" style="display: none;">
                                                                            <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                            <div class="col-xs-12 cr-body" >
                                                                                    <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                        <div class="col-xs-8" style="padding: 0px; ">
                                                                                            <div class="input-group input-group-md" style="width: 100%">
                                                                                                <span class="input-group-addon" style="width: 175px">Nombre: &nbsp;<i class="fa fa-user-secret"></i></span>
                                                                                                <div>
                                                                                                    <input id="dlg_nombre_96" type="text" class="form-control text-center" style="height: 30px;"  >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>


                                                                                        <div class="col-xs-8" style="padding: 0px; margin-top: 10px ">
                                                                                            <div class="input-group input-group-md" style="width: 100%">
                                                                                                <span class="input-group-addon" style="width: 175px">Apellidos: &nbsp;<i class="fa fa-phone"></i></span>
                                                                                                <div>
                                                                                                    <input id="dlg_apellidos_56" type="text" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);" >
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>

                                                                                        <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                                                                                            <div class="input-group input-group-md" style="width: 100%">
                                                                                                <span class="input-group-addon" style="width: 175px">Edad: &nbsp;<i class="fa fa-money"></i></span>
                                                                                                <div>
                                                                                                    <input id="dlg_edad_23" type="text" class="form-control" style="height: 30px;" row="4">
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                  </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>


                                                                                                                                                <div id="dlg_nuevo_profesor" style="display: none;">
                                                                                                                                                    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                                                                                                    <div class="col-xs-12 cr-body" >
                                                                                                                                                            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                                                                                                <div class="col-xs-8" style="padding: 0px; ">
                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">Nombre: &nbsp;<i class="fa fa-user-secret"></i></span>
                                                                                                                                                                        <div>
                                                                                                                                                                            <input id="dlg_nombre_96" type="text" class="form-control text-center" style="height: 30px;"  >
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>


                                                                                                                                                                <div class="col-xs-8" style="padding: 0px; margin-top: 10px ">
                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">Apellidos: &nbsp;<i class="fa fa-phone"></i></span>
                                                                                                                                                                        <div>
                                                                                                                                                                            <input id="dlg_apellidos_56" type="text" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);" >
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>

                                                                                                                                                                <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">Edad: &nbsp;<i class="fa fa-money"></i></span>
                                                                                                                                                                        <div>
                                                                                                                                                                            <input id="dlg_edad_23" type="text" class="form-control" style="height: 30px;" row="4">
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                          </div>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>


                                                                                                                                                <div id="dlg_nuevo_Curso" style="display: none;">
                                                                                                                                                    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                                                                                                    <div class="col-xs-12 cr-body" >
                                                                                                                                                            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                                                                                                <div class="col-xs-8" style="padding: 0px; ">
                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">Nombre: &nbsp;<i class="fa fa-user-secret"></i></span>
                                                                                                                                                                        <div>
                                                                                                                                                                            <input id="dlg_nombre_96" type="text" class="form-control text-center" style="height: 30px;"  >
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>


                                                                                                                                                                <div class="col-xs-8" style="padding: 0px; margin-top: 10px ">
                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">Materia: &nbsp;<i class="fa fa-phone"></i></span>
                                                                                                                                                                        <div>
                                                                                                                                                                            <input id="dlg_apellidos_56" type="text" class="form-control" style="height: 30px;"  onkeypress="return soloNumeroTab(event);" >
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>

                                                                                                                                                                <div class="col-xs-8" style="padding: 0px; margin-top:10px">
                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">curso: &nbsp;<i class="fa fa-money"></i></span>
                                                                                                                                                                        <div>
                                                                                                                                                                            <input id="dlg_edad_23" type="text" class="form-control" style="height: 30px;" row="4">
                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                          </div>
                                                                                                                                                        </div>
                                                                                                                                                    </div>
                                                                                                                                                </div>


                                                                                                                                                <div id="dlg_Abogados" style="display: none;">
                                                                                                                                                    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                                                                                                    <div class="col-xs-12 cr-body" >
                                                                                                                                                            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                                                                                                <div class="col-xs-12" style="padding: 0px; ">
                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">Nombre: &nbsp;<i class="fa fa-child"></i></span>
                                                                                                                                                                        <div>

                                                                                                                                                                              <input id="dlg_Nombre_Abogados" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="200" >
                                                                                                                                                                        </div>                                                                                                                                                                          </div>
                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                    </div>
                                                                                                                                                                </div>
                                                                                                                                                          </div>
                                                                                                                                                        </div>


                                                                                                                                                        <div id="dlg_Tipos" style="display: none;">
                                                                                                                                                            <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                                                                                                            <div class="col-xs-12 cr-body" >
                                                                                                                                                                    <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                                                                                                        <div class="col-xs-12" style="padding: 0px; ">
                                                                                                                                                                            <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                                <span class="input-group-addon" style="width: 175px">Descripcion: &nbsp;<i class="fa fa-file-image-o"></i></span>
                                                                                                                                                                                <div>

                                                                                                                                                                                      <input id="dlg_Tipo_Descripcion" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="200" >
                                                                                                                                                                                </div>                                                                                                                                                                          </div>
                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                            </div>
                                                                                                                                                                        </div>
                                                                                                                                                                  </div>
                                                                                                                                                                </div>


                                                                                                                                                                <div id="dlg_Proceso" style="display: none;">
                                                                                                                                                                    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                                                                                                                    <div class="col-xs-12 cr-body" >
                                                                                                                                                                            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                                                                                                                <div class="col-xs-12" style="padding: 0px; ">
                                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">Descripcion: &nbsp;<i class="fa fa-file-image-o"></i></span>
                                                                                                                                                                                        <div>

                                                                                                                                                                                              <input id="dlg_Proceso_Descripcion" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="100" >
                                                                                                                                                                                        </div>                                                                                                                                                                          </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                    </div>
                                                                                                                                                                                </div>
                                                                                                                                                                          </div>
                                                                                                                                                                        </div>


                                                                                                                                                                        <div id="dlg_Sancion" style="display: none;">
                                                                                                                                                                            <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                                                                                                                            <div class="col-xs-12 cr-body" >
                                                                                                                                                                                    <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                                                                                                                        <div class="col-xs-12" style="padding: 0px; ">
                                                                                                                                                                                            <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                                                <span class="input-group-addon" style="width: 175px">Descripcion: &nbsp;<i class="fa fa-gavel"></i></span>
                                                                                                                                                                                                <div>

                                                                                                                                                                                                      <input id="dlg_Tipo_Sancion_Descripcion" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="100" >
                                                                                                                                                                                                </div>                                                                                                                                                                          </div>
                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                            </div>
                                                                                                                                                                                        </div>
                                                                                                                                                                                  </div>
                                                                                                                                                                                </div>


                                                                                                                                                                                <div id="dlg_Caso" style="display: none;">
                                                                                                                                                                                    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                                                                                                                                    <div class="col-xs-12 cr-body" >
                                                                                                                                                                                            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                                                                                                                                <div class="col-xs-12" style="padding: 0px; ">
                                                                                                                                                                                                    <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                                                        <span class="input-group-addon" style="width: 175px">Descripcion: &nbsp;<i class="fa fa-gavel"></i></span>
                                                                                                                                                                                                        <div>

                                                                                                                                                                                                              <input id="dlg_Tipo_Caso" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="100" >
                                                                                                                                                                                                        </div>                                                                                                                                                                          </div>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                        </div>
                                                                                                                                                                                                    </div>
                                                                                                                                                                                                </div>
                                                                                                                                                                                          </div>
                                                                                                                                                                                        </div>


                                                                                                                                                                                                                                                                                                                                  <div id="dlg_Materia" style="display: none;">
                                                                                                                                                                                                                                                                                                                                  <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                                                                                                                                                                                                                                                                                                                    <div class="col-xs-12 cr-body" >
                                                                                                                                                                                                                                                                                                                                  <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px">


                                                                                                                                                                                                                                                                                                                                 <div class="col-xs-12" style="padding: 0px; ">
                                                                                                                                                                                                                                                                                                                                  <div class="input-group input-group-md" style="width: 100%">
                                                                                                                                                                                                                                                                                                                                    <span class="input-group-addon" style="width: 175px">Descripcion: &nbsp;<i class="fa fa-file-image-o"></i></span>
                                                                                                                                                                                                                                                                                                                                      <div>

                                                                                                                                                                                                                                                                                                                                    <input id="dlg_Tipo_Materia_Descripcion" type="text" class="form-control text-uppercase" style="height: 30px;" maxlength="100" >
                                                                                                                                                                                                                                                                                                                                      </div>                                                                                                                                                                          </div>
                                                                                                                                                                                                                                                                                                                                         </div>
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                            </div>
                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                </div>
                                                                                                                                                                                                                                                                                                                                                </div>











@endsection
