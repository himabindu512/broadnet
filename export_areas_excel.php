<?php
header ( "Content-type: application/octet-stream" );
header ( "Content-Disposition: attachment; filename=areas.xls" );
header ( "Pragma: no-cache" );
header ( "Expires: 0" );
include ("common.php");
echo "<table cellspacing='3' cellpadding='3' border=1 align=center>";
echo "<thead style='font-weight:bold;'>
<tr style='font-weight:bold;'>
<td>ID</td>
<td>Area Name</td>
<td>Zone Name</td>
</tr>
</thead>";

	$query_string = " SELECT *  FROM  areas  order by id desc ";  
    $query = mysql_query($query_string);   
    if(!$query){ die(mysql_error());  }
	while($result = mysql_fetch_array($query)){
        
        $areaID = $result['id'];
                    $parentID = $result['parent'];
                    if($parentID==0 or $parentID==""){$parentID=$areaID;}
                    $areaZone = getValue('name','areas',$parentID);
                  
		 echo "<tr>
         <td>" .$result['id']  .  "</td>
         <td>" .$result['name']  .  "</td>
         <td>" .$areaZone  .  "</td>
		 </tr>";
}
echo "</table>";

?>
