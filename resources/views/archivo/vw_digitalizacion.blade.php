@extends('layouts.app')
@section('content')
<input type="hidden" id="per_imp" value="{{$permisos[0]->btn_imp}}"/>
<input type="hidden" id="per_edit" value="{{$permisos[0]->btn_edit}}"/>
<section id="widget-grid" class="">  
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Registro de Expedientes...</b></h1>
                <div class="row">
                    <div class="col-xs-12">
                        <div class="text-right">
                            <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
                                <div class="col-xs-12 cr-body" >
                                    <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                                        <section>
                                            <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                                                <header>
                                                        <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                                        <h2>Contribuyente::..</h2>
                                                </header>
                                            </div>
                                        </section>
                                        <div class="col-xs-8" style="padding: 0px; ">
                                            <div class="input-group input-group-md" style="width: 100%">
                                                <span class="input-group-addon" style="width: 165px">N° de Expediente &nbsp;<i class="fa fa-file-archive-o"></i></span>
                                                <div>
                                                    <input id="dlg_num_exp" type="text"  class="form-control" style="height: 32px;" maxlength="30">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12" style="margin-top: 10px;"></div>
                                        <div class="col-xs-8" style="padding: 0px; ">
                                            <div class="input-group input-group-md" style="width: 100%">
                                                <span class="input-group-addon" style="width: 165px">Número Documento &nbsp;<i class="fa fa-hashtag"></i></span>
                                                <div>
                                                    <input id="dlg_nro_doc" type="text"  class="form-control" style="height: 32px;" maxlength="20">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-xs-12" style="margin-top: 10px;"></div>
                                        <div class="col-xs-12" style="padding: 0px; ">
                                            <div class="input-group input-group-md" style="width: 100%">
                                                <span class="input-group-addon" style="width: 165px">Contribuyente &nbsp;<i class="fa fa-male"></i></span>
                                                <div>
                                                    <input id="dlg_contrib" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 101% !important" autofocus="focus" >
                                                </div>
                                                <span class="input-group-btn">
                                                    <button class="btn btn-default" type="button" onclick="fn_bus_contrib_arch('dlg_contrib')">
                                                        <i class="glyphicon glyphicon-search"></i>
                                                    </button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-xs-12" style="margin-top: 10px;"></div>
                                        <div class="col-xs-12" style="padding: 0px; ">
                                            <div class="input-group input-group-md" style="width: 100%">
                                                <span class="input-group-addon" style="width: 165px">Domicilio &nbsp;<i class="fa fa-home"></i></span>
                                                <div>
                                                    <input id="dlg_domicilio" type="text"  class="form-control" style="height: 32px; width: 100%" disabled="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            @if( $permisos[0]->btn_new ==1 )
                                <button onclick="fn_new_archi_expe();"  type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                </button>
                            @else
                                <button onclick="sin_permiso();" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                </button>
                            @endif
                            @if( $permisos[0]->btn_edit ==1 )
                                <button id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                </button>
                            @else
                                <button onclick="sin_permiso();" id="btn_vw_contribuyentes_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                </button>
                            @endif
                            @if( $permisos[0]->btn_imp ==1 )
                                <button type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
                                </button>
                            @else
                                <button onclick="sin_permiso();" type="button" class="btn btn-labeled bg-color-magenta txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-print"></i></span>Imprimir
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
                                <table id="table_doc"></table>
                                <div id="pager_table_doc"></div>
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
        $("#menu_archivo").show();
        $("#li_arch_reg_exp").addClass('cr-active');
        jQuery("#table_doc").jqGrid({
            url: 'list_arch_expe?contrib=0',
            datatype: 'json', mtype: 'GET',
            height: 'auto', autowidth: true,
            toolbarfilter: true,
            colNames: ['id','Año', 'Documento', 'Fecha', 'Observacion','Ver'],
            rowNum: 20, sortname: 'id', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE DOCUMENTOS', align: "center",
            colModel: [                
                {name: 'id', index: 'id', hidden:true},
                {name: 'anio', index: 'anio', align: 'center', width: 30},
                {name: 'documento', index: 'documento', align: 'center', width: 90},
                {name: 'fecha', index: 'fecha', align: 'center', width: 50},
                {name: 'observacion', index: 'observacion', align: 'left', width: 200},
                {name: 'ver', index: 'ver', align: 'left', width: 40}
               
                
            ],
            pager: '#pager_table_doc',
            rowList: [20, 30, 50],
            onSelectRow: function (Id) { },
            ondblClickRow: function (Id) {
                fn_mod_archi_expe();
            },
            gridComplete: function () {
                var rows = $("#table_doc").getDataIDs();
                for (var i = 0; i < rows.length; i++) {
                    var tipo_doc = $("#table_doc").getCell(rows[i], "tipo_doc");
                }
                if (rows.length > 0) {
                    var firstid = jQuery('#table_doc').jqGrid('getDataIDs')[0];
                    $("#table_doc").setSelection(firstid);    
                }
            }
        });
        $(window).on('resize.jqGrid', function () {
            $("#table_doc").jqGrid('setGridWidth', $("#content_2").width());
        });
        
        
        contrib_global=0;
        jQuery("#table_contrib").jqGrid({
            url: 'grid_contrib_arch?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_contrib','DNI/RUC','contribuyente','Dom Fiscal','Expediente'],
            rowNum: 20, sortname: 'nombres', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_contrib', index: 'id_contrib', hidden: true},
                {name: 'nro_doc', index: 'nro_doc', align: 'center',width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left',width: 260},
                {name: 'dom_fiscal', index: 'dom_fiscal', align: 'left',width: 260},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left',width: 100},
                
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                            $("#table_contrib").setSelection(firstid);    
                        }
                    if(contrib_global==0)
                    {   contrib_global=1;    
                        jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list_arch(rowid);} } ); 
                    }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){fn_bus_contrib_list_arch(Id)}
        });
        $("#dlg_nro_doc").keypress(function (e) {
            if (e.which == 13) {
                busqueda(1);
            }
        });
        $("#dlg_num_exp").keypress(function (e) {
            if (e.which == 13) {
                busqueda(2);
            }
        });
        var globalvalidador=0;
        $("#dlg_contrib").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_bus_contrib_arch("dlg_contrib");
                    globalvalidador=1;
                }
                else
                {
                    globalvalidador=0;
                }
                
            }
        });
       
             
    });
