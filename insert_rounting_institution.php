<?
    include 'common.php'; 
    loggedIn ("index.php");
    
        $institutionId = $_POST['institutionId'];
        $feild = $_POST['feild'];
        $column = $_POST['column'];
        $todaydate = $_POST['todaydate'];
        $routingID = $_POST['routingID'];

    if (@$institutionId!="" and $feild!='' and $column!='' and $todaydate!='' and $routingID!=''){

        
        $columndata = getValue($column,'routing',$routingID);
        $inst = explode(',',$columndata); 
        
        if (count($inst)>=45) {
            echo 'Institution more than 45';
            exit;
        }
        if (in_array($institutionId, $inst)) {
            echo 'Institution Already Exists';
            exit;
        }
        $columndata = $columndata.','.$institutionId;
        $inst = explode(',',$columndata); 
        
        $Mon_Data = implode(',',array_unique($inst));
        $update_families = $db->update_sql ( " update routing set `$column` ='".$Mon_Data."' where id ='".$routingID."' ");
        echo 'Institution Added';
        exit;
    }else{
     echo 'Institution Not Added';   
    }
?>