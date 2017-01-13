<? 


function DivideNames($column,$name){
$name = preg_replace('!\s+!', '', $name);
$arr1 = str_split($name);
$words = array_unique($arr1);
//print_r($words);
$highlighted = array();
foreach ( $words as $key => $word ){
    $word = trim($word);
    if($key==0){
$highlighted[] = " ( $column like '".mysql_real_escape_string($word)."%' ) ";}else{
$highlighted[] = " ( $column like '%".mysql_real_escape_string($word)."%' ) ";}
}
return '('.implode(' AND ',$highlighted).')';
}

function notification_email($dealid,$doctorID,$receiverID,$senderID,$subject,$status,$statusID){

$to=getValue('email','users',$receiverID);    
$doctorname=str_replace(","," ",getValue('name','institutions',$doctorID));

mysql_query( " update deals set status='$status' where id='".$dealid."'"); 
 
$insert_notification = mysql_query ( "INSERT INTO notifications (dealId,receiverId,senderId,title,brief,status,receiverEmail) 
VALUES ('$dealid', '$receiverID', '$senderID', '$subject', '$status', '$statusID', '$to')" ) ;

$message = "Hi $to,<br>
<p>Kindly to inform you that a deal has been $status.</p>
<p>Deal ID : $dealid</p>
<p>Doctor Name : $doctorname</p>
<p>Please login to the system, to check the deal. </p>
Regards,<br>
The Broadmed Team";

$headers = "From: info@broad-med.com". "\r\n";
$headers .= 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

@mail($to,$subject,$message,$headers);
//@mail('touficy@optimalsolutions.it',$subject,$message,$headers);
//@mail('kishorekan2001@gmail.com',$subject,$message,$headers);
   
}


function DivideNames2($column,$lastname,$firstname){
//$key = preg_replace('/\s+/', ' ', $key);
//$key = preg_replace('/\+/', ' ', $key);
$lastname = preg_replace('!\s+!', ' ', $lastname);
//echo $key;
$lasts= explode(" ", $lastname);

$firstname = preg_replace('!\s+!', ' ', $firstname);
//echo $key;
$firsts = explode(" ", $firstname);

$highlighted = array();



foreach ( $firsts as $first ){
    $first = trim($first);
    
$stringlenF = strlen($first);

    if($stringlenF>3)$stringlengthF=$stringlenF-2;
    if($stringlenF<=3)$stringlengthF=1;
    for($i=0;$i<$stringlengthF;$i++){
    $firsts = substr($first,$i, 3);
//$highlighted[] = " ( $column like '%".mysql_real_escape_string($firsts)."%' ) ";

foreach ( $lasts as $last ){
    $last = trim($last);
    
    $stringlen = strlen($last);
    if($stringlen>4)$stringlength=$stringlen-3;
    if($stringlen<=4)$stringlength=1;
    //echo $stringlength;
    for($j=0;$j<$stringlength;$j++){
    $lastss = substr($last,$j, 4);
$highlighted[] = " ( $column like '%".mysql_real_escape_string($firsts)."%' and $column like '%".mysql_real_escape_string($lastss)."%' ) ";
    }

}
}
}

return '('.implode(' OR ',$highlighted).')';
}

function Multiple_keywords($column,$key){
//$key = preg_replace('/\s+/', ' ', $key);
//$key = preg_replace('/\+/', ' ', $key);
$key = preg_replace('!\s+!', ' ', $key);
//echo $key;
$words = explode(" ", $key);

$highlighted = array();
foreach ( $words as $word ){
    $word = trim($word);
    if($column=="A.name"){
       $highlighted[] = "( $column like '%".mysql_real_escape_string($word)."%' or A.id in ( select id from  areas where parent in (select id from areas where name like '%".mysql_real_escape_string($word)."%') ) ) "; 
    }else{
$highlighted[] = " ( $column like '%".mysql_real_escape_string($word)."%' ) ";
    }
}
return implode(' AND ',$highlighted);
}

function clean_url($text) 
{ 
$text=strtolower($text); 
$code_entities_match = array(' ','--','&quot;','!','@','#','$','%','^','&','*','(',')','_','+','{','}','|',':','"','<','>','?','[',']','\\',';',"'",',','.','/','*','+','~','`','=');
$code_entities_replace = array('-','-','','','','','','','','','','','','','','','','','','','','','','','','');
$text = str_replace($code_entities_match, $code_entities_replace, $text); 
return $text; 
} 
function getUserInfo($id)
{
    $sql = "select * from users where id= '".$id."'";    
    $result = mysql_query($sql);
    $data = mysql_fetch_assoc($result);
    if($data['role']==1) { $role= "Admin"; }  
    else if($data['role']==2) { $role= "MedRep"; } 
    else if($data['role']==3) { $role= "Supervisor"; } 
    else if($data['role']==4) { $role= "Sales Man"; } 
    else if($data['role']==5) { $role= "Deal Manager"; } 
    return $data['username']." | ".$role;
}
function getUserNameRole($id)
{
	$sql = "select * from users where id= '".$id."'";	
	$result = mysql_query($sql);
	$data = mysql_fetch_assoc($result);
	if($data['role']==1) { $role= "Admin"; }  
	else if($data['role']==2) { $role= "MedRep"; } 
    else if($data['role']==3) { $role= "Supervisor"; } 
    else if($data['role']==4) { $role= "Sales Man"; } 
	else if($data['role']==5) { $role= "Deal Manager"; } 
	return $data['name']." | ".$role;
}

function loggedIn($url) {
	if (! isset ( $_SESSION ['CMSuserID'] )) {
        echo "<script>window.location.href='$url';</script>";
		header ( "location:$url" );
		exit ();
	}
}

function salemanPharmaScore($select){
    
    if($select=="Good Evidence of Prescriptions"){
        $score = 100;
    }
    if($select=="Some Evidence of Prescriptions"){
        $score = 50;
    }
    if($select=="No evidence of Prescriptions"){
        $score = 0;
    }
    return $score;
    
}
function MedrepPharmaScore($select){
    
    if($select=="Doctor Complying"){
        $score = 100;
    }
    if($select=="Needs Close Follup-up/Reminders"){
        $score = 50;
    }
    if($select=="Does Not Appear to be Complying"){
        $score = 0;
    }
    return $score;
    
}
function SupervisorPharmaScore($select){
    
    if($select=="Recommend Continue"){
        $score = 100;
    }
    if($select=="Recommend Observation"){
        $score = 50;
    }
    if($select=="Recommend Amend or Terminate"){
        $score = 0;
    }
    return $score;
    
}
function salemanScore($dealid,$pharmaid){
    $score =0;
    $sql = "select * from dealsfollowup where dealId= '".$dealid."' and (pharmacy1ID=$pharmaid or pharmacy2ID=$pharmaid or pharmacy3ID=$pharmaid or pharmacy4ID=$pharmaid)";    
    $result = mysql_query($sql);
    $resultcount = mysql_num_rows(mysql_query($sql));
    while($data=mysql_fetch_assoc($result)) {
        //print_r($data);
        if($pharmaid==$data['pharmacy1ID']){
            $score+=salemanPharmaScore($data['pharmacy1FeedbackType']);
        }if($pharmaid==$data['pharmacy2ID']){
            $score+=salemanPharmaScore($data['pharmacy2FeedbackType']);
        }if($pharmaid==$data['pharmacy3ID']){
            $score+=salemanPharmaScore($data['pharmacy3FeedbackType']);
        }if($pharmaid==$data['pharmacy4ID']){
            $score+=salemanPharmaScore($data['pharmacy4FeedbackType']);
        }
    }
    $scores = $score / $resultcount;
    if($scores>=66.7){        
     $span = "<span style='background:green;'>$scores %</span>";   
    }
    if($scores>=33.3 and $scores<66.7){        
     $span = "<span style='background:orange;'>$scores %</span>";   
    }
    if($scores<33.3){        
     $span = "<span style='background:red;'>$scores %</span>";   
    }
    return $span;
}

function latest_assesment_date($dealid,$visitDate){
    
$db = new db_class ();
if (! $db->connect ()) $db->print_last_error ( true ); 
$Med_visitDate = $db->select_one(" select $visitDate from dealsfollowup where dealId='".$dealid."' and ($visitDate!='0000-00-00') order by intervalId desc limit 1");  
if($Med_visitDate=="")$Med_visitDate="Missing";  


$score =0;
    $sql = "select * from dealsfollowup where dealId= '".$dealid."' and ($visitDate!='0000-00-00')  order by intervalId desc limit 1";    
    $result = mysql_query($sql);
    $resultcount = mysql_num_rows(mysql_query($sql));
    while($data=mysql_fetch_assoc($result)) {
        //print_r($data);
        if($visitDate=="visitDate")$score+=MedrepPharmaScore($data['medrepFeedbackType']);
        if($visitDate=="pharmacy1VisitDate")$score+=salemanPharmaScore($data['pharmacy1FeedbackType']);
        if($visitDate=="supervisorVisitDate")$score+=SupervisorPharmaScore($data['supervisorFeedbackType']);
    }
    $scores = $score / $resultcount;
    if($Med_visitDate=="Missing"){
     $span = $Med_visitDate;      
    }
    elseif($scores>=66.7){        
     $span = "<span style='background:green;'>$Med_visitDate</span>";   
    }
    elseif($scores>=33.3 and $scores<66.7){        
     $span = "<span style='background:orange;'>$Med_visitDate</span>";   
    }
    elseif($scores<33.3){        
     $span = "<span style='background:red;'>$Med_visitDate</span>";   
    }


return $span;
}

function latest_assesment_date2($dealid,$visitDate){
    
$db = new db_class ();
if (! $db->connect ()) $db->print_last_error ( true ); 
$Med_visitDate = $db->select_one(" select $visitDate from dealsfollowup where dealId='".$dealid."' and ($visitDate!='0000-00-00') order by intervalId desc limit 1,1");  
if($Med_visitDate=="")$Med_visitDate="Missing";  


$score =0;
    $sql = "select * from dealsfollowup where dealId= '".$dealid."' and ($visitDate!='0000-00-00')  order by intervalId desc limit 1,1";    
    $result = mysql_query($sql);
    $resultcount = mysql_num_rows(mysql_query($sql));
    while($data=mysql_fetch_assoc($result)) {
        //print_r($data);
        if($visitDate=="visitDate")$score+=MedrepPharmaScore($data['medrepFeedbackType']);
        if($visitDate=="pharmacy1VisitDate")$score+=salemanPharmaScore($data['pharmacy1FeedbackType']);
        if($visitDate=="supervisorVisitDate")$score+=SupervisorPharmaScore($data['supervisorFeedbackType']);
    }
    $scores = $score / $resultcount;
    if($Med_visitDate=="Missing"){
     $span = $Med_visitDate;      
    }
    elseif($scores>=66.7){        
     $span = "<span style='background:green;'>$Med_visitDate</span>";   
    }
    elseif($scores>=33.3 and $scores<66.7){        
     $span = "<span style='background:orange;'>$Med_visitDate</span>";   
    }
    elseif($scores<33.3){        
     $span = "<span style='background:red;'>$Med_visitDate</span>";   
    }


return $span;
}

function main_dashboard_duedate($dealid,$visitDate,$dealstartdate){
    

$querydealsintervals=mysql_query("select * from dealsfollowupintervals order by id asc limit 1");
$followupintervals=@mysql_fetch_assoc($querydealsintervals);  


$querydealsintervals2=mysql_query("select * from dealsfollowupintervals order by id asc limit 1,1");
$followupintervals2=@mysql_fetch_assoc($querydealsintervals2);  

$querydealsintervals3=mysql_query("select * from dealsfollowupintervals order by id asc limit 2,1");
$followupintervals3=@mysql_fetch_assoc($querydealsintervals3);  


$querydealsintervals4=mysql_query("select * from dealsfollowupintervals order by id asc limit 3,1");
$followupintervals4=@mysql_fetch_assoc($querydealsintervals4);  
$db = new db_class ();
if (! $db->connect ()) $db->print_last_error ( true ); 

$week1followup1 = $db->select_one(" select $visitDate from dealsfollowup where dealId='".$dealid."' and intervalId='".$followupintervals['id']."' ");
$week1followup2 = $db->select_one(" select $visitDate from dealsfollowup where dealId='".$dealid."' and intervalId='".$followupintervals2['id']."' ");
$week1followup3 = $db->select_one(" select $visitDate from dealsfollowup where dealId='".$dealid."' and intervalId='".$followupintervals3['id']."' ");
$week1followup4 = $db->select_one(" select $visitDate from dealsfollowup where dealId='".$dealid."' and intervalId='".$followupintervals4['id']."' ");

if($week1followup1=="" or $week1followup1=="0000-00-00"){
$dealstartdateafter1week = "Week $followupintervals[weekNo] :".date( "Y-m-d", strtotime( "$dealstartdate +$followupintervals[weekNo] week" ) );
$exdate=explode(":",$dealstartdateafter1week);
if(date('Y-m-d')>=$exdate[1]){
 $dealnextdue = "<span style='background:red;'>$dealstartdateafter1week</span>";   
}elseif((date('Y-m-d') < $exdate[1]) and (date('Y-m-d') >=date( "Y-m-d", strtotime( "$exdate[1] -2 day"))) ){
 $dealnextdue = "<span style='background:orange;'>$dealstartdateafter1week</span>";   
}else{
 $dealnextdue = "<span style='background:green;'>$dealstartdateafter1week</span>";   
}
$dealstartdateafter1week=$dealnextdue;
}else if($week1followup2=="" or $week1followup2=="0000-00-00"){
$dealstartdateafter1week = "Week $followupintervals2[weekNo] :".date( "Y-m-d", strtotime( "$dealstartdate +$followupintervals2[weekNo] week" ) );
$exdate=explode(":",$dealstartdateafter1week);
if(date('Y-m-d')>=$exdate[1]){
 $dealnextdue = "<span style='background:red;'>$dealstartdateafter1week</span>";   
}elseif((date('Y-m-d') < $exdate[1]) and (date('Y-m-d') >=date( "Y-m-d", strtotime( "$exdate[1] -2 day"))) ){
 $dealnextdue = "<span style='background:orange;'>$dealstartdateafter1week</span>";   
}else{
 $dealnextdue = "<span style='background:green;'>$dealstartdateafter1week</span>";   
}
$dealstartdateafter1week=$dealnextdue;
}elseif($week1followup3=="" or $week1followup3=="0000-00-00"){
$dealstartdateafter1week = "Week $followupintervals3[weekNo] :".date( "Y-m-d", strtotime( "$dealstartdate +$followupintervals3[weekNo] week" ) );
$exdate=explode(":",$dealstartdateafter1week);
if(date('Y-m-d')>=$exdate[1]){
 $dealnextdue = "<span style='background:red;'>$dealstartdateafter1week</span>";   
}elseif((date('Y-m-d') < $exdate[1]) and (date('Y-m-d') >=date( "Y-m-d", strtotime( "$exdate[1] -2 day"))) ){
 $dealnextdue = "<span style='background:orange;'>$dealstartdateafter1week</span>";   
}else{
 $dealnextdue = "<span style='background:green;'>$dealstartdateafter1week</span>";   
}
$dealstartdateafter3week=$dealnextdue;
}else{
$dealstartdateafter1week = "Week $followupintervals4[weekNo] :".date( "Y-m-d", strtotime( "$dealstartdate +$followupintervals4[weekNo] week" ) );
$exdate=explode(":",$dealstartdateafter1week);
if(date('Y-m-d')>=$exdate[1]){
 $dealnextdue = "<span style='background:red;'>$dealstartdateafter1week</span>";   
}elseif((date('Y-m-d') < $exdate[1]) and (date('Y-m-d') >=date( "Y-m-d", strtotime( "$exdate[1] -2 day"))) ){
 $dealnextdue = "<span style='background:orange;'>$dealstartdateafter1week</span>";   
}else{
 $dealnextdue = "<span style='background:green;'>$dealstartdateafter1week</span>";   
}
$dealstartdateafter1week=$dealnextdue;
}   
   return $dealstartdateafter1week; 
}
function salemanID($pharmaid){
    $areaID = mysql_fetch_assoc(mysql_query("select areaId from institutions_addresses where `default`=1 and instituteId=".$pharmaid));
    $areaID = $areaID['areaId'];
    $sql = "select id from users where id in (select salesManId from salesmanpharmacies where AreaId='$areaID') order by id limit 1";    
    $result = mysql_query($sql);
    $data=mysql_fetch_assoc($result);
     
    return $data['id'];
}
function MedrepAreaID($pharmaid){
    $areaID = mysql_fetch_assoc(mysql_query("select areaId from institutions_addresses where `default`=1 and instituteId=".$pharmaid));
    $areaID = $areaID['areaId'];
    $sql = "select id from users where role=2 and id in (select MedrepId from medreppharmacies where AreaId='$areaID') order by id limit 1";    
    $result = mysql_query($sql);
    $data=mysql_fetch_assoc($result);
     
    return $data['id'];
}


function dateDiff ($d1, $d2) {

    // Return the number of days between the two dates:    
    return round(abs(strtotime($d1) - strtotime($d2))/86400);

}
function firstOfMonth() {
return date("Y-m-d", strtotime(date('m').'/01/'.date('Y').' 00:00:00'));
//return date("Y-m-d", strtotime('-1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00')));
}
function lastOfMonth() {
return date("Y-m-d", strtotime('-1 second',strtotime('+1 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));
//return date("Y-m-d", strtotime('-1 second',strtotime('+0 month',strtotime(date('m').'/01/'.date('Y').' 00:00:00'))));
}

function getWorkingDays($startDate, $endDate){
 $begin=strtotime($startDate);
 $end=strtotime($endDate);
 if($begin>$end){
  //echo "startdate is in the future! <br />";
  return 0;
 }else{
   $no_days=0;
   $weekends=0;
  while($begin<=$end){
    $no_days++; // no of days in the given interval
    $what_day=date("N",$begin);
     if($what_day>5) { // 6 and 7 are weekend days
          $weekends++;
     };
    $begin+=86400; // +1 day
  };
  $working_days=$no_days-$weekends;
  return $working_days;
 }
}

function isWeekend($date) {
    $weekDay = date('w', strtotime($date));
    if($weekDay==0){
     return 2;   
    }elseif($weekDay==6){
     return 1;   
    }else{
     return 0;   
    }
    //return ($weekDay == 0 || $weekDay == 6);
}

function getdealcomment($dealid,$userrole)
{
    $result = mysql_query("select comment from dealcomments where dealId='$dealid' and userRole='$userrole' order by id desc ");
    $data = mysql_fetch_assoc($result);
    return $data['comment'];
}
function insertdealcommennt($dealid,$userrole,$userID,$comment){
    mysql_query("insert into dealcomments (dealId,userRole,userId,comment) values ($dealid,$userrole,$userID,'$comment') ");
}
function getValue($col,$tab,$id)
{
        $sql = "SELECT $col FROM $tab WHERE id= '".$id."' order by id desc limit 1 ";    
        $result = mysql_query($sql);
        $data = mysql_fetch_assoc($result);
        return $data[$col];
}

function getreqValue($col,$tab,$field,$id)
{
        $sql = "SELECT $col FROM $tab WHERE $field= '".$id."' order by id desc limit 1  ";    
        $result = mysql_query($sql);
        $data = mysql_fetch_assoc($result);
        return $data[$col];
}

function getsalesmanByarea($areaid){
$salesmanid=getreqValue('salesManId','salesmanpharmacies','AreaId',$areaid);
if(getValue('name','users',$salesmanid)!=""){
return '<small>('.getValue('name','users',$salesmanid).')</small>';
}else{
    return "";
}
}
function getMedrepByarea($areaid){
$salesmanid=getreqValue('MedrepId','medreppharmacies','AreaId',$areaid);
if(getValue('name','users',$salesmanid)!=""){
return '<small>('.getValue('name','users',$salesmanid).')</small>';
}else{
    return "";
}
}

?>