</script>
@stop
<script src="{{ asset('archivos_js/archivo/archi_expe.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div> 
<div id="dlg_new_expe" style="display: none;">
    <div class='cr_content col-xs-7 ' style="margin-bottom: 10px;">
        <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>LLenado de Información::..</h2>
                        </header>
                    </div>
                </section>
    <form id="FormularioFiles" name="FormularioFiles" method="post" enctype="multipart/form-data" action="callpdf"  target="ifrafile">
        <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}" data-token="{{ csrf_token() }}"> 
            <input type="hidden" id="id_arch" name="id_arch" value="0"/>
        <input id="id_contrib_hidden" name="id_contrib_hidden" type="hidden" value="0"/>
        <div class="col-xs-8" style="padding: 0px;">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon"  style="width: 165px" >Tipo Documento &nbsp;<i class="fa fa-file"></i></span>
                        <div class="icon-addon addon-md">
                            <select id='seltipdoc' name="seltipdoc" class="form-control col-lg-8" style="height: 32px;">
                            @foreach ($tip_doc as $docs)
                            <option value='{{$docs->id_tip}}' >{{$docs->documento}}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px"></div>
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Año &nbsp;<i class="fa fa-calendar-check-o"></i></span>
                        <div>
                            <input id="dlg_anio" name="dlg_anio" type="text"  class="form-control" style="height: 32px;" maxlength="4" onkeypress="return soloDNI(event);">
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-8" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Fecha &nbsp;<i class="fa fa-calendar"></i></span>
                        <div>
                            <input id="dlg_fec" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
                
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Observaciones &nbsp;<i class="fa fa-eye"></i></span>
                        <div>
                            <input id="dlg_obs_exp" name="dlg_obs_exp" type="text"  class="form-control" style="height: 32px; width: 100%" maxlength="250">
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Dirección &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_direcc_hiddn" name="dlg_direcc_hiddn" type="hidden" >
                            <input id="dlg_direcc" name="dlg_direcc" type="text"  class="form-control" style="height: 32px; width: 94%">
                        </div>
                        <span style="display: inline-block">
                            <button class="btn btn-success" type="button" onclick="new_dir()" style="height: 32px;width: 32px">
                                +
                            </button>
                        </span>
                    </div>
                </div>
                <div id="div_direcc">
                    
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 165px">Documento &nbsp;<i class="fa fa-file-archive-o"></i></span>
                        <div>
                            <input name="dlg_documento_file" id="dlg_documento_file" type="file"  class="form-control" style="height: 32px; width: 100%" onchange="llamarsubmit();">
                        </div>
                    </div>
                </div>
    </form>            
                
            </div>
          
        </div>
    </div>
        <div id="dlg_sub_frame" class='cr_content col-xs-5 ' style="margin-bottom: 10px;">
            <iframe name="ifrafile" id="ifrafile" class="form-control col-xs-12"  style=" height: 400px; padding: 0px"></iframe>
        </div>
</div> 



@endsection




