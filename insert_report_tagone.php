<?
    include 'common.php'; 
    loggedIn ("index.php");
    if (@$_POST ['institutionId']!=""){

        $institutionId = $_POST['institutionId'];
        $startdate = $_POST['startdate'];
        $tag_lati_long = trim($_POST['tag_lati_long']);
        if($tag_lati_long==",")$tag_lati_long="";
        $todaydate = date('Y-m-d');
        
        /*$count_days_diff = dateDiff($todaydate,$startdate);
        if($count_days_diff>1){
         exit('Cannot Accept Tag one day Before Routing');   
        }*/
        
        $proceed_options = $_POST['proceed_options'];

        $typeId = getValue('typeId','institutions',$institutionId);
        $specialityId = getValue('specialityId','institutions',$institutionId);

        $visitDate = date('Y-m-d');
        $datetimeAdded = date('Y-m-d H:i:s');
        $addressId = $db->select_one("select areaId from institutions_addresses where `default`=1 and instituteId=".$institutionId);

        $ReportID = ReportID($institutionId,$startdate);
        if($ReportID==0){

            if(@$_SESSION['CMSuserID']!='' and $institutionId!='' and $visitDate!=''){

                $insert_id = $db->insert_sql ( "INSERT INTO reports (medRepId,institutionId,typeId,specialityId,addressId,visitDate,tag,proceed_options,datetimeAdded,tag_lati_long) VALUES ('".@$_SESSION['CMSuserID']."', '".@$institutionId."', '".@$typeId."', '".@$specialityId."', '".@$addressId."', '".@$visitDate."',1,'".$proceed_options."','".$datetimeAdded."','".$tag_lati_long."')" ) ;

                $db->insert_sql ( "INSERT INTO reporttags (reportId,instId,startdate,tag,tagDateTime) VALUES ('".@$insert_id."', '".@$institutionId."', '".@$startdate."',1,'".$datetimeAdded."')");

                echo $insert_id;exit;

            }
        }else{
            echo $ReportID;exit;
        }
    }
?>