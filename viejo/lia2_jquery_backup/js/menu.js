
$(document).ready(function() {
	
			//elimina animaciones
			//$.fx.off=true;
	
					   
			var hash = window.location.hash.substr(1);
			
		
			
			$(document).on("click", ':not(.linkcontent)', function(e){
				$(this).attr("target", "_blank");
			});
			
				if (hash=="") 
					{
					
					 loadContent("home.php");
					 
					}
				else{
				
					loadContent(hash);
				}
			
			
			
		
		$(document).on("click", '.linkcontent', function(e){
				
						
				e.preventDefault();
										
				//$("#update").html(last_update);
				
				//console.log("variable-->"+$("#update").text());
				var $this = $(this);
				var href = $this.attr("href");
				var pos = href.lastIndexOf(".");
				if (pos == -1){
					console.log("No soy un enlace", href);
					href = href.substr(href.lastIndexOf("#") + 1);
					scrollTo(href);
				}else{
				
					
					loadContent(href);
				}
				
				return false;
				
			}); // onclick

			
			//controlo botones navegador
		
		$(window).bind('hashchange', function(e) {
			//console.log("HASCHANGE");
			
			var url = $.param.fragment();
			
			//console.log(toLoad);
			$('a.current').removeClass('current');
			if (url) {
				
								
				//console.log($a.attr('href'));			
				
				loadContent(url);
					
			}
			
			});
			
	
		
		// fincontrolo botones navegador	

		function loadContent(toLoad/*,url*/) {
			
			$.ajax({
				url:"lastupdate.php",
				data:"file=" + toLoad,
				success:function(response){
					//actualizamos fecha automaticamente
					$("#update").html(response);	
				}
			});
					
			$('#contenedor').fadeOut('fast',function (){ $('#contenedor').load(toLoad,'', function(){
				var hash = toLoad.substr(toLoad.lastIndexOf("#") + 1);
				//console.log("Hash", hash);
				showNewContent(function(){
					scrollTo(hash);
				});
			})});
			
						
			//$('#load').remove();
			//$('#contenedor').html('<span id="load"><img src="img/ajax-loader.gif" /></span>');	
			//$('#load').fadeIn('fast');
			
			window.location.hash = toLoad;
			
		}
		
		function scrollTo(hash){
			var $target = $("[name='" + hash + "']");
			console.log("Target", $target);
			if ($target.length){
				//console.log("scrolltop", $target.offset().top);
				$(window).scrollTop($target.offset().top);
				//$(window).animate({scrollTop : 2000}, 1000);
			}
		}
		
		function showNewContent(cb) {
			var cb = cb || $.noop;
			
			$('#contenedor').fadeIn('fast', function(){
				hideLoader();
				cb();
			});
			ready();
		}
		
		function hideLoader() {
			$('#load').fadeOut('fast');
		}

});

