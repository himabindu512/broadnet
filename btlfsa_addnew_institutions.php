                   
<form method="POST" name="institutions" id="institutions" class="form-vertical form-bordered" onSubmit="return ValidateReprts();" style="margin: 0px;" enctype="multipart/form-data">

<?	
if(@$_REQUEST['edit']!='')
{
$res = $db->select ( "select * from institutions where id=".$_REQUEST['edit']."" );
$row = $db->get_row ( $res, 'MYSQL_BOTH' );
$Mon_Data = explode(',',$row['Mon_Data']);   
$Tues_Data = explode(',',$row['Tues_Data']);   
$Wednes_Data = explode(',',$row['Wednes_Data']);   
$Thurs_Data = explode(',',$row['Thurs_Data']);   
$Fri_Data = explode(',',$row['Fri_Data']);  
}
?>
<input type="hidden" name="edit" id="edit"  value=<?=@$_REQUEST['edit']; ?>>
<div class="row-fluid">
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">Institution Type</label>
<div class="controls">
<input type="hidden" name="typeId" id="typeId" value="<? if(@$row['typeId']!='') echo $row['typeId']; ?>">
<input type="text" name="type" id="type"  onchange="Specialties_HospitalHideShow(this.value)" class="input-block-level" style="display: block;" readonly="readonly" value="<? if(@$row['typeId']!='') echo getValue('name','institutionTypes',$row['typeId']); ?>" placeholder="Select Institution Type">
<div class="pickers">
&nbsp;&nbsp;<a href="#lightbox-institutionTypes" data-toggle="modal" ><i class="icon-edit"></i></a>

&nbsp;&nbsp;<a href="javascript:" onClick="return removeSelectedValue('typeId-type');" title="clear">X</a> 
</div>
<input type="text" name="Pname" style="display: none" id="Pname" placeholder="Pharmacy Name" class="input-block-level" value="<? if(@$row['pharmacistName']!='' and @$row['typeId']==3) echo $row['name'];?>" />
</div>
</div>
</div>
<div class="span6">

</div>
</div>

<div class="row-fluid">
<div class="span6 Insname" >
<div class="control-group">
<label for="textfield" class="control-label">Name</label>
<div class="controls">
<input type="text" name="name" autocomplete="off" id="name" placeholder="Institution Name" class="input-block-level" value="<? if(@$row['name']!='') echo $row['name']; ?>">
</div>
</div>
</div>
<div style="display: none;" id="pharmacistName">
<div class="span3">
<div class="control-group">
<label for="textfield" class="control-label">LastName</label>
<div class="controls">
<input type="text" name="lastname" autocomplete="off" id="lastname" placeholder="Last Name" class="input-block-level" value="<?if(@$row['typeId']==1){ $explode=explode(",",@$row['name']); echo @$explode[0]; }elseif(@$row['typeId']==3){ $explode=explode(",",@$row['pharmacistName']); echo @$explode[0]; }?>">
</div>
</div>
</div>
<div class="span3">
<div class="control-group">
<label for="textfield" class="control-label">FirstName</label>
<div class="controls">
<input type="text" name="firstname" autocomplete="off" id="firstname" placeholder="First Name" class="input-block-level" value="<?if(@$row['typeId']==1){ $explode=explode(",",@$row['name']); echo @$explode[1].' '.@$explode[2]; }elseif(@$row['typeId']==3){ $explode=explode(",",@$row['pharmacistName']); echo @$explode[1].' '.@$explode[2]; }?>">
</div>
</div>
</div>
</div>
<div class="span6">

</div>
</div>


<input type="hidden" value="<?if($fm>0){echo $fm;}else{ echo $fm;}?>" name="fm" id="fm" />
<input type="hidden" value="" name="fmvalue" id="fmvalue" />


<? if($_REQUEST['edit']!="") { ?>
<div class="form-actions">
<button type="submit" class="btn btn-primary" name="submit" value="Update" >Update</button>
</div>
<? } else { ?>
<div class="form-actions">
<button type="button" class="btn btn-primary" onclick="ajax_check_duplicate_institutions();" name="submit" value="Insert" >Insert</button>
</div>
<? } ?>
<div id="ajax_institute_listings_duplicate" style="float: right; margin-top: -50px;width:80%;"></div>

