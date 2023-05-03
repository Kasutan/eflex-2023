<?php


/**
 * Liens
 *
 */
add_action( 'tha_footer_top', 'kasutan_main_footer' );
function kasutan_main_footer() {
	

	//TODO : ajouter tous droits réservés
		//Liens
		if( has_nav_menu( 'footer-liens')) {
			echo '<div class="liens">';
				
				
				if( has_nav_menu( 'footer-liens') ) {
					wp_nav_menu( array( 'theme_location' => 'footer-liens', 'menu_id' => 'footer-liens', 'container_class' => 'nav-footer' ) );
				}
			echo '</div>';
		}

	echo '</div>';
}
