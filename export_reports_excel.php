<?php

header ( "Content-type: application/octet-stream" );

header ( "Content-Disposition: attachment; filename=reports.xls" );

header ( "Pragma: no-cache" );

header ( "Expires: 0" );

include ("common.php");

echo "<table cellspacing='3' cellpadding='3' border=1 align=center>";

echo "<thead style='font-weight:bold;'>

<tr style='font-weight:bold;'>

<td>ID</td>

<td>Medrep </td>

<td>Institute Name</td>

<td>Institute ID</td>

<td>Type</td>

<td>Speciality</td>

<td>VisitDate</td>

<td>Advocate</td>

<td>DoubleVisit</td>

<td>Supervisor</td>

<td>FaildVisit</td>

<td>Feedback</td>

<td>Product1</td>

<td>Product2</td>

<td>Sample1</td>

<td>Sample2</td>

<td>Area/Zone</td>

<td>Insert DateTime</td>

<td>200m > Reason</td>

<td>Actual Tagging location</td>
</tr>

</thead>";

	if(@$_POST['from_date'] and @$_POST['to_date']){

              $where=" where visitDate between '".$_POST['from_date']."' and '".$_POST['to_date']."' ";

             }

	$query_string = " SELECT *  FROM  reports $where  order by id desc ";  

    $query = mysql_query($query_string);   

    if(!$query){ die(mysql_error());  }

	while($result = mysql_fetch_array($query)){

        

        $areaID = $db->select_one("select areaId from institutions_addresses where `default`=1 and instituteId=".$result['institutionId']);

                    $parentID = getValue('parent','areas',$areaID);

                    if($parentID==0 or $parentID==""){$parentID=$areaID;}

                    $areaZone = getValue('name','areas',$parentID).' / '.getValue('name','areas',$areaID);

                  $typeId = getValue('typeId','institutions',$result['institutionId']);  

                  $speciality = "";

                  if($typeId==1){

                  $speciality = getValue('name','Specialties',getValue('specialityId','institutions',$result['institutionId']));

                  }

        if($result['deal']==1)$deal = "Yes";else $deal = "No";

        if($result['doubleVisit']==1)$doubleVisit = "Yes";else $doubleVisit = "No";

        if($result['faildVisit']==1)$faildVisit = "Yes";else $faildVisit = "No";

		 echo "<tr>

         <td>" .$result['id']  .  "</td>

         <td>" .getValue('name','users',$result['medRepId'])  .  "</td>

         <td>" .stripslashes(str_replace(',', ' ',getValue('name','institutions',$result['institutionId'])))  .  "</td>

         <td>" .$result['institutionId']  .  "</td>

         <td>" .getValue('name','institutionTypes',$typeId)  .  "</td>

         <td>" .$speciality  .  "</td>

         <td>" .$result['visitDate']  .  "</td>

         <td>" .$deal.  "</td>

         <td>" .$doubleVisit.  "</td>

         <td>" .getValue('name','users',$result['supervisorId'])  .  "</td>

         <td>" .$faildVisit.  "</td>

         <td>" .$result['feedback']  .  "</td>

         <td>" .getValue('name','products',$result['productId1'])  .  "</td>

         <td>" .getValue('name','products',$result['productId2'])  .  "</td>

         <td>" .getValue('name','products',$result['productId3'])  .  "</td>

         <td>" .getValue('name','products',$result['productId4'])  .  "</td>

         <td>" .$areaZone .  "</td>

         <td>" .$result['datetimeAdded'] .  "</td>

         <td>" .$result['proceed_options'] .  "</td>
         
		 <td>" .$result['tag_lati_long'] .  "</td>
		 </tr>";

}

echo "</table>";



?>

