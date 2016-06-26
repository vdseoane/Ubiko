 <?php
 // web/index.php

 // carga del modelo y los controladores
 include_once __DIR__ . '/../app/Config.php';
 include_once __DIR__ . '/../app/Model.php';
 include_once __DIR__ . '/../app/Controller.php';
 //include_once __DIR__ . '/../app/datos.php';

 // enrutamiento
 $map = array(
     'logIn' => array('controller' =>'Controller', 'action' =>'logIn'),
     'admision' => array('controller' =>'Controller', 'action' =>'admision'),
     'logOut' => array('controller' =>'Controller', 'action' =>'logOut'),
     'seguimiento' => array('controller' =>'Controller', 'action' =>'seguimiento'),
     'seg' => array('controller' =>'Controller', 'action' =>'seg'),
     'estadisticas' => array('controller' =>'Controller', 'action' =>'estadisticas'),
     'box' => array('controller' =>'Controller', 'action' =>'box'),
     'ubicacion' => array('controller' =>'Controller', 'action' =>'ubicacion'),
     'insertarBOX' => array('controller' =>'Controller', 'action' =>'insertarBOX'),
     'insertarECO' => array('controller' =>'Controller', 'action' =>'insertarECO'),
     'insertarRX' => array('controller' =>'Controller', 'action' =>'insertarRX'),
     'insertarTAC' => array('controller' =>'Controller', 'action' =>'insertarTAC'),
     'insertarTR' => array('controller' =>'Controller', 'action' =>'insertarTR'),
     'insertarSalaA' => array('controller' =>'Controller', 'action' =>'insertarSalaA'),
     'insertarSalaB' => array('controller' =>'Controller', 'action' =>'insertarSalaB'),
     'insertarSalaTra' => array('controller' =>'Controller', 'action' =>'insertarSalaTra'),
     'insertarOBS' => array('controller' =>'Controller', 'action' =>'insertarOBS'),
     'insertarQUI' => array('controller' =>'Controller', 'action' =>'insertarQUI'),
     'insertarING' => array('controller' =>'Controller', 'action' =>'insertarING'),
     'insertarExitus' => array('controller' =>'Controller', 'action' =>'insertarExitus'),
     'insertarAlta' => array('controller' =>'Controller', 'action' =>'insertarAlta'),
     'recuperarUbicaciones' => array('controller' =>'Controller', 'action' =>'recuperarUbicaciones')
 );

 // Parseo de la ruta
 if (isset($_GET['ctl'])) {
     if (isset($map[$_GET['ctl']])) {
         $ruta = $_GET['ctl'];
     } else {
         header('Status: 404 Not Found');
         echo '<html><body><h1>Error 404: No existe la ruta <i>' .
                 $_GET['ctl'] .
                 '</p></body></html>';
         exit;
     }
 } else {
     $ruta = 'logIn';
 }

 $controlador = $map[$ruta];
 // Ejecución del controlador asociado a la ruta

 if (method_exists($controlador['controller'],$controlador['action'])) {
     call_user_func(array(new $controlador['controller'], $controlador['action']));
 } else {

     header('Status: 404 Not Found');
     echo '<html><body><h1>Error 404: El controlador <i>' .
             $controlador['controller'] .
             '->' .
             $controlador['action'] .
             '</i> no existe</h1></body></html>';
 }
 ?>