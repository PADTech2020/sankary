<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/**
 * Body class - LTR
 */
add_filter( 'body_class', 'tokostrap4_body_class' );
function tokostrap4_body_class( $classes ) {
	if ( !is_rtl() ) {
		$classes[] = 'ltr';
	}
	return $classes;
}

/**
 * Style Output - Custom Header Image on Header Hero / Page Title
 */
add_filter( 'tisara_style', 'tisara_style_custom_header_css' );
function tisara_style_custom_header_css( $style ) {
	$image = get_header_image();
	if ( $image ) {
		$style = $style.'.site-hero{ background-image:url('.esc_url($image).'); background-size: cover; background-position: center; background-repeat: no-repeat; }';
	}
	return $style;
}

/**
 * Post class - Entry
 */
add_filter( 'post_class', 'tokostrap4_post_class' );
function tokostrap4_post_class( $classes ) {
	if ( in_array( 'hentry', $classes ) ) {
		$classes = array_diff( $classes, array( 'hentry' ) );
		$classes[] = 'entry';
	}
	return $classes;
}

/**
 * Search Form
 */
add_filter( 'get_search_form', 'tisara_get_search_form' );
function tisara_get_search_form( $form ) {
	global $tisara_search_form_index;
	ob_start();
	get_template_part( 'templates/searchform' );
	$form = ob_get_clean();
	return $form;
}

/**
 * More Link Button
 */
add_filter( 'the_content_more_link', 'tisara_filter_content_more_link' );
function tisara_filter_content_more_link( $content ) {
	$content = '<p class="entry-more-link">'.str_replace( 'more-link', 'entry-more-button more-link button', $content ).'</p>';
	return $content;
}

/**
 * Excerpt - Simple Excerpt More
 */
add_action( 'excerpt_more', 'tokostrap4_excerpt_more' );
function tokostrap4_excerpt_more( $html ) {
	return ' &hellip;';
}
