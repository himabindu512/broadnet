<? 
	ini_set('max_execution_time', 300);
	include_once ('common.php');
	error_reporting(E_ALL ^ E_NOTICE); 
?>
<div id="main">
    <div class="container-fluid">
        <div class="row-fluid">
            <div class="span12">
                <div class="box box-bordered">
                    <form action="#" method="POST"  name="familily_information" id="familily_information" 
                    enctype="multipart/form-data" class="form-horizontal form-bordered" >
                    <div class="box-title" >
                        <h3> Import Zone and Areas<i class="icon-th-list"></i></h3>	
                    </div>
                    <div class="box-content nopadding">
                    <table width="100%" >
                        <tr>
                            <td>
                            <div class="control-group">
                             <label for="textfield" class="control-label">XML Upload File </label>
                                <div class="controls">
                                <input type="file" name="file" >    
                                </div>
                            </div>
                            </td>
                        </tr>
                    </table>
                    <div class="form-actions">
                    <button type="submit" class="btn btn-primary" name="submit" value="Insert" >Import</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?
if ( $_POST ['submit'] == "Insert")
{
  $data = array();
	function add_property($zone,$area)
	{
		global $data;
		$data []= array(
		'zone' => $zone,
		'area' => $area,
				 );
	}
	  
	if ( $_FILES['file']['tmp_name'] )
	{	
			$doc = new DOMDocument();
			$doc->load( $_FILES['file']['tmp_name'] );
			$rows = $doc->getElementsByTagName( 'Row' );
			$first_row = true;
			foreach ($rows as $row)
			{
				if ( !$first_row )
				{	
					$zone="";
					$area="";
															
					$index = 1;
					$cells = $row->getElementsByTagName( 'Cell' );
					foreach( $cells as $cell )
					{ 
					  $ind = $cell->getAttribute( 'ss:Index' );
					  if ( $ind != null ) $index = $ind;

					  if ( $index == 1 ) $zone= $cell->nodeValue;	
					  if ( $index == 2 ) $area= $cell->nodeValue;	
					  $index += 1;
					}
					add_property($zone,$area);
				}
				$first_row = false;
			}
	  }
      //ech0 "<pre>";
      //print_r($data);
      //exit;
####-----Query ---####
  foreach( $data as $row )
  { 
      if($row["zone"]!='' and $row["area"]!=''){
          $parent=getreqValue('id','areas','name',trim($row["zone"]));
echo $user_id=$db->insert_sql("insert areas(name,parent) values('".trim($row["area"])."','$parent')");
 $db->print_last_query();
}
}
 		print "<script language=JavaScript>";
		print "alert(\"Records are Imported Successfully\");";
		print "</script>";
}
								
?>
   
