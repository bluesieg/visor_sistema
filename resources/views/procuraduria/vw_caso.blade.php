@extends('layouts.procuraduria')
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
                                            
                                        <h1 ><b>MANTENIMIENTO DE CASOS</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE CASO:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_caso" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR CASO">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_caso();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                           <div class="col-xs-5">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="crear_nuevo_caso();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo Caso
                                                </button>

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="modificar_caso();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar Caso
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_caso"></table>
                                                        <div id="pager_table_caso"></div>
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
        
        jQuery("#table_caso").jqGrid({
            url: 'procuraduria/0?grid=casos',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID_CASO', 'DESCRIPCION'],
            rowNum: 50, sortname: 'id_caso', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE CASOS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_caso', index: 'id_caso', hidden: true},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 100}
            ],
            pager: '#pager_table_caso',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_caso').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_caso').jqGrid('getDataIDs')[0];
                            $("#table_caso").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){modificar_caso();}
        });
        
        $("#dlg_buscar_caso").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_caso();

            }
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/procuraduria/caso.js') }}"></script>

<div id="dlg_nuevo_caso" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DESCRIPCION DE CASO</div>
        <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
            
            <div class="col-xs-12" style="padding: 0px; margin-top:10px;">
                <div class="input-group input-group-md" style="width: 100%">
                    <span class="input-group-addon" style="width: 180px">DESCRIPCION: &nbsp;<i class="fa fa-home"></i></span>
                    <div>
                        <input id="dlg_descripcion" type="text" class="form-control text-uppercase" maxlength="150" style="height: 30px;"  >
                    </div>
                </div>
            </div>  
      
        </div>
    </div>
    </div>
    
</div>
@endsection

