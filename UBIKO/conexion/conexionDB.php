
<?php
 

function conexion(){
	$host="localhost"; // Nombre del host  
	$username="user"; // usuarioMysql  
	$password="user"; // password Mysql  
	$db_name="ubiko"; // Nombre de la BD 

	$mysqli = new mysqli("localhost", "user", "user", "ubiko");
	if ($mysqli->connect_errno) {
	    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
	}
	else{
		return $mysqli;
	}
}

?>