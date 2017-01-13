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
                        <h3> Import Dispencary<i class="icon-th-list"></i></h3>	
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
	function add_property($name,$zone,$area,$specialityId)
	{
		global $data;
		$data []= array(
		'name' => $name,

        'zone' => $zone,
        'area' => $area,

        'specialityId' => $specialityId,

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
					$name="";

                    
                    $zone="";
                    $area="";

                    $specialityId="";

															
					$index = 1;
					$cells = $row->getElementsByTagName( 'Cell' );
					foreach( $cells as $cell )
					{ 
					  $ind = $cell->getAttribute( 'ss:Index' );
					  if ( $ind != null ) $index = $ind;

					  if ( $index == 1 ) $name= $cell->nodeValue;	
                      if ( $index == 5 ) $zone= $cell->nodeValue;    
					  if ( $index == 6 ) $area= $cell->nodeValue;	
                      if ( $index == 2 ) $specialityId= $cell->nodeValue;   
					  $index += 1;
					}
					add_property($name,$zone,$area,$specialityId);
				}
				$first_row = false;
			}
	  }
      //ech0 "<pre>";
     // print_r($data);
     // exit;
####-----Query ---####
  foreach( $data as $row )
  { 
      if($row["name"]!=''){
          
          
          
          $areaId=getreqValue('id','areas','name',trim($row["area"]));
          
          
          
echo $user_id=$db->insert_sql("insert institutions(name,typeId,areaId,class) values('".trim($row["name"])."','11','$areaId','A')");
 $db->print_last_query();
echo $add_id=$db->insert_sql("insert institutions_addresses(instituteId,areaId,address) values('$user_id','$areaId','".trim($row["area"]).', '.trim($row["zone"])."')");
 $db->print_last_query();
}
}
 		print "<script language=JavaScript>";
		print "alert(\"Records are Imported Successfully\");";
		print "</script>";
}
								
?>
   
