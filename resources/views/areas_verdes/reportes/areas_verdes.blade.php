<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>REPORTE DE AREAS VERDES</title>
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
    <style>
        .move-ahead { counter-increment: page 2; position: absolute; visibility: hidden; }
        .pagenum:after { content:' ' counter(page); }
       .footer {position: fixed }

    </style>
</head>
    <footer class="footer" style="font-size:0.8em; text-align: left; padding-top: 5px; padding-left: 10px;"><b> </b></footer>

<body>
    <main>
         <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 0px;">
        <tr>
            <td style="width: 10%; border: 0px;" >
                <img src="img/escudo.png" height="60px"/>
            </td>
            <td style="width: 80%; padding-top: 0px; border:0px;">
                <div id="details" class="sub2">
                    <div id="invoice" style="font-size:0.7em" >
                        <h1>MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</h1>
                        <div class="sub2">Creado por Ley 12075 el día 26 de Febrero de 1954</div>
                    </div>
                    <div  style="width: 95%; border-top:1px solid #999; margin-top: 5px; margin-left: 25px"></div>
                </div>
            </td>
            <td style="width: 10%;border: 0px;"></td>
        </tr>

    </table>
    <center>
            <div Class="asunto" style="margin-top: 1px;font-size:0.8em;">
                <b>
                    REPORTE DE AREAS VERDES
                </b>
            </div>
        </center>
        <div class="subasunto" style=" margin-bottom:1px; text-align: left; padding-left: 30px;font-size:0.7em;">
        <h5 class="subasunto" style="font-size:0.8em;  text-align: right; padding-left: 30px;">{{ date("d/m/Y") }}</h5>
    </div>
        <div class="lado3" style=" margin-top: 5px;">
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom:20px; margin-top: 0px;  font-size: 1.0em;">
            <thead>
            <tr >
                <th style="width: 10%;">CODIGO</th>
                <th style="width: 70%">UBICACION</th>
                <th style="width: 20%">COD. CAT.</th>
                
            </tr>
            </thead>
            <tbody>

            @foreach ($sql as $sql)
            @if($sql->codigo)
                <tr>
                    <td style="text-align: left;">{{ trim($sql->codigo) }}</td>
                    <td style="text-align: left;">{{trim($sql->ubicacion)}}</td>
                    <td style="text-align: left;">
                <?php $lote =DB::connection('pgsql')->table('catastro.vw_lotes')->where("id_lote",$sql->id_lote )->get(); ?>
                        @foreach($lote as $lot)
                           {{$lot->sector.$lot->codi_mzna.$lot->codi_lote}}
                        @endforeach
                    </td>
                </tr>
                
                @endif
            @endforeach
           
            </tbody>
        </table>
    </div>
        
       

        
        
    </body>

</html>