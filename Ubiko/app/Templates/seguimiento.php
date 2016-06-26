    
<?php ob_start();
$cont = 0;
$cont1 = 0;
$contadorTiempo = 0;
?>

<div id="navCirculos">
  <div id="navCirculosDentro1" class="item-wrapper">
    <div id="BOX" class="xxx arrastrable"><span class="circulos blanco circulo">BOX</span></div>
    <div id="TAC" class="xxx arrastrable"><span class="circulos blanco">TAC</span></div>
    <div id="SALAA" class="xxx arrastrable"><span class="circulos azul">SALA A</span></div>
    <div id="SALATRA" class="xxx arrastrable"><span class="circulos lila">SALA TRA</span></div>
    <div id="QUI" class="xxx arrastrable"><span class="circulos violeta">QUI</span></div>
    <div id="EXITUS" class="xxx arrastrable"><span class="circulos negro">EXITUS</span></div>
  </div>
  <div id="navCirculosDentro2" class="item-wrapper">
    <div id="ECO" class="xxx arrastrable"><span class="circulos blanco">ECO</span></div>
    <div id="RX" class="xxx arrastrable"><span class="circulos blanco">RX</span></div>
    <div id="SALAB" class="xxx arrastrable"><span class="circulos pistacho">SALA B</span></div>
    <div id="SALAOBS" class="xxx arrastrable"><span class="circulos naranja">SALA OBS</span></div>
    <div id="ING" class="xxx arrastrable"><span class="circulos rojo">ING</span></div>
    <div id="ALTA" class="xxx arrastrable"><span class="circulos verde">ALTA</span></div>
  </div>
</div>
<div id="infoPaciente">
  <div class="superior">
    <form method='post' action='index.php?ctl=seguimiento'>
      <div class= "buscadorPaciente"> 
        <input type="image" class="imgBuscar" src ="img/boton_buscar.png">
        <input type="text" name="buscador" required id="buscador" class="form-control">
      </div>
    </form>
    <img type="image" value="" src ="img/infoPaciente1.png">
  </div>
  <div class="inferior">
    <div id= "inf">
      <input type="text" name="nombrePaciente" id="nombrePaciente" class="form-control" value= "<?php echo $_SESSION['nombrePaciente']." ".$_SESSION['apellidosPaciente']; ?>" readonly>
      <input type="text" name="nhcPaciente" id="nhcPaciente" class="form-control" value= "<?php echo $_SESSION['nhcPaciente']; ?>" readonly>
    </div>
    <img src ="img/infoPaciente2.png">
  </div>
</div>

<div id="libros"><img src="img/libros.jpg" alt="libros" /></div>
<div class="infiniteCarousel">
  <!--<div id="botonCancelar"><img src="img/boton_cancelar.png" alt="cancelar" /></div>-->
  <div id="botonesScroll" class="next"><img src="img/flechaArriba.png" alt="cancelar" /></div>
  <div id="botonesScroll" class="pre"><img src="img/flechaAbajo.png" alt="cancelar" /></div>     
  <div class="viewport">
    <div class="list">
      <?php for($i=0; $i<7; $i++){?>
        <!-- creación de la fila del carousel -->
        <div class="columnaCarousel">
        <!-- Si existe el paciente, cargamos las ubicaciones -->
          <?php if($_SESSION['nhcPaciente'] != "NHC"){ for($j=0; $j<3; $j++){?>
            <!-- Si el cuadrado ya tiene una ubicación no tendra la clase 'droppable' -->
            <div class="cuadradoLista <?php if(!isset($_SESSION['infoUbicacion'][$cont1]['localizacion'])){echo "droppable";} ?>" id="<?php echo $cont; ?>">
              <?php if(isset($_SESSION['infoUbicacion'][$cont1]['localizacion'])){ ?>
                <div id="<?php echo $_SESSION['infoUbicacion'][$cont1]['localizacion'] ?>" class="xxx">
                  <span class="circulos <?php 
                  switch ($_SESSION['infoUbicacion'][$cont1]['localizacion']) {
                    case 'AD':
                    echo 'azulAD';
                    break;
                    case 'TR':
                    echo 'azulTriaje';
                    break;
                    case 'BOX':
                    echo 'blanco';
                    break;
                    case 'ECO':
                    echo 'blanco';
                    break;
                    case 'TAC':
                    echo 'blanco';
                    break;
                    case 'RX':
                    echo 'blanco';
                    break;
                    case 'SALA A':
                    echo 'azul';
                    break;
                    case 'SALA B':
                    echo 'pistacho';
                    break;
                    case 'SALA TRA':
                    echo 'lila';
                    break;
                    case 'SALA OBS':
                    echo 'naranja';
                    break;
                    case 'QUI':
                    echo 'violeta';
                    break;
                    case 'ING':
                    echo 'rojo';
                    break;
                    case 'EXITUS':
                    echo 'negro';
                    break;
                    case 'ALTA':
                    echo 'verde';
                    break;
                  }
                  ?>">
                  <?php echo $_SESSION['infoUbicacion'][$cont1]['localizacion'] ?></span>
                  <div id="<?php $cont?>"><input type="text" name="tiempoParcial" id="tiempoParcial" class="tiempoParcial 
                    <?php if($_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'BOX' OR $_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'RX' OR $_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'ECO' OR $_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'TAC'){
                      echo "letraNegra";
                    }else{
                      echo "letraBlanca";
                    } ?>"   
                    value= "<?php if(isset($_SESSION['infoUbicacion'][$cont1]['horaFin'])){
                      echo $_SESSION['infoUbicacion'][$cont1]['tiempoParcial'];
                    } else{
                      echo "-";
                    }
                    ?>" readonly></div>
                    <div id="<?php $cont?>"><input type="text" name="tiempoTotal" id="tiempoTotal" class="tiempoTotal 
                      <?php if($_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'BOX' OR $_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'RX' OR $_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'ECO' OR $_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'TAC'){
                        echo "letraNegra";
                      }else{
                        echo "letraBlanca";
                      } ?>" 
                      value= "<?php echo $_SESSION['infoUbicacion'][$cont1]['tiempoTotal']; ?>" readonly></div>
                    </div>
                    <?php 
                    if($_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'ALTA' OR $_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'EXITUS' OR $_SESSION['infoUbicacion'][$cont1]['localizacion'] == 'ING'){
                      break 2;
                    }
                  } ?> <!-- fin del for-->

                </div>
                <?php 
                $cont++; ?>
                <div class="cuadradoLargoLista" >
                  <div  class="flecha" id="<?php echo $cont; ?>" style="display: <?php 
                    if(isset($_SESSION['infoUbicacion'][$cont1+1]['localizacion'])){ ?>
                      inline-block">
                      <?php } else { ?>
                        none"> 
                        <?php } ?>
                        <input type="text" name="hora" id="hora" class="form-control hora" value= "<?php
                        if(isset($_SESSION['infoUbicacion'][$cont1+1]['horaInicio'])){
                          echo substr($_SESSION['infoUbicacion'][$cont1+1]['horaInicio'], 0, 5);
                        }else{
                          echo substr(date("H:i"), 0, 5);     
                        } ?>"
                        readonly>
                      </div>
                    </div>

                    <?php $cont++;

                    $cont1++; }?>
                  </div>
                  <?php } 


                } ?>

              </div>
            </div>
          </div>


          <?php $contenido = ob_get_clean() ?>

          <?php include 'layout.php' ?>