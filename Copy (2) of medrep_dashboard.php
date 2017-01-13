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
<!--<div class="row-fluid">
<div class="span4">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=reports&p=4" style="color: #fff;" >Reports List</a>
</h3>
</div>
</div>
</div>
<div class="span4">
<div class="box box-color box-bordered lightred">
<div class="box-title">
<h3>
<i class="icon-road"></i>
<a href="main.php?g=routing&p=5" style="color: #fff;">Routing List</a>
</h3>
</div>
</div>
</div>

<div class="span4">
<div class="box box-color box-bordered green">
<div class="box-title">
<h3>
<i class="icon-plus-sign-alt"></i>
<a href="main.php?g=admin&p=1" style="color: #fff;" >Institutions List</a>
</h3>
</div>
</div>
</div>
</div>-->
<div class="row-fluid">
<div class="span12">
<div class="box box-color box-bordered darkblue">
<div class="box-title">
<h3><? echo date('F'); ?> Month To Date</h3>
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6">
<div class="box box-color box-bordered darkblue">
<div class="box-title">
<h3>
<i class="icon-bar-chart"></i>
<a href="#" style="color: #fff;" >Reports By Inst Type</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Inst Type</th>
<th>Succ Visits</th>
<th>%</th>
</tr>
<?

 $date_start = firstOfMonth();
 $date_end  = lastOfMonth();


$selectinstitutions="select * from institutionTypes where id in (1,3) order by id ";
$queryinstitutions=mysql_query($selectinstitutions);
while($resinstitutions=@mysql_fetch_assoc($queryinstitutions)) {
@$total=$db->select_one("select count(*) from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end'");
$typecount = $db->select_one("select count(*) from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and typeId=".$resinstitutions['id']." and visitDate between '$date_start' and '$date_end'");
$typecountothers = $db->select_one("select count(*) from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and typeId not in(1,3) and visitDate between '$date_start' and '$date_end'");
?>
<tr>
<td><?=$resinstitutions['name']; ?></td>
<td><?=$typecount?></td>
<td><?=@round(($typecount/@$total)*100,1)?>%</td>
</tr>                                                
<?}?>
<tr>
<td>Others</td>
<td><?=$typecountothers?></td>
<td><?=@round(($typecountothers/@$total)*100,1)?>%</td>
</tr>
<tr>
<td>Total</td>
<td><?=@$total?></td>
<td>100%</td>
</tr>
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
<th></th>
<th>Succ Visits</th>
<th>AVG</th>
</tr>
<?
$presentdate2 = date('Y-m-d');
//$diff=dateDiff ($date_start, $date2);
$selectinstitutions="select * from institutionTypes where id in (1,3) order by id ";
$queryinstitutions=mysql_query($selectinstitutions);

@$total=getWorkingDays($date_start,$presentdate2);
@$TTtotal=mysql_num_rows(mysql_query("select visitDate from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end'  "));
$typecountothers=mysql_num_rows(mysql_query("select visitDate from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end' and typeId not in(1,3) "));

