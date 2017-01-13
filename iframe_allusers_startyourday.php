<? include('common.php');
    $uid = $_REQUEST['uid'];
    unset($locations);    
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
    $locations[] =array('coordinates' => getValue('coordinates','users',$uid), 'locationname' => 'Home Location', 'tagstage' => 'purple','tagtime' => '00');

    $where="";
    $where=" where medrepId=".$uid;
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
    //print_r($res);


    if($res['instdata']!=''){
        $inst = explode(',',$res['instdata']);   
        for($i=0;$i<count($inst);$i++){

            $InsID = $inst[$i];
            $InsName = str_replace(',', ' ',getValue('name','institutions',$InsID));

            $coordinates = getValue('coordinates','institutions',$InsID);


            $ReportID = ReportIDMed($InsID,$todaydate,$uid);
            $reporttag = getValue('tag','reports',$ReportID);
            $tagtime = getValue('datetimeAdded','reports',$ReportID);
            $proceed_options = getValue('proceed_options','reports',$ReportID);
            
            if($ReportID==0){$tagstage='red';}elseif($ReportID>0 and $reporttag==2 and $proceed_options==""){$tagstage='green';}elseif($ReportID>0 and $reporttag==2 and $proceed_options!=""){$tagstage='blue';}elseif($ReportID>0 and $reporttag==1 and $proceed_options==""){$tagstage='yellow';}elseif($ReportID>0 and $reporttag==1 and $proceed_options!=""){$tagstage='orange';}
            

            if($coordinates!=''){
                $locations[]=array('coordinates' => $coordinates, 'locationname' => $InsName, 'tagstage' => $tagstage, 'tagtime' => $tagtime);    
        } } }

    $locations = array_orderby($locations, 'tagtime', SORT_ASC);

    //print_r($locations);
    //exit;
?>
<script src="js/jquery.min.js"></script>
<div id="mapall<?=$uid?>" style="width: 100%;height: 400px;display:block;"></div>
<div id="mapscriptall<?=$uid?>"></div>
<script>

    function initialize_all<?=$uid?>() {
        var   locations = [

            <? 

                $i=0;
                foreach($locations as $location){
                    $i++;
                    $coordinates = $location['coordinates'];

                    if(@$coordinates!='') {
                        $latlong = explode(',',$coordinates);
                        $lat = $latlong[0];
                        $long = $latlong[1];
                    ?>

                    ['<?=$location['locationname']?>',<?=$lat?>,<?=$long?>,<?=$i?>,'<?=$location['tagstage']?>','<?=$location['tagtime']?>'],


                    <?}}?>
        ];


        /*var locations = [
        ['DESCRIPTION', 41.926979,12.517385, 3],
        ['DESCRIPTION', 41.914873,12.506486, 2],
        ['DESCRIPTION', 41.918574,12.507201, 1]
        ];*/

        var map<?=$uid?> = new google.maps.Map(document.getElementById('mapall<?=$uid?>'), {
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
                    map : map<?=$uid?>
            });

            google.maps.event.addListener(marker, 'click', (function(marker, i) {
                        return function() {
                            infowindow.setContent(locations[i][0]);
                            infowindow.open(map<?=$uid?>, marker);
                        }
                })(marker, i));
        }




        //***********ROUTING****************//

        //Initialize the Path Array
        var path = new google.maps.MVCArray();

        //Initialize the Direction Service
        var service = new google.maps.DirectionsService();

        //Set the Path Stroke Color
        var poly = new google.maps.Polyline({ map: map<?=$uid?>, strokeColor: '#4986E7' });

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

    function loadScript_all<?=$uid?>() {
        var script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=true&' + 'callback=initialize_all<?=$uid?>';
        //document.body.appendChild(script);
        $('#mapscriptall<?=$uid?>').html(script);
    }
    <?if(count($location['coordinates'])>0){?>
        loadScript_all<?=$uid?>();
        <?}?>


                    </script>


