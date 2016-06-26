<?php ob_start();

$contAlta = 0;
$contIng = 0;
$contExitus = 0;

for($i=0; $i<count($_SESSION['estadisticasLoc']); $i++){
	if($_SESSION['estadisticasLoc'][$i] == 'ALTA'){
		$contAlta = $_SESSION['estadisticasNum'][$i];
	}elseif($_SESSION['estadisticasLoc'][$i] == 'ING'){
		$contIng = $_SESSION['estadisticasNum'][$i];
	}elseif($_SESSION['estadisticasLoc'][$i] == 'EXITUS'){
		$contExitus = $_SESSION['estadisticasNum'][$i];
	}
}

?>


<canvas id="myChart" width="920" height="400"></canvas>

<canvas id="myChart2" width="920" height="160"></canvas>

<script>

    var ctx = document.getElementById("myChart");
    var myChart = new Chart(ctx, {
        type: 'bar',
        data: {labels: [<?php for($i=0; $i<count($_SESSION['estadisticasLoc']); $i++){ if($i<count($_SESSION['estadisticasLoc'])){if($_SESSION['estadisticasLoc'][$i] != 'AD' && $_SESSION['estadisticasLoc'][$i] != 'TR' && $_SESSION['estadisticasLoc'][$i] != 'ALTA' && $_SESSION['estadisticasLoc'][$i] != 'EXITUS' && $_SESSION['estadisticasLoc'][$i] != 'ING'){echo '"'.$_SESSION['estadisticasLoc'][$i].'",';}} else{if($_SESSION['estadisticasLoc'][$i] != 'AD' && $_SESSION['estadisticasLoc'][$i] != 'TR'){echo '"'.$_SESSION['estadisticasLoc'][$i].'"';}} } ?>],
        datasets: [{
            label: 'Num pacientes',
            data: [<?php for($i=0; $i<count($_SESSION['estadisticasNum']); $i++){ if($i<count($_SESSION['estadisticasNum'])){if($_SESSION['estadisticasLoc'][$i] != 'AD' && $_SESSION['estadisticasLoc'][$i] != 'TR' && $_SESSION['estadisticasLoc'][$i] != 'ALTA' && $_SESSION['estadisticasLoc'][$i] != 'EXITUS' && $_SESSION['estadisticasLoc'][$i] != 'ING'){echo $_SESSION['estadisticasNum'][$i].',';}} else{echo $_SESSION['estadisticasNum'][$i];} } ?>],
            backgroundColor: [
            <?php for($i=0; $i<count($_SESSION['estadisticasLoc']); $i++){
              if($_SESSION['estadisticasLoc'][$i] != 'AD' && $_SESSION['estadisticasLoc'][$i] != 'TR' && $_SESSION['estadisticasLoc'][$i] != 'ALTA' && $_SESSION['estadisticasLoc'][$i] != 'EXITUS' && $_SESSION['estadisticasLoc'][$i] != 'ING'){
                  switch($_SESSION['estadisticasLoc'][$i]){
                     case 'BOX':
                     echo '\'rgba(034, 231, 255, 0.6)\'';
                     break;
                     case 'ECO':
                     echo '\'rgba(034, 231, 255, 0.6)\'';
                     break;
                     case 'RX':
                     echo '\'rgba(034, 231, 255, 0.6)\'';
                     break;
                     case 'TAC':
                     echo '\'rgba(034, 231, 255, 0.6)\'';
                     break;
                     case 'SALA A':
                     echo '\'rgba(103, 187, 255, 0.6)\'';
                     break;
                     case 'SALA B':
                     echo '\'rgba(187, 173, 060, 0.6)\'';
                     break;
                     case 'SALA TRA':
                     echo '\'rgba(204, 153, 255, 0.6)\'';
                     break;
                     case 'SALA OBS':
                     echo '\'rgba(255, 153, 000, 0.6)\'';
                     break;
                     case 'QUI':
                     echo '\'rgba(128, 000, 128, 0.6)\'';
                     break;
                 }
                 if($i<count($_SESSION['estadisticasLoc'])){
                     echo ',';
                 }
             }
         } ?>
         ],
         borderColor: [
         <?php for($i=0; $i<count($_SESSION['estadisticasLoc']); $i++){
          if($_SESSION['estadisticasLoc'][$i] != 'AD' && $_SESSION['estadisticasLoc'][$i] != 'TR' && $_SESSION['estadisticasLoc'][$i] != 'ALTA' && $_SESSION['estadisticasLoc'][$i] != 'EXITUS' && $_SESSION['estadisticasLoc'][$i] != 'ING'){
              switch($_SESSION['estadisticasLoc'][$i]){
                 case 'BOX':
                 echo '\'rgba(034, 231, 255, 0.6)\'';
                 break;
                 case 'ECO':
                 echo '\'rgba(034, 231, 255, 0.6)\'';
                 break;
                 case 'RX':
                 echo '\'rgba(034, 231, 255, 0.6)\'';
                 break;
                 case 'TAC':
                 echo '\'rgba(034, 231, 255, 0.6)\'';
                 break;
                 case 'SALA A':
                 echo '\'rgba(103, 187, 255, 0.6)\'';
                 break;
                 case 'SALA B':
                 echo '\'rgba(187, 173, 060, 0.6)\'';
                 break;
                 case 'SALA TRA':
                 echo '\'rgba(204, 153, 255, 0.6)\'';
                 break;
                 case 'SALA OBS':
                 echo '\'rgba(255, 153, 000, 0.6)\'';
                 break;
                 case 'QUI':
                 echo '\'rgba(128, 000, 128, 0.6)\'';
                 break;
             }
             if($i<count($_SESSION['estadisticasLoc'])){
                 echo ',';
             }
         }
     } ?>
     ],
     borderWidth: 1
 }]
},
options: {
   responsive: false,
   scales: {
    yAxes: [{
        ticks: {
            stepSize: 1,
            beginAtZero:true
        },
    }]
},
title: {
    display: true,
    text: 'Numero de pacientes por ubicacion',
    fontSize: 16
},
legend: {
   display: false
},
yLabel: Number,
}
});
</script>
<script>
    var ctx2 = document.getElementById("myChart2");
    var myBarChart = new Chart(ctx2, {
        type: 'horizontalBar',
        data: {
           labels: ['EXITUS', 'INGRESO', 'ALTA'],
           datasets: [{
            label: 'Pacientes ingrasados/alta/exitus',
            data: [<?php echo $contExitus; ?>, <?php echo $contIng; ?>, <?php echo $contAlta; ?>],
            backgroundColor: ['rgba(051, 051, 051, 0.6)','rgba(255, 000, 000, 0.6)', 'rgba(011, 097, 011, 0.6)'],
            borderColor: ['rgba(051, 051, 051, 0.6)','rgba(255, 000, 000, 0.6)', 'rgba(011, 097, 011, 0.6)'],
            borderWidth: 1
        }]
    },
    options: {
    	responsive: false,
        scales: {
            xAxes: [{
                ticks: {
                    stepSize: 1,
                    beginAtZero:true
                },
            }]
        },
        title: {
            display: true,
            text: 'Numero de pacientes por ubicacion',
            fontSize: 16
        },
        legend: {
        	display: false
        },
        xLabel: Number,
    }
});
</script>




<?php $contenido = ob_get_clean() ?>

<?php include 'layout.php' ?>