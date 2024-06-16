/*=================================================
Animations
=================================================*/
//Only Use the IntersectionObserver if it is supported

if ('IntersectionObserver' in window) {
	const config = {
		//rootMargin: '0 0 -300px 0',
		threshold: [0, 0.25, 0.3, 0.4, 1]
		};

	const logoHeader = jQuery('.logo-header');
	const homeLogoBlock=document.querySelectorAll('.home-logo .logo');
	
		
	observer = new IntersectionObserver((entries) => {
		entries.forEach(entry => {
			if (entry.intersectionRatio > 0) {
				jQuery(logoHeader).removeClass('fade-in');
			} else {
				jQuery(logoHeader).addClass('fade-in');
			}
		}, config);
	});
	homeLogoBlock.forEach(item => {
		observer.observe(item);
	});

} else {
	//if Intersection Observer is not supported, add classes right away
	jQuery('.home-logo').addClass('fade-in'); 
}

/*=================================================
Fonctions jQuery
=================================================*/
(function($) {

	$( document ).ready(function() {
		/*********Afficher/masquer le volet avec les ctas **********/
		var voletCTA=$('#volet-cta');
		if($(voletCTA).length>0) {
			var boutonCTA=$(".book-demo a");
			//Le volet est fermé au chargement de la page
			$(boutonCTA).attr('aria-expanded','false');

			//Au clic sur un bouton
			$(boutonCTA).click(function(){
				if($(boutonCTA).attr('aria-expanded')=="false") {
					$(voletCTA).fadeIn('slow');
					$(voletCTA).css('display','flex');
					$(boutonCTA).attr('aria-expanded','true');
					$(this).addClass('last-focus');
					$('#volet-cta a:first-of-type()').focus();
					
				} else {
					$(voletCTA).fadeOut('slow');
					$(boutonCTA).attr('aria-expanded','false');
				}

			});
			$('#fermer-cta').click(function(){
				$(voletCTA).fadeOut('slow');
				$(boutonCTA).attr('aria-expanded','false');
				//Remettre le focus au bouton qu'on avait cliqué pour ouvrir le volet
				$('.last-focus').focus();
				$('.last-focus').removeClass('last-focus');
			});
		}
	}); //fin document ready
})( jQuery );