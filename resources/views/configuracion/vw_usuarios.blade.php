@extends('layouts.app')
@section('content')
<style>    
    .smart-form fieldset {    
        padding: 5px 8px 0px;   
    }
    .smart-form section {
        margin-bottom: 5px;    
    }
    .smart-form .label {  
        margin-bottom: 0px;   
    }
    .smart-form .col {
        padding-right: 8px;
        padding-left: 8px;       
    }
</style>
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Mantenimiento de Usuarios...</b></h1>
                <div class="row">                    
                    <div class="col-xs-12">                        
                        <div class="text-right">
                            <div class="col-xs-2 col-sm-12 col-md-12 col-lg-5">
                                <div class="input-group">
                                    <div class="icon-addon addon-md">
                                        <input type="text" class="form-control" placeholder="Buscar">
                                        <label title="" rel="tooltip" class="glyphicon glyphicon-search" for="Buscar" data-original-title="Buscar"></label>
                                    </div>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-primary">Buscar</button>
                                    </span>
                                </div>
                            </div>
                            <button onclick="open_dialog_new_edit_Usuario();" id="btn_vw_usuarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                            </button>
                            <button onclick="dlg_Editar_Usuario();" id="btn_vw_usuarios_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                            </button>
                            <button onclick="eliminar_usuario();" id="btn_vw_usuarios_Eliminar" type="button" class="btn btn-labeled btn-danger">
                                <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                            </button> 
                            <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                            </button> 
                        </div>
                    </div>
                </div>
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="table_Usuarios"></table>
            <div id="pager_table_Usuarios"></div>
        </article>
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">    
    memory_glob_dni = '';
    memory_glob_usuario = '';
    $("#menu_configuracion").show();
    $("#li_config_usuarios").addClass('cr-active');
    $(document).ready(function () {
        jQuery("#table_Usuarios").jqGrid({
            url: 'list_usuarios',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id', 'DNI', ' Nombres', 'Usuario', 'Fecha Nac.'],
            rowNum: 13, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE USUARIOS REGISTRADOS', align: "center",
            colModel: [
                {name: 'id', index: 'id', hidden: true},
                {name: 'dni', index: 'dni', align: 'center', width: 80},
                {name: 'ape_nom', index: 'ape_nom', width: 250},
                {name: 'usuario', index: 'usuario', width: 130},                
                {name: 'fch_nac', index: 'fch_nac', width: 100}
            ],
            pager: '#pager_table_Usuarios',
            rowList: [13, 20],
            onSelectRow: function (Id) {},
            ondblClickRow: function (Id) {
                dlg_Editar_Usuario();
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Usuarios").jqGrid('setGridWidth', $("#content").width());
        });
        $("#vw_usuario_txt_dni").keypress(function (e) {
            if (e.which == 13) {
                fn_consultar_dni($("#vw_usuario_txt_dni").val());
            }
        });
        $("#pers_nro_doc").keypress(function (e) {
            if (e.which == 13) { 
                get_datos_dni(); 
            }
        });
    });
</script>
@stop
<div id="dialog_new_edit_Usuario" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <form action="usuario_save" enctype="multipart/form-data" method="POST" id="form_user" name="form_user" target="iframeformuser">
                <input type="hidden" id="vw_usuarios_id" name="vw_usuarios_id" value="">
                {{ csrf_field() }}
                <iframe id="iframeformuser" name="iframeformuser" style="display: none;"></iframe>            
                <fieldset>                
                    <section>
                        <label class="label">Nombres y Apellidos:</label>
                        <label class="input">  
                            <div class="input-group">
                                <input id="vw_usuario_txt_ape_nom" type="text" name="vw_usuario_txt_ape_nom" placeholder="Nombres y Apellidos" style="text-transform: uppercase">
                                <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                            </div>
                        </label>
                    </section>
                    <div class="row">
                        <section class="col col-6" style="padding-left: 50px">
                            <img id="vw_usuario_foto_img" src="{{asset('img/avatars/male.png')}}" name="vw_usuario_foto_img" size="1024" style="width: 175px;height: 230px;border: 1px solid #fff; outline: 1px solid #bfbfbf;margin-top: 2px;margin-bottom: 5px;">
                        </section>
                        <section class="col col-6" style="padding-right: 14px">
                            <label class="label" style="margin-top:5px">Dni:</label>
                            <label class="input">  
                                <div class="input-group">
                                    <input type="hidden" id="vw_usuario_txt_id_pers">
                                    <input id="vw_usuario_txt_dni" name="vw_usuario_txt_dni" type="text" placeholder="00000000" onkeypress="return soloDNI(event);" maxlength="8">                                
                                    <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                </div>
                            </label>                               
                            <label class="label" style="margin-top:5px">Usuario:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_usuario" name="vw_usuario_txt_usuario" type="text" placeholder="de 3 a mas caracteres" style="text-transform: uppercase">
                                    <span id="vw_usuario_btn_val_usuario" class="input-group-addon"><i class="fa fa-user"></i></span>
                                </div>
                            </label>
                            <label class="label" style="margin-top:5px">Contraseña:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_password" name="vw_usuario_txt_password" type="password" placeholder="Password">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                </div>
                            </label>
                            <label class="label" style="margin-top:5px">Confirmar Contraseña:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="vw_usuario_txt_conf_pass" type="password" placeholder="Confirmar Password">
                                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                </div>
                            </label>                            
                        </section>                        
                    </div>
<!--                    <section>
                        <label class="label">Seleccionar Foto:</label>
                        <label class="input"> 
                            <input type="file" id="vw_usuario_cargar_foto" name="vw_usuario_cargar_foto" placeholder="solo jpge,jpg,png" accept="image/png, image/jpeg, image/jpg">                                
                        </label>
                    </section>-->
                    <section>
                        <label class="label">Jefe Inmediato:</label>                                   
                        <label class="select">
                            <select id="vw_usuario_dni_jefe" name="vw_usuario_dni_jefe" onchange="filtro_tipo_doc_pers(this.value);" class="input-sm">
                                <option value="0">Seleccione</option>
                            @foreach ($jef as $jef)
                            <option value='{{$jef->dni}}' >{{trim($jef->ape_nom)}}</option>
                            @endforeach                                          
                            </select><i></i> </label>
                    </section>
                </fieldset>
            </form>
        </div>        
    </div>
</div>
<!-- **************************                EDITAR USUARIO-          ************************************-->
<div id="dialog_Editar_Usuario" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <div class="panel-group">                
                <div class="panel panel-success" style="border: 0px !important;">
                    <div class="panel-heading bg-color-success">.:: Datos del Usuario ::.</div>
                    <div class="panel-body">
                        <div class="col col-12" style="margin-top: 10px;">
                            <label class="label">Nombres y Apellidos:</label>
                            <label class="input">  
                                <div class="input-group">
                                    <input id="vw_usuario_txt_ape_nom_2" type="text" placeholder="Nombres y Apellidos" style="text-transform: uppercase">
                                    <span class="input-group-addon"><i class="fa fa-text-height"></i></span>
                                </div>
                            </label>
                        </div>
                        <section>
                            <div class="col col-6">
                                <label class="label">Usuario:</label>
                                <label class="input">
                                    <div class="input-group">
                                        <input id="vw_usuario_txt_usuario_2" type="text" onblur="validar_usuario(this.value);" placeholder="de 3 a mas caracteres" style="text-transform: uppercase">
                                        <span id="vw_usuario_btn_val_usuario" class="input-group-addon"><i class="fa fa-user"></i></span>
                                    </div>
                                </label>
                            </div>
                            <div class="col col-6">
                                <label class="label">Dni:</label>
                                <label class="input">  
                                    <div class="input-group">
                                        <input id="vw_usuario_txt_dni_2" onblur="validar_dni(this.value);" type="text" placeholder="00000000" onkeypress="return soloDNI(event);" maxlength="8" disabled="">                                
                                        <span class="input-group-addon"><i class="fa fa-credit-card"></i></span>
                                    </div>
                                </label>                                
                            </div>
                        </section>                
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
                                        @foreach ($tip_doc as $tip_doc3)
                                        <option value='{{$tip_doc3->tip_doc}}' >{{trim($tip_doc3->tipo_documento)}}</option>
                                        @endforeach                                          
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



