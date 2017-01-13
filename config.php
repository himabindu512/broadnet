<?php
ini_set('max_execution_time', 5);
set_time_limit(20*60);
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set( "display_errors", 0 );
date_default_timezone_set('Asia/Beirut');
@session_start ();

define('localHostname', 'localhost' );
define('localHostUsername', 'root' );
define('localHostPassword', '' );
define('localDb', 'broadmed_db' );



require_once ('general.php');

require_once ('classes/dbMG.class.php');
$dbMG = new _dbMGClass();

require_once 'classes/dbs.class.php';
$dbServer = new dbs_class();

$localTables = $dbServer -> _getTableNames();

require_once 'classes/aSync.php';
$dbMGSync = new _dbMGSync();
