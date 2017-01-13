<?
    include 'common.php'; 

    if(@$_REQUEST['todaydate']!=""){
        $todaydate = $_REQUEST['todaydate'];   
    }else{
        $todaydate = date('Y-m-d');   
    }
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
        <script language="javascript" type="text/javascript">
            $(function(){  
                    //calculates distance between two points in km's
                    function calcDistance(p1, p2){
                        return (google.maps.geometry.spherical.computeDistanceBetween(p1, p2));
                    }

                    var locations;
                    var mylat;
                    var mylong;

                    window.onload = function() {
                        var startPos;
                        var geoSuccess = function(position) {
                            startPos = position;
                            //alert(startPos.coords.latitude);

                            $('#startLat').val(startPos.coords.latitude);
                            $('#startLon').val(startPos.coords.longitude);

                            mylat = startPos.coords.latitude;
                            mylong = startPos.coords.longitude;
                        };
                        navigator.geolocation.getCurrentPosition(geoSuccess);
                    };

                    function loadmylocation(id,tag,thisobject){

                        //alert('vv');
                        $('#cboxLoadedContent').remove();
                        $.colorbox({href:"current_location_inst_map.php?id="+id+"&tag="+tag+"&thisobject="+thisobject});   

                    }
            });
        </script>
        <style>
            #tbody_startyourday a{font-size: 20px;}
        </style>
    </head>

    <body style="max-width: 600px;width: 100%;">
        <div class="wrapper">
            <div class="box-title">
                <h3>
                    <i class="icon-magic"></i>
                    Start Your Day Map on <?=$todaydate?>
                </h3>
            </div>  

            <?    
                $locations[]=array(coordinates => getValue('coordinates','users',$_SESSION['CMSuserID']), locationname => 'Home Location', tagstage => 'purple', tagtime => '00');
            ?>

            <form method="POST" name="startyourday" id="startyourday" style="margin: 0px;" >


                <input type="hidden" name="startLat" autocomplete="off" id="startLat"  value="">
                <input type="hidden" name="startLon" autocomplete="off" id="startLon"  value="">
                <input type="hidden" name="distance" autocomplete="off" id="distance"  value="">
                <input type="hidden" name="institutionId" autocomplete="off" id="institutionId"  value="">
                <input type="hidden" name="institution" autocomplete="off" id="institution"  value="">
                <input type="hidden" name="latlong" autocomplete="off" id="latlong"  value="">

            </form>
            <div class="box-content nopadding"> 
                <?
                    $where="";
                    if($_SESSION['role']==2 or $_SESSION['role']==4) $where=" where medrepId=".$_SESSION['CMSuserID'];
                    if(@$_REQUEST['todaydate']!=""){
                        $todaydate = $_REQUEST['todaydate'];   
                    }else{
                        $todaydate = date('Y-m-d');   
                    }                                        
                    $weekname = date('l', strtotime( $todaydate));



                    $where.=" and `$weekname`='".$todaydate."' ";   

                    if($weekname=='Monday'){
                        $column = 'Mon_Data';
                    }elseif($weekname=='Tuesday'){
                        $column = 'Tues_Data';
                    }elseif($weekname=='Wednesday'){
                        $column = 'Wednes_Data';
                    }elseif($weekname=='Thursday'){
                        $column = 'Thurs_Data';
                    }elseif($weekname=='Friday'){
                        $column = 'Fri_Data';
                    }    

                    $select="select id,active,$column as instdata from routing $where and active=1 order by id desc";
                    $query=mysql_query($select);
                    $rowscount=mysql_num_rows($query);
                    $res=mysql_fetch_assoc($query);


                    if($res['instdata']!=''){
                        $inst = explode(',',$res['instdata']);   
                        for($i=0;$i<count($inst);$i++){

                            $InsID = $inst[$i];
                            $InsName = str_replace(',', ' ',getValue('name','institutions',$InsID));

                            $coordinates = getValue('coordinates','institutions',$InsID);

                            $areaID = $db->select_one("select areaId from institutions_addresses where `default`=1 and instituteId=".$InsID);
                            $parentID = getValue('parent','areas',$areaID);
                            if($parentID==0 or $parentID==""){$parentID=$areaID;}

                            $areazone = getValue('name','areas',$parentID).' / '.getValue('name','areas',$areaID);
                            $ReportID = ReportID($InsID,$todaydate);
                            $reporttag = getValue('tag','reports',$ReportID);
                            $tagtime = getValue('datetimeAdded','reports',$ReportID);
                            $proceed_options = getValue('proceed_options','reports',$ReportID);
                        ?>                           	<?if($ReportID==0){ $tagstage='red';}elseif($ReportID>0 and $reporttag==2 and $proceed_options==""){  $tagstage='green';}elseif($ReportID>0 and $reporttag==2 and $proceed_options!=""){ $tagstage='blue';}elseif($ReportID>0 and $reporttag==1 and $proceed_options==""){ $tagstage='yellow';}elseif($ReportID>0 and $reporttag==1 and $proceed_options!=""){ $tagstage='orange';}?>

                        <?
                            if($coordinates!=''){

                                $locations[]=array(coordinates => $coordinates, locationname => $InsName, tagstage => $tagstage, tagtime => $tagtime);    

                        }?>


                        <? } }?>

            </div>

            <br>
            <div id="mapall" style="width: 100%;height: 400px;"></div>
            <div id="mapscriptall"></div>

        </div>
        <?
            //echo '<pre>';
            // print_r($locations);
            function array_orderby()
            {
                $args = func_get_args();
                $data = array_shift($args);
                foreach ($args as $n => $field) {
                    if (is_string($field)) {
                        $tmp = array();
                        foreach ($data as $key => $row)
                            $tmp[$key] = $row[$field];
                        $args[$n] = $tmp;
                    }
                }
                $args[] = &$data;
                call_user_func_array('array_multisort', $args);
                return array_pop($args);
            }
            $locations = array_orderby($locations, 'tagtime', SORT_ASC);

            //print_r($locations);

        ?>
        <script>

            function initialize_all() {
                var   locations = [

                    <? 


                        foreach($locations as $location){

                            $coordinates = $location['coordinates'];

                            if(@$coordinates!='') {
                                $latlong = explode(',',$coordinates);
                                $lat = $latlong[0];
                                $long = $latlong[1];
                            ?>

                            ['<?=$location['locationname']?>',<?=$lat?>,<?=$long?>,<?=$key+1?>,'<?=$location['tagstage']?>','<?=$location['tagtime']?>'],


                            <?}}?>
                ];


                /*var locations = [
                ['DESCRIPTION', 41.926979,12.517385, 3],
                ['DESCRIPTION', 41.914873,12.506486, 2],
                ['DESCRIPTION', 41.918574,12.507201, 1]
                ];*/

                var map = new google.maps.Map(document.getElementById('mapall'), {
                        zoom: 14,
                        center: new google.maps.LatLng('<?=$lat?>','<?=$long?>'), 
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




                //***********ROUTING****************//

                //Initialize the Path Array
                var path = new google.maps.MVCArray();

                //Initialize the Direction Service
                var service = new google.maps.DirectionsService();

                //Set the Path Stroke Color
                var poly = new google.maps.Polyline({ map: map, strokeColor: '#4986E7' });

                //Loop and Draw Path Route between the Points on MAP
                for (var i = 0; i < lat_lng.length; i++) {
                    if (i <= lat_lng.length) {
                        var src = lat_lng[i];
                        if(i==lat_lng.length){
                            var des = lat_lng[0];
                        }else{
                            var des = lat_lng[i + 1];
                        }


                        path.push(src);
                        poly.setPath(path);
                        service.route({
                                origin: src,
                                destination: des,
                                travelMode: google.maps.DirectionsTravelMode.DRIVING
                            }, function (result, status) {
                                if (status == google.maps.DirectionsStatus.OK) {
                                    for (var j = 0, len = result.routes[0].overview_path.length; j < len; j++) {
                                        //path.push(result.routes[0].overview_path[j]);
                                    }
                                }
                        });
                    }
                }
                //console.log(path);


            }

            function loadScript_all() {
                var script = document.createElement('script');
                script.type = 'text/javascript';
                script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&' + 'callback=initialize_all';
                //document.body.appendChild(script);
                $('#mapscriptall').html(script);
            }
            <?if(count($location['coordinates'])>0){?>
                loadScript_all();
                <?}?>


        </script>

        <style type="text/css">
            #ajax_institute_listings th { padding-right:10px !important;}
            #ajax_institute_listings tr td { padding: 2px !important;} 
            .form-vertical.form-bordered .control-group {
                border-bottom: 0px solid #ddd;
                padding: 5px 5px !important;
            }
            #ajax_institute_listings_length select { width: 100px !important;}
            #ajax_institute_listings { width: 100% !important;}
        </style>
    </body>
</html>