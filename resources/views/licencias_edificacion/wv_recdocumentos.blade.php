@extends('layouts.map')
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
                                            
                                        <h1 ><b>RECEPCION DE DOCUMENTOS</b></h1>
                                        
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_documento();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                    </button>
                                                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_documento();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                    </button>
                                                    <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_exp();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                                    </button>   
                                                </div>
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
        
        
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/recdocumentos.js') }}"></script>
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
<div id="dlg_nuevo_exp_edit" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 150px">Nro. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="nro_expediente" type="text" class="form-control" style="height: 30px;" maxlength="20">
                        </div>
                    </div>
                    
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 150px">Gestor del Tramite: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="gestor_tramite" type="text" class="form-control" style="height: 30px;" maxlength="100">
                        </div>
                    </div>
                    
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 150px">Fecha Inicio: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="fecha_inicio" type="text"  class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                    
                    <div class="input-group input-group-md" style="width: 100%; padding-top: 10px">
                        <span class="input-group-addon" style="width: 150px">Fecha Registro: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="fecha_registro" type="text" class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

