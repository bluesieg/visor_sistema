<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
        <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
  </head>
  <body>
    <main>
      <div id="details" class="clearfix">
          <div id="invoice" >
          <h1>MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</h1>
          
          
          <div class="lado" style="text-align: left !important; padding-top: 20px;">GERENCIA DE RENTAS</div>
          <div class="lado">
              <div class="sub">IMPUESTO PREDIAL</div>
              <div class="date">AÑO:</div>
          </div>
          <div class="lado" style="text-align: right !important"><div class="resaltado" >HR</div>HOJA RESUMEN</div>
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


        <div class="lado3" style="height: 435px; border-bottom: 1px solid #333">
            INFORMACION ADICIONAL. 
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px; font-size: 1.3em;">
        <thead>
            <tr >
              <th style="width: 10%;">CÓDIGO</th>
              <th style="width: 10%">DOCUMENTO</th>
              <th style="width: 60%">CONTRIBUYENTE</th>
              <th style="width: 20%">CALLE O VÍA</th>
          </tr>
        </thead>
        <tbody>
        @foreach ($sql as $cont)
            <tr>
                <td>{{ $cont->id_persona }}</td>
                <td>{{$cont->nro_doc}}</td>
                <td>{{$cont->contribuyente}}</td>
                <td style="text-align: right; padding-right: 5px;">{{$cont->nom_via}}</td>
            </tr>
        @endforeach
        </tbody>
      </table>
        </div>
        
        <table border="0" cellspacing="0" cellpadding="0" >
            <thead>
              <tr>
                  <td style="width: 50%; border:0px;" rowspan="3"></td>
                  <td class="nro">18</td>
                  <th style="width: 22.5%">BASE IMPONIBLE</th>
                  <td style="text-align: right; padding-right: 5px;"></td>
              </tr>
              <tr>
                  <td class="nro">19</td>
                  <th>IMPUESTO ANUAL</th>
                  <td style="text-align: right; padding-right: 5px;"></td>
              </tr>
              <tr>
                  <td class="nro">20</td>
                  <th>IMPUESTO TRIMESTRAL</th>
                  <td style="text-align: right; padding-right: 5px;"></td>
              </tr>
            </thead>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px;">
            <thead>
              <tr>
                  <td class="nro">21</td>
                  <th rowspan="2" style="width: 15%; border-left: 0px;">total predios declarados</th>
                  <td rowspan="2" style="width: 10%; font-size: 1.2em; text-align: center"></td>
                  <td rowspan="3" style="border-top:0px; border-bottom:0px; border-left: 0px;"></td>
                  <th rowspan="3" style="width: 20%; border-left: 0px;">DECLARO BAJO JURAMENTO QUE LOS DATOS CONSIGNADOS EN ESTA DECLARACION SON VERDADEROS</th>
                  <td rowspan="2" style="width: 20%; border-bottom: 0px;"></td>
                  <td rowspan="2" style="width: 30%; border-bottom: 0px;"></td>

              </tr>
              <tr>
                  <th style="border-right: 0px;"></th>
              </tr>
              <tr>
                  <td colspan="3" style="border:0px;"></td>
                  <td  class="firma" style="width: 20%;"><div class="firma2">fecha</div></td>
                  <td  class="firma" style="width: 30%;"><div class="firma2">firma</div></td>
              </tr>
              
            </thead>
        </table>
        
  </body>
  
</html>
