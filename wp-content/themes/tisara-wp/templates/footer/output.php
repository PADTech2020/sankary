<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$footer_elementor_before = '';
$footer_layout = '';
$footer_elementor_after = '';
/* get footer layout per page */
if ( class_exists('Tisara_Metabox') ) {
	if ( is_page() || is_singular() ) {
		$footer_layout = get_post_meta( get_the_ID() , '_footer_layout', true );
		if ( did_action( 'elementor/loaded' ) ) {
			$footer_elementor_before = get_post_meta( get_the_ID() , '_footer_elementor_before' ,true );
			$footer_elementor_after = get_post_meta( get_the_ID() , '_footer_elementor_after' ,true );
		}
	}
}
/* get footer layout from customizer */
if ( empty( $footer_layout ) || 'default' == $footer_layout ) {
	$footer_layout = tisara_theme_mod( 'tisara_footer_layout' );
}
if ( did_action( 'elementor/loaded' ) ) {
	if ( empty( $footer_elementor_before ) ) {
		$footer_elementor_before = tisara_theme_mod( 'tisara_footer_elementor_before' );
	}
	if ( empty( $footer_elementor_after ) ) {
		$footer_elementor_after = tisara_theme_mod( 'tisara_footer_elementor_after' );
	}
}
/* default footer layout */
if ( empty( $footer_layout ) ) {
	$footer_layout = 'style-4';
}

/* display footer elementor before */
if ( !empty( $footer_elementor_before ) ) {
	echo \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_elementor_before );
}

/* display footer */
if ( 'hide' != $footer_layout ) {
	get_template_part( 'templates/footer/layout/'.$footer_layout );
}

/* display footer elementor after */
if ( !empty( $footer_elementor_after ) ) {
	echo \Elementor\Plugin::$instance->frontend->get_builder_content( $footer_elementor_after );
}
