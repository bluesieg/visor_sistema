@extends('layouts.app')
@section('content')
<section id="widget-grid" class="">    
    <input type="hidden" id="per_edit" value="{{$permisos[0]->btn_edit}}"/>
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Modificar persona...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">
                            <section class="col-lg-7" style="padding-left:2px;">
                                <div class="input-group">
                                    <span class="input-group-addon">Buscar Personas<i class="icon-append fa fa-male" style="margin-left: 5px;"></i></span>
                                    <input type="text" id="vw_persona_buscar" class="form-control text-uppercase">
                                    <span class="input-group-btn">
                                        <button class="btn btn-success" type="button" onclick="buscar_persona();" title="BUSCAR">
                                            <i class="glyphicon glyphicon-search"></i>&nbsp;Buscar
                                        </button>
                                    </span>
                                </div>                                            
                            </section>
                            
                            @if( $permisos[0]->btn_edit ==1 )
                                <button onclick="fn_mod_persona();" id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                </button>
                            @else
                                <button onclick="sin_permiso();" id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
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
                                <table id="table_Personas"></table>
                                <div id="pager_table_Personas"></div>
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
        $("#menu_admtri").show();
        $("#li_mod_persona").addClass('cr-active');
        jQuery("#table_Personas").jqGrid({
            url: 'modificar_persona/0?name=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers','N° Documento', ' Tip. Doc', 'Contribuyente ', 'Razon Social'],
            rowNum: 20, sortname: 'id_pers', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE PERSONAS REGISTRADAS', align: "center",
            colModel: [                
                {name: 'id_pers', index: 'id_pers', hidden:true},
                {name: 'pers_nro_doc', index: 'pers_nro_doc', align: 'center', width: 70},
                {name: 'pers_tip_doc', index: 'pers_tip_doc', align: 'center', width: 70},
                {name: 'contribuyente', index: 'contribuyente', align: 'left', width: 200},
                {name: 'pers_raz_soc', index: 'pers_raz_soc', align: 'left', width: 200},
                
                
            ],
            pager: '#pager_table_Personas',
            rowList: [20, 30, 50],
            onSelectRow: function (Id) { },
            ondblClickRow: function (Id) {
                fn_mod_persona();
            },
            gridComplete: function () {
                var rows = $("#table_Personas").getDataIDs();
                if (rows.length > 0) {
                    var firstid = jQuery('#table_Personas').jqGrid('getDataIDs')[0];
                    $("#table_Personas").setSelection(firstid);    
                }
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_Personas").jqGrid('setGridWidth', $("#content_2").width());
        });
        $("#vw_persona_buscar").keypress(function (e) {
            if (e.which == 13) {
                buscar_persona();
            }
        });
       
             
    });
</script>
@stop
<script src="{{ asset('archivos_js/adm_tributaria/personas.js') }}"></script>
<div id="dlg_mod_persona" style="display: none;">
    <input type="hidden" id="dlg_persona_id" value="0" />
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>Modificar Persona::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-8" style="padding: 0px;">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon"  style="width: 165px" >Tipo Documento &nbsp;<i class="fa fa-file"></i></span>
                        <div class="icon-addon addon-md">
                            <select id='seltipdoc' class="form-control col-lg-8" style="height: 32px;" onchange="verificatipodoc()">
                            @foreach($tip_doc as $doc)
                            <option value="{{$doc->tip_doc}}">
                                {{$doc->tipo_documento}}
                            </option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px"></div>
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Número Documento &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="dlg_nro_doc" type="text"  class="form-control" style="height: 32px;" maxlength="20">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div id="show_nombres">
                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Apellido Paterno &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_pers_apep" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="200">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Apellido Materno &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_pers_apem" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="200">
                        </div>
                    </div>
                </div>
                <div class="col-xs-6" style="padding: 0px; margin-top: 10px ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Nombres &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_pers_nom" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="200">
                        </div>
                    </div>
                </div>
                </div>
                <div id="show_razon">
                    <div class="col-xs-12" style="padding: 0px; ">
                        <div class="input-group input-group-md" style="width: 100%">
                            <span class="input-group-addon" style="width: 165px">Razon Social &nbsp;<i class="fa fa-hospital-o"></i></span>
                            <div>
                                <input id="dlg_pers_razon" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="200">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
            
                
           
          
        </div>
    </div>
</div> 



@endsection




