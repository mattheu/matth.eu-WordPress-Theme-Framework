<?php

/**
 *	More Functions & Plugins.
 */
get_template_part( 'updates/updates', 'core' );

get_template_part( 'functions/functions-comments' );
get_template_part( 'functions/functions-image_caption' );
get_template_part( 'functions/functions-thumbnail_link' );

get_template_part( 'plugins/grid/grid' );


/**
 *	Setup
 *
 *  @return null
 */
function mtf_setup() {

	register_nav_menus(
		array(
		  'mtf_menu_main' => 'Main Menu',
		  'mtf_menu_foot' => 'Footer Menu'
		)
	);

	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'mtf_secondary' ),
		'id' => 'mtf_secondary',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h1 class="widget-title">',
		'after_title' => '</h1>',
	) );

	add_theme_support( 'post-formats', array( 'quote' ) );
	add_theme_support( 'post-thumbnails' );

	// Add default posts and comments RSS feed links to head
	add_theme_support( 'automatic-feed-links' );

	//Remove some unused stuff from the head.
	remove_action('wp_head', 'wlwmanifest_link');

}
add_action( 'after_setup_theme', 'mtf_setup' );


/**
 *	Register all assets
 *
 *  @return null
 */
function mtf_register_assets() {

	if ( is_admin() )
		return;

	// Use the theme version for theme assets to bust cache when updating.
	$theme = get_theme_data( get_bloginfo( 'stylesheet_directory' ) . '/style.css' );

	//Libraries, plugins and other resources
	wp_deregister_script( 'jquery' );
	wp_register_script( 'jquery', get_bloginfo( 'template_directory' ) . '/js/libs/jquery.min.js', null, '1.7.1', true );
	wp_register_script( 'modernizr', get_bloginfo( 'template_directory' ) . '/js/libs/modernizr-1.7.min.js', null, '1.7' );

   	// Scripts. Theme functions and behaviour
    wp_register_script( 'mtf_functions', get_bloginfo( 'template_directory' ) . '/js/functions.js', array( 'jquery' ), $theme['Version'], true );
	wp_register_script( 'mtf_theme', get_bloginfo( 'template_directory' ) . '/js/theme.js', array( 'jquery' ), $theme['Version'], true );

    // Theme CSS
    wp_register_style( 'reset', get_bloginfo( 'template_directory' ) . '/css/reset.css', null, $theme['Version'] );
    wp_register_style( 'mtf_type', get_bloginfo( 'template_directory' ) . '/css/type_14-21.css', null, $theme['Version'] );
    wp_register_style( 'mtf_forms', get_bloginfo( 'template_directory' ) . '/css/forms.css', null, $theme['Version'] );
    wp_register_style( 'mtf_style', get_bloginfo( 'template_directory' ) . '/css/theme.css', null, $theme['Version'] );

}
add_action( 'init', 'mtf_register_assets' );


/**
 *	Enqueue all the assets.	
 *
 *  @return null
 */
function mtf_enqueue_assets() {

	wp_enqueue_script( 'modernizr' );
	wp_enqueue_script( 'jquery' );

	// Theme Scripts
	wp_enqueue_script( 'comment-reply' );
	wp_enqueue_script( 'mtf_functions' );
	wp_enqueue_script( 'mtf_theme' );

	// Theme Styles
	wp_enqueue_style( 'reset' );
	wp_enqueue_style( 'mtf_type' );
	wp_enqueue_style( 'mtf_forms' );
	wp_enqueue_style( 'mtf_style' );

}
add_action( 'wp_enqueue_scripts', 'mtf_enqueue_assets' );


/**
 * Filter the excerpt length.
 * Different lengths can be used in different places.
 *
 * @param int $length
 * @return int
 */
function mtf_excerpt_length( $length ) {

	global $template;

	// Can adjust excerpt based on template file like this.
	if ( in_array( basename( $template ), array( 'index-grid.php' ) ) )
		return 25;

	if ( has_post_thumbnail() )
		return 30;

	return 50;

}
add_filter( 'excerpt_length', 'mtf_excerpt_length' );


/**
 *	Hide update notice if not an admin.
 *
 *  @return null
 */
function mtf_remove_update_nag() {

	if ( ! current_user_can( 'manage_options' ) )	
		remove_action( 'admin_notices', 'update_nag', 3 );

}
add_action( 'admin_notices', 'mtf_remove_update_nag', 1 );


/**
 *	Different category templates.
 *
 *	@param $template Path of template file
 *  @return null
 *	@todo - build some sort of UI/checkbox perhaps?
 */
function mtf_grid_template ( $template ) {
	
	// Portfolio category should use the grid template.
	if( is_category( 'featured-image' ) )
		return locate_template( 'index-grid.php', false );
			
	return $template;
	
}
add_filter( 'category_template', 'mtf_grid_template' );
add_filter( 'single_template', 'mtf_grid_template' );