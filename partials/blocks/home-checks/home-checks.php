<?php 
/**
* Template pour le bloc home-checks
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
$texte=wp_kses_post( get_field('texte') );
$liens=array();
$liens[1]=get_field('bouton_1');
$liens[2]=get_field('bouton_2');

printf('<section class="acf home-checks %s">', $className);

	printf('<h2 class="titre-section">%s</h2>',$titre);
	if(have_rows('checks')) :
		echo '<ul class="checks">';
		while(have_rows('checks')) : the_row();
			$check=wp_kses_post( get_sub_field('texte') );
			printf('<li class="check">%s</li>',$check);
		endwhile;
		echo '</ul>';
	endif;

	printf('<p class="texte">%s</p>',$texte);

	echo '<div class="liens">';
		for($i=1;$i<=2;$i++) {
			$attr='';
			if($liens[$i]['target']) {
				$attr='target="_blank" rel="noreferrer noopener"';
			}
			printf('<a class="bouton secondaire" href="%s" %s>%s</a>',
				esc_url($liens[$i]['url']),
				$attr,
				wp_kses_post($liens[$i]['title'])
			);
		}
	echo '</div>';

echo '</section>';