</form>
<a data-toggle="modal" style="display: none;" id="a_institutions_duplicate" href="#lightbox-institutions_duplicate"><i class="icon-edit"></i></a>
<script type="text/javascript">
function cancel_institutions(){    
    $("#ajax_institute_listings_duplicate").html("");
}
function ajax_check_duplicate_institutions(){    
    var typeId = $("#typeId").val();
    var specId = $("#specialityId").val();
    var type = $("#type").val();
    var areaID = $("#areaId_1").val();
    var name = "";
    var firstname = "";
    var lastname = "";
    //alert(areaID);
    if(type=="Doctor"){
     firstname =$("#firstname").val();
     lastname  =$("#lastname").val();
    //name = lastname+" "+firstname;
    }else if(type=="Pharmacy"){ name = $("#Pname").val();    }
    else{     name = $("#name").val();    }  
  if(typeId!=""){
      
     //$('#a_institutions_duplicate').click(); 
 $.ajax({
   type: "POST",
   url: "includes/btlfsa_didyoumean_institute.php",
   data: "name="+name+"&lastname="+lastname+"&firstname="+firstname+"&typeId="+typeId+"&areaID="+areaID+"&specialityId="+specId,
   success: function(msg){
      //$('#ajax_institute_listings_duplicate').html(msg);
      $("#ajax_institute_listings_duplicate").fadeIn("fast").html(msg);
      //$('#ajax_institute_listings_duplicate').delay(10000).fadeOut('slow');
       }
     });
//$("#ajax_institute_listings_duplicate").fadeIn("fast").html(msg);
//$("#ajax_institute_listings_duplicate").delay(1000).hide();
  }
}
function select_institutionTypes(id,name)
{
    document.getElementById("typeId").value=id;
    document.getElementById("type").value=name;
    Specialties_HospitalHideShow(name);
    //document.getElementById("withNationality").value=name;
    $('.close').click();
}
function select_areasaddress(id,name)
{
    var fmvalue = $('#fmvalue').val(); 
    document.getElementById("areaId_"+fmvalue).value=id;
    document.getElementById("area_"+fmvalue).value=name;
    //document.getElementById("withNationality").value=name;
    $('.close').click();
}
function ValidateReprts(){
    var institution=$("#type").val();
    var institutionId=$("#typeId").val();
    var specialityId=$("#specialityId").val();
    var hospitalId=$("#hospitalId").val();
    var areaId_1=$("#areaId_1").val();
    //alert($("#areaId_1").val());
    var visitDate=$("#visitDate").val();
    if(institutionId==""){alert("Select Institution Type From Picker");return false;}
    if(institutionId==1 && ( specialityId=="" || specialityId==0 )){alert("Select Speciality From Picker");return false;}
    //if(institutionId==1 && hospitalId==""){alert("Select Hospital From Picker");return false;}
    
    /*if($("#areaId_2").length) {
    var areaId_2=$("#areaId_2").val();
    if(areaId_2==""){alert("Select Area2 From Picker");return false;}
    }
    if($("#areaId_3").length) {
    var areaId_3=$("#areaId_3").val();
    if(areaId_3==""){alert("Select Area3 From Picker");return false;}
    }*/
    if($('.area_fields').length === 0){alert("Minimum one Address required");return false;}
    if(areaId_1=="" || areaId_1==0){alert("Select Area From Picker");return false;}
    else{ return true;}
}
function changefmvalue(fm){
  $("#fmvalue").val(fm);  
}
function Specialties_HospitalHideShow(type){
    var type = $("#type").val();
    //alert(type);
    if(type=="Doctor"){
     $("#Specialties_Hospital").show();  
     $("#pharmacistName").hide(); 
     $("#Pname").hide(); 
     $('.Insname').hide();
     $("#name").prop("required", false);
     $("#Pname").prop("required", false);
     $("#firstname").prop("required", true);
     $("#lastname").prop("required", true);
     $("#pharmacistName").show();  
    }else if(type=="Pharmacy"){
     $("#pharmacistName").show();  
     $("#Pname").show();  
     $("#Specialties_Hospital").hide(); 
     $('.Insname').hide();
     $("#Pname").prop("required", true);
     $("#name").prop("required", false);
     $("#firstname").prop("required", false);
     $("#lastname").prop("required", false);
    }else{
    $("#Specialties_Hospital").hide();  
    $("#pharmacistName").hide(); 
    $("#Pname").hide(); 
    $('.Insname').show();
    $("#name").prop("required", true);
    $("#Pname").prop("required", false);
     $("#firstname").prop("required", false);
     $("#lastname").prop("required", false);
    }
}
$( document ).ready(function() {
var type = $("#type").val();    
Specialties_HospitalHideShow(type)
$(".phonenumber").keydown(function (e) {
var tlength = $(this).val().length;                 
var tvalue = $(this).val();
// alert(tvalue);
// alert(tlength);
if(tlength == 2)
{
var tvalue = $(this).val() + '-';
$(this).val(tvalue);
}
if(tlength>8)
{
    // Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right
(e.keyCode >= 35 && e.keyCode <= 39)) {
// let it happen, don't do anything

return;
}else{
e.preventDefault();
}
}
// Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right
(e.keyCode >= 35 && e.keyCode <= 39)) {
// let it happen, don't do anything

return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
e.preventDefault();
}
});
});

function add_imgs()
    {
        var fcount  = document.getElementById('fm').value;
        var sid        = parseInt(fcount)+1;
        document.getElementById('fm').value=parseInt(fcount)+1;
        $.ajax({
                   type: "POST",
                   url: "includes/ajax_add_address.php",
                   data: "fmcount="+sid,
                   success: function(msg){
                      //alert(msg);
                     $('#mydiv').append(msg);
                     $(".phonenumber").keydown(function (e) {
var tlength = $(this).val().length;                 
var tvalue = $(this).val();
// alert(tvalue);
// alert(tlength);
if(tlength == 2)
{
var tvalue = $(this).val() + '-';
$(this).val(tvalue);
}
if(tlength>8)
{
    // Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right
(e.keyCode >= 35 && e.keyCode <= 39)) {
// let it happen, don't do anything

return;
}else{
e.preventDefault();
}
}
// Allow: backspace, delete, tab, escape, enter and .
if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 110, 190]) !== -1 ||
// Allow: Ctrl+A
(e.keyCode == 65 && e.ctrlKey === true) || 
// Allow: home, end, left, right
(e.keyCode >= 35 && e.keyCode <= 39)) {
// let it happen, don't do anything

return;
}
// Ensure that it is a number and stop the keypress
if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
e.preventDefault();
}
});
                       }
                 });
    }
    function delete_imgs(delid,fm)
    {
        if(delid==0){
        if(fm>1){
            $('#delcontrols_'+fm).html("");
        }
        }else{
            if($('.area_fields').length < 2){alert("Minimum one Address required");return false;}else{
        $.ajax({
                   type: "POST",
                   url: "includes/ajax_delete_address.php",
                   data: "delid="+delid,
                   success: function(msg){
                      $('#delcontrols_'+fm).html("");
                       }
                 });
        }}
    }
    
</script>
