<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$header_elementor_before = '';
$header_layout = '';
$header_elementor_after = '';
/* get header layout per page */
if ( class_exists('Tisara_Metabox') ) {
	if ( is_page() || is_singular() ) {
		$header_layout = get_post_meta( get_the_ID() , '_header_layout', true );
		if ( did_action( 'elementor/loaded' ) ) {
			$header_elementor_before = get_post_meta( get_the_ID() , '_header_elementor_before' ,true );
			$header_elementor_after = get_post_meta( get_the_ID() , '_header_elementor_after' ,true );
		}
	}
}
/* get header layout from customizer */
if ( empty( $header_layout ) || 'default' == $header_layout ) {
	$header_layout = tisara_theme_mod( 'tisara_header_layout' );
}
if ( did_action( 'elementor/loaded' ) ) {
	if ( empty( $header_elementor_before ) ) {
		$header_elementor_before = tisara_theme_mod( 'tisara_header_elementor_before' );
	}
	if ( empty( $header_elementor_after ) ) {
		$header_elementor_after = tisara_theme_mod( 'tisara_header_elementor_after' );
	}
}
/* default header layout */
if ( empty( $header_layout ) ) {
	$header_layout = 'style-3';
}

/* display header elementor before */
if ( !empty( $header_elementor_before ) ) {
	echo \Elementor\Plugin::$instance->frontend->get_builder_content( $header_elementor_before );
}

/* display header */
if ( 'hide' != $header_layout ) {
	get_template_part( 'templates/header/layout/'.$header_layout );
}

/* display header elementor after */
if ( !empty( $header_elementor_after ) ) {
	echo \Elementor\Plugin::$instance->frontend->get_builder_content( $header_elementor_after );
}
