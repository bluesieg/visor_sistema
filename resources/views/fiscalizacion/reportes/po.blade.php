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
            <div class="sub2">Creado por Ley 12075 el día 26 de Febrero de 1954</div>
        </div>
      </div>
        <div style="width: 100%; border-top:1px solid #999;"></div>
        <center><div Class="asunto" style="margin-top: 20px;"><b>ORDEN DE PAGO PREDIAL N° {{$sql->nro_fis}}--{{$sql->anio}}--GAT-MDCC</b></di</center>
        <div class="subasunto" style="text-align: left; padding-left: 30px; margin-top: 20px;">Cerro Colorado, {{$sql->fec_reg}}</div>

        <div class="lado3" style="margin-top: 30px; font-weight: bold">
            INDENTIFICACION DEL DEUDOR TRIBUTARIO
        </div>
        <b>
        <table>
            <tr>
                <td style="border:0px; width: 20%">
                    Nombre/ Razon Social
                </td>
                <td style="border:0px;">
                    : {{$sql->contribuyente}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; width: 20%">
                    N° Documento
                </td>
                <td style="border:0px;">
                    : {{$sql->nro_doc}}
                </td>
            </tr>
            <tr>
                <td style="border:0px; width: 20%">
                    Domicilio Fiscal
                </td>
                <td style="border:0px;">
                    : {{$sql->dom_fiscal}}
                </td>
            </tr>
            
        </table>
        </b>
        <div style="width: 100%; text-align: justify">
            Se requiere la cancelacion de la deuda contenida en el presente documento, en el plazao de 20 días habiles contados a partir del día siguiente de la notificación, bajo apercibimiento de iniciar procedimiento de ejecución coactiva.<br>
            La presente de emite por los tributos y periodos que se indican, cuyo monto se ha actualizaco a la FECHA DE EMISION, luego de esta fecha se actualizara con la tasa diaria de 0.04% conforme a la tasa de interes fijada.<br>
            <b>Monto Determinante:</b><br>
            Se ha verificado la existencia de una deuda tributaria no cancelada dentro de los plazos establecidos.<br>
            <b>Declaración jurada</b><br>
            Actualizacion de DJ N° 46745 de Fecha 22/02/2017<br>
        </div>
        <div style="width: 100%; text-align: justify">
            <b>Base Legal:</b><br>
            Artículos 33°,77°,78° inc 1 y 194 del T.U.O. del Código Tributario, aprobado por D.S. N° 133-2013-EF y sus
            modificatorias.<br>
            Artículo 8° y siguientes del TUO de la ley de Tributación Municipal, aprobada por D.S.N° 133-2013-EF y sus modificatorias<br>
            Ordenanzas 297-2010 que aprueba TIM para la jurisdicción del distrito de Cerro Colorado.<br>
            <b>Avisos:</b><br>
            -Si a la recepción de esta. Ud. ya realizo el pago de tales conceptos, le rogamos no prestar atención a la presente<br>
            -Cualquier consulta adicional, lo esperamos en la Plaza Las Americas, La Libertad, Cerro Colorado; o comuníquese al 
            teléfono (054)382590 anexo 719, en el horario de lunes a viernes de 8.00am a 3.30pm.<br>
            -En el caso de no conformidad, podrá interponer recurso de reclamación debidamente sustentado, suscrito por letrado hábil
            (nombre, firma y número de registro), para lo cual deberá acreditar la cancelación de la totalidad de la deuda, salvo sea
            evidente la improcedencia de la cobranza, en cuyo caso podra presentar la reclamación en el plazo de 20 días hábiles
            de motificada la presente, y conforme a los dispositivos vigentes.<br>
            <br>
            <b>Nota:</b> Se ha aprobado los beneficiones tributarios a traves de Ordenanza Municipal 459-MDCC.
        </div>
        
  </body>
  
</html>
