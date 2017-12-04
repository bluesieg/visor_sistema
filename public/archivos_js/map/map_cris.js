



map.on('singleclick', function(evt) {
   var fl = map.forEachFeatureAtPixel(evt.pixel, function (feature, layer) {
        alert(feature.get('gid')+" "+feature.get('layer')+" "+feature.get('text'));
        
    });
});

var layerSwitcher = new ol.control.LayerSwitcher({
    tipLabel: 'Légende' // Optional label for button
});
map.addControl(layerSwitcher);