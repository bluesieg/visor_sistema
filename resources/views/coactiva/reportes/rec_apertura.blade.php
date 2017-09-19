<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>REC</title>
        <style>        
            @font-face {
                font-family: SourceSansPro;
                src: url(SourceSansPro-Regular.ttf);
            }
            @page {                
                margin: 180px 80px;
            }
            #header { position: fixed; left: 0px; top: -180px; right: 0px; height: 100px; text-align: center; }
            #footer { position: fixed; left: 0px; bottom: -180px; right: 0px; height: 100px; background-color: lightblue; }
            #footer .page:after { content: counter(page, upper-roman); }
            .t1, .t2 { border-collapse: collapse; }
            .t1 > tbody > tr > td { border: 1px solid #D5D5D5; font-size: 13px}
            .t1 > thead > tr > th { border:1px solid #D5D5D5; background: #01A858;color: white; }            
        </style>

    </head>    
    <body>
        <div id="header" style="padding-top:30px">            
            <img src="img/escudo.png" style="position:absolute;margin-top: 0px;margin-left: -10px; width: 55px;height: 65px;" >
            <center>
                <h3 style="color:#018F4B;margin-bottom:0px;font-size: 20px;">MUNICIPALIDAD DISTRITAL DE CERRO COLORADO</h3
                <h3 style="color:#018F4B;margin-top:0px;font-size: 20px;">Oficina de Ejecución Coactiva</h3>
                <div style="background:#01A858; margin-top: 0px;height: 1px"></div>           
            </center> 
        </div>
        <div style="margin-top: -40px;">
            <table style="font-size:15px;">
                <tr>
                    <td><b>Expediente N°</b></td>
                    <td>:&nbsp;0000134-2017<br/></td>
                </tr>
                <tr>
                    <td><b>Entidad</b></td>
                    <td>:&nbsp;Municipalidad Distrital de Cerro Colorado<br/></td>
                </tr>
                <tr>
                    <td><b>Obligado</b></td>
                    <td>:&nbsp;Velasquez Mamani Vladimiro Etdisson<br/></td>
                </tr>
                <tr>
                    <td><b>Materia</b></td>
                    <td>:&nbsp;Tributaria<br/></td>
                </tr>
                <tr>
                    <td><b>Domicilio</b></td>
                    <td>:&nbsp;La Libertad Mariano Melgar 101, Cerro Colorado - Arequipa<br/></td>
                </tr>
                <tr>
                    <td><b>Ubicacion de Predio</b></td>
                    <td>:&nbsp;La Libertad Mariano Melgar 101, Cerro Colorado - Arequipa<br/></td>
                </tr>
            </table>
            </div>
        <br>
        <div style="text-align:center"><b>RESOLUCIÓN DE EJECUCIÓN COACTIVA NRO. 001-2017 / OEC-MDCC</b></div><br>
        
        <div style="width: 100%; text-align: justify;font-size:15px;">           
            @php echo $plantilla @endphp
        </div>
    </body>
</html>
