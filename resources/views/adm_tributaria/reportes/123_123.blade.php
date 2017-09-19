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
    <!--
    <div class="subasunto" style="text-align: left; padding-left: 30px; margin-top: 20px;">

    </div>-->
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
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px; font-size: 1em;">
            <thead>
            <tr>
                <th style="width: 3%;">Código</th>
                <th colspan="2" style="width: 10%">DNI/RUC</th>
                <th colspan="2"style="width: 20%;">Nombre o Razon Social</th>
                <th style="width: 20%;">Dirección Fiscal</th>
                <th style="width: 10%">N° DNI </th>
                <th colspan="2" style="width: 20%">Conyugue o Representante</th>
                <th colspan="2" style="width: 10%"></th>
            </tr>
            <tr >
                <th style="width: 5%;"></th>
                <th style="width: 5%;">Código</th>
                <th style="width: 5%">Tipo</th>
                <th style="width: 5%">Lugar(Urb./PJ/HU)</th>
                <th style="width: 5%">Sec/Mz/Lt</th>
                <th style="width: 5%">Calle y Número</th>
                <th style="width: 5%">Adquirido x</th>
                <th style="width: 5%">Condición</th>
                <th style="width: 5%">Estado</th>
                <th style="width: 5%">Uso</th>
                <th style="width: 5%">Área M2 PU</th>
            </tr>
            </thead>
            <tbody>

            <tr>
                <td style="text-align: center;">{{$sql[0]->id_persona}}</td>
                <td colspan="2" style="text-align: center;">{{$sql[0]->nro_doc_contri}}</td>
                <td colspan="2" style="text-align: center;">{{$sql[0]->contribuyente}}</td>
                <td style="text-align: left;">{{$sql[0]->ref_dom_fis}}</td>
                <td style="text-align: center;">{{$sql[0]->nro_doc_conyugue}}</td>
                <td colspan="2" style="text-align: center;">{{$sql[0]->conyugue}}</td>
                <td colspan="2" style="text-align: center;"></td>

            </tr>

            <tr>
                <td style="border-right:0px; border-bottom: 0px; text-align: center;"></td>
                <td style="border:0px; text-align: center;">{{$sql[0]->cod_cat}}</td>
                <td style="border:0px; text-align: center;">{{$sql[0]->tp}}</td>
                <td style="border:0px; text-align: left;">{{$sql[0]->nomb_hab_urba}}</td>
                <td style="border:0px; text-align: center;">{{$sql[0]->sec}}-{{$sql[0]->mzna}}-{{$sql[0]->lote_cat}}</td>
                <td style="border:0px; text-align: left;">{{$sql[0]->nom_via}}</td>
                <td style="border:0px; text-align: center;">{{$sql[0]->des_for_adq}}</td>
                <td style="border:0px; text-align: center;">{{$sql[0]->cond_prop_descripc}}</td>
                <td style="border:0px; text-align: center;"></td>
                <td style="border:0px; text-align: center;">{{$sql[0]->desc_uso}}</td>
                <td style="border-left:0px; border-bottom: 0px;text-align: center;">{{$sql[0]->are_terr}}</td>
            </tr>

            @for ($i = 1; $i < count($sql); $i++)
                @if($sql[$i]->id_contrib == $sql[$i-1]->id_contrib)
                    <tr>
                        <td style="border-right:0px; border-bottom: 0px;border-top: 0px; text-align: center;"></td>
                        <td style="border:0px; text-align: center;">{{$sql[0]->cod_cat}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->tp}}</td>
                        <td style="border:0px; text-align: left;">{{$sql[$i]->nomb_hab_urba}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->sec}}-{{$sql[$i]->mzna}}-{{$sql[$i]->lote_cat}}</td>
                        <td style="border:0px; text-align: left;">{{$sql[$i]->nom_via}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->des_for_adq}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->cond_prop_descripc}}</td>
                        <td style="border:0px; text-align: center;"></td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->desc_uso}}</td>
                        <td style="border-left:0px; border-bottom: 0px;border-top: 0px; text-align: center;">{{$sql[$i]->are_terr}}</td>
                    </tr>
                @else

                    <tr>
                        <td style="text-align: center;">{{$sql[$i]->id_persona}}</td>
                        <td colspan="2" style="text-align: center;">{{$sql[$i]->nro_doc_contri}}</td>
                        <td colspan="2" style="text-align: center;">{{$sql[$i]->contribuyente}}</td>
                        <td style="text-align: left;">{{$sql[$i]->ref_dom_fis}}</td>
                        <td style="text-align: left;">{{$sql[$i]->nro_doc_conyugue}}</td>
                        <td colspan="2" style="text-align: center;">{{$sql[$i]->conyugue}}</td>
                        <td colspan="2" style="text-align: center;"></td>

                    </tr>

                    <tr>
                        <td style="border-right:0px; border-bottom: 0px;border-top: 0px; text-align: center;"></td>
                        <td style="border:0px; text-align: center;">{{$sql[0]->cod_cat}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->tp}}</td>
                        <td style="border:0px; text-align: left;">{{$sql[$i]->nomb_hab_urba}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->sec}}-{{$sql[$i]->mzna}}-{{$sql[$i]->lote_cat}}</td>
                        <td style="border:0px; text-align: left;">{{$sql[$i]->nom_via}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->des_for_adq}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->cond_prop_descripc}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->descripcion}}</td>
                        <td style="border:0px; text-align: center;">{{$sql[$i]->desc_uso}}</td>
                        <td style="border-left:0px; border-bottom: 0px;border-top: 0px;text-align: center;">{{$sql[$i]->are_terr}}</td>
                    </tr>
                @endif
            @endfor
            <tr>
                <td colspan="11" style="border-left:0px; border-bottom: 0px;border-right: 0px"></td>
            </tr>
            </tbody>
        </table>
    </div>
    <!--
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
    -->
    <p class="pagenum" style="padding-top: 130px;text-align: center"> Gerencia de Administración Tributaria - Página</p>
</body>

</html>