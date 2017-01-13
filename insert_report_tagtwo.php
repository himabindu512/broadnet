<?
include 'common.php'; 
loggedIn ("index.php");
//$db->print_last_query();
// print_r($_REQUEST);
//exit;
if ( @$_REQUEST ['submit'] == "Update") 
{
    $update_families = $db->update_sql (" update reports set
                                         
                                         status                    ='1',
                                         tag                        ='2',
                                         institutionId                    ='".@$_REQUEST['institutionId']."',
                                         typeId                    ='".@$_REQUEST['parent']."',
                                         specialityId                    ='".@$_REQUEST['specialityId']."',
                                         supervisorId                    ='".@$_REQUEST['supervisorId']."',
                                         addressId                    ='".@$_REQUEST['addressId']."',
                                         visitDate                   ='".$_REQUEST['visitDate']."',
                                         deal                   ='".@$_REQUEST['deal']."',
                                         doubleVisit             ='".@$_REQUEST['doubleVisit']."',
                                         faildVisit               ='".@$_REQUEST['faildVisit']."',
                                         feedback                  ='".$_REQUEST['feedback']."',
                                         productId1                    ='".$_REQUEST['productId1']."',
                                         productId2                    ='".$_REQUEST['productId2']."',
                                         productId3                    ='".$_REQUEST['productId3']."',
                                         productId4                    ='".$_REQUEST['productId4']."'
                                         where id     ='".$_REQUEST['edit']."' ");
                                         //$db->print_last_query();
    $pid=$_REQUEST['edit'];
    exit;
}     
?>
<style type="text/css">
@media (max-width: 768px) {
.control-group {
    border-bottom: 0 solid #ddd;
    padding: 0 10px !important;
    margin-bottom: 0px !important;
}
button.close{padding-right: 10px !important;}
.modal{
    position: fixed;
    top: 20px;
    right: 20px;
    left: 20px;
    width: 93%;
    margin: 0;
  } 
}
.form-vertical.form-bordered .control-group {
    border-bottom: 0px solid #ddd;
    padding: 10px 20px;
}
.pickers{
 float: right;
 margin-top: -35px; 
 position: relative;
 margin-right: 5px;  
}
label{font-weight: bold;}h3{background-color: #368ee0;color: white;}#cboxLoadedContent{background: white;}#cboxTitle{display: none !important}
#cboxOverlay {background: none repeat scroll 0 0 #000;}
</style>
<script>
  $("#submit_updatereport_ajax").validate({
submitHandler: function(form) {
    submit_updatereport_ajax();
    }
});
function submit_updatereport_ajax(){
  var form = $('#submit_updatereport_ajax');
  var coordinates = $('#submit_updatereport_ajax #coordinates').val();
  var submit = $('#submit_updatereport_ajax #submit').val();
  var todaydate = $('#todaydate').val();
    $.ajax({
      type: "GET",
      url: "insert_report_tagtwo.php",
      data: form.serialize(),
      success: function( response ) {
          response = response.trim();
          //form[0].reset(); 
          //var formfeild = response.split("_");
      $.ajax({
       type: "GET",
       url: "ajax_startyourday.php",
       data: 'todaydate='+todaydate,
       cache: false,
       success: function(result){
           $('#tbody_startyourday').html(result);
           //form[0].reset(); 
           $('#cboxClose').click();
           $('.colorbox-image').colorbox();
            }
       });
       
       
      },
      cache: false,
        contentType: false,
        processData: false
    });
}
</script>


	<div class="wrapper">
	                    
<form method="POST" action="insert_report_tagtwo.php" name="submit_updatereport_ajax" id="submit_updatereport_ajax" class="form-vertical form-bordered form-validate" onSubmit="return false;" enctype="multipart/form-data">
<div class="box-title" >
    <h3> <i class="icon-th-list"></i> Reports</h3>    
</div>
<div class="box-content nopadding">
<?    


if($_SESSION['role']==2 or $_SESSION['role']==4) $where=" and medRepId=".$_SESSION['CMSuserID']; else $where="";

if(@$_REQUEST['edit']!='')
{
$res = $db->select ( "select * from reports where id=".$_REQUEST['edit']." $where" );
$row = $db->get_row ( $res, 'MYSQL_BOTH' );
}

$institutionId = $row['institutionId'];

$typeId = getValue('typeId','institutions',$institutionId);
$specialityId = getValue('specialityId','institutions',$institutionId);

$visitDate = date('Y-m-d');
$addressId = $db->select_one("select areaId from institutions_addresses where `default`=1 and instituteId=".$institutionId);

?>
<input type="hidden" name="edit" id="edit"  value=<?=@$_REQUEST['edit']; ?>>


<div class="row-fluid">
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">MedRep</label>
<div class="controls">
<input type="hidden"  name="medRepId" id="medRepId" value="<? if(@$row['medRepId']!=''){ echo $row['medRepId'];}elseif($_SESSION['role']==2 or $_SESSION['role']==4 or $_SESSION['role']==3){ echo $_SESSION['CMSuserID'];} ?>">
<input type="text"  name="medRep" id="medRep" class="input-block-level" readonly="readonly" value="<? if(@$row['medRepId']!=''){ echo @getValue('name','users',$row['medRepId']);}elseif($_SESSION['role']==2 or $_SESSION['role']==4 or $_SESSION['role']==3){ echo getValue('name','users',$_SESSION['CMSuserID']);} ?>">
<!--<div class="pickers">
&nbsp;&nbsp;<a href="#lightbox-medReps" data-toggle="modal" ><i class="icon-edit"></i></a>

&nbsp;&nbsp;<a href="javascript:" onClick="return removeSelectedValue('medRepId-medRep');" title="clear">X</a> 
</div>-->
</div>
</div>
</div>

<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">VisitDate</label>
<div class="controls">
<input type="text" name="visitDate" autocomplete="off"  id="visitDate" readonly="readonly" placeholder="visitDate" class="input-block-level required" value="<?=$row['visitDate']; ?>">
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Doctor/Pharmacy/Institution</label>
<div class="controls">
<input type="hidden" name="parent" id="typeId" value="<? if(@$typeId!='') echo $typeId; ?>">
<input type="hidden" name="institutionId" id="institutionId" value="<? if(@$institutionId!='') echo $institutionId; ?>">
<input type="text" name="institution" id="institution" class="input-block-level" readonly="readonly" value="<? if(@$institutionId!='') echo str_replace(',', ' ',getValue('name','institutions',$institutionId)); ?>">
</div>
</div>
</div>
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Address</label>
<div class="controls" id="address_list">
<?if(@$institutionId!=''){?>
<select class="chosen-select input-block-level"  name="addressId" id="addressId">
<?
$query="select * from institutions_addresses where instituteId=".$institutionId;
$queryproducts=mysql_query($query);
while($products=mysql_fetch_assoc($queryproducts)) {
?><option value="<?=$products['id']?>" <?if(@$row['addressId']==$products['id']) echo 'selected';?> >
<?=getValue('name','areas',$products['areaId'])?> - <?=getValue('name','areas',getValue('parent','areas',$products['areaId']))?> - <?=$products['address']?> | <?=$products['phone']?>
</option><?}?>
</select>
<?}?>
</div>
</div>
</div>
</div>
<div class="row-fluid">

<div class="span6" id="Specialties" style="display: none;">
<div class="control-group" style="display: none;">
<label for="textfield" class="control-label">Specialties</label>
<div class="controls">
<input type="hidden" name="specialityId" id="specialityId" value="<? if(@$specialityId!='') echo $specialityId ?>">
<input type="text" name="speciality" id="speciality" class="input-block-level" readonly="readonly" value="<? if(@$specialityId!='') echo getValue('name','Specialties',$specialityId); ?>">
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span4">
<div class="control-group">
<!--<label for="textfield" class="control-label">Failed Visit</label>-->
<div class="controls">
<input type="checkbox" name="faildVisit" onclick="Feedback_required();" id="faildVisit" style="float: left" value="1" <? if(@$row['faildVisit']==1) echo 'checked'; ?>>
<label for="faildVisit" class="inline">&nbsp;&nbsp;Failed Visit</label>
</div>
</div>
</div>
<div class="span4">
<div class="control-group">
<!--<label for="textfield" class="control-label">Deal</label>-->
<div class="controls">
<input type="checkbox" name="deal" style="float: left" id="deal" value="1" <? if(@$row['deal']==1) echo 'checked'; ?>>
<label for="deal" class="inline" style="float: left">&nbsp;&nbsp;Deal</label>
</div>
</div>
</div>
<div class="span4">
<div class="control-group">
<!--<label for="textfield" class="control-label">Double Visit</label>-->
<div class="controls">
<input type="checkbox" name="doubleVisit" onclick="Select_Supervisor();" id="doubleVisit" value="1" style="float: left" <? if(@$row['doubleVisit']==1) echo 'checked'; ?>>
<label for="doubleVisit" class="inline" style="float: left">&nbsp;&nbsp;Double Visit</label>
</div>
</div>
</div>

</div>
<div class="row-fluid">
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Feedback</label>
<div class="controls">
<textarea name="feedback" required style="height: 100px;" id="feedback" class="input-block-level"><? if(@$row['feedback']!='') echo $row['feedback']; ?></textarea>
</div>
</div>
</div>
<div class="span6">
<div class="control-group" id="supervisor_row" style="display: none;">
<label for="textfield" class="control-label">Supervisor</label>
<div class="controls">
<select class="input-block-level" name="supervisorId" id="supervisorId">
<option value="">Select Supervisor</option>
<?
$selectproducts="select * from users where role in (3,5) order by id ";
$queryproducts=mysql_query($selectproducts);
while($products=mysql_fetch_assoc($queryproducts)) {
?><option value="<?=$products['id']?>" <?if(@$row['supervisorId']==$products['id']) echo 'selected';?> ><?=$products['name']?></option><?}?>
</select>
</div>
</div>
</div>
</div>
<div class="row-fluid">
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Products discussed</label>
<div class="controls">
<select class="input-block-level" required name="productId1" id="productId1">
 <?if(@$row['productId1']!=""){?><option value="<?=$row['productId1']?>"><?=getValue('name','products',$row['productId1']);?></option><?}?>
<option value="" <?if(@$row['productId1']==0){ echo 'selected="selected"'; }?>>Select Product 1</option>
<?
$selectproducts="select * from products where deleted=0 order by id ";
$queryproducts=mysql_query($selectproducts);
while($products=mysql_fetch_assoc($queryproducts)) {
?><option value="<?=$products['id']?>" ><?=$products['name']?></option><?}?>
</select>
<select class="input-block-level"  name="productId2" id="productId2">
<?if(@$row['productId2']!=""){?><option value="<?=$row['productId2']?>"><?=getValue('name','products',$row['productId2']);?></option><?}?>
<option value="" <?if(@$row['productId2']==0){ echo 'selected="selected"'; }?>>Select Product 2</option>
<?
$selectproducts="select * from products where deleted=0 order by id ";
$queryproducts=mysql_query($selectproducts);
while($products=mysql_fetch_assoc($queryproducts)) {
?><option value="<?=$products['id']?>" ><?=$products['name']?></option><?}?>
</select>
</div>
</div>
</div>
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Samples Given</label>
<div class="controls">
<select class="input-block-level"  name="productId3" id="productId3">
 <?if(@$row['productId3']!=""){?><option value="<?=$row['productId3']?>"><?=getValue('name','products',$row['productId3']);?></option><?}?>
<option value="" <?if(@$row['productId3']==0){ echo 'selected="selected"'; }?>>Select Sample 1</option>
<?
$selectproducts="select * from products where deleted=0 order by id ";
$queryproducts=mysql_query($selectproducts);
while($products=mysql_fetch_assoc($queryproducts)) {
?><option value="<?=$products['id']?>" ><?=$products['name']?></option><?}?>
</select>
<select class="input-block-level"  name="productId4" id="productId4">
 <?if(@$row['productId4']!=""){?><option value="<?=$row['productId4']?>"><?=getValue('name','products',$row['productId4']);?></option><?}?>
<option value="" <?if(@$row['productId4']==0){ echo 'selected="selected"'; }?>>Select Sample 2</option>
<?
$selectproducts="select * from products where deleted=0 order by id ";
$queryproducts=mysql_query($selectproducts);
while($products=mysql_fetch_assoc($queryproducts)) {
?><option value="<?=$products['id']?>" ><?=$products['name']?></option><?}?>
</select>
</div>
</div>
</div>
</div>

<? if($_REQUEST['edit']!="") { ?>
<div class="form-actions">
<button type="submit" class="btn btn-primary" name="submit" value="Update" >Update</button>
</div>
<? } else { ?>
<div class="form-actions">
<button type="submit" class="btn btn-primary" name="submit" value="Insert" >Insert</button>
</div>
<? } ?>
</div>
</form>
<script type="text/javascript">
$(".form-validate").length>0&&$(".form-validate").each(function(){var e=$(this).attr("id");$("#"+e).validate({errorElement:"span",errorClass:"help-block error",errorPlacement:function(e,t){t.parents(".controls").append(e)},highlight:function(e){$(e).closest(".control-group").removeClass("error success").addClass("error")},success:function(e){e.addClass("valid").closest(".control-group").removeClass("error success").addClass("success")}})});
function ValidateReprts(){
    var institution=$("#institution").val();
    var institutionId=$("#institutionId").val();
    var visitDate=$("#visitDate").val();
    if(visitDate==""){alert("Select visitDate");return false;}
    if(institution=="" || institutionId==""){alert("Select Institution From Picker");return false;}
    
    
    else{ return true;}
}
function Feedback_required(){
    if($('#faildVisit').prop('checked')) {
    $('#feedback').removeAttr('required');
    $('#productId1').removeAttr('required');
    } else {
    $("#feedback").prop("required", true);
    $("#productId1").prop("required", true);
    }
}
//$("#visitDate").keydown(function (e) {e.preventDefault();});
//$('.datepick').datepicker({dateFormat:"yy-mm-dd",minDate:startDateFrom,maxDate: endDateTo});
function Select_Supervisor(){
    if($('#doubleVisit').prop('checked')) {
    $('#supervisor_row').show();
    $("#supervisorId").prop("required", true);
    } else {
    $('#supervisor_row').hide();
    $("#supervisorId").prop("required", false);
    }
}

$( document ).ready(function() {
Select_Supervisor();
});
</script>
    
    

    
	</div>
	

