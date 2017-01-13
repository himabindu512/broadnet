<?
include 'common.php'; 
//print_r($_REQUEST);
//exit;
if(@$_REQUEST['submit'] == "Update") 
{
 $update_families = $db->update_sql ( " update institutions set
                                         
                                         coordinates              ='".$_REQUEST['coordinates']."'                                         
                                         where id     ='".$_REQUEST['id']."' ");
//$db->print_last_query();
echo 1;
                    exit;
}

    $row['coordinates'] = getValue('coordinates','institutions',$_GET['id']);
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

var coordinates = document.getElementById("coordinates");
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
    document.getElementById("coordinates").value = latlon;
    mylat = position.coords.latitude;
    mylong = position.coords.longitude;

    latlong = latlon.split(',');
    locations = [
    ['My location',parseFloat(latlong[0]),parseFloat(latlong[1]),1]
    ];
    $('#map').show();
    loadScript();
}

function showPosition(position) {
    <? if(@$row['coordinates']!='') {
        $latlong = explode(',',$row['coordinates']);
        $lat = $latlong[0];
        $long = $latlong[1];
        ?>
    var latlon = "<?=$row['coordinates']?>";
    document.getElementById("coordinates").value = latlon;
    mylat = "<?=$lat?>";
    mylong = "<?=$long?>";
    <?}else{?>
    var latlon = position.coords.latitude + "," + position.coords.longitude;
    document.getElementById("coordinates").value = latlon;
    mylat = position.coords.latitude;
    mylong = position.coords.longitude;
    <?}?>
    latlong = latlon.split(',');
    locations = [
    ['My location',parseFloat(latlong[0]),parseFloat(latlong[1]),1]
    ];
    $('#map').show();
    loadScript();
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

document.getElementById("coordinates").value = marker.getPosition().lat() + "," + marker.getPosition().lng();

                
            } else {
                alert('Error: Google Maps could not determine the address of this location.');
            }
        });
        map.panTo(marker.getPosition());
    });
    
    
    
    
      }

      function loadScript() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&' + 'callback=initialize';
        //document.body.appendChild(script);
        $('#mapscript').html(script);
      }

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            document.getElementById("coordinates").value = ""
            break;
        case error.POSITION_UNAVAILABLE:
            document.getElementById("coordinates").value = ""
            break;
        case error.TIMEOUT:
            document.getElementById("coordinates").value = ""
            break;
        case error.UNKNOWN_ERROR:
            document.getElementById("coordinates").value = ""
            break;
    }
}

getLocation();  
      //window.onload = loadScript;
      
      

function submit_coordinates_ajax(){
  var form = $('#update_institutions_coordinates');
  var coordinates = $('#update_institutions_coordinates #coordinates').val();
  var submit = $('#update_institutions_coordinates #submit').val();
  var todaydate = $('#todaydate').val();
    $.ajax({
      type: "POST",
      url: form.attr( 'action' )+'&coordinates='+coordinates+'&submit='+submit,
      //data: 'coordinates='+coordinates+'&submit='+submit,
      success: function( response ) {
          response = response.trim();
          //form[0].reset(); 
          //var formfeild = response.split("_");
      /*$.ajax({
       type: "POST",
       url: "ajax_startyourday.php",
       data: 'todaydate='+todaydate,
       cache: false,
       success: function(result){
           $('#tbody_startyourday').html(result);
           //form[0].reset(); 
           $('#cboxClose').click();
           $('.colorbox-image').colorbox();
            }
       });*/
       window.location.reload();
       
       
      },
      cache: false,
        contentType: false,
        processData: false
    });
}      
    </script>


<div class="wrapper" style="background-color: white;">
  <div class="box-title">
                            <h3>
                                <i class="icon-magic"></i>
                                Update Coordinates of Institute
                            </h3>
                        </div>  
<form method="POST" action="start_update_inst_map.php?id=<?=$_REQUEST['id']?>" name="update_institutions_coordinates" onsubmit="submit_coordinates_ajax();return false;" id="update_institutions_coordinates" class="form-vertical form-validate form-bordered"  >
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
<div id="map" class="input-block-level" style="height: 250px;"></div>
</div>
</div>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary" name="submit" id="submit" value="Update" >Update</button>
<button type="button" onclick="getMYLocation();" class="btn btn-primary">Get My Location</button>
</div>
</form>




</div>

<div id="mapscript"></div>
