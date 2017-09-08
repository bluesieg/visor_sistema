@extends('layouts.app')
@section('content')
<section id="widget-grid" class=""> 
    <div class='cr_content col-xs-12 '>
        <div class="col-xs-9">
            <h1 class="txt-color-green"><b>Generación de Carta de Requerimiento</b></h1>
        </div>
        <div class="col-xs-3" style="margin-top: 5px; padding-right: 23px;">
            <div class="input-group input-group-md">
                <span class="input-group-addon">Año de Tramite <i class="fa fa-cogs"></i></span>
                <div class="icon-addon addon-md">
                    <select id='selantra' class="form-control col-lg-8" style="height: 32px;">
                    @foreach ($anio_tra as $anio)
                    <option value='{{$anio->anio}}' >{{$anio->anio}}</option>
                    @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="col-xs-12 cr-body" >
            
            <div class="col-xs-3" style="padding: 0px; margin-top: 5px">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 0px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                <h2>Busqueda por Contribuyente</h2>
                        </header>
                    </div>
                </section>
            </div>
            <div class="col-xs-9" style="padding: 0px; margin-top: 5px">
                
                <div class="col-xs-8" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Contribuyente &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_contri_hidden" type="hidden" value="0">
                            <input id="dlg_contri" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 102% !important" autofocus="focus" >
                        </div>
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="button" onclick="fn_bus_contrib_carta('dlg_contri')">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                
            </div>
            
            
            <div class="col-xs-12"></div>
            <div class="col-xs-3" style="padding: 0px; margin-top: 5px">
                <div>
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 5px; padding: 0px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
                                <h2>Busqueda Por Fechas</h2>
                        </header>
                    </div>
                </section>
                </div>
            </div>
            <div class="col-xs-9" style="padding: 0px; margin-top: 5px">
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Desde &nbsp;<i class="fa fa-calendar"></i></span>
                        <div class=""  >
                            <input id="dlg_bus_fini" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Hasta &nbsp;<i class="fa fa-calendar"></i></span>
                        <div class=""  >
                            <input id="dlg_bus_ffin" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
                <div class='col-lg-2'style="padding: 0px;" >
                    <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="call_list_contrib_carta(2)">
                        <span class="btn-label"><i class="glyphicon glyphicon-search"></i></span>Buscar fechas
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class='cr_content col-xs-12'>
       
        <div class="col-xs-12" style="padding: 0px; margin-top: 10px">
            <article class="col-xs-11" style=" padding: 0px !important">
                    <table id="table_cartas"></table>
                    <div id="pager_table_cartas"></div>
            </article>
            <div class="col-xs-1 text-center" style="padding-right: 0px;">
                <button class="btn bg-color-green txt-color-white btn-circle btn-xl" onclick="fn_new_carta();" >
                    <span  >
                        <i class="glyphicon glyphicon-plus"></i>
                    </span>
                </button>
                    <label><b>Nuevo</b></label>
            </div>
            </div>
    </div>
    
