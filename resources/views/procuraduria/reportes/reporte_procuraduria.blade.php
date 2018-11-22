<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>REPORTE EXPEDIENTE PROCURADURIA</title>
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
        
        <center><div Class="asunto" style="margin-top: 0px;"><b>REPORTE PROCURADURIA - GDUC</b></div></center>
        <div class="subasunto" style="text-align: right; padding-left: 30px; margin-top: 20px;">Cerro Colorado </div>

        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>I . <span style=" text-decoration: underline">RESPONSABLE </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE RESPONSABLE</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->persona}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DNI</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nro_doc_persona}}
                </td>
            </tr>

        </table>
        
        <br>
        
        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>II . <span style=" text-decoration: underline">INFORMACION EXPEDIENTE </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE GESTOR</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->gestor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DNI</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nro_doc_gestor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NUMERO EXPEDIENTE</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nro_expediente}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> FECHA INICIO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->fecha_inicio_tramite}}
                </td>
            </tr>

        </table>
        
        <br>
        
        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>III . <span style=" text-decoration: underline">INFORMACION CATASTRAL </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> CODIGO CATASTRAL</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->cod_catastral}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> HABILITACION URBANA</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nomb_hab_urba}}
                </td>
            </tr>

        </table>
        
        <br>
        
        <table style="margin-top: 5px; margin-bottom: 5px !important;">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>IV. <span style=" text-decoration: underline">INFORMACION DEL PROCESO</span></b>
                </td>
            </tr>
        </table>
        
        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> TIPO SANCION</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->tipo_sancion}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> MATERIA</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->materia}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> PROCESO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->proceso}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> CASO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->caso}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> REFERENCIA</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->referencia}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> PROCEDIMIENTO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->procedimiento}}
                </td>
            </tr>
        </table>
        
        <br>
        
        <table style="margin-top: 5px; margin-bottom: 5px !important;">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>V. <span style=" text-decoration: underline">OBSERVACIONES</span></b>
                </td>
            </tr>
        </table>
        
        @if($observaciones->count())
        
        <input type="hidden" value=" {{$num= 1}}">

        <div class="lado3" style="margin-bottom: 20px;">
            <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px; margin-top: 0px;  font-size: 1.0em;">
                <thead>
                <tr >
                    <th style="width: 5%;">N°</th>
                    <th style="width: 20%">FECHA REGISTRO</th>
                    <th style="width: 75%;">OBSERVACIONES</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($observaciones as $cont)
                    <tr>
                        <td style="text-align: center;">{{ $num++ }}</td>
                        <td style="text-align: center;">{{$cont->fecha_registro}}</td>
                        <td style="text-align: left;">{{ $cont->observaciones }}</td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
        
        @else
            <div class="contenedor" style="left: 0px;top: 280px;height: 43px;"><center><h2 style="margin-top:6px">NO PRESENTA OBSERVACIONES</h2></center></div>
        @endif
        
  </body>

</html>