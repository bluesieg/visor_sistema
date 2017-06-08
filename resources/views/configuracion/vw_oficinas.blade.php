@extends('layouts.app')

@section('content')


<section id="widget-grid" class="">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="margin-bottom: -15px">
            <div class="well well-sm well-light">
                <h1 class="txt-color-green"><b>Listado de Oficinas...</b></h1>			
               
                                    
                <button id="btn_vw_oficinas_Editar" type="button" class="btn btn-labeled bg-color-blue txt-color-white">
                    <span class="btn-label"><i class="glyphicon glyphicon-pencil"></i></span>Editar
                </button>
              
            </div>                   
        </div>
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <table id="table_vw_oficinas"></table>
            <div id="pager_table_vw_oficinas"></div>
        </article>
    </div>
</section> 
        
        


<div id="dialog_open_list_oficinas" style="display: none">
    <table >
        
         <tr><td> <h1>Oficina...</h1> </td></tr> 
        
        <tr><td> Nombre de la Oficina : </td></tr>
            <tr><td>
                <input id="txt_nombre" type="text"   required="required" size="55"><p>
            </td>
        </tr>
   </table>
    
    
</div>
    


  @section('page-js-script')
<script type="text/javascript">
    global=0;
    $(document).ready(function() {
        jQuery("#table_vw_oficinas").jqGrid({        
            url: 'list_oficinas',
            datatype: 'json', mtype: 'GET',        
            autowidth: true, height: 'auto',
            colNames:['Codigo','Nombre de la Oficina','codigo Oficina '], 
            //rowNum: 11, sortname: 'pk_uit', sortorder: 'desc', viewrecords: true,
            rowNum: 10, sortname: 'id_ofi', sortorder: 'asc', viewrecords: true, caption: 'LISTADO DE OFICINAS',  align: "center",
            colModel:[ 
                {name:'id_ofi',index:'id_ofi', align:'center',width:'15%'}, 
            
                {name:'nombre',index:'anio'}, 
                 {name:'cod_oficina',index:'cod_oficina',  align:'center', hidden:true},
                
            ],        
            pager: '#pager_table_vw_oficinas',
            rowList: [11, 22],
            onSelectRow: function(Id){
                $('#btn_vw_oficinas_Editar').attr('onClick', 'open_dialog_nuevo_oficinas("'+'EDITAR'+'",'+Id+')');
           
            },
            ondblClickRow: function(Id){
                //ape=$("#table_vw_uit").getCell(Id,"anio");
                //alert(ape);
                //global=Id;
//                alert(global);
                
        //open_dialog_nuevo_uit();
                
                
            }
        });
        
        $(window).on('resize.jqGrid', function() {
                $("#table_vw_oficinas").jqGrid('setGridWidth', $("#content").width());
        });
    });
</script>
@stop  
    
    


<script src="{{ asset('archivos_js/configuracion/uit.js') }}"></script>




@endsection

