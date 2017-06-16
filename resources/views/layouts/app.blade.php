<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Maynsa</title>
        <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">

        <link href="{{ asset('css/smartadmin-production-plugins.min.css') }}" rel="stylesheet" type="text/css" media="screen">
        <link href="{{ asset('css/smartadmin-production.min.css') }}" rel="stylesheet">
        <link href="{{ asset('css/smartadmin-skins.min.css') }}" rel="stylesheet">

        <link rel="shortcut icon" href="{{ asset('img/favicon/favi.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('img/favicon/favi.ico') }}" type="image/x-icon">

        <link rel="shortcut icon" href="img/favicon/favi.ico" type="image/x-icon">
        <link rel="icon" href="img/favicon/favi.ico" type="image/x-icon">

        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

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
                    <span> <a href="javascript:void(0);" data-action="toggleMenu" title="Colapsar Menu"><i class="fa fa-reorder"></i></a> </span>
                </div> 
                <div id="logout" class="btn-header transparent pull-right">
                    <span> <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" title="Salir" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> 
                        <form id="logout-form" action="{{ route('logout') }}" method="GET" style="display: none;">
                            {{ csrf_field() }}
                        </form>
                    </span>
                </div>     
                <ul class="header-dropdown-list">
                    <li class="">
                        <a href="#" class="dropdown-toggle userdropdown pull-right" data-toggle="dropdown" style="margin-top: 8px;font-weight:bold;text-transform: uppercase"> 
                            <img src="img/avatars/sunny.png" style="width: 35px;border: 1px solid #fff; outline: 1px solid #bfbfbf;">
                            <span> {{ Auth::user()->usuario }} </span> <i class="fa fa-angle-down"></i> 
                        </a>
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Cambiar Password</a>
                            </li>
                            <div class="divider"></div>
                            <li>
                                <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
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
        <aside id="left-panel" style="background: #4caf50 !important">        
            <div class="login-info">
                <span> <!-- User image size is adjusted inside CSS, it should stay as is --> 
                    <a href="javascript:void(0);" id="show-shortcut" data-action="toggleShortcut">
                        <img src="img/avatars/sunny.png" alt="me" class="online" /> 
                        <span>
                            {{ Auth::user()->usuario }}
                        </span>
                        <i class="fa fa-angle-down"></i>
                    </a> 
                </span>
            </div>
            <nav >
                <ul>
                    <li class="">
                        <a href="#" title="Configuracion del Sistema"><i class="fa fa-lg fa-fw fa-cogs"></i> <span class="menu-item-parent">Configuracion</span></a>
                        <ul id="menu_configuracion">
                            <li id="li_config_uit">
                                <a href="{{ route('uit') }}" title="Dashboard"><i class="fa fa-gear"></i>UIT</a>
                            </li>
                            <li id="li_config_val_ara">
                                <a href="{{route('val_aran')}}" title="Dashboard"><i class="fa fa-picture-o"></i> Valores Arancelarios</a>
                            </li>
                            <li class="">
                                <a href="skins.html" title="Dashboard"><i class="fa fa-picture-o"></i> Depreciacion</a>
                            </li>
                            <li id="li_config_val_unit">
                                <a href="{{route('valores_unitarios')}}" title="Valores Unitario"><i class="fa fa-cube"></i>Valores Unitario</a>
                            </li>
                            <li id="li_config_oficinas">
                                <a href="{{ route('oficinas') }}" title="Oficinas"><i class="fa fa-cube"></i>Oficinas</a>
                            </li>
                            <li>
                                <a href="#" title="Configuracion del IPM."><i class="fa fa-cube"></i>Config. IPM</a>
                            </li>
                            <li class="">
                                <a href="{{ route('usuarios') }}" title="Usuarios"><i class="fa fa-cube"></i>Usuarios</a>
                            </li>                        
                            <li>
                                <a href="#" title="Usos Predio"><i class="fa fa-cube"></i>Usos Predio</a>
                            </li>
                            <li>
                                <a href="#" title="Naturaleza del Contrato"><i class="fa fa-cube"></i>Nat. del Contrato</a>
                            </li>
                            <li>
                                <a href="#" title="Documento de Transferencia"><i class="fa fa-cube"></i>Doc. Transferencia</a>
                            </li>
                        </ul>
                    </li>
                    <li class="">
                        <a href="#" title="Administracion Tributaria"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Adm. Tributaria.</span></a>
                        <ul id="menu_admtri">
                            <li id="li_config_contribuyentes">
                                <a href='{{ route('adm_contribuyentes') }}' title="Contribuyentes"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Contribuyentes</span></a>                            
                            </li>
                            <li id="li_preurb">
                                <a href="predios_urbanos" title="Predios Urbanos"><i class="fa fa-lg fa-fw fa-table"></i> <span class="menu-item-parent">Pred. Urbanos</span></a>
                            </li>
                            <li class="">
                                <a href='#' title="Predios Rusticos"><i class="fa fa-lg fa-fw fa-user"></i> <span class="menu-item-parent">Pred. Rusticos</span></a>                            
                            </li>
                            <li class="">
                                <a href="#" title="Impresion de Formatos"><i class="fa fa-lg fa-fw fa-table"></i> <span class="menu-item-parent">Imp. Formatos</span></a>
                            </li>
                        </ul>	
                    </li>
                    <li class="">
                        <a href="#"><i class="fa fa-lg fa-fw fa-cube"></i> <span class="menu-item-parent">Tesoreria</span></a>
                        <ul id="menu_tesoreria">
                            <li id="li_tesoreria_emi_rec_pag">
                                <a href="layouts.html" title="Emision de Recibos de Pago"><i class="fa fa-gear"></i> <span class="menu-item-parent">Emision de Recibos</span></a>
                            </li>
                            <li class="">
                                <a href="skins.html" title="Dashboard"><i class="fa fa-lg fa-fw fa-picture-o"></i> <span class="menu-item-parent">Prebuilt Skins</span></a>
                            </li>
                            <li>
                                <a href="applayout.html"><i class="fa fa-cube"></i> App Settings</a>
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

        <div class="page-footer">
            <div class="row">
                <div class="col-xs-12 col-sm-6">
                    <span class="txt-color-white">Maynsa<span class="hidden-xs"> Sistema Web</span> © Arequipa-2017</span>
                </div>
            </div>            
        </div>

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>
                        if (!window.jQuery) {
                            document.write('<script src="js/libs/jquery-2.1.1.min.js"><\/script>');
                        }
        </script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
        <script>
                        if (!window.jQuery.ui) {
                            document.write('<script src="/js/libs/jquery-ui-1.10.3.min.js"><\/script>');
                        }
        </script>

        <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.2.0/jquery-confirm.min.js"></script>-->

        <script src="{{ asset('archivos_js/global_function.js') }}"></script>

        <script src="{{ asset('js/app.config.js') }}"></script>
        <script src="{{ asset('js/app.min.js') }}"></script>
        <script src="{{ asset('js/block_ui.js') }}"></script>

        <script src="{{ asset('js/bootstrap/bootstrap.min.js') }}"></script>

        <script src="{{ asset('js/plugin/jqgrid/jquery.jqGrid.min.js') }}"></script>
        <script src="{{ asset('js/plugin/jqgrid/grid.locale-en.min.js') }}"></script>

        <script src="{{ asset('js/plugin/masked-input/jquery.maskedinput.min.js') }}"></script>

        <script src="{{ asset('js/notification/SmartNotification.min.js')}}"></script>
        
        <script src="{{ asset('js/jquery-confirm.js')}}"></script>

        <script src="js/plugin/jquery-touch/jquery.ui.touch-punch.min.js"></script> 

        <script data-pace-options='{ "restartOnRequestAfter": true }' src="js/plugin/pace/pace.min.js"></script>

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
