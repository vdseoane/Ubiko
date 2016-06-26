<?php 
// datos para la coneccion a mysql 
define('DB_SERVER','localhost'); 
define('DB_NAME','ubiko'); 
define('DB_USER','user'); 
define('DB_PASS','user'); 

$con = mysql_connect(DB_SERVER,DB_USER,DB_PASS); 
mysql_select_db(DB_NAME,$con); 
?>