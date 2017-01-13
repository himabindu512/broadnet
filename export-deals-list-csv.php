<?php
    header ( "Content-type: application/octet-stream" );
    header ( "Content-Disposition: attachment; filename=advocate-list.xls" );
    header ( "Pragma: no-cache" );
    header ( "Expires: 0" );
    include ("common.php");
	//require_once("functions.php");

    $table_name='deals';
    $primary_id='id';
?>
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


	

<table class="table table-hover table-nomargin dataTable table-bordered dataTable-scroll-y dataTable-scroll-x" style="width: 100%;" width="100%" cellspacing='3' cellpadding='3' border=1 id="deals_basedon_assessment_list">

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

$selectdeals="select * from deals where active=1 and deleted=0 and (supervisorApproval=1 or supervisorApproval=2) and (countryManagerApproval=1 or countryManagerApproval=2) and (CEOApproval=1 or CEOApproval=2)  and actualStartDate!='0000-00-00' order by id desc";
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
<td><?=$resdeals['id']?></td>
<td><?=str_replace(","," ",getValue('name','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','Specialties',getValue('specialityId','institutions',$resdeals['doctorId'])); ?></td>
<td><?=getValue('name','areas',$areaID); ?>/<?=getValue('name','areas',$areaparentId); ?></td>
<td><?=$resdeals['actualStartDate']?></td>

<td><table border="2" width="100%"><tr><td style="padding: 0px !important;text-align: center;"><?=latest_assesment_date($resdeals['id'],'visitDate')?></td><td style="padding: 0px !important;text-align: center;"><?=latest_assesment_date2($resdeals['id'],'visitDate')?></td></tr></table></td>

<td><table border="2" width="100%"><tr><td style="padding: 0px !important;text-align: center;" ><?=latest_assesment_date($resdeals['id'],'pharmacy1VisitDate')?></td><td style="padding: 0px !important;text-align: center;" ><?=latest_assesment_date2($resdeals['id'],'pharmacy1VisitDate')?></td></tr></table></td>

<td><table border="2" width="100%"><tr><td style="padding: 0px !important;text-align: center;" ><?=latest_assesment_date($resdeals['id'],'supervisorVisitDate')?></td><td style="padding: 0px !important;text-align: center;" ><?=latest_assesment_date2($resdeals['id'],'supervisorVisitDate')?></td></tr></table></td>

<td><?=$lastpaymentDate?></td>
<td>$ <?=$lastpaymentamount?></td>
<td>$ <?=$totalpaymentamount?></td>
<td><a href="main.php?g=deals&p=25&edit=<?=$resdeals['id']?>" class="icon-search" target="_blank"></a></td>
</tr>                                                
<?}?>
</tbody>
</table> 



             
                    