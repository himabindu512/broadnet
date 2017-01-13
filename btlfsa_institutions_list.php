<?
@include_once ('common.php');
?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Apple devices fullscreen -->
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
    <!-- Apple devices fullscreen -->
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <!-- Apple devices fullscreen -->
    <meta names="apple-mobile-web-app-status-bar-style" content="black-translucent" />
    
    <title>MedReps</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Bootstrap responsive -->
    <link rel="stylesheet" href="css/bootstrap-responsive.min.css">
    <!-- jQuery UI -->
    <link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/plugins/jquery-ui/smoothness/jquery.ui.theme.css">
    <!-- PageGuide -->
    <link rel="stylesheet" href="css/plugins/pageguide/pageguide.css">
    <!-- Fullcalendar -->
    <link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.css">
    <link rel="stylesheet" href="css/plugins/fullcalendar/fullcalendar.print.css" media="print">
    <!-- Tagsinput -->
    <link rel="stylesheet" href="css/plugins/tagsinput/jquery.tagsinput.css">
    <!-- chosen -->
    <link rel="stylesheet" href="css/plugins/chosen/chosen.css">
    <!-- colorbox -->
    <link rel="stylesheet" href="css/plugins/colorbox/colorbox.css">
    <!-- multi select -->
    <link rel="stylesheet" href="css/plugins/multiselect/multi-select.css">
    <!-- timepicker -->
    <link rel="stylesheet" href="css/plugins/timepicker/bootstrap-timepicker.min.css">
    <!-- colorpicker -->
    <link rel="stylesheet" href="css/plugins/colorpicker/colorpicker.css">
    <!-- Datepicker -->
    <link rel="stylesheet" href="css/plugins/datepicker/datepicker.css">
    <!-- Plupload -->
    <link rel="stylesheet" href="css/plugins/plupload/jquery.plupload.queue.css">
    <!-- select2 -->
    <link rel="stylesheet" href="css/plugins/select2/select2.css">
    <!-- icheck -->
    <link rel="stylesheet" href="css/plugins/icheck/all.css">
    <!-- Theme CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Color CSS -->
    <link rel="stylesheet" href="css/themes.css">
