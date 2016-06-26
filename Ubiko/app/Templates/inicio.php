<!doctype html>
<html>
<link rel="stylesheet" href="./css/bootstrap.css">
<link href="./css/log.css" rel="stylesheet" type="text/css">

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>

<head>
    <title>logIn</title>
    <link rel="icon" type="image/gif" href="img/animated_favicon1.gif">
</head>

<body>
    <div id="main">
        <div id="contenedor">
            <div id="form">
                <form method="post" action="index.php?ctl=logIn">
                   <div id="logo">
                     <a href="logIn.html"><img src="img/logo_ubiko.png" width="165" height="72" alt="logo"/></a>
                 </div>
                 <div class="form-inblock" id="divUsuario">
                    <label id="usuario">Usuario</label>
                    <input type="text" name="usuario" id="usuario" class="form-control">
                </div>
                <div class="form-inblock" id="divPass">
                    <label id="password">Contrase&ntildea</label>
                    <input type="password" name="password" required id="password" class="form-control">
                </div>
                <div id="enviar">
                   <input type="image" value="" SRC="img/boton_enviar.jpg">
               </div>
           </form>
       </div>
   </div>
</div>
</body>
</html>