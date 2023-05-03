<?php
/**
 * Single Post
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/


// Image bannière 
add_action( 'tha_entry_top', 'kasutan_single_banniere', 5 );


//Elements dans le header, sous la bannière
add_action( 'tha_entry_top', 'kasutan_single_top',10 );

function kasutan_single_top() {
	echo '<div class="single-top-wrap">';
		printf('<h1 class="single-title">%s</h1>',get_the_title());
	echo '</div>';
}




// Build the page
require get_template_directory() . '/index.php';
