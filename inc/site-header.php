<?php

add_action('tha_header_top','kasutan_header_top');
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
