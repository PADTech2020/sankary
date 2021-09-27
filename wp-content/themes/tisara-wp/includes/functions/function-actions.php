<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/**
 * Meta Responsive
 */
add_action( 'wp_head', 'tisara_wp_head_responsive', 1);
function tisara_wp_head_responsive() {
?>
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<?php
}

/**
 * Browser Theme Color
 */
add_action( 'wp_head', 'tisara_wp_head_browser_theme_color', 5 );
function tisara_wp_head_browser_theme_color() {
	$theme_color = tisara_theme_mod('tisara_browser_theme_color');
	if ( ! empty( $theme_color ) ) {
?>
<meta name="theme-color" content="<?php echo esc_attr($theme_color); ?>">
<meta name="msapplication-navbutton-color" content="<?php echo esc_attr($theme_color); ?>">
<?php
	}
	$safari_uic_hide = tisara_theme_mod('tisara_browser_safari_uic_hide');
	if ( ! empty( $safari_uic_hide ) ) {
?>
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
<?php
	}
}

/**
 * Header Script
 */
add_action( 'wp_head', 'tisara_header_scripts', 999 );
function tisara_header_scripts() {
	$header_scripts = tisara_theme_mod( 'tisara_header_scripts' );
	if ( ! empty( $header_scripts ) ) {
		echo tisara_theme_mod( 'tisara_header_scripts' );
	}
}

/**
 * Footer Script
 */
add_action( 'wp_footer', 'tisara_footer_scripts' );
function tisara_footer_scripts() {
	$footer_scripts = tisara_theme_mod( 'tisara_footer_scripts' );
	if ( ! empty( $footer_scripts ) ) {
		echo tisara_theme_mod( 'tisara_footer_scripts' );
	}
}
