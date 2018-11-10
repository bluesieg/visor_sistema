<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MDCC</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

        <link rel="stylesheet" href="{{ asset('layers/ol.css')}}" />
        <script src="{{ asset('layers/ol.js')}}"></script>
        <script src="{{ asset('js/libs/jquery-2.1.1.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('layers/ol3-layerswitcher.css')}}">
        <script  src="{{ asset('layers/ol3-layerswitcher.js')}}"></script>
        <script src="{{ asset('js/plugin/jqgrid/jquery.jqGrid.min.js') }}"></script>
        <script src="{{ asset('js/plugin/jqgrid/grid.locale-en.min.js') }}"></script>

        <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

        <!-- SmartAdmin Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
        <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
        <script src='mapbox/mapbox.js'></script>
        <link href='mapbox/mapbox.css' rel='stylesheet' />
        <link href="{{ asset('css/jquery-confirm.css') }}" rel="stylesheet">
         


    </head>
    <body class="desktop-detected pace-done fixed-header fixed-navigation" style="background: white !important">
        <header id="header" style="background: #154360 !important;">
            <div id="logo-group">                
                <span id="logo"> <img src="img/logos/logo_largo.png" alt="SmartAdmin"> </span> 

            </div>
            @if (Auth::guest())
            <div class="pull-right" style="margin-top: 8px">
                <a href="{{ route('login') }}" class="btn btn-default ">Iniciar Session</a>                
            </div>  
            @else
            <div class="pull-right">
                <div id="hide-menu" class="btn-header pull-right">
                    <span> <a style="background: #356E35; color:white;border: 1px solid white;" href="javascript:void(0);" data-action="toggleMenu" title="Colapsar Menu"><i class="fa fa-reorder"></i></a> </span>
                </div> 
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a style="background: #A90329 !important; color:white;border: 1px solid white;" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Salir" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> 
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
                </div>     
                <ul class="header-dropdown-list">
                    <li class="">
                        <a href="#" class="dropdown-toggle userdropdown pull-right" data-toggle="dropdown" style="margin-top: 8px;font-weight:bold;text-transform: uppercase;color: white"> 
                            @if (Auth::user()->foto)
                                <img src="data:image/png;base64,{{ Auth::user()->foto }}" style="width: 28px; height: 35px;border: 1px solid #fff; outline: 1px solid #bfbfbf;">                           
                            @else
                                <img src="{{asset('img/avatars/male.png')}}" style="width: 28px; height: 35px;border: 1px solid #fff; outline: 1px solid #bfbfbf;">                           
                            @endif
                            <span >BIENVENIDO, {{ Auth::user()->ape_nom }} </span> <i class="fa fa-angle-down" ></i> 
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a onclick="cambiar_foto_usuario();" class="padding-10 padding-top-0 padding-bottom-0" style="cursor: pointer;margin-bottom: 4px;"><i class="fa fa-cog"></i> Cambiar Foto</a>
                            </li>                            
                            <li>
                                <a onclick="cambiar_password();" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Cambiar Password</a>
                            </li>                            
                        </ul>
                    </li>
                </ul>
            </div>    
            @endif
        </header>
        <!-- Dialogo de alertas -->
        <div id="alertdialog" style="display: none;" ></div>
        
        @if (!Auth::guest())
        <aside id="left-panel" style="background: #231918 !important; border-right: 2px #bfbfbf dashed; overflow-y: scroll; width: 300px; padding-bottom: 50px">        
                <div class="login-info" style="background: #2471A3;border-bottom: 3px solid #f2f2f2;">
                <span> <!-- User image size is adjusted inside CSS, it should stay as is --> 
                    <a>
                        @if (Auth::user()->foto)
                            <img src="data:image/png;base64,{{ Auth::user()->foto }}" alt="me" style="width: 20px; height: 25px;" class="online"/> 
                        @else
                            <img src="{{asset('img/avatars/male.png')}}" alt="me" style="width: 20px; height: 25px;" class="online"/> 
                        @endif
                        
                        <span style="color: white;">
                            Usuario:{{ Auth::user()->usuario }}
                        </span>
                        <!--<i class="fa fa-angle-down" style="color: white;"></i>-->
                    </a> 
                </span>
            </div>
            <!-- widget div-->
            <div style="margin-top: 20px">
            <!-- widget content -->
                <div class="widget-body no-padding">
                    <div class="panel-group smart-accordion-default" id="accordion-2" style="padding-right: 11px;">
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseOne-1"> <i class="fa fa-fw fa-plus-circle txt-color-white"></i> <i class="fa fa-fw fa-minus-circle txt-color-white"></i> General </a></h4>
                            </div>
                            <div id="collapseOne-1" class="panel-collapse collapse in cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
<!--                                            widget edit box -->
                                           <div class="jarviswidget-editbox">
