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


//@$total=$db->select_one("select COUNT(DISTINCT(visitDate)) from reports where faildVisit=0 and medRepId='".@$_SESSION['CMSuserID']."' and visitDate between '$date_start' and '$date_end'");

$total=workingdays_months($_SESSION['CMSuserID']);

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
<th>Completed Reports</th>
<th>% Routing Complete</th>
<th>Distance(Kms)/Day</th>
</tr>
<?
//ini_set('display_errors',1);

//$now_date = '2015-04-03';
$now_date = date("Y-m-d", strtotime("next weekday", time()));

foreach(working_days($now_date, -5) as $presentdate2) {
    
    $weekname = date('l', strtotime($presentdate2));
                                        
                                        
                                        
                                        
                                             
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
                                        $weekname = 'Monday';
                                        $column = 'Mon_Data';
                                        } 
                                        $where=" and `$weekname`='".$presentdate2."' ";   
                                        
    $total_routes =  $db->select_one("select $column from routing where  medRepId='".@$_SESSION['CMSuserID']."' and `$weekname` = '$presentdate2' limit 1");
    
    $count_total_routes = 0;
    if($total_routes!=''){
    $count_total_routes = count(explode(',',$total_routes));
    }
    
    $total_reports =  $db->select_one("select count(*) from reports where medRepId='".@$_SESSION['CMSuserID']."' and visitDate = '$presentdate2' and tag=2 limit 1");  //$db->print_last_query();
    $tag_reports =  $db->select_one("select count(*) from reports where medRepId='".@$_SESSION['CMSuserID']."' and visitDate = '$presentdate2' and tag=1 limit 1");
    $First_time_reports =  $db->select_one("select time(datetimeAdded) from reports where medRepId='".@$_SESSION['CMSuserID']."' and visitDate = '$presentdate2' order by datetimeAdded asc limit 1");
    $Last_time_reports =  $db->select_one("select time(datetimeAdded) from reports where medRepId='".@$_SESSION['CMSuserID']."' and visitDate = '$presentdate2' order by datetimeAdded desc limit 1");
    
    $distance = 0;
    $coordinates = array();
    
    $coordinates[] = getValue('coordinates','users',$_SESSION['CMSuserID']);
    
$selectusersreports="select institutions.coordinates from reports left join institutions on reports.institutionId=institutions.id where reports.medRepId='".$_SESSION['CMSuserID']."' and reports.visitDate = '$presentdate2' and tag!=0 order by reports.datetimeAdded asc";
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


$percentage = round(($total_reports/$count_total_routes) * 100,2);

