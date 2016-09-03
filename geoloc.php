<?php
    require_once("class.denuncia.php");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Geolocation</title>
    <meta name="viewport" content="initial-scale=1.0, user-scalable=no">
    <meta charset="utf-8">
    <style>
      html, body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
      #map {
        height: 100%;
      }
    </style>
  </head>
  <body>
    <div id="map"></div>
    <script>
        
        
var labels = '';
var labelIndex = 0;
var map;

    
function initMap() {

    var myLatLng; //= {lat: -21.23765, lng: -50.40702};
    
    
    map = new google.maps.Map(document.getElementById('map'), {
    center: myLatLng,
    zoom: 15
  });
  //var infoWindow = new google.maps.InfoWindow({map: map});
        
    var marker = new google.maps.Marker({
        position: MostraPonto(),
        map: map,
        icon: 'img/marcador.png',
        title: 'Você está aqui.'
    });
    
   /* google.maps.event.addListener(map, 'click', function(event) {
        addMarker(event.latLng);
    });*/
    
        //addMarker(myLatLng, map);


  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };

        marker.setPosition(pos);
      //infoWindow.setContent('Você está aqui.');
        map.setCenter(pos);
        marker.setMap(map);
    }, function() {
      handleLocationError(true, marker, map.getCenter());
    });
  } else {
    handleLocationError(false, marker, map.getCenter());
  }
}
        
        
        
    function addMarker(location) {
      var marker = new google.maps.Marker({
          
        position: location,
        label: labels[labelIndex++ % labels.length],
        icon: 'img/mega.png',
        map: map
      });
}
        
        

google.maps.event.addDomListener(window, 'click', initMap);


function handleLocationError(browserHasGeolocation, marker, pos) {
  marker.setPosition(pos);
  marker.setContent(browserHasGeolocation ?
                        'Error: O serviço de geolocalização falhou.' :
                        'Error: O seu navegador não suporta o serviço de geolocalização.');
}
        
        function MostraPonto(){
            /*var latlng = {lat:  -21.23765, lng:-50.40702};
            
            latlng[0] = {lat:  -21.23765, lng:-50.40702};
            latlng[1] = {lat:  -21.22385, lng:-50.42796}
            latlng[2] = {lat:  -21.21328, lng:-50.43265}
            
            for(i=0; i<=2; i++){
                addMarker(latlng[i]); 
            }*/
           <?php 
                 $denLoc = new DENUNCIA();

                $resultado = $denLoc->retornaLoc();

                foreach($resultado as $result){ ?>
                   var latlng = {lat:  <?php echo $result['latitude']; ?>, lng: <?php echo $result['longitude']; ?>};
                    addMarker(latlng);
            
            <?php    }
            ?>
    }

            
                    
        
        
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDUd6nzucTwkmTv7SAk4qF7udfDUa641GY&signed_in=true&callback=initMap"
        async defer>
    </script>
  </body>
</html>