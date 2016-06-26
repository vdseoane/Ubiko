 <?php ob_start() ?>

 <form method="post" action="index.php?ctl=admision">
    <div id="divForm">
        <div class="form-inline">
            <label id="nombre">Nombre</label>
            <label id="apellidos">Apellidos</label>
            <label id="telefono">Tel&eacute;fono</label>
        </div>
        <div class="form-inline">
            <input type="text" name="nombre" id="nombre" required class="form-control">
            <input type="text" name="apellidos" required id="apellidos" class="form-control">
            <input type="text" name="telefono" id="telefono" class="form-control">
        </div>
    </div>
    <div id="divForm1">
        <div class="form-inline">
            <label id="direccion">Direcci&oacute;n</label>
            <label id="nhc">NHC</label>
        </div>
        <div class="form-inline">
            <input type="text" name="direccion" id="direccion" class="form-control">
            <input type="text" name="nhc" required id="nhc" class="form-control">
        </div>
    </div>
    <div id="divForm2">
        <label id="anotaciones">Anotaciones</label>
        <textarea name="anotaciones" id="anotaciones" cols="30" rows="6" class="form-control"></textarea>
    </div>
    <div id="enviar">
        <input type="image" value="" SRC="img/boton_enviar.jpg"> 
    </div>
</form>

<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>