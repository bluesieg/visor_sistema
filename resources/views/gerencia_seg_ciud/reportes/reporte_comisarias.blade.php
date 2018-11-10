<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>REPORTE DE COMISARIAS</title>
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
        
        <center><div Class="asunto" style="margin-top: 0px;"><b>REPORTE COMISARIAS - GDUC</b></div></center>
        <div class="subasunto" style="text-align: right; padding-left: 30px; margin-top: 20px;">Cerro Colorado </div>

        <table style="margin-top: 10px; margin-bottom: 5px !important; border-bottom: 1px solid black">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>I . <span style=" text-decoration: underline">INFORMACION COMISARIA </span></b>
                </td>
            </tr>
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
                    <b> NOMBRE COMISARIA</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nombre}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> TELEFONO</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->telefono}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NUMERO DE VEHICULOS</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nro_vehiculos}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; padding-left:18px; width: 35%">
                    <b> NUMERO DE EFECTIVOS</b>
                </td>
                <td style="border:0px;">
                    : {{$sql->nro_efectivos}}
                </td>
            </tr>

        </table>
        
        <br>
        
        <table style="margin-top: 5px; margin-bottom: 5px !important;">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>II. <span style=" text-decoration: underline">PERSONAL COMISARIA</span></b>
                </td>
            </tr>
        </table>
        
        @if($personal->count())
        
        <input type="hidden" value=" {{$per_num = 1}}">

        <div class="lado3" style="margin-bottom: 20px;">
            <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px; margin-top: 0px;  font-size: 1.0em;">
                <thead>
                <tr >
                    <th style="width: 5%;">N°</th>
                    <th style="width: 10%">DNI</th>
                    <th style="width: 45%;">NOMBRE</th>
                    <th style="width: 10%;">TELEFONO</th>
                    <th style="width: 10%;">CARGO</th>
                    <th style="width: 10%;">FECHA REGISTRO</th>
                    <th style="width: 10%;">ESTADO</th>
                </tr>
                </thead>
                <tbody>

                @foreach ($personal as $pers)
                    <tr>
                        <td style="text-align: center;">{{ $per_num++ }}</td>
                        <td style="text-align: center;">{{$pers->dni}}</td>
                        <td style="text-align: left;">{{ $pers->persona }}</td>
                        <td style="text-align: center;">{{ $pers->telefono }}</td>
                        <td style="text-align: left;">{{ $pers->descripcion }}</td>
                        <td style="text-align: center;">{{ $pers->fecha_registro }}</td>
                        @if($pers->estado == '1')
                            <td style="text-align: center;">ACTIVO</td>
                        @else
                            <td style="text-align: center;">INACTIVO</td>
                        @endif
                    </tr>

                @endforeach

                </tbody>
            </table>
        </div>
        
        @else
            <div class="contenedor" style="left: 0px;top: 280px;height: 43px;"><center><h2 style="margin-top:6px">NO PRESENTA PERSONAL</h2></center></div>
        @endif
        
        <br>
        
        <table style="margin-top: 5px; margin-bottom: 5px !important;">
            <tr>
                <td colspan="2" style="border:0px;">
                    <b>III. <span style=" text-decoration: underline">OBSERVACIONES</span></b>
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
                        <td style="text-align: left;">{{ $cont->observacion }}</td>
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