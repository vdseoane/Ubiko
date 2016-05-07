<?php

include("../conexion/conexionDB.php");

function login($nombre, $pass,$mysqli)
{
	//$nombre= $_POST["usuario"];
	//$pass= $_POST["password"];

	$sql = "SELECT idUsuario, Password FROM usuario WHERE idUsuario = '".$nombre."'
			AND Password = '". $pass."'";
	$result = $mysqli->query($sql);

	if ($result->num_rows > 0) {
		header('Location: ../../../Ubiko/admision.html');
	} else { 
	    echo "no logeado";
	}
}

function insertarPaciente($nombre, $apellidos, $telefono, $direccion, $nhc, $anotaciones, $mysqli){
	echo "Holaaaaaa";
	$sql ="INSERT INTO Paciente(nhc, nombre, apellidos, calle, estado, telefono, anotaciones)
	VALUES('".$nhc."','".$nombre."','".$apellidos."','".$direccion."','1','".$telefono."','".$anotaciones."')";

	$mysqli->query($sql);
	if ($mysqli == true) {
		header('Location: ../../../Ubiko/seg.html');
	}
}

$mysqli = conexion();

//Datos del paciente




if(isset($_POST['usuario']) && isset($_POST['password'])){
	login($_POST['usuario'], $_POST['password'],$mysqli);	
}

if(isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['nhc'])){
	insertarPaciente($_POST['nombre'], $_POST['apellidos'], $_POST['telefono'],
		$_POST['direccion'], $_POST['nhc'], $_POST['anotaciones'],$mysqli);	
}

?>