while($resinstitutions=@mysql_fetch_assoc($queryinstitutions)) {
$typecount=mysql_num_rows(mysql_query("select visitDate from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end' and typeId=".$resinstitutions['id']));
?>
<tr>
<td><?=$resinstitutions['name']; ?></td>
<td><?=$typecount?></td>
<td><?=@round(($typecount/@$total),1)?></td>
</tr>                                                
<?}?>
<tr>
<td>Others</td>
<td><?=$typecountothers?></td>
<td><?=@round(($typecountothers/@$total),1)?></td>
</tr>
<tr>
<td>Total Days</td>
<td><?=@$total?></td>
<td><?=@round(($TTtotal/@$total),1)?></td>
</tr>
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
<th>Inst Type</th>
<th>Visits</th>
<th>%</th>
</tr>
<?
@$total=$db->select_one("select count(*) from reports where typeId!=2 and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end'");
$faildcount = $db->select_one("select count(*) from reports where faildVisit=1 and typeId!=2  and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end'");
$successcount = $db->select_one("select count(*) from reports where faildVisit=0 and typeId!=2 and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end'");
?>
<tr>
<td>Total Failed Visits</td>
<td><?=$faildcount?></td>
<td><?=@round(($faildcount/@$total)*100,1)?>%</td>
</tr>    
<tr>
<td>Total Succ Visits</td>
<td><?=$successcount?></td>
<td><?=@round(($successcount/@$total)*100,1)?>%</td>
</tr>                                                
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
<a href="#" style="color: #fff;" >Doctors By Class Report</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr><th>Class</th><th>Succ Visits</th><th>%</th></tr>
<?
@$total=$db->select_one("select count(*) from reports where faildVisit=0 and typeId=1 and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end'");
$Acount = $db->select_one("select count(*) from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and typeId=1 and institutionId in (select id from institutions where typeId=1 and class='A') and visitDate between '$date_start' and '$date_end'");
$Bcount = $db->select_one("select count(*) from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and typeId=1 and institutionId in (select id from institutions where typeId=1 and class='B') and visitDate between '$date_start' and '$date_end'");
$Ccount = $db->select_one("select count(*) from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and typeId=1 and institutionId in (select id from institutions where typeId=1 and class='C') and visitDate between '$date_start' and '$date_end'");
$BLcount = $db->select_one("select count(*) from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and typeId=1 and institutionId in (select id from institutions where typeId=1 and class='BL') and visitDate between '$date_start' and '$date_end'");
?>
<tr><td>A</td><td><?=$Acount?></td><td><?=@round(($Acount/@$total)*100,1)?>%</td></tr>    
<tr><td>B</td><td><?=$Bcount?></td><td><?=@round(($Bcount/@$total)*100,1)?>%</td></tr>    
<tr><td>C</td><td><?=$Ccount?></td><td><?=@round(($Ccount/@$total)*100,1)?>%</td></tr>    
<tr><td>BL</td><td><?=$BLcount?></td><td><?=@round(($BLcount/@$total)*100,1)?>%</td></tr>                                                
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
<a href="main.php?g=deals&p=25" style="color: #fff;" >YOUR ACTIVE DEALS</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Deal ID</th>
<th>Doctor Name</th>
<th>Speciality</th>
<th>Zone/Area</th>
<th>Date Started</th>
<th>Week 1</th>
<th>Week 3</th>
<th>Week 5</th>
<th>Week 8</th>
<th>Deal History</th>
</tr>
<?
$selectdeals="select * from deals where active=1 and deleted=0 and CEOApproval=1 and supervisorApproval=1 and countryManagerApproval=1 and medrepId='".@$_SESSION['CMSuserID']."' order by id ";
$querydeals=mysql_query($selectdeals);
while($resdeals=@mysql_fetch_assoc($querydeals)) {  
    
$areaID = $db->select_one(" select areaId from institutions_addresses where instituteId='".$resdeals['doctorId']."' and `default`=1  ");
$areaparentId = getValue('parent','areas',$areaID);    
$dealstartdate = $resdeals['actualStartDate'];

$querydealsintervals=mysql_query("select * from dealsfollowupintervals order by id asc limit 1");
$followupintervals=@mysql_fetch_assoc($querydealsintervals);  


$querydealsintervals2=mysql_query("select * from dealsfollowupintervals order by id asc limit 1,1");
$followupintervals2=@mysql_fetch_assoc($querydealsintervals2);  

$querydealsintervals3=mysql_query("select * from dealsfollowupintervals order by id asc limit 2,1");
$followupintervals3=@mysql_fetch_assoc($querydealsintervals3);  


$querydealsintervals4=mysql_query("select * from dealsfollowupintervals order by id asc limit 3,1");
$followupintervals4=@mysql_fetch_assoc($querydealsintervals4);  


$week1followup1 = $db->select_one(" select visitDate from dealsfollowup where dealId='".$resdeals['id']."' and intervalId='".$followupintervals['id']."' ");
$week1followup2 = $db->select_one(" select visitDate from dealsfollowup where dealId='".$resdeals['id']."' and intervalId='".$followupintervals2['id']."' ");
$week1followup3 = $db->select_one(" select visitDate from dealsfollowup where dealId='".$resdeals['id']."' and intervalId='".$followupintervals3['id']."' ");
$week1followup4 = $db->select_one(" select visitDate from dealsfollowup where dealId='".$resdeals['id']."' and intervalId='".$followupintervals4['id']."' ");

if($week1followup1=="" or $week1followup1=="0000-00-00"){
$dealstartdateafter1week = date( "Y-m-d", strtotime( "$dealstartdate +$followupintervals[weekNo] week" ) );

if(date('Y-m-d')>=$dealstartdateafter1week){
 $dealnextdue = "<span style='background:red;'>$dealstartdateafter1week</span>";   
}elseif((date('Y-m-d') < $dealstartdateafter1week) and (date('Y-m-d') >=date( "Y-m-d", strtotime( "$dealstartdateafter1week -2 day"))) ){
 $dealnextdue = "<span style='background:orange;'>$dealstartdateafter1week</span>";   
}else{
 $dealnextdue = "<span style='background:white;'>$dealstartdateafter1week</span>";   
}
$dealstartdateafter1week=$dealnextdue;
}else{
$dealstartdateafter1week = $week1followup1;    
$dealnextdue = "<span style='background:green;'>$dealstartdateafter1week</span>";   
$dealstartdateafter1week=$dealnextdue;
}

if($week1followup2=="" or $week1followup2=="0000-00-00"){
$dealstartdateafter2week = date( "Y-m-d", strtotime( "$dealstartdate +$followupintervals2[weekNo] week" ) );
if(date('Y-m-d')>=$dealstartdateafter2week){
 $dealnextdue = "<span style='background:red;'>$dealstartdateafter2week</span>";   
}elseif((date('Y-m-d') < $dealstartdateafter2week) and (date('Y-m-d') >=date( "Y-m-d", strtotime( "$dealstartdateafter2week -2 day"))) ){
 $dealnextdue = "<span style='background:orange;'>$dealstartdateafter2week</span>";   
}else{
 $dealnextdue = "<span style='background:white;'>$dealstartdateafter2week</span>";   
}
$dealstartdateafter2week=$dealnextdue;
}else{
$dealstartdateafter2week = $week1followup2;    
$dealnextdue = "<span style='background:green;'>$dealstartdateafter2week</span>";   
$dealstartdateafter2week=$dealnextdue;
}

if($week1followup3=="" or $week1followup3=="0000-00-00"){
$dealstartdateafter3week = date( "Y-m-d", strtotime( "$dealstartdate +$followupintervals3[weekNo] week" ) );
if(date('Y-m-d')>=$dealstartdateafter3week){
 $dealnextdue = "<span style='background:red;'>$dealstartdateafter3week</span>";   
}elseif((date('Y-m-d') < $dealstartdateafter3week) and (date('Y-m-d') >=date( "Y-m-d", strtotime( "$dealstartdateafter3week -2 day"))) ){
 $dealnextdue = "<span style='background:orange;'>$dealstartdateafter3week</span>";   
}else{
 $dealnextdue = "<span style='background:white;'>$dealstartdateafter3week</span>";   
}
$dealstartdateafter3week=$dealnextdue;
}else{
$dealstartdateafter3week = $week1followup3;    
$dealnextdue = "<span style='background:green;'>$dealstartdateafter3week</span>";   
$dealstartdateafter3week=$dealnextdue;
}

if($week1followup4=="" or $week1followup4=="0000-00-00"){
$dealstartdateafter4week = date( "Y-m-d", strtotime( "$dealstartdate +$followupintervals4[weekNo] week" ) );
if(date('Y-m-d')>=$dealstartdateafter4week){
 $dealnextdue = "<span style='background:red;'>$dealstartdateafter4week</span>";   
}elseif((date('Y-m-d') < $dealstartdateafter4week) and (date('Y-m-d') >=date( "Y-m-d", strtotime( "$dealstartdateafter4week -2 day"))) ){
 $dealnextdue = "<span style='background:orange;'>$dealstartdateafter4week</span>";   
}else{
 $dealnextdue = "<span style='background:white;'>$dealstartdateafter4week</span>";   
}
$dealstartdateafter4week=$dealnextdue;
}else{
$dealstartdateafter4week = $week1followup4;    
$dealnextdue = "<span style='background:green;'>$dealstartdateafter4week</span>";   
$dealstartdateafter4week=$dealnextdue;
}


?>
<tr>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" target="_blank"><?=$resdeals['id']?></a></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','Specialties',getValue('specialityId','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=$resdeals['actualStartDate']?></td>
<td><?=$dealstartdateafter1week?></td>
<td><?=$dealstartdateafter2week?></td>
<td><?=$dealstartdateafter3week?></td>
<td><?=$dealstartdateafter4week?></td>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" target="_blank">check details</a></td>
</tr>                                                
<?}?>
</table>                                         
</div>
</div>
</div>
</div>
</div>
</div>