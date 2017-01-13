<?php
set_time_limit(300);
/*header('Content-Type: application/force-download');
header ( "Content-Disposition: attachment; filename=institutions.xls" );
header("Pragma: ");
header("Cache-Control: ");*/
include ("common.php");
$export = "<table cellspacing='3' cellpadding='3' border=1 align=center>
<thead style =\" font-weight:bold; \">
                            <td>Id</td>
                            <td>Name </td>
                            <td>Class</td>
                            <td>Type </td>
                            <td>Speciality </td>
                            <th>Zone/Area</th>                            
                            <td>Affiliated Hospital </td>
                        </tr>
                    </thead>";
	$areasList=$_REQUEST['city'];
	$query_string = " SELECT *  FROM  institutions order by name asc limit 1";
    $query = mysql_query($query_string);
    if(!$query){ die(mysql_error());  }
	while($result = mysql_fetch_array($query)){
	$areaID = $db->select_one("select areaId from institutions_addresses where `default`=1 and instituteId=".$result['id']);
                    $parentID = getValue('parent','areas',$areaID);
                    if($parentID==0 or $parentID==""){$parentID=$areaID;}
                    $zoneArea= getValue('name','areas',$parentID).' / '.getValue('name','areas',$areaID);
		 $export.="<tr>
		 <td>".$result['id']  .  "</td>
		 <td>".str_replace(',', ' ',$result['name']).  "</td>
		 <td>".$result['class']  .  "</td>
		 <td>".getValue('name','institutionTypes',$result['typeId']).  "</td>
         <td>".getValue('name','Specialties',$result['specialityId']).  "</td>
		 <td>".$zoneArea."</td>
         <td>".str_replace(',', ' ',getValue('name','institutions',$result['hospitalId'])).  "</td>
		 </tr>";
}
$export.="</table>";
//sleep(5);
//echo $export;
phpinfo();
?>
