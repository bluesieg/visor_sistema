function load_list_UIT(){
  // alert(5);
    jQuery("#table_vw_uit").jqGrid({ 
        
        url: 'list_uit',
        datatype: 'json', mtype: 'GET',        
        autowidth: true, height: 'auto',
        
        colNames:['pk_uit','Año','UIT','Uit Alcab %','Tasa Alcab','Formatos','% Min Ivpp','% Min O Inst'], 
        rowNum: 11, sortname: 'pk_uit', sortorder: 'desc', viewrecords: true,
        colModel:[ 
            {name:'pk_uit',index:'pk_uit', hidden:true}, 
            {name:'anio',index:'anio', align:'center'}, 
            {name:'uit',index:'uit', align:'center'},
            {name:'uit_alc',index:'uit_alc', align:'center'},
            {name:'tas_alc',index:'uit_alc', align:'center'},
            {name:'formatos',index:'formatos', align:'center'},
            {name:'porc_min_ivpp',index:'porc_min_ivpp', align:'center'},
            {name:'porc_ot_ins',index:'porc_ot_ins',  align:'center'},
        ],        
        pager: '#pager_table_vw_uit',
        rowList: [11, 22],        
        
        onSelectRow: function(Id){
            
        },
        
        ondblClickRow: function(Id){
//            ape=$("#table_vw_uit").getCell(Id,"pk_uit");
//            alert(ape);
            
            //ele=document.getElementById('#btn_editar');
            //ele.addEventListener('click',open_dialog_nuevo_uit(Id));
            
//                boton = document.getElementById('#btn_editar');
//                boton.addEventListener('click', function(Id){
//                open_dialog_nuevo_uit();
//                        alert('Hola!');
//                        }, false);
            
            
        }
    });
    
    $(window).on('resize.jqGrid',function(){
        $("#table_vw_uit").jqGrid('setGridWidth',$("#content").width());
    });
}

function open_tabla(){
    load_list_UIT();
}

function open_dialog_nuevo_uit(tipe,Id)
{
    
    $("#dialog_open_list_uit").dialog({
        autoOpen: false, modal: true, height: 370, width: 480, show: { effect: "fade", duration: 300 },resizable : false,
        //title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Ingresar Datos Datos</h4></div>",
        title: "<div class='widget-header'><h4><i class='fa fa-user'></i>&nbsp.: " + tipe + " USUARIO :.</h4></div>",
        buttons : [{
                html : "<i class='fa fa-trash-o'></i>&nbsp; Guardar",
                "class" : "btn btn-primary bg-color-green",
                click : function() {
                 //$(this).dialog("close");
                 if(tipe=='NUEVO'){
                           guardar_uit();
                           $(this).dialog("close");
                       }
                  
                  if(tipe=='EDITAR'){
                      modificar_uit(Id);
                      $(this).dialog("close");
                  }
                  
                  recargar_iut();
                    
                }
        }, {
                html : "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class" : "btn btn-primary bg-color-green",
                click : function() {
                    $(this).dialog("close");
                }
        }]
    }).dialog('open');
    
   
   if(tipe=='NUEVO'){
           // alert(tipe+ '---'+ Id);
        }else{
//            ape_nom = $.trim($("#table_Usuarios").getCell(Id, "ape_nom"));
            //$("#txt_ape_nom").val($.trim($("#table_Usuarios").getCell(Id, "ape_nom")));
            
            $("#txt_anio").val($.trim($("#table_vw_uit").getCell(Id, "anio")));
            $("#txt_uit").val($.trim($("#table_vw_uit").getCell(Id, "uit")));
            $("#txt_uit_alc").val($.trim($("#table_vw_uit").getCell(Id, "uit_alc")));
            $("#txt_tas_alc").val($.trim($("#table_vw_uit").getCell(Id, "tas_alc")));
            $("#txt_formatos").val($.trim($("#table_vw_uit").getCell(Id, "formatos")));
            $("#txt_15uit").val($.trim($("#table_vw_uit").getCell(Id, "deoa15")));
            $("#txt_60uit").val($.trim($("#table_vw_uit").getCell(Id, "de15a60")));
            $("#txt_60mas").val($.trim($("#table_vw_uit").getCell(Id, "mas60")));
            $("#txt_min_ivpp").val($.trim($("#table_vw_uit").getCell(Id, "porc_min_ivpp")));
            $("#txt_ot_ins").val($.trim($("#table_vw_uit").getCell(Id, "porc_ot_ins")));
            
        }
   

}


function open_dialog_nuevo_oficinas(tipe,Id)
{
    
    $("#dialog_open_list_oficinas").dialog({
        autoOpen: false, modal: true, height: 250, width: 440, show: { effect: "fade", duration: 300 },resizable : false,
        //title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Ingresar Datos Datos</h4></div>",
        title: "<div class='widget-header'><h4><i class='fa fa-user'></i>&nbsp.: " + tipe + " Oficina :.</h4></div>",
        buttons : [{
                html : "<i class='fa fa-trash-o'></i>&nbsp; Guardar",
                "class" : "btn btn-primary bg-color-green",
                click : function() {
                 //$(this).dialog("close");
                
                      //modificar_uit(Id);
                      modificar_oficina(Id);
                      $(this).dialog("close");
                      recargar_oficinas();
                  
                    
                }
        }, {
                html : "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class" : "btn btn-primary bg-color-green",
                click : function() {
                    $(this).dialog("close");
                }
        }]
    }).dialog('open');
    
   
   
           
            $("#txt_nombre").val($.trim($("#table_vw_oficinas").getCell(Id, "nombre")));
            
            
        
   

}





