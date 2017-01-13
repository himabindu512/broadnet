<?
@include_once ('../common.php');
@include_once ('common.php');
?>
<style type="text/css">label{font-weight: bold;}h3{background-color: #368ee0;color: white;}#cboxLoadedContent{background: white;}#cboxTitle{display: none !important}
#cboxOverlay {background: none repeat scroll 0 0 #000;}
</style>                    
<form method="POST" target="_blank" action="export_reports_excel.php" style="width: 550px;background: white !important;margin-top: -10px;" name="reports_view" id="reports_view" class="form-vertical form-bordered" >
    <div class="box-title box box-color box-bordered" >
    <h3> Exports Reports</h3>    
</div>               
<div class="box-content nopadding">
<?    

?>
<input type="hidden" name="edit" id="edit"  value=<?=@$_REQUEST['edit']; ?>>


<div class="row-fluid">


<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">From VisitDate</label>
<div class="controls">
<input type="text" readonly name="from_date" placeholder="From Visit Date" class="input-block-level datepick" />
</div>
</div>
</div>
<div class="span6">
<div class="control-group">
<label for="textfield" class="control-label">To VisitDate</label>
<div class="controls">
<input type="text" readonly name="to_date" placeholder="To Visit Date" class="input-block-level datepick" />
</div>
</div>
</div>
</div>

<div class="form-actions">
<button type="submit" class="btn btn-primary" name="submit" value="Insert" >Submit</button>
<button type="button" class="btn btn-primary" name="Cancel" value="Cancel" onclick="$('#cboxClose').click();">Cancel</button>
</div>
</div>
</form>


