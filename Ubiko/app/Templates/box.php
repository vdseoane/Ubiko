    
<?php ob_start(); 
$cont = 0;
?>

<div class="inferiorBox">
  <div id= "inf">
    <input type="text" name="nombrePaciente" id="nombrePaciente" class="form-control" value="<?php echo $_SESSION['nombrePaciente']." ".$_SESSION['apellidosPaciente'];; ?>" readonly>
    <input type="text" name="nhcPaciente" id="nhcPaciente" class="form-control" value= "<?php echo $_SESSION['nhcPaciente'] ?>" readonly>
  </div>
  <img src ="img/infoPaciente2.png">
</div>
<div class ="infoCamas">
  <div class="cuadradoBox">
    <div class="c"><img type="image" value="" src ="img/camaNegra.png"></div>
    <input type="text" name="camaOcupada" id="leyenda" class="form-control" value="Cama Ocupada" readonly>
  </div>
  <div class="separacionCama"></div>
  <div class="cuadradoBox">
   <div class="c"><img type="image" value="" src ="img/camaAzul.png"></div>
   <input type="text" name="camaPaciente" id="leyenda" class="form-control" value="Paciente" readonly>
  </div>
 <div class="separacionCama"></div>
 <div class="cuadradoBox">
   <div class="c"><img type="image" value="" src ="img/camaGris.png"></div>
   <input type="text" name="camaLibre" id="leyenda" class="form-control" value="Cama Libre" readonly>
</div>
</div>
<div class="infiniteCarouselBox">
  <div id="botonesScroll" class="next"><img src="img/flechaArriba.png" alt="cancelar" /></div>
  <div id="botonesScroll" class="pre"><img src="img/flechaAbajo.png" alt="cancelar" /></div>     
  <div class="viewportBox">
    <div class="listBox">
      <?php for($i=0; $i<count($_SESSION['infoCamas'])/5; $i++){?>
        <div class="FilaCarouselBox">
          <?php for($j=0; $j<5; $j++){?>
            <div class="cuadradoBox">
              <div class="c">
                <input type="text" name="" id="infoBoxPaciente" class="form-control" value= "" readonly>
                <?php if(isset($_SESSION['infoCamas'][$cont]['paciente'])){ 
                  if($_SESSION['infoCamas'][$cont]['paciente'] === $_SESSION['nhcPaciente']){ ?> 
                    <img type="image" value="" src ="img/camaAzul.png">
                    <?php } else{ ?>
                      <img type="image" value="" src ="img/camaNegra.png">
                      <?php }
                    } else{ ?>
                      <img type="image" value="" src ="img/camaGris.png">
                      <?php } ?>
                      <input type="text" name="" id="infoBoxCama" class="form-control" value= "<?php
                      if(isset($_SESSION['infoCamas'][$cont]['numeroCama'])){
                        echo $_SESSION['infoCamas'][$cont]['localizacion'].'  '.$_SESSION['infoCamas'][$cont]['numeroCama'];
                      }else{
                        echo 'Cama';
                      }
                      ?>" 
                      readonly>
                      <?php $cont++; ?>
                    </div>
                  </div>
                  <?php if($j<5){ ?>
                    <div class="separacion"></div>
                    <?php  } ?>
                    <?php } ?>
                  </div>
                  <?php } ?>
                </div>
              </div>
            </div>

            <?php $contenido = ob_get_clean() ?>

            <?php include 'layout.php' ?>