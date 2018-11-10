<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>REPORTE DE PERFILES</title>
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
        
        <center><div Class="asunto" style="margin-top: 0px;"><b>REPORTE EXPEDIENTE TECNICO - GDUC</b></div></center>
        <div class="subasunto" style="text-align: right; padding-left: 30px; margin-top: 20px;">Cerro Colorado </div>

        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>I . <span style=" text-decoration: underline">PERSONA </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->persona}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> DNI</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->nro_doc_persona}}
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
                    <b>III. <span style=" text-decoration: underline">INFORMACION DE EXPEDIENTE TECNICO</span></b>
                </td>
            </tr>
        </table>
        
        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> CODIGO SNIP</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->codigo_snip}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NOMBRE PIP</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->nombre_pip}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> MONTO EXPEDIENTE TECNICO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->monto_exp_t}}
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
                    <b> MONTO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->monto}}
                </td>
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
                    <b> APROBACION</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->aprobacion}}
                </td>
            </tr>

        </table>
        
  </body>

</html>