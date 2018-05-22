<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Notificacion Verificacion Tecnica</title>
    <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
    <style>
        .move-ahead { counter-increment: page 2; position: absolute; visibility: hidden; }
        .pagenum:after { content:' ' counter(page); }
    </style>
</head>
<body>
<main>
    
    <center><div Class="asunto" style="margin-top: 100px;">
               <b>GERENCIA DE DESARROLLO URBANO Y CATASTRO DE LA MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</b>   
            </div></center>
       
        <div style="width: 100%; text-align: justify; font-size: 1.0em; margin-top: 10px;margin-bottom:10px;">
            @php echo $sql[0]->notificacion @endphp
        </div>

        

</body>

</html>