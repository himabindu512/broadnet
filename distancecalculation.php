<?
include 'common.php'; 
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
    
    
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=true&libraries=geometry"></script>
<script>
//var p1 = new google.maps.LatLng(18.385044,78.4871);
//var p2 = new google.maps.LatLng(17.385044,78.48665);

//alert(calcDistance(p1, p2));

//calculates distance between two points in km's
function calcDistance(p1, p2){
    //alert(p1); 
    //alert(p2); 
    
  return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2) / 1000).toFixed(2);
}

var locations;
var mylat;
var mylong;

window.onload = function() {
  var startPos;
  var geoSuccess = function(position) {
    startPos = position;
    //alert(startPos.coords.latitude);
    
    document.getElementById('startLat').value = startPos.coords.latitude;
    document.getElementById('startLon').value = startPos.coords.longitude;
    
    mylat = startPos.coords.latitude;
    mylong = startPos.coords.longitude;
  };
  navigator.geolocation.getCurrentPosition(geoSuccess);
};



function select_institutions(id,name,latlong)
{

    document.getElementById("institutionId").value=id;
    document.getElementById("institution").value=name;
    document.getElementById("latlong").value=latlong;

    latlong = latlong.split(',');
   
var p1 = new google.maps.LatLng(parseFloat($('#startLat').val()),parseFloat($('#startLon').val()));
var p2 = new google.maps.LatLng(parseFloat(latlong[0]),parseFloat(latlong[1]));

var distance = parseFloat(calcDistance(p1, p2));
if(distance>1){
 alert('the distance between point 1 and 2 bigger than 1 km');   
}
    $('#distance').val(distance);
    
    
    
   locations = [
    ['present location',parseFloat($('#startLat').val()),parseFloat($('#startLon').val()),1],
    ['Institute location',parseFloat(latlong[0]),parseFloat(latlong[1]),2]
    ];
    
    
    loadScript();
    $('.close').click();
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
      mapTypeId: google.maps.MapTypeId.ROADMAP
    });

    var infowindow = new google.maps.InfoWindow();

    var marker, i;

    for (i = 0; i < locations.length; i++) {  
      marker = new google.maps.Marker({
        position: new google.maps.LatLng(locations[i][1], locations[i][2]),
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
        document.body.appendChild(script);
      }

      //window.onload = loadScript;
    </script>


</head>

<body style="max-width: 400px;width: 100%;">
	<div class="wrapper">
      <div class="box-title">
                                <h3>
                                    <i class="icon-magic"></i>
                                    Distance in KMS 
                                </h3>
                            </div>  
	<form method="POST" name="institutions" id="institutions" class="form-vertical form-validate form-bordered"  enctype="multipart/form-data">
    <div class="row-fluid">
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Present Latitude</label>
<div class="controls">
<input type="text" name="startLat" autocomplete="off" id="startLat" placeholder="ReferePresent Latitudence" class="input-block-level" value="">
</div>
</div>
</div>
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Present Longitude</label>
<div class="controls">
<input type="text" name="startLon" autocomplete="off" id="startLon" placeholder="Present Longitude" class="input-block-level" value="">
</div>
</div>
</div>
</div>

<div class="row-fluid">
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Institution LatLong</label>
<div class="controls">
<input type="hidden"  name="institutionId" id="institutionId" value="">
<input type="hidden"  name="institution" id="institution" class="input-block-level" readonly="readonly" value="">
<input type="text"  name="latlong" id="latlong" class="input-block-level" readonly="readonly" value="">


<div class="pickers">
&nbsp;&nbsp;<a id="institution_lightbox" href="#lightbox-institutions" data-toggle="modal" ><i class="icon-edit"></i></a>
&nbsp;&nbsp;<a href="javascript:" onClick="return removeSelectedValue('institutionId-institution-latlong');" title="clear">X</a> 
</div>
</div>
</div>
</div>
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Distance in KMS</label>
<div class="controls">
<input type="text" name="distance" autocomplete="off" id="distance" placeholder="distance" class="input-block-level" value="">
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
</form>
    
    

    
	</div>
	
</body>

</html>

<div id="lightbox-institutions" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

    <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="chooseInzartClosebutton">X</button>

    <h3 id="myModalLabel">Select Institutions </h3>

    </div>

    <div class="modal-body nopadding">

        

    

        <form action="#" method="POST" class='form-horizontal form-column form-bordered' name="ls" id="ls" enctype="multipart/form-data">

        <table class="table table-hover table-nomargin table-bordered dataTable" id="ajax_institute_listings">

            <thead>
                <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Coordinates</th>
                <th>Type</th>
                <th>Zone/Area</th>
                <th>Select </th>
                </tr>
            </thead>
            <tbody>
                <?$ls_select="select * from institutions  where deleted=0 and coordinates!='' and typeId not in (2,4,5,7,11) order by typeId asc";
                

                $ls_query=mysql_query($ls_select);

                while($ls_res=mysql_fetch_assoc($ls_query)) {
                $areaINSID = $db->select_one(" select areaId from institutions_addresses  where instituteId=".$ls_res['id']." and `default`=1");
                ?>          

                <tr>

                <td><?=$ls_res['id']; ?></td>
 
                <td><?=$ls_res['name']; ?></td>
                <td><?=$ls_res['coordinates']; ?></td>
                
                
                
                <td><?=getValue('name','institutionTypes',$ls_res['typeId']); ?>
                <? if($ls_res['typeId']==1){?> / Spec : <?=getValue('name','Specialties',$ls_res['specialityId']); ?><? }?>
                </td>
                <td><?=getValue('name','areas',getValue('parent','areas',$areaINSID)); ?> / <?=getValue('name','areas',$areaINSID); ?></td>


                <td><input type="radio" name="radiotypes[]" onClick="select_institutions('<?=$ls_res['id']; ?>','<?=$ls_res['name']; ?>','<?=$ls_res['coordinates'];?>')" class="radio"></td>

                </tr>

                <? } ?>
            </tbody>

        </table>

        </form>

     </div>

</div>