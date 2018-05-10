<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Notificacion Verificacion Administrativa</title>
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
        
        <div class="subasunto" style="text-align: left; padding-left: 30px; margin-top: 20px;">EXPEDIENTE Nº: {{$parametros->nro_exp}}</div>
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
                            {{$parametros->nro_doc_gestor}}
                        </td> 
                        <td>
                            {{$parametros->gestor}}
                        </td> 
                    </tr>
            </tbody>
        </table>

        <div style="width: 100%; text-align: justify; font-size: 1.0em; margin-top: 10px;margin-bottom:10px;">
            @php echo $sql->notificacion @endphp
        </div>

        

</body>

</html>