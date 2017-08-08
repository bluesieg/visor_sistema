@extends('layouts.app')

@section('content')

<section id="widget-grid" class="">
    <div class="jarviswidget" id="wid-id-7" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false" role="widget">
       
        <header role="heading"><div class="jarviswidget-ctrls" role="menu">    </div>
            <h2>ContactForm </h2>
            <span class="jarviswidget-loader"><i class="fa fa-refresh fa-spin"></i></span></header>
        <div role="content">            
            <div class="jarviswidget-editbox">                
                <input class="form-control" type="text">
            </div>            
            <div class="widget-body">
                <form id="contactForm" method="post" class="form-horizontal bv-form" novalidate="novalidate"><button type="submit" class="bv-hidden-submit" style="display: none; width: 0px; height: 0px;"></button>

                    <fieldset>
                        <legend>Showing messages in custom area</legend>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Full name</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="fullName" data-bv-field="fullName"><i class="form-control-feedback" data-bv-icon-for="fullName" style="display: none;"></i>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Email</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="email" data-bv-field="email"><i class="form-control-feedback" data-bv-icon-for="email" style="display: none;"></i>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Title</label>
                            <div class="col-md-6">
                                <input type="text" class="form-control" name="title" data-bv-field="title"><i class="form-control-feedback" data-bv-icon-for="title" style="display: none;"></i>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <div class="form-group has-feedback">
                            <label class="col-md-3 control-label">Content</label>
                            <div class="col-md-6">
                                <textarea class="form-control" name="content" rows="5" data-bv-field="content"></textarea><i class="form-control-feedback" data-bv-icon-for="content" style="display: none;"></i>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>                        
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <div id="messages" class="has-error"><small class="help-block" data-bv-validator="notEmpty" data-bv-for="fullName" data-bv-result="NOT_VALIDATED" style="display: none;">The full name is required and cannot be empty</small><small class="help-block" data-bv-validator="notEmpty" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">The email address is required and cannot be empty</small><small class="help-block" data-bv-validator="emailAddress" data-bv-for="email" data-bv-result="NOT_VALIDATED" style="display: none;">The email address is not valid</small><small class="help-block" data-bv-validator="notEmpty" data-bv-for="title" data-bv-result="NOT_VALIDATED" style="display: none;">The title is required and cannot be empty</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="title" data-bv-result="NOT_VALIDATED" style="display: none;">The title must be less than 100 characters long</small><small class="help-block" data-bv-validator="notEmpty" data-bv-for="content" data-bv-result="NOT_VALIDATED" style="display: none;">The content is required and cannot be empty</small><small class="help-block" data-bv-validator="stringLength" data-bv-for="content" data-bv-result="NOT_VALIDATED" style="display: none;">The content must be less than 500 characters long</small></div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="form-actions">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-default" type="submit">
                                    <i class="fa fa-eye"></i>
                                    Validate
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--    <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -15px">
                <div class="well well-sm well-light">
                    <h1 class="txt-color-green"><b>Configuracion Convenio de Fraccionamiento...</b></h1>
                    <div class="row">
                        <div class="col-xs-12">
                            <section>
                                <section class="col col-4">
                                    <label class="label">Cod. Via:</label>
                                    <label class="input">
                                        <input id="val_arancel_cod_via" onkeypress="return soloDNI(event);" type="text" placeholder="000000" class="input-sm">
                                    </label>                        
                                </section>
                            </section>
                            
                            <div class="text-right">
                                <button onclick="" id="btn_vw_oficinas_Nuevo" type="button" class="btn btn-labeled bg-color-greenLight txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>Guardar
                                </button> 
                                <button id="btn_vw_oficinas_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Editar
                                </button>                            
                            </div>
                        </div>                        
                    </div>
                </div>                   
            </div>
        </div>-->
</section>

@section('page-js-script')
<script type="text/javascript">
    global = 0;
    $(document).ready(function () {
        $("#menu_configuracion").show();
        $("#li_config_fraccionamiento").addClass('cr-active');


    });
</script>
@stop
<script src="{{ asset('archivos_js/configuracion/uit.js') }}"></script>
@endsection