</section>
@section('page-js-script')
<script type="text/javascript">
    $(document).ready(function (){
        $("#menu_fisca").show();
        $("#li_fisca_carta").addClass('cr-active')
        jQuery("#table_cartas").jqGrid({
            url: 'trae_cartas/'+$("#selantra").val()+'/0/0/0',
            datatype: 'json', mtype: 'GET',
            height: '260px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_car', 'Nro', 'contribuyente', 'Registro','Fiscalizacion','Ver'],
            rowNum: 20, sortname: 'id_car', sortorder: 'desc', viewrecords: true, caption: 'Lista de Ordenes', align: "center",
            colModel: [
                {name: 'id_car', index: 'id_gen_fis', hidden: true},
                {name: 'nro_car', index: 'nro_car', align: 'center', width: 15},
                {name: 'contribuyente', index: 'contribuyente', align: 'center', width: 40},
                {name: 'fec_reg', index: 'fec_reg', align: 'center', width: 15},
                {name: 'fec_fis', index: 'fec_fis', align: 'center', width: 16},
                {name: 'id_car', index: 'id_car', align: 'center', width: 15},

            ],
            pager: '#pager_table_cartas',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_cartas').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_cartas').jqGrid('getDataIDs')[0];
                            $("#table_cartas").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){}
        });
        jQuery("#table_contrib").jqGrid({
            url: 'obtiene_cotriname?dat=0',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['id_pers','codigo','DNI/RUC','contribuyente','Dom Fiscal'],
            rowNum: 20, sortname: 'contribuyente', sortorder: 'asc', viewrecords: true, caption: 'Contribuyentes', align: "center",
            colModel: [
                {name: 'id_pers', index: 'id_pers', hidden: true},
                {name: 'id_per', index: 'id_per', align: 'center',width: 100},
                {name: 'nro_doc', index: 'nro_doc', align: 'center',width: 100},
                {name: 'contribuyente', index: 'contribuyente', align: 'left',width: 260},
                {name: 'dom_fiscal', index: 'dom_fiscal', align: 'left',width: 260},
                
            ],
            pager: '#pager_table_contrib',
            rowList: [13, 20],
            gridComplete: function () {
                    var idarray = jQuery('#table_contrib').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_contrib').jqGrid('getDataIDs')[0];
                            $("#table_contrib").setSelection(firstid);    
                        }
                    jQuery('#table_contrib').jqGrid('bindKeys', {"onEnter":function( rowid ){fn_bus_contrib_list_carta(rowid);} } ); 
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){fn_bus_contrib_list(Id)}
        });
        
        
        
        var globalvalidador=0;
        $("#dlg_contri").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_bus_contrib_carta("dlg_contri");
                    globalvalidador=1;
                }
                else
                {
                    globalvalidador=0;
                }
                
            }
        });
        $("#dlg_contri_carta").keypress(function (e) {
            if (e.which == 13) {
                if(globalvalidador==0)
                {
                    fn_bus_contrib_carta("dlg_contri_carta");
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
<script src="{{ asset('archivos_js/fiscalizacion/carta_reque.js') }}"></script>
<div id="dlg_bus_contr" style="display: none;">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-top:5px; margin-bottom: 10px; padding: 0px !important">
        <table id="table_contrib"></table>
        <div id="pager_table_contrib"></div>
    </article>
</div> 
<div id="dlg_new_carta" style="display: none;">
    
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
        <div id="div_adquiere" class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-info"></i> </span>
                                <h2>LLenado de Información::..</h2>
                        </header>
                    </div>
                </section>
                <div class="col-xs-3" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">N° Doc. &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div class=""  >
                            <input id="dlg_contri_carta_doc" type="text"  class="form-control" style="height: 32px; " disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-9" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Contribuyente a Fiscalizar &nbsp;<i class="fa fa-male"></i></span>
                        <div>
                            <input id="dlg_contri_carta_hidden" type="hidden" value="0">
                            <input id="dlg_contri_carta" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;width: 102% !important" autofocus="focus" >
                        </div>
                        <span class="input-group-btn" style="font-size: 13px;">
                            <button class="btn btn-default" type="button" onclick="fn_bus_contrib_carta('dlg_contri_carta')">
                                <i class="glyphicon glyphicon-search"></i>
                            </button>
                        </span>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;"></div>
                
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Domicilio Fiscal &nbsp;<i class="fa fa-map"></i></span>
                        <div>
                            <input id="dlg_contri_carta_dom" type="text"  class="form-control" style="height: 32px;font-size: 0.9em;" disabled="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-calendar-o"></i> </span>
                                <h2>Selección de Fecha de Fiscalización ::..</h2>
                        </header>
                    </div>
                </section>
                
                <div class="col-xs-5" style="padding: 0px;">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Fecha Fizcalizacion &nbsp;<i class="fa fa-calendar"></i></span>
                        <div class=""  >
                            <input id="dlg_fec_fis" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 10px;margin-bottom: 10px;">
                <section>
                    <div class="jarviswidget jarviswidget-color-green" style="margin-bottom: 15px;"  >
                        <header>
                                <span class="widget-icon"> <i class="fa fa-users"></i> </span>
                                <h2>Seleccion de Fizcalizadores ::..</h2>
                        </header>
                    </div>
                </section>

                <div class="col-xs-10" style="padding: 0px; ">
                    <div class="input-group input-group-md">
                        <span class="input-group-addon">Fiscalizadores &nbsp;<i class="fa fa-list"></i></span>
                        <div>
                            <select id='selfisca' class="form-control col-lg-8" style="height: 32px;">
                                <option value="0">--Seleccione--</option>
                                @foreach ($fiscalizadores as $fis)
                                    <option value='{{$fis->id_user_fis}}' documento="{{trim($fis->pers_nro_doc)}}">{{trim($fis->pers_nro_doc)."-".trim($fis->fiscalizador)}}</option>
                                @endforeach
                            </select>                       
                        </div>
                    </div>
                </div>
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white col-xs-2" onclick="poner_fisca()">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-plus"></i></span>Poner Fiscalizador
                </button>
                
                    <div class="table-responsive col-xs-12" style="margin-top: 10px; height: 150px; border: 1px solid #bbb; padding:10px;">

                        <table class="table " id="table_fiscalizadores" >
                                <thead>
                                        <tr>
                                            <th class="text-center" style="border: 1px solid #bbb; width: 10%; height: 30px">Codigo</th>
                                            <th class="text-center"  style="border: 1px solid #bbb; width: 10%; height: 30px">Documento</th>
                                            <th class="text-center"  style="border: 1px solid #bbb; width: 70%;height: 30px">Nombre Fiscalizador</th>
                                            <th class="text-center"  style="border: 1px solid #bbb; width: 10%; height: 30px">Borrar</th>

                                        </tr>
                                </thead>
                                <tbody>
                                 

                                </tbody>
                        </table>

                    </div>
            </div>
            <ul id="sparks" >
                <button type="button" class="btn btn-labeled bg-color-green txt-color-white" onclick="fn_confirmar_carta()">
                    <span class="cr-btn-label"><i class="glyphicon glyphicon-save"></i></span>Guardar y Generar
                </button>
            </ul>
        </div>
    </div>
</div> 



@endsection




