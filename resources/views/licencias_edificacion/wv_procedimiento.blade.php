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
                                            
                                        <h1 ><b>MANTENIMIENTO DE PROCEDIMIENTOS</b></h1>
                                        
                                        <div class="row">
                                            <div class="col-xs-6">    
                                                <label>AÑO:</label>
                                                <label class="select">
                                                    <select id="select_anio" class="input-sm">
                                                        @foreach ($anio as $anio_procedimiento)
                                                            <option value='{{$anio_procedimiento->anio}}' >{{$anio_procedimiento->anio}}</option>
                                                        @endforeach
                                                    </select><i></i>
                                                </label>
                                            </div>
                                            <div class="col-xs-6">
                                                <div class="text-right">
                                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_procedimiento();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                    </button>
                                                    <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_procedimiento();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                    </button>
                                                    <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_procedimiento();">
                                                        <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                                    </button>   
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
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/licencias_edificacion/procedimiento.js') }}"></script>

<div id="dlg_nuevo_procedimiento" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">DNI: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_anio" type="text" class="form-control text-center" style="height: 30px;" disabled="" >
                        </div>
                    </div>
                </div>
                <div class="col-xs-12" style="margin-top: 10px;padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Descripcion: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="inp_descripcion" type="text" class="form-control" style="height: 30px;" maxlength="30">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection

