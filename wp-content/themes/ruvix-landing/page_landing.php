<?php
/**
 * Ruvix Landing
 *
 * 
 *
 * Template Name: Landing
 *
 * @package Ruvix Landin
 * @author  Ruvix
 * @license GPL-2.0+
 * @link    http://www.ruvix.com/
 */

remove_action('genesis_entry_header', 'genesis_do_post_title');


// Add landing page body class to the head.
add_filter( 'body_class', 'ruvix_landing_add_body_class' );
function ruvix_landing_add_body_class( $classes ) {

	$classes[] = 'landing-page';

	return $classes;

}

// Remove Skip Links.
remove_action ( 'genesis_before_header', 'genesis_skip_links', 5 );

// Dequeue Skip Links Script.
add_action( 'wp_enqueue_scripts', 'ruvix_landing_dequeue_skip_links' );
function ruvix_landing_dequeue_skip_links() {
	wp_dequeue_script( 'skip-links' );
}

// Force full width content layout.
add_filter( 'genesis_site_layout', '__genesis_return_full_width_content' );



// Remove navigation.
remove_theme_support( 'genesis-menus' );

// Remove breadcrumbs.
remove_action( 'genesis_before_loop', 'genesis_do_breadcrumbs' );



// Remove site footer elements.
remove_action( 'genesis_footer', 'genesis_footer_markup_open', 5 );
remove_action( 'genesis_footer', 'genesis_do_footer' );
remove_action( 'genesis_footer', 'genesis_footer_markup_close', 15 );

// Run the Genesis loop.
genesis();
