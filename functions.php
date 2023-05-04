<?php
/**
 * kasutan functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package kasutan
 */

define( 'KASUTAN_STARTER_VERSION', filemtime( get_template_directory() . '/style.css' ) );


// General cleanup
include_once( get_template_directory() . '/inc/wordpress-cleanup.php' );

// Theme
include_once( get_template_directory() . '/inc/tha-theme-hooks.php' );
include_once( get_template_directory() . '/inc/helper-functions.php' );
include_once( get_template_directory() . '/inc/navigation.php' );
include_once( get_template_directory() . '/inc/loop.php' );
include_once( get_template_directory() . '/inc/template-tags.php' );
include_once( get_template_directory() . '/inc/site-header.php' );
include_once( get_template_directory() . '/inc/site-footer.php' );

// Editor
include_once( get_template_directory() . '/inc/disable-editor.php' );
include_once( get_template_directory() . '/inc/tinymce.php' );

// Functionality
include_once( get_template_directory() . '/inc/login-logo.php' );


// Plugin Support
include_once( get_template_directory() . '/inc/acf.php' );

if ( ! function_exists( 'kasutan_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function kasutan_setup() {
		
		// Body open hook
		add_theme_support( 'body-open' );
		
		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails', array('post','page','jobs'));

		register_nav_menus( array(
			'primary' => 'Menu principal en-tête',
			'footer-liens' => 'Liens du pied de page (en plus des réseaux sociaux)',
		) );


		//Affichage classique des widgets
		remove_theme_support( 'widgets-block-editor' );

		//Autoriser les shortcodes dans les widgets
		add_filter( 'widget_text', 'shortcode_unautop' );
		add_filter( 'widget_text', 'do_shortcode' );


		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			//'comment-form',
			//'comment-list',
			'gallery',
			'caption',
		) );


		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 40,
			'width'       => 149,
			'flex-width'  => true,
			'flex-height' => true,
		) );

		// Gutenberg

		// -- Responsive embeds
		add_theme_support( 'responsive-embeds' );

		// -- Wide Images
		add_theme_support( 'align-wide' );

		// -- Disable custom font sizes
		add_theme_support( 'disable-custom-font-sizes' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'editor-styles.css' );

	}
endif;
add_action( 'after_setup_theme', 'kasutan_setup' );

//https://stackoverflow.com/questions/69800090/deregister-admin-editor-reset-styles-with-the-handle-of-wp-reset-editor-styles
add_action( 'enqueue_block_editor_assets', 'kasutan_enqueue_block_editor_assets', 102);
function kasutan_enqueue_block_editor_assets () {
	wp_deregister_style('wp-reset-editor-styles');
	wp_register_style( 'wp-reset-editor-styles', get_stylesheet_directory_uri() . '/editor-styles.css', false, '1.0', 'all' );
}

/**
 * Enqueue scripts and styles.
 */
function kasutan_scripts() {
	
	wp_enqueue_style( 'eflex-style', get_stylesheet_uri(),array(), filemtime( get_template_directory() . '/style.css' ) );
	

	// Move jQuery to footer
	if( ! is_admin() ) {
		wp_deregister_script( 'jquery' );
		wp_register_script( 'jquery', includes_url( '/js/jquery/jquery.js' ), false, NULL, true );
		wp_enqueue_script( 'jquery' );
	}

	wp_enqueue_script( 'eflex-navigation', get_template_directory_uri() . '/js/min/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'eflex-skip-link-focus-fix', get_template_directory_uri() . '/js/min/skip-link-focus-fix.js', array(), '20151215', true );



	wp_enqueue_script( 'eflex-scripts', get_template_directory_uri() . '/js/min/main.js', array('jquery'), '', true );

}
add_action( 'wp_enqueue_scripts', 'kasutan_scripts' );


/**
* Image sizes. 
* https://developer.wordpress.org/reference/functions/add_image_size/
*/
/*Autres tailles réglées en bo : 
• small défaut
• medium 375 x 255 pour les logos
• medium_large défaut
• large défut


*/
add_image_size('banniere',1800,0,false);



/**
 * Afficher tous les résultats sans pagination sur page résultats de recherche et sur l'archive principale du blog
 */
function kasutan_remove_pagination( $query ) {
	if ( $query->is_main_query() && (is_home() || get_query_var( 's', 0 ) ) ) {
		$query->query_vars['nopaging'] = 1;
		$query->query_vars['posts_per_page'] = -1;
	}
}
add_action( 'pre_get_posts', 'kasutan_remove_pagination' );


/**
* Template Hierarchy
*
*/
function ea_template_hierarchy( $template ) {

	if( is_home() || is_search() )
		$template = get_query_template( 'archive' );
	return $template;
}
add_filter( 'template_include', 'ea_template_hierarchy' );