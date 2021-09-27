<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists('WooCommerce') ) {
	return;
}

add_action( 'after_setup_theme', 'tisara_wc_setup' );
function tisara_wc_setup() {

	/**
	 * Declare WooCommerce Support
	 */
	add_theme_support( 'woocommerce' );

	/**
	 * Product Gallery Zoom
	 */
	if ( tisara_theme_mod('tisara_wc_product_gallery_zoom_disable') || function_exists('wpb_wiz_adding_scripts') ) {
		remove_theme_support( 'wc-product-gallery-zoom' );
	}
	else {
		add_theme_support( 'wc-product-gallery-zoom' );
	}

	/**
	 * Product Gallery LightBox
	 */
	if ( tisara_theme_mod('tisara_wc_product_gallery_lightbox_disable') ) {
		remove_theme_support( 'wc-product-gallery-lightbox' );
	}
	else {
		add_theme_support( 'wc-product-gallery-lightbox' );
	}

	/**
	 * Product Gallery Slider
	 */
	if ( tisara_theme_mod('tisara_wc_product_gallery_slider_disable') ) {
		remove_theme_support( 'wc-product-gallery-slider' );
	}
	else {
		add_theme_support( 'wc-product-gallery-slider' );
	}
}

add_action( 'widgets_init', 'tisara_wc_register_sidebars' );
function tisara_wc_register_sidebars() {
	
	register_sidebar(
		array(
			'name'			=> esc_html__( 'Shop', 'tisara-wp' ),
			'id'			=> 'shop',
			'description'	=> esc_html__( 'Appears on shop page, when enabled. If you want to leave it empty, add empty Text Widget here.', 'tisara-wp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Single Product', 'tisara-wp' ),
			'id'			=> 'product',
			'description'	=> esc_html__( 'Appears on single product page, when enabled. If you want to leave it empty, add empty Text Widget here.', 'tisara-wp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);

}
