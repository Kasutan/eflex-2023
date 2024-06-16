<?php

add_action('tha_header_top','kasutan_header_top',10);
function kasutan_header_top() {
	echo '<div class="header-container">';

		printf('<div class="logo-header"><a href="%s" class="logo-link" title="Accueil">
		%s</a></div>',
			apply_filters( 'wpml_home_url', get_option( 'home' ) ),
			kasutan_picto(array("icon"=>"Logo-Eleneo-RVB","size"=>false))
		);


		if( has_nav_menu( 'primary' ) ) {
			echo '<nav id="site-navigation" class="nav-main" aria-label="menu principal">';

			wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu', 'container_class' => 'nav-primary' ) );

			echo '</nav>';
		}

		do_action('wpml_add_language_selector');

	echo '</div>';
}


/**
* Afficher le volet avec les CTA Calendly dans l'en-tête
*/
add_action('tha_header_top','kasutan_affiche_volet_cta',5);
function kasutan_affiche_volet_cta() {
	if(!function_exists('get_field') ) {
		return;
	}
	$cta_img_1=esc_attr(get_field('eflex_cta_image_1','option'));
	$cta_img_2=esc_attr(get_field('eflex_cta_image_2','option'));
	$cta_link_1=esc_url(get_field('eflex_cta_link_1','option'));
	$cta_link_2=esc_url(get_field('eflex_cta_link_2','option'));
	$cta_titre=wp_kses_post(get_field('eflex_cta_titre','option'));
	$cta_texte=wp_kses_post(get_field('eflex_cta_texte','option'));

	echo '<div class="volet-cta" id="volet-cta">';

		echo '<div class="cadre">';
			if($cta_titre) printf('<h2 class="titre-cta">%s</h2>',$cta_titre);

			echo '<div class="cols-cta">';
				if($cta_img_1 && $cta_link_1) {
					printf('<a href="%s" class="link-cta" target="_blank" rel="noopener noreferrer">%s</a>',
						$cta_link_1,
						wp_get_attachment_image($cta_img_1, 'full', false, array("Alt"=>"Open link 1"))
					);
				}
				if($cta_img_2 && $cta_link_2) {
					printf('<a href="%s" class="link-cta" target="_blank" rel="noopener noreferrer">%s</a>',
						$cta_link_2,
						wp_get_attachment_image($cta_img_2, 'full', false, array("Alt"=>"Open link 1"))
					);
				}
			echo '</div>';
			if($cta_texte) printf('<p class="texte-cta">%s</p>',$cta_texte);

			echo '<button id="fermer-cta" class="fermer"><span class="screen-reader-text">Close panel</span>
				<svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
			</button>';
		echo '</div>';

		
	echo '</div>';
}