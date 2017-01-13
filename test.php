<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head><?
error_reporting(E_ALL ^ E_NOTICE);
//loggedIn ( "index.php" );
?>
<?
require('resize-class.php');

if ($_POST ['submit']=="Insert") {

       
$insert_article = $db->insert_sql ( "INSERT INTO programs(name,brief,description,active) VALUES ('".$_POST['name']."','".$_POST['brief']."','".$_POST['description']."',1)");
$id=mysql_insert_id();
}
if ( $_POST ['submit'] == "Update") 
{
	$update_families =$db->update_sql ( "update banners set
										 name				='".$_POST['name']."',
										 brief				='".$_POST['brief']."',
										 description		='".$_POST['description']."'
										 where id 	='".$_REQUEST['edit']."' ");
	$id=$_REQUEST['edit'];
}
##################________START OF image_Resize________####################	
		$resizeObj = new resize();
		if($_FILES['pimg']['name']!='')
		{
			$image = $_FILES['pimg']['name'];
			$extension = strtolower(strrchr($image, '.'));
			$imageName = $id."_program".$extension;
			move_uploaded_file($_FILES['pimg']['tmp_name'],'photo/programImages/'.$imageName);
			$imagepath ="photo/programImages/".$imageName;
			
			list($original_width, $original_height) = getimagesize($imagepath);
				
			$imgpath=$resizeObj->ImagePath($imagepath);
			if($imgpath)
			{		
				$big_Imagewidth=940;
				$big_Imageheight=ceil(($big_Imagewidth*$original_height)/$original_width);
				$resizeObj -> resizeImage($big_Imagewidth,$big_Imageheight, 'auto');	
				$resize=$resizeObj -> saveImage($imagepath, 100);
			}
			
			$thumb_imageName = $id."_programThumb".$extension;
			copy($imagepath,'photo/programThumbImages/'.$thumb_imageName);
			$thumb_imagepath ="photo/programThumbImages/".$thumb_imageName;
			
			$imgpath=$resizeObj->ImagePath($thumb_imagepath);
			if($imgpath)
			{		
				$thumb_Imagewidth=350;
				$thumb_Imageheight=ceil(($thumb_Imagewidth*$original_height)/$original_width);
				$resizeObj -> resizeImage($thumb_Imagewidth,$thumb_Imageheight, 'auto');	
				$resize=$resizeObj -> saveImage($thumb_imagepath, 100);
			}
			$update_families =$db->update_sql ( "update programs set image='".$imageName."' , thumb='".$thumb_imageName."' where id='".$id."' ");
			
		}
if (isset($_POST ['submit'])) {
		echo "<script>window.location.href='main.php?g=academic&p=21';</script>";
}
##################________END OF image_Resize________####################	

?>



<div id="main">
    <div class="container-fluid">
    		    <div class="page-header">
					<div class="pull-left">
						<h1>Programs</h1>
					</div>
				</div>
				
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-bordered">
                    
<form action="#" method="POST"  name="banners" id="banners" class="form-horizontal form-bordered" onSubmit="return validate(this);" enctype="multipart/form-data">
<div class="box-title" >
	<h3> <i class="icon-th-list"></i> Programs</h3>	
</div>
<div class="box-content nopadding">
<!------------------------start of family Information-1------------------>
<?	
	if($_REQUEST['edit']!='')
	{
		//families family_owner family_border family_noufous family_address family_un family_members
		$res = $db->select ( "select * from programs where id=" . $_REQUEST['edit'] );
		$row = $db->get_row ( $res, 'MYSQL_BOTH' );
	}
?>
<input type="hidden" name="edit" id="edit"  value=<?=$_REQUEST['edit']; ?>>
<table width="100%" >
    
    <tr>
        <td>
        <div class="control-group">
        <label for="textfield" class="control-label">Name</label>
        <div class="controls">
        <input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<? if($row['name']!='') echo $row['name']; ?>">
        </div>
        </div>
        </td>
        <td>
        </td>
    </tr>
    <tr>
        <td colspan="2">
        <div class="control-group">
        <label for="textfield" class="control-label">Brief</label>
        <div class="controls">
        <textarea name="brief" id="brief" class='ckeditor span12' rows="5"><?=$row['brief']; ?></textarea>
        </div>
        </div>
        </td>
    </tr>
    <tr>
        <td colspan="2">
        <div class="control-group">
        <label for="textfield" class="control-label">Description</label>
        <div class="controls">
        <textarea name="description" id="description" class='ckeditor span12' rows="5"><?=$row['description']; ?></textarea>
        </div>
        </div>
        </td>
    </tr>
    <tr>
        <td>
        <div class="control-group">
                <label for="textfield" class="control-label">Image</label>
                <div class="controls">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="<? if($row['thumb']=='') echo "http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image";  else echo 'photo/programThumbImages/'.$row['thumb']; ?>" /></div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                        <div>
                            <span class="btn btn-file"><span class="fileupload-new">Select image</span><span class="fileupload-exists">Change</span><input type="file" name='pimg' /></span>
                            <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                        </div>
                    </div>
                </div>
            </div>
        </td>
        <td>
        </td>
    </tr>
</table>

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
                    
                </div>
            </div>
        </div>
    </div>
</div>
<style type="text/css">
.ui-datepicker { font-size:8pt !important}
</style>
<style type="text/css">
.ui-datepicker { font-size:8pt !important}
#radio input 
{	
	width:20px;
	margin-right:4px;
}
#radio li
{	
	padding:8px;
	float:right;
	list-style:none;
}
</style>
