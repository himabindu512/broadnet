<?
include "common.php";
require_once ('includes/imageResize.func.php');
$r = $db->select ( "select id,path from item_images" );
while ( $row = $db->get_row ( $r, 'MYSQL_BOTH' ) ) {
	
	$imagesFolder = "uploads/";
	$reg_file = "reg!" . $row ['path'];
	$file_path = $imagesFolder . $row ['path'];
	$reg_file_path = $imagesFolder . $reg_file;
	$result = move_uploaded_file ( $temp_name, $file_path );
	chmod ( $file_path, 0777 );
	$I = new Image ( $file_path );
	$I->width ( 200 );
	//$I->width ( 364 );
	//$imgsrc = $I->resource();
	//$height = imagesy($imgsrc);
	//$difference = $height-364;
	//$I->crop_h(($difference/2));
	$I->write ( $reg_file_path );
	$res = $db->update_sql ( "update item_images set path='" . $reg_file . "' where id=" . $row ['id'] );
	$db->print_last_query ();
	unlink ( $file_path );
}

?>