<!-- dataTables -->
    <link rel="stylesheet" href="css/plugins/datatable/TableTools.css">
    <!-- chosen -->
    <link rel="stylesheet" href="css/plugins/chosen/chosen.css">

    <!-- jQuery -->
    <script src="js/jquery.min.js"></script>
    
    <!-- Nice Scroll -->
    <script src="js/plugins/nicescroll/jquery.nicescroll.min.js"></script>
    
    <!-- jQuery UI -->
    <script src="js/plugins/jquery-ui/jquery.ui.core.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.widget.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.mouse.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.draggable.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.resizable.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.sortable.min.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.spinner.js"></script>
    <script src="js/plugins/jquery-ui/jquery.ui.slider.js"></script>
    <!-- Touch enable for jquery UI -->
    <script src="js/plugins/touch-punch/jquery.touch-punch.min.js"></script>
    <!-- slimScroll -->
    <script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    

    <!-- imagesLoaded -->
    <script src="js/plugins/imagesLoaded/jquery.imagesloaded.min.js"></script>
    <!-- Bootstrap -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Bootbox -->
    <script src="js/plugins/bootbox/jquery.bootbox.js"></script>
    <!-- Masked inputs -->
    <script src="js/plugins/maskedinput/jquery.maskedinput.min.js"></script>
    <!-- TagsInput -->
    <script src="js/plugins/tagsinput/jquery.tagsinput.min.js"></script>
    <!-- Datepicker -->
    <script src="js/plugins/datepicker/bootstrap-datepicker.js"></script>
    <!-- Timepicker -->
    <script src="js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
    <!-- Colorpicker -->
    <script src="js/plugins/colorpicker/bootstrap-colorpicker.js"></script>
    <!-- Chosen -->
    <script src="js/plugins/chosen/chosen.jquery.min.js"></script>
    <!-- colorbox -->
    <script src="js/plugins/colorbox/jquery.colorbox-min.js"></script>
    <!-- MultiSelect -->
    <script src="js/plugins/multiselect/jquery.multi-select.js"></script>
    <!-- CKEditor -->
    <script src="js/plugins/ckeditor/ckeditor.js"></script>
    <!-- PLUpload -->
    <script src="js/plugins/plupload/plupload.full.js"></script>
    <script src="js/plugins/plupload/jquery.plupload.queue.js"></script>
    <!-- Custom file upload -->
    <script src="js/plugins/fileupload/bootstrap-fileupload.min.js"></script>
    <script src="js/plugins/mockjax/jquery.mockjax.js"></script>
    <!-- select2 -->
    <script src="js/plugins/select2/select2.min.js"></script>
    <!-- icheck -->
    <script src="js/plugins/icheck/jquery.icheck.min.js"></script>
    <!-- complexify -->
    <script src="js/plugins/complexify/jquery.complexify-banlist.min.js"></script>
    <script src="js/plugins/complexify/jquery.complexify.min.js"></script>



    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" />
    <!-- Apple devices Homescreen icon -->
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />
    <script src="js/plugins/datatable/jquery.dataTables.min.js"></script>
    <script src="js/plugins/datatable/TableTools.min.js"></script>
    <script src="js/plugins/datatable/ColReorder.min.js"></script>
    <script src="js/plugins/datatable/ColVis.min.js"></script>
    <script src="js/plugins/datatable/jquery.dataTables.columnFilter.js"></script>
    <!-- Wizard -->
    <script src="js/plugins/wizard/jquery.form.wizard.min.js"></script>
    <script src="js/plugins/mockjax/jquery.mockjax.js"></script>
    <!-- Theme framework -->
    <script src="js/eakroko.min.js"></script>
    <!-- Theme scripts -->
    <script src="js/application.min.js"></script>
    <!-- Just for demonstration -->
    <script src="js/demonstration.min.js"></script>

    <!-- Favicon -->
    <link rel="shortcut icon" href="img/favicon.ico" />
    <!-- Apple devices Homescreen icon -->
    <link rel="apple-touch-icon-precomposed" href="img/apple-touch-icon-precomposed.png" />

</head>

