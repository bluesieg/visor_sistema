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
                      <h1>{{$institucion[0]->nom1}}&nbsp;{{$institucion[0]->nom2}}</h1>
                        <div class="sub2">Creado por Ley 12075 el día 26 de Febrero de 1954</div>
                    </div>
                    <div style="width: 90%; border-top:1px solid #999; margin-top: 10px; margin-left: 25px;"></div>
                </div>
            </td>
            <td style="width: 10%;border: 0px;"></td>
        </tr>

    </table>

    <center><div Class="asunto" style="margin-top: 10px;">
               <b>GERENCIA DE DESARROLLO URBANO Y CATASTRO DE LA MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</b>   
            </div></center>
        <div class="subasunto" style="text-align: center; padding-left: 30px; margin-top: 20px;">CONSTANCIA DE POSESION Nº: {{$sql[0]->nro_constancia}}</div>
        <div class="subasunto" style="text-align: left; padding-left: 30px; margin-top: 20px;">EXPEDIENTE Nº: {{$sql[0]->nro_expediente}}</div>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;margin-bottom: 5px;">
            <thead>
              <tr>
                  <th style="width: 10%">DNI/RUC</th>
                  <th style="width: 70%">Solicitante</th>
                  
              </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                            {{$sql[0]->numero_identificacion}}
                        </td> 
                        <td>
                            {{$sql[0]->gestor}}
                        </td> 
                    </tr>
            </tbody>
        </table>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;margin-bottom: 5px;">
            <thead>
              <tr>
                  <th style="width: 40%">Ubicación</th>
                  <th style="width: 5%">Super Mzna</th>
                  <th style="width: 5%">Mzna</th>
                  <th style="width: 5%">Lote</th>
                  <th style="width: 5%">Sub Lote</th>
                  
              </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                            {{$sql[0]->nomb_hab_urba}}
                        </td> 
                        <td>
                           {{$sql[0]->sup_mzna}}
                        </td> 
                        <td>
                            {{$sql[0]->mzna}}
                        </td> 
                        <td>
                            {{$sql[0]->lote}}
                        </td> 
                        <td>
                            {{$sql[0]->sub_lote}}
                        </td> 
                          </tr>
            </tbody>
        </table>
        
        <div style="width: 100%; text-align: justify; font-size: 1.0em; margin-top: 10px;">
            <B>NOTA</B> La Sub División no se encuentra Registrada
            <br>
        </div>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;margin-bottom: 10px;">
            <thead>
              <tr>
                  <th style="width: 30%">Inicio de Posesión</th>
                  <th style="width: 30%">Área (M2)</th>
                  <th style="width: 30%"></th>
              </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                            {{$sql[0]->anio_posesion}}
                        </td> 
                        <td>
                            {{$sql[0]->area_m2}}
                        </td> 
                        <td>
                        </td> 
                    </tr>
            </tbody>
        </table>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;margin-bottom: 5px;">
            <thead>
              <tr>
                  <th style="width: 70%">Región</th>
                  <th style="width: 70%">Provincia</th>
                  <th style="width: 70%">Distrito</th>
              </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                                AREQUIPA
                        </td> 
                        <td>
                                AREQUIPA
                        </td> 
                        <td>
                                CERRO COLORADO
                        </td> 
                    </tr>
            </tbody>
        </table>
        <div style="width: 100%; text-align: justify; font-size: 1.0em; margin-top: 10px;margin-bottom:10px;">
            Se encuentra ejerciendo Posesión en forma pacífica, pública y permanente 
            según declaración jurada del solicitante, encerrado dentro de los siguientes linderos
            <br>
        </div>
        
        <table >
            <tr>
                  <th>Linea Recta Izquierda</th>
                  <td>{{$sql[0]->g_lin_rec_izq}}</td>
                  <th>Por Izquierda con</th>
                  <td>{{$sql[0]->por_la_izquierda}}</td>
                </tr>
                <tr>
                  <th>Linea Recta Fondo</th>
                  <td>{{$sql[0]->g_lin_rec_fondo}}</td>
                  <th>Por el Fondo con</th>
                  <td>{{$sql[0]->por_el_fondo}}</td>
                </tr>
                <tr>
                  <th>Linea Recta Frente</th>
                  <td>{{$sql[0]->g_lin_rec_frent}}</td>
                  <th>Por el frente con</th>
                  <td>{{$sql[0]->por_el_frente}}</td>
                </tr>
                <tr>
                  <th>Linea Recta Derecha</th>
                  <td>{{$sql[0]->g_lin_rec_derecha}}</td>
                  <th>Por la Derecha con</th>
                  <td>{{$sql[0]->por_la_derecha}}</td>
                </tr>
                
        </table>
        <div style="width: 100%; text-align: justify; font-size: 1.0em; margin-top: 10px;margin-bottom:10px;">
            Se emite la presente constancia únicamente para el <b>OTORGAMIENTO DE LA FACTIBILIDAD DE SERVICIOS
            BASICOS</b> a que hace alusión el <b>TITULO III </b> de la ley 28687 Ley de Desarrollo y Complementación de
            Formalización de la Propiedad Informal, acceso al suelo y Dotación de Servicios.<b> D.S. N</b>°017-2006
            <b>VIVIENDA</b>VIVIENDA  que para el presente caso resulta de aplicación supletoria. Así como en mérito de los 
           siguientes informes, acta de posesión efectiva de predio mediante el cual de constato la ocupación 
           del predio materia del predio
            <br>
        </div>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-top: 10px;margin-bottom: 5px;">
            <thead>
              <tr>
                  <th style="width: 50%">Informe Nº/th>
                  <th style="width: 50%">Informe Nº</th>
                  
              </tr>
            </thead>
            <tbody>
                    <tr>
                        <td>
                            {{$parametros[0]->informe_base}}
                        </td> 
                        <td>
                            {{$sql[0]->nro_informe}}
                        </td> 
                    </tr>
            </tbody>
        </table>
        <div style="width: 100%; text-align: justify; font-size: 1.0em; margin-top: 10px;margin-bottom:10px;">
           
            Se deja expresa constancia, que la presente de expide a solicitud de la parte interesada y bajo
            amparo de imprevisto por los artículos 890° y siguientes del código civil, haciendo la salvedad 
            que el presente documento <b>NO CONSTITUYE RECOCNOCIMIENTO ALGUNO QUE AFECTE EL DERECHO DE PROPIEDAD 
            DEL TITULAR DEL PREDIO Y SOLO TIENE VALIDEZ PARA LOS TRAMITES QUE REALICE ANTE LAS ENTIDADES 
            PRESTADORAS DE LOS SERVICIOS BASICOS</b>. Luego el presente quedara sin efecto ni validez legal alguna
            <br>
            <br>
            <br>
            <b>“ESTE DOCUMENTO TIENE VALIDEZ POR SEIS MESES CONFORME A LA ORDENANZA MUNICIPAL N°380. MDCC DE FECHA
            27 DE MARZO DEL 2015 Y SOLO PARA EL TRAMITE DE LOS SERVICIOS BASICOS”</b>
        </div>
</body>

</html>