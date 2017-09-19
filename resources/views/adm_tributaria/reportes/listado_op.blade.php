<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Lista-OP</title>
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
                <h2 style="margin-bottom:10px;font-size: 20px;"><u>LISTADOD DE ORDENES DE PAGO (OP) ENVIADOS A COACTIVA</u></h2>                    
            </div>
        </center>
        
        <div style="margin-top: 20px;">
            <center><b>DATOS DEL CONTRIBUYENTE</b></center>
            <table style="font-size:14px;margin-top: 10px;">
                <tr>
                    <td><b>USUARIO:</b></td>
                    <td>{{ Auth::user()->ape_nom }}<br/></td>
                </tr>
                <tr>
                    <td><b>FECHA:</b></td>
                    <td>{{ $fecha_larga }}<br/></td>
                </tr>                
            </table>
        </div>        
        <div style="margin-top:10px;">         
            <table style="width: 100%;" id="t_dina_conve_fracc" class="t1">
                <thead>
                    <tr>
                        <th width="30%" align="center">Nro. Doc.</th>
                        <th width="25%" align="center">Fecha Envio</th>
                        <th width="20%" align="center">Hora</th>
                        <th width="80%" align="center">Contribuyente</th>
                        <th width="30%" align="center">Monto S/.</th>                        
                    </tr>
                </thead>
                <tbody>                
                    @foreach($op as $value)
                    <tr>
                        <td style="text-align: center">{{ $value->nro_fis }}</td>
                        <td style="text-align: center">{{ $value->fch_env }}</td>
                        <td style="text-align: center">{{ $value->hora_env }}</td>
                        <td style="text-align: left">{{ $value->contribuyente }}</td>
                        <td style="text-align: center">{{ $value->monto }}</td>                        
                    </tr>
                    @endforeach        
                </tbody>
            </table>            
        </div>
    
    
    </body>
</html>
