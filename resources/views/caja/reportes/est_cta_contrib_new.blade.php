<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Estado de Cta</title>    
        <link href="{{ asset('css/pdf.css') }}" rel="stylesheet">
        <style>        
            @page { margin-top: 40px !important;};
        </style>

    </head>    
    <body>
        <table border="0" cellspacing="0" cellpadding="0" style="margin-bottom: 5px;">
            <tr>
            <td style="width: 15%; border: 0px; font-size: 0.7em; text-align: center" >
                <img src="img/escudo.png" height="70px"/><br>
                Municipalidad Distrital de Cerro colorado
            </td>
            <td style="width: 70%; padding-top: 10px; border:0px;">
                <div id="details" class="clearfix">
                  <div id="invoice" >
                      <h1>ESTADO DE CUENTA CORRIENTE<BR>RESUMEN POR AÑO: {{$hasta}}</h1>
                  </div>
                </div>
            </td>
            <td style="width: 15%;border: 0px;">
                Fecha: {{date("d/m/Y")}}<br>
                Hora: {{date("h:i:s")}}<br>
            </td>
            </tr>
            
        </table>
        
        <div style="margin-top: 0px;">
            <!--<center><b>DATOS DEL CONTRIBUYENTE</b></center>-->
            <table style="font-size:14px;margin-top: 10px;">
                <tr>
                    <td colspan="2" style="border: 0px"><b>DATOS CONTRIBUYENTE</b></td>
                </tr>
                
                <tr>
                    <td style="border: 0px; width: 20%"><b>CODIGO:</b></td>
                    <td style="border: 0px">{{ $contrib[0]->id_persona}}<br/></td>
                </tr>
                
                <tr>
                    <td style="border: 0px"><b>CONTRIBUYENTE:</b></td>
                    <td style="border: 0px">{{ $contrib[0]->nro_doc}}- {{ $contrib[0]->contribuyente}}<br/></td>
                </tr>
                
                <tr>
                    <td style="border: 0px"><b>DOMICILIO FISCAL:</b></td>
                    <td style="border: 0px">{{ strtoUpper($contrib[0]->dom_fis)}}<br/></td>
                </tr>
                <tr>
                    <td style="border: 0px"><b>FECHA:</b></td>
                    <td style="border: 0px">{{ strtoupper($fecha_larga) }}<br/></td>
                </tr>
            </table>
        </div>
        
        <div style="margin-top: 10px;"> 
            <div><b>TRIUTO IMPUESTO PREDIAL </b></div>
            <table style="width: 100%;" class="t1">
                <thead>
                    <tr>
                        <th align="center" width="5%">Estado</th>
                        <th align="center" width="30%">OP/RD</th>
                        <th align="center" width="10%">Periodo</th>
                        <th align="center" width="10%">Insoluto</th>
                        <th align="center" width="10%">Der.Emisión</th>
                        <th align="center" width="10%">Reajuste</th>
                        <th align="center" width="10%">Interes</th>
                        <th align="center" width="10%">Beneficio</th>
                        <th align="center" width="10%">Total</th>
                    </tr>                                        
                </thead>
                <tbody>
                                                      
                </tbody>
            </table>
            @if(isset($convenio[0]))
                @if($convenio[0]->tipo==1 || $convenio[0]->tipo==3)
                    <div class="contenedor" style="left: 0px;top: 280px;height: 43px;"><center><h2 style="margin-top:6px">En Fraccionamiento</h2></center></div>
                @endif
            @endif
            
        </div>        
                     
        <script src="{{ asset('archivos_js/reportes/est_cta.js') }}"></script>
        <script src="{{ asset('js/libs/jquery-2.1.1.min.js') }}"></script>
        <script type="text/javascript">            
            $(document).ready(function() {
                
            });
        </script>
    </body>
</html>
