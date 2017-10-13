<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Fraccionamiento</title>
        <style>        
            @font-face {
                font-family: SourceSansPro;
                src: url(SourceSansPro-Regular.ttf);
            }
            footer { position: fixed; bottom: -20px; left: 0px; right: 0px; height: 70px; }
            .t1, .t2 { border-collapse: collapse; }
            .t1 > tbody > tr > td { border: 1px solid #D5D5D5; font-size: 13px}
            .t1 > thead > tr > th { border:1px solid #D5D5D5; background: #01A858;color: white; }            
        </style>
    </head>    
    <body>
        <img src="img/escudo.png" style="position:absolute;margin-top: 0px;margin-left: 12px; width: 55px;height: 60px;" >
        <center>
            <h3 style="color:#018F4B;margin-bottom:0px;font-size: 20px;">MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</h3>
            <div style="background:#01A858; margin-top: 20px;height: 1px"></div>
            <div>
                <h2 style="margin-bottom:10px;font-size: 20px;"><u>ESTADO DE CUENTA - FRACCIONAMIENTO</u></h2>                    
            </div>
        </center>
        
        <div style="margin-top: 20px;">
            <center><b>DATOS DEL CONTRIBUYENTE</b></center>
            <table style="font-size:14px;margin-top: 10px;">
                <tr>
                    <td><b>CODIGO:</b></td>
                    <td>{{ $contrib[0]->id_persona}}<br/></td>
                </tr>
                <tr>
                    <td><b>CONTRIBUYENTE:</b></td>
                    <td>{{ $contrib[0]->contribuyente}}<br/></td>
                </tr>
                <tr>
                    <td><b>DNI:</b></td>
                    <td>{{ $contrib[0]->nro_doc}}<br/></td>
                </tr>
                <tr>
                    <td><b>DOMICILIO FISCAL:</b></td>
                    <td>{{ $contrib[0]->dom_fis}}<br/></td>
                </tr>
                <tr>
                    <td><b>FECHA:</b></td>
                    <td>{{ strtoupper($fecha_larga) }}<br/></td>
                </tr>
            </table>
        </div>
        <div style="margin-top: 20px; ">
            <center><b>DATOS DEL FRACCIONAMIENTO</b></center>
            <table class="table table-sm" style="font-size:14px;margin-top: 10px;">
                <tr>
                    <td><b>PERIODO FRACCIONADO:</b></td>
                    <td>&nbsp;{{ $conv[0]->periodo}}<br/></td>
                </tr>
                <tr>
                    <td><b>POR CONCEPTOS DE:</b></td>
                    <td>&nbsp;DEUDA &nbsp;{{ $conv[0]->desc_tipo}}<br/></td>
                </tr>
                <tr>
                    <td><b>TIPO FRACCIONAMIENTO:</b></td>
                    <td>&nbsp;{{ $conv[0]->tip_fracc}}<br/></td>
                </tr>
                <tr>
                    <td><b>NRO. CONVENIO:</b></td>
                    <td>&nbsp;{{ $conv[0]->nro_conve2}}<br/></td>
                </tr>
                <tr>
                    <td><b>TOTAL:</b></td>
                    <td>&nbsp;S/.{{ $conv[0]->total_convenio}}<br/></td>
                </tr>
                <tr>
                    <td><b>INICIAL:</b></td>
                    <td>&nbsp;S/.{{ $conv[0]->cuota_inicial}} &nbsp;({{ $conv[0]->porc_cuo_inic}}%)<br/></td>
                </tr>
                <tr>
                    <td><b>TIF:</b></td>
                    <td>&nbsp;{{ $conv[0]->interes}}%<br/></td>
                </tr>
                <tr>
                    <td><b>N° CUOTAS APROBADAS:</b></td>
                    <td>&nbsp;{{ $conv[0]->nro_cuotas}}<br/></td>
                </tr>
                <tr>
                    <td><b>CUOTA CONSTANTE:</b></td>
                    <td>&nbsp;S/.{{ $fracc[0]->total }}<br/></td>
                </tr>                
            </table>
        </div>
                
       
        <div style="margin-top: 10px;" id="div_arb">
            <table style="width: 100%;" class="t1">
                <thead>
                    <tr>
                        <th align="center" width="5%">Nro</th>
                        <th align="center" width="20%">Fecha de Pago</th>                            
                        <th align="center" width="20%">Estado</th>
                        <th align="center" width="20%">Fecha que Pagó</th>
                        <th align="center" width="20%">Cuota Mensual</th>
                    </tr>                                        
                </thead>
                <tbody>                    
                    @foreach($fracc as $fracc)
                    <tr>                        
                        <td style="text-align: center">{{ $fracc->nro_cuota }}</td>
                        <td style="text-align: center">{{ $fracc->fec_pago }}</td>
                        <td style="text-align: center">{{ $fracc->estado }}</td>                            
                        <td style="text-align: center">{{ $fracc->fecha_q_pago }}</td>
                        <td style="text-align: center">S/.&nbsp;{{ number_format($fracc->total,2,'.',',') }}</td>
                    </tr>
                    @endforeach                    
                </tbody>
            </table>                
        </div>
    </body>
</html>
