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

        <link href="{{ asset('css/smartadmin-production-plugins.min.css') }}" rel="stylesheet" type="text/css" media="screen">
        <link href="{{ asset('css/smartadmin-production.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/smartadmin-skins.min.css') }}" rel="stylesheet">

		<link rel="stylesheet" href="{{ asset('layers/ol.css')}}" />
		<script src="{{ asset('layers/ol.js')}}"></script>
        <script src="{{ asset('js/libs/jquery-2.1.1.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('layers/ol3-layerswitcher.css')}}">
        <script  src="{{ asset('layers/ol3-layerswitcher.js')}}"></script>

        <link rel="shortcut icon" href="{{ asset('img/favicon/favi.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('img/favicon/favi.ico') }}" type="image/x-icon">

        <link rel="shortcut icon" href="img/favicon/favi.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon/favi.ico" type="image/x-icon">

        <!--<link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">-->

        <link rel="apple-touch-icon" href="{{ asset('img/splash/sptouch-icon-iphone.png') }}">
        <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/splash/touch-icon-ipad.png') }}">
        <link rel="apple-touch-icon" sizes="120x120" href="{{ asset('img/splash/touch-icon-iphone-retina.png') }}">
        <link rel="apple-touch-icon" sizes="152x152" href="{{ asset('img/splash/touch-icon-ipad-retina.png') }}">

        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link rel="apple-touch-startup-image" href="{{ asset('img/splash/ipad-landscape.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="{{ asset('img/splash/ipad-portrait.png') }}" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="{{ asset('img/splash/iphone.png') }}" media="screen and (max-device-width: 320px)">

        <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.css">-->

        <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
        <link href="{{ asset('css/jquery-confirm.css') }}" rel="stylesheet">
        


    </head>
    <body class="desktop-detected pace-done fixed-header fixed-navigation">
        <header id="header">
            <div id="logo-group">                
                <span id="logo"> <img src="img/logo_cc_2.png" alt="SmartAdmin"> </span> 

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
                        <a href="#" class="dropdown-toggle userdropdown pull-right" data-toggle="dropdown" style="margin-top: 8px;font-weight:bold;text-transform: uppercase"> 
                            @if (Auth::user()->foto)
                                <img src="data:image/png;base64,{{ Auth::user()->foto }}" style="width: 35px; height: 35px;border: 1px solid #fff; outline: 1px solid #bfbfbf;">                           
                            @else
                                <img src="{{asset('img/avatars/male.png')}}" style="width: 35px; height: 35px;border: 1px solid #fff; outline: 1px solid #bfbfbf;">                           
                            @endif
                            <span style="color: black">BIENVENIDO, {{ Auth::user()->ape_nom }} </span> <i class="fa fa-angle-down" style="color: black"></i> 
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
        <aside id="left-panel" style="background: #41BE82 !important">        
            <div class="login-info" style="background: #37A26F;border-bottom: 3px solid #f2f2f2;">
                <span> <!-- User image size is adjusted inside CSS, it should stay as is --> 
                    <a>
                        @if (Auth::user()->foto)
                            <img src="data:image/png;base64,{{ Auth::user()->foto }}" alt="me" style="width: 22px; height: 25px;" class="online"/> 
                        @else
                            <img src="{{asset('img/avatars/male.png')}}" alt="me" style="width: 22px; height: 25px;" class="online"/> 
                        @endif
                        
                        <span style="color: white;">
                            Usuario:{{ Auth::user()->usuario }}
                        </span>
                        <!--<i class="fa fa-angle-down" style="color: white;"></i>-->
                    </a> 
                </span>
            </div>
            <nav >
                <ul>
                    <li class="">
                        <a href="#" title="Configuracion del Sistema"><i class="fa fa-lg fa-fw fa-cog fa-gears"></i> <span class="menu-item-parent">Configuracion</span></a>
                        <ul id="menu_configuracion">
                            <li id="li_config_uit">
                                <a href="{{ route('uit') }}" title="Dashboard"><i class="fa fa-money"></i>UIT</a>
                            </li>
                            <li id="li_config_val_ara">
                                <a href="{{route('val_aran')}}" title="Dashboard"><i class="fa fa-dollar"></i>Valores Arancelarios</a>
                            </li>
                            <li class="">
                                <a href="skins.html" title="Dashboard"><i class="fa fa-sort-amount-desc"></i>Depreciacion</a>
                            </li>
                            <li id="li_config_val_unit">
                                <a href="{{route('valores_unitarios')}}" title="Valores Unitario"><i class="fa fa-dollar"></i>Valores Unitarios</a>
                            </li>
                            <li id="li_config_oficinas">
                                <a href="{{ route('oficinas') }}" title="Oficinas"><i class="fa fa-laptop"></i>Oficinas</a>
                            </li>
                            <li>
                                <a href="#" title="Configuracion del IPM."><i class="fa fa-cogs"></i>Config. IPM</a>
                            </li>
                            <li id="li_config_fraccionamiento">
                                <a href="config_fraccionamiento" title="Configuracion Convenio de Fraccionamiento"><i class="fa fa-cogs"></i>Fraccionamiento</a>
                            </li>
                            <li id="li_config_usuarios">
                                <a href="{{ route('usuarios') }}" title="Usuarios"><i class="fa fa-group"></i>Usuarios</a>
                            </li>                        
                            <li>
                                <a href="#" title="Usos Predio"><i class="fa fa-home"></i>Usos Predio</a>
                            </li>
                            <li>
                                <a href="#" title="Naturaleza del Contrato"><i class="fa fa-cube"></i>Nat. del Contrato</a>
                            </li>
                            <li>
                                <a href="#" title="Documento de Transferencia"><i class="fa fa-file-text"></i>Doc. Transferencia</a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#" title="Presupuesto"><i class="fa fa-lg fa-fw fa-briefcase"></i> <span class="menu-item-parent">Presupuesto.</span></a>
                        <ul id="menu_presupuesto">
                            <li id="li_pres_gen">
                                <a href='generica' title="Generica"><i class="fa fa-lg fa-fw fa-group"></i> <span class="menu-item-parent">Generica</span></a>                            
                            </li>
                            <li id="li_pres_subgen">
                                <a href="sub_generica" title="Sub Generica"><i class="glyphicon glyphicon-lg glyphicon-fw glyphicon-home"></i> <span class="menu-item-parent">Sub Generica</span></a>
                            </li>
                            <li id="li_pres_subgendeta">
                                <a href="sub_gen_detalle" title="Sub Generica Detalle"><i class="glyphicon glyphicon-lg glyphicon-fw glyphicon-home"></i> <span class="menu-item-parent">Sub Generica Detalle</span></a>
                            </li>
                            <li id="li_pres_especi">
                                <a href='especifica' title="Especifica"><i class="glyphicon glyphicon-lg glyphicon-fw glyphicon-tree-deciduous"></i> <span class="menu-item-parent">Especifica</span></a>                            
                            </li>
                            <li id="li_pres_especideta">
                                <a href="especifica_detalle" title="Especifica Detalle"><i class="fa fa-lg fa-fw fa-print"></i> <span class="menu-item-parent">Especifica Detalle</span></a>
                            </li>
                            <li id="li_pres_proced">
                                <a href="procedimientos" title="Procedimientos"><i class="fa fa-lg fa-fw fa-print"></i> <span class="menu-item-parent">Procedimientos</span></a>
                            </li>
                        </ul>	
                    </li>
                    <li class="">
                        <a href="#" title="Administracion Tributaria"><i class="fa fa-lg fa-fw fa-briefcase"></i> <span class="menu-item-parent">Adm. Tributaria.</span></a>
                        <ul id="menu_admtri">
                            <li id="li_config_contribuyentes">
                                <a href='contribuyentes' title="Contribuyentes"><i class="fa fa-lg fa-fw fa-group"></i> <span class="menu-item-parent">Contribuyentes</span></a>                            
                            </li>
                            <li id="li_preurb">
                                <a href="predios_urbanos" title="Predios Urbanos"><i class="glyphicon glyphicon-lg glyphicon-fw glyphicon-home"></i> <span class="menu-item-parent">Pred. Urbanos</span></a>
                            </li>
                            <li id="li_arbmun">
                                <a href="arbitrios_municipales" title="Arbítrios Municipales"><i class="glyphicon glyphicon-lg glyphicon-fw glyphicon-home"></i> <span class="menu-item-parent">Arbítrios Muni.</span></a>
                            </li>
                            <li class="">
                                <a href='predios_rural' title="Predios Rusticos"><i class="glyphicon glyphicon-lg glyphicon-fw glyphicon-tree-deciduous"></i> <span class="menu-item-parent">Pred. Rusticos</span></a>                            
                            </li>
                            <li id="li_impform">
                                <a href="adm_impform" title="Impresion de Formatos"><i class="fa fa-lg fa-fw fa-print"></i> <span class="menu-item-parent">Imp. Formatos</span></a>
                            </li>
                            <li id="li_env_doc_a_coac">
                                <a href="envio_doc_coactiva" title="Envio de OP a Coactiva"><i class="fa fa-lg fa-fw fa-print"></i> <span class="menu-item-parent">Envio OP Coactiva</span></a>
                            </li>
                        </ul>	
                    </li>
                    <li class="">
                        <a href="#" title="Ventanilla"><i class="fa fa-lg fa-fw fa-institution"></i> <span class="menu-item-parent">Ventanilla</span></a>
                        <ul id="menu_ventanilla">
                            <li id="li_tesoreria_emi_rec_pag">
                                <a href="emi_recibo_master" title="Emision de Recibos de Pago"><i class="fa fa-lg fa-fw fa-file-text"></i> <span class="menu-item-parent">Emision de Recibos</span></a>
                            </li>
                            <li id="li_vent_est_cta">
                                <a href="estado_de_cta" title="Estado de Cuentas"><i class="fa fa-lg fa-exchange"></i> <span class="menu-item-parent">Estado de Cuentas</span></a>
                            </li>                            
                            <li id="li_vent_est_cta_fracc">
                                <a href="est_cta_fracc" title="Estado de Cuenta de Fraccinamiento"><i class="fa fa-lg fa-exchange"></i> <span class="menu-item-parent">Consulta Fraccionam.</span></a>
                            </li>
                        </ul>	
                    </li>
                    <li class="">
                        <a href="#" title="Recaudación"><i class="fa fa-lg fa-fw fa-institution"></i> <span class="menu-item-parent">Recaudación</span></a>
                        <ul id="menu_recaudacion">
                            <li id="li_reca_op">
                                <a href='ordenpago' title="Orden de Pago(OP)"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Generar O.P.</span></a>                            
                            </li>
                        </ul>	
                    </li> 
                    <li class="">
                        <a href="#" title="Fiscalización"><i class="fa fa-lg fa-fw fa-institution"></i> <span class="menu-item-parent">Fiscalización</span></a>
                        <ul id="menu_fisca">
                            <li id="li_fisca_carta">
                                <a href='carta_reque' title="Carta de Requerimiento"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Carta Requerimiento</span></a>                            
                            </li>
                            <li id="li_ficha_ver">
                                <a href='ficha_veri' title="Ingresar Ficha Verificación"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Ing. Ficha Verificación</span></a>                            
                            </li>
                            <li id="li_hoja_liq">
                                <a href='hoja_liquidacion' title="Crear Hoja de Liquidación"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Hoja de Liquidación</span></a>                            
                            </li>
                            <li id="li_reso_deter">
                                <a href='reso_deter' title="Crear Resolución de Determinación"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Generar R.D.</span></a>                            
                            </li>
                            <li id="li_env_rd_a_coac">
                                <a href='env_rd_coactiva' title="Enviar RD a Coactiva"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Envio RD a Coactiva</span></a>                            
                            </li>
                        </ul>	
                    </li> 
                    <li class="">
                        <a href="#" title="Alcabala"><i class="fa fa-lg fa-fw fa-suitcase"></i> <span class="menu-item-parent">Alcabala</span></a>
                        <ul id="menu_alcabala">
                            <li id="li_alcala_conf">
                                <a href='alcabala_conf' title="Configuración"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Confi. Parametros</span></a>                            
                            </li>
                            <li id="li_alca_manten_doc">
                                <a href='alca_manten_doc' title="Matenimiento de Documentos"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Manten. Documentos</span></a>                            
                            </li>
                            <li id="li_alcabala">
                                <a href='alcabala' title="Alcabala"><i class="fa fa-file-text-o"></i> <span class="menu-item-parent">Registro Alcabala</span></a>                            
                            </li>
                        </ul>	
                    </li>
                    <li class="">
                        <a href="#" title="Cobranza Coactiva"><i class="fa fa-lg fa-fw fa-rebel"></i> <span class="menu-item-parent">Coactiva</span></a>
                        <ul id="menu_coactiva">                            
                            <li id="li_gesion_exped">
                                <a href="gestion_expedientes" title="Gestion de Expedientes"><i class="fa fa-lg fa-fw fa-gavel"></i> <span class="menu-item-parent">Gestion Expediente</span></a>
                            </li>
                            <li id="li_emision_rec">
                                <a href="emision_rec" title="Apertura de Ejecucion Coactiva"><i class="fa fa-lg fa-fw fa-gavel"></i> <span class="menu-item-parent">Emision REC</span></a>
                            </li>
                            <li id="li_recep_doc">
                                <a href="recepcion_doc" title="Recepcion de Documentos"><i class="fa fa-lg fa-fw fa-gavel"></i> <span class="menu-item-parent">Recepcion Doc.</span></a>
                            </li>
                        </ul>	
                    </li>
                    <li class="">
                        <a href="#" title="Fraccionamiento"><i class="fa fa-lg fa-fw fa-suitcase"></i> <span class="menu-item-parent">Fraccionamento</span></a>
                        <ul id="menu_fracc">                            
                            <li id="li_fraccionamiento">
                                <a href="conve_fraccionamiento" title="Fraccionamiento"><i class="fa fa-lg fa-fw fa-outdent"></i> <span class="menu-item-parent">Fraccionamiento</span></a>
                            </li>
                        </ul>	
                    </li>
                    <li class="">
                        <a href="#"><i class="fa fa fa-lg fa-fw fa-fax"></i> <span class="menu-item-parent">Tesoreria</span></a>
                        <ul id="menu_tesoreria">                            
                            <li class="">
                                <a href="#" title="Generar Recibos"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Generar Recibos</span></a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#"><i class="fa fa-lg fa-fw fa-usd"></i> <span class="menu-item-parent">Caja</span></a>
                        <ul id="menu_caja">
                            <li id="li_menu_caja_movimientos">
                                <a href="caja_movimient" title="Movimientos"><i class="fa fa-lg fa-exchange"></i> <span class="menu-item-parent">Movimientos</span></a>
                            </li>                                                        
                        </ul>
                    </li>
                    <li class="">
                        <a href="#" title="Configuracion Catastro"><i class="fa fa-lg fa-fw fa-cog fa-spin"></i> <span class="menu-item-parent">Configuracion Catastro</span></a>
                        <ul id="menu_configuracion_catastro">
                            <li id="conf_cat_sect">
                                <a href="catastro_sectores" title="Dashboard"><i class="fa fa-map-marker"></i> Sectores catastrales</a>
                            </li>
                            <li id="conf_cat_mzna">
                                <a href="catastro_mzns" title="Dashboard"><i class="fa fa-building"></i> Manzanas catastrales</a>
                            </li>
                            <li id="conf_aran_rust">
                                <a href="catastro_aran_rust" title="Dashboard"><i class="fa fa-building"></i> Aranceles Rusticos</a>
                            </li>
                        </ul>
                    </li>

                    <li class="">
                        <a href="#" title="Reportes"><i class="fa fa-lg fa-fw fa-bar-chart-o"></i> <span class="menu-item-parent">Reportes</span></a>
                        <ul id="menu_reportes">
                            <li id="li_ver_reportes">
                                <a href="reportes" title="Ver Cartografia"><i class="fa fa-lg fa-fw fa-file-text"></i> <span class="menu-item-parent">Reportes generales</span></a>
                            </li>

                        </ul>
                    </li>
                    <li class="">
                        <a href="#" title="Cartografia Base"><i class="fa fa-lg fa-fw fa-map-marker"></i> <span class="menu-item-parent">Cartografia Base</span></a>
                        <ul id="menu_cart_base">
                            <li id="li_ver_cart">
                                <a href="cartografia" title="Ver Cartografia"><i class="fa fa-lg fa-fw fa-print"></i> <span class="menu-item-parent">Cartografia</span></a>
                            </li>
                        
                        </ul>
                    </li>
                    
                </ul>
            </nav>
            <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit"></i> </span>
        </aside>
        @endif

        <div id="main" role="main">            
            <div id="content">
                @yield('content') 
            </div>
        </div>

        <div class="page-footer" style="background: #01A858;">
            <div class="row">
                <div class="col-xs-12 col-sm-12">
                    <span class="txt-color-white">Municipalidad Distrital de Cerro Colorado © Arequipa - Perú &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><a href="http://www.mdcc.gob.pe" target="blank"style="color: white">www.municerrocolorado.gob.pe</a>
                </div>
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
        
        <script src="{{ asset('js/jquery-confirm.js')}}"></script>
        <script src="{{ asset('js/pdf/jspdf.debug.js') }}"></script>
        <script src="{{ asset('js/pdf/html2pdf.js') }}"></script>
        <script src="{{ asset('archivos_js/configuracion.js') }}"></script>
        
        
        <script src="{{ asset('js/plugin/ckeditor/ckeditor.js') }}"></script>
        <!--<script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script>--> 

        <!--<script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>-->

        @if (!Auth::guest()) 
<!--        <input type="hidden" id="usuario_id" value="{{ Auth::user()->id }}" >
        <input type="hidden" id="usuario" value="{{ Auth::user()->ape_nom }}" >-->
        <!--<input type="hidden" id="_token" name="_token" value="{{ csrf_token() }}">-->

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
            });                       
        </script>
        @endif

        @yield('page-js-script')

<!--        <script type="text/javascript">
            var _gaq = _gaq || [];
            _gaq.push(['_setAccount', 'UA-XXXXXXXX-X']);
            _gaq.push(['_trackPageview']);
            (function () {
                var ga = document.createElement('script');
                ga.type = 'text/javascript';
                ga.async = true;
                ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
                var s = document.getElementsByTagName('script')[0];
                s.parentNode.insertBefore(ga, s);
            })();
        </script>-->
    </body>
</html>
