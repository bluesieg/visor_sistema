@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -15px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Mantenimiento de Usuarios...</b></h1>			

                <button onclick="open_dialog_new_edit_Usuario('NUEVO', false);" id="btn_vw_usuarios_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                </button>                        
                <button id="btn_vw_usuarios_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                </button>
                <button type="button" class="btn btn-labeled btn-danger">
                    <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                </button>
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
            rowNum: 10, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE USUARIOS REGISTRADOS', align: "center",
            colModel: [
                {name: 'id', index: 'id', hidden: true},
                {name: 'dni', index: 'dni', align: 'left'},
                {name: 'ape_nom', index: 'ape_nom', align: 'left'},
                {name: 'usuario', index: 'usuario', align: 'center'},
                {name: 'nivel', index: 'nivel'},
                {name: 'fch_nac', index: 'fch_nac'}
            ],
            pager: '#pager_table_Usuarios',
            rowList: [10, 20],
            onSelectRow: function (Id) {
                $('#btn_vw_usuarios_Nuevo').on('click', open_dialog_new_edit_Usuario('EDITAR', Id));

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
                <div class="row">
                    <section class="col col-6">
                        <label class="label">Dni:</label>
                        <label class="input">
                            <div class="input-group">
                                <input type="text" name="txt_dni" id="txt_dni" class="form-control">
                                <span class="input-group-addon"><i class="fa fa-slack"></i></span>                                
                            </div>
                        </label>
                    </section>
                    <section class="col col-6">
                        <label class="label">Usuario:</label>
                        <label class="input">
                            <div class="input-group">
                                <input type="text" name="txt_usuario" id="txt_usuario" class="form-control">
                                <span class="input-group-addon"><i class="fa fa-user"></i></span>                                
                            </div>
                        </label>
                    </section>
                </div>
                <section>
                    <label class="label">Nombres y Apellidos:</label>
                    <label class="input">  
                        <div class="input-group">
                        <input type="text" name="txt_ape_nom" id="txt_ape_nom">
                        <span class="input-group-addon"><i class="fa fa-male"></i></span>
                        </div>
                    </label>
                </section>
                <div class="row">
                    <section class="col col-6">
                        <label class="label">Nivel:</label>
                        <label class="select">
                            <select name="country">
                                <option value="3" selected="" disabled="">3</option>
                                <option value="2">2</option>
                                <option value="1">1</option>
                            </select> <i class="fa fa-user"></i> </label>
                    </section>
                    <section class="col col-6">
                        <label class="label">Fecha Nacimiento:</label>
                        <label class="input">
                            <div class="input-group">
                                <input type="text" name="txt_fch_nac" id="txt_fch_nac" class="form-control" data-mask="99/99/9999" data-mask-placeholder="-">
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



