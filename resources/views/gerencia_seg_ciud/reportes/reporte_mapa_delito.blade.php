<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>REPORTE DE MAPA DELITO</title>
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
        
        <center><div Class="asunto" style="margin-top: 0px;"><b>REPORTE MAPA DELITO - GDUC</b></div></center>
        <div class="subasunto" style="text-align: right; padding-left: 30px; margin-top: 20px;">Cerro Colorado </div>

        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>I . <span style=" text-decoration: underline">PERSONAS </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE ENCARGADO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->encargado}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DNI</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nro_doc_encargado}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE INFRACTOR</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->infractor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DNI</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nro_doc_infractor}}
                </td>
            </tr>

        </table>
        
        <br>
        
        <table style="margin-top: 5px; margin-bottom: 5px !important;">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>III. <span style=" text-decoration: underline">INFORMACION DEL DELITO</span></b>
                </td>
            </tr>
        </table>
        
        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> UBICACION</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->ubicacion}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> TIPO DELITO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->descripcion}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> VEHICULO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->vehiculo}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> OBSERVACIONES</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->observacion}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> FECHA REGISTRO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->fecha_registro}}
                </td>
            </tr>

        </table>
        
  </body>

</html>