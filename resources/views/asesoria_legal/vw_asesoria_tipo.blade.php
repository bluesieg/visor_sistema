@extends('layouts.asesoria_legal')
@section('content')
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
                                            
                                        <h1 ><b>MANTENIMIENTO DE TIPO</b></h1>
                                        
                                        <div class="row" style="padding: 0px; margin-top: 30px">
                                            <div class="col-xs-5">
                                                <div class="input-group input-group-md">
                                                    <span class="input-group-addon">NOMBRE TIPO:. &nbsp;<i class="fa fa-male"></i></span>
                                                    <div>
                                                        <input id="dlg_buscar_tipo" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="ESCRIBIR NOMBRE TIPO">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xs-2">
                                                <div class="text-left">
                                                        <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="buscar_tipos();">
                                                            <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                                        </button>
                                                </div>
                                            </div>
                                            
                                           <div class="col-xs-5 text-right">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="new_tipo();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                                </button>

                                                <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="edit_tipo();">
                                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                                </button>
                                            </div>
                                        </div>
                                        
                                            <div class="col-xs-12" style="padding: 0px; margin-top: 30px">
                                                <article class="col-xs-12" style=" padding: 0px !important">
                                                        <table id="table_asesoria_tipos"></table>
                                                        <div id="pager_table_asesoria_tipos"></div>
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
        
        jQuery("#table_asesoria_tipos").jqGrid({
            url: 'asesoria_legal/0?grid=tipos',
            datatype: 'json', mtype: 'GET',
            height: '300px', autowidth: true,
            toolbarfilter: true,
            colNames: ['ID_TIPO', 'DESCRIPCION'],
            rowNum: 50, sortname: 'id_tipo', sortorder: 'desc', viewrecords: true, caption: 'LISTA DE TIPOS - CERRO COLORADO', align: "center",
            colModel: [
                {name: 'id_tipo', index: 'id_tipo', hidden: true},
                {name: 'descripcion', index: 'descripcion', align: 'left', width: 100}
            ],
            pager: '#pager_table_asesoria_tipos',
            rowList: [50, 100],
            gridComplete: function () {
                    var idarray = jQuery('#table_asesoria_tipos').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_asesoria_tipos').jqGrid('getDataIDs')[0];
                            $("#table_asesoria_tipos").setSelection(firstid);    
                        }
                },
            onSelectRow: function (Id){},
            ondblClickRow: function (Id){edit_tipo();}
        });
        
        $("#dlg_buscar_tipo").keypress(function (e) {
            if (e.which == 13) {

                   buscar_tipos();

            }
        });
         
    });
</script>

@stop
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/asesoria_legal/asesoria_tipo.js') }}"></script>

<div id="dlg_nuevo_tipo" style="display: none;">
    <div class='cr_content col-xs-12' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body panel-success">
        <div class="panel-heading bg-color-success">DESCRIPCION DE TIPO</div>
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

