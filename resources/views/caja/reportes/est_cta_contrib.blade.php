<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Estado de Cta</title>
        <style>        
            @font-face {
                font-family: SourceSansPro;
                src: url(SourceSansPro-Regular.ttf);
            }
            @page {
                size: 29.7cm 21cm;
                margin-top: 0.5cm;
                margin-bottom: 0.5cm;
                border: 1px solid blue;
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
                <h2 style="margin-bottom:10px;font-size: 20px;"><u>ESTADO DE CUENTA</u></h2>                    
            </div>
        </center>
        
        <div style="margin-top: 20px;">
            <!--<center><b>DATOS DEL CONTRIBUYENTE</b></center>-->
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
        <div style="margin-top: 20px;"> <center> PREDIAL Y FORMATOS</center></div>
        <div style="margin-top: 20px;">            
            <table style="width: 100%;" class="t1">
                <thead>
                    <tr>
                        <th align="center" width="5%">Año</th>
                        <th align="center" width="30%">Descripcion</th>
                        <th align="center" width="10%">Trim I</th>
                        <th align="center" width="10%">Abo I</th>
                        <th align="center" width="10%">Trim II</th>
                        <th align="center" width="10%">Abo II</th>
                        <th align="center" width="10%">Trim III</th>
                        <th align="center" width="10%">Abo III</th>
                        <th align="center" width="10%">Trim IV</th>
                        <th align="center" width="10%">Abo IV</th>
                        <th align="center" width="10%">Pago Tot</th>
                        <th align="center" width="10%">Deuda Tot</th>
                    </tr>                                        
                </thead>
                <tbody>
                    @foreach($pred as $pred)
                    <tr>                        
                        <td style="text-align: center">{{ $pred->ano_cta }}</td>
                        <td style="text-align: left">{{ $pred->descrip_tributo }}</td>
                        <td style="text-align: right">{{ $pred->car1_cta }}</td>
                        <td style="text-align: right">{{ number_format($pred->abo1_cta,2,'.',',') }}</td>
                        <td style="text-align: right">{{ $pred->car2_cta }}</td>
                        <td style="text-align: right">{{ number_format($pred->abo2_cta,2,'.',',') }}</td>
                        <td style="text-align: right">{{ $pred->car3_cta }}</td>
                        <td style="text-align: right">{{ number_format($pred->abo3_cta,2,'.',',') }}</td>
                        <td style="text-align: right">{{ $pred->car4_cta }}</td>
                        <td style="text-align: right">{{ number_format($pred->abo4_cta,2,'.',',') }}</td>
                        <td style="text-align: right">{{ $pred->ivpp }}</td>
                        <td style="text-align: right">{{ $pred->saldo }}</td>
                    </tr>
                    @endforeach                                     
                </tbody>
            </table>
        </div>
        <div style="margin-top: 20px;"> <center> ARBITRIOS</center></div>
        <div style="margin-top: 20px;">            
            <table style="width: 100%;" class="t1">
                <thead>
                    <tr>
                        <th align="center" width="5%">Año</th>
                        <th align="center" width="30%">Descripcion</th>
                        <th align="center" width="10%">Trim I</th>
                        <th align="center" width="10%">Abo I</th>
                        <th align="center" width="10%">Trim II</th>
                        <th align="center" width="10%">Abo II</th>
                        <th align="center" width="10%">Trim III</th>
                        <th align="center" width="10%">Abo III</th>
                        <th align="center" width="10%">Trim IV</th>
                        <th align="center" width="10%">Abo IV</th>
                        <th align="center" width="10%">Pago Tot</th>
                        <th align="center" width="10%">Deuda Tot</th>
                    </tr>                                        
                </thead>
                <tbody>                    
                    @foreach($arb as $arb)
                    <tr>                        
                        <td style="text-align: center">{{ $arb->anio }}</td>
                        <td style="text-align: left">{{ $arb->descripcion }}</td>
                        <td style="text-align: right">{{ $arb->trim_1 }}</td>
                        <td style="text-align: right">{{ number_format($arb->abo_trim_1,2,'.',',') }}</td>
                        <td style="text-align: right">{{ $arb->trim_2 }}</td>
                        <td style="text-align: right">{{ number_format($arb->abo_trim_2,2,'.',',') }}</td>
                        <td style="text-align: right">{{ $arb->trim_3 }}</td>
                        <td style="text-align: right">{{ number_format($arb->abo_trim_3,2,'.',',') }}</td>
                        <td style="text-align: right">{{ $arb->trim_4 }}</td>
                        <td style="text-align: right">{{ number_format($arb->abo_trim_4,2,'.',',') }}</td>
                        <td style="text-align: right">{{ $arb->ani_total }}</td>
                        <td style="text-align: right">{{ $arb->deuda_arb }}</td>
                    </tr>
                    @endforeach                    
                </tbody>
            </table>
        </div>
    
    
    <footer>
        <center>
        <div style="float: left;width: 45%; text-align: center;border-top: 1px solid #01A858">
            <p>MUNICIPALIDAD</p>
        </div>
        <div style="float: right;width: 45%; text-align: center;border-top: 1px solid #01A858">
            <p>{{ str_replace('-','',$contrib[0]->contribuyente)}}<br>DNI: {{ $contrib[0]->nro_doc}}</p>
        </div>
        </center>
    </footer>
    </body>
</html>
