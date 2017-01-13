<?
    include 'common.php'; 

    $instituteId = getValue('institutionId','reports',$_GET['id']);
    $tag_lati_long = getValue('tag_lati_long','reports',$_GET['id']);
    $Inscoordinates = getValue('coordinates','institutions',$instituteId);
    
    $tag_latlong = explode(',',$tag_lati_long);
    $tag_lat = $tag_latlong[0];
    $tag_long = $tag_latlong[1];
    
    $Inslatlong = explode(',',$Inscoordinates);
    $Inslat = $Inslatlong[0];
    $Inslong = $Inslatlong[1];
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
        
        <link rel="stylesheet" href="css/style.css">
        <!-- Color CSS -->
        <link rel="stylesheet" href="css/themes.css">
        <!-- jQuery -->
        <script src="js/jquery.min.js"></script>

        <!--<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDKw1I9ZlI-piCBp2zXSuviBDVRjju-aYI&sensor=true&libraries=adsense"></script>-->
        <script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&libraries=geometry"></script>
        <script>

            function initialize_all() {
                var   locations = [
                    ['Institution',<?=$Inslat?>,<?=$Inslong?>,2,'red'],
                    ['Tag Point',<?=$tag_lat?>,<?=$tag_long?>,1,'blue'],
                ];


                /*var locations = [
                ['DESCRIPTION', 41.926979,12.517385, 3],
                ['DESCRIPTION', 41.914873,12.506486, 2],
                ['DESCRIPTION', 41.918574,12.507201, 1]
                ];*/

                var map = new google.maps.Map(document.getElementById('mapall'), {
                        zoom: 14,
                        center: new google.maps.LatLng('<?=$tag_lat?>','<?=$tag_long?>'), 
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
                var lat_lng = new Array();

                var marker, i;

                for (i = 0; i < locations.length; i++) {
                    var myLatlng = new google.maps.LatLng(locations[i][1], locations[i][2]);
                    if(locations[i][5]!=''){
                        lat_lng.push(myLatlng); 
                    } 
                    marker = new google.maps.Marker({
                            position: myLatlng,
                            animation: google.maps.Animation.DROP,
                            icon: '<?=$site_url?>img/'+locations[i][4]+'-dot.png',
                            draggable: false,
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

            /*function loadScript_all() {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&' + 'callback=initialize_all';
                //document.body.appendChild(script);
                $('#mapscript').html(script);
            }*/
            <?if($tag_lati_long!=''){?>
            //loadScript_all(); 
                google.maps.event.addDomListener(window, 'load', initialize_all);
                <?}?>

        </script>


    </head>

    <body style="max-width: 600px;width: 100%;">
        <div class="wrapper">
            <div class="box-title">
                <h3>
                    <i class="icon-magic"></i>
                    Report Taging From Institute
                </h3>
            </div>  
            <form method="POST" name="institutions" id="institutions" class="form-vertical form-validate form-bordered"  enctype="multipart/form-data">


                <div class="row-fluid">
                    <div class="span12">
                        <div class="control-group">
                            <label for="textfield" class="control-label">Map</label>
                            <div class="controls">
                                <div id="mapall" class="input-block-level" style="height: 300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>




        </div>

    </body>

</html>
<div id="mapscript"></div>
