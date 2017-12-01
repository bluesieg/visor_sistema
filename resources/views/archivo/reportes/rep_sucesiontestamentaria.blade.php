<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
        <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
        <style>
            @page { margin-bottom: 10px !important; margin-left: 50px;margin-right: 50px;};
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
        
        <center><div Class="asunto" style="margin-top: 0px;"><b>LISTA DE CONTRIBUYENTES CON SUCESIÓN TESTAMENTARIA</b></div></center>
        <input type="hidden" value=" {{$num=1}}">
         <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 10px; margin-top: 10px" >
        <thead>
          <tr>
              <th style="width: 2%">N°</th>
              <th style="width: 5%">N° Doc</th>
              <th style="width: 15%">Nombre</th>
              <th style="width: 15%">Domicilio Fiscal</th>
              <th style="width: 5%">N° Expe</th>
              <th style="width: 10%"> Documento</th>
              <th style="width: 25%">Direcciones Registradas</th>
              <th style="width: 25%">Observación</th>
          </tr>
        </thead>
        <tbody>
          
          @foreach ($sql as $arc)
          <tr>
              <td style="text-align: center;font-size: 0.7em; padding: 0px;">{{$num++}}</td>
              <td style="text-align: center;font-size: 0.7em; padding: 0px;">{{$arc->nro_documento}}</td>
              <td style="text-align: left;font-size: 0.7em; padding-left: 5px;">{{$arc->nombres}}</td>
              <td style="text-align: left;font-size: 0.7em; padding-left: 5px;">{{$arc->domicilio}}</td>
              <td style="text-align: center;font-size: 0.7em; padding: 0px;">{{$arc->nro_expediente}}</td>
              <td style="text-align: left;font-size: 0.7em; padding-left: 3px;">{{$arc->anio}}-{{$arc->documento}}</td>
              <td style="text-align: left;font-size: 0.7em; padding-left: 3px;">{{$arc->direccion}}</td>
              <td style="text-align: left;font-size: 0.7em; padding-left: 3px;">{{$arc->observacion}}</td>
          </tr>
          @endforeach
        </tbody>
      </table>
  </body>
</html>
