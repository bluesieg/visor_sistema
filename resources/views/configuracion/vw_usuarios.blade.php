@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Mantenimiento de Usuarios...</b></h1>
                <div class="row">
                    <div class="input-group col-lg-4">
                        <div class="icon-addon addon-md">
                            <input type="text" class="form-control" placeholder="Buscar" value="asfd">
                            <label title="" rel="tooltip" class="glyphicon glyphicon-search" for="Buscar" data-original-title="Buscar"></label>
                        </div>
                        <span class="input-group-btn">
                            <button type="button" class="btn btn-primary">Buscar</button>
                        </span>
                    </div>
                    <div class="col-xs-12">                        
                        <div class="text-right">                             
                            <button onclick="open_dialog_new_edit_Usuario('NUEVO');" id="btn_vw_usuarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                            </button>
                            <button id="btn_vw_usuarios_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                            </button>
                            <button id="btn_vw_usuarios_Eliminar" type="button" class="btn btn-labeled btn-danger">
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
    $(document).ready(function () {
        jQuery("#table_Usuarios").jqGrid({
            url: 'list_usuarios',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id', 'DNI', ' Nombres', 'Usuario', 'Nivel', 'Fecha Nac.'],
            rowNum: 13, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE USUARIOS REGISTRADOS', align: "center",
            colModel: [
                {name: 'id', index: 'id', hidden: true},
                {name: 'dni', index: 'dni', align: 'left'},
                {name: 'ape_nom', index: 'ape_nom', align: 'left'},
                {name: 'usuario', index: 'usuario', align: 'left'},
                {name: 'nivel', index: 'nivel'},
                {name: 'fch_nac', index: 'fch_nac'}
            ],
            pager: '#pager_table_Usuarios',
            rowList: [13, 20],
            onSelectRow: function (Id) {
                $('#btn_vw_usuarios_Editar').attr('onClick', 'open_dialog_new_edit_Usuario("' + 'EDITAR' + '",' + Id + ')');
                $('#btn_vw_usuarios_Eliminar').attr('onClick', 'eliminar_usuario(' + Id + ')');
            },
            ondblClickRow: function (Id) {
                $("#btn_vw_contribuyentes_Editar").click();
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Usuarios").jqGrid('setGridWidth', $("#content").width());
        });
    });
</script>
@stop
<div id="dialog_new_edit_Usuario" style="display: none">
    <div class="widget-body">
        <div  class="smart-form">
            <fieldset>                
                <section>
                    <label class="label">Nombres y Apellidos:</label>
                    <label class="input">  
                        <div class="input-group">
                            <input id="txt_ape_nom" type="text" name="txt_ape_nom" >
                            <span class="input-group-addon"><i class="fa fa-male"></i></span>
                        </div>
                    </label>
                </section>
                <div class="row">
                    <section class="col col-6">
                        <section>                            
                            <label class="input img-thumbnail center-block">
                                <div class="input-group">
                                    <img src="img/avatars/male.png" alt="" width="135" height="129">                                
                                </div>
                            </label>                           
                        </section>   
                        <section>
                            <label class="label">Dni:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="txt_dni_usuario" onkeypress="return soloDNI(event);" type="text" name="txt_dni"  class="form-control" maxlength="8">
                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>                                
                                </div>
                            </label>
                        </section>
                    </section>
                    <section class="col col-6">                        
                        <section>
                            <label class="label">Dni:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="txt_dni_usuario" onkeypress="return soloDNI(event);" type="text" name="txt_dni"  class="form-control" maxlength="8">
                                    <span class="input-group-addon"><i class="fa fa-slack"></i></span>                                
                                </div>
                            </label>
                        </section>
                        <section>
                            <label class="label">Usuario:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="txt_usuario" type="text" name="txt_usuario"  class="form-control" maxlength="20">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>                                
                                </div>
                            </label>
                        </section>
                        <section>
                            <label class="label">Usuario:</label>
                            <label class="input">
                                <div class="input-group">
                                    <input id="txt_usuario" type="text" name="txt_usuario"  class="form-control" maxlength="20">
                                    <span class="input-group-addon"><i class="fa fa-user"></i></span>                                
                                </div>
                            </label>
                        </section>
                    </section>
                </div>                

                <div class="row">
                    <section class="col col-6">                        
                        <label class="label">Nivel:</label>
                        <label class="select">
                            <select id="txt_nivel" name="txt_nivel">
                                <option value="select">Seleccione</option>
                                <option value="3">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select> <i class="fa fa-user"></i> </label>                        
                    </section>
                    <section class="col col-6">                        
                        <label class="label">Fecha Nacimiento:</label>
                        <label class="input">
                            <div class="input-group">
                                <input id="txt_fch_nac" type="text" name="txt_fch_nac" class="form-control" data-mask="99/99/9999" data-mask-placeholder="-">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                            </div>
                        </label>                       
                    </section>
                </div>
            </fieldset>
        </div>        
    </div>
</div>


<script src="{{ asset('archivos_js/configuracion.js') }}"></script>


@endsection



