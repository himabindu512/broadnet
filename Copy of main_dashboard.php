<div class="container-fluid">
<div class="page-header">
    <div class="pull-left" >
        <h1 style="font-size:4vw;">Dashboard</h1>
    </div>
    <div class="pull-right">
        <ul class="stats" style="display: block !important;">
            <li class="lightred">
                <i class="icon-calendar"></i>
                <div class="details" >
                    <span class="big"></span>
                    <span></span>
                </div>
            </li>
        </ul>
    </div>
</div>
<div class="row-fluid">
<div class="span6">
<div class="box box-color box-bordered">
<div class="box-title">
<h3>
<i class="icon-book"></i>
<a href="main.php?g=reports&p=4" style="color: #fff;" >Reports List</a>
</h3>
<div class="actions">
<!--<a class="btn btn-mini content-refresh" href="#"><i class="icon-refresh"></i></a>
<a class="btn btn-mini content-remove" href="#"><i class="icon-remove"></i></a>-->
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>MedRep</th>
<th>Institution</th>
</tr>
<?
if($_SESSION['role']==2) $where=" where medRepId=".$_SESSION['CMSuserID']; else $where="";
$selectreports="select * from reports $where order by id desc limit 5";
$queryreports=mysql_query($selectreports);
while($resreports=@mysql_fetch_assoc($queryreports)) {
?>
<tr>
<td><a href="main.php?g=reports&p=4&edit=<?=$resreports['id']?>" target="_blank"><?=getValue('name','users',$resreports['medRepId']); ?></a></td>
<td><?=getValue('name','institutions',$resreports['institutionId']); ?></td>
</tr>                                                
<?}?>
</table>                                         
</div>
</div>
</div>
</div>
<div class="span6">
<div class="box box-color lightred box-bordered">
<div class="box-title">
<h3>
<i class="icon-road"></i>
<a href="main.php?g=routing&p=5" style="color: #fff;">Routing List</a>
</h3>
<div class="actions">
<!--<a class="btn btn-mini content-refresh" href="#"><i class="icon-refresh"></i></a>
<a class="btn btn-mini content-remove" href="#"><i class="icon-remove"></i></a>-->
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>MedRep</th>
<th>Monday</th>
</tr>
<?
if($_SESSION['role']==2) $where=" where medRepId=".$_SESSION['CMSuserID']; else $where="";
$selectrouting="select id,medrepId,Monday from routing $where order by id desc limit 5";
$queryrouting=mysql_query($selectrouting);
while($resrouting=@mysql_fetch_assoc($queryrouting)) {
?>
<tr>
<td><a href="main.php?g=routing&p=5&edit=<?=$resrouting['id']?>" target="_blank"><?=getValue('name','users',$resrouting['medrepId']); ?></a></td>
<td><?=$resrouting['Monday']?></td>
</tr>                                                
<?}?>
</table>
</div>
</div>
</div>
</div>
</div>



<div class="row-fluid">
<div class="span6">
<div class="box box-color box-bordered green">
<div class="box-title">
<h3>
<i class="icon-plus-sign-alt"></i>
<a href="main.php?g=institutions&p=1" style="color: #fff;" >Institutions List</a>
</h3>
<div class="actions">
<a class="btn btn-mini content-slideUp" href="#"><i class="icon-angle-down"></i></a>
</div>
</div>
<div class="box-content">
<div class="statistic-big">
<table class="table table-hover table-nomargin table-striped">
<tr>
<th>Name</th>
<th>Type</th>
</tr>
<?
$selectinstitutions="select * from institutions order by id desc limit 5";
$queryinstitutions=mysql_query($selectinstitutions);
while($resinstitutions=@mysql_fetch_assoc($queryinstitutions)) {
?>
<tr>
<td><a href="main.php?g=institutions&p=1&edit=<?=$resinstitutions['id']?>" target="_blank"><?=$resinstitutions['name']; ?></a></td>
<td><?=getValue('name','institutionTypes',$resinstitutions['typeId']); ?></td>
</tr>                                                
<?}?>
</table>                                         
</div>
</div>
</div>
</div>
</div>


</div>