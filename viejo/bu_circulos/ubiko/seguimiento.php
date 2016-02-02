<!DOCTYPE html>

<head>

	<title>Ubiko - Seguimiento</title>
	
	<link rel="shortcut icon" href="ubiko.ico" >
	<link href="css/css_seguimiento.css" rel="stylesheet" type="text/css"  />
	
</head>

<body >
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
				<div id="pass"><input type="password" size="18" /></div>
			</div>
		</div>
		
		<!--menu-->
		<nav id=navegacion>
				<ul>
					<li><a href="admision.php" class="enlace_admision_h linkcontent">Admisi&oacute;n</a></li>       
					<li><a href="seguimiento.php" class="seguimiento_h  linkcontent">Seguimiento</a></li>       
					<li><a href="box.php" class="box_h  linkcontent">BOX</a></li>      
					<li><a href="estadisticas.php" class="estadistcicas_h  linkcontent">Estad&iacute;sticas</a></li>     
				</ul>
		</nav>
	
	
	
	</header>
	
	<div id=contenedor> <!-- contenedor principal -->
    	<div  id=cambio> 
		     
			         <div  class="izquierda1" id=cambio2> 
					        <div  id=control_paciente>
						     
						          <div class="izquierda2">
								  <a href="" class="linkcontent">
								  <div class="izquierda3">
						                     <div class="izquierda3" id=num>22</div>
						                     <div class="izquierda3" id=nombre>Maria del Pilar Garcia del Monte</div>
											 <div class="izquierda3" id=num1>1286</div>
								      </div>
									  </a>
								  </div>
			   
			                 
			                </div>
					     <div  class="izquierda4" id=cambio4>
						<!-- <?php
								$lista = array(
                                    "1" => "libre",
									"2" => "ocupada",
									"3" => "libre",
									"4" => "ocupada",
									"5" => "pulsada",
									"6" => "libre",
									"7" => "libre",
									"8" => "ocupada",
									"9" => "libre",
									"10" => "ocupada",
									"11" => "pulsada",
									"12" => "libre",
									"13" => "libre",
									"14" => "ocupada",
									"15" => "libre",
									"16" => "ocupada",
									"17" => "pulsada",
									"18" => "libre",
									
									);
									
									

								
								?> -->
								
							<ul>
								<?
								foreach ($lista as $key => $subArray) { 
            echo '<li>' . $key . makeList($subArray) . '</li>'; 
        } 
        ?>
         
								<li <?php if  ?>id=libre ><div class="text_circ">1</div></li>     
								
							</ul>
							
							</ul>
				
					         <div  id=linea>	
					         </div>
							 <ul>
								<li id=libre ><div class="text_circ_l">V</div></li>     
								<li id=ocupada><div class="text_circ_l">A</div></li>      
								<li id=libre><div class="text_circ_l">B</div></li>      
								<li id=ocupada><div class="text_circ_l">C</div></li>  
								<li id=pulsada><div class="text_circ_l">Q</div></li>
								<li id=libre><div class="text_circ_l">Y</div></li>
							</ul>
						 
			             </div> 
					 </div>
				     <div class="izquierda1" id=cambio3>
                         <div class="cont_menu der">
        	                <div class="circulo_menu b">
        		               <div class="text_menu n">ECO</div>
                         </div>
                         <div class="circulo_menu b">
        		               <div class="text_menu n">RX</div>
                         </div>
                        <div class="circulo_menu salab b">
        		               <div class="text_menu_doble b">SALA</div>
                               <div class="text_menu_doble b">B</div>
                        </div>
                        <div class="circulo_menu salao b">
        		               <div class="text_menu_doble b">SALA</div>
                               <div class="text_menu_doble b">OBS</div>
                        </div>
                               <div class="circulo_menu ing b">
        		               <div class="text_menu b">ING</div>
                         </div>
                      </div>
			   
			        
                    <div class="cont_menu izq">
        	            <div class="circulo_menu b">
        		               <div class="text_menu n">BOX</div>
                        </div>
                        <div class="circulo_menu b">
        		               <div class="text_menu n">TAC</div>
                        </div>
                       <div class="circulo_menu salaa b">
        		               <div class="text_menu_doble b">SALA</div>
                              <div class="text_menu_doble b">A</div>
                       </div>
                       <div class="circulo_menu salat b">
        		             <div class="text_menu_doble b">SALA</div>
                             <div class="text_menu_doble b">TRA</div>
                       </div>
                       <div class="circulo_menu qui b">
        		             <div class="text_menu b">QUI</div>
                      </div>
                      <div class="circulo_menu exit b">
        		           <div class="text_menu b">EXITUS</div>
                      </div>
                    </div>					
					
				 </div>	
			
		  </div>
		</div>
<!--	<div class="cont">
		<ul>
			<li id="libre">
			<li id="libre">
			<li id="ocupado"> -->
	
</body>
</html>