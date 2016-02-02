function ready(){
	/* The following code is executed once the DOM is loaded */

console.log("Ready");
	

		if ($('html').hasClass('csstransforms3d')) {	
		
			$('.thumb').removeClass('scroll').addClass('flip');		
			$('.thumb.flip').hover(
				function () {
					$(this).find('.thumb-wrapper').addClass('flipIt');
				},
				function () {
					$(this).find('.thumb-wrapper').removeClass('flipIt');			
				}
			);
			
			/*$(document).on("hover", ".thumb.flip", function(){
				$(this).find('.thumb-wrapper').addClass('flipIt');
			});
			
			$(document).on("mouseleave", ".thumb.flip", function(){
				$(this).find('.thumb-wrapper').removeClass('flipIt');
			});*/
		}
}

$(document).ready(ready);