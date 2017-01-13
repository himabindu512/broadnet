<?
include 'common.php'; 
//print_r($_REQUEST);
//exit;
$_REQUEST['name'] = str_replace(',', ' ',getValue('name','institutions',$_GET['id']));
$_REQUEST['latlong'] = getValue('coordinates','institutions',$_GET['id']);
?>

<style type="text/css">
@media (max-width: 768px) {
.control-group {
    border-bottom: 0 solid #ddd;
    padding: 0 10px !important;
    margin-bottom: 0px !important;
}
button.close{padding-right: 10px !important;}
.modal{
    position: fixed;
    top: 20px;
    right: 20px;
    left: 20px;
    width: 93%;
    margin: 0;
  } 
}
.form-vertical.form-bordered .control-group {
    border-bottom: 0px solid #ddd;
    padding: 10px 20px;
}
.pickers{
 float: right;
 margin-top: -35px; 
 position: relative;
 margin-right: 5px;  
}
label{font-weight: bold;}h3{background-color: #368ee0;color: white;}#cboxLoadedContent{background: white;}#cboxTitle{display: none !important}
#cboxOverlay {background: none repeat scroll 0 0 #000;}
</style>
    
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>
<script>

var instid = '<?=$_REQUEST['id']?>';
var instname = '<?=$_REQUEST['name']?>';
var instcordinates = '<?=$_REQUEST['latlong']?>';
var tag = '<?=$_REQUEST['tag']?>';
var thisobject = '<?=$_REQUEST['thisobject']?>';


var locations;
var mylat;
var mylong;

function getLocation() {
    //showPosition("0");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        //coordinates.value = "33.8833,35.5000";
        //showPosition("0");
    }
}
function getMYLocation() {
    //showPosition("0");
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showMYPosition, showError);
    } else {
        //coordinates.value = "33.8833,35.5000";
        //showPosition("0");
    }
}

function showMYPosition(position) {

    var latlon = position.coords.latitude + "," + position.coords.longitude;
   
    $('#startLat').val(position.coords.latitude);
    $('#startLon').val(position.coords.longitude);
    
    latlong = latlon.split(',');
    
    latlong2 = instcordinates.split(',');
    
    locations = [
    ['My location',parseFloat(latlong[0]),parseFloat(latlong[1]),1,'purple'],
    [instname,parseFloat(latlong2[0]),parseFloat(latlong2[1]),2,'red']
    ];
    
    $('#map').show();
    loadScript();
}

function showPosition(position) {
    
    var latlon = position.coords.latitude + "," + position.coords.longitude;
   
    $('#startLat').val(position.coords.latitude);
    $('#startLon').val(position.coords.longitude);
    
    latlong = latlon.split(',');
    
    latlong2 = instcordinates.split(',');
    
    locations = [
    ['My location',parseFloat(latlong[0]),parseFloat(latlong[1]),1,'purple'],
    [instname,parseFloat(latlong2[0]),parseFloat(latlong2[1]),2,'red']
    ];
    $('#map').show();
    loadScript();
}

function initialize() {
          
    var map = new google.maps.Map(document.getElementById('map'), {
      zoom: 13,
      center: new google.maps.LatLng(mylat,mylong), 
      mapTypeId: google.maps.MapTypeId.ROADMAP,
        streetViewControl: false,
        panControl: false,
        mapTypeControl: true,
        mapTypeControlOptions: {
            style: google.maps.MapTypeControlStyle.HORIZONTAL_BAR,
            position: google.maps.ControlPosition.BOTTOM_CENTER
        },
        zoomControl: true,
        zoomControlOptions: {
            style: google.maps.ZoomControlStyle.SMALL,
            position: google.maps.ControlPosition.LEFT_CENTER
        }
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
        animation: google.maps.Animation.DROP,
        draggable: false,
        icon: '<?=$site_url?>img/'+locations[i][4]+'-dot.png',
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    
    
    
    
    
      }

      function loadScript() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&' + 'callback=initialize';
        //document.body.appendChild(script);
        $('#mapscript').html(script);
      }

function showError(error) {

}

getLocation();  
      //window.onload = loadScript;
      
          
    </script>


<div class="wrapper" style="background-color: white;">

<div class="box-title"><h3><i class="icon-magic"></i>Check Current Location</h3></div>  

<form method="POST" name="update_institutions_coordinates" onsubmit="return false;" id="update_institutions_coordinates" class="form-vertical form-validate form-bordered"  >

<div class="row-fluid">
<div class="span12">
<div class="control-group">
<label for="textfield" class="control-label">Map</label>
<div class="controls">
<div id="map" class="input-block-level" style="height: 250px;"></div>
</div>
</div>
</div>
</div>

<div class="form-actions">
<button type="button" class="btn btn-primary" name="submit" id="submit" onclick="select_tagging(instid,instname,instcordinates,tag,thisobject,0);$('#cboxClose').click();return false;" value="Tag" >Tag</button>

<button type="button" onclick="$('#cboxClose').click();" class="btn btn-primary">Cancel</button>

<button type="button" onclick="getMYLocation();" class="btn btn-primary">Get My Location</button>
</div>
</form>




</div>

<div id="mapscript"></div>
