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
                        <h3> Import Doctor Reports<i class="icon-th-list"></i></h3>	
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
	function add_property($medrep,$doctor,$specialityId,$class,$zone,$area,$visitDate,$deal,$doublevisit,$feedback,$product1,$product2,$product3,$product4,$failedvisit)
	{
		global $data;
		$data []= array(
        'medrep' => $medrep,
        'doctor' => $doctor,
        'specialityId' => $specialityId,
		'class' => $class,

        'zone' => $zone,
        'area' => $area,
        'visitDate' => $visitDate,
        'deal' => $deal,
        'doublevisit' => $doublevisit,
        'feedback' => $feedback,

        'product1' => $product1,
        'product2' => $product2,
        'product3' => $product3,
        'product4' => $product4,

        'failedvisit' => $failedvisit,
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
					$medrep=$doctor=$specialityId=$class=$zone=$area=$visitDate=$deal=$doublevisit=$feedback=$product1=$product2=$product3=$product4=$failedvisit="";
															
					$index = 1;
					$cells = $row->getElementsByTagName( 'Cell' );
					foreach( $cells as $cell )
					{ 
					  $ind = $cell->getAttribute( 'ss:Index' );
					  if ( $ind != null ) $index = $ind;

					  if ( $index == 1 ) $medrep= $cell->nodeValue;	
                      if ( $index == 2 ) $doctor= $cell->nodeValue;    
					  if ( $index == 3 ) $specialityId= $cell->nodeValue;	
                      if ( $index == 4 ) $class= $cell->nodeValue;    
                      if ( $index == 5 ) $zone= $cell->nodeValue;
                      if ( $index == 6 ) $area= $cell->nodeValue;
                      if ( $index == 7 ) $visitDate= $cell->nodeValue;
                      if ( $index == 8 ) $deal= $cell->nodeValue;
                      if ( $index == 9 ) $doublevisit= $cell->nodeValue;
                      if ( $index == 10 ) $feedback= $cell->nodeValue;
                      if ( $index == 11 ) $product1= $cell->nodeValue;
                      if ( $index == 12 ) $product2= $cell->nodeValue;
                      if ( $index == 13 ) $product3= $cell->nodeValue;
                      if ( $index == 14 ) $product4= $cell->nodeValue;
                      if ( $index == 15 ) $failedvisit= $cell->nodeValue;
					  $index += 1;
					}
					add_property($medrep,$doctor,$specialityId,$class,$zone,$area,$visitDate,$deal,$doublevisit,$feedback,$product1,$product2,$product3,$product4,$failedvisit);
				}
				$first_row = false;
			}
	  }
      /*echo "<pre>";
      print_r($data);
      exit;*/
      
####-----Query ---####
  foreach( $data as $row )
  { 
      if($row["medrep"]!=''){
          
          
          $medrepId=getreqValue('id','users','name',trim($row["medrep"]));
          $institutionsId=getreqValue('id','institutions','name',trim($row["doctor"]));
          $institutionsTypeId=getValue('typeId','institutions',$institutionsId);
          $addressId=getreqValue('id','institutions_addresses','instituteId',$institutionsId);
          $specialityId=getreqValue('id','Specialties','name',trim($row["specialityId"]));
          
          
          $product1=getreqValue('id','products','name',trim($row["product1"]));
          $product2=getreqValue('id','products','name',trim($row["product2"]));
          $product3=getreqValue('id','products','name',trim($row["product3"]));
          $product4=getreqValue('id','products','name',trim($row["product4"]));
          $areaId=getreqValue('id','areas','name',trim($row["area"]));
          $visitDate=substr($row["visitDate"],0,10);
          if($row["deal"]!=''){$deal=1;}else{$deal=0;}
          if($row["failedvisit"]!=''){$failedvisit=1;}else{$failedvisit=0;}
          if($row["doublevisit"]!=''){$doublevisit=1;
          $supervisorId=getreqValue('id','users','name',trim($row["doublevisit"]));
          }else{$doublevisit=0;$supervisorId=0;}
          
          
echo $user_id=$db->insert_sql("insert reports(medRepId,institutionId,typeId,addressId,specialityId,supervisorId,visitDate,deal,doubleVisit,faildVisit,feedback,productId1,productId2,productId3,productId4) values('".$medrepId."','$institutionsId','$institutionsTypeId','$addressId','".$specialityId."','".$supervisorId."','".$visitDate."','".$deal."','".$doublevisit."','".$failedvisit."','".addslashes(trim($row["feedback"]))."','".$product1."','".$product2."','".$product3."','".$product4."')");
 $db->print_last_query();

}
}
 		print "<script language=JavaScript>";
		print "alert(\"Records are Imported Successfully\");";
		print "</script>";
}
								
?>
   
