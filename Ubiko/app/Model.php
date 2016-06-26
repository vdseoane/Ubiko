<?php

class Model
{
    protected $conexion;

    //Conexion a la base de datos
    public function __construct($dbname,$dbuser,$dbpass,$dbhost)
    {   
        $mvc_bd_conexion = mysqli_init();
        $mvc_bd_conexion = new mysqli($dbhost, $dbuser,$dbpass, $dbname);
        
        if ($mvc_bd_conexion->connect_errno) {
            echo "Fallo al conectar a MySQL: (" . $mvc_bd_conexion->connect_errno . ") " . $mvc_bd_conexion->connect_error;
        }

        $this->conexion = $mvc_bd_conexion;
    }

    public function bd_conexion()
    {

    }

    public function logIn($nombre, $pass){
        $sql = "SELECT idUsuario, Password FROM usuario WHERE idUsuario = '".$nombre."'
        AND Password = '". $pass."'";

        $resultado = $this->conexion->query($sql);

        return $resultado;
    }

    public function insertarPaciente($nombre, $apellidos, $telefono, $direccion, $nhc, $anotaciones){
        $sql ="INSERT INTO paciente(nhc, nombre, apellidos, direccion, estado, telefono, anotaciones)
        VALUES('".$nhc."','".$nombre."','".$apellidos."','".$direccion."','1','".$telefono."','".$anotaciones."')";

        $resultado = $this->conexion->query($sql);

        return $resultado;
    }

    public function buscarPacienteNhc($nhc){
        $sql = "SELECT nombre, nhc, apellidos FROM paciente WHERE nhc = '".$nhc."'";

        $resultado = $this->conexion->query($sql);

        return $resultado;
    }

    public function insertarUbicacion($nhc, $idLocalizacion, $horaInicio, $fecha, $usuario){
        $sql ="INSERT INTO ubicacionPaciente(Paciente_NHC, Localizacion_idLocalizacion, horaInicio, fecha, Usuario_idUsuario)
        VALUES('".$nhc."','".$idLocalizacion."','".$horaInicio."','".$fecha."','".$usuario."')";
        $this->conexion->query($sql);
    }

    public function insertarPrimeraUbicacion($nhc, $idLocalizacion, $horaInicio, $fecha, $usuario){
        $sql ="INSERT INTO ubicacionPaciente(Paciente_NHC, Localizacion_idLocalizacion, horaInicio, fecha, Usuario_idUsuario)
        VALUES('".$nhc."','".$idLocalizacion."','".$horaInicio."','".$fecha."','".$usuario."')";
        $this->conexion->query($sql);
    }

    public function recuperarUbicacionesPaciente($nhc){
        $sql = "SELECT Localizacion_idLocalizacion, horaInicio, horaFin, orden FROM ubicacionPaciente WHERE Paciente_NHC = '".$nhc."' ORDER BY orden";

        $resultado = $this->conexion->query($sql);

        $res = array();
        while ($row = mysqli_fetch_assoc($resultado))
        {
           $res[] = $row;
       }

       return $res;
   }

   public function recuperarCamas(){
    $sql = "SELECT Localizacion_idLocalizacion, numeroCama, Paciente_NHCPaciente FROM cama ORDER BY numeroCama";

    $resultado = $this->conexion->query($sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($resultado))
    {
       $res[] = $row;
   }

   return $res;
}

public function insertarFinUbicacionAnterior($nhc, $ultimaUbicacion, $hora){
    $sql = "UPDATE ubicacionPaciente SET horaFin='".$hora."' WHERE Localizacion_idLocalizacion='".$ultimaUbicacion."' AND Paciente_NHC='".$nhc."' AND isNull(horaFin)";
    $this->conexion->query($sql);
}

public function recuperarCamasVacias(){
    $sql = "SELECT Localizacion_idLocalizacion, numeroCama FROM cama WHERE isNull(Paciente_NHCPaciente)";

    $resultado = $this->conexion->query($sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($resultado))
    {
       $res[] = $row;
   }

   return $res;
}

public function comprobarCamaBox($nhc){
    $sql = "SELECT Paciente_NHCPaciente FROM cama WHERE Paciente_NHCPaciente = '".$nhc."'";

    $resultado = $this->conexion->query($sql);

    return $resultado;
}

public function insertarCamaBOX($nhc, $localizacion, $numero){
    $sql = "UPDATE cama SET Paciente_NHCPaciente='".$nhc."' WHERE Localizacion_idLocalizacion='".$localizacion."' AND numeroCama='".$numero."'";
    $this->conexion->query($sql);
}

public function insertarEstadoFinal($nhc, $estado){
    $sql = "UPDATE Paciente SET estado='".$estado."' WHERE nhc='".$nhc."'";
    $this->conexion->query($sql);
}

public function liberarCama($nhc){
    $sql = "UPDATE cama SET Paciente_NHCPaciente=null WHERE Paciente_NHCPaciente='".$nhc."'";
    $this->conexion->query($sql);
}

public function estadisticasUbicaciones(){
    $sql = "SELECT Localizacion_idLocalizacion, COUNT(Localizacion_idLocalizacion) as numeroPacientes FROM (SELECT DISTINCTROW(Localizacion_idLocalizacion), Paciente_NHC FROM ubicacionPaciente) tabla GROUP BY (Localizacion_idLocalizacion)";

    $resultado = $this->conexion->query($sql);

    $res = array();
    while ($row = mysqli_fetch_assoc($resultado))
    {
       $res[] = $row;
   }

   return $res;
}

}
?>