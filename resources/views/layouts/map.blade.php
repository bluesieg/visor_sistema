<!DOCTYPE html>
<html lang="en">
    <head>        
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>MDCC</title>
       

		<link rel="stylesheet" href="{{ asset('layers/ol.css')}}" />
		<script src="{{ asset('layers/ol.js')}}"></script>
        <script src="{{ asset('js/libs/jquery-2.1.1.min.js') }}"></script>
        <link rel="stylesheet" href="{{ asset('layers/ol3-layerswitcher.css')}}">
        <script  src="{{ asset('layers/ol3-layerswitcher.js')}}"></script>


        <link href="{{ asset('css/estilo.css') }}" rel="stylesheet">
<!-- Basic Styles -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/font-awesome.min.css">

		<!-- SmartAdmin Styles : Caution! DO NOT change the order -->
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production-plugins.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-production.min.css">
		<link rel="stylesheet" type="text/css" media="screen" href="css/smartadmin-skins.min.css">
        


    </head>
    <body class="desktop-detected pace-done fixed-header fixed-navigation" style="background: white !important">
        <header id="header" style="background: #B40411 !important;">
            <div id="logo-group">                
                <span id="logo"> <img src="img/logo-white.png" alt="SmartAdmin"> </span> 

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
        <aside id="left-panel" style="background: #231918 !important; border-right: 2px #bfbfbf dashed">        
            <div class="login-info" style="background: #B40411;border-bottom: 3px solid #f2f2f2;">
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
               <div>
				
                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="tree smart-form" style="color:white !important">
                                    <ul>
                                            <li>
                                                    <span><i class="fa fa-lg fa-folder-open"></i> Capas</span>
                                                    <ul >
                                                          
                                                            <li >
                                                                <span style="width: 130px;">
                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                        <input type="checkbox" name="checkbox-inline" checked="checked" id="chk_limite" onchange="valida_capa('chk_limite')"/>

                                                                        <i></i>
                                                                        <span style="background-color: #ffff00; width: 5px !important ; height: 5px !important;"></span>
                                                                        Limites
                                                                </span>
                                                            </li>
                                                            <li >
                                                                <span style="width: 130px;">
                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                        <input type="checkbox" name="checkbox-inline" id="chk_sector" onchange="valida_capa('chk_sector')">
                                                                        <i></i>
                                                                        <span style="background-color: #6666ff; width: 5px !important ; height: 5px !important;"></span>
                                                                        Sector
                                                                    </label> 
                                                                </span>
                                                            </li>
                                                            <li >
                                                                <span style="width: 130px;">
                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                        <input type="checkbox" name="checkbox-inline" id="chk_mzna" onchange="valida_capa('chk_mzna')">
                                                                        <i></i>
                                                                        <span style="background-color: #009900; width: 5px !important ; height: 5px !important;"></span>
                                                                        Manzana
                                                                    </label> 
                                                                </span>
                                                            </li>
                                                            
                                                            <li >
                                                                <span style="width: 130px;">
                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                        <input type="checkbox" name="checkbox-inline" id="chk_lote" onchange="valida_capa('chk_lote')">
                                                                        <i></i>
                                                                        <span style="background-color: #C70039; width: 5px !important ; height: 5px !important;"></span>
                                                                        Lotes
                                                                    </label> 
                                                                </span>
                                                            </li>
                                                            <li >
                                                                <span style="width: 130px;">
                                                                    <label class="checkbox inline-block" style="color:white !important">
                                                                        <input type="checkbox" name="checkbox-inline" id="chk_hab_urb" onchange="valida_capa('chk_hab_urb')">
                                                                        <i></i>
                                                                        <span style="background-color: #B40477; width: 5px !important ; height: 5px !important;"></span>
                                                                        Hab. Urbanas
                                                                    </label> 
                                                                </span>
                                                            </li>
                                                            
                                                    </ul>
                                            </li>

                                    </ul>
                                           
                            </div>

                    </div>
                    <!-- end widget content -->

            </div>
            <span class="minifyme" data-action="minifyMenu"> <i class="fa fa-arrow-circle-left hit" style="color: red;"></i> </span>
        </aside>
        @endif

        <div id="main" role="main" style="padding-bottom: 0px !important; min-height: 0px !important;">            
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
