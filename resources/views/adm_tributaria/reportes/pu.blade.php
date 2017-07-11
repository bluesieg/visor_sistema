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
                <div class="cabdiv" style="width: 100%; font-size: 0.9em !important">código contribuyente</div>
                <div class="cuerdiv" style="width: 100%;font-size: 0.9em !important">{{ $sql->id_persona }}</div>
              </td>
              <td style="width: 15%; padding: 0px 0px 0px 2px; border: 0px;text-align: center;font-size: 0.9em; " >
                <div class="cabdiv" style="width: 100%;font-size: 0.9em !important">código del predio</div>
                <div class="cuerdiv" style="width: 100%;font-size: 0.9em !important">{{ $sql->cod_cat }}</div>
              </td>
              
              <td style="width: 10%; padding: 0px 0px 0px 2px; border: 0px;text-align: center;font-size: 0.9em; " >
                <div class="cabdiv" style="width: 100%;font-size: 0.9em !important">ANEXO</div>
                <div class="cuerdiv" style="width: 100%;font-size: 0.9em !important">-</div>
              </td>
              
              
              
              
          </tr>
         
        </thead>
        <tbody>
          
        </tbody>

      </table>
      
      
        
        <div class="lado3" style="border-top: double 3px #000; padding-top: 5px;">
            DATOS DEL CONTRIBUYENTE / CONYUGUE:.      
        </div>
        
       <table border="0" cellspacing="0" cellpadding="0" >
        <thead>
          <tr>
              <th style="width: 20%">DNI/RUC</th>
              <th style="width: 80%">APELLIDOS Y NOMBRES / RAZON SOCIAL</th>
          </tr>
          
        </thead>
        <tbody>
          <tr>
              <td>{{$sql->nro_doc}}</td>
              <td>{{$sql->contribuyente}}</td>
          </tr>
          <tr>
              <td>{{$sql->nro_doc_conv}}</td>
              <td>{{$sql->conviviente}}</td>
          </tr>
        </tbody>

      </table>
        <div class="lado3" >
            UBICACION DEL PREDIO:    
        </div>
        
        <table border="0" cellspacing="0" cellpadding="0" >
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
              <td>{{$sql->habilitacion}}</td>
              <td>{{$sql->calle}}</td>
              <td>{{$sql->nro_mun}}</td>
              <td>{{$sql->nro_int}}</td>
              <td>{{$sql->mzna_dist}}</td>
              <td>{{$sql->lote_dist}}</td>
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
              <td>{{$sql->cond_prop_descripc}}</td>
              <td>{{$sql->descripcion}}</td>
              <td>{{$sql->uso_predio}}</td>
          </tr>
          
        </tbody>

      </table>
      <div style="height: 410px">
        <div class="lado3" >
            INFORMACION DE PISOS:    
        </div>
        <table border="0" cellspacing="0" cellpadding="0">
        <thead>
          <tr>
              <th style="width: 4%">PISO</th>
              <th style="width: 4%">CLAS</th>
              <th style="width: 4%">MAT</th>
              <th style="width: 4%">EST</th>
              <th style="width: 8%">CATEGORIAS</th>
              <th style="width: 10%">VALOR UNIT M2</th>
              <th style="width: 8%">INCRE.</th>
              <th style="width: 8%">DEPREC (%)</th>
              <th style="width: 10%">VALOR UNIT DEPREC.</th>
              <th style="width: 10%">AREA CONST.</th>
              <th style="width: 10%">AREA COMUN</th>
              <th style="width: 15%">VALOR TOTAL S/.</th>
              
          </tr>
          
        </thead>
        <tbody>
          @foreach ($sql_pis as $pis)
          <tr>
              <td>{{$pis->num_pis}}</td>
              <td>{{$pis->clas}}</td>
              <td>{{$pis->mep}}</td>
              <td>{{$pis->esc}}</td>
              <td style="padding-left: 2px;">{{$pis->est_mur.$pis->est_tch.$pis->aca_pis.$pis->aca_pta.$pis->aca_rev.$pis->aca_ban.$pis->ins_ele}}</td>
              <td style="text-align: right;padding-right: 5px;">{{number_format($pis->val_cons,2)}}</td>
              <td style="text-align: right;padding-right: 5px;">{{number_format($pis->inc_pis)}}</td>
              <td style="text-align: right;padding-right: 5px;">{{$pis->por_dep."%"}}</td>
              <td style="text-align: right;padding-right: 5px;">{{ number_format($pis->val_uni_dep,2)}}</td>
              <td style="text-align: right;padding-right: 5px;">{{number_format($pis->area_const,2)}}</td>
              <td style="text-align: right;padding-right: 5px;">{{number_format($pis->val_areas_com,2)}}</td>
              <td style="text-align: right;padding-right: 5px;">{{number_format($pis->val_const_tot,2)}}</td>
          </tr>
          @endforeach
        </tbody>

      </table>
        </div>
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
                  <th style="width: 15%">AREA TERRENO</th>
                  <TD style="width: 2%; border: 0px;"></TD>
                  <th style="width: 15%">AREA T. COMUN</th>
                  <TD style="width: 2%; border: 0px;"></TD>
                  <th style="width: 15%">ARANCEL * M2</th>
                  <TD STYLE="width: 11%;border: 0px;"></TD>
                  <td rowspan="4" STYLE="border: 0px; vertical-align: top;">
                      <table>
                          <tr><td>VALOR DE LA CONSTRUCCION</td><td style="text-align: right;padding-right: 5px; font-size: 1.1em">{{number_format($sql->val_const,2)}}</td></tr>
                          <tr><td>VALOR DE OTRAS INSTALAC.</td><td style="text-align: right;padding-right: 5px;font-size: 1.1em">{{number_format($sql->val_obr_cmp,2)}}</td></tr>
                          <tr><td>VALOR TOTAL DEL TERRENO</td><td style="text-align: right;padding-right: 5px;font-size: 1.1em">{{number_format($sql->val_ter,2)}}</td></tr>
                          <tr><td>TOTAL AVALUO</td><td style="text-align: right;padding-right: 5px;font-size: 1.1em">{{number_format($sql->base_impon,2)}}</td></tr>

                      </table>
                  </td>
              </tr>
            </thead>
            <tbody>
              <tr>
                  <td style="text-align: right;padding-right: 5px">{{number_format($sql->are_terr,2)}}</td>
                  <td STYLE="border: 0px;">+</td>
                  <td style="text-align: right;padding-right: 5px">{{number_format($sql->are_com_terr,2)}}</td>
                  <td STYLE="border: 0px;">*</td>
                  <td style="text-align: right;padding-right: 5px">{{number_format($sql->arancel,2)}}</td>
                  <td STYLE="border: 0px;"></td>
              </tr>
              <tr>
                  <td colspan="5" style="border:0px"></td>
                  
              </tr>

            </tbody>
          </table>
  </body>
  
</html>
