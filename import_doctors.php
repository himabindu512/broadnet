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
                        <h3> Import Doctors<i class="icon-th-list"></i></h3>	
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
	function add_property($name,$speciality,$class,$zone,$area,$hospital,$address,$phone)
	{
		global $data;
		$data []= array(
		'name' => $name,
        'speciality' => $speciality,
		'class' => $class,
        'zone' => $zone,
        'area' => $area,
        'hospital' => $hospital,
        'address' => $address,
        'phone' => $phone,
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
                    $speciality="";
					$class="";
                    
                    $zone="";
                    $area="";
                    $hospital="";
                    $address="";
                    $phone="";
															
					$index = 1;
					$cells = $row->getElementsByTagName( 'Cell' );
					foreach( $cells as $cell )
					{ 
					  $ind = $cell->getAttribute( 'ss:Index' );
					  if ( $ind != null ) $index = $ind;

					  if ( $index == 1 ) $name= $cell->nodeValue;	
                      if ( $index == 2 ) $speciality= $cell->nodeValue;    
					  if ( $index == 3 ) $class= $cell->nodeValue;	
                      if ( $index == 4 ) $zone= $cell->nodeValue;    
                      if ( $index == 5 ) $area= $cell->nodeValue;
                      if ( $index == 6 ) $hospital= $cell->nodeValue;
                      if ( $index == 7 ) $address= $cell->nodeValue;
                      if ( $index == 8 ) $phone= $cell->nodeValue;
					  $index += 1;
					}
					add_property($name,$speciality,$class,$zone,$area,$hospital,$address,$phone);
				}
				$first_row = false;
			}
	  }
      //ech0 "<pre>";
      //print_r($data);
     // exit;
####-----Query ---####
  foreach( $data as $row )
  { 
      if($row["name"]!=''){
          
          
          $specialityId=getreqValue('id','Specialties','name',trim($row["speciality"]));
          $areaId=getreqValue('id','areas','name',trim($row["area"]));
          $hospitalId=getreqValue('id','institutions','name',trim($row["hospital"]));
          
echo $user_id=$db->insert_sql("insert institutions(name,typeId,areaId,class,specialityId,hospitalId,address,phone) values('".trim($row["name"])."','1','$areaId','".trim($row["class"])."','$specialityId','$hospitalId','".trim($row["address"])."','".trim($row["phone"])."')");
 $db->print_last_query();
echo $add_id=$db->insert_sql("insert institutions_addresses(instituteId,areaId,address,phone) values('$user_id','$areaId','".trim($row["address"])."','".trim($row["phone"])."')");
 $db->print_last_query();
}
}
 		print "<script language=JavaScript>";
		print "alert(\"Records are Imported Successfully\");";
		print "</script>";
}
								
?>
   
