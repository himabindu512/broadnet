
<style type="text/css">
.Missing { background-color: #e63a3a; color: white; padding: 2px;}
.New { background-color: #368ee0; color: white; padding: 2px;}
.Updated { background-color: orange; color: white; padding: 2px;}
.Checked { background-color: green; color: white; padding: 2px;}

.fullday { color: black; padding: 2px;border: 3px solid red;display: block;text-align: center;width: 25px;}
.halfday { color: black; padding: 2px;border: 3px solid orange;display: block;text-align: center;width: 25px;}
.quaterday { color: black; padding: 2px;border: 3px solid pink;display: block;text-align: center;width: 25px;}
.normalday { color: black; padding: 2px;border: 3px solid green;display: block;text-align: center;width: 25px;}

table tr th, .table tr td {
padding: 6px !important;
}
.chzn-container{width:60px !important;}
</style>
<?
$date_start = firstOfMonth();
$date_end  = lastOfMonth();


$increday="";
$countweekday=0;

$countweekday=  isWeekend(date("Y-m-d"));if($countweekday>0){$increday=0; } 
$zeroday = $countweekday+0;
if($countweekday==0){
    $countweekday=  isWeekend(date("Y-m-d", strtotime( '-1 days' ) ));
    if($countweekday>0){$increday=1;} 
}
$oneday = $countweekday+1;
if($countweekday==0){
    $countweekday=  isWeekend(date("Y-m-d", strtotime( '-2 days' ) ));
    if($countweekday>0){$increday=2;}
}
$twoday = $countweekday+2;

if($countweekday==0){
    $countweekday=  isWeekend(date("Y-m-d", strtotime( '-3 days' ) ));
    if($countweekday>0){$increday=3;}
}
$threeday = $countweekday+3;
if($countweekday==0){
    $countweekday=  isWeekend(date("Y-m-d", strtotime( '-4 days' ) ));
    if($countweekday>0){$increday=4;}
}
$fourday = $countweekday+4;

$fourdayDate = date("Y-m-d", strtotime("-$fourday days"));
$threedayDate = date("Y-m-d", strtotime("-$threeday days"));
$twodayDate = date("Y-m-d", strtotime("-$twoday days"));
$onedayDate = date("Y-m-d", strtotime("-$oneday days"));
$zerodayDate = date("Y-m-d", strtotime("-$zeroday days"));

/*echo $countweekday;
echo $increday;
echo $zeroday;
echo $oneday;
echo $twoday;
echo $threeday;
echo $fourday;*/
?>

<div class="container-fluid">
<div class="page-header">
    <div class="pull-left" >
        <h1 style="font-size:4vw;">Dashboard</h1>
    </div>
    <div class="pull-right">
        <ul class="stats" style="display: block !important;">
            <li class="lightred">
                <i class="icon-calendar"></i>
                <div class="details" >
                    <span class="big"></span>
                    <span></span>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="row-fluid">
<div class="span6">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=reports&p=4" style="color: #fff;" >Reports List</a>
</h3>
<div class="actions">
<!--<a class="btn btn-mini content-refresh" href="#"><i class="icon-refresh"></i></a>
<a class="btn btn-mini content-remove" href="#"><i class="icon-remove"></i></a>-->
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>MedRep</th>
<th><?=$fourdayDate?></th>
<th><?=$threedayDate?></th>
<th><?=$twodayDate?></th>
<th><?=$onedayDate?></th>
<th><?=$zerodayDate?></th>
</tr>
<?

$selectusers="select * from users where role in (2,4) and active=1 order by id ";
$queryusers=mysql_query($selectusers);
while($resusers=@mysql_fetch_assoc($queryusers)) {
$selectreports="select * from reports where active=1 and medrepId='".$resusers['id']."' order by id desc limit 1 ";
$queryreports=mysql_query($selectreports);
$resreports=@mysql_fetch_assoc($queryreports);



    $Today = $db->select_one("select count(id) from reports where medRepId='".$resusers['id']."' and visitDate ='$zerodayDate' order by id desc limit 1");
    $Day_Today = checkdaytype($zerodayDate,$resusers['id']);
    
    $Today_1 = $db->select_one("select count(id) from reports where medRepId='".$resusers['id']."' and visitDate ='$onedayDate' order by id desc limit 1");
    $Day_Today_1 = checkdaytype($onedayDate,$resusers['id']);
    
    $Today_2 = $db->select_one("select count(id) from reports where medRepId='".$resusers['id']."' and visitDate ='$twodayDate' order by id desc limit 1");
    $Day_Today_2 = checkdaytype($twodayDate,$resusers['id']);
    
    $Today_3 = $db->select_one("select count(id) from reports where medRepId='".$resusers['id']."' and visitDate ='$threedayDate' order by id desc limit 1");
    $Day_Today_3 = checkdaytype($threedayDate,$resusers['id']);
    
    $Today_4 = $db->select_one("select count(id) from reports where medRepId='".$resusers['id']."' and visitDate ='$fourdayDate' order by id desc limit 1");
    $Day_Today_4 = checkdaytype($fourdayDate,$resusers['id']);
    
?>
<tr>
<td><a href="main.php?g=reports&p=4&medRepId=<?=$resusers['id']?>" target="_blank"><?=getValue('name','users',$resusers['id']); ?></a></td>
<td><a class="<?=$Day_Today_4?>" ><?=$Today_4?></a></td>
<td><a class="<?=$Day_Today_3?>" ><?=$Today_3?></a></td>
<td><a class="<?=$Day_Today_2?>" ><?=$Today_2?></a></td>
<td><a class="<?=$Day_Today_1?>" ><?=$Today_1?></a></td>
<td><a class="<?=$Day_Today?>" ><?=$Today?></a></td>
</tr>                                                
<?}?>
</table>                                         
</div>
</div>
</div>
</div>

<div class="span6">
<div class="box box-color box-bordered teal">
<div class="box-title">
<h3>
<i class="icon-bar-chart"></i>
<a href="#" style="color: #fff;" >Daily Reports</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Medrep</th>
<th>Doctor-AVG</th>
<th>Pharmacy-AVG</th>
<th>Others-AVG</th>
<th>Total-AVG</th>
</tr>
<?
$presentdate2 = date('Y-m-d');
$date_start = firstOfMonth();
$date_end  = lastOfMonth();
//@$total=getWorkingDays($date_start,$presentdate2);
$selectusers="select * from users where role in (2,4) and active=1 order by id ";
$queryusers=mysql_query($selectusers);
while($resusers=@mysql_fetch_assoc($queryusers)) {
//$total=mysql_num_rows(mysql_query("select distinct visitDate from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and medRepId='".@$resusers['id']."' and typeId=1"));
$doctortypecount=mysql_num_rows(mysql_query("select visitDate from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and medRepId='".@$resusers['id']."' and typeId=1"));
$pharmacytypecount=mysql_num_rows(mysql_query("select visitDate from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and medRepId='".@$resusers['id']."' and typeId=3"));
$totalpharmacy=mysql_num_rows(mysql_query("select distinct visitDate from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and medRepId='".@$resusers['id']."' and typeId=3"));

$otherstypecount=mysql_num_rows(mysql_query("select visitDate from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and medRepId='".@$resusers['id']."' and typeId not in(1,3)"));
$totalothers=mysql_num_rows(mysql_query("select distinct visitDate from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and medRepId='".@$resusers['id']."' and typeId not in(1,3)"));
$alltypes_total=workingdays_months($resusers['id']);
//$alltypes_total=mysql_num_rows(mysql_query("select distinct visitDate from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and medRepId='".@$resusers['id']."' "));
/*$total_doctortypecount+=$doctortypecount;
$total_pharmacytypecount+=$pharmacytypecount;
$total_otherstypecount+=$otherstypecount;*/
?>
<tr>
<td><?=$resusers['name']; ?></td>
<td><?=$doctortypecount?>-<?=@round(($doctortypecount/@$alltypes_total),1)?></td>
<td><?=$pharmacytypecount?>-<?=@round(($pharmacytypecount/@$alltypes_total),1)?></td>
<td><?=$otherstypecount?>-<?=@round(($otherstypecount/@$alltypes_total),1)?></td>
<td><?=$otherstypecount+$pharmacytypecount+$doctortypecount?>-<?=@round((($otherstypecount+$pharmacytypecount+$doctortypecount)/@$alltypes_total),1)?></td>
</tr>                                                
<?}/*?>
<tr>
<td>Total Avg per day</td>
<td><?=$total_doctortypecount?>-<?=@round(($total_doctortypecount/@$total),1)?></td>
<td><?=$total_pharmacytypecount?>-<?=@round(($total_pharmacytypecount/@$total),1)?></td>
<td><?=$total_otherstypecount?>-<?=@round(($total_otherstypecount/@$total),1)?></td>
</tr><? */?>
</table>                                         
</div>
</div>
</div>
</div>



</div>



<div class="row-fluid">
<div class="span6">
<div class="box box-color box-bordered orange">
<div class="box-title">
<h3>
<i class="icon-plus-sign-alt"></i>
<a href="main.php?g=INinstitutions&p=2" style="color: #fff;" >Review Institutions List</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content nopadding scrollable" data-height="250" data-visible="true">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Medrep</th>
<th>Name</th>
<th>Type</th>
<th>Notification</th>
</tr>
<?
$selectinstitutions="select * from institutions where active=0 and deleted=0 order by id desc ";
$queryinstitutions=mysql_query($selectinstitutions);
while($resinstitutions=@mysql_fetch_assoc($queryinstitutions)) {
?>
<tr>
<td><?=getValue('name','users',$resinstitutions['medrepId']); ?></td>
<td><a href="main.php?g=INinstitutions&p=2&edit=<?=$resinstitutions['id']?>" target="_blank"><?=$resinstitutions['name']; ?></a></td>
<td><?=getValue('name','institutionTypes',$resinstitutions['typeId']); ?></td>
<td>New</td>
</tr>                                                
<?}?>
</table>                                         
</div>
</div>
</div>
</div>
<div class="span6">
<div class="box box-color box-bordered pink">
<div class="box-title">
<h3>
<i class="icon-map-marker"></i>
<a href="main.php?g=admin&p=13" style="color: #fff;" >Review Areas List</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content nopadding scrollable" data-height="250" data-visible="true">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Medrep</th>
<th>Area</th>
<th>Zone</th>
<th>Notification</th>
</tr>
<?
$selectareas="select * from areas where active=0 and deleted=0 order by id desc ";
$queryareas=mysql_query($selectareas);
while($resareas=@mysql_fetch_assoc($queryareas)) {
?>
<tr>
<td><?=getValue('name','users',$resareas['medrepId']); ?></td>
<td><a href="main.php?g=admin&p=13" target="_blank"><?=$resareas['name']; ?></a></td>
<td><?=getValue('name','areas',$resareas['parent']); ?></td>
<td>New</td>
</tr>                                                
<?}?>
</table>                                         
</div>
</div>
</div>
</div></div>




<div class="row-fluid">

<div class="span12">
<div class="box box-color box-bordered teal">
<div class="box-title">
<h3>
<i class="icon-bar-chart"></i>
<a href="#" style="color: #fff;" >Daily Reports For Tagging</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Medrep/Saleman</th>
<th>First time visit</th>
<th>Last time visit</th>
<th>In Routing</th>
<th>Tagged</th>
<th>Reports</th>
<th>Distance(Kms)/Day</th>
</tr>
<?
$presentdate2 = date('Y-m-d');
//$presentdate2 = '2015-04-10';

$selectusers="select * from users where role in (2,4) and active=1 order by id ";
$queryusers=mysql_query($selectusers);
while($resusers=@mysql_fetch_assoc($queryusers)) {
    
    $weekname = date('l', strtotime( $presentdate2));
                                        
                                        
                                        
                                        
                                             
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
                                        }else{
                                        $weekname = 'Mon_Data';
                                        $column = 'Mon_Data';
                                        } 
                                        $where=" and `$weekname`='".$presentdate2."' ";   
                                        
    $total_routes =  $db->select_one("select $column from routing where medrepId='".$resusers['id']."' and `$weekname` = '$presentdate2' limit 1");
    
    $count_total_routes = 0;
    if($total_routes!=''){
    $count_total_routes = count(explode(',',$total_routes));
    }
    
    $total_reports =  $db->select_one("select count(*) from reports where medRepId='".$resusers['id']."' and visitDate = '$presentdate2' and tag=2 limit 1");
    $tag_reports =  $db->select_one("select count(*) from reports where medRepId='".$resusers['id']."' and visitDate = '$presentdate2' and tag=1 limit 1");
    $First_time_reports =  $db->select_one("select time(datetimeAdded) from reports where medRepId='".$resusers['id']."' and visitDate = '$presentdate2' order by datetimeAdded asc limit 1");
    $Last_time_reports =  $db->select_one("select time(datetimeAdded) from reports where medRepId='".$resusers['id']."' and visitDate = '$presentdate2' order by datetimeAdded desc limit 1");
    
    $distance = 0;
    $coordinates = array();
    
    $coordinates[] = $resusers['coordinates'];
    
$selectusersreports="select institutions.coordinates from reports left join institutions on reports.institutionId=institutions.id where reports.medRepId='".$resusers['id']."' and reports.visitDate = '$presentdate2' and tag!=0 order by reports.datetimeAdded asc";
$queryusersreports=mysql_query($selectusersreports);
while($resusersreports=@mysql_fetch_assoc($queryusersreports)) {
    $coordinates[] = $resusersreports['coordinates'];
}

if(count($coordinates)>1){
    //echo $resusers['name']; print_r($coordinates);
    $x=0;
    foreach($coordinates as $coordinate){
        $x++;
    $INScoordinates = explode(',',$coordinate);
    $INSlat[$x] = $INScoordinates[0];
    $INSlong[$x] = $INScoordinates[1];
    
    }
    
    if($x>=2){
        for($i=1;$i<$x;$i++){
           // echo $i;  print_r($INSlat);
            $distance+= distance($INSlat[$i], $INSlong[$i], $INSlat[$i+1], $INSlong[$i+1], "K");        
        }
    }
}


?>
<tr>
<td><?=$resusers['name']; ?></td>
<td><?=$First_time_reports?></td>
<td><?=$Last_time_reports?></td>
<td><?=$count_total_routes?></td>
<td><?=$tag_reports?></td>
<td><?=$total_reports?></td>
<td><?=round($distance,2)?>kms</td>
</tr>                                                
<?}?>
</table>                                         
</div>
</div>
</div>
</div>
</div>

<div class="row-fluid">
<div class="span6">
<div class="box box-color box-bordered brown">
<div class="box-title">
<h3>
<i class="icon-bar-chart"></i>
<a href="#" style="color: #fff;" >Failed and Successful Report</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Medrep</th>
<th>Failed Visits-%</th>
<th>Succ Visits-%</th>
<th>Daily Tagged-%</th>
<th>Monthly Tagged-%</th>
</tr>
<?

$todaydate = date('Y-m-d');   

$selectusers="select * from users where role in (2,4) and active=1 order by id ";
$queryusers=mysql_query($selectusers);
while($resusers=@mysql_fetch_assoc($queryusers)) {
@$total=$db->select_one("select count(*) from reports where typeId!=2 and visitDate between '$date_start' and '$date_end' and medRepId=".$resusers['id']);
$faildcount = $db->select_one("select count(*) from reports where faildVisit=1 and visitDate between '$date_start' and '$date_end' and typeId!=2 and medRepId=".$resusers['id']);
$successcount = $db->select_one("select count(*) from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and typeId!=2 and medRepId=".$resusers['id']);

$daily_tag_count = $db->select_one("select count(*) from reports where tag!=0 and visitDate='$todaydate' and typeId!=2 and medRepId=".$resusers['id']);
$daily_total_count = $db->select_one("select count(*) from reports where visitDate='$todaydate' and typeId!=2 and medRepId=".$resusers['id']);

$monthly_tag_count = $db->select_one("select count(*) from reports where tag!=0 and visitDate between '$date_start' and '$date_end' and typeId!=2 and medRepId=".$resusers['id']);
?>
<tr>
<td><?=$resusers['name']?></td>
<td><?=$faildcount?>-<?=@round(($faildcount/@$total)*100,1)?>%</td>
<td><?=$successcount?>-<?=@round(($successcount/@$total)*100,1)?>%</td>
<td><?=$daily_tag_count?>-<?=@round(($daily_tag_count/@$daily_total_count)*100,1)?>%</td>
<td><?=$monthly_tag_count?>-<?=@round(($monthly_tag_count/@$total)*100,1)?>%</td>
</tr>    <?}?>                                            
</table>                                         
</div>
</div>
</div>
</div>
<div class="span6">
<div class="box box-color box-bordered lightgrey">
<div class="box-title">
<h3>
<i class="icon-bar-chart"></i>
<a href="#" style="color: #fff;" >Institutions By Medrep Report</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Name</th>
<th>A</th>
<th>B</th>
<th>C</th>
<th>BL</th>
</tr>
<?

$selectinstitutions="select * from users where role in (2,4) and active=1 order by id ";
$queryinstitutions=mysql_query($selectinstitutions);

while($resinstitutions=@mysql_fetch_assoc($queryinstitutions)) {
@$total=$db->select_one("select count(*) from reports where /*typeId=1 and*/ faildVisit=0 and visitDate between '$date_start' and '$date_end' and medRepId=".$resinstitutions['id']);    
$Acount = $db->select_one("select count(*) from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and /*typeId=1 and*/ medRepId=".$resinstitutions['id']." and institutionId in (select id from institutions where /*typeId=1 and*/ class='A')");
$Bcount = $db->select_one("select count(*) from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and /*typeId=1 and*/ medRepId=".$resinstitutions['id']." and institutionId in (select id from institutions where /*typeId=1 and*/ class='B')");
$Ccount = $db->select_one("select count(*) from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and /*typeId=1 and*/ medRepId=".$resinstitutions['id']." and institutionId in (select id from institutions where /*typeId=1 and*/ class='C')");
$BLcount = $db->select_one("select count(*) from reports where faildVisit=0 and visitDate between '$date_start' and '$date_end' and /*typeId=1 and*/ medRepId=".$resinstitutions['id']." and institutionId in (select id from institutions where /*typeId=1 and*/ class='BL')");
?>
<tr>
<td><?=$resinstitutions['name']; ?></td>
<td><?=$Acount?>-<?=@round(($Acount/@$total)*100,1)?>%</td>
<td><?=$Bcount?>-<?=@round(($Bcount/@$total)*100,1)?>%</td>
<td><?=$Ccount?>-<?=@round(($Ccount/@$total)*100,1)?>%</td>
<td><?=$BLcount?>-<?=@round(($BLcount/@$total)*100,1)?>%</td>
</tr>    
<?}?>                                            
</table>                                         
</div>
</div>
</div>
</div>
</div>


<?if(@$_SESSION['role']!=3){?>
<div class="row-fluid">
<div class="span12">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=deals&p=25" style="color: #fff;" >Advocates List Based on Products</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<script>
/*$(document).ready(function() {
$('#deals_basedon_products_list').DataTable({   
    "sPaginationType": "full_numbers","sScrollX": "100%","bScrollCollapse": true,
    "iDisplayLength": 10,
    "aaSorting": [[0, 'desc']],
    "oLanguage":{
        "sSearch": "<span>Search:</span> ",
        "sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
        "sLengthMenu": "_MENU_ <span>entries per page</span>"
    }
     
    });
    $('.dataTables_filter input').attr("placeholder", "Search here...");
    
    
    $(".dataTables_length select").wrap("<div class='input-mini'></div>").chosen({
        disable_search_threshold: 9999999
    });
    $("#deals_basedon_products_list thead tr").hide();
    });*/
</script>
<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x" id="deals_basedon_products_list">
<thead>
<tr>
<th>ID</th>
<th>Doctor Name</th>
<th>Speciality</th>
<th>Zone/Area</th>
<th>Date Started</th>
<th>Product</th>
<th>Prescriptions/Month</th>
<th>Monthly Contribution</th>
<th>Check Details</th>
</tr>
</thead>
<tbody>
<?
if($_SESSION['role']==3) $where=" and supervisorId=".$_SESSION['CMSuserID']; else $where="";
$selectdealsproducts="select * from dealsproducts where dealId in (select id from deals where active=1 and deleted=0 and (supervisorApproval=1 or supervisorApproval=2) and (countryManagerApproval=1 or countryManagerApproval=2) and (CEOApproval=1 or CEOApproval=2) and actualStartDate!='0000-00-00' $where) order by dealId asc";
$querydealsproducts=mysql_query($selectdealsproducts);
while($resdealsproducts=@mysql_fetch_assoc($querydealsproducts)) {
    
$selectdeals="select * from deals where active=1 and id=$resdealsproducts[dealId] order by id ";
$querydeals=mysql_query($selectdeals);
$resdeals=@mysql_fetch_assoc($querydeals);     
    
$areaID = $db->select_one(" select areaId from institutions_addresses where instituteId='".$resdeals['doctorId']."' and `default`=1  ");
$areaparentId = getValue('parent','areas',$areaID);  
$pharmacysid = explode(",",$resdeals['pharmacysid']);  
$salemanID = salemanID($pharmacysid[0]);    
?>
<tr>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdealsproducts['dealId']?>" target="_blank"><?=$resdealsproducts['dealId']?></a></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','Specialties',getValue('specialityId','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=$resdeals['actualStartDate']?></td>
<td><?=getValue('name','products',$resdealsproducts['productId'])?></td>
<td><?=$resdealsproducts['Promised']?></td>
<td>$<?=$resdealsproducts['AgreedCommission']?></td>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" class="icon-search" target="_blank"></a></td>
</tr>                                                
<?}?>
</tbody>
</table>                                         
</div>
</div>
</div>
</div>
</div>


<div class="row-fluid">
<div class="span12">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=deals&p=25" style="color: #fff;" >Advocates List Based on Assessment</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big" style="width: 100%;">
<script>
/*$(document).ready(function() {
$('#deals_basedon_assessment_list').DataTable({   
    "sPaginationType": "full_numbers","sScrollX": "100%","bScrollCollapse": true,
    "iDisplayLength": 10,
    "aaSorting": [[0, 'desc']],
    "oLanguage":{
        "sSearch": "<span>Search:</span> ",
        "sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
        "sLengthMenu": "_MENU_ <span>entries per page</span>"
    }
     
    });
    $('.dataTables_filter input').attr("placeholder", "Search here...");
    
    
    $(".dataTables_length select").wrap("<div class='input-mini'></div>").chosen({
        disable_search_threshold: 9999999
    });
    $("#deals_basedon_assessment_list thead tr").hide();
    });*/
</script>
<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x" style="width: 100%;" width="100%" id="deals_basedon_assessment_list">
<a href="javascript:" onclick="window.location='export-deals-list-csv.php';" style="background:#E63A3A;color:white;padding:0px 5px 5px 5px;">Export</a> 
<thead>
<tr>
<th>ID</th>
<th>Doctor Name</th>
<th>Speciality</th>
<th>Zone/Area</th>
<th>Date Started</th>
<th>Latest Medrep Assessment</th>
<th>Latest Salesman Assessment</th>
<th>Latest Supervisor Assessment</th>
<th>Last Payment Date</th>
<th>Latest Payment Amount</th>
<th>Total Payment Amount</th>
<th>Check Details</th>
</tr>
</thead>
<tbody>
<?

$selectdeals="select * from deals where active=1 and deleted=0 and (supervisorApproval=1 or supervisorApproval=2) and (countryManagerApproval=1 or countryManagerApproval=2) and (CEOApproval=1 or CEOApproval=2)  and actualStartDate!='0000-00-00' order by id asc";
$querydeals=mysql_query($selectdeals);
while($resdeals=@mysql_fetch_assoc($querydeals)) {

  
$totalpaymentamount = $db->select_one(" select sum(amount) from dealspayment where dealId='".$resdeals['id']."' group by dealId ");
$lastpaymentamount = $db->select_one(" select amount from dealspayment where dealId='".$resdeals['id']."' order by id desc limit 1 ");
$lastpaymentDate = $db->select_one(" select paymentDate from dealspayment where dealId='".$resdeals['id']."' order by id desc limit 1 ");

$areaID = $db->select_one(" select areaId from institutions_addresses where instituteId='".$resdeals['doctorId']."' and `default`=1  ");
$areaparentId = getValue('parent','areas',$areaID);  
$pharmacysid = explode(",",$resdeals['pharmacysid']);  
$salemanID = salemanID($pharmacysid[0]);    
?>
<tr>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" target="_blank"><?=$resdeals['id']?></a></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','Specialties',getValue('specialityId','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=$resdeals['actualStartDate']?></td>

<td><table border="2" width="100%"><tr><td style="padding: 0px !important;text-align: center;"><?=latest_assesment_date($resdeals['id'],'visitDate')?></td><td style="padding: 0px !important;text-align: center;"><?=latest_assesment_date2($resdeals['id'],'visitDate')?></td></tr></table></td>

<td><table border="2" width="100%"><tr><td style="padding: 0px !important;text-align: center;"><?=latest_assesment_date($resdeals['id'],'pharmacy1VisitDate')?></td><td style="padding: 0px !important;text-align: center;"><?=latest_assesment_date2($resdeals['id'],'pharmacy1VisitDate')?></td></tr></table></td>

<td><table border="2" width="100%"><tr><td style="padding: 0px !important;text-align: center;"><?=latest_assesment_date($resdeals['id'],'supervisorVisitDate')?></td><td style="padding: 0px !important;text-align: center;"><?=latest_assesment_date2($resdeals['id'],'supervisorVisitDate')?></td></tr></table></td>

<td><?=$lastpaymentDate?></td>
<td>$ <?=$lastpaymentamount?></td>
<td>$ <?=$totalpaymentamount?></td>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" class="icon-search" target="_blank"></a></td>
</tr>                                                
<?}?>
</tbody>
</table>                                         
</div>
</div>
</div>
</div>
</div>
<?}?>


<div class="row-fluid">
<div class="span12">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=deals&p=25" style="color: #fff;" >Medrep/Supervisor Next Visit Due Week</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<script>
/*$(document).ready(function() {
$('#medrep_supervisor_nextdueweek_list').DataTable({   
    "sPaginationType": "full_numbers","sScrollX": "100%","bScrollCollapse": true,
    "iDisplayLength": 10,
    "aaSorting": [[0, 'desc']],
    "oLanguage":{
        "sSearch": "<span>Search:</span> ",
        "sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
        "sLengthMenu": "_MENU_ <span>entries per page</span>"
    }
     
    });
    $('.dataTables_filter input').attr("placeholder", "Search here...");
    
    
    $(".dataTables_length select").wrap("<div class='input-mini'></div>").chosen({
        disable_search_threshold: 9999999
    });
    $("#medrep_supervisor_nextdueweek_list thead tr").hide();
    });*/
</script>
<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x" id="medrep_supervisor_nextdueweek_list">
<thead>
<tr>
<th>ID</th>
<th>Doctor Name</th>

<th>Zone/Area</th>
<th>Date Started</th>
<th>Medrep Visit Due Week</th>
<th>Supervisor Visit Due Week</th>
<th>Check Details</th>
</tr>
</thead>
<tbody>
<?
if($_SESSION['role']==3) $where=" and supervisorId=".$_SESSION['CMSuserID']; else $where="";
$selectdeals="select * from deals where active=1 and deleted=0 and (supervisorApproval=1 or supervisorApproval=2) and (countryManagerApproval=1 or countryManagerApproval=2) and (CEOApproval=1 or CEOApproval=2)  and actualStartDate!='0000-00-00' $where order by id ";
$querydeals=mysql_query($selectdeals);
while($resdeals=@mysql_fetch_assoc($querydeals)) {  
    
$areaID = $db->select_one(" select areaId from institutions_addresses where instituteId='".$resdeals['doctorId']."' and `default`=1  ");
$areaparentId = getValue('parent','areas',$areaID);    
$dealstartdate = $resdeals['actualStartDate'];

?>
<tr>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" target="_blank"><?=$resdeals['id']?></a></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>

<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=$dealstartdate?></td>
<td><?=main_dashboard_duedate($resdeals['id'],'visitDate',$dealstartdate)?></td>
<td><?=main_dashboard_duedate($resdeals['id'],'supervisorVisitDate',$dealstartdate)?></td>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" class="icon-search" target="_blank"></a></td>
</tr>                                                
<?}?>
</tbody>
</table>                                         
</div>
</div>
</div>
</div>
</div>

<div class="row-fluid">
<div class="span12">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=deals&p=25" style="color: #fff;" >Salesman Next Visit Due Week on Pharmacy's</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<script>
/*$(document).ready(function() {
$('#salesman_pharmacy_nextdueweek_list').DataTable({   
    "sPaginationType": "full_numbers","sScrollX": "100%","bScrollCollapse": true,
    "iDisplayLength": 10,
    "aaSorting": [[0, 'desc']],
    "oLanguage":{
        "sSearch": "<span>Search:</span> ",
        "sInfo": "Showing <span>_START_</span> to <span>_END_</span> of <span>_TOTAL_</span> entries",
        "sLengthMenu": "_MENU_ <span>entries per page</span>"
    }
     
    });
    $('.dataTables_filter input').attr("placeholder", "Search here...");
    
    
    $(".dataTables_length select").wrap("<div class='input-mini'></div>").chosen({
        disable_search_threshold: 9999999
    });
    $("#salesman_pharmacy_nextdueweek_list thead tr").hide();
    });*/
</script>
<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x" id="salesman_pharmacy_nextdueweek_list">
<thead>
<tr>
<th>ID</th>
<th>Doctor Name</th>

<th>Pharmacy Name</th>


<th>Zone/Area</th>
<th>Salesman Name</th>
<th>Date Started</th>
<th>Next Visit Due Week</th>
<th>Check Details</th>

</tr>
</thead>
<tbody>    
<?
$querysalesman=mysql_query("select * from users where role=4 order by id desc");
while($salesman=@mysql_fetch_assoc($querysalesman)) {  
$selectpharmacys="select DP.id,DP.pharmacyId,D.actualStartDate,DP.dealId,D.doctorId,D.id as Did from dealpharmacies DP 
    LEFT JOIN deals D on (DP.dealId=D.id )
    LEFT JOIN institutions I on (DP.pharmacyId=I.id )
    LEFT JOIN institutions_addresses IA on (IA.instituteId=I.id )
    
    /*LEFT JOIN areas A ON ( A.id = IA.areaId ) */
where D.active=1 and D.deleted=0 and (D.supervisorApproval=1 or D.supervisorApproval=2) and (D.countryManagerApproval=1 or D.countryManagerApproval=2) and (D.CEOApproval=1 or D.CEOApproval=2) and D.actualStartDate!='0000-00-00' and
 I.active=1 and I.typeId=3 and I.deleted=0 and IA.areaId in (select AreaId from salesmanpharmacies where salesManId=".$salesman['id']." ) /*group by DP.pharmacyId*/ order by D.id ";


//$selectdeals="select * from deals where active=1 and patientareaIds order by id ";
$querydeals=mysql_query($selectpharmacys);
while($resdeals=@mysql_fetch_assoc($querydeals)) {  
    
$areaID = $db->select_one(" select areaId from institutions_addresses where instituteId='".$resdeals['pharmacyId']."' and `default`=1  ");
$areaparentId = getValue('parent','areas',$areaID);    

$dealstartdate = $resdeals['actualStartDate'];
$pharmacy1VisitDate = "pharmacy1VisitDate";

if($resdeals['pharmacyId']==getreqValue('pharmacy1ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy1VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy2ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy2VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy3ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy3VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy4ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy4VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy5ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy5VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy6ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy6VisitDate";

?>
<tr>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['Did']?>" target="_blank"><?=$resdeals['Did']?></a></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>

<td><?=getValue('name','institutions',$resdeals['pharmacyId']); ?></td>


<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=$salesman['name'];?></td>
<td><?=$dealstartdate?></td>
<td><?=main_dashboard_duedate($resdeals['Did'],$pharmacy1VisitDate,$dealstartdate)?></td>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['Did']?>" class="icon-search" target="_blank"></a></td>

</tr>                                                
<?}}?>
</tbody>
</table>                                         
</div>
</div>
</div>
</div>
</div>


<? /*if(@$_SESSION['role']==3){?>
<div class="row-fluid">
<div class="span12">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=deals&p=25" style="color: #fff;" >Salesman Score on Pharmacy's</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>ID</th>
<th>Salesman Name</th>
<th>Pharmacy Name</th>
<th>Doctor Name</th>
<th>Speciality</th>
<th>Zone/Area</th>
<th>Products</th>
<th>Date Started</th>
<th>Next Visit Due Week</th>
<th>Total Score</th>
<th>Advocates History</th>
</tr>
<?
$querysalesman=mysql_query("select * from users where role=4 order by id desc");
while($salesman=@mysql_fetch_assoc($querysalesman)) {  
$selectpharmacys="select * from dealpharmacies DP 
    LEFT JOIN deals D on (DP.dealId=D.id )
    LEFT JOIN dealsproducts P on (P.dealId=D.id )
    LEFT JOIN institutions I on (DP.pharmacyId=I.id )
    LEFT JOIN institutions_addresses IA on (IA.instituteId=I.id )
    
    LEFT JOIN areas A ON ( A.id = IA.areaId ) 
where D.active=1 and D.deleted=0 and (D.supervisorApproval=1 or D.supervisorApproval=2) and (D.countryManagerApproval=1 or D.countryManagerApproval=2) and (D.CEOApproval=1 or D.CEOApproval=2) and
 I.active=1 and I.typeId=3 and I.deleted=0 and IA.areaId in (select AreaId from salesmanpharmacies where salesManId=".$salesman['id']." ) group by DP.pharmacyId order by D.id ";


//$selectdeals="select * from deals where active=1 and patientareaIds order by id ";
$querydeals=mysql_query($selectpharmacys);
while($resdeals=@mysql_fetch_assoc($querydeals)) {  
    
 $dealsProductscount = $db->select_one(" select count(productId) from dealsproducts where dealId='".$resdeals['dealId']."'  ");
$products="";    
for($i=0;$i<$dealsProductscount;$i++){
    $productID = $db->select_one(" select productId  from dealsproducts where dealId='".$resdeals['dealId']."' order by id limit $i,1  ");
    
$products=$products.getValue('name','products',$productID).",";
} 
$products=substr($products,0,-1);

$areaID = $db->select_one(" select areaId from institutions_addresses where instituteId='".$resdeals['doctorId']."' and `default`=1  ");
$areaparentId = getValue('parent','areas',$areaID);    

$dealstartdate = $resdeals['actualStartDate'];

if($resdeals['pharmacyId']==getValue('pharmacy1ID','dealsfollowup',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy1VisitDate";
elseif($resdeals['pharmacyId']==getValue('pharmacy2ID','dealsfollowup',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy2VisitDate";
elseif($resdeals['pharmacyId']==getValue('pharmacy3ID','dealsfollowup',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy3VisitDate";
elseif($resdeals['pharmacyId']==getValue('pharmacy4ID','dealsfollowup',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy4VisitDate";
elseif($resdeals['pharmacyId']==getValue('pharmacy5ID','dealsfollowup',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy5VisitDate";
elseif($resdeals['pharmacyId']==getValue('pharmacy6ID','dealsfollowup',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy6VisitDate";
?>
<tr>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['dealId']?>" target="_blank"><?=$resdeals['dealId']?></a></td>
<td><?=$salesman['name'];?></td>
<td><?=getValue('name','institutions',$resdeals['pharmacyId']); ?></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','Specialties',getValue('specialityId','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=$products?></td>
<td><?=$resdeals['actualStartDate']?></td>
<td><?=main_dashboard_duedate($resdeals['id'],$pharmacy1VisitDate,$dealstartdate)?></td>
<td><?=salemanScore($resdeals['dealId'],$resdeals['pharmacyId'])?></td>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['dealId']?>" target="_blank">check details</a></td>
</tr>                                                
<?}}?>
</table>                                         
</div>
</div>
</div>
</div>
</div>
<?}*/?>

</div>