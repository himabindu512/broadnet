<?
//echo "hi";exit;
error_reporting(E_ALL);
ini_set( "display_errors", 0);
ini_set('max_execution_time', 120);
ini_set('post_max_size',"20M");
ini_set('memory_limit',"256M");
ini_set('max_input_vars',"2500");
date_default_timezone_set('Asia/Beirut');
session_start ();
// Use the DB managment class and declare an instance of it
require_once ('classes/db.class.php');

$db = new db_class ();
// connect to the database
if (! $db->connect ())
	$db->print_last_error ( true );
$site_url='';

require_once ('functions.php');

$path =  $_SERVER['PHP_SELF'];

$file = basename($path);         // $file is set to "index.php"
$file = basename($path, ".php"); 

function POSTtmyFunc_mysql_real_escape_string(&$item, $key) {
    $item = str_replace('"',"'",mysql_real_escape_string(trim($item)));
  $_POST[$key] = $item;
}
function REQUESTmyFunc_mysql_real_escape_string(&$item, $key) {
    $item = str_replace('"',"'",mysql_real_escape_string(trim($item)));
  $_REQUEST[$key] = $item;
}
function GETmyFunc_mysql_real_escape_string(&$item, $key) {
    $item = str_replace('"',"'",mysql_real_escape_string(trim($item)));
  $_GET[$key] = $item;
}
@array_walk_recursive(@$_POST,'POSTtmyFunc_mysql_real_escape_string');
@array_walk_recursive(@$_GET,'GETmyFunc_mysql_real_escape_string');
@array_walk_recursive(@$_REQUEST,'REQUESTmyFunc_mysql_real_escape_string');
?>