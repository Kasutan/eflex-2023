<?php 
/**
* Template pour le bloc home-refs
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$titre=wp_kses_post( get_field('titre') );
$galerie=get_field('galerie');

if(!empty($galerie)) :
	printf('<section class="acf home-refs %s">', $className);

		printf('<h2 class="titre-section">%s</h2>',$titre);
		echo '<ul class="logos">';
		foreach($galerie as $image) {
			printf('<li class="image">%s</li>',wp_get_attachment_image( $image, 'medium'));
		}
		echo '</ul>';

	echo '</section>';
endif;