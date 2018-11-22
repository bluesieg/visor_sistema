@extends('layouts.asesoria_legal')
@section('content')

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
                                            
                                        <h1 ><b>MANTENIMIENTO DE ABOGADOS</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE ABOGADO:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_abogado" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE ABOGADOS">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_abogados();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                           <div class="col-xs-5 text-right">
                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_abogado();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_abogado();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_asesoria_abogados"></table>
                                                        <div id="pager_table_asesoria_abogados"></div>
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
        
        jQuery("#table_asesoria_abogados").jqGrid({
            url: 'asesoria_legal/0?grid=abogados',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID_ABOGADO', 'DNI', 'NOMBRE COMPLETO'],
            rowNum: 50, sortname: 'id_abogado', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE ABOGADOS - ASESORIA LEGAL', align: "center",
            colModel: [
                {name: 'id_abogado', index: 'id_abogado', hidden: true},
                {name: 'dni', index: 'dni', align: 'left', width: 20},
                {name: 'nombre', index: 'nombre', align: 'left', width: 80}
            ],
            pager: '#pager_table_asesoria_abogados',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_asesoria_abogados').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_asesoria_abogados').jqGrid('getDataIDs')[0];
                            $("#table_asesoria_abogados").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_abogado();}
        });
        
        $("#dlg_buscar_abogado").keypress(function (e) {
            if (e.which == 13) {

                   buscar_abogados();

            }
        });
        $("#dlg_dni").keypress(function (e) {
            if (e.which == 13 && !e.shiftKey) {
                consultar_persona();
            }
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/asesoria_legal/asesoria_abogados.js') }}"></script>

<div id="dlg_nuevo_abogado" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DATOS PERSONALES ABOGADO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DNI: &nbsp;<i class="fa fa-location-arrow"></i></span>
                    <div>
                        <input type="hidden" id="hidden_dlg_dni" name="hidden_dlg_dni">
                        <input id="dlg_dni" type="text" class="form-control" maxlength="8" style="height: 30px;"  onkeypress="return soloNumeroTab(event);">
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">NOMBRE ABOGADO: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="dlg_nombre" type="text" class="form-control text-uppercase"  disabled="" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
      
        </div>
    </div>
    </div>
    
</div>
<div id="dialog_Personas" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important;">
<!--                    <div class="panel-heading bg-color-success">.:: Datos del Contribuyente ::.</div>-->
                    <div class="panel-body">
                        <fieldset class="col col-lg-9">
                            <div class="row">
                                <section class="col col-6" style="padding-right:5px;">
                                    <label class="label">Tipo Documento:</label>                                   
                                    <label class="select">
                                        <select id="cb_tip_doc_3" name="cb_tip_doc_3" onchange="filtro_tipo_doc_pers(this.value);" class="input-sm">
                                                                              
                                        </select><i></i> </label>                                                       
                                </section>
                                <section class="col col-4" style="padding-left:5px;padding-right: 5px;">
                                    <label class="label">Nro. Documento:</label>
                                    <label class="input">
                                        <input id="pers_nro_doc" name="pers_nro_doc" type="text" onkeypress="return soloDNI(event);" maxlength="8" placeholder="00000000" class="input-sm">
                                    </label>                                    
                                </section>
                                <section class="col col-2" style="padding-left:5px;">
                                    <label class="label">&nbsp;</label>
                                    <button onclick="btn_bus_getdatos();" type="button" class="btn btn-labeled btn-primary">
                                        <span class="btn-label" style="left: 0px;">
                                            <i class="fa fa-search"></i>
                                        </>Buscar
                                   </button>
                                </section>
                            </div>
                            <div class="row">
                                <section class="col col-3" style="padding-right:5px;">
                                    <label class="label">Ape.Paterno:</label>
                                    <label class="input">
                                        <input id="pers_pat" name="pers_pat" type="text" maxlength="50" class="input-sm text-uppercase">
                                    </label>                                    
                                </section>
                                <section class="col col-3" style="padding-left:5px;padding-right:5px;">
                                    <label class="label">Ape.Materno:</label>
                                    <label class="input">
                                        <input id="pers_mat" name="pers_mat" type="text" maxlength="50" class="input-sm text-uppercase">
                                    </label>                                                                     
                                </section>
                                <section class="col col-6" style="padding-left:5px;">
                                    <label class="label">Nombres:</label>
                                    <label class="input">
                                        <input id="pers_nombres" name="pers_nombres" type="text" maxlength="100" class="input-sm text-uppercase">
                                    </label>                                                                     
                                </section> 
                            </div>                            
                            <section>
                                <label class="label">Razon Social:</label>
                                <label class="input">
                                    <input id="pers_raz_soc" name="pers_raz_soc" type="text" class="input-sm text-uppercase">
                                </label>                                                 
                            </section>
                            <div class="row">
                                <section class="col col-6" style="padding-right:5px;">
                                    <label class="label">Sexo:</label>                                   
                                    <label class="select">
                                        <select id="pers_sexo" name="pers_sexo" class="input-sm text-uppercase">
                                            <option value="-">Seleccionar</option>
                                            <option value="1">Masculino</option>
                                            <option value="0">Femenino</option>        
                                        </select><i></i> </label>                                     
                                </section>
                                <section class="col col-6" style="padding-left:5px;">
                                    <label class="label">Fecha Nac.:</label>
                                    <label class="input">
                                        <input id="pers_fnac" name="pers_fnac" type="text" data-mask="99/99/9999" data-mask-placeholder="-" placeholder="dia/mes/año" class="input-sm">
                                    </label>                                                                                                          
                                </section>                                
                            </div>
                        </fieldset>
                        <fieldset class="col col-lg-3 text-align-center">
                            <section>
                             <img id="pers_foto" src="{{asset('img/avatars/male.png')}}" name="pers_foto" style="width: 160px;height: 220px;border: 1px solid #fff; outline: 1px solid #bfbfbf;">   
                            </section>
                        </fieldset>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
