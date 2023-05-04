(function($) {

	$( document ).ready(function() {
		var width=$(window).width();

		
		


		//Supprimer les attributs aria-describedby qui pointent vers des éléments inexistants
		var inputsAvecAria=$('[aria-describedby]');
		if(inputsAvecAria.length > 0) {
			$(inputsAvecAria).each(function() {
				var cible=$(this).attr('aria-describedby');
				if($('#'+cible).length === 0) {
					$(this).removeAttr('aria-describedby');
				}
			});
		}

		//Corriger la valeur de l'attribut for du label select
		var labelToFix=$('label[for*="select"]');
		console.log(labelToFix);
		if(labelToFix.length > 0) {
			$(labelToFix).each(function() {
				var f=$(this).attr("for");
				console.log('f',f);
				f=f.replace('-label','');
				console.log('f',f);

				$(this).attr('for',f);

			})
		}

	}); //fin document ready
})( jQuery );
