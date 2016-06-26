<!doctype html>
<html>
<link rel="stylesheet" href="./css/bootstrap.css">


<link href="./libs/jquery-ui/jquery-ui.min.css" rel="stylesheet" type="text/css">

<link href="./css/cssIndex.css" rel="stylesheet" type="text/css">
<link href="./css/cssAdmision.css" rel="stylesheet" type="text/css">
<link href="./css/cssSeguimiento.css" rel="stylesheet" type="text/css">
<link href="./css/cssBox.css" rel="stylesheet" type="text/css">
<link href="./css/cssEstadisticas.css" rel="stylesheet" type="text/css">

<link href="" rel="stylesheet" type="text/css" id="linkestilo">

<!--<script src="./js/jquery-1.9.0.js"></script>-->



<script src="./libs/jquery-1.12.0.js"></script>
<script src="./libs/jquery-ui/jquery-ui.min.js"></script>
<script src='./libs/infinitecarrousel.js'></script>
<script src='./libs/carouselBox.js'></script>
<script src='./js/main.js'></script>



<script src='./js/Chart.min.js' charset="utf-8"></script>



<!--<script src="./js/jquery-1.5.min.js"></script>-->



<head>
  <title>index</title>
  <link rel="icon" type="image/gif" href="img/animated_favicon1.gif">
</head>

<body>

  <div id="main">
    <div id="cabecera">
      <div id="logo">
        <a href="index.php?ctl=logOut"><image src="img/logo_ubiko.png" width="165" height="72" alt="logo"/></a>
      </div>
      <div id="navegacion">
        <ul class="navegacion_ul">
          <li class="navegacion_li"><a id="admision" title="Admision" href="index.php?ctl=admision" style="<?php if($_SESSION["fondo"] == 'ad'){ ?> background-color: #339999 <?php } ?> ">Admisi&oacute;n</a></li>
          <li class="navegacion_li"><a id="seguimiento"  title="Seguimiento" href="index.php?ctl=seguimiento" style="<?php if($_SESSION["fondo"] == 'seg'){ ?> background-color: #339999 <?php } ?> ">Seguimiento</a></li>
          <li class="navegacion_li"><a id="box" href="index.php?ctl=box" title="BOX" style="<?php if($_SESSION["fondo"] == 'box'){ ?> background-color: #339999 <?php } ?> ">BOX</a></li>
          <li class="navegacion_li"><a id="estadisticas" title="Estadisticas" href="index.php?ctl=estadisticas" style="<?php if($_SESSION["fondo"] == 'estadisticas'){ ?> background-color: #339999 <?php } ?>">Estad&iacute;sticas</a></li>
        </ul>
      </div>
      <div id="login">
        <div>
          <input type="text" name="texto_login" value= <?php echo $_SESSION["nombreUsuario"]; ?>  id="texto_login" class="form-control" readonly>
          <img id="imagen_login" src="img/acceso.jpg" width="220" height="72" alt="login" />
          <a href="index.php?ctl=logOut"> <image type="image" id="boton_login" src="img/logOut.png" alt="boton_login"> </a>
        </div>
      </div>
    </div>
    <div id="contenedor">
      <?php echo $contenido ?>
    </div>
  </div>
</body>
<script>


</script>
</html>