?>
<tr>
<td><?=date("F j, Y",strtotime($presentdate2)); ?></td>
<td><?=$First_time_reports?></td>
<td><?=$Last_time_reports?></td>
<td><?=$count_total_routes?></td>
<td><?=$tag_reports?></td>
<td><?=$total_reports?></td>
<td><?=$percentage?> % </td>
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
<div class="span12">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=deals&p=25" style="color: #fff;" >YOUR ACTIVE Advocates</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x" id="medrep_pharmacy_nextdueweek_list">
<thead>
<tr>
<th>ID</th>
<th>Doctor Name</th>
<th>Speciality</th>
<th>Zone/Area</th>
<th>Pharmacys</th>
<th>Products</th>
<th>Date Started</th>
<th>Next Due Date</th>
<th>Advocates History</th>
</tr>
</thead>
<tbody>
<?
$selectdeals="select * from deals where active=1 and deleted=0 and (supervisorApproval=1 or supervisorApproval=2) and (countryManagerApproval=1 or countryManagerApproval=2) and (CEOApproval=1 or CEOApproval=2)  and actualStartDate!='0000-00-00' and medrepId='".@$_SESSION['CMSuserID']."' order by id ";
$querydeals=mysql_query($selectdeals);
while($resdeals=@mysql_fetch_assoc($querydeals)) {
    
$areaID = $db->select_one(" select areaId from institutions_addresses where instituteId='".$resdeals['doctorId']."' and `default`=1  ");
$areaparentId = getValue('parent','areas',$areaID);       

$getpharmacy_query = mysql_query("select DP.pharmacyId,I.name from dealpharmacies DP 
    LEFT JOIN deals D on (DP.dealId=D.id )
    LEFT JOIN dealsproducts P on (P.dealId=D.id )
    LEFT JOIN institutions I on (DP.pharmacyId=I.id )
    LEFT JOIN institutions_addresses IA on (IA.instituteId=I.id )
    LEFT JOIN users U on (U.id=D.medrepId )
    LEFT JOIN areas A ON ( A.id = IA.areaId ) 
where D.active=1 and D.deleted=0 and (D.supervisorApproval=1 or D.supervisorApproval=2) and (D.countryManagerApproval=1 or D.countryManagerApproval=2) and (D.CEOApproval=1 or D.CEOApproval=2) and D.actualStartDate!='0000-00-00' and
 I.active=1 and I.typeId=3 and I.deleted=0 and D.id='".$resdeals['id']."' and A.id='".$areaID."' AND FIND_IN_SET(IA.areaId, U.areaIds) group by DP.pharmacyId order by D.id");  
 $PIDS=array();
 $PNames=array();
 while($getpharmacyid=mysql_fetch_assoc($getpharmacy_query)){
    $PIDS[]=$getpharmacyid['pharmacyId'];
    $PNames[]=$getpharmacyid['name'];
 }
 
$dealstartdate = $resdeals['actualStartDate'];

 $dealsProductscount = $db->select_one(" select count(productId) from dealsproducts where dealId='".$resdeals['id']."'  ");
$products="";    
for($i=0;$i<$dealsProductscount;$i++){
    $productID = $db->select_one(" select productId  from dealsproducts where dealId='".$resdeals['id']."' order by id limit $i,1  ");
    
$products=$products.getValue('name','products',$productID).",";
} 
$products=substr($products,0,-1);
?>
<tr>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" target="_blank"><?=$resdeals['id']?></a></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','Specialties',getValue('specialityId','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=implode('<br>',$PNames)?></td>
<td><?=$products?></td>
<td><?=$resdeals['actualStartDate']?></td>
<td><?=main_dashboard_duedate($resdeals['id'],'visitDate',$dealstartdate)?></td>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" target="_blank">check details</a></td>
</tr>                                                
<?}?>
</tbody>
</table>                                         
</div>
</div>
</div>
</div>
</div>
<?
    $selectpharmacys="select DP.id,DP.pharmacyId,D.actualStartDate,DP.dealId,D.doctorId,D.id as Did from dealpharmacies DP 
    LEFT JOIN deals D on (DP.dealId=D.id )
    LEFT JOIN dealsproducts P on (P.dealId=D.id )
    LEFT JOIN institutions I on (DP.pharmacyId=I.id )
    LEFT JOIN institutions_addresses IA on (IA.instituteId=I.id )
    
    LEFT JOIN areas A ON ( A.id = IA.areaId ) 
where D.active=1 and D.deleted=0 and (D.supervisorApproval=1 or D.supervisorApproval=2) and (D.countryManagerApproval=1 or D.countryManagerApproval=2) and (D.CEOApproval=1 or D.CEOApproval=2) and D.actualStartDate!='0000-00-00' and
 I.active=1 and I.typeId=3 and I.deleted=0 and IA.areaId in (select AreaId from salesmanpharmacies where salesManId=".$_SESSION['CMSuserID']." ) group by DP.pharmacyId order by D.id ";


//$selectdeals="select * from deals where active=1 and patientareaIds order by id ";
$querydeals=mysql_query($selectpharmacys);

$countdeals_salesman = mysql_num_rows($querydeals);
if($countdeals_salesman>0){
?>

<div class="row-fluid">
<div class="span12">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-table"></i>Active Advocates List As Salesman
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content nopadding">
<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x" id="salesman_pharmacy_nextdueweek_list">
<thead>
<tr>
<th>ID</th>
<th>Doctor Name</th>
<th>Speciality</th>
<th>Zone/Area</th>
<th>Pharmacy Name</th>
<th>Products</th>
<th>Date Started</th>
<th>Next Visit Due Week</th>
<!--<th>Total Score</th>-->
<th>Advocates History</th>
</tr>
</thead>
<tbody>
<?
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
$pharmacy1VisitDate = "pharmacy1VisitDate";
if($resdeals['pharmacyId']==getreqValue('pharmacy1ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy1VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy2ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy2VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy3ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy3VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy4ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy4VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy5ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy5VisitDate";
elseif($resdeals['pharmacyId']==getreqValue('pharmacy6ID','dealsfollowup','dealId',$resdeals['dealId']))$pharmacy1VisitDate = "pharmacy6VisitDate";
?>
<tr>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['dealId']?>" target="_blank"><?=$resdeals['dealId']?></a></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','Specialties',getValue('specialityId','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=getValue('name','institutions',$resdeals['pharmacyId']); ?></td>
<td><?=$products?></td>
<td><?=$dealstartdate?></td>
<td><?=main_dashboard_duedate($resdeals['dealId'],$pharmacy1VisitDate,$dealstartdate)?></td>
<!--<td><?/*=salemanScore($resdeals['dealId'],$resdeals['pharmacyId'])*/?></td>-->
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['dealId']?>&sales=1" target="_blank">check details</a></td>
</tr>                                                
<?}?>
</tbody>
</table>                                         

</div>
</div>
</div>
</div>
<?}?>
</div>