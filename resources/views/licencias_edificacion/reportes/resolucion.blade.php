<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>RESOLUCION</title>
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
        
        <center><div Class="asunto" style="margin-top: 0px;"><b>RESOLUCION N° 012--2018-SGPHU-GDUC-MDCC</b></div></center>
        <div class="subasunto" style="text-align: right; padding-left: 30px; margin-top: 20px;">Cerro Colorado </div>

        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>I . <span style=" text-decoration: underline">IDENTIFICACIÓN </span></b>
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> SEÑOR(A)ES</b>
                </td>
                <td style="border:0px;">
                    : {{$parametros->gestor}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> Tramite Nº</b>
                </td>
                <td style="border:0px;">
                    : {{$parametros->nro_exp}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> Exp. Interno Nº</b>
                </td>
                <td style="border:0px;">
                    : {{$parametros->cod_interno}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> Materia</b>
                </td>
                <td style="border:0px;">
                    : Regularización de Licencia de Edificación
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px;">
                    <b> Ubicacion del Predio</b>
                </td>
                <td style="border:0px;">
                    : --
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
            Tengo el agrado de dirigirme a Usted en atención al documento de referencia
            en la que solicita : xxxxxx , al respecto le comunico que su tramite adolece de observaciones
        </div>
        
        <input type="hidden" value=" {{$num= 1}}">
        
        <div class="lado3" style="height: 435px; margin-bottom: 20px;">
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px; margin-top: 0px;  font-size: 1.4em;">
            <thead>
            <tr >
                <th style="width: 5%;">N°</th>
                <th style="width: 20%">Nº PISO</th>
                <th style="width: 20%;">EXISTENTE</th>
                <th style="width: 20%;">DEMOLICION</th>
                <th style="width: 20%">REMODELACION</th>
                <th style="width: 20%">AMPLIACION</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($especificaciones as $especificacion)
                <tr>
                    <td style="text-align: center;">{{ $num++ }}</td>
                    <td style="text-align: center;">{{$especificacion->nro_piso}}</td>
                    <td style="text-align: center;">{{$especificacion->existente}}m2</td>
                    <td style="text-align: center;">{{$especificacion->demolicion}}m2</td>
                    <td style="text-align: center;">{{$especificacion->remodelacion}}m2</td>
                    <td style="text-align: center;">{{$especificacion->ampliacion}}m2</td>
                </tr>
                
            @endforeach

            </tbody>
        </table>
    </div>
        <div style="width: 100%; text-align: justify; font-size: 0.8em; margin-top: 0px; padding-left:18px;">
            @php echo $resolucion->cuerpo @endphp
        </div>
        
  </body>

</html>