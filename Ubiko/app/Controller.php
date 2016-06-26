 <?php

 class Controller
 {

    private $model;
    private $hora;
    private $contadorTotal;
    private $contadorParcial;
    private $inicio;
    private $fin;


    public function __construct(){
        //session_start();
        session_start();
        $this->model = new Model(Config::$mvc_bd_nombre, Config::$mvc_bd_usuario,
            Config::$mvc_bd_clave, Config::$mvc_bd_hostname);   
    }

    //Carga la plantilla del log in (inicio.php)
    //Una vez hecho el post llama al model para buscar el usuario enviado
    //En caso de encontrarlo vuelve al index
    //En caso negativo vuelve al log in (inicio.php)
    public function logIn()
    {

        if(isset($_POST['usuario']) && isset($_POST['password'])){
            
            $nombre = $_POST['usuario'];
            $pass = $_POST['password'];
            $resultado = $this->model->logIn($nombre, $pass);

            if ($resultado->num_rows > 0) {
                $_SESSION["nombreUsuario"] = $nombre;
                $_SESSION["nombrePaciente"] = "Introduzca Paciente";
                $_SESSION['apellidosPaciente']=" ";
                $_SESSION["nhcPaciente"] = "NHC";
                $_SESSION["fondo"] = 'ad';
                //$_SESSION["hora1"] = date("H:i");

                header('Location: index.php?ctl=admision');
            }
            else{
                header('Location: index.php?ctl=logIn');
            }
        }
        require __DIR__ . '/Templates/inicio.php';
    }

    public function admision(){
        if(isset($_SESSION['nombreUsuario'])){
            $_SESSION["fondo"] = 'ad';
            if(isset($_POST['nombre']) && isset($_POST['apellidos']) && isset($_POST['nhc'])){
                $nombre = $_POST['nombre'];
                $apellidos = $_POST['apellidos'];
                $telefono = $_POST['telefono'];
                $direccion = $_POST['direccion'];
                $nhc = $_POST['nhc'];
                $anotaciones = $_POST['anotaciones'];
                $resultado1 = $this->model->buscarPacienteNhc($nhc);
                if($resultado1->num_rows >0){
                    
                    $_SESSION['nhcPaciente'] = $nhc;
                    echo "<script type=\"text/javascript\">alert(\"El paciente ya existe\");</script>";
                    $this->seguimiento();
                }else{
                    $resultado = $this->model->insertarPaciente($nombre, $apellidos, $telefono, $direccion, $nhc, $anotaciones);
                    $_SESSION["nombrePaciente"]=$nombre;
                    $_SESSION['apellidosPaciente']=$apellidos;
                    $_SESSION["nhcPaciente"]=$nhc;

                    $this->insertarPrimeraUbicacion($nhc, $_SESSION['nombreUsuario']);
                    
                    header('Location: index.php?ctl=seguimiento');
                }
            }

            require __DIR__ . '/Templates/admision.php';
        }else{
           $this->logIn();
       }
   }

   public function logOut(){ 
    session_destroy(); 
    
    header('Location: index.php?ctl=logIn'); 
}

public function seguimiento(){
    if(isset($_SESSION['nombreUsuario'])){
        $_SESSION["fondo"] = 'seg';
        if(isset($_POST['buscador'])){
            $nhc = $_POST['buscador'];
            $resultado = $this->model->buscarPacienteNhc($nhc);
            if($resultado->num_rows > 0){
                foreach ($resultado as $result) :
                    $_SESSION['nombrePaciente'] = $result['nombre'];
                $_SESSION['apellidosPaciente'] = $result['apellidos'];
                $_SESSION['nhcPaciente'] = $result['nhc'];
                endforeach;
            }else{
                echo "<script type=\"text/javascript\">alert(\"El paciente no existe\");</script>";
                $this->admision();
            }
            $this->recuperarUbicacionesPaciente($nhc);
        }else{
            $this->recuperarUbicacionesPaciente($_SESSION['nhcPaciente']);
        }
        require __DIR__ . '/Templates/seguimiento.php';    
    }else{
        $this->logIn();   
    }
}


public function insertarUbicacion($nhc, $idLocalizacion, $usuario){
    $horaActual = date("H:i:s");
    $fechaActual = date("y-m-d");
    $this->model->insertarUbicacion($nhc, $idLocalizacion, $horaActual, $fechaActual, $usuario);
}

public function insertarPrimeraUbicacion($nhc, $usuario){
    $horaActual = date("H:i:s");
    $fechaActual = date("y-m-d");
    $this->model->insertarPrimeraUbicacion($nhc, 'AD', $horaActual, $fechaActual, $usuario);
    $this->model->insertarPrimeraUbicacion($nhc, 'TR', $horaActual, $fechaActual, $usuario);
}

public function box(){
    if(isset($_SESSION['nombreUsuario'])){
        $_SESSION["fondo"] = 'box';
        $this->recuperarCamas();

        require __DIR__ . '/Templates/box.php';
    } else{
        $this->login();
    }
}

public function recuperarUbicaciones(){
    $this->recuperarUbicacionesPaciente($_SESSION['nhcPaciente']);
    header('Location: index.php?ctl=seguimiento'); 
    
}


public function recuperarUbicacionesPaciente($nhc){
    $params['resultado'] = $this->model->recuperarUbicacionesPaciente($nhc);
    $this->contadorTiempo = 0;
    if(count($params) > 0){
            //reset de $_SESSION['infoUbicacion'] para que cada vez que se ejecute una búsqueda guarde unicamente los datos de la busqueda en cuestión.
        $this->contadorParcial = "00:00:00";
        $this->contadorTotal = "00:00:00";
        $_SESSION['infoUbicacion'] = null;
        foreach ($params['resultado'] as $result) :
            if($result['horaFin'] != null){
                $this->fin = date('H:i:s',strtotime($result['horaFin']));
                $this->inicio = date('H:i:s',strtotime($result['horaInicio']));  
                $this->contadorParcial = $this->restarHoras($this->inicio, $this->fin);
                $this->contadorTotal = $this->sumarHoras($this->contadorTotal, $this->contadorParcial);  
            }
            $info = array('horaInicio' => $result['horaInicio'], 'localizacion' => $result['Localizacion_idLocalizacion'], 'horaFin' => $result['horaFin'], 'tiempoParcial' => $this->contadorParcial, 'tiempoTotal' => $this->contadorTotal);
            $_SESSION['infoUbicacion'][] = $info;
            endforeach;
                /*$mostrar = $_SESSION['infoUbicacion'][0]['horaInicio'];
                $mostrar1 = $_SESSION['infoUbicacion'][0]['localizacion'];
                $mostrar2 = $_SESSION['infoUbicacion'][1]['horaInicio'];
                $mostrar3 = $_SESSION['infoUbicacion'][1]['localizacion'];
                $mostrar4 = $_SESSION['infoUbicacion'][2]['horaInicio'];
                $mostrar5 = $_SESSION['infoUbicacion'][2]['localizacion'];
                echo "<script type=\"text/javascript\">alert(\"$mostrar, $mostrar1, $mostrar2, $mostrar3, $mostrar4, $mostrar5\");</script>";*/
            }
        }
    //Recupera todas las camas de BD con su Localización y con el paciente asignado en caso de existir
        public function recuperarCamas(){
            $params['resultado'] = $this->model->recuperarCamas();
            if(count($params) > 0){
                $_SESSION['infoCamas'] = null;
                foreach ($params['resultado'] as $result) :
                    $info = array('localizacion' => $result['Localizacion_idLocalizacion'], 'numeroCama' => $result['numeroCama'], 'paciente' => $result['Paciente_NHCPaciente']);
                $_SESSION['infoCamas'][] = $info;
                endforeach;
            }
        }

        public function insertarBOX(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'BOX'){
                echo "<script type=\"text/javascript\">alert(\"dentro\");</script>";
            //Comprobar cama
                $resultado = $this->model->comprobarCamaBox($_SESSION['nhcPaciente']);
                if ($resultado->num_rows == 0) {
                    $params['resultado'] = $this->model->recuperarCamasVacias();
                    if(count($params) > 0){
                        $_SESSION['camasVacias'] = null;
                        foreach ($params['resultado'] as $result) :
                            $camas = array('localizacion' => $result['Localizacion_idLocalizacion'], 'numeroCama' => $result['numeroCama']);
                        $_SESSION['camasVacias'][] = $camas;
                        endforeach;
                        $this->model->insertarCamaBOX($_SESSION['nhcPaciente'], $_SESSION['camasVacias'][0]['localizacion'], $_SESSION['camasVacias'][0]['numeroCama']);
                        $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                        $this->insertarUbicacion($_SESSION['nhcPaciente'], 'BOX', $_SESSION['nombreUsuario']);
                    }
                }else{

                    $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                    $this->insertarUbicacion($_SESSION['nhcPaciente'], 'BOX', $_SESSION['nombreUsuario']);
                }
                $this->recuperarUbicaciones();
            }
            $this->recuperarUbicaciones();
        }

        public function insertarECO(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'ECO'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'ECO', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarRX(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'RX'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'RX', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarTAC(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'TAC'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'TAC', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarTR(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'TR'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'TR', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarSalaA(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'SALA A'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'SALA A', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarSalaB(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'SALA B'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'SALA B', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarSalaTra(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'SALA TRA'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'SALA TRA', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarOBS(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'SALA OBS'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'SALA OBS', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarQUI(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            if($_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion'] != 'QUI'){
                $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
                $this->insertarUbicacion($_SESSION['nhcPaciente'], 'QUI', $_SESSION['nombreUsuario']);
            }
            $this->recuperarUbicaciones();
        }

        public function insertarING(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
            $this->insertarEstadoFinal($_SESSION['nhcPaciente'], '2');
            $this->liberarCama($_SESSION['nhcPaciente']);
            $this->insertarUbicacion($_SESSION['nhcPaciente'], 'ING', $_SESSION['nombreUsuario']);
            $this->insertarFinUbicacionFinal($_SESSION['nhcPaciente'], 'ING');
            $this->recuperarUbicaciones();
        }

        public function insertarExitus(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
            $this->insertarEstadoFinal($_SESSION['nhcPaciente'], '3');
            $this->liberarCama($_SESSION['nhcPaciente']);
            $this->insertarUbicacion($_SESSION['nhcPaciente'], 'EXITUS', $_SESSION['nombreUsuario']);
            $this->insertarFinUbicacionFinal($_SESSION['nhcPaciente'], 'EXITUS');
            $this->recuperarUbicaciones();
        }

        public function insertarAlta(){
            $ultimaUbicacion = count($_SESSION['infoUbicacion'])-1;
            $this->insertarFinUbicacionAnterior($_SESSION['nhcPaciente'], $_SESSION['infoUbicacion'][$ultimaUbicacion]['localizacion']);
            $this->insertarEstadoFinal($_SESSION['nhcPaciente'], '4');
            $this->liberarCama($_SESSION['nhcPaciente']);
            $this->insertarUbicacion($_SESSION['nhcPaciente'], 'ALTA', $_SESSION['nombreUsuario']);
            $this->insertarFinUbicacionFinal($_SESSION['nhcPaciente'], 'ALTA');
            $this->recuperarUbicaciones();
        }

        public function insertarFinUbicacionAnterior($nhc, $ultimaUbicacion){
            $hora = date("H:i:s");
            $this->model->insertarFinUbicacionAnterior($nhc, $ultimaUbicacion, $hora);
        }

        public function insertarFinUbicacionFinal($nhc, $ubicacionFinal){
            $hora = date("H:i:s");
            $this->model->insertarFinUbicacionAnterior($nhc, $ubicacionFinal, $hora);
        }

        public function insertarEstadoFinal($nhc, $estado){
            $this->model->insertarEstadoFinal($nhc, $estado);
        }

        public function liberarCama($nhc){
            $this->model->liberarCama($nhc);
        }

        public function restarHoras($horaini,$horafin)
        {
            $toret;
            $horai=substr($horaini,0,2);
            $mini=substr($horaini,3,2);
            $segi=substr($horaini,6,2);
            
            $horaf=substr($horafin,0,2);
            $minf=substr($horafin,3,2);
            $segf=substr($horafin,6,2);
            
            $ini=((($horai*60)*60)+($mini*60)+$segi);
            $fin=((($horaf*60)*60)+($minf*60)+$segf);
            
            $dif=$fin-$ini;
            
            $difh=floor($dif/3600);
            $difm=floor(($dif-($difh*3600))/60);
            $difs=$dif-($difm*60)-($difh*3600);
            $toret = date("H-i-s",mktime($difh,$difm,$difs));
            $toret = str_replace('-', ':', $toret);
            return $toret;
        }

        public function sumarHoras($horaini,$horafin)
        {
            $toret;
            $horai=substr($horaini,0,2);
            $mini=substr($horaini,3,2);
            $segi=substr($horaini,6,2);
            
            $horaf=substr($horafin,0,2);
            $minf=substr($horafin,3,2);
            $segf=substr($horafin,6,2);
            
            $ini=((($horai*60)*60)+($mini*60)+$segi);
            $fin=((($horaf*60)*60)+($minf*60)+$segf);
            
            $dif=$fin+$ini;
            
            $difh=floor($dif/3600);
            $difm=floor(($dif-($difh*3600))/60);
            $difs=$dif-($difm*60)-($difh*3600);
            $toret = date("H-i-s",mktime($difh,$difm,$difs));
            $toret = str_replace('-', ':', $toret);
            return $toret;
        }

        public function estadisticas(){
            if(isset($_SESSION['nombreUsuario'])){
                $_SESSION["fondo"] = 'estadisticas';     
                $params['resultado'] = $this->model->estadisticasUbicaciones(); 
                
                if(count($params) > 0){
                    $_SESSION['estadisticasLoc'] = null; 
                    $_SESSION['estadisticasNum'] = null;
                    foreach ($params['resultado'] as $result) :
                        $_SESSION['estadisticasLoc'][] = $result['Localizacion_idLocalizacion'];
                    $_SESSION['estadisticasNum'][] = $result['numeroPacientes'];   
                    endforeach;
                }

                require __DIR__ . '/Templates/estadisticas.php';
            }else{
               $this->logIn();
           }
       }

   }
   ?>