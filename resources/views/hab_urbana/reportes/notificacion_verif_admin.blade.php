<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Notificación</title>
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
        
        <center><div Class="asunto" style="margin-top: 0px;"><b>NOTIFICACIÓN N° 012--2018-SGPHU-GDUC-MDCC</b></div></center>
        <div class="subasunto" style="text-align: right; padding-left: 30px; margin-top: 20px;">Cerro Colorado,{{$notificacion[0]->fec_reg}} </div>

        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>I . <span style=" text-decoration: underline">IDENTIFICACIÓN </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> SEÑOR(a)</b>
                </td>
                <td style="border:0px;">
                    : {{$sql[0]->gestor}}
                </td>
            </tr>
            
            <tr>
                <td style="border:0px; padding-left:18px;">
                    <b> DOMICILIO FISCAL</b>
                </td>
                <td style="border:0px;">
                    : {{$sql{0}->gestor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px;">
                    <b> EXPEDIENTE N°</b>
                </td>
                <td style="border:0px">
                    : {{$sql{0}->nro_exp}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px;">
                    <b> MATERIA</b>
                </td>
                <td style="border:0px">
                    : {{$sql{0}->nro_exp}}
                </td>
            </tr>
     
        </table>
        </b>
        <div style="width: 100%; text-align: justify; font-size: 0.8em; margin-top: 0px; padding-left:18px;">
            Tengo el agrado de dirigirme a Usted en atención al documento de referencia
            en la que solicita : xxxxxx , al respecto le comunico que su tramite adolece de observaciones
        </div>
        <table style="margin-top: 5px; margin-bottom: 5px !important;">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>II. <span style=" text-decoration: underline">OBSERVACIONES</span></b>
                </td>
            </tr>
         </table>
        <div style="width: 100%; text-align: justify; font-size: 0.8em; margin-top: 0px; padding-left:18px;">
            @php echo $notificacion[0]->txt_notificacion @endphp
        </div>
        
  </body>

</html>