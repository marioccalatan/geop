<!DOCTYPE html>
<html>
<head>
    <title>XYZ Example</title>

    <link rel="stylesheet" href="ol/v7.1.0/ol.css">
    <link rel="stylesheet" href="ol/ol-layerswitcher-master/dist/ol-layerswitcher.css">
    <script src="ol/v7.1.0/dist/ol.js"></script>
    <script src="https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v5.3.0/build/ol.js"></script>
    <script src="ol/ol-layerswitcher-master/dist/ol-layerswitcher.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@turf/turf@6/turf.min.js"></script>
    <script src="proj4/dist/proj4.js"></script>
    <script src="proj4/projs.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/proj4js/2.4.4/proj4.js" type="text/javascript"></script>
    
    
    
</head>
<body>
    
<div id="map" class="map"></div>



<script type="text/javascript">
    

  

    var view = new ol.View({
    projection: 'EPSG:4326',    
    center: [
        120.59436304, 16.41096274
    ],
    zoom: 12// 5
    });
    
    var OSM = new ol.layer.Tile({
        title: 'OSM',
        type: 'base',
        visible: 'true',
        source: new ol.source.OSM()
    });
    
    var Satellite = new ol.layer.Tile({
        title: 'Satellite',
        type: 'base',
        visible: 'true',
        source: new ol.source.XYZ({
                url: 'https://mt1.google.com/vt/lyrs=y&x={x}&y={y}&z={z}'
            })
    });
    
    var base_maps = new ol.layer.Group({
        title: 'Base Maps',
        layers: [OSM, Satellite]
    });
    
    
            
    
    var map = new ol.Map({
        target: 'map',
        view: view
    });
    
    var full_sc = new ol.control.FullScreen({
    label: 'F'
});
map.addControl(full_sc);
    
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
    
    var layerSwitcher = new ol.control.LayerSwitcher({
		activationMode: 'click',
		startActive: true,
		tipLbel: 'Layers',
		groupSelectstyle: 'children',
		collapseTipLabel: 'Collapse Layer'
	});
	map.addControl(layerSwitcher);
	layerSwitcher.renderPanel();
        
    var style_online = new ol.style.Style({   
        image: new ol.style.Icon({
            anchor: [0.5, 10],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: 'images/meter_online.png',
        })    
    });  
    var style_offline = new ol.style.Style({   
        image: new ol.style.Icon({
            anchor: [0.5, 10],
            anchorXUnits: 'fraction',
            anchorYUnits: 'pixels',
            src: 'images/meter_offline.png',
        })
        
    }); 
    
    var style_label = new ol.style.Style({   
        text: new ol.style.Text({
        font: '12px Calibri,sans-serif',
        fill: new ol.style.Fill({ color: '#000' }),
        stroke: new ol.style.Stroke({
          color: '#fff', width: 5
        }),
        text: 'BWD Pumping'
      })
    }); 
        



    
    var markerx = new ol.Feature({
       geometry: new ol.geom.Point([241971.57132163, 1820516.95804389]),
        type: 'park',
        name: 'test1'
    });
    
    var markery = new ol.Feature({
       geometry: new ol.geom.Point([120.60675716, 16.40754178]),
        type: 'park',
        name: 'test2'
    }); 
    
    var poly = new ol.Feature({
       geometry: new ol.geom.Polygon([[[120.60129279, 16.43270098],[120.61391425, 16.41403682],[120.59778683, 16.39141884],[120.56377902, 16.39705256],[120.60129279, 16.43270098]]]),
        type: 'park',
        name: 'test2'
    });

    <?php
include 'db_config/edmi.php';
$sql = "SELECT * FROM gis";
$result = $conn->query($sql);  
$turf='';
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) 
  {
    $turf = $turf. "turf.point([".$row['loc']."]), ";
   }
  
} else {
    echo "";
}
$conn->close();  
?>;   
    var points = turf.featureCollection([
     
<?php echo $turf;?>
  
]);


var hull = turf.convex(points);





//multiPolygonFeature = new ol.format.GeoJSON().readFeature(hull);
    

//ONLINE    
<?php
include 'db_config/edmi.php';
$sql = "SELECT * FROM maps WHERE DelayID=0";
$result = $conn->query($sql);  

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) 
  {
    echo "var online".$row['ID']." = new ol.Feature({";
    echo "geometry: new ol.geom.Point([".$row['loc']."])";
    echo "});";
   }
} else {
    echo "";
}

$conn->close();  
?>;

//OFFLINE
<?php
include 'db_config/edmi.php';
$sql = "SELECT * FROM maps WHERE DelayID>0";
$result = $conn->query($sql);  

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) 
  {
    echo "var offline".$row['ID']." = new ol.Feature({";
    echo "geometry: new ol.geom.Point([".$row['loc']."])";
    echo "});";
   }
} else {
    echo "";
}

$conn->close();  
?>;