<!--                                                    This area used as dropdown edit box -->

                                           </div>
<!--                                            end widget edit box -->
<!--                                            widget content -->
                                           <div class="widget-body">
                                               <div class="tree smart-form" style="color:white !important">
                                                    <ul >
                                                            <li >
                                                                <span style="width: 170px;">
                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                        <input type="checkbox" name="checkbox-inline" checked="checked" id="chk_limite" onchange="valida_capa('chk_limite')"/>

                                                                        <i></i>
                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                        Limites
                                                                </span>
                                                            </li>
                                                            <li>
                                                                <span style="width: 170px;">
                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                        <input type="checkbox" name="checkbox-inline" id="chk_agencias" onchange="valida_capa('chk_agencias')">
                                                                        <i></i>
                                                                        <span style="background-color: #04A4B4; width: 5px !important ; height: 5px !important;"></span>
                                                                        Sectores Administrativos
                                                                    </label> 
                                                                </span>
                                                            </li>
                                                    </ul>
                                                </div>
                                           </div>
<!--                                            end widget content -->

                                   </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background: transparent">
                            <div class="panel-heading" style="background: #2471A3; color: white" >
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseTwo-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-white"></i> <i class="fa fa-fw fa-minus-circle txt-color-white"></i> GDUC </a></h4>
                            </div>
                            <div id="collapseTwo-1" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-3">
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" class="collapsed" href="#zon_terri"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Zonas Territoriales </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne-sub-zon_terri" class="panel-collapse cr_toogle collapse">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           
                                                        <!--end widget content -->
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" class="collapsed" href="#collapseOne-sub-1"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> Zonas Distritales </a></h4>
                                                </div>
                                                <div id="collapseOne-sub-1" class="panel-collapse cr_toogle collapse">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                    <ul >

                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_z_urbana" onchange="valida_capa('chk_z_urbana')"/>

                                                                                        <i></i>
                                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Z. Urbana
                                                                                </span>
                                                                            </li>
                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_z_agricola" onchange="valida_capa('chk_z_agricola')">
                                                                                        <i></i>
                                                                                        <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Z. Agrícola
                                                                                    </label> 
                                                                                </span>
                                                                            </li>
                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_z_eriaza" onchange="valida_capa('chk_z_eriaza')">
                                                                                        <i></i>
                                                                                        <span style="background-color: #009900; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Z. Eriaza
                                                                                    </label> 
                                                                                </span>
                                                                            </li>


                                                                    </ul>
                                                                   
                                                              </div>

                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> Catastro </a></h4>
                                                </div>
                                                <div id="collapseTwo_sub-1" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_sector" onchange="valida_capa('chk_sector')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Sector
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_mzna" onchange="valida_capa('chk_mzna')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #009900; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Manzana
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_lote" onchange="valida_capa('chk_lote')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #C70039; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Lotes
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_hab_urb" onchange="valida_capa('chk_hab_urb')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #B40477; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Hab. Urbanas
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_vias" onchange="valida_capa('chk_vias')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #B40477; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Vias
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-aportes" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Aportes 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-aportes" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_aportes" onchange="valida_capa('chk_aportes')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Aportes
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTree_sub-1" class="collapsed"> <i class="fa fa-fw fa-plus-circle txt-color-green"></i> <i class="fa fa-fw fa-minus-circle txt-color-red"></i> Infra. Urbana </a></h4>
                                                </div>
                                                <div id="collapseTree_sub-1" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_salud" onchange="valida_capa('chk_salud')">
                                                                                    <i></i>
                                                                                    <img src="img/recursos/hospital.png" height="20px" />
                                                                                    Salud
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_educacion" onchange="valida_capa('chk_educacion')">
                                                                                    <i></i>
                                                                                    <img src="img/recursos/colegio.png" height="20px" />
                                                                                    Educación
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_comer" >
                                                                                    <i></i>
                                                                                    Comercio
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_industria" >
                                                                                    <i></i>
                                                                                    Industria
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_deporte">
                                                                                    <i></i>
                                                                                    Recre. Dep.
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_recre_esp">
                                                                                    <i></i>
                                                                                    Recre. Esp.
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_parque" >
                                                                                    <i></i>
                                                                                    Pareque Recre.
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_otros" >
                                                                                    <i></i>
                                                                                    Otros
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_gob" >
                                                                                    <i></i>
                                                                                    Gubernamentales
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_finan" >
                                                                                    <i></i>
                                                                                    Ins. Financieras
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-quebradas" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Quebradas 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-quebradas" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_quebradas" onchange="valida_capa('chk_quebradas')" >
                                                                                    <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Quebradas
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                  </ul>
                                                               </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-predios_mun" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Predios Municipales 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-predios_mun" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                                <div class="panel panel-default" style="background:  transparent;">
                                                <div class="panel-heading" style="background: #2471A3; color: white">

                                                    <h4 class="panel-title"><a data-toggle="collapse" href="#collapse_plan">
                                                            <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                                            Planeamiento y Hab. Urbanas 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_plan" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 20px" >
                                                        <div>
                                                        <!-- widget content -->
                                                        <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="registro_expedientes"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Constancia de Posesión
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="consultar_expedientes"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Consultar Expediente
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="mantenimiento_inspectores"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mantenimiento de Inspectores
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                     <li >
                                                                         <span style="width: 160px;">
                                                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                 <input type="checkbox" name="checkbox-inline" id="chk_map_cons" onchange="valida_capa('chk_map_cons')" >
                                                                                                                    <i></i>
                                                                                     <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                 Mapa Constancias
                                                                                                                </label> 
                                                                                                            </span> 
                                                                                                        </li>
                                                                                                    </ul>
                                                                                </div>
                                                              </div>
                                                        <!-- end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  #2471A3; color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapse_licencias_edificacion" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                                            Sub Gerencia Obras Privadas 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_licencias_edificacion" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 20px" >
                                                        <div>
                                                        <!-- widget content -->
                                                        <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="procedimientos"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Procedimientos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="requisitos"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Requisitos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="recepcion_documentos"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Recepcion de Documentos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="widget-body">
                                                                    <div class="tree smart-form" style="color:white !important">
                                                                        <ul >
                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_map_licencias" onchange="valida_capa('chk_map_licencias')" ><i></i>
                                                                                    <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Mapa Licencias Edificacion
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                        </div>
                                                       
                                                        <!-- end widget content -->
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  #2471A3; color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapse_hab_urbana" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                                            Sub Gerencia Habilitaciones Urb 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapse_hab_urbana" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 20px" >
                                                        <div>
                                                        <!-- widget content -->
                                                        <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="hab_urbana"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Habilitaciones Urbanas
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                            </div>
                                                        </div>
                                                        <div class="widget-body">
                                                                    <div class="tree smart-form" style="color:white !important">
                                                                        <ul >
                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_map_mod_hab_urb" onchange="valida_capa('chk_map_mod_hab_urb')" ><i></i>
                                                                                    <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Mapa Hab. Urbanas
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                         </div>
                                                       
                                                        <!-- end widget content -->
                                                    </div>
                                                </div>
                                            </div>
                                                
                                                
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-espa_publi" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Sub Ge. Cat. y espacios Publicos
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-espa_publi" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_fiscalizacion" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Fiscalización
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                       
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-planos_tematicos" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Planos Temáticos
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-planos_tematicos" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_topografia" onchange="valida_capa('chk_topografia')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Topografía
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_relieve" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Relieve
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_3D" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    3D
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li style="padding-left: 0px;" >
                                                                                
                                                                                <div class="tree">
                                                                                    <ul style="padding-left: 0px; padding-top: 0px">
                                                                                            <li>
                                                                                                <span class="label " style=" border: 1px dotted #999;width: 160px; color: white">
                                                                                                        <i class="fa fa-lg fa-minus-circle"></i> PDM
                                                                                                    </span>
                                                                                                    <ul>
                                                                                                        <li>
                                                                                                            <span style="width: 120px">
                                                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_pdm_zonificacion" onchange="valida_capa('chk_pdm_zonificacion')">
                                                                                                                    <i></i>
                                                                                                                    Zonificación
                                                                                                                </label> 
                                                                                                            </span> 
                                                                                                        </li>
                                                                                                        <li>
                                                                                                            <span style="width: 120px">
                                                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_pdm_plan_vial" onchange="valida_capa('chk_pdm_plan_vial')">
                                                                                                                    <i></i>
                                                                                                                    Plan Vial
                                                                                                                </label> 
                                                                                                            </span>
                                                                                                        </li>
                                                                                                    </ul>
                                                                                            </li>

                                                                                    </ul>
                                                                                </div>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_usos" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Usos
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_espe_urba" onchange="valida_capa('chk_espe_urba')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Expediente Urbano
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_puntos_geo" onchange="valida_capa('chk_puntos_geo')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Puntos Geodésicos
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_carta_nac" onchange="valida_capa('chk_carta_nac')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Carta Nacional
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important;padding-left: 0px;" onclick="viewlong('cartas_nacional/1940.jpg')">
                                                                                    <img src="img/recursos/img_icon.png" height="20px" />
                                                                                    Carta Nacional 1940
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li >
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important;padding-left: 0px;" onclick="viewlong('cartas_nacional/1956.jpg')">
                                                                                    <img src="img/recursos/img_icon.png" height="20px" />
                                                                                    Carta Nacional 1956
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                       
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-extrac_mat" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Extracción de Materiales 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-extrac_mat" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_ext_mat" onchange="valida_capa('chk_ext_mat')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #09EAD9; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Extracción de Materiales
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-uni_catas" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Unidades Catastrales
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-uni_catas" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 
                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_ext_mat" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #09EAD9; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Unidades Catastrales
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-lot_rurales" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Lotes Rurales
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-lot_rurales" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 
                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_lotes_rurales" onchange="valida_capa('chk_lotes_rurales')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #109528; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Lotes Rurales
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapsetree-1">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        Gerencia Adm. Tributaria 
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsetree-1" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div class="widget-body">
                                        <div class="tree smart-form" style="color:white !important">
                                            <ul >
                                                <li >
                                                <span style="width: 200px;">
                                                    <label class="checkbox inline-block" style="color:white !important">
                                                        <input type="checkbox" name="checkbox-inline" id="chk_map_gerencia_adm_trib" onchange="valida_capa('chk_map_gerencia_adm_trib')" >
                                                                                           <i></i>
                                                            <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                        Ver Mapa Reportes
                                                    </label> 
                                                </span> 
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapse-asesoria-legal">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        Asesoría Legal
                                    </a>
                                </h4>
                            </div>
                             <div id="collapse-asesoria-legal" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                          <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                 <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="asesoria_legal?tipo=legal"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Asesoria Legal
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="asesoria_legal?tipo=reportes"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Reportes
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="asesoria_legal?tipo=abogados"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mant. Abogados
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                 <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="asesoria_legal?tipo=tipos"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mant. Tipos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="asesoria_legal?tipo=t_sanción"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mant. Tipo Sancion
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="asesoria_legal?tipo=proceso"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mant. Proceso
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="asesoria_legal?tipo=materia"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mant. Materia
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="asesoria_legal?tipo=legal"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mant. Casos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="widget-body">
                                                                    <div class="tree smart-form" style="color:white !important">
                                                                        <ul >
                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_map_licencias" onchange="valida_capa('chk_map_licencias')" ><i></i>
                                                                                    <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Mapa Asesoria legal
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                
                                                                
                                                            </div>
                                                        </div>

                                   </div>
                                </div>
                            </div>  
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapse-procuraduria">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        Procuraduria
                                    </a>
                                </h4>
                            </div>
                            <div id="collapse-procuraduria" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                        <div class="widget-body no-padding">
                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                <div class="panel panel-default" style="background: transparent">
                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                        <h4 class="panel-title"><a href="procuraduria?tipo=procuraduria"> 
                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                Procuraduria
                                                            </a>
                                                        </h4>
                                                    </div>
                                                    
                                                    <div class="widget-body">
                                                        <div class="tree smart-form" style="color:white !important">
                                                            <ul >
                                                                <li >
                                                                    <span style="width: 160px;">
                                                                        <label class="checkbox inline-block" style="color:white !important">
                                                                        <input type="checkbox" name="checkbox-inline" id="chk_map_procuraduria" onchange="valida_capa('chk_map_procuraduria')"><i></i>
                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                        Mapa Procuraduria
                                                                        </label> 
                                                                    </span> 
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>

                                                 <div class="panel panel-default" style="background: transparent">
                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                        <h4 class="panel-title"><a href="procuraduria_mant_tipo"> 
                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                Mant. Tipos
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default" style="background: transparent">
                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                        <h4 class="panel-title"><a href="procuraduria?tipo=tipo_sancion"> 
                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                Mant. Tipo Sancion
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default" style="background: transparent">
                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                        <h4 class="panel-title"><a href="procuraduria?tipo=proceso"> 
                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                Mant. Proceso
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default" style="background: transparent">
                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                        <h4 class="panel-title"><a href="procuraduria?tipo=materia"> 
                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                Mant. Materia
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>
                                                <div class="panel panel-default" style="background: transparent">
                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                        <h4 class="panel-title"><a href="procuraduria?tipo=caso"> 
                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                Mant. Casos
                                                            </a>
                                                        </h4>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                   </div>
                                </div>
                            </div>                         
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapsesix-1">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        Coactiva
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsesix-1" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>

                                   </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseseven-1">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        G. Servicios Ciudadanos
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseseven-1" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-3">
                                            
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" class="collapsed" href="#collapseOne-sub-limpieza_publica"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Limpieza Pública
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne-sub-limpieza_publica" class="panel-collapse cr_toogle collapse">
                                                    <div class="panel-body" style="padding: 0px;padding-left: 20px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="rutas_barrido_calles"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                                                                Mod. Rutas Barrido Calles
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="rutas_recojo_residuos"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                                                                Mod. Rutas Recojo Residuos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" class="collapsed" href="#collapseOne-sub-plan_tema_admini"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Plan Temático Administrativo
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne-sub-plan_tema_admini" class="panel-collapse cr_toogle collapse">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                    <ul >

                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_a_predios" onchange=""/>

                                                                                        <i></i>
                                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Predios
                                                                                </span>
                                                                            </li>
                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_a_aportes" onchange=""/>

                                                                                        <i></i>
                                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Aportes
                                                                                </span>
                                                                            </li>
                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_a_complejos" onchange=""/>

                                                                                        <i></i>
                                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Complejos
                                                                                </span>
                                                                            </li>
                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_a_parques" onchange=""/>

                                                                                        <i></i>
                                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Parques
                                                                                </span>
                                                                            </li>
                                                                    </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-resi_soli" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Residuos Sólidos 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-resi_soli" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_botaderos" onchange="valida_capa('chk_aportes')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Botaderos
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_curtiembre" onchange="valida_capa('chk_aportes')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Ubicación Curtiembres
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-atencion" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Plano Temático Atención
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-atencion" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_area_verdes" onchange="valida_capa('chk_aportes')">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Areas Verdes
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseeigth-1">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        G. Seguridad Ciudadana
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseeigth-1" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-3">
                                            <!--option-->
