<?php


/**
 * Liens
 *
 */
add_action( 'tha_footer_top', 'kasutan_main_footer' );
function kasutan_main_footer() {
	
		$copyright="";
		if(function_exists('get_field')) {
			$copyright=wp_kses_post(get_field('eflex_copyright','option'));
			$copyright2=wp_kses_post(get_field('eflex_copyright_2','option'));
		}
		if($copyright) printf('<p>%s</p>',$copyright);
		if($copyright2) printf('<span class="copy">%s</span>',$copyright2);
		//Liens
		if( has_nav_menu( 'footer-liens')) {
				
				
				if( has_nav_menu( 'footer-liens') ) {
					wp_nav_menu( array( 'theme_location' => 'footer-liens', 'menu_id' => 'footer-liens', 'container_class' => 'nav-footer' ) );
				}
		}

}