function guardar_uit() {
 
    v_anio = $("#txt_anio").val();
    v_uit = $("#txt_uit").val();
    v_uit_alc= $("#txt_uit_alc").val();
    v_tas_alc = $("#txt_tas_alc").val();
    v_formatos=  $("#txt_formatos").val();
    v_base_01=0;
    v_deoa15=$("#txt_15uit").val();
    v_tram_01= 0;
    v_base_02=0;
    v_de15a60=$("#txt_60uit").val();
    v_tram_02=0;
    v_base_03=0;
    v_mas60= $("#txt_60mas").val();
    v_porc_min_ivpp= $("#txt_min_ivpp").val();
    v_porc_ot_ins=$("#txt_ot_ins").val();
    
    

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url: 'uit_save',
        data: {anio: v_anio,uit:v_uit,uit_alc:v_uit_alc,tas_alc:v_tas_alc,formatos:v_formatos,base_01:v_base_01,deoa15:v_deoa15,tram_01:v_tram_01,base_02:v_base_02,de15a60:v_de15a60,tram_02:v_tram_02,base_03:v_base_03,mas60:v_mas60,porc_min_ivpp:v_porc_min_ivpp,porc_ot_ins:v_porc_ot_ins},
        success: function (data) {
            if (data.msg == 'si') {
                alert('datos guardados corecctamente');
            } else
            {
                alert('error');

            }

        }, error: function (data) {
            alert('error conexion');
        }
    });
}

function modificar_uit(Id) {
    
//   v_pk_uit=Id;
    v_anio = $("#txt_anio").val();
    v_uit = $("#txt_uit").val();
    v_uit_alc= $("#txt_uit_alc").val();
    v_tas_alc = $("#txt_tas_alc").val();
    v_formatos=  $("#txt_formatos").val();
    v_base_01=0;
    v_deoa15=$("#txt_15uit").val();
    v_tram_01= 0;
    v_base_02=0;
    v_de15a60=$("#txt_60uit").val();
    v_tram_02=0;
    v_base_03=0;
    v_mas60= $("#txt_60mas").val();
    v_porc_min_ivpp= $("#txt_min_ivpp").val();
    v_porc_ot_ins=$("#txt_ot_ins").val();
    
    

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url: 'uit_mod',
        data: {pk_uit: Id,anio: v_anio,uit:v_uit,uit_alc:v_uit_alc,tas_alc:v_tas_alc,formatos:v_formatos,base_01:v_base_01,deoa15:v_deoa15,tram_01:v_tram_01,base_02:v_base_02,de15a60:v_de15a60,tram_02:v_tram_02,base_03:v_base_03,mas60:v_mas60,porc_min_ivpp:v_porc_min_ivpp,porc_ot_ins:v_porc_ot_ins},
        success: function (data) {
            if (data.msg == 'si') {
                alert('datos guardados corecctamente');
            } else
            {
                alert('error');

            }

        }, error: function (data) {
            alert('error conexion');
        }
    });
    
    
       
    
  
}


function modificar_oficina(Id) {
    
//   v_pk_uit=Id;
    v_nombre = $("#txt_nombre").val();
   
    

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url: 'oficinas_mod',
        data: {id_ofi: Id,nombre: v_nombre,cod_oficina:Id},
        success: function (data) {
            if (data.msg == 'si') {
                alert('datos guardados corecctamente');
            } else
            {
                alert('error');

            }

        }, error: function (data) {
            alert('error conexion');
        }
    });
    
    
       
    
  
}





function open_dialog_quitar_uit(Id)
    {
        
            $("#dialog_open_msg_eliminar").dialog({
        autoOpen: false, modal: true, height: 200, width: 300, show: { effect: "fade", duration: 300 },resizable : false,
        //title : "<div class='widget-header'><h4><i class='fa fa-warning'></i> Ingresar Datos Datos</h4></div>",
        title: "<div class='widget-header'><h4><i class='fa fa-user'></i>&nbsp.: ELIMINAR USUARIO</h4></div>",
        buttons : [{
                html : "<i class='fa fa-trash-o'></i>&nbsp; Eliminar",
                "class" : "btn btn-primary bg-color-green",
                click : function() {
                 //$(this).dialog("close");
              quitar_uit(Id);
              $(this).dialog("close");
              recargar_iut();
                    
                }
        }, {
                html : "<i class='fa fa-sign-out'></i>&nbsp; Salir",
                "class" : "btn btn-primary bg-color-green",
                click : function() {
                    $(this).dialog("close");
                }
        }]
    }).dialog('open');
        
    }


function quitar_uit(Id) {
    
//   v_pk_uit=Id;
        

    $.ajax({
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        type: 'POST',
        url: 'uit_quitar',
        data: {pk_uit: Id},
        success: function (data) {
            if (data.msg == 'si') {
                alert('datos guardados corecctamente');
            } else
            {
                alert('error');

            }

        }, error: function (data) {
            alert('error conexion');
        }
    });
    
    
       
    
  
}

function recargar_iut(){    
    jQuery("#table_vw_uit").jqGrid('setGridParam', {
        url: 'list_uit'
    }).trigger('reloadGrid');    
}

function recargar_oficinas(){    
    jQuery("#table_vw_oficinas").jqGrid('setGridParam', {
        url: 'list_oficinas'
    }).trigger('reloadGrid');    
}