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
