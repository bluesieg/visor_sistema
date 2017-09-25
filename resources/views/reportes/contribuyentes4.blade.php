<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
    <style>
        .move-ahead { counter-increment: page 2; position: absolute; visibility: hidden; }
        .pagenum:after { content:' ' counter(page); }
    </style>
</head>
<body>
<main>

    <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 5px;">
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

    <center><div Class="asunto" style="margin-top: 10px;"><b>REPORTE DE CONTRIBUYENTES</b></div></center>
    <div class="subasunto" style="text-align: left; padding-left: 30px; margin-top: 20px;">
            AÑO: {{ $anio }}
    </div>
    <!--
  <div id="details" class="clearfix">
      <div id="invoice" >
      <h1>MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</h1>



      <div class="lado" style="text-align: right !important"></div>

              <div Class="asunto">DECLARACION JURADA DE AUTOVALUO</div>
          <div class="subasunto">LEY TRIBUTARIA MUNICIPAL/DECRETO LEGISLATIVO 776</div>
          <table border="0" cellspacing="0" cellpadding="0" style="margin: 0px;">
              <tr>
                  <td style="width:75%;vertical-align: bottom; border: 0px; padding: 0px;">
                    IDENTIFICACION DEL CONTRIBUYENTE: Si es casado anotar datos del Conyugue
                  </td>
                  <td style="text-align: center;border: 0px">
                      <div class="cabdiv">COD. CONTRIBUYENTE</div>
                      <div class="cuerdiv"></div>
                  </td>
              </tr>
          </div>


          </table>

    </div>
  </div>
  -->
    <input type="hidden" value=" {{$num= 1}}">

    <div class="lado3" style="height: 435px; border-bottom: 1px solid #333">

        <br>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px; font-size: 1.3em;">
            <thead>
            <tr >
                <th style="width: 7%;">N°</th>
                <th style="width: 12%;">COD. ZONA</th>
                <th style="width: 61%">NOMBRE DE LA ZONA</th>
                <th style="width: 10%;">N° CONTRI</th>
                <th style="width: 10%;">N° PREDIOS</th>
            </tr>
            </thead>
            <tbody>

            @foreach ($sql as $cont)
                <tr>
                    <td style="text-align: center;">{{ $num++ }}</td>
                    <td style="text-align: center;">{{ $cont->codi_hab_urba }}</td>
                    <td style="text-align: center;">{{$cont->nomb_hab_urba}}</td>
                    <td style="text-align: center;">{{ $cont->n_contrib }}</td>
                    <td style="text-align: center;">{{ $cont->n_predios }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <p class="pagenum" style="padding-top: 130px;text-align: center"> Gerencia de Administración Tributaria - Página</p>
</body>

</html>