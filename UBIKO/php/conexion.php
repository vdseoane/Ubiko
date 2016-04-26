<?php

session_start(); 
//Variables de conexion a la base de datos 
$host="localhost"; // Nombre del host  
$username="user"; // usuarioMysql  
$password="user"; // password Mysql  
$db_name="ubiko"; // Nombre de la BD 

$mysqli = new mysqli("localhost", "user", "user", "ubiko");
if ($mysqli->connect_errno) {
    echo "Fallo al conectar a MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
else
echo "EXITO";

/* @var $_POST type */
$nombre= $_POST["usuario"];
$pass= $_POST["password"];

$sql = "SELECT idUsuario, Password FROM Usuario WHERE idUsuario = $nombre 
		AND Password = $pass";
$result = $mysqli->query($sql);

if ($result->num_rows > 0) {
	echo "logeado";

} else {
    header('Location: ../../../Ubiko/admision.html'); 
    echo "no logeado";
}
?>