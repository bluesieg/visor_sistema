<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Caja-Recibo</title>        
    </head>
    <style>        
        @page {
            margin:0;
            padding: 0;
        }
    </style>
    <body>

        <img src="img/recibo_caja.jpg" style="width: 100%;position: absolute;">              
        <div style="position: absolute;margin-top: 80px;margin-left: 640px; font-size: 20px;">
            N°.{{$recibo[0]->serie}}
        </div>
        <div style="position: absolute;margin-top: 90px;margin-left: 180px; font-size: 12px;">
            {{$recibo[0]->contribuyente}}
        </div>
        <div style="position: absolute;margin-top: 122px;margin-left: 180px; font-size: 12px;">
            {{$recibo[0]->usuario}}
        </div>
        <div style="position: absolute;margin-top: 138px;margin-left: 180px; font-size: 12px;">
            {{$recibo[0]->id_rec_mtr}}
        </div>
        <div style="position: absolute;margin-top: 138px;margin-left: 310px; font-size: 13px;">
            {{date('M d',strtotime($recibo[0]->fecha))}}
        </div>
        <div style="position: absolute;margin-top: 138px;margin-left: 590px; font-size: 13px;">
            {{$recibo[0]->serie}}
        </div>
        <div style="position: absolute;margin-top: 154px;margin-left: 180px; font-size: 13px;">
            {{$fecha_larga}}
        </div>
        <div style="width: 700px;position: absolute;margin-top: 181px;margin-left: 50px; font-size: 13px;">
            <table class="table table-sm" style="font-size:14px">
                <thead>
                    <tr>
                        <th style="width: 20px">Cant.</th>
                        <th style="width: 70px">Consepto</th>
                        <th style="width: 450px">Descripcion</th>
                        <th style="width: 60px" align="center">Prec.Unit</th>
                        <th style="width: 60px" align="center">Total</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($detalle as $det)
                    <tr>
                        <td align="center">{{number_format($det->cant,0)}}</td>
                        <td align="center">{{$det->concepto}}</td>
                        <td>{{$det->descrip_tributo}}</td>        
                        <td align="right">{{$det->p_unit}}</td>        
                        <td align="right">{{number_format($det->monto,2)}}</td>        
                    </tr>
                    @endforeach                    
                </tbody>
            </table>
        </div>
        <div style="position: absolute;margin-top: 249px;margin-left: 110px; font-size: 14px;">
            Son: &nbsp;{{$soles}}
        </div>
    </body>
</html>

<!--sd
{{$recibo[0]->id_rec_mtr}}<br>
                {{$recibo[0]->serie}}<br>
                {{$recibo[0]->hora_pago}}<br>
-->

