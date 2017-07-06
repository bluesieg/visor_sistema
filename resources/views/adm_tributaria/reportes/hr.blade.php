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
        <div id="invoice">
          <h1>MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</h1>
          
          
          <div class="lado" style="text-align: left !important; padding-top: 20px;">GERENCIA DE RENTAS</div>
          <div class="lado">
              <div class="sub">IMPUESTO PREDIAL</div>
              <div class="date">AÑO: {{ $date }}</div>
          </div>
          <div class="lado" style="text-align: right !important"><div class="resaltado" >HR</div>HOJA RESUMEN</div>
          <div Class="asunto">DECLARACION JURADA DE AUTOVALUO</div>
          <div class="subasunto">LEY TRIBUTARIA MUNICIPAL/DECRETO LEGISLATIVO 776</div>
          <div class="lado2">
                IDENTIFICACION DEL CONTRIBUYENTE: Si es casado anotar datos del Conyugue
          </div>
          <div class="lado">
                <div class="cabdiv">COD. CONTRIBUYENTE</div>
                <div class="cuerdiv">XXXXXXXXXXXXXX</div>
          </div>
        </div>
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
              <td class="nro">1</td>
              <th>TIPO PERSONA</th>
              <td class="nro">2</td>
            <th>NUMERO DE DOCUMENTO</th>
            <td class="nro">3</td>
            <th>APELLIDOS y NOMBRES / RAZON SOCIAL</th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td colspan="2"></td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
        </tbody>
<!--        <tfoot>
          <tr>
           
            
          </tr>
        </tfoot>-->
      </table>
      <div class="lado3">
                IDENTIFICACION DEL CONYUGUE  /  REPRESENTANTE LEGAL : (Llenar de acuerdo a tabla adjunta y completando datos personales)
      </div>
      <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
              <td class="nro">4</td>
              <th>TD</th>
              <td class="nro">5</td>
            <th>NUMERO DE DOCUMENTO</th>
            <td class="nro">6</td>
            <th>CONYUGE / REPRESENTANTE LEGAL</th>
          </tr>
        </thead>
        <tbody>
            <tr>
              <td colspan="2"></td>
              <td colspan="2"></td>
              <td colspan="2"></td>
            </tr>
        </tbody>

      </table>
        
        <div class="lado3">
            DOMICILIO FISCAL DEL CONTRIBUYENTE / REPRESENTANTE LEGAL.      
        </div>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px;">
        <thead>
          <tr>
              <td class="nro">7</td>
              <th style="width: 15.16%">DEPARTAMENTO</th>
              <td style="width: 15.16%"></td>
              <td class="nro">8</td>
              <th style="width: 15.16%">PROVINCIA</th>
              <td style="width: 15.16%"></td>
              <td class="nro">9</td>
              <th style="width: 15.16%">DISTRITO</th>
              <td colspan="2"></td>
          </tr>
          <tr>
              <td class="nro">10</td>
              <th>MANZANA URBANA</th>
              <td></td>
              <td class="nro">11</td>
              <th>LOTE URBANO</th>
              <td></td>
              <td class="nro">12</td>
              <th>SUB LOTE URBANO</th>
              <td colspan="2" ></td>
          </tr>
          <tr>
              <td class="nro">13</td>
              <th colspan="5">HABILITACION URBANA / ZONA / VIA /CALLE</th>
              <td class="nro">14</td>
              <th>NUMERO MUNICIPAL</th>
              <td class="nro">15</td>
              <th>NUMERO INTERIOR/DPTO</th>
          </tr>
          <tr>
              <td colspan="6"></td>
              <td colspan="2"></td>
              <td colspan="2"></td>
          </tr>
          <tr>
              <td class="nro">16</td>
              <th>CORREO ELECTRONICO</th>
              <td colspan="4"></td>
              <td class="nro">17</td>
              <th>N° DE TELEFONO</th>
              <td colspan="2"></td>
          </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="10" class="fintd"></td>
            </tr>
        </tbody>
        
      </table>
        <div class="lado3" style="height: 385px; border-bottom: 1px solid #333">
            INFORMACION ADICIONAL.     
        </div>
        
        <table border="0" cellspacing="0" cellpadding="0" >
            <thead>
              <tr>
                  <td style="width: 50%; border:0px;" rowspan="3"></td>
                  <td class="nro">18</td>
                  <th style="width: 22.5%">BASE IMPONIBLE</th>
                  <td></td>
              </tr>
              <tr>
                  <td class="nro">19</td>
                  <th>IMPUESTO ANUAL</th>
                  <td></td>
              </tr>
              <tr>
                  <td class="nro">20</td>
                  <th>IMPUESTO TRIMESTRAL</th>
                  <td></td>
              </tr>
            </thead>
        </table>
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px;">
            <thead>
              <tr>
                  <td class="nro">21</td>
                  <th rowspan="2" style="width: 15%; border-left: 0px;">total predios declarados</th>
                  <td rowspan="2" style="width: 10%">0</td>
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