//ONLINE    
    var vectorSource = new ol.source.Vector({
            features: [
<?php
include 'db_config/edmi.php';
$sql = "SELECT * FROM maps WHERE DelayID=0";
$result = $conn->query($sql);  
if ($result->num_rows > 0) {
    $online = '';
  while($row = $result->fetch_assoc()) 
  {
   $online = $online."online".$row['ID'].", ";   
    
  }
echo $online;  
} else {
  echo "";
};
?>

            ]
        });

//OFFLINE
   var vectorSource2 = new ol.source.Vector({
            features: [
 <?php
include 'db_config/edmi.php';
$sql = "SELECT * FROM maps WHERE DelayID>0";
$result = $conn->query($sql);  
if ($result->num_rows > 0) {
    $offline = '';
  while($row = $result->fetch_assoc()) 
  {
   $offline = $offline."offline".$row['ID'].", ";   
    
  }
  echo $offline;
} else {
  echo "";
}
?>
            ]
        });



  




  var vectorSource3 = new ol.source.Vector({
            features: (new ol.format.GeoJSON({
                defaultDataProjection: 'EPSG:32651',
                featureProjection: 'EPSG:4326'
            })).readFeatures(hull)
            
        }); 
        
    var vectorSource4 = new ol.source.Vector({
            features: [markerx],
            defaultDataProjection: 'EPSG:32651',
                featureProjection: 'EPSG:4326'
        });       
        
    
    
    var vectorLayer4 = new ol.layer.Vector({
        title: 'XXX',
        source: vectorSource4,
        style: style_offline
    });    



    var vectorLayer = new ol.layer.Vector({
        title: 'Online meters',
        source: vectorSource,
        style: style_online
    });
    var vectorLayer2 = new ol.layer.Vector({
        title: 'Offline meters',
        source: vectorSource2,
        style: style_offline
    });
    
    var vectorLayer3 = new ol.layer.Vector({
        title: 'Polygon',
        source: vectorSource3
    });

 var primary = new ol.layer.Tile({
     title: 'Primary',
     source: new ol.source.TileWMS({
         url: 'http://localhost:8080/geoserver/mario/wms',
         params:{'LAYERS':'mario:primary','TILED': true },
         serverType: 'geoserver'
     }),
     visible: false
     
 });
  var transformer = new ol.layer.Tile({
    title: 'Transformer', 
    source: new ol.source.TileWMS({
         url: 'http://localhost:8080/geoserver/beneco/wms',
         params:{'LAYERS':'beneco:transformer','TILED': true },
         serverType: 'geoserver'
     })
 });
   var consumer = new ol.layer.Tile({
     title: 'Consumer',
     source: new ol.source.TileWMS({
         url: 'http://localhost:8080/geoserver/beneco/wms',
         params:{'LAYERS':'beneco:consumer','TILED': true },
         serverType: 'geoserver'
     })
 });


 
 




    
    map.addLayer(base_maps);
    
    
    //overlays.getLayers().push(vectorLayer);
    

    map.addLayer(vectorLayer);
    map.addLayer(vectorLayer2);
    map.addLayer(vectorLayer3);
    map.addLayer(vectorLayer4);
    
     map.addLayer(primary);
     map.addLayer(transformer);
     map.addLayer(consumer);
    
<?php
include 'db_config/edmi.php';
$sql = "SELECT * FROM meter_details";
$result = $conn->query($sql);  
if ($result->num_rows > 0) {
    
  while($row = $result->fetch_assoc()) 
  {
 echo "var vectorLayer".$row["ID"]." = new ol.layer.Vector({";
 echo "source: new ol.source.Vector({features: [new ol.Feature({geometry: new ol.geom.Point([".$row['loc']."])})]}),style: new ol.style.Style({text: new ol.style.Text({font: '12px Calibri,sans-serif',fill: new ol.style.Fill({ color: '#000' }),stroke: new ol.style.Stroke({color: '#fff', width: 5}),";   
 echo "text: '".$row['Account_Name']."'})})});";
 echo "map.addLayer(vectorLayer".$row['ID'].");";
 }
} else {
  echo "0 results";
}

?>

 var overlays = new ol.layer.Group({
        title: 'Labels',
        layers: [
            
<?php
include 'db_config/edmi.php';
$sql = "SELECT * FROM meter_details";
$result = $conn->query($sql);  
if ($result->num_rows > 0) {
    $vectorLayer = '';
  while($row = $result->fetch_assoc()) 
  {
   $vectorLayer = $vectorLayer."vectorLayer".$row['ID'].", ";   
    
  }
} else {
  echo "0 results";
}
$mario = "marker2";
echo $vectorLayer
?>
        
        ]
    });
    
    map.addLayer(overlays);
 
       // var vectorLayer3 = new ol.layer.Vector({
       // source: new ol.source.Vector({features: [new ol.Feature({geometry: new ol.geom.Point([120.58292485, 16.45342808])})]}),style: new ol.style.Style({text: new ol.style.Text({font: '12px Calibri,sans-serif',fill: new ol.style.Fill({ color: '#000' }),stroke: new ol.style.Stroke({color: '#fff', width: 5}),
       // text: 'BWD Pumping'})})});
       // map.addLayer(vectorLayer3);
    
    
    
    layerSwitcher.renderPanel();
    
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
<?php echo $turf ?>
</body>
</html>