<?php
function isAjaxRequest(){
	if( !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest' ){
		return true;
	}else{
		return false;
	}
}
function _displayPre( $details ){
	echo '<pre>';
	print_r( $details );
	echo '</pre>';
}