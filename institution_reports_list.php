<?

ini_set( "display_errors", 1);


?>

<div class="container-fluid">
	
    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                         <i class="icon-table"></i>
                                         Active Routing Templates Institutions Last Visit Reports List
                                         <?if($_SESSION['role']==1||$_SESSION['role']==3||$_SESSION['role']==5){?>
&nbsp;&nbsp;<a href="includes/export_routing_templates_institutions.php" target="_blank" data-toggle="modal" style="background:#E63A3A;color:white;padding:0px 5px 5px 5px;float: right;margin-left: 10px;"  > Export All</a>
<?}?>
                                    </h3>
                                </div>
                                <div class="box-content nopadding">
       

                                    <table class="table table-hover table-nomargin table-striped dataTable" id="dataTable-scroller">
                                        <thead>
                                            <tr>
                                                <th>Id</th>
                                                <th>NAme</th>
                                                <th>Type</th>
                                                <th>Zone / Area</th>
                                                <th>Speciality</th>
                                                <th>Class</th>
                                                <th>Route Name</th>
                                                <th>Last VisitDate</th>
                                                <th>days since last successful visit</th>
                                            </tr>
                                        </thead>
                                        <tbody>	
                                        <?
if($_SESSION['role']==2 || $_SESSION['role']==4){ 
    $sWhere="";
  if($_SESSION['role']==4){
        //$sWhere=" and IA.areaId in (select AreaId from salesmanpharmacies where salesManId=".$_SESSION['CMSuserID'].")";
    }
    if($_SESSION['role']==2){
       // $sWhere=" and IA.areaId in (select AreaId from medreppharmacies where MedrepId=".$_SESSION['CMSuserID'].")";
    }
$selectquery = "
SELECT RT.InstitutionsData,I.id,I.name,I.typeId,I.specialityId,I.class,RT.name as routename,IT.name as typename,S.name as Sname,IA.areaId FROM routestemplates RT
    LEFT JOIN institutions I on FIND_IN_SET(I.id, RT.InstitutionsData)
    LEFT JOIN institutions_addresses IA on (IA.instituteId=I.id )
    LEFT JOIN areas A ON ( A.id = IA.areaId ) 
    LEFT JOIN institutionTypes IT on (IT.id=I.typeId )
    LEFT JOIN users U on (U.id=RT.userId )
    LEFT JOIN Specialties S on (S.id=I.specialityId )
  WHERE RT.active=1  $sWhere and RT.userId=".$_SESSION['CMSuserID']." and `default`=1 group by I.id order by I.id desc
";
}else{
$selectquery = " SELECT RT.InstitutionsData,I.id,I.name,I.typeId,I.specialityId,I.class,RT.name as routename,IT.name as typename,S.name as Sname,IA.areaId FROM routestemplates RT
    LEFT JOIN institutions I on FIND_IN_SET(I.id, RT.InstitutionsData) > 0
    LEFT JOIN institutions_addresses IA on (IA.instituteId=I.id )
    LEFT JOIN areas A ON ( A.id = IA.areaId ) 
    LEFT JOIN institutionTypes IT on (IT.id=I.typeId )
    LEFT JOIN users U on (U.id=RT.userId )
    LEFT JOIN Specialties S on (S.id=I.specialityId )
  WHERE RT.active=1 AND FIND_IN_SET(I.id, RT.InstitutionsData) and `default`=1 group by I.id order by I.id desc";
}
//$selectquery = " SELECT institutions.id,institutions.name,institutions.typeId,institutions.specialityId,institutions.class,routestemplates.name as routename FROM institutions, routestemplates, users ,institutions_addresses WHERE routestemplates.active=1 AND `default`=1 AND users.id='".$_SESSION['CMSuserID']."' AND FIND_IN_SET(institutions.id, routestemplates.InstitutionsData) AND institutions_addresses.areaId in(users.areaIds) order by institutions.id desc";
//echo$selectquery;


$query=mysql_query($selectquery);
while($res=mysql_fetch_assoc($query)) {

$areaID = $res['areaId'];

//$usersareaIds = getValue('areaIds','users',$_SESSION['CMSuserID']);
//$areaIds = explode(',',$usersareaIds);
//print_r($areaIds);
$parentID = getValue('parent','areas',$areaID);
if($parentID==0 or $parentID==""){$parentID=$areaID;}
$areaZone = getValue('name','areas',$parentID).' / '.getValue('name','areas',$areaID);

//$routename = $db->select_one("select name from routestemplates  where active=1 and InstitutionsData LIKE '".$res['id']."%' limit 1");
$visitDate = $db->select_one("SELECT visitDate FROM reports WHERE institutionId='".$res['id']."'  order by id desc limit 1");
if($visitDate==""){
    $countdays = "";
}else{
$countdays = dateDiff($visitDate,date('Y-m-d'));
}
if($visitDate==""){$visitDate="No Visit";}


//if(in_array($areaID,$areaIds) || $_SESSION['role']==1||$_SESSION['role']==3||$_SESSION['role']==5){ 
?>                                           
<tr>
<td><?=$res['id']; ?></td>
<td><?=str_replace("\\", '',str_replace(',', ' ',$res['name'])); ?></td>
<td><?=$res['typename'];?></td>
<td><?=$areaZone?></td>
<td><?=$res['Sname']?></td>
<td><?=$res['class']; ?></td>
<td><?=str_replace("\\", '',$res['routename']); ?></td>
<td><?=$visitDate; ?></td>
<td><?=$countdays; ?></td>
</tr>
<?}//}?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    
</div>
