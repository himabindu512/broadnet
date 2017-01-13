<?
include './common.php';
require_once ('./functions.php');
error_reporting(0);
?>
<form action="#" method="POST" class='form-horizontal form-column form-bordered' name="ls" id="ls" enctype="multipart/form-data">
	<input type="hidden" name="fileId" id="fileId" value="<?=$_POST['fid']; ?>"  >
	<input type="hidden" name="fileType" id="fileType" value="<?=$_POST['ftype']; ?>"  > 
	<?
	$sel=mysql_query("select * from attachments where id =".$_POST['editId']);
	$res=mysql_fetch_assoc($sel);
	?>
	<div class="span12">
		<div class="control-group">
			<label for="textfield" class="control-label">File</label>
			<div class="controls">
				<div class="fileupload fileupload-new" data-provides="fileupload">
					<span class="btn btn-file"><span class="fileupload-new">Select file</span><span class="fileupload-exists">Change</span><input type="file" name="my_file1" /></span>
					<span class="fileupload-preview"></span>
					<a href="#" class="close fileupload-exists" data-dismiss="fileupload" >x</a>
				</div>
			</div>
		</div>
	</div>
	<div class="span12">
		<div class="control-group">
			<label for="task-name" class="control-label">Title</label>
			<div class="controls">
				<input type="text" name="title" id="title" value="<? if($res['title']!='') echo $res['title']; ?>">
			</div>
		</div>
	</div>
	<div class="span12">
		<div class="control-group">
			<label for="task-name" class="control-label">Keywords</label>
			<div class="controls">
			<input type="text" name="keywords" id="keywords" value="<? if( $res['keywords']!='') echo $res['keywords']; ?>">
			</div>
		</div>
	</div>
	<div class="span12">
		<div class="form-actions">
			<button type="submit" class="btn btn-primary" name="attach_submit" value="Insert" >Submit</button>
		</div>
	</div>
</form>