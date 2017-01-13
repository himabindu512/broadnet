<head>
<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
</head><?
error_reporting(E_ALL ^ E_NOTICE);
//loggedIn ( "index.php" );
?>
<?
require('resize-class.php');

if (isset($_POST ['submit'] )) {
                   
$insert_article = $db->insert_sql ( "INSERT INTO projects(name,description) VALUES ('" . $_POST ["title"] . "','" . $_POST ["description"] . "')" ) ;
$id=1;

	
$resizeObj = new resize();
		if($_FILES['pimg']['name']!='')
		{
			$image = $_FILES['pimg']['name'];
			$extension = strtolower(strrchr($image, '.'));
			$image1 = $id."_banner".$extension;
			move_uploaded_file($_FILES['pimg']['tmp_name'],'photo/bannerImages/'.$image1);
			$imgpath=$resizeObj->ImagePath($image1);
			$image ="photo/bannerImages/".$image1;
				
			$imgpath=$resizeObj->ImagePath($image);
			if($imgpath)
			{	
				$resizeObj -> resizeImage(140,94, 'auto');	
				$bigimg= $image1;
				$bigdest=$image ;
				$resize=$resizeObj -> saveImage($bigdest, 100);
			}
			
			$image2 = $id."_bannerThumb".$extension;
			copy($image,'photo/bannerThumbImages/'.$image2);
			

			$thumb_image ="photo/bannerThumbImages/".$image2;
			
			$imgpath=$resizeObj->ImagePath($thumb_image);
			if($imgpath)
			{	
				$resizeObj -> resizeImage(400,400, 'auto');	
				$bigimg= $image2;
				$bigdest=$thumb_image ;
				$resize=$resizeObj -> saveImage($bigdest, 100);
			}
		}

}   
	?>



<div id="main">
    <div class="container-fluid">
    		    <div class="page-header">
					<div class="pull-left">
						<h1>Cities</h1>
					</div>
				</div>
				<div class="breadcrumbs">
					<ul>
                   		<li>
							<a href="#">Admin</a>
							<i class="icon-angle-right"></i>
						</li>
						<li>
							<a href="main.php?g=admin&p=9">Cities</a>
							
						</li>
					</ul>
					<div class="close-bread">
						<!--<a href="#">
							<i class="icon-remove"></i>
						</a>-->
					</div>
				</div>
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-bordered">
                    
<form action="#" method="POST"  name="banners" id="banners" class="form-horizontal form-bordered" onSubmit="return validate(this);" enctype="multipart/form-data">
<div class="box-title" >
	<h3> <i class="icon-th-list"></i> Cities</h3>	
</div>
<div class="box-content nopadding">
<!------------------------start of family Information-1------------------>
<?	
	if($_REQUEST['edit']!='')
	{
		//families family_owner family_border family_noufous family_address family_un family_members
		$res = $db->select ( "select * from cities where id=" . $_REQUEST['edit'] );
		$row = $db->get_row ( $res, 'MYSQL_BOTH' );
	}
?>
<input type="hidden" name="edit" id="edit"  value=<?=$_REQUEST['edit']; ?>>
<table width="100%" >
    
    <tr>
        <td>
        <div class="control-group">
        <label for="textfield" class="control-label">name</label>
        <div class="controls">
        <input type="text" name="name" id="name" placeholder="" class="input-xlarge" value="<? if($row['name']!='') echo $row['name']; ?>">
        </div>
        </div>
        </td>
        <td>
        </td>
    </tr>
        <tr>
        <td>
        <div class="control-group">
        <label for="textfield" class="control-label">Title</label>
        <div class="controls">
        <input type="text" name="description" id="description" placeholder="" class="input-xlarge" value="<? if($row['description']!='') echo $row['description']; ?>">
        </div>
        </div>
        </td>
        <td>
        </td>
    </tr>

    
    
    <tr>
        <td>
        <div class="control-group">
                <label for="textfield" class="control-label">City Name</label>
                <div class="controls">
                    <div class="fileupload fileupload-new" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 200px; height: 150px;"><img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&text=no+image" /></div>
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
