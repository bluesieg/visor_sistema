@extends('layouts.planeamiento_hab_urb')
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
                    <h1 class="txt-color-green" style="padding-left: 350px; padding-top: 80px;"><b>.:: CONSULTA EXPEDIENTES ::.</b></h1>
                    <div class="row">
                        <div class="col-xs-8" style="padding-left:350px;">
                            <div class="input-group input-group-md">
                                <span class="input-group-addon">Expediente. &nbsp;<i class="fa fa-male"></i></span>
                                <div>
                                    <input id="dlg_expediente" type="text"  class="form-control input-sm text-uppercase" style="height: 32px;font-size: 1.2em;width: 102% !important" autofocus="focus" placeholder="NUMERO DE EXPEDIENTE">
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-4">
                            <div class="text-left">
                                    <button type="button" class="btn btn-labeled bg-color-greenLight txt-color-white" onclick="fn_buscar_expediente();">
                                        <span class="btn-label"><i class="glyphicon glyphicon-plus-sign"></i></span>BUSCAR
                                    </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>            
        </div>       
    </div>
</section>
@section('page-js-script')
<script type="text/javascript">

        $("#dlg_expediente").keypress(function (e) {
            if (e.which == 13) {

                   fn_buscar_expediente();

            }
        });
        
        function fn_buscar_expediente(){
            
            num_expediente = $('#dlg_expediente').val();
            
            MensajeDialogLoadAjax('dlg_expediente', '.:: Cargando ...');
            $.ajax({url: 'buscar_expediente',
                type: 'GET',
                data:{num_expediente:num_expediente},
                success: function(data) 
                {
                    if (data.msg === 'si'){
                        MensajeDialogLoadAjaxFinish('dlg_expediente');
                        mostraralertasconfoco("El Numero de Expediente: "+data.nro_expediente+", se encuentra en Fase: "+data.descrip_fase+".");
                    }
                    else
                    {
                        MensajeDialogLoadAjaxFinish('dlg_expediente');
                        mostraralertasconfoco("El Numero de Expediente no Existe");
                    }
                },
                error: function(data) {
                    mostraralertas("hubo un error, Comunicar al Administrador");
                    MensajeDialogLoadAjaxFinish('dlg_expediente');
                    console.log('error');
                    console.log(data);
                }
            });
        }
</script>

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

@endsection

