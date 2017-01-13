<?
include 'common.php'; 

if ( @$_POST ['submit'] == "Update") 
{
 $update_families = $db->update_sql ( " update institutions set
                                         
                                         coordinates              ='".$_POST['coordinates']."'                                         
                                         where id     ='".$_REQUEST['id']."' ");
print "<script language=JavaScript>";
        //print "window.opener.location.reload();";
        print "window.opener.focus();";
        print "this.close();";
        print "</script>";                                         
}

    $row['coordinates'] = getValue('coordinates','institutions',$_GET['id']);
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<!-- Apple devices fullscreen -->
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<!-- Apple devices fullscreen -->
	<meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
	
	<title>MedReps</title>

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- icheck -->
	<link rel="stylesheet" href="css/plugins/icheck/all.css">
	<!-- Theme CSS -->
	<link rel="stylesheet" href="css/style.css">
	<!-- Color CSS -->
	<link rel="stylesheet" href="css/themes.css">
<!-- dataTables -->
    <link rel="stylesheet" href="css/plugins/datatable/TableTools.css">

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	
	<!-- Nice Scroll -->
	<script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
	<!-- Validation -->
	<script src="js/plugins/validation/jquery.validate.min.js"></script>
	<script src="js/plugins/validation/additional-methods.min.js"></script>
	<!-- icheck -->
	<script src="js/plugins/icheck/jquery.icheck.min.js"></script>
    
    <script src="js/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="js/plugins/datatable/TableTools.min.js"></script>
    <script src="js/plugins/datatable/ColReorder.min.js"></script>
    <script src="js/plugins/datatable/ColVis.min.js"></script>
    <script src="js/plugins/datatable/jquery.dataTables.columnFilter.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<script src="js/eakroko.js"></script>

	<!--[if lte IE 9]>
		<script src="js/plugins/placeholder/jquery.placeholder.min.js"></script>
		<script>
			$(document).ready(function() {
				$('input, textarea').placeholder();
			});
		</script>
	<![endif]-->
	

	<!-- Favicon -->
	<link rel="shortcut icon" href="img/favicon.ico" />
	<!-- Apple devices Homescreen icon -->
	<link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

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
</style>
    
    
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>
<script>

var coordinates = '<?=$row['coordinates']?>';
var locations;

//alert(coordinates);
latlong = coordinates.split(',');
    locations = [
    ['My location',parseFloat(latlong[0]),parseFloat(latlong[1]),1]
    ];
var mylat=parseFloat(latlong[0]);
var mylong=parseFloat(latlong[1]);
    
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
    $("#coordinates").val(latlon);
    mylat = position.coords.latitude;
    mylong = position.coords.longitude;

    latlong = latlon.split(',');
    locations = [
    ['My location',parseFloat(latlong[0]),parseFloat(latlong[1]),1]
    ];
    $('#map').show();
    google.maps.event.addDomListener(window, 'load', initialize);
}

function showPosition(position) {
    <? if(@$row['coordinates']!='') {
        $latlong = explode(',',$row['coordinates']);
        $lat = $latlong[0];
        $long = $latlong[1];
        ?>
    var latlon = "<?=$row['coordinates']?>";
    $("#coordinates").val(latlon);
    mylat = "<?=$lat?>";
    mylong = "<?=$long?>";
    <?}else{?>
    var latlon = position.coords.latitude + "," + position.coords.longitude;
    $("#coordinates").val(latlon);
    mylat = position.coords.latitude;
    mylong = position.coords.longitude;
    <?}?>
    latlong = latlon.split(',');
    locations = [
    ['My location',parseFloat(latlong[0]),parseFloat(latlong[1]),1]
    ];
    $('#map').show();
    google.maps.event.addDomListener(window, 'load', initialize);
}

function initialize() {
          /*var locations = [
      ['DESCRIPTION', 41.926979,12.517385, 3],
      ['DESCRIPTION', 41.914873,12.506486, 2],
      ['DESCRIPTION', 41.918574,12.507201, 1]
    ];*/
    
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
        draggable: true,
        map: map
      });

      google.maps.event.addListener(marker, 'click', (function(marker, i) {
        return function() {
          infowindow.setContent(locations[i][0]);
          infowindow.open(map, marker);
        }
      })(marker, i));
    }
    
    
    
    geocoder = new google.maps.Geocoder();
    
    //Update postal address when the marker is dragged
    google.maps.event.addListener(marker, 'dragend', function() {
        geocoder.geocode({latLng: marker.getPosition()}, function(responses) {
            //console.log(responses);
            if (responses && responses.length > 0) {

            $("#coordinates").val(marker.getPosition().lat() + "," + marker.getPosition().lng());

                
            } else {
                alert('Error: Google Maps could not determine the address of this location.');
            }
        });
        map.panTo(marker.getPosition());
    });
    
    
    
    
      }
google.maps.event.addDomListener(window, 'load', initialize);
      function loadScript() {
        /*var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&' + 'callback=initialize';
        //document.body.appendChild(script);
        $('#mapscript').html(script);*/
      }

function showError(error) {
    /*switch(error.code) {
        case error.PERMISSION_DENIED:
            document.getElementById("coordinates").value = "User denied the request for Geolocation."
            break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("coordinates").value = "Location information is unavailable."
            break;
        case error.TIMEOUT:
            document.getElementById("coordinates").value = "The request to get user location timed out."
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("coordinates").value = "An unknown error occurred."
            break;
    }*/
}

getLocation();  
      //window.onload = loadScript;
    </script>


</head>

<body style="max-width: 600px;width: 100%;">
	<div class="wrapper">
      <div class="box-title">
                                <h3>
                                    <i class="icon-magic"></i>
                                    Update Coordinates of Institute
                                </h3>
                            </div>  
	<form method="POST" name="institutions" id="institutions" class="form-vertical form-validate form-bordered"  enctype="multipart/form-data">
    <div class="row-fluid">
<div class="span12">
<div class="control-group">
<label for="textfield" class="control-label">Coordinates</label>
<div class="controls">
<input type="text" name="coordinates"  id="coordinates" placeholder="latitude,longitude" class="input-block-level" value="<? if(@$row['coordinates']!='') echo $row['coordinates']; ?>">
</div>
</div>
</div>

</div>



<div class="row-fluid">
<div class="span12">
<div class="control-group">
<label for="textfield" class="control-label">Map</label>
<div class="controls">
    <div id="map" class="input-block-level" style="height: 300px;"></div>
</div>
</div>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary" name="submit" value="Update" >Update</button>
<button type="button" onclick="getMYLocation();" class="btn btn-primary">Get My Location</button>
</div>
</form>
    
    

    
	</div>
	
</body>

</html>
<div id="mapscript"></div>
