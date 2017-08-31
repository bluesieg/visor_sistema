

    function clicknewsector()
    {
        $("#dlg_nuevo_sector").dialog({
            autoOpen: false, modal: true, width: 1300, show: {effect: "fade", duration: 300}, resizable: false,
            title: "<div class='widget-header'><h4>.:  NUEVO SECTOR :.</h4></div>",
        });

        $("#dlg_nuevo_sector").dialog('open');
    }

