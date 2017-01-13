<? include_once ('common.php');
loggedIn ("index.php");
$where="";
if($_SESSION['role']==2 or $_SESSION['role']==4) $where=" where medrepId=".$_SESSION['CMSuserID'];
if(@$_REQUEST['todaydate']!=""){
$todaydate = $_REQUEST['todaydate'];   
}else{
$todaydate = date('Y-m-d');   
}                                        
$weekname = date('l', strtotime( $todaydate));



$where.=" and `$weekname`='".$todaydate."' ";   

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
}    





$select="select id,active,$column as instdata from routing $where and active=1 order by id desc";
$query=mysql_query($select);
$res=mysql_fetch_assoc($query);
if($res['instdata']!=''){
$inst = explode(',',$res['instdata']);   
for($i=0;$i<count($inst);$i++){

$InsID = $inst[$i];
$InsName = str_replace(',', ' ',getValue('name','institutions',$InsID));

$coordinates = getValue('coordinates','institutions',$InsID);

$areaID = $db->select_one("select areaId from institutions_addresses where `default`=1 and instituteId=".$InsID);
$parentID = getValue('parent','areas',$areaID);
if($parentID==0 or $parentID==""){$parentID=$areaID;}

$areazone = getValue('name','areas',$parentID).' / '.getValue('name','areas',$areaID);
$ReportID = ReportID($InsID,$todaydate);
$reporttag = getValue('tag','reports',$ReportID); 
$tagtime = getValue('datetimeAdded','reports',$ReportID);
$proceed_options = getValue('proceed_options','reports',$ReportID);
?>                                           
<tr style="background-color: <?if($ReportID==0){echo'#FB9C9C;'; $tagstage='red';}elseif($ReportID>0 and $reporttag==2 and $proceed_options==""){ echo 'green;'; $tagstage='green';}elseif($ReportID>0 and $reporttag==2 and $proceed_options!=""){ echo '#13D2F0'; $tagstage='blue';}elseif($ReportID>0 and $reporttag==1 and $proceed_options==""){ echo 'yellow'; $tagstage='yellow';}elseif($ReportID>0 and $reporttag==1 and $proceed_options!=""){ echo 'orange'; $tagstage='orange';}?>"> 

<td><?=$InsName?></td>
<td><?=$areazone?></td>

<td>
<?
if($coordinates!=''){
 if($ReportID==0){
    ?>                                             
<a class="icon-flag" onclick="select_tagging('<?=$InsID?>','<?=$InsName?>','<?=$coordinates?>',1,this)" title="Tag 1" href="javascript:void(0);" ></a><?}else{?>

<a class="icon-check colorbox-image cboxElement" title="Tag 2" href="insert_report_tagtwo.php?edit=<?=$ReportID?>" ></a>

<?}}?>
</td>
<td><?=$tagtime?></td> 
 <td>
<?if($coordinates==''){?><a href="start_update_inst_map.php?id=<?=$InsID?>" title="Map" class="colorbox-image cboxElement icon-map-marker" ></a><?}?>
</td>
 <td>
<a class="colorbox-image cboxElement" href="includes/startyourday_reports_view.php?edit=<?=$InsID?>" title="View"><i class="icon-search"></i></a>    
</td>


</tr>


<? } }?>