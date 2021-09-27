<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_action( 'after_setup_theme', 'tisara_setup' );
function tisara_setup() {

	load_theme_textdomain( 'tisara-wp', get_template_directory() . '/languages' );

	global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 667; /* pixels */
	}

	add_editor_style();

	add_theme_support( 'title-tag' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'custom-header');
	add_theme_support( 'custom-logo' );
	add_theme_support( 'title-tag' );

	add_theme_support( 'html5', array( 'comment-list', 'comment-form', 'search-form', 'gallery', 'caption' ) );

	add_theme_support( 'custom-background', apply_filters( 'tisara_custom_background_args', array() ) );

	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 750, 420 );

	add_image_size( 'tisara-featured', 750, 420, true );
	add_image_size( 'tisara-featured-medium', 360, 200, true );
	add_image_size( 'tisara-thumbnail-small', 80, 80, true );

	register_nav_menus( array(
			'primary'		=> esc_html__( 'Primary Menu', 'tisara-wp' ),
			'secondary'		=> esc_html__( 'Secondary Menu', 'tisara-wp' ),
			'footer'		=> esc_html__( 'Footer Menu', 'tisara-wp' ),
		) );
}

function tisara_theme_mod( $option ) {
	global $tisara_defaults;
	$default = isset( $tisara_defaults[ $option ] ) ? $tisara_defaults[ $option ] : '';
	return get_theme_mod( $option, $default );
}
