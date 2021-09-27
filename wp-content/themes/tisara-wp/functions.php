<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/* Define static constant */
define( 'TISARA_THEME_NAME', 'Tisara WP Premium WordPress Theme' );
define( 'TISARA_THEME_SLUG', 'tisara-wp' );
define( 'TISARA_THEME_VERSION', '0.9.0' );
define( 'TISARA_THEME_ADDONS_VERSION', '0.3.0' );

define( 'TISARA_CUSTOMIZER_DEBUG', true );

/** 
 * Set default setting value.
 */
global $tisara_defaults;
$tisara_defaults = apply_filters( 'tisara_defaults', 
	array( 
		/* Header */
		'tisara_header_layout' => 'style-3',
		'tisara_header_social_icons' => array( 'facebook', 'twitter', 'youtube', 'instagram', 'pinterest', 'rss', 'email' ),
		'tisara_header_top_hide' => 1,
		'tisara_header_logo_type' => 'image',
		/* Footer */
		'tisara_footer_layout' => 'style-4',
		'tisara_footer_social_icons' => array( 'facebook', 'twitter', 'youtube', 'instagram', 'pinterest', 'rss', 'email' ),
		'tisara_footer_social_hide' => 1,
		/* Blog Page */
		'tisara_blog_sidebar_layout' => 'right',
		'tisara_blog_layout' => 'excerpt-image',
		'tisara_blog_meta' => 1,
		'tisara_blog_meta_items' => array( 'sticky', 'date' ),
		'tisara_blog_more_link' => 1,
		/* Single Post */
		'tisara_single_image' => 1,
		'tisara_single_meta' => 1,
		'tisara_single_meta_items' => array( 'sticky', 'date', 'categories', 'author' ),
		'tisara_single_comments' => 1,
		/* Single Page */
		'tisara_page_image' => 1,
		'tisara_page_comments' => 1,
		'tisara_single_related_layout' => 'grid-2columns',
		/* WooCommerce */
		'tisara_wc_shop_sidebar_layout' => 'none',
		'tisara_wc_shop_title_truncate' => 1,
		'tisara_wc_shop_button_style' => 'inline',
		'tisara_wc_product_sidebar_layout' => 'none',
		'tisara_wc_product_share' => 1,
	)
);

/* Library - TGM Plugin Activation */
require_once( get_template_directory() . '/includes/libraries/class-tgm-plugin-activation.php' );
/* Library - Customizer */
add_action( 'customize_register', 'tisara_customize_controls_register', 5 );
function tisara_customize_controls_register( $wp_customize ){
	require_once( get_template_directory() . '/includes/libraries/customize-controls.php' );
}
require_once( get_template_directory() . '/includes/libraries/customize.php' );
require_once( get_template_directory() . '/includes/libraries/breadcrumb.php' );

/* Setup - Theme */
require_once( get_template_directory() . '/includes/setup/setup-theme.php' );
/* Setup - Enqueue */
require_once( get_template_directory() . '/includes/setup/setup-enqueue.php' );
/* Setup - Sidebars */
require_once( get_template_directory() . '/includes/setup/setup-sidebars.php' );
/* Setup - Customizer */
require_once( get_template_directory() . '/includes/setup/setup-customizer.php' );
/* Setup - TGMPA */
require_once( get_template_directory() . '/includes/setup/setup-plugins.php' );
/* Setup - Demo Import */
require_once( get_template_directory() . '/includes/setup/setup-import.php' );
/* Setup - WooCommerce */
if ( class_exists('WooCommerce') ) {
	require_once( get_template_directory() . '/includes/setup/setup-woocommerce.php' );
}

/* Functions */
require_once( get_template_directory() . '/includes/functions/function-data-source.php' );
require_once( get_template_directory() . '/includes/functions/function-helpers.php' );
require_once( get_template_directory() . '/includes/functions/function-actions.php' );
require_once( get_template_directory() . '/includes/functions/function-filters.php' );
require_once( get_template_directory() . '/includes/functions/function-dummies.php' );
if ( class_exists('WooCommerce') ) {
	require_once( get_template_directory() . '/includes/functions/function-woocommerce.php' );
}

/* Customizer */
require_once( get_template_directory() . '/includes/customizer/customizer-11-typography.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-21-header.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-23-footer.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-31-blog.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-33-single.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-35-page.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-37-comments.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-91-scripts.php' );
require_once( get_template_directory() . '/includes/customizer/customizer-woocommerce.php' );
