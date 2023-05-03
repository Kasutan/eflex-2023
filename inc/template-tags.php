<?php
/**
 * Template Tags
 *
 * @package      EAStarter
 * @author       Bill Erickson
 * @since        1.0.0
 * @license      GPL-2.0+
**/



/**
 * Entry Category
 *
 */
function ea_entry_category($contexte='archive') {
	$post_type=get_post_type();
	$term=false;
	if($post_type==='post') {
		$term = ea_first_term();
	}
	if( !empty( $term ) && ! is_wp_error( $term ) )
		if($contexte==='archive') {
			
			//pour le filtre
			printf('<span class="categorie screen-reader-text">%s</span>',$term->slug);
		} else {
			//contexte single
			
				$name=$term->name;
			
			echo '<p class="entry-category h1 entry-title">' . $name . '</p>';
		}
		
}



/**
 * Post Summary Title
 *
 */
function ea_post_summary_title() {
	global $wp_query;
	$tag = ( is_singular() || -1 === $wp_query->current_post ) ? 'h3' : 'h2';
	echo '<' . $tag . ' class="post-summary__title"><a href="' . get_permalink() . '">' . get_the_title() . '</a></' . $tag . '>';
}

/**
 * Post Summary Image
 *
 */
function ea_post_summary_image( $size = 'thumbnail' ) {
	/*On cherche une image à afficher*/ 
	$image_id=get_theme_mod( 'custom_logo' ); //défaut : le logo du site
	$classe='contain';
	if(has_post_thumbnail()) {
		$image_id=get_post_thumbnail_id();
		$classe='';
	} else if(function_exists('get_field')) {
		$banniere=get_field('eflex_page_banniere');
		if($banniere) {
			$image_id=$banniere;
			$classe='';
		} else {
			$logo_footer=get_field('eflex_logo_footer','option');
			if($logo_footer) {
				$image_id=$logo_footer;
				$classe='contain has-bleu-background-color';
			}
		}
	}

	printf('<a class="post-summary__image %s" href="%s" tabindex="-1" aria-hidden="true" >%s</a>',
		$classe,
		get_permalink(),
		wp_get_attachment_image( $image_id, $size )
	);
}


/**
* Banniere contenant une image, le titre de la page et un lien retour vers la home
*
*/
function kasutan_page_banniere() {

	if( is_home() ) {
		$titre = get_the_title( get_option( 'page_for_posts' ) );

	} elseif( is_search() ) {
		$titre = 'Résultats de recherche';

	} elseif( is_archive() ) {
		$titre = get_the_archive_title();
	} else {
		//Single
		$titre=get_the_title();

	}

	if(is_front_page(  )) {
		printf('<h1 class="screen-reader-text">%s</h1>',$titre);
		return;
	}

	if(!function_exists('get_field')) {
		echo '<a href="/" class="retour"><span aria-hidden="true">&lt;</span> Retour</a>';
		printf('<h1>%s</h1>',$titre);
		return;
	}


	$image_id=esc_attr(get_field('banniere'));
	$opacity=intval(esc_attr(get_field('banniere_opacite')));
	if(!$opacity) {
		$opacity='60'; //defaut
	}
	$opacity=$opacity / 100;
	$style_filtre=sprintf('style="opacity:%s"',$opacity);
	

	if(!$image_id) {
		$image_id=esc_attr(get_field('eflex_bg_image','option'));//image par défaut
	}

	if(!empty($image_id)) {
		printf('<div class="page-banniere">');
			echo wp_get_attachment_image( $image_id, 'banniere',false,array('decoding'=>'async','loading'=>'eager'));

			//Filtre dont l'opacité vient d'une option de la publication
			printf('<div class="filtre" %s></div>',$style_filtre);

			echo '<a href="/" class="retour"><span aria-hidden="true">&lt;</span> Retour</a>';

			printf('<h1 class="titre-banniere">%s</h1>',$titre);

		echo '</div>';
	} else {
		echo '<a href="/" class="retour"><span aria-hidden="true">&lt;</span> Retour</a>';
		printf('<h1>%s</h1>',$titre);
	}
}

/**
* Image banniere pour les posts singles
*
*/
function kasutan_single_banniere() {

	if(!function_exists('get_field')) {
		return;
	}

	$image_id=esc_attr(get_field('banniere'));

	if(!$image_id) {
		$image_id=esc_attr(get_field('eflex_bg_image','option'));//image par défaut
	}

	//Texte dans la banniere = nom de la page archive
	$titre_banniere="Blog";

	if(!empty($image_id)) {
		printf('<div class="page-banniere">');
			echo wp_get_attachment_image( $image_id, 'banniere',false,array('decoding'=>'async','loading'=>'eager'));


			printf('<span class="titre-banniere h1">%s</span>',$titre_banniere);

		echo '</div>';
	} 
	
}

