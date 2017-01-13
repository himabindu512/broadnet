<?php include ("cms/common.php");
$pageid=8;
?>
<base href="<?php echo ROOT_PATH; ?>" />

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

        <meta charset="UTF-8" />
        <meta name="viewport" content="initial-scale = 1.0" />
        <?                
    $pages_query=$db->select("select * from pages where id='$pageid'");
    $pages=$db->get_row($pages_query,'MYSQL_BOTH');
?>
<title><?=$pages['name']?> | Friday Prayers Evaluation</title>
<meta name="description" content=" <?=$pages['metadesc']?>"/>
<meta name="keywords" content="<?=$pages['keywords']?>"/>
<?php
include("includes/header.php");

$sort = 'Alphabetic';
$city='';
if( isset( $_GET['sort'] ) ){
    $sort = $_GET['sort'];
}
if( isset( $_GET['city'] ) ){
	$city = $_GET['city'];
}

$masjids = array();
if( isset( $_GET['searchMasjid'] ) ){
	extract( $_GET );

	if( $countryDD != '' ){
        $city = $countryDD;
		$where = " and areaId = '".$countryDD."' ";
	}
	if( $cityDD != '' ){
        $city = $cityDD;
		$where = " and areaId = '".$cityDD."' ";
	}
	if( $searchMasjid != '' ){
		$where .= " and name like '%".$searchMasjid."%' ";
	}
	$query = "select * from masjid where 1 $where and active = 1 ";
	
	$query = mysql_query( $query );
	while( $result = mysql_fetch_assoc( $query ) ){
		$masjids[] = $result;
	}
	_getPageDescNav('Masjid Search Results');

}else{
    
    if( $city != '' ){
        $where = " and ( areaId = '".$city."' or areaId in (select id from areas where parent=$city) )";
    }
	
	$query = "select * from masjid where active = 1 $where ";
	
	if( $sort == 'Alphabetic' ){
		$query .= " order by name asc";
	}else if( $sort == 'Popularity' ){
		$query .= " order by generalAvgOfMasjid desc";
	}else if( $sort == 'Newest' ){
		$query .= " order by builtYear desc";
	}
	
	$sql = mysql_query( $query );
	
	while( $result = mysql_fetch_assoc( $sql ) ){
		$masjids[] = $result;
	}
	
	_getPageDescMasjd('لائحة المساجد ');

}
?>


<div class="content-wrapper">
	<div class="gdlr-content"> 
		<div class="with-sidebar-wrapper">
			<section id="content-section-1" >
			
				<div class="section-container container">
                <select name="sorting-masjid" id="sorting-masjid" onchange="sortMasjidList()" style="width:13%;height: 44px;float: right;clear: both;margin-bottom: 10px;margin-right: 15px;border: 1px solid;">
                    <option value="Alphabetic" <?= ( $sort == 'Alphabetic' )?'selected':'' ?> >حسب الترتيب الأبجدي </option>
                    <option value="Popularity" <?= ( $sort == 'Popularity' )?'selected':'' ?>>حسب التقييم العام </option>
                    <option value="Newest" <?= ( $sort == 'Newest' )?'selected':'' ?> >حسب تاريخ الإضافة </option>
                    
                </select>
			   <select  name="sorting-areaId" id="sorting-areaId" onchange="sortMasjidList()" style="width:13%;height: 44px;float: right;text-align: right;margin-bottom: 10px;margin-right: 15px;border: 1px solid">
                    <option style="text-align:right" value="" > المدينة </option>
                    <?php   
                    $select="select * from areas where parent='0' and active=1";
                    $query=mysql_query($select);
                    while($res=mysql_fetch_assoc($query)) {
                        ?>
                        <option style="text-align:right" value="<?php echo $res['id'];?>" <?= ( $city == $res['id'] )?'selected':'' ?> ><?php echo $res['name'];?></option>
                        
                    <?php   
                    $select2="select * from areas where parent='".$res['id']."' and active=1";
                    $query2=mysql_query($select2);
                    while($res2=mysql_fetch_assoc($query2)) {
                        ?>
                        <option style="text-align:right" value="<?php echo $res2['id'];?>" <?= ( $city == $res2['id'] )?'selected':'' ?> >&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $res2['name'];?></option>
                    <?php }} ?>
                    
                </select>
                
					<div class="course-item-wrapper"  >
						<div class="gdlr-lms-course-grid2-wrapper">
							<div class="clear"></div>
							<? if( count( $masjids ) > 0 ){ ?>
							<? foreach( $masjids as $masjid ):
                            $art_link = "masjed_details/$masjid[id]/".clean_url($masjid['name'])."/"; ?>
								<div class="gdlr-lms-course-grid2 gdlr-lms-col4">
									<div class="gdlr-lms-item ">
										<div class="gdlr-lms-course-thumbnail">
											<a href="<?=$art_link;?>" >
												<img src="cms/uploads/<?= $masjid['image']; ?>" alt="" width="400" height="300" />
											</a>
										</div>
										<div class="gdlr-lms-course-content">
											<h3 class="gdlr-lms-course-title">
												<a href="<?=$art_link;?>"><?= $masjid['name'];?></a>
											</h3>
											<div>
												<?= getValue('name','areas',$masjid['areaId'] );?>
											</div>
											<div>
												<span><b>المعدل العام : </b></span>
												<?= round( _generalAvarageOfMasjed( $masjid['id'] ),2 ); ?>
											</div>
											
											<!-- <div class="gdlr-lms-course-info" style="float:left !important;" >
												<?= $masjid['brief'];?>
											</div> -->
											<div class="clear"></div>
										</div>
									</div>
								</div>
							<? endforeach ?>
							<? }else { ?>
								<h3>Empty Results</h3>
							<? } ?>	
						</div>
					</div>
					<div class="clear"></div>
				</div>
			</section>
		</div>
	</div>
	<div class="clear" ></div>
</div>
<?php include("includes/footer.php");?>

<script>
function sortMasjidList(){
    var val = $('#sorting-masjid').val();
    var city = $('#sorting-areaId').val();
    document.location='masjid/?sort='+val+'&city='+city;   
}
</script>