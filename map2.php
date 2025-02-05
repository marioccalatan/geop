<!DOCTYPE html>


<html>
<head>
<title>XYZ Example</title>
<link rel="stylesheet" href="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/css/ol.css">
</head>
<body>

<div id="map" class="map"></div>
<div id="popup" class="ol-popup">
    <a href="#" id="popup-closer" class="ol-popup-closer"></a>
<div id="popup-content"></div>
 </div>
<br>
<script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
<script>

var map = new ol.Map({
    target: 'map',
    layers: [
        new ol.layer.Tile({
            source: new ol.source.XYZ({
                url: 'https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}'
            })
        })
    ],
    view: new ol.View({
        center: ol.proj.fromLonLat([120.57307008, 16.4138815]),
        zoom: 15
    })
    
});
var waingMaw = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([97.4320373,25.3440388]))
      });

      var mandalay = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([96.0057831,21.9405043]))
      });

      var taunggyi = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([97.0337,20.7888]))
      });


      var yangon = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([96.0118912,16.9101877]))
      });

      var hsiPaw = new ol.Feature({
        geometry: new ol.geom.Point(ol.proj.fromLonLat([97.2906196,22.6239215]))
      });
      
      var vectorSource = new ol.source.Vector({
        features: [waingMaw, mandalay, taunggyi, yangon, hsiPaw]
      });

var mandalay2 = ol.proj.fromLonLat([96.0891,21.9588]);
var view = new ol.View({
  center: mandalay,
  zoom: 6// 5
});

var geometry2 = ([120.57307008, 16.4138815]);

var layer = new ol.layer.Vector({
     source: vectorSource     
 });
 
 var primary = new ol.layer.Image({
     source = new ol.source.ImageWMS({
         url: 'http://localhost:8080/geoserver/mario/wms',
         params:{'LAYERS':'mario:primary'},
         serverType: 'geoserver'
     });
 });

 
  map.addLayer(primary);

 
 map.addLayer(layer);
 
 var container = document.getElementById('popup');
 var content = document.getElementById('popup-content');
 var closer = document.getElementById('popup-closer');

 var overlay = new ol.Overlay({
     element: container,
     autoPan: true,
     autoPanAnimation: {
         duration: 250
     }
 });
 map.addOverlay(overlay);

 closer.onclick = function() {
     overlay.setPosition(undefined);
     closer.blur();
     return false;
 };
 
 map.on('singleclick', function (event) {
     if (map.hasFeatureAtPixel(event.pixel) === true) {
         var coordinate = event.coordinate;

         content.innerHTML = '<b>Hello world!</b><br />I am a popup.';
         overlay.setPosition(coordinate);
     } else {
         overlay.setPosition(undefined);
         closer.blur();
     }
 });

</script>
</body>
</html>