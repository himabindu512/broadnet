<? include_once (__DIR__.'/common.php');
###### Deals Followup Every one week ##############

$weekintervals = array(1,4);
 
foreach($weekintervals as $interval){
 
$deals_count=$db->select_one("select count(*) from deals where active=1 and CEOApproval=1 and countryManagerApproval=1 and supervisorApproval=1 and actualStartDate=CURDATE() - INTERVAL $interval WEEK  order by id");
$todayDate=date('Y-m-d');  
//$db->print_last_query();

if($deals_count>0){
$deals_query=$db->select("select * from deals where active=1 and CEOApproval=1 and countryManagerApproval=1 and supervisorApproval=1 and actualStartDate=CURDATE() - INTERVAL $interval WEEK  order by id");
//$db->print_last_query();
while($deals = $db->get_row ( $deals_query, 'MYSQL_BOTH' )){
$id=$deals['id'];
$senderID = getreqValue('id','users','role',1);
$senderName = getValue('name','users',$senderID);

$subject = "Write the Advocates($id) Followup";
$notify_status = "Waiting for the Week $interval Advocates Followup";

$receiverID = $deals['medrepId'];
//notification_email($id,$deals['doctorId'],$receiverID,$senderID,$subject,$notify_status,$deals['adminApproval']);
   
$salesman_query=$db->select("select * from users where active=1 and role=4 order by id");
//$db->print_last_query();
while($salesman = $db->get_row ( $salesman_query, 'MYSQL_BOTH' )){

$salesmanareaids =explode(",",$salesman['areaIds']);
//print_r($salesmanareaids);
$pharmacyIds = explode(",",$deals['pharmacyIds']);
foreach($pharmacyIds as $pharmacyId){

$areaID = $db->select_one(" select areaId from institutions_addresses where instituteId='".$pharmacyId."' and `default`=1  limit 1 ");    
// $db->print_last_query();
if(in_array($areaID,$salesmanareaids)){
    
$pharmacyName = getValue('name','institutions',$pharmacyId);
$areaparentId = getValue('parent','areas',$areaID);  
$areazone = getValue('name','areas',$areaID).'/'.getValue('name','areas',$areaparentId);

$subject = "Write the Advocates($id) Followup";
$notify_status = "Waiting for the Week $interval <br>Advocates Followup for <br>AreaID : $areaID , <br>Area/Zone : $areazone , <br>PharmacyID : $pharmacyId , <br>PharmacyName : $pharmacyName ";
$receiverID = $salesman['id'];
//notification_email($id,$deals['doctorId'],$receiverID,$senderID,$subject,$notify_status,$deals['adminApproval']);
  
}
}   
}
}
}
}

###### Deals Followup Every one week ##############
?>
