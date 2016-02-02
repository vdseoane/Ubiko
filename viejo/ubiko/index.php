<!DOCTYPE html>

<head>

	<title>Ubiko</title>
	
	<link rel="shortcut icon" href="ubiko.ico" >
	<link href="css/css1.css" rel="stylesheet" type="text/css"  />
  <!---jquery-->  
  <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
  <title>JQuery Ajax</title>
  <script type="text/javascript" src="jquery-1.3.2.min.js"></script>
  <script type="text/javascript">
            $(document).ready(function() {
				$("#admision").click(function(event) {
                    $("#contenedor").load('./admision.php');
                });
                $("#seguimiento").click(function(event) {
                    $("#contenedor").load('./seguimiento.php');
                });
				$("#BOX").click(function(event) {
                    $("#contenedor").load('./admision.php');
                });
				$("#estadisticas").click(function(event) {
                    $("#contenedor").load('./estadisticas.php');
                });
				
            });
</script>
	
</head>

<body>
	<header id=cab>
		<div id=cont_logo>
		<div id=logo>
			<div><a href="home.php" class="linkcontent"><img alt="logotipo" src="./img/logo.jpg"/></a></div>
		</div>
		</div>
	
		<div id=login>
			<div id=img_log>
				<div><img alt="login" src="./img/login.jpg"/></div>
				<div id=bot_log>
				<div><a href="login.php" class="linkcontent"><img alt="botón login" src="./img/bot_log.jpg"/></a></div>
				</div>
				<div id="pass"><input type="text" /></div>
			</div>
		</div>
		
		<!--menu-->
		<nav id=navegacion>
				<ul>
					<li><a id=admision class="admision">Admisi&oacute;n</a></li>       
					<li><a id=seguimiento class="seguimiento">Seguimiento</a></li>       
					<li><a id=BOX class="BOX">BOX</a></li>      
					<li><a id=estadisticas class="estadisticas">Estad&iacute;sticas</a></li>     
				</ul>
		</nav>
	
	
	
	</header>
	
	<div id=contenedor>
		<div id=formulario>
        	<div>
        		<div class="izq1" id="nombre1">Nombre</div>
         		<div class="izq1" id="apellidos1">Apellidos</div>
         		<div class="izq1" id="telf1">Tel&eacute;fono</div>
            </div>
            <div>
        		<div class="izq2" ><input id="nombre" type="text"/></div>
         		<div class="izq2"><input id="apellidos" type="text"/></div>
         		<div class="izq2"><input id="telf" type="text"/></div>
            </div>
            <div>
          	  	<div class="izq1" id="direccion1">Direcci&oacute;n</div>
            	<div class="izq1" id="nhc1">NHC</div>
            </div>
            <div>
            	<div class="izq2" ><input id="direccion" type="text"/></div>
         		<div class="izq2"><input id="nhc" type="text"/></div>
            </div>
            <div class="izq1" id="anotaciones1">Anotaciones</div>
            <div class="izq2" ><input id="anotaciones" type="text"/></div>
            <div class="centro" id="bot_admis"><a href="admision.php" class="linkcontent"><img alt="boton admitir" src="./img/bot_admis.jpg"/></a></div>
        </div>
        </div>
	</div><!-- fin contenedor-->
	
</body>