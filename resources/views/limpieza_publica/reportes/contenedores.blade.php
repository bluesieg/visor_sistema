<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>REPORTE DE CONTENEDORES</title>
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
                    REPORTE CONTENEDORES
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
                <th style="width: 60%">UBICACION</th>
                <th style="width: 10%">CANTIDAD</th>
                <th style="width: 20%">ESTADO</th>
                
            </tr>
            </thead>
            <tbody>

            @foreach ($sql as $sql)
            @if($sql->codigo)
                <tr>
                    <td style="text-align: left;">{{ trim($sql->codigo) }}</td>
                    <td style="text-align: left;">{{trim($sql->ubicacion)}}</td>
                    <td style="text-align: left;">{{trim($sql->cantidad)}}</td>
                    <td style="text-align: left;">
                        @if($sql->estado==1)
                            BUENO
                        @endif
                        @if($sql->estado==2)
                            REGULAR
                        @endif
                        @if($sql->estado==3)
                            MALO
                        @endif
                    </td>
                </tr>
                <?php $personal =DB::connection('gerencia_catastro')->table('limpieza_publica.observaciones_contenedores')->where('id_contenedor',$sql->id)->get(); ?>
                @if(count($personal)>0)
                    <tr>
                        <td style="border:0px"></td>
                        <th style="text-align: center;" colspan="3" >OBSERVACIONES</th>
                    </tr>
                    @foreach($personal as $per)
                    <tr>
                        <td style="border:0px"></td>
                        <td style="text-align: left;" colspan="3">{{ trim($per->observacion)}}</td>
                    </tr>
                    @endforeach
                @endif
                @endif
            @endforeach
           
            </tbody>
        </table>
    </div>
        
       

        
        
    </body>

</html>