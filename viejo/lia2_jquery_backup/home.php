 <!-- SECCIÓN PRESENTACIÓN -->
         <script>
  			var last_update = "May 10, 2013";
  		</script>

  <section>
		<!--<div class="articulo"><span class="destaca">The research group LIA (Laboratory of Applied Computer Science)</span> was founded by Arno Formella and Eva Cernadas in the year 2000 shortly after their arrival at the Computer Science Department of the University of Vigo.
        </div>-->
        
        <div class="dos_columnas izq">
        	<h2>Research Areas</h2>
            <ul class="lista">
                <li><a href="researchareas/ra_simulation.php" class="linkcontent">Simulation, Optimization, and Approximation</a> <span class="silver">[6]</span></li>
                <li><a href="researchareas/ra_imagen.php" class="linkcontent">Image Processing</a> <span class="silver">[8]</span></li>
                <li><a href="researchareas/ra_computer.php" class="linkcontent">Computer Graphics</a> <span class="silver">[2]</span></li>
                <li>Software Engineering based on Agents</li>
                <li>Software Engineering in Multi-media</li>
                <li>Intelligent Software Systems</li>
            </ul>
        </div>
        
        <div class="dos_columnas der">
        	<h2>Interesting Links</h2>
            <ul class="lista">
                <li><a href="http://www.uvigo.es/" target="_blank">Universidad de Vigo</a></li>
                <li><a href="http://www.esei.uvigo.es/" target="_blank">Escuela Superior de Ingeniería Informática</a></li>
                <li><a href="http://www.di.uvigo.es/" target="_blank">Computer Science Department</a></li>
                <li><a href="http://bioinfo.cesga.es/" target="_blank">Galicia Bioinformatics Network</a></li>
                <li><a href="http://www.citi.uvigo.es/" target="_blank">Centro de Investigación, Transferencia e Innovación</a></li>
                <li><a href="http://www.vindeira.org/" target="_blank">Plataforma Tecnológica de las Tic en Galicia</a></li>
            </ul>
        </div>
        
  </section>
  <!-- FIN SECCIÓN PRESENTACIÓN -->
  
  
  
  <!-- SECCIÓN RUNNING PROJECTS -->
  <h1>RUNNING PROJECTS</h1>
   <div class="line blue" ></div>
   
  <section class="project">
  	<article class="columna izq boxl">
    	
        <div class="box">
           <div style="overflow:hidden;"> 
                <div class="izq">
                    <img src="imagenes/HumSAT.png" alt="logotipo HumSat">
                </div>
                <div class="der boxt">
                    <h2 class="destaca">HumSAT</h2>
                    <p class="small">
                    Within the HumSAT project we build a pico-satellite according to the cubesat standard following the ECSS (European Cooperation for Space Standardization) recommendations.
                    </p> 
                </div>
			</div>
           <p class="der space"><a href="projects/humsat/index.html" class="linkcontent">MORE </a></p>
	    </div>
        
    </article>
    <article class="columna izq boxl">
    
	    <div class="box">
           <div style="overflow:hidden;"> 
                <div class="izq">
                    <img src="imagenes/Nacce.png" alt="logotipo Nacce">
                </div>
                <div class="der boxt">
                    <h2 class="destaca"><a href="http://www.nacce.es/" target="_blank">Nacce</a></h2>
                    <p class="small">
                    El proyecto NACCE, es una iniciativa  innovadora que pretende revolucionar el sector TIC en la región transfronteriza de Galicia – Norte de Portugal.
                    </p> 
                </div>
			</div>
           <p class="der space"></p>
	    </div>
        
    </article>
    <article class="columna izq boxl">
    
 	   <div class="box">
           <div style="overflow:hidden;"> 
                <div class="izq">
                    <img src="imagenes/Shaprox.png" alt="logotipo Sahprox" >
                </div>
                <div class="der boxt">
                    <h2 class="destaca">Shaprox</h2>
                    <p class="small">
                   The objective of this investigation is to design a system that approximates a set of two-dimensional points with one or several geometric shapes with certain restrictions and possibly additional domain specific knowledge.
                    </p> 
                </div>
			</div>
           <p class="der space"><a href="projects/shaprox/index.html"  class="linkcontent">MORE </a></p>
	    </div>
    
    </article>
    <article class="columna der boxr">
    
    	<div class="box">
           <div style="overflow:hidden;"> 
                <div class="izq">
                    <img src="imagenes/Particle.png" alt="logotipo HumSat">
                </div>
                <div class="der boxt">
                    <h2 class="destaca">Particle Simulation</h2>
                    <p class="small">
                    We are implementing a state-of-the-art simulator which handles carefully many of the difficulties one has to deal with to achieve an efficient and robust implementation. 
                    </p> 
                </div>
			</div>
           <p class="der space"><a href="projects/particles/index.html"  class="linkcontent">MORE </a></p>
	    </div>
    
    </article>
  
  
  
  </section>
  <!-- FIN SECCIÓN RUNNING PROJECTS -->
 
 <!-- SECCIÓN PARTNERS -->
  <h1>PARTNERS</h1>
   <div class="line blue2" ></div>
  
  <section id="partners">
  
  <?php

