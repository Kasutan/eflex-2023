<?php 
/**
* Template pour le bloc home-temoignages
*
* @param   array $block The block settings and attributes.
* @param   string $content The block inner HTML (empty).
* @param   bool $is_preview True during AJAX preview.
* @param   (int|string) $post_id The post ID this block is saved to.
*/


if(array_key_exists('className',$block)) {
	$className=esc_attr($block["className"]);
} else $className='';


$titre_section=wp_kses_post( get_field('titre_section') );
if(function_exists('kasutan_espaces_inseccables')) {
	$titre_section=kasutan_espaces_inseccables($titre_section);
}

printf('<section class="acf home-temoignages %s">', $className);

	printf('<h2 class="titre-section">%s</h2>',$titre_section);
	if(have_rows('lignes')) :
		echo '<ul class="lignes">';
		while(have_rows('lignes')) : the_row();
			echo '<li class="ligne">';
				$titre=wp_kses_post( get_sub_field('titre') );
				$texte=wp_kses_post( get_sub_field('texte') );
				printf('<p><span class="titre">%s</span> <span class="texte">%s</span></p>',$titre,$texte);
				echo '<div class="quotes">';
					for($i=1;$i<=2;$i++) :
						$quote=wp_kses_post( get_sub_field('quote_'.$i) );
						$client=wp_kses_post( get_sub_field('client_'.$i) );
						if($quote && $client) :
							printf('<blockquote>«&nbsp;%s.&nbsp;»</blockquote>',$quote);
							printf('<p class="client">%s</p>',$client);
						endif;
					endfor;
				echo '</div>';

			echo '</li>';
		endwhile;
		echo '</ul>';
	endif;


echo '</section>';
	