<!--                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-camaras" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Cámaras
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-camaras" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        widget edit box 
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        end widget edit box 

                                                            widget content 
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_camaras" onchange="valida_capa('chk_camaras')">
                                                                                    <i></i>
                                                                                    <img src="img/recursos/camara-md.png" height="20px" />
                                                                                    Cámaras
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        end widget content 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>-->
                                            <!-- fin option-->
                                            
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-operaciones_vig_int" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Sub Ge. Operaciones y Vigilancia Interna
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-operaciones_vig_int" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                            <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_op_vigilancia_interna?tipo=comisarias"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Matenimiento Comisarias
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="widget-body">
                                                                        <div class="tree smart-form" style="color:white !important">
                                                                            <ul>
                                                                            <li>
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                         <input type="checkbox" name="checkbox-inline" id="chk_geren_seg_ciud_comisarias" onchange="valida_capa('chk_geren_seg_ciud_comisarias')" >
                                                                                            <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                         Mapa de Comisarias
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_op_vigilancia_interna?tipo=mapa_delito"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Matenimiento Map. Delito
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="widget-body">
                                                                        <div class="tree smart-form" style="color:white !important">
                                                                            <ul>
                                                                            <li>
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                         <input type="checkbox" name="checkbox-inline" id="chk_geren_seg_ciud_delitos" onchange="valida_capa('chk_geren_seg_ciud_delitos')" >
                                                                                            <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                         Mapa de Delitos
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_op_vigilancia_interna?tipo=rutas_serenazgo"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mantenimiento Rutas Serenazgo
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="widget-body">
                                                                        <div class="tree smart-form" style="color:white !important">
                                                                            <ul>
                                                                            <li>
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                         <input type="checkbox" name="checkbox-inline" id="chk_geren_seg_ciud_camaras" onchange="valida_capa('chk_geren_seg_ciud_camaras')" >
                                                                                            <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                         Mapa de Camaras
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                        </div>
<!--                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_geren_seg_ciud_comisarias" onchange="valida_capa_gerencia_seg_ciud('chk_geren_seg_ciud_comisarias')">
                                                                                    <i></i>
                                                                                    <img src="img/recursos/comisaria.png" height="20px" />
                                                                                    Comisarias
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_geren_seg_ciud_delitos" onchange="valida_capa_gerencia_seg_ciud('chk_geren_seg_ciud_delitos')">
                                                                                    <i></i>
                                                                                    <img src="img/recursos/camara-md.png" height="20px" />
                                                                                    Mapa del Delito
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_geren_seg_ciud_basureros" onchange="valida_capa_gerencia_seg_ciud('chk_geren_seg_ciud_basureros')">
                                                                                    <i></i>
                                                                                    <img src="img/recursos/camara-md.png" height="20px" />
                                                                                    Basureros
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 200px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_plan_riesgo" onchange="">
                                                                                    <i></i>
                                                                                    <img src="img/recursos/camara-md.png" height="20px" />
                                                                                    Rutas de Serenazgo
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>-->
                                                        <!--end widget content -->
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-riesgo_desa" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Sub Ge. Riesgos y Desastres
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-riesgo_desa" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        
                                                            <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_riesgos_desastres?tipo=zona_riesgo"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mod. Zonas de Riesgos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_riesgos_desastres?tipo=ctr_zona_riesgo"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mod. de Construcciones en Zonas de Riesgo
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_riesgos_desastres?tipo=atencion_emergencia"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mod. de Zonas de Atencion por Emergencia
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                               </div>
                                                                
                                                            </div>
                                                            </div>
      
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-seguridad_vial" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Sub Ge. Transito y Seguridad Vial
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-seguridad_vial" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                            <!--end widget edit box widget content -->
                                                            <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_transito_seg_vial"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mod. Ubicacion de Semaforos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="widget-body">
                                                                        <div class="tree smart-form" style="color:white !important">
                                                                            <ul>
                                                                            <li>
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                         <input type="checkbox" name="checkbox-inline" id="chk_geren_seg_ciud_semaforos" onchange="valida_capa('chk_geren_seg_ciud_semaforos')" >
                                                                                            <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                         Mapa de Semaforos
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapsenine-1">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        Património
                                    </a>
                                </h4>
                            </div>
                            <div id="collapsenine-1" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-3">
                                            
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" class="collapsed" href="#collapseOne-sub-aportes_patri"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Aportes
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne-sub-aportes_patri" class="panel-collapse cr_toogle collapse">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                    <ul >

                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_a_aportes_patri" onchange=""/>

                                                                                        <i></i>
                                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Aportes
                                                                                </span>
                                                                            </li>
                                    
                                                                    </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-terr_muni" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Terrenos Municipales 
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-terr_muni" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_terr_muni_patri" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Terrenos Municipales
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseten-1">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        G. Desarr. Económico Local
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseten-1" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-3">
                                            
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" class="collapsed" href="#collapseOne-sub-zonificacion"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Zonificación
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne-sub-zonificacion" class="panel-collapse cr_toogle collapse">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                    <ul >

                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_a_zonificacion" onchange=""/>

                                                                                        <i></i>
                                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Zonificación
                                                                                </span>
                                                                            </li>
                                    
                                                                    </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-usos_desa" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Usos
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-usos_desa" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_usos_desa" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Usos
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-info_urba_admin" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Informacion Urbana Administrativa.
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-info_urba_admin" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_info_urb_admin" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Información
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapseeleven-1">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        G. Desarrollo Social
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseeleven-1" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-3">
                                            
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-3" class="collapsed" href="#collapseOne-sub-colegios"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Colegios
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseOne-sub-colegios" class="panel-collapse cr_toogle collapse">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                    <ul >

                                                                            <li >
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                        <input type="checkbox" name="checkbox-inline" id="chk_a_colegios" onchange=""/>

                                                                                        <i></i>
                                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                                        Colegios
                                                                                </span>
                                                                            </li>
                                    
                                                                    </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-comple_deportivos" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Complejos Deportivos
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-comple_deportivos" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_a_comple_deportivos" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Complejos Deportivos
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-comedores" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Comedores Populares
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-comedores" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_comedores" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Comedores
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-guarderias" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Guarderías wawa wasi
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-guarderias" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_guarderias" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Guarderías
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub-pro_soc" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Sub Ge. Programas Sociales
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub-pro_soc" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        <!--end widget edit box 

                                                            widget content -->
                                                           <div class="widget-body">

                                                               <div class="tree smart-form" style="color:white !important">
                                                                  <ul >
                                                                      
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_sisfoh" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    SISFOH
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_vaso_leche" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Vaso Leche
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        <li>
                                                                            <span style="width: 160px;">
                                                                                <label class="checkbox inline-block" style="color:white !important">
                                                                                    <input type="checkbox" name="checkbox-inline" id="chk_pension_65" onchange="">
                                                                                    <i></i>
                                                                                    <span style="background-color: #EA7D09; width: 5px !important ; height: 5px !important;"></span>
                                                                                    Pensión 65
                                                                                </label> 
                                                                            </span>
                                                                        </li>
                                                                        
                                                                  </ul>
                                                              </div>
                                                           </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                       <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#menu_gerencia_obras_publicas_infraestructura">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        G. Obras Publicas e Inf.
                                    </a>
                                </h4>
                            </div>
                            <div id="menu_gerencia_obras_publicas_infraestructura" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-3">
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#collapseTwo_sub_gerencia_obras_publicas" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Sub Ge. Obras Publicas
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="collapseTwo_sub_gerencia_obras_publicas" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                            <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_obras_publicas"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Modulo de Obras Publicas
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div class="widget-body">
                                                                        <div class="tree smart-form" style="color:white !important">
                                                                            <ul>
                                                                            <li>
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                         <input type="checkbox" name="checkbox-inline" id="chk_map_gopi_obras" onchange="valida_capa('chk_map_gopi_obras')" >
                                                                                            <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                         Mapa de Obras
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#sub_gerencia_estudios_proyectos" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Sub Ge. Estudios y Proyectos
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="sub_gerencia_estudios_proyectos" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                        
                                                            <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_estudios_proyectos?tipo=perfiles"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mod. Perfiles
                                                                            </a>
                                                                        </h4>
                                                                    </div>

                                                                    <div class="widget-body">
                                                                        <div class="tree smart-form" style="color:white !important">
                                                                            <ul>
                                                                            <li>
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                         <input type="checkbox" name="checkbox-inline" id="chk_map_gopi_perfiles" onchange="valida_capa('chk_map_gopi_perfiles')" >
                                                                                            <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                         Mapa de Perfiles
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_estudios_proyectos?tipo=expedientes_tecnicos"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mod. Expedientes Tecnicos
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    
                                                                    <div class="widget-body">
                                                                        <div class="tree smart-form" style="color:white !important">
                                                                            <ul>
                                                                            <li>
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                         <input type="checkbox" name="checkbox-inline" id="chk_map_gopi_expedientes_tecnicos" onchange="valida_capa('chk_map_gopi_expedientes_tecnicos')" >
                                                                                            <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                         Mapa de Expedientes Tecnicos
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                            </div>
                                                            </div>
      
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                            <!--option-->
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title">
                                                        <a data-toggle="collapse" data-parent="#accordion-3" href="#apoyo_matenimiento" class="collapsed"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Apoyo y Mantenimiento
                                                        </a>
                                                    </h4>
                                                </div>
                                                <div id="apoyo_matenimiento" class="panel-collapse collapse cr_toogle">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                                                            <!--end widget edit box widget content -->
                                                            <div class="widget-body no-padding">
                                                            <div class="panel-group smart-accordion-default" id="accordion-3">

                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_apoyo_matenimiento?tipo=apoyo"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mod. Apoyo
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                </div>
                                                                
                                                                <div class="panel panel-default" style="background: transparent">
                                                                    <div class="panel-heading" style=" background:  transparent;color: white;">
                                                                        <h4 class="panel-title"><a href="sub_geren_apoyo_matenimiento?tipo=mantenimiento"> 
                                                                                <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                                                <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                                                Mod. Mantenimiento
                                                                            </a>
                                                                        </h4>
                                                                    </div>
                                                                    
                                                                    <div class="widget-body">
                                                                        <div class="tree smart-form" style="color:white !important">
                                                                            <ul>
                                                                            <li>
                                                                                <span style="width: 160px;">
                                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                                         <input type="checkbox" name="checkbox-inline" id="chk_map_gopi_mantenimientos" onchange="valida_capa('chk_map_gopi_mantenimientos')" >
                                                                                            <i></i>
                                                                                        <span style="background-color: green; width: 5px !important ; height: 5px !important;"></span>
                                                                                         Mapa de Mantenimientos
                                                                                    </label> 
                                                                                </span> 
                                                                            </li>
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                
                                                            </div>
                                                            </div>
                                                        <!--end widget content -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- fin option-->
                                        </div>
                                    </div>
                                    <!-- end widget content -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                        <!--option-->
                        <div class="panel panel-default" style="background:  transparent;">
                            <div class="panel-heading" style="background: #2471A3; color: white">
                                
                                <h4 class="panel-title"><a data-toggle="collapse" data-parent="#accordion-2" href="#collapsetwelve-config">
                                        <i class="fa fa-fw fa-plus-circle txt-color-white"></i> 
                                        <i class="fa fa-fw fa-minus-circle txt-color-white"></i> 
                                        Configuración
                                    </a>
                                </h4>
                    </div>
                            <div id="collapsetwelve-config" class="panel-collapse collapse cr_toogle">
                                <div class="panel-body" style="padding-left: 20px" >
                                    <div>
                                    <!-- widget content -->
                                    <div class="widget-body no-padding">
                                        <div class="panel-group smart-accordion-default" id="accordion-3">
                                            
                                            <div class="panel panel-default" style="background: transparent">
                                                <div class="panel-heading" style=" background:  transparent;color: white;">
                                                    <h4 class="panel-title"><a href="usuarios"> 
                                                            <i class="fa fa-fw fa-plus-circle txt-color-green"></i> 
                                                            <i class="fa fa-fw fa-minus-circle txt-color-red"></i> 
                                                            Usuarios
                                                        </a>
                                                    </h4>
                </div>
                                                <div id="collapseOne-sub-usuarios" class="panel-collapse cr_toogle collapse">
                                                    <div class="panel-body" style="padding-left: 30px" >
                                                        <div>
                                                        <!--widget edit box -->
                                                            <div class="jarviswidget-editbox">
                                                            </div>
                             
                                                        </div>
                                                    
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    </div>
                <!-- end widget content -->
            </div>
                                </div>
                            </div>
                        </div>
                        <!--fin option-->
                    </div>
                </div>
                <!-- end widget content -->
            </div>
        
            <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit" style="color: red;"></i> </span>
        </aside>
        @endif

        <div id="main" role="main" style="padding-bottom: 0px !important; min-height: 0px !important; margin-left: 300px !important">            
            <div id="content">
                @yield('content') 
            </div>
        </div>

        
        <!--************************                  CAMBIAR FOTO USUARIO         *******************************-->        
        <div id="dialog_Cambiar_Foto_Usuario" style="display: none">
            <div class="widget-body">
                <div  class="smart-form">
                    <div class="panel-group">                
                        <div class="panel panel-success" style="border: 0px !important;">
                            <div class="panel-heading bg-color-success">.:: Selecciona Tu Foto ::.</div>
                            <div class="panel-body">
                                <form id="form_cambiar_foto" name="form_cambiar_foto">
                                <div class="text-center col col-12" style="margin-top: 10px;">                            
                                    <img id="vw_usuario_cambiar_foto_img" src="{{asset('img/avatars/male.png')}}" name="vw_usuario_cambiar_foto_img" size="2048" style="width: 233px;height: 230px;border: 1px solid #fff; outline: 1px solid #bfbfbf;margin-bottom: 14px;">
                                    <label class="label">Seleccionar Foto:</label>
                                    <label class="input"> 
                                        <input type="file" id="vw_usuario_cambiar_cargar_foto" name="vw_usuario_cambiar_cargar_foto" accept="image/png, image/jpeg, image/jpg">
                                </div>
                                </form>
                            </div>
                        </div>
                    </div>                 
                </div>        
            </div>
        </div>
        <div id="dialog_Cambiar_password" style="display: none">
            <div class="widget-body">
                <div  class="smart-form">
                    <div class="panel-group">                
                        <div class="panel panel-success" style="border: 0px !important;">
                            <div class="panel-heading bg-color-success">.:: Cambiar Password ::.</div>
                            <div class="panel-body">
                                <section style="margin-top: 10px;">                                    
                                    <label class="label">Nuevo Contraseña:</label>
                                    <label class="input"> 
                                        <input type="password" id="vw_usuario_cam_pass_1"></label>                                    
                                </section>
                                <section>                                    
                                    <label class="label">Confirmar Contraseña:</label>
                                    <label class="input"> 
                                        <input type="password" id="vw_usuario_cam_pass_2"></label>                                   
                                </section>                               
                            </div>
                        </div>
                    </div>                 
                </div>        
            </div>
        </div>
       
        <script src="{{ asset('js/libs/jquery-ui-1.10.3.min.js') }}"></script>
        

        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.js"></script>-->
     
        <script src="{{ asset('archivos_js/global_function.js') }}"></script>
        <script src="{{ asset('js/moment.js') }}"></script>
        <script src="{{ asset('js/app.config.js') }}"></script>
        <script src="{{ asset('js/app.min.js') }}"></script>
        <script src="{{ asset('js/block_ui.js') }}"></script>
        
         <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

        <script src="{{ asset('js/plugin/jqgrid/jquery.jqGrid.min.js') }}"></script>
        <script src="{{ asset('js/plugin/jqgrid/grid.locale-en.min.js') }}"></script>

        <script src="{{ asset('js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

        <script src="{{ asset('js/notification/SmartNotification.min.js')}}"></script>

        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>
        <script src="{{ asset('archivos_js/configuracion.js') }}"></script>

        <script src="{{ asset('js/jquery-confirm.js')}}"></script>

        @if (!Auth::guest()) 

        <script>
            $(document).ready(function () {                
                pageSetUp();
                $.widget("ui.dialog", $.extend({}, $.ui.dialog.prototype, {
                    _title: function (title) {
                        if (!this.options.title) {
                            title.html("&#160;");
                        } else {
                            title.html(this.options.title);
                        }
                    }
                }));
                jconfirm.defaults = {
                    closeIcon: true,
                    type: 'green', 

                };
                $("#alertdialog").dialog({
                        autoOpen: false,modal:true,title: "<div class='widget-header'><h4>.: Mensaje del Sistema :.</h4></div>", buttons: [ { html: '<span class="btn-label"><i class="glyphicon glyphicon-check"></i></span>&nbsp; Aceptar',
                        "class": "btn btn-labeled bg-color-blue txt-color-white", click: function() { $( this ).dialog( "close" );  if(focoglobal!=""){ foco(focoglobal);} focoglobal="";} } ]
                });
                pageSetUp();
                $('.tree > ul').attr('role', 'tree').find('ul').attr('role', 'group');
                $('.tree').find('li:has(ul)').addClass('parent_li').attr('role', 'treeitem').find(' > span').attr('title', 'Collapse this branch').on('click', function(e) {
                        var children = $(this).parent('li.parent_li').find(' > ul > li');
                        if (children.is(':visible')) {
                                children.hide('fast');
                                $(this).attr('title', 'Expand this branch').find(' > i').removeClass().addClass('fa fa-lg fa-plus-circle');
                        } else {
                                children.show('fast');
                                $(this).attr('title', 'Collapse this branch').find(' > i').removeClass().addClass('fa fa-lg fa-minus-circle');
                        }
                        e.stopPropagation();
                });
            });                       
        </script>
        @endif

        @yield('page-js-script')


    </body>
</html>
