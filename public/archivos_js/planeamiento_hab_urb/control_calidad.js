function grilla_control_calidad(){
        fecha_desde_cc = $("#dlg_fecha_desde_cc").val();
        fecha_hasta_cc = $("#dlg_fecha_hasta_cc").val();
        alert(fecha_desde_cc);
        alert(fecha_hasta_cc);
        jQuery("#table_control_calidad").jqGrid({
            url: 'getExpedientes_ControlCalidad?fecha_desde='+fecha_desde_cc +'&fecha_hasta='+fecha_hasta_cc,
            datatype: 'json', mtype: 'GET',
            height: '280px', width: 1100,
            toolbarfilter: true,
            colNames: ['id_reg_exp', 'CODIGO EXPEDIENTE','GESTOR DEL TRAMITE','FECHA INICIO','FECHA REGISTRO','ESTADO'],
            rowNum: 200, sortname: 'id_reg_exp', sortorder: 'desc', viewrecords: true, caption: 'REGISTRO EXPEDIENTES', align: "center",
            colModel: [
                {name: 'id_reg_exp', index: 'id_reg_exp', hidden: true},
                {name: 'nro_expediente', index: 'nro_expediente', align: 'left', width: 20},
                {name: 'gestor', index: 'gestor', align: 'left', width: 40},
                {name: 'fecha_inicio_tramite', index: 'fecha_inicio_tramite', align: 'left', width: 20},
                {name: 'fecha_registro', index: 'fecha_registro', align: 'left', width: 15},
                {name: 'fase', index: 'fase', align: 'left', width: 15}
            ],
            pager: '#pager_table_cartas',
            rowList: [20, 50],
            gridComplete: function () {
                    var idarray = jQuery('#table_control_calidad').jqGrid('getDataIDs');
                    if (idarray.length > 0) {
                    var firstid = jQuery('#table_control_calidad').jqGrid('getDataIDs')[0];
                            $("#table_control_calidad").setSelection(firstid);    
                        }
                },
            ondblClickRow: function (Id){actualizar_exp();}
        });
}