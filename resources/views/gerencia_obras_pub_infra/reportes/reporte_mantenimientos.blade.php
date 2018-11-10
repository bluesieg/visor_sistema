<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>REPORTE DE MANTENIMIENTOS</title>
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
    <style>
        .move-ahead { counter-increment: page 2; position: absolute; visibility: hidden; }
        .pagenum:after { content:' ' counter(page); }
       .footer {position: fixed }

    </style>
</head>
    <footer class="footer" style="font-size:0.8em; text-align: left; padding-top: 5px; padding-left: 10px;"><b> </b></footer>

<body>
    <main>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px;">
            <tr>
            <td style="width: 10%; border: 0px;" >
                <img src="img/escudo.png" height="70px"/>
            </td>
            <td style="width: 80%; padding-top: 10px; border:0px;">
                <div id="details" class="clearfix">
                  <div id="invoice" >
                      <h1>MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</h1>
                      <div class="sub2">Creado por Ley 12075 el día 26 de Febrero de 1954</div>
                  </div>
                    <div style="width: 90%; border-top:1px solid #999; margin-top: 10px; margin-left: 25px;"></div>
                </div>
            </td>
            <td style="width: 10%;border: 0px;"></td>
            </tr>
            
        </table>
        
        <center><div Class="asunto" style="margin-top: 0px;"><b>REPORTE MANTENIMIENTO - GDUC</b></div></center>
        <div class="subasunto" style="text-align: right; padding-left: 30px; margin-top: 20px;">Cerro Colorado </div>

        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>I . <span style=" text-decoration: underline">PERSONAS </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE EJECUTOR</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->ejecutor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DNI</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->dni_ejecutor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE SUPERVISOR</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->supervisor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DNI</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->dni_supervisor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE RESIDENTE</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->residente}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DNI</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->dni_residente}}
                </td>
            </tr>

        </table>
        
        <br>
        
        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>II . <span style=" text-decoration: underline">INFORMACION CATASTRAL </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> CODIGO CATASTRAL</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->ubicacion}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> HABILITACION URBANA</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->nomb_hab_urba}}
                </td>
            </tr>

        </table>
        
        <br>
        
        <table style="margin-top: 5px; margin-bottom: 5px !important;">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>III. <span style=" text-decoration: underline">INFORMACION DE MANTENIMIENTO</span></b>
                </td>
            </tr>
        </table>
        
        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE MANTENIMIENTO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->nombre}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> TIPO MANTENIMIENTO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->tipo_mant}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> MODALIDAD EJECUCION</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->modalidad}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> OBSERVACIONES</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->observacion}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> INFORME TECNICO</b>
                </td>
                @if($sql[0]->informe_tecnico == 1)
                    <td style="border:0px;">
                        : SI
                    </td>
                @else
                    <td style="border:0px;">
                        : NO
                    </td>
                @endif  
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> TIEMPO EJECUCION</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->tiempo_ejecucion}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> BENEFICIARIOS</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->beneficiarios}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> FECHA INICIO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->fecha_inicio}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> FECHA TERMINO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->fecha_termino}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DESCRIPCION</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->descripcion}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> ESTADO MANTENIMIENTO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->estado}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> AVANCE FISICO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->avance_fisico}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> AVANCE FINANCIERO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->avance_financiero}}
                </td>
            </tr>

        </table>
        
  </body>

</html>