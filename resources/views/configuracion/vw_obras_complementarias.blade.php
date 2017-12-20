@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <input type="hidden" id="per_edit" value="{{$permisos[0]->btn_edit}}"/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Obras Complementarias..</b></h1>
                <div class="row">

      
                           
                                 <div class="col-xs-8">
                                    <label>Año:</label>
                                    <label class="select">
                                        <select onchange="selecciona_anio_oficina();" id="select_anio" class="input-sm">
                                            @foreach ($anio as $anio_t)
                                                <option value='{{$anio_t->anio}}' >{{$anio_t->anio}}</option>
                                            @endforeach
                                        </select><i></i>
                                    </label>
                                </div>                                        
                           
                            
                            <div class="col-xs-4">
                                <div class="text-right">
                                    
                                    @if( $permisos[0]->btn_new ==1 )
                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="nueva_instalacion();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                        </button>
                                    @else
                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="sin_permiso();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                        </button>
                                    @endif
                                    @if( $permisos[0]->btn_edit ==1 )
                                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_instalacion();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                        </button>
                                    @else
                                        <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="sin_permiso();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                        </button>
                                    @endif
                                    @if( $permisos[0]->btn_del ==1 )
                                        <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_instalacion();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                        </button>
                                    @else
                                        <button  type="button" class="btn btn-labeled btn-danger" onclick="sin_permiso();">
                                            <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                        </button>
                                    @endif
                                    
                                </div>
                            </div>
                            
              
                </div> 
            </div>
            <div class="well well-sm well-light" style="margin-top:-20px;">                
                <div class="row">
                    <div class="col-xs-12">                        
                        <div class="row">
                            <section id="content_2" class="col-lg-12">
                                <input type="hidden" id="current_id" value="0">
                                <table id="table_Instalaciones"></table>
                                <div id="pager_table_Instalaciones"></div>
                            </section>                            
                        </div>                                                
                    </div>
                </div> 
            </div>
        </div>       
    </div>
</section>
@section('page-js-script')

<script type="text/javascript">
    $(document).ready(function () {
        selecciona_anio_oficina();
        $("#menu_configuracion").show();
        $("#li_obras_complementarias").addClass('cr-active');
        anio = $("#select_anio").val();
        jQuery("#table_Instalaciones").jqGrid({
            url: 'get_instalaciones?anio=' + anio,
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_instal','Código','Descripción', 'U. Medida', 'Valor'],
            rowNum: 20, sortname: 'id_instal', sortorder: 'desc', viewrecords: true, caption: 'Lista de Instalaciones', align: "center",
            colModel: [                
                {name: 'id_instal', index: 'id_instal', hidden:true},
                {name: 'cod_instal', index: 'cod_instal', align: 'center', width: 70},
                {name: 'descrip_instal', index: 'descrip_instal', align: 'left', width: 350},
                {name: 'unid_medida', index: 'unid_medida', align: 'center', width: 70},
                {name: 'precio', index: 'precio', align: 'center', width: 70},
                
                
            ],
            pager: '#pager_table_Instalaciones',
            rowList: [20, 30, 50],
            onSelectRow: function (Id) {
            $('#current_id').val($("#table_Instalaciones").getCell(Id, "id_instal"));
            },
            ondblClickRow: function (Id) {
                $('#current_id').val($("#table_Instalaciones").getCell(Id, "id_instal"));
                modificar_instalacion();
            },
            gridComplete: function () {
                var rows = $("#table_Instalaciones").getDataIDs();
                if (rows.length > 0) {
                    var firstid = jQuery('#table_Instalaciones').jqGrid('getDataIDs')[0];
                    $("#table_Instalaciones").setSelection(firstid);    
                }
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Instalaciones").jqGrid('setGridWidth', $("#content_2").width());
        });

       
             
    });
</script>
@stop
<script src="{{ asset('archivos_js/configuracion/obras_complementarias.js') }}"></script>
<div id="dlg_nueva_instalacion" style="display: none;">
    <input type="hidden" id="dlg_instalacion_id" value="0" />
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>Obras complementarias::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-6" style="padding: 0px; margin-bottom: 10px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Año &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_aniox" type="text"  class="form-control" style="height: 32px;" disabled="">
                        </div>
                    </div>
                </div>
                 <div class="col-xs-12" style="margin-top: 10px;"></div>

                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Código &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_codigo" type="text"  class="form-control" style="height: 32px; width: 100%" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Descripción &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_descripcion" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="150">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Unidad de Medida &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_unidad_medida" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="10">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Valor &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_valor" type="text"   class="form-control" style="height: 32px; width: 100%" maxlength="12" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                </div>
                
               
               
                </div>          
        </div>
    </div>
</div> 



@endsection




