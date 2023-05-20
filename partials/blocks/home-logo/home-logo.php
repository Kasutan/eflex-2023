<?php 
/**
* Template pour le bloc home-logo
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$logo=esc_attr( get_field('logo') );
$image=esc_attr( get_field('image') );
$titre=wp_kses_post( get_field('titre') );
$texte=wp_kses_post( get_field('texte') );

printf('<section class="acf home-logo %s">', $className);
	printf('<div class="image">%s</div>',wp_get_attachment_image( $image, 'banniere',false,array('decoding'=>'async','loading'=>'eager')));
	printf('<h1 class="screen-reader-text">%s</h1>',$titre);
	printf('<div class="logo">%s</div>',wp_get_attachment_image( $logo, 'medium'));
	echo '<div class="trait"></div>';
	printf('<div class="texte">%s</div>',$texte);
echo '</section>';