<body> <?
if (@$_POST ['submit']=="Insert"){
    
    
    $Mon_Data=array();
    $Tues_Data=array();
    $Wednes_Data=array();
    $Thurs_Data=array();
    $Fri_Data=array();
    for($i=1;$i<=$_POST['timingcount'];$i++){
     if(@$_POST['monday_timingId_'.$i]!="") $Mon_Data[]= $_POST['monday_timingId_'.$i]; 
     if(@$_POST['tuesday_timingId_'.$i]!="") $Tues_Data[]= $_POST['tuesday_timingId_'.$i]; 
     if(@$_POST['wednesday_timingId_'.$i]!="") $Wednes_Data[]= $_POST['wednesday_timingId_'.$i]; 
     if(@$_POST['thursday_timingId_'.$i]!="") $Thurs_Data[]= $_POST['thursday_timingId_'.$i]; 
     if(@$_POST['friday_timingId_'.$i]!="") $Fri_Data[]= $_POST['friday_timingId_'.$i]; 
    }
    $Mon_Data = implode(',',$Mon_Data);
    $Tues_Data = implode(',',$Tues_Data);
    $Wednes_Data = implode(',',$Wednes_Data);
    $Thurs_Data = implode(',',$Thurs_Data);
    $Fri_Data = implode(',',$Fri_Data);
    $Pharmacistname = "";
    if($_POST['typeId']==1){ $name =ucfirst($_POST['lastname']).','.ucfirst($_POST['firstname']);}elseif($_POST['typeId']==3){ $Pharmacistname =ucfirst($_POST['lastname']).','.ucfirst($_POST['firstname']); $name=ucfirst($_POST['Pname']);}else{$name=ucfirst($_POST['name']);}
    if($_SESSION['role']==2) $active="0"; else $active="1";
    
    /*$duplicat_count = $db->select_one("select count(*) from institutions where typeId='".$_POST['typeId']."' and name='".$name."' ");
    if($duplicat_count>0){
        echo "<script>alert('Same Institute Name and Type Exists');</script>";
    }else{*/
$insert_article = $db->insert_sql ( "INSERT INTO institutions (medrepId,name,pharmacistName,class,typeId,specialityId,hospitalId,active,Mon_Data,Tues_Data,Wednes_Data,Thurs_Data,Fri_Data) VALUES ('".@$_SESSION['CMSuserID']."','".$name."', '".$Pharmacistname."', '".$_POST['class']."', '".$_POST['typeId']."', '".$_POST['specialityId']."', '".$_POST['hospitalId']."', $active, '".$Mon_Data."', '".$Tues_Data."', '".$Wednes_Data."', '".$Thurs_Data."', '".$Fri_Data."')" ) ;
$id=$insert_article;
 for($i=1; $i<($_POST['fm']+1); $i++)
{
 if($_POST['address_'.$i]!='')
{if($i==$_POST['default']){$default=1;}else{$default=0;}
$insert_article = $db->insert_sql ( "INSERT INTO institutions_addresses (instituteId,`default`,address,areaId,phone) VALUES ('".$id."','".$default."','".$_POST['address_'.$i]."','".$_POST['areaId_'.$i]."','".$_POST['phone_'.$i]."')" ) ;
    //$db->print_last_query();
}    
}
/*}*/
}
//$db->print_last_query();
if ( @$_POST ['submit'] == "Update") 
{
    $Mon_Data=array();
    $Tues_Data=array();
    $Wednes_Data=array();
    $Thurs_Data=array();
    $Fri_Data=array();
    for($i=1;$i<=$_POST['timingcount'];$i++){
     if(@$_POST['monday_timingId_'.$i]!="") $Mon_Data[]= $_POST['monday_timingId_'.$i]; 
     if(@$_POST['tuesday_timingId_'.$i]!="") $Tues_Data[]= $_POST['tuesday_timingId_'.$i]; 
     if(@$_POST['wednesday_timingId_'.$i]!="") $Wednes_Data[]= $_POST['wednesday_timingId_'.$i]; 
     if(@$_POST['thursday_timingId_'.$i]!="") $Thurs_Data[]= $_POST['thursday_timingId_'.$i]; 
     if(@$_POST['friday_timingId_'.$i]!="") $Fri_Data[]= $_POST['friday_timingId_'.$i]; 
    }
    $Mon_Data = implode(',',$Mon_Data);
    $Tues_Data = implode(',',$Tues_Data);
    $Wednes_Data = implode(',',$Wednes_Data);
    $Thurs_Data = implode(',',$Thurs_Data);
    $Fri_Data = implode(',',$Fri_Data);
    $Pharmacistname = "";
    if($_POST['typeId']==1){ $name =ucfirst($_POST['lastname']).','.ucfirst($_POST['firstname']);}elseif($_POST['typeId']==3){ $Pharmacistname =ucfirst($_POST['lastname']).','.ucfirst($_POST['firstname']); $name=ucfirst($_POST['Pname']);}else{$name=ucfirst($_POST['name']);}
    if($_SESSION['role']==2) $active="0"; else $active="1";
    
    /* $duplicat_count = $db->select_one("select count(*) from institutions where typeId='".$_POST['typeId']."' and name='".$name."' ");
    if($duplicat_count>0){
        echo "<script>alert('Same Institute Name and Type Exists');</script>";
    }else{*/
    $update_families = $db->update_sql ( " update institutions set
                                         name                     ='".$name."',
                                         pharmacistName           ='".$Pharmacistname."',
                                         class                    ='".$_POST['class']."',
                                         typeId                   ='".$_POST['typeId']."',
                                         specialityId             ='".$_POST['specialityId']."',
                                         hospitalId               ='".$_POST['hospitalId']."',
                                         
                                         active                   ='$active',
                                         Mon_Data                  ='".$Mon_Data."',
                                         Tues_Data                    ='".$Tues_Data."',
                                         Wednes_Data                    ='".$Wednes_Data."',
                                         Thurs_Data                    ='".$Thurs_Data."',
                                         Fri_Data                    ='".$Fri_Data."'
                                         where id     ='".$_REQUEST['edit']."' ");
    $id=$_REQUEST['edit'];
    
     $del=mysql_query('delete from institutions_addresses where instituteId='.$id);
 
 
 for($i=1; $i<($_POST['fm']+1); $i++)
{
if($_POST['address_'.$i]!='')
{if($i==$_POST['default']){$default=1;}else{$default=0;}
$insert_article = $db->insert_sql ( "INSERT INTO institutions_addresses (instituteId,`default`,address,areaId,phone) VALUES ('".$id."','".$default."','".$_POST['address_'.$i]."','".$_POST['areaId_'.$i]."','".$_POST['phone_'.$i]."')" ) ;
    //$db->print_last_query();
}   
}
    
/*} */                             
}                              
if (isset($_POST ['submit'])) {
  echo "<script>window.location.href='main.php?g=admin&p=1';</script>";
} 

   
if(isset($_GET['aid']))
{
	$aid=$_GET['aid'];
}
if(isset($_GET['status']))
{
	$status=$_GET['status'];
}
if(isset($aid) && isset($status))
{
	if($status=='0')
		$active = '1';
	else
		$active = '0';

	$statusquery=$db->update_sql ("update institutions set active=".$active." where id='".$aid."'");
	$url = "main.php?g=admin&p=1";
}
//To Delete
if(isset($_GET['delete']))
{
	$delid=$_GET['delete'];
}
if(isset($delid))
{
	
	$delquery=$db->update_sql ("update institutions set deleted=1 where id='".$delid."'");
	$url = "main.php?g=admin&p=1";
}

?>	<!-- Bootstrap -->

<div class="container-fluid">
	
    <div class="row-fluid">
                        <div class="span12">
                            <div class="box box-color box-bordered">
                                <div class="box-title">
                                    <h3>
                                         <i class="icon-table"></i>Institutions List
                                    </h3>
                                </div>
                                <div class="box-content nopadding">

<div class="accordion-group" style="margin-top:15px;margin:10px;">
<div id="collapse_addedit" class="accordion-body collapse in">
<div class="accordion-inner">
<div id="replace"><? include 'btlfsa_addnew_institutions.php';?></div>
</div>
</div>
</div> 
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
</div>
</body>
</html>

<script language="javascript" type="text/javascript">
function Hidediv(){
 
 $('#collapse_addedit').removeClass('in');
 $('#collapse_addedit').css('height','0px');
    
}

function del(id)
{
	var y=confirm("Are you sure want to delete");
	
	if(y==true)
	{
		window.location.href="main.php?g=admin&p=1&delete="+id;
	}
}
function status(id,status)
{
	window.location.href="main.php?g=admin&p=1&aid="+id+"&status="+status;
}
function select_institutionTypes(id,name)
{
    document.getElementById("typeId").value=id;
    document.getElementById("type").value=name;
    Specialties_HospitalHideShow(name);
    //document.getElementById("withNationality").value=name;
    $('.close').click();
}
function select_TimeVisit(id,name)
{
    document.getElementById("bestTimeVisit").value=name;
    //document.getElementById("withNationality").value=name;
    $('.close').click();
}
function select_areas(id,name)

{
    document.getElementById("areaId").value=id;
    document.getElementById("area").value=name;
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
function select_Specialties(id,name)

{
    document.getElementById("specialityId").value=id;
    document.getElementById("speciality").value=name;
    //document.getElementById("withNationality").value=name;
    $('.close').click();
}
function select_hospitals(id,name)

{
    document.getElementById("hospitalId").value=id;
    document.getElementById("hospital").value=name;
    //document.getElementById("withNationality").value=name;
    $('.close').click();
}
function removeSelectedValue(str){

var res = str.split("-");

document.getElementById(res[0]).value="";

document.getElementById(res[1]).value="";

return false;

}

$(document).on("click", ".accordion-toggle", function () {

     var id = $(this).data('id');

     var tableName = $(this).data('table');

     var name = $(this).data('name');

        $.ajax({

        type: "POST",

        url: "includes/institutions.php",

        data: "edit="+id+"",

        success: function(msg){

            $('#replace').html(msg);
            $('#collapse_addedit').addClass('in');
            $('#collapse_addedit').css('height','auto');
$(".chosen-select").length>0&&$(".chosen-select").each(function(){var e=$(this),t=e.attr("data-nosearch")==="true"?!0:!1,n={};t&&(n.disable_search_threshold=9999999);e.chosen(n)});
            }

        });



});
</script>
<div id="lightbox-institutionTypes" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

    <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="chooseInzartClosebutton">X</button>

    <h3 id="myModalLabel">Select Institution Type</h3>

    </div>

    <div class="modal-body nopadding">

        

    

        <form action="#" method="POST" class='form-horizontal form-column form-bordered' name="ls" id="ls" enctype="multipart/form-data">

        <table class="table table-hover table-nomargin  table-bordered">

            <thead>

                <tr>

                <th>Id</th>

                <th>Name</th>

                <th>Select </th>

                </tr>

            </thead>

            <tbody>

                <?

                $ls_select="select * from institutionTypes where id in (1,3) order by id asc";

                $ls_query=mysql_query($ls_select);

                while($ls_res=mysql_fetch_assoc($ls_query)) {

                ?>          

                <tr>

                <td><?=$ls_res['id']; ?></td>

                <td><?=$ls_res['name']; ?></td>

                <td><input type="radio" name="radiotypes[]" onClick="select_institutionTypes('<?=$ls_res['id']; ?>','<?=$ls_res['name']; ?>')" class="radio"></td>

                </tr>

                <? } ?>

                <?

                $ls_select="select * from institutionTypes  where id not in (1,3) order by id asc";

                $ls_query=mysql_query($ls_select);

                while($ls_res=mysql_fetch_assoc($ls_query)) {

                ?>          

                <tr>

                <td><?=$ls_res['id']; ?></td>

                <td><?=$ls_res['name']; ?></td>

                <td><input type="radio" name="radiotypes[]" onClick="select_institutionTypes('<?=$ls_res['id']; ?>','<?=$ls_res['name']; ?>')" class="radio"></td>

                </tr>

                <? } ?>

            </tbody>

        </table>

        </form>

     </div>

</div>

<div id="lightbox-areas" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

    <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="chooseInzartClosebutton">X</button>

    <h3 id="myModalLabel">Select Area</h3>

    </div>

    <div class="modal-body nopadding">

        

    

        <form action="#" method="POST" class='form-horizontal form-column form-bordered' name="ls" id="ls" enctype="multipart/form-data">

        <table class="table table-hover table-nomargin dataTable table-bordered">

            <thead>

                <tr>

                <th>Id</th>
                <th>Zone</th>
                <th>Area</th>
                <th>Select </th>

                </tr>

            </thead>

            <tbody>

                <?

                $ls_select="select * from areas where active=1 and deleted=0 ";

                $ls_query=mysql_query($ls_select);

                while($ls_res=mysql_fetch_assoc($ls_query)) {

                ?>          

                <tr>

                <td><?=$ls_res['id']; ?></td>
 				<td><? if($ls_res['parent']==0) echo $ls_res['name']; else echo getValue('name','areas',$ls_res['parent']);?></td>
                <td><?=$ls_res['name']; ?></td>
               

                <td><input type="radio" name="radiotypes[]" onClick="select_areas('<?=$ls_res['id']; ?>','<?=$ls_res['name']; ?>')" class="radio"></td>

                </tr>

                <? } ?>

            </tbody>

        </table>

        </form>

     </div>

</div>
<div id="lightbox-Specialties" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

    <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="chooseInzartClosebutton">X</button>

    <h3 id="myModalLabel">Select Specialties</h3>

    </div>

    <div class="modal-body nopadding">

        

    

        <form action="#" method="POST" class='form-horizontal form-column form-bordered' name="ls" id="ls" enctype="multipart/form-data">

        <table class="table table-hover table-nomargin dataTable table-bordered">

            <thead>

                <tr>

                <th>Id</th>

                <th>Name</th>

                <th>Select </th>

                </tr>

            </thead>

            <tbody>

                <?

                $ls_select="select * from Specialties";

                $ls_query=mysql_query($ls_select);

                while($ls_res=mysql_fetch_assoc($ls_query)) {

                ?>          

                <tr>

                <td><?=$ls_res['id']; ?></td>

                <td><?=$ls_res['name']; ?></td>

                <td><input type="radio" name="radiotypes[]" onClick="select_Specialties('<?=$ls_res['id']; ?>','<?=$ls_res['name']; ?>')" class="radio"></td>

                </tr>

                <? } ?>

            </tbody>

        </table>

        </form>

     </div>

</div>
<div id="lightbox-hospitals" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

    <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="chooseInzartClosebutton">X</button>

    <h3 id="myModalLabel">Select Institute for Doctor</h3>

    </div>

    <div class="modal-body nopadding">

        

    

        <form action="#" method="POST" class='form-horizontal form-column form-bordered' name="ls" id="ls" enctype="multipart/form-data">

        <table class="table table-hover table-nomargin dataTable table-bordered">

            <thead>

                <tr>

                <th>Id</th>

                <th>Name</th>

                <th>Select </th>

                </tr>

            </thead>

            <tbody>

                <?

                $ls_select="select * from institutions where typeId=2 and deleted=0";

                $ls_query=mysql_query($ls_select);

                while($ls_res=mysql_fetch_assoc($ls_query)) {

                ?>          

                <tr>

                <td><?=$ls_res['id']; ?></td>

                <td><?=$ls_res['name']; ?></td>

                <td><input type="radio" name="radiotypes[]" onClick="select_hospitals('<?=$ls_res['id']; ?>','<?=$ls_res['name']; ?>')" class="radio"></td>

                </tr>

                <? } ?>

            </tbody>

        </table>

        </form>

     </div>

</div>

<div id="lightbox-areasaddress" class="modal hide" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" >

    <div class="modal-header">

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true" id="chooseInzartClosebutton">X</button>

    <h3 id="myModalLabel">Select Area</h3>

    </div>

    <div class="modal-body nopadding">

        

    

        <form action="#" method="POST" class='form-horizontal form-column form-bordered' name="ls" id="ls" enctype="multipart/form-data">

        <table class="table table-hover table-nomargin dataTable table-bordered">

            <thead>

                <tr>

                <th>Id</th>
                <th>Zone</th>
                <th>Area</th>
                <th>Select </th>

                </tr>

            </thead>

            <tbody>

                <?

                $ls_select="select * from areas where active=1 and deleted=0";

                $ls_query=mysql_query($ls_select);

                while($ls_res=mysql_fetch_assoc($ls_query)) {

                ?>          

                <tr>

                <td><?=$ls_res['id']; ?></td>

                
                <td><? if($ls_res['parent']==0) echo $ls_res['name']; else echo getValue('name','areas',$ls_res['parent']);?></td>
                <td><?=$ls_res['name']; ?></td>
                <td><input type="radio" name="radiotypes[]" onClick="select_areasaddress('<?=$ls_res['id']; ?>','<?=$ls_res['name']; ?>')" class="radio"></td>

                </tr>

                <? } ?>

            </tbody>

        </table>

        </form>

     </div>

</div>
<style type="text/css">
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
</style>