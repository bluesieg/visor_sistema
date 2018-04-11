//@extends('layouts.map')
@section('content')
<section id="widget-grid" class="">    
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -12px">
            <div class="well well-sm well-light">
                <div class="row">                    
                    
                    <section class="col col-lg-12">
                        
                        <ul id="tabs1" class="nav nav-tabs bordered">
                            <li class="active">
                                <a href="#s1" data-toggle="tab" aria-expanded="true">
                                    VER PREDIAL
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                            <li>
                                <a href="#s2" data-toggle="tab" aria-expanded="false">
                                    VER ARBITRIOS
                                    <i class="fa fa-lg fa-fw fa-cog fa-spin"></i>
                                </a>
                            </li>
                        </ul>
                        
                    <div id="myTabContent1" class="tab-content padding-1"> 
                        
                      <div id="s1" class="tab-pane fade active in">
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="col-xs-12">
                                            
                                    <h1 class="txt-color-green"><b>REGISTRO DE EXPEDIENTES</b></h1>
                                        <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; font-size: 0.6em">
                                           <div class="input-group input-group-md">
                                               <span class="input-group-addon">Desde:</span>
                                               <div class="icon-addon addon-md">
                                               <input  id="fec_ini_cajas" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                               </div>
                                           </div>
                                       </div>
                                       <div class="col-lg-3" style="padding-right: 5px; padding-top: 20px; font-size: 0.6em">
                                            <div class="input-group input-group-md">
                                                <span class="input-group-addon">Hasta:</span>
                                                <div class="icon-addon addon-md">
                                                <input id="fec_fin_cajas" name="dlg_fec" type="text"   class="datepicker text-center" data-dateformat='dd/mm/yy' data-mask="99/99/9999" style="height: 32px; width: 100%" placeholder="--/--/----" value="{{date('d/m/Y')}}">
                                                </div>
                                            </div>
                                        </div>
                                       <div class="text-right" style=" padding-top: 20px">

                                                <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="nuevo_tim();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Nuevo
                                               </button>

                                               <button  type="button" class="btn btn-labeled bg-color-blue txt-color-white" onclick="actualizar_tim();">
                                                   <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Modificar
                                               </button>

                                           <button  type="button" class="btn btn-labeled btn-danger" onclick="eliminar_tim();">
                                               <span class="btn-label"><i class="glyphicon glyphicon-trash"></i></span>Eliminar
                                           </button>


                                       </div>
                                        </div>
                                    </section>
                                   
                                </div>
                            </div>
                           </div>
                        </section>
                        
                      </div>
                        
                        <div id="s2" class="tab-pane fade" style="height: auto">
                        
                        <section class="col col-lg-12">
                        <div class="col-xs-12">               
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 10px">
                                        <div class="well well-sm well-light" style="margin-top:10px;padding:0px">
                                        <table id="table_predios"></table>
                                        <div id="p_table_predios"></div>
                                        </div>
                                    </section>
                                </div>
                            </div> 
                        </div>
                        </section>
                        
                        <section class="col col-lg-6"> 
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <section>
                                    <div class="well well-sm well-light" style="padding:0px">
                                    <table id="table_concepto"></table>
                                    <div id="p_table_concepto"></div>
                                    </div> 
                                </section>    
                            </div>
                        </div> 
                        </section>
                            
                        <section class="col col-lg-6">              
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                    <section style="padding-right: 30px">
                                        <div class="well well-sm well-light" style="padding:0px">
                                        <table id="table_meses"></table>
                                        <div id="p_table_meses"></div>
                                        </div>
                                    </section>
                                </div>
                            </div> 
                        </section>
                            
                        </div> 
                        </div> 
      
                    </section>
                </div>
            </div>            
        </div>       
    </div>
</section>
<script language="JavaScript" type="text/javascript" src="{{ asset('archivos_js/planeamiento_hab_urb/registro_expendientes.js') }}"></script>
<div id="dlg_nuevo_tim" style="display: none;">
    <div class='cr_content col-xs-12 ' style="margin-bottom: 10px;">
    <div class="col-xs-12 cr-body" >
            <div class="col-xs-12 col-md-12 col-lg-12" style="padding: 0px; margin-top: 0px;">
                
                
                <input type="hidden" id="id_tim" value="0">
   
                <div class="col-xs-12" style="padding: 0px; ">
                    <div class="input-group input-group-md" style="width: 100%">
                        <span class="input-group-addon" style="width: 150px">Cod. Expediente: &nbsp;<i class="fa fa-hashtag"></i></span>
                        <div>
                            <input id="valor" type="text" class="form-control" style="height: 30px;" maxlength="7" onkeypress="return soloNumeroTab(event);">
                        </div>
                    </div>
                </div>
                              
            </div>
          
        </div>
    </div>
    </div>
@endsection
