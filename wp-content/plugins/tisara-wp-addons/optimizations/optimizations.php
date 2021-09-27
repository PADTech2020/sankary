<?php 

/**
 * Optimization functions
 *
 * @return void
 * @author Tisara
 **/

if ( is_admin() ) {
	return;
}

add_filter( 'wp_calculate_image_srcset_meta', 'tisara_disable_responsive_images' );
function tisara_disable_responsive_images( $option ) {
	if ( get_theme_mod( 'tisara_disable_responsive_images', true ) ) {
		return false;
	}
	return $option;
}

add_filter( 'intermediate_image_sizes_advanced', 'tisara_disable_medium_large_images' );
function tisara_disable_medium_large_images( $sizes ) {
	if ( get_theme_mod( 'tisara_disable_responsive_images', true ) ) {
		unset($sizes['medium_large']);
	}
	return $sizes;
}

add_action('after_setup_theme', 'tisara_cleanup_header');
function tisara_cleanup_header() {

	if ( get_theme_mod( 'tisara_disable_emojis', true ) ) {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		add_filter( 'emoji_svg_url', '__return_false' );
	}

	if ( get_theme_mod( 'tisara_disable_wp_generator', true ) ) {
		remove_action( 'wp_head', 'wp_generator' );
	}

	if ( get_theme_mod( 'tisara_disable_wlwmanifest' ) ) {
		remove_action( 'wp_head', 'wlwmanifest_link' );
	}

	if ( get_theme_mod( 'tisara_disable_rsd' ) ) {
		remove_action( 'wp_head', 'rsd_link' );
	}

	if ( get_theme_mod( 'tisara_disable_shortlink' ) ) {
		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 );
	}

	if ( get_theme_mod( 'tisara_disable_relational' ) ) {
		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
	}

	if ( get_theme_mod( 'tisara_disable_feed' ) ) {
		remove_action( 'wp_head', 'feed_links', 2 );
		remove_action( 'wp_head', 'feed_links_extra', 3 );
	}

	if ( get_theme_mod( 'tisara_disable_rest' ) ) {
		remove_action( 'wp_head', 'rest_output_link_wp_head', 10 );
	}

	if ( get_theme_mod( 'tisara_disable_oembed' ) ) {
		remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );
	}

}

add_filter( 'clean_url', 'tisara_defer_parsing_javascript', 11, 1 );
function tisara_defer_parsing_javascript ( $url ) {
	if ( is_customize_preview() ) {
		return $url;
	}
	if ( is_admin() ) {
		return $url;
	}
	if ( get_theme_mod( 'tisara_enable_defer_parsing' ) ) {
		if ( false === strpos( $url, '.js' ) ) {
			return $url;
		}
		if ( strpos( $url, 'jquery.js' ) ) {
			return $url;
		}
		return "$url' defer='defer";
	}
	else {
		return $url;

	}
}

add_filter( 'script_loader_src', 'tisara_remove_query_strings_1', 15, 1 );
add_filter( 'style_loader_src', 'tisara_remove_query_strings_1', 15, 1 );
function tisara_remove_query_strings_1( $src ) {
	if ( get_theme_mod('tisara_remove_query_string') ) {
		$rqs = explode( '?ver', $src );
		return $rqs[0];
	}
	return $src;
}

add_filter( 'script_loader_src', 'tisara_remove_query_strings_2', 15, 1 );
add_filter( 'style_loader_src', 'tisara_remove_query_strings_2', 15, 1 );
function tisara_remove_query_strings_2( $src ) {
	if ( get_theme_mod('tisara_remove_query_string') ) {
		$rqs = explode( '&ver', $src );
		return $rqs[0];
	}
	return $src;
}

add_filter( 'tisara_style', 'tisara_style_wpadminbar_css' );
function tisara_style_wpadminbar_css( $style ) {
	$style .= '@media screen and (max-width: 600px) { #wpadminbar { position: fixed; } }';
	return $style;
}
