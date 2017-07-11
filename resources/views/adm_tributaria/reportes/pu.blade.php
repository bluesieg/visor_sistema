<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Example 2</title>
        <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
  </head>
  <body>
       <div class="datehead">AÑO: {{ $sql->anio }}</div>

    <main>
      <div id="details" class="clearfix">
        <div id="invoice">
          <h1>DECLARACION JURADA DE AUTOAVALUO</h1>
          <div class="sub2">IMPUESTO PREDIAL  - DECRETO LEGISLATIVO Nº 776</div>
        </div>
      </div>
      
          
        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
        <thead>
          <tr>
              <td style=" font-size: 0.7em; width: 20%; border: 0px; text-align: center;">
                  MUNICIPALIDAD DISTRITAL DE CERRO COLORADO
              </td>
              <td style="width: 40%;  border: 0px; padding: 10px 0px 0px 80px;"><div class="resaltado" >PU</div></td>
                <td style="width: 15%; padding: 0px; border: 0px;text-align: center;font-size: 0.9em; " >
                <div class="cabdiv" style="width: 100%;">código contribuyente</div>
                <div class="cuerdiv" style="width: 100%;">{{ $sql->id_persona }}</div>
              </td>
              <td style="width: 15%; padding: 0px 0px 0px 2px; border: 0px;text-align: center;font-size: 0.9em; " >
                <div class="cabdiv" style="width: 100%;">código del predio</div>
                <div class="cuerdiv" style="width: 100%;">-</div>
              </td>
              
              <td style="width: 10%; padding: 0px 0px 0px 2px; border: 0px;text-align: center;font-size: 0.9em; " >
                <div class="cabdiv" style="width: 100%;">ANEXO</div>
                <div class="cuerdiv" style="width: 100%;">-</div>
              </td>
              
              
              
              
          </tr>
         
        </thead>
        <tbody>
          
        </tbody>

      </table>
      
      
        
        <div class="lado3" style="border-top: double 3px #000; padding-top: 5px;">
            DATOS DEL CONTRIBUYENTE / CONYUGUE:.      
        </div>
        
       <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
        <thead>
          <tr>
              <th style="width: 20%">DNI/RUC</th>
              <th style="width: 80%">APELLIDOS Y NOMBRES / RAZON SOCIAL</th>
          </tr>
          
        </thead>
        <tbody>
          <tr>
              <td></td>
              <td></td>
          </tr>
          <tr>
              <td></td>
              <td></td>
          </tr>
        </tbody>

      </table>
        <div class="lado3" >
            UBICACION DEL PREDIO:    
        </div>
        
        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;">
        <thead>
          <tr>
              <th style="width: 30%">HABILITACION URBANA</th>
              <th style="width: 30%">CALLE / AV. /PSJE</th>
              <th style="width: 10%">N° MUN.</th>
              <th style="width: 10%">INTER</th>
              <th style="width: 10%">MZNA</th>
              <th style="width: 10%">LOTE</th>
          </tr>
          
        </thead>
        <tbody>
          <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
          </tr>
          
        </tbody>

      </table>
        
        <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
              <th style="width: 25%">CONDICION DE LA PROPIEDAD</th>
              <th style="width: 25%">ESTADO DE LA CONSTRUCCION</th>
              <th style="width: 50%">USO DEL PREDIO</th>
              
          </tr>
          
        </thead>
        <tbody>
          <tr>
              <td></td>
              <td></td>
              <td></td>
          </tr>
          
        </tbody>

      </table>
        <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
              <th style="width: 4%">PISO</th>
              <th style="width: 4%">CLAS</th>
              <th style="width: 4%">MAT</th>
              <th style="width: 4%">EST</th>
              <th style="width: 2%">1</th>
              <th style="width: 2%">2</th>
              <th style="width: 2%">3</th>
              <th style="width: 2%">4</th>
              <th style="width: 2%">5</th>
              <th style="width: 2%">6</th>
              <th style="width: 2%">7</th>
              <th style="width: 10%">VALOR UNIT M2</th>
              <th style="width: 10%">DEPREC (%)</th>
              <th style="width: 10%">VALOR UNIT DEPREC.</th>
              <th style="width: 10%">AREA CONST.</th>
              <th style="width: 15%">VALOR TOTAL S/.</th>
              
          </tr>
          
        </thead>
        <tbody>
          <tr>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
              <td></td>
          </tr>
          
        </tbody>

      </table>
        <div style="height: 350px"></div>
        <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
              <th style="width: 100%">Descripción de Otras instalaciones</th>
          </tr>
        </thead>
        <tbody>
          <tr>
              <td style="height: 100px;"></td>
          </tr>
          
        </tbody>
      </table>
        <table border="0" cellspacing="0" cellpadding="0">
            <thead>
              <tr>
                  <th style="width: 20%">AREA TERRENO</th>
                  <TD style="width: 5%; border: 0px;"></TD>
                  <th style="width: 20%">ARANCEL * M2</th>
                  <TD STYLE="width: 20%;border: 0px;"></TD>
                  <td rowspan="3" STYLE="border: 0px; vertical-align: top;">VALOR DE LA CONSTRUCCION:<br>VALOR DE OTRAS INSTALAC. :<br>VALOR TOTAL DEL TERRENO.<br>TOTAL AVALUO:</td>
              </tr>
            </thead>
            <tbody>
              <tr>
                  <td></td>
                  <td STYLE="border: 0px;"></td>
                  <td></td>
                  <td STYLE="border: 0px;"></td>
              </tr>
              <tr>
                  <td colspan="3" style="border:0px"></td>
                  
              </tr>

            </tbody>
          </table>
  </body>
  
</html>