// Each sponsor is an element of the $sponsors array:

$sponsors = array(
	array('ctc','Centro Tecnolóxico da Carne','www.ceteca.net'),
	array('gradiant','Gradiant.','www.gradiant.org'),
	array('lomg','Laboratorio Oficial de Metrología de Galicia','www.lomg.es'),
	array('charite','Charité-Universitätsmedizin','www.charite.de'),
	array('trabeculae','Trabeculae S.L.','www.trabeculae.es'),
	array('inta','Instituto Nacional de Técnica Aeroespacial','www.inta.es'),
	array('thales','Thales ATM GmbH','www.thalesgroup.com'),
	array('eam','Engineering of Advanced Materials','www.eam.uni-erlangen.de'),
	array('mobileconnect','Mobile connect GmbH','www.mobile-connect.de'),
	array('firmist','Firmist Animación','www.firmist.com'),
	array('imaxdi','Imaxdi Real Innovation','www.imaxdi.com'),
	array('cima','Centro de Ingeniería Mecánica','www.cima.uvigo.es'),
	array('iim','Instituto de Investigaciones Marinas de Vigo','www.iim.csic.es'),
	array('gti','Grupo de Tecnologías de la Información','enigma.det.uvigo.es/webgti'),
	array('dma','Grupo de Optimización, Control y Modelado Numérico','www.dma.uvigo.es'),
	array('ssr','Grupo de Radiocomunicacion','www.ssr.upm.es'),
	array('gpi','Grupo de Procesado de Imagen y Realidad Virtual','webs.uvigo.es/gpi-rv'),
	array('edisa','EDISA','www.edisa.com'),

);


// Randomizing the order of sponsors:
 shuffle($sponsors);

?>

  
  
  <div class="sponsorListHolder">
		
        
				 <?php
	
		
	  // Looping through the array:
 foreach($sponsors as $company)
			{
				echo'               
				  <div class="thumb scroll">
					<div class="thumb-wrapper">
						<img src="imagenes/partners/'.$company[0].'.png" alt="More about '.$company[0].'" />
						<div class="thumb-detail">
							<div class="sponsorDescription">
										'.$company[1].'
									</div>
									<div class="sponsorURL">
										<a href="http://'.$company[2].'" target="_blank">'.$company[2].'</a>
									</div>			
						</div>
					</div>
				</div>
					';
					}
		
		?>			
				
	
        
        
    	<div class="clear"></div>
    </div>
  	
  </section>
  <!-- FIN SECCIÓN PARTNERS -->
  
  <!-- SECTION RESEARCH GROUPS -->
    <section id="research_groups" class="no_padding">
    
   <h2>RESEARCH GROUPS OF THE COMPUTER SCIENCE DEPARTEMENT</h2>
   <!--<div class="line blue3" ></div>-->
  

   <?php

// Each sponsor is an element of the $sponsors array:

$sponsors = array(
	
	array('sing','Grupo de Sistemas Informáticos de Nueva Generación','sing.ei.uvigo.es'),
	array('mile','bioMedical Informatics and signaL procEssing','www.milegroup.net'),
	array('cole','Compilers and Languages','www.grupocole.org'),
	
);


// Randomizing the order of sponsors:
 shuffle($sponsors);

?>

  
  
  <div class="sponsorListHolder" >
		
        
				 <?php
	
		
	  // Looping through the array:
 foreach($sponsors as $company)
			{
				echo'               
				  <div class="thumb scroll">
					<div class="thumb-wrapper">
						<img src="imagenes/partners/'.$company[0].'.png" alt="More about '.$company[0].'" />
						<div class="thumb-detail">
							<div class="sponsorDescription">
										'.$company[1].'
									</div>
									<div class="sponsorURL">
										<a href="http://'.$company[2].'" target="_blank">'.$company[2].'</a>
									</div>			
						</div>
					</div>
				</div>
					';
					}
		
		?>			
				
	
        
        
    	<div class="clear"></div>
  
  
  
  </section>
  
  <!-- FIN RESEARCH GROUPS -->