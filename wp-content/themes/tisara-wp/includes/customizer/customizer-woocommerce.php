<?php
/**
 * WooCommerce Customizer
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists('WooCommerce') ) {
	return;
}

add_action( 'customize_register', 'tisara_wc_customize_reposition_options', 20 );
function tisara_wc_customize_reposition_options( $wp_customize ) {
	$description = '<p class="tisara-alert tisara-alert-with-icon">
					<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.panel( \'tisara_wc_panel_settings\' ).focus();">'.esc_html__( 'CLICK HERE to go to "Theme Settings - WooCommerce" panel.', 'tisara-wp' ).'</a>
					</p>';

	$wp_customize->get_panel( 'woocommerce' )->title = esc_html__( 'WooCommerce Settings', 'tisara-wp' );
	$wp_customize->get_panel( 'woocommerce' )->description = $description;
	$wp_customize->get_panel( 'woocommerce' )->priority = 9;

	$wp_customize->get_section( 'woocommerce_store_notice' )->description = $description;
	$wp_customize->get_section( 'woocommerce_product_catalog' )->description = $description;
	$wp_customize->get_section( 'woocommerce_product_images' )->description = $description;
	$wp_customize->get_section( 'woocommerce_checkout' )->description = $description;
}

/**
 * WooCommerce Customizer Panel
 */
add_filter( 'tisara_customize_controls', 'tisara_wc_customize_controls' );
function tisara_wc_customize_controls( $controls ) {
	$controls['tisara_wc_panel_settings'] = array(
		'title'    => esc_html__( 'Theme Settings - WooCommerce', 'tisara-wp' ),
		'setting'  => 'tisara_wc_panel_settings',
		'type'     => 'panel',
		'priority' => 7,
	);

	return $controls;
}

/**
 * WooCommerce - General
 */
add_filter( 'tisara_customize_controls', 'tisara_wc_customize_controls_general' );
function tisara_wc_customize_controls_general( $controls ) {

	$controls['tisara_wc_section_general'] = array(
		'title'    => esc_html__( 'WC - General', 'tisara-wp' ),
		'setting'  => 'tisara_wc_section_general',
		'panel'    => 'tisara_wc_panel_settings',
		'type'     => 'section',
		'priority' => 10,
	);

	$controls['tisara_wc_heading_storenotice'] = array(
		'label'				=> esc_html__( 'WC Store Notice', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.section( \'woocommerce_store_notice\' ).focus();">'.esc_html__( 'CLICK HERE to setup WooCommerce Store Notice', 'tisara-wp' ).'</a>
								</p>',
		'setting'  			=> 'tisara_wc_heading_storenotice',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_heading_saleflash'] = array(
		'label'				=> esc_html__( 'WC Sale Flash Badge', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_saleflash',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_saleflash_text'] = array(
		'label'				=> esc_html__( 'Sale Flash Badge Text', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_saleflash_text',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'text',
	);

	$controls['tisara_wc_saleflash_background'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_saleflash_background',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce span.onsale { background-color: [value] } .woocommerce span.onsale:after { border-color: transparent transparent transparent [value] }',
	);

	$controls['tisara_wc_saleflash_color'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_saleflash_color',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce span.onsale { color: [value] }',
	);

	$controls['tisara_wc_heading_soldout'] = array(
		'label'				=> esc_html__( 'WC Sold Out Badge', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_soldout',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_soldout_text'] = array(
		'label'				=> esc_html__( 'Sold Out Badge Text', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_soldout_text',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'text',
	);

	$controls['tisara_wc_soldout_background'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_soldout_background',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce span.onsale.soldout { background-color: [value] } .woocommerce span.onsale.soldout:after { border-color: transparent transparent transparent [value] }',
	);

	$controls['tisara_wc_soldout_color'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_soldout_color',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce span.onsale.soldout { color: [value] }',
	);

	$controls['tisara_wc_heading_rating'] = array(
		'label'				=> esc_html__( 'WC Rating', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_rating',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_rating_color'] = array(
		'label'				=> esc_html__( 'Rating Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_rating_color',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce .star-rating, .woocommerce p.stars a, .woocommerce p.stars a:hover { color: [value] }',
	);

	$controls['tisara_wc_heading_button'] = array(
		'label'				=> esc_html__( 'WC Button (Default)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_button',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_button_background'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_background',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { background-color: [value] }',
	);

	$controls['tisara_wc_button_border'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_border',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { border-color: [value] }',
	);

	$controls['tisara_wc_button_color'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_color',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit, .woocommerce a.button, .woocommerce button.button, .woocommerce input.button { color: [value] }',
	);

	$controls['tisara_wc_button_background_hover'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_background_hover',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover { background-color: [value] }',
	);

	$controls['tisara_wc_button_border_hover'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_border_hover',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover { border-color: [value] }',
	);

	$controls['tisara_wc_button_color_hover'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_color_hover',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit:hover, .woocommerce a.button:hover, .woocommerce button.button:hover, .woocommerce input.button:hover { color: [value] }',
	);

	$controls['tisara_wc_heading_button_alt'] = array(
		'label'				=> esc_html__( 'WC Button Alt (Primary)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_button_alt',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_button_alt_background'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_alt_background',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt.disabled, .woocommerce a.button.alt.disabled, .woocommerce button.button.alt.disabled, .woocommerce input.button.alt.disabled { background-color: [value] }',
	);

	$controls['tisara_wc_button_alt_border'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_alt_border',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt.disabled, .woocommerce a.button.alt.disabled, .woocommerce button.button.alt.disabled, .woocommerce input.button.alt.disabled { border-color: [value] }',
	);

	$controls['tisara_wc_button_alt_color'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_alt_color',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit.alt, .woocommerce a.button.alt, .woocommerce button.button.alt, .woocommerce input.button.alt, .woocommerce #respond input#submit.alt.disabled, .woocommerce a.button.alt.disabled, .woocommerce button.button.alt.disabled, .woocommerce input.button.alt.disabled { color: [value] }',
	);

	$controls['tisara_wc_button_alt_background_hover'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_alt_background_hover',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce a.button.alt.disabled:hover, .woocommerce button.button.alt.disabled:hover, .woocommerce input.button.alt.disabled:hover { background-color: [value] }',
	);

	$controls['tisara_wc_button_alt_border_hover'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_alt_border_hover',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce a.button.alt.disabled:hover, .woocommerce button.button.alt.disabled:hover, .woocommerce input.button.alt.disabled:hover { border-color: [value] }',
	);

	$controls['tisara_wc_button_alt_color_hover'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_button_alt_color_hover',
		'section'			=> 'tisara_wc_section_general',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #respond input#submit.alt:hover, .woocommerce a.button.alt:hover, .woocommerce button.button.alt:hover, .woocommerce input.button.alt:hover, .woocommerce #respond input#submit.alt.disabled:hover, .woocommerce a.button.alt.disabled:hover, .woocommerce button.button.alt.disabled:hover, .woocommerce input.button.alt.disabled:hover { color: [value] }',
	);

	return $controls;
}

/**
 * WooCommerce - Shop Page
 */
add_filter( 'tisara_customize_controls', 'tisara_wc_customize_controls_shop' );
function tisara_wc_customize_controls_shop( $controls ) {

	$controls['tisara_wc_section_shop'] = array(
		'title'    => esc_html__( 'WC - Shop Page', 'tisara-wp' ),
		'description' => '<p class="tisara-alert tisara-alert-success tisara-alert-with-icon">
							<span class="dashicons dashicons-megaphone"></span> '.esc_html__( 'WooCommerce "Shop" page does not use standard WordPress page. It can not be edited by visual page builder plugin, including Elementor.', 'tisara-wp' ).'
							</p>',
		'setting'  => 'tisara_wc_section_shop',
		'panel'    => 'tisara_wc_panel_settings',
		'type'     => 'section',
		'priority' => 20,
	);

	$controls['tisara_wc_heading_shop_sidebar_layout'] = array(
		'label'    => esc_html__( 'Sidebar Layout', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.panel( \'widgets\' ).focus();">'.esc_html__( 'CLICK HERE to setup / manage widgets when sidebar is available', 'tisara-wp' ).'</a>
								</p>',
		'setting'  => 'tisara_wc_heading_shop_sidebar_layout',
		'section'  => 'tisara_wc_section_shop',
		'type'     => 'heading',
	);

	$controls['tisara_wc_shop_sidebar_layout'] = array(
		'label'    => esc_html__( 'Sidebar Layout', 'tisara-wp' ),
		'setting'  => 'tisara_wc_shop_sidebar_layout',
		'section'  => 'tisara_wc_section_shop',
		'type'     => 'radio',
		'choices'  => array(
			'none' 		=> esc_html__( 'No Sidebar (Full Width)', 'tisara-wp' ),
			'right' 	=> esc_html__( 'Right Sidebar', 'tisara-wp' ),
			'left'		=> esc_html__( 'Left Sidebar', 'tisara-wp' ),
		),
	);

	$controls['tisara_wc_heading_shop_layout'] = array(
		'label'    => esc_html__( 'Shop Page Layout', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.section( \'woocommerce_product_catalog\' ).focus();">'.esc_html__( 'CLICK HERE to setup Shop page display, Category display, and Default product sorting on Product Catalog settings', 'tisara-wp' ).'</a>
								</p>',
		'setting'  => 'tisara_wc_heading_shop_layout',
		'section'  => 'tisara_wc_section_shop',
		'type'     => 'heading',
	);

	$controls['tisara_wc_shop_result_count_disable'] = array(
		'label'				=> esc_html__( 'DISABLE result count', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_result_count_disable',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_shop_catalog_ordering_disable'] = array(
		'label'				=> esc_html__( 'DISABLE catalog ordering', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_catalog_ordering_disable',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_shop_columns'] = array(
		'label'				=> esc_html__( 'Number of products per row', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_columns',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'radio-buttonset',
		'choices'			=> array(
			'6' => '6',
			'5' => '5',
			'4' => '4',
			'3' => '3',
			'2' => '2',
			'1' => '1',
		),
	);

	$controls['tisara_wc_shop_columns_mobile'] = array(
		'label'				=> esc_html__( 'Number of products per row (mobile)', 'tisara-wp' ),
		'description' 		=> esc_html__( 'For mobile only, when device viewport width <= 480px', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_columns_mobile',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'radio-buttonset',
		'choices'			=> array(
			'1' => '1',
			'2' => '2',
		),
		// 'style'				=> array(
		// 	'1'		=> '',
		// 	'2'		=> '@media (max-width: 480px) { .woocommerce ul.products, .woocommerce-page ul.products { margin: 0 -8px; } .woocommerce ul.products li.product, .woocommerce-page ul.products li.product, .woocommerce[class*="columns-"] ul.products li.product, .woocommerce-page[class*="columns-"] ul.products li.product, .woocommerce ul.products[class*="columns-"] li.product, .woocommerce-page ul.products[class*="columns-"] li.product, .woocommerce .cart-collaterals .cross-sells ul.products li, .woocommerce-page .cart-collaterals .cross-sells ul.products li { width: 50%; padding: 0 8px; margin: 0 0 15px; } .woocommerce ul.products li.product .product-detail-box, .woocommerce-page ul.products li.product .product-detail-box { padding: 12px 12px 12px; font-size: 13px; } }',
		// ),
		'active_callback'	=> 'tisara_wc_callback_shop_columns_mobile_is_active',
	);

	$controls['tisara_wc_shop_per_page'] = array(
		'label'				=> esc_html__( 'Number of products per page', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_per_page',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'number',
	);

	$controls['tisara_wc_heading_shop_thumbnail'] = array(
		'label'    => esc_html__( 'Shop Page Product Image', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.section( \'woocommerce_product_images\' ).focus();">'.esc_html__( 'CLICK HERE to setup Thumbnail Width for products in the catalog (shop page)', 'tisara-wp' ).'</a>
								</p>',
		'setting'  => 'tisara_wc_heading_shop_thumbnail',
		'section'  => 'tisara_wc_section_shop',
		'type'     => 'heading',
	);

	$controls['tisara_wc_heading_shop_elements'] = array(
		'label'    => esc_html__( 'Shop Page Elements', 'tisara-wp' ),
		'setting'  => 'tisara_wc_heading_shop_elements',
		'section'  => 'tisara_wc_section_shop',
		'type'     => 'heading',
	);

	$controls['tisara_wc_shop_saleflash_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product sale flash', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_saleflash_disable',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_shop_title_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product title', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_title_disable',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_shop_title_truncate'] = array(
		'label'				=> esc_html__( 'TRUNCATE product title (one line only)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_title_truncate',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_shop_price_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product price', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_price_disable',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_shop_rating_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product rating', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_rating_disable',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_shop_product_alignment'] = array(
		'label'				=> esc_html__( 'Product Detail Alignment', 'tisara-wp' ),
		'setting'			=> 'tisara_wc_shop_product_alignment',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'radio-iconset',
		'choices'			=> array(
			'left'			=> 'dashicons dashicons-editor-alignleft',
			'center'		=> 'dashicons dashicons-editor-aligncenter',
			'right'			=> 'dashicons dashicons-editor-alignright',
		),
		'style'				=> array(
			'left'			=> '.woocommerce ul.products li.product .product-detail-box, .woocommerce-page ul.products li.product .product-detail-box { text-align: left; }',
			'center'		=> '.woocommerce ul.products li.product .product-detail-box, .woocommerce-page ul.products li.product .product-detail-box { text-align: center; }',
			'right'			=> '.woocommerce ul.products li.product .product-detail-box, .woocommerce-page ul.products li.product .product-detail-box { text-align: right; }',
		),
	);

	$controls['tisara_wc_shop_product_box_background'] = array(
		'label'				=> esc_html__( 'Product Box Background', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_product_box_background',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .product-inner, .woocommerce-page ul.products li.product .product-inner { background: [value] }',
	);

	$controls['tisara_wc_shop_product_box_border'] = array(
		'label'				=> esc_html__( 'Product Box Border', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_product_box_border',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .product-inner, .woocommerce-page ul.products li.product .product-inner { border-color: [value] }',
	);

	$controls['tisara_wc_shop_product_title_color'] = array(
		'label'				=> esc_html__( 'Product Title Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_product_title_color',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product h2, .woocommerce ul.products li.product h3 { color: [value] }',
	);

	$controls['tisara_wc_shop_product_title_font_size'] = array(
		'label'    			=> esc_html__( 'Product Title Font Size', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_product_title_font_size',
		'section'			=> 'tisara_wc_section_shop',
		'type'     			=> 'slider',
		'choices'  			=> array(
			'min' 			=> 0.5,
			'max' 			=> 2,
			'step' 			=> 0.1,
			'unit' 			=> 'rem',
		),
		'style'    			=> '.woocommerce ul.products li.product .woocommerce-loop-category__title, .woocommerce ul.products li.product .woocommerce-loop-product__title, .woocommerce ul.products li.product h3 { font-size: [value]rem }',
	);

	$controls['tisara_wc_shop_product_price_color'] = array(
		'label'				=> esc_html__( 'Product Price Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_product_price_color',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .price { color: [value] }',
	);

	$controls['tisara_wc_shop_product_price_font_size'] = array(
		'label'    			=> esc_html__( 'Product Price Font Size', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_product_price_font_size',
		'section'			=> 'tisara_wc_section_shop',
		'type'     			=> 'slider',
		'choices'  			=> array(
			'min' 			=> 0.5,
			'max' 			=> 2,
			'step' 			=> 0.1,
			'unit' 			=> 'rem',
		),
		'style'    			=> '.woocommerce ul.products li.product .price { font-size: [value]rem }',
	);

	$controls['tisara_wc_shop_product_sale_price_font_size'] = array(
		'label'    			=> esc_html__( 'Product Sale Price Font Size', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_product_sale_price_font_size',
		'section'			=> 'tisara_wc_section_shop',
		'type'     			=> 'slider',
		'choices'  			=> array(
			'min' 			=> 0.5,
			'max' 			=> 2,
			'step' 			=> 0.1,
			'unit' 			=> 'rem',
		),
		'style'    			=> '.woocommerce ul.products li.product .price ins { font-size: [value]rem }',
	);

	$controls['tisara_wc_heading_shop_button'] = array(
		'label'    			=> esc_html__( '"Add to cart" Button', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_shop_button',
		'section'  			=> 'tisara_wc_section_shop',
		'type'     			=> 'heading',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_disable'] = array(
		'label'				=> esc_html__( 'DISABLE "add to cart" button', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_disable',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'checkbox',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_style'] = array(
		'label'				=> esc_html__( 'Button Style', 'tisara-wp' ),
		'setting'			=> 'tisara_wc_shop_button_style',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'radio',
		'choices'			=> array(
			''				=> esc_html__( 'Inline', 'tisara-wp' ),
			'fullwidth'		=> esc_html__( 'Full Width', 'tisara-wp' ),
		),
		'style'				=> array(
			''				=> '',
			'fullwidth'		=> '.woocommerce ul.products li.product .button-shop-addtocart { display: block; }',
		),
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_text_simple'] = array(
		'label'				=> esc_html__( 'Button Text: Simple Product', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_text_simple',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'text',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_text_variable'] = array(
		'label'				=> esc_html__( 'Button Text: Variable Product', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_text_variable',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'text',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_text_outofstock'] = array(
		'label'				=> esc_html__( 'Button Text: OutOfStock Product', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_text_outofstock',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'text',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_font_size'] = array(
		'label'    			=> esc_html__( 'Font Size', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_font_size',
		'section'			=> 'tisara_wc_section_shop',
		'type'     			=> 'slider',
		'choices'  			=> array(
			'min' 			=> 0.5,
			'max' 			=> 2,
			'step' 			=> 0.1,
			'unit' 			=> 'rem',
		),
		'style'    			=> '.woocommerce ul.products li.product .button-shop-addtocart { font-size: [value]rem }',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_background'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_background',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .button-shop-addtocart { background-color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_border'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_border',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .button-shop-addtocart { border-color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_color'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_color',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .button-shop-addtocart { color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_background_hover'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_background_hover',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .button-shop-addtocart:hover { background-color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_border_hover'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_border_hover',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .button-shop-addtocart:hover { border-color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_shop_button_color_hover'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_shop_button_color_hover',
		'section'			=> 'tisara_wc_section_shop',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce ul.products li.product .button-shop-addtocart:hover { color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_shop_button_is_active',
		'priority'			=> 20,
	);

	$controls['tisara_wc_heading_shop_pagination'] = array(
		'label'				=> esc_html__( 'Pagination Style', 'tisara-wp' ),
		'description'		=> '<p class="tisara-alert tisara-alert-with-icon"><span class="dashicons dashicons-admin-appearance"></span> <a href="javascript:wp.customize.control( \'tisara_heading_pagination\' ).focus();">' . sprintf( esc_html__( 'CLICK HERE to setup %s', 'tisara-wp' ), esc_html__( 'Pagination Style', 'tisara-wp' ) ) . '</a></p>',
		'setting'			=> 'tisara_wc_heading_shop_pagination',
		'section'			=> 'tisara_wc_section_shop',
		'type'				=> 'heading',
		'priority'			=> 99,
	);

	return $controls;
}

/**
 * WooCommerce - Single Product
 */
add_filter( 'tisara_customize_controls', 'tisara_wc_customize_controls_product' );
function tisara_wc_customize_controls_product( $controls ) {

	$controls['tisara_wc_section_product'] = array(
		'title'    => esc_html__( 'WC - Single Product', 'tisara-wp' ),
		'description' => '<p class="tisara-alert tisara-alert-success tisara-alert-with-icon">
							<span class="dashicons dashicons-megaphone"></span>'.sprintf( esc_html__( 'These settings are applied on All %s', 'tisara-wp' ), esc_html__( 'Single Product', 'tisara-wp' ) ).
						'</p>',
		'setting'  => 'tisara_wc_section_product',
		'panel'    => 'tisara_wc_panel_settings',
		'type'     => 'section',
		'priority' => 30,
	);

	$controls['tisara_wc_heading_product_sidebar_layout'] = array(
		'label'    => esc_html__( 'Sidebar Layout', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.panel( \'widgets\' ).focus();">'.esc_html__( 'CLICK HERE to setup / manage widgets when sidebar is available', 'tisara-wp' ).'</a>
								</p>',
		'setting'  => 'tisara_wc_heading_product_sidebar_layout',
		'section'  => 'tisara_wc_section_product',
		'type'     => 'heading',
	);

	$controls['tisara_wc_product_sidebar_layout'] = array(
		'label'    => esc_html__( 'Sidebar Layout', 'tisara-wp' ),
		'setting'  => 'tisara_wc_product_sidebar_layout',
		'section'  => 'tisara_wc_section_product',
		'type'     => 'radio',
		'choices'  => array(
			'none' 		=> esc_html__( 'No Sidebar (Full Width)', 'tisara-wp' ),
			'right' 	=> esc_html__( 'Right Sidebar', 'tisara-wp' ),
			'left'		=> esc_html__( 'Left Sidebar', 'tisara-wp' ),
		),
	);

	$controls['tisara_wc_heading_product_elements'] = array(
		'label'    => esc_html__( 'Single Product Elements', 'tisara-wp' ),
		'setting'  => 'tisara_wc_heading_product_elements',
		'section'  => 'tisara_wc_section_product',
		'type'     => 'heading',
	);

	$controls['tisara_wc_product_saleflash_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product sale flash', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_saleflash_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_product_rating_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product rating', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_rating_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_product_price_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product price', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_price_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_product_excerpt_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product short description', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_excerpt_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_product_meta_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product meta (sku, category, tag)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_meta_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_product_title_color'] = array(
		'label'				=> esc_html__( 'Product Title Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_title_color',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce div.product .product_title { color: [value] }',
	);

	$controls['tisara_wc_product_price_color'] = array(
		'label'				=> esc_html__( 'Product Price Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_price_color',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce div.product p.price, .woocommerce div.product span.price { color: [value] }',
	);

	$controls['tisara_wc_heading_product_image'] = array(
		'label'   	 		=> esc_html__( 'Single Product Image', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.section( \'woocommerce_product_images\' ).focus();">'.esc_html__( 'CLICK HERE to setup Main Image Width for products in the single product page', 'tisara-wp' ).'</a>
								</p>',
		'setting'  			=> 'tisara_wc_heading_product_image',
		'section'  			=> 'tisara_wc_section_product',
		'type'     			=> 'heading',
	);

	$controls['tisara_wc_product_gallery_zoom_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product gallery zoom', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_gallery_zoom_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'transport'         => 'postMessage',
	);

	$controls['tisara_wc_product_gallery_lightbox_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product gallery lightbox', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_gallery_lightbox_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'transport'         => 'postMessage',
	);

	$controls['tisara_wc_product_gallery_slider_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product gallery slider', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_gallery_slider_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'transport'         => 'postMessage',
	);

	$controls['tisara_wc_heading_product_image_warning'] = array(
		'description' 		=> '<p class="tisara-alert tisara-alert-danger tisara-alert-with-icon">
								<span class="dashicons dashicons-warning"></span> <a href="javascript:wp.customize.section( \'woocommerce_product_images\' ).focus();">'.esc_html__( 'IMPORTANT: Live preview does not work for these options above. Please publish your changes and refresh to see the result', 'tisara-wp' ).'</a>
								</p>',
		'setting'  			=> 'tisara_wc_heading_product_image_warning',
		'section'  			=> 'tisara_wc_section_product',
		'type'     			=> 'heading',
	);

	$controls['tisara_wc_heading_product_button'] = array(
		'label'				=> esc_html__( '"Add to cart" Button', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_product_button',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'heading',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_disable'] = array(
		'label'				=> esc_html__( 'DISABLE "add to cart" button', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_quantity_disable'] = array(
		'label'				=> esc_html__( 'DISABLE quantity input box', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_quantity_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'style'    			=> array( 
			'on'   			=> '.woocommerce div.product form.cart .quantity { display:none !important; }',
			'off'  			=> '',
		),
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_style'] = array(
		'label'				=> esc_html__( 'Button Style', 'tisara-wp' ),
		'setting'			=> 'tisara_wc_product_button_style',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'radio',
		'choices'			=> array(
			''				=> esc_html__( 'Inline', 'tisara-wp' ),
			'fullwidth'		=> esc_html__( 'Full Width', 'tisara-wp' ),
		),
		'style'				=> array(
			''				=> '',
			'fullwidth'		=> '.woocommerce a.button.alt.single_add_to_cart_button, .woocommerce button.button.alt.single_add_to_cart_button, .woocommerce input.button.alt.single_add_to_cart_button, .woocommerce-product-button { clear: both; display:block; width: 100%; } .woocommerce-product-button { padding: 0; }',
		),
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_text'] = array(
		'label'				=> esc_html__( 'Button Text', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_text',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'text',
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_font_size'] = array(
		'label'    			=> esc_html__( 'Font Size', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_font_size',
		'section'			=> 'tisara_wc_section_product',
		'type'     			=> 'slider',
		'choices'  			=> array(
			'min' 			=> 0.5,
			'max' 			=> 2,
			'step' 			=> 0.1,
			'unit' 			=> 'rem',
		),
		'style'    			=> '.woocommerce a.button.alt.single_add_to_cart_button, .woocommerce button.button.alt.single_add_to_cart_button, .woocommerce input.button.alt.single_add_to_cart_button, .woocommerce div.product form.cart div.quantity .qty { font-size: [value]rem }',
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_background'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_background',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce a.button.alt.single_add_to_cart_button, .woocommerce button.button.alt.single_add_to_cart_button, .woocommerce input.button.alt.single_add_to_cart_button { background-color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_border'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_border',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce a.button.alt.single_add_to_cart_button, .woocommerce button.button.alt.single_add_to_cart_button, .woocommerce input.button.alt.single_add_to_cart_button { border-color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_color'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_color',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce a.button.alt.single_add_to_cart_button, .woocommerce button.button.alt.single_add_to_cart_button, .woocommerce input.button.alt.single_add_to_cart_button { color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_background_hover'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_background_hover',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce a.button.alt.single_add_to_cart_button:hover, .woocommerce button.button.alt.single_add_to_cart_button:hover, .woocommerce input.button.alt.single_add_to_cart_button:hover { background-color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_border_hover'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_border_hover',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce a.button.alt.single_add_to_cart_button:hover, .woocommerce button.button.alt.single_add_to_cart_button:hover, .woocommerce input.button.alt.single_add_to_cart_button:hover { border-color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_product_button_color_hover'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_button_color_hover',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce a.button.alt.single_add_to_cart_button:hover, .woocommerce button.button.alt.single_add_to_cart_button:hover, .woocommerce input.button.alt.single_add_to_cart_button:hover { color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_product_button_is_active',
		'priority'   		=> 20,
	);

	$controls['tisara_wc_heading_product_tabs'] = array(
		'label'    			=> esc_html__( 'Product Tabs', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_product_tabs',
		'section'  			=> 'tisara_wc_section_product',
		'type'     			=> 'heading',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_product_tab_description_title'] = array(
		'label'				=> esc_html__( 'Product description tab title', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_tab_description_title',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'text',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_product_tab_description_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product description tab', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_tab_description_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_product_tab_attributes_title'] = array(
		'label'				=> esc_html__( 'Product attributes (additional information) tab title', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_tab_attributes_title',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'text',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_product_tab_attributes_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product attributes (additional information) tab', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_tab_attributes_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_product_tab_reviews_title'] = array(
		'label'				=> esc_html__( 'Product review tab title', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_tab_reviews_title',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'text',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_product_tab_reviews_disable'] = array(
		'label'				=> esc_html__( 'DISABLE product review tab', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_tab_reviews_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_product_tab_color'] = array(
		'label'				=> esc_html__( 'Tab Title Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_tab_color',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce div.product .woocommerce-tabs ul.tabs li a, .woocommerce div.product .woocommerce-tabs ul.tabs .description_tab a { color: [value] }',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_product_tab_color_active'] = array(
		'label'				=> esc_html__( 'Tab Title Color (Active)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_tab_color_active',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, .woocommerce div.product .woocommerce-tabs ul.tabs .description_tab.active a { color: [value] }',
		'priority'   		=> 30,
	);

	$controls['tisara_wc_heading_product_upsells'] = array(
		'label'				=> esc_html__( 'Up-Sells Products', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_product_upsells',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'heading',
		'priority'   		=> 40,
	);

	$controls['tisara_wc_product_upsells_disable'] = array(
		'label'				=> esc_html__( 'DISABLE upsells products (if any)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_upsells_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'priority'   		=> 40,
	);

	$controls['tisara_wc_product_upsells_title_color'] = array(
		'label'				=> esc_html__( 'Title Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_upsells_title_color',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.upsells.products > h2 { color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_product_upsells_is_active',
		'priority'   		=> 40,
	);

	$controls['tisara_wc_product_upsells_columns'] = array(
		'label'				=> esc_html__( '(Max) Number of products to show', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_upsells_columns',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'radio-buttonset',
		'choices'			=> array(
			'6' => '6',
			'5' => '5',
			'4' => '4',
			'3' => '3',
			'2' => '2',
			'1' => '1',
		),
		'active_callback'	=> 'tisara_wc_callback_product_upsells_is_active',
		'priority'   		=> 40,
	);

	$controls['tisara_wc_heading_product_related'] = array(
		'label'				=> esc_html__( 'Related Products', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_product_related',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'heading',
		'priority'   		=> 50,
	);

	$controls['tisara_wc_product_related_disable'] = array(
		'label'				=> esc_html__( 'DISABLE related products (if any)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_related_disable',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'checkbox',
		'priority'   		=> 50,
	);

	$controls['tisara_wc_product_related_title_color'] = array(
		'label'				=> esc_html__( 'Title Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_related_title_color',
		'section'			=> 'tisara_wc_section_product',
		'type'   			=> 'color',
		'style'    			=> '.related.products > h2 { color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_product_related_is_active',
		'priority'   		=> 50,
	);

	$controls['tisara_wc_product_related_columns'] = array(
		'label'				=> esc_html__( '(Max) Number of products to show', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_product_related_columns',
		'section'			=> 'tisara_wc_section_product',
		'type'				=> 'radio-buttonset',
		'choices'			=> array(
			'6' => '6',
			'5' => '5',
			'4' => '4',
			'3' => '3',
			'2' => '2',
			'1' => '1',
		),
		'active_callback'	=> 'tisara_wc_callback_product_related_is_active',
		'priority'   		=> 50,
	);

	return $controls;
}

/**
 * WooCommerce - Cart Page
 */
add_filter( 'tisara_customize_controls', 'tisara_wc_customize_controls_cart' );
function tisara_wc_customize_controls_cart( $controls ) {

	$controls['tisara_wc_section_cart'] = array(
		'title'    => esc_html__( 'WC - Cart Page', 'tisara-wp' ),
		'description' => '<p class="tisara-alert tisara-alert-success tisara-alert-with-icon">
							<span class="dashicons dashicons-megaphone"></span> '.esc_html__( 'Sidebar is automatically disabled on Cart page', 'tisara-wp' ).'
							</p>',
		'setting'  => 'tisara_wc_section_cart',
		'panel'    => 'tisara_wc_panel_settings',
		'type'     => 'section',
		'priority' => 40,
	);

	$controls['tisara_wc_heading_cart_coupon'] = array(
		'label'				=> esc_html__( 'Coupon Form', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_cart_coupon',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_cart_coupon_disable'] = array(
		'label'				=> esc_html__( 'DISABLE coupon form on Cart page', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_coupon_disable',
		'section'			=> 'tisara_wc_section_cart',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_heading_cart_button_colors'] = array(
		'label'				=> esc_html__( 'Button Colors', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-appearance"></span> <a href="javascript:wp.customize.control( \'tisara_wc_heading_button\' ).focus();">'.esc_html__( 'CLICK HERE to go to WC General settings to change WooCommerce default & primary (alt) button colors.', 'tisara-wp' ).'</a>
								</p>',
		'setting'  			=> 'tisara_wc_heading_cart_button_colors',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_heading_cart_button'] = array(
		'label'				=> esc_html__( '"Proceed to checkout" Button', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_cart_button',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_cart_button_text'] = array(
		'label'				=> esc_html__( 'Button Text', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_button_text',
		'section'			=> 'tisara_wc_section_cart',
		'type'				=> 'text',
	);

	$controls['tisara_wc_cart_button_font_size'] = array(
		'label'    			=> esc_html__( 'Font Size', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_button_font_size',
		'section'			=> 'tisara_wc_section_cart',
		'type'     			=> 'slider',
		'choices'  			=> array(
			'min' 			=> 0.5,
			'max' 			=> 2,
			'step' 			=> 0.1,
			'unit' 			=> 'rem',
		),
		'style'    			=> '#add_payment_method .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button { font-size: [value]rem }',
	);

	$controls['tisara_wc_cart_button_background'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_button_background',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'color',
		'style'    			=> '#add_payment_method .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button { background-color: [value] }',
	);

	$controls['tisara_wc_cart_button_border'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_button_border',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'color',
		'style'    			=> '#add_payment_method .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button { border-color: [value] }',
	);

	$controls['tisara_wc_cart_button_color'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_button_color',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'color',
		'style'    			=> '#add_payment_method .wc-proceed-to-checkout a.checkout-button, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button { color: [value] }',
	);

	$controls['tisara_wc_cart_button_background_hover'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_button_background_hover',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'color',
		'style'    			=> '#add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover { background-color: [value] }',
	);

	$controls['tisara_wc_cart_button_border_hover'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_button_border_hover',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'color',
		'style'    			=> '#add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover { border-color: [value] }',
	);

	$controls['tisara_wc_cart_button_color_hover'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_button_color_hover',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'color',
		'style'    			=> '#add_payment_method .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-cart .wc-proceed-to-checkout a.checkout-button:hover, .woocommerce-checkout .wc-proceed-to-checkout a.checkout-button:hover { color: [value] }',
	);

	$controls['tisara_wc_heading_cart_cross_sells'] = array(
		'label'				=> esc_html__( 'Cross-sells Products', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-warning tisara-alert-with-icon">
								<span class="dashicons dashicons-warning"></span> '.esc_html__( 'Cross-sells products will be automatically disabled when [woocommerce_checkout] shortcode is detected on cart page', 'tisara-wp' ).'
								</p>',
		'setting'  			=> 'tisara_wc_heading_cart_cross_sells',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_cart_cross_sells_disable'] = array(
		'label'				=> esc_html__( 'DISABLE cross-sells products (if any)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_cross_sells_disable',
		'section'			=> 'tisara_wc_section_cart',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_cart_cross_sells_title_color'] = array(
		'label'				=> esc_html__( 'Title Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_cross_sells_title_color',
		'section'			=> 'tisara_wc_section_cart',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce .cart-collaterals .cross-sells > h2, .woocommerce-page .cart-collaterals .cross-sells > h2 { color: [value] }',
		'active_callback'	=> 'tisara_wc_callback_cart_cross_sells_is_active',
	);

	$controls['tisara_wc_cart_cross_sells_limit'] = array(
		'label'				=> esc_html__( '(Max) Number of products to show', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_cart_cross_sells_limit',
		'section'			=> 'tisara_wc_section_cart',
		'type'				=> 'radio-buttonset',
		'choices'			=> array(
			'2' => '2',
			'4' => '4',
			'6' => '6',
			'all' => esc_html__( 'all', 'tisara-wp' ),
		),
		'active_callback'	=> 'tisara_wc_callback_cart_cross_sells_is_active',
	);

	return $controls;
}

/**
 * WooCommerce - Checkout Page
 */
add_filter( 'tisara_customize_controls', 'tisara_wc_customize_controls_checkout' );
function tisara_wc_customize_controls_checkout( $controls ) {

	$controls['tisara_wc_section_checkout'] = array(
		'title'    => esc_html__( 'WC - Checkout Page', 'tisara-wp' ),
		'description' => '<p class="tisara-alert tisara-alert-success tisara-alert-with-icon">
							<span class="dashicons dashicons-megaphone"></span> '.esc_html__( 'Sidebar is automatically disabled on Checkout page', 'tisara-wp' ).'
							</p>',
		'setting'  => 'tisara_wc_section_checkout',
		'panel'    => 'tisara_wc_panel_settings',
		'type'     => 'section',
		'priority' => 50,
	);

	$controls['tisara_wc_heading_checkout_layout'] = array(
		'label'				=> esc_html__( 'Checkout Layout', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_checkout_layout',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_checkout_layout'] = array(
		'label'				=> esc_html__( 'Checkout Layout', 'tisara-wp' ),
		'setting'			=> 'tisara_wc_checkout_layout',
		'section'			=> 'tisara_wc_section_checkout',
		'type'				=> 'radio',
		'choices'			=> array(
			''				=> esc_html__( 'Default WooCommerce Checkout Layout', 'tisara-wp' ),
			'custom'		=> esc_html__( 'Billing & Shipping (Left) + Order Review (Right)', 'tisara-wp' ),
			'wide'			=> esc_html__( 'One Column (Wide)', 'tisara-wp' ),
			'slim'			=> esc_html__( 'One Column (Slim)', 'tisara-wp' ),
		),
	);


	$controls['tisara_wc_heading_checkout_login'] = array(
		'label'				=> esc_html__( 'Login and Coupon Form', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_checkout_login',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_checkout_login_disable'] = array(
		'label'				=> esc_html__( 'DISABLE login form on Checkout page', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_login_disable',
		'section'			=> 'tisara_wc_section_checkout',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_checkout_coupon_disable'] = array(
		'label'				=> esc_html__( 'DISABLE coupon form on Checkout page', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_coupon_disable',
		'section'			=> 'tisara_wc_section_checkout',
		'type'				=> 'checkbox',
	);

	$controls['tisara_wc_heading_checkout_button_colors'] = array(
		'label'				=> esc_html__( 'Button Colors', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-appearance"></span> <a href="javascript:wp.customize.control( \'tisara_wc_heading_button\' ).focus();">'.esc_html__( 'CLICK HERE to go to WC General settings to change WooCommerce default & primary (alt) button colors.', 'tisara-wp' ).'</a>
								</p>',
		'setting'  			=> 'tisara_wc_heading_checkout_button_colors',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_heading_checkout_button'] = array(
		'label'				=> esc_html__( '"Place order" Button', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_checkout_button',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_checkout_button_text'] = array(
		'label'				=> esc_html__( 'Button Text', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_button_text',
		'section'			=> 'tisara_wc_section_checkout',
		'type'				=> 'text',
	);

	$controls['tisara_wc_checkout_button_font_size'] = array(
		'label'    			=> esc_html__( 'Font Size', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_button_font_size',
		'section'			=> 'tisara_wc_section_checkout',
		'type'     			=> 'slider',
		'choices'  			=> array(
			'min' 			=> 0.5,
			'max' 			=> 2,
			'step' 			=> 0.1,
			'unit' 			=> 'rem',
		),
		'style'    			=> '.woocommerce #payment #place_order, .woocommerce-page #payment #place_order { font-size: [value]rem }',
	);

	$controls['tisara_wc_checkout_button_background'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_button_background',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #payment #place_order, .woocommerce-page #payment #place_order { background-color: [value] }',
	);

	$controls['tisara_wc_checkout_button_border'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_button_border',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #payment #place_order, .woocommerce-page #payment #place_order { border-color: [value] }',
	);

	$controls['tisara_wc_checkout_button_color'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_button_color',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #payment #place_order, .woocommerce-page #payment #place_order { color: [value] }',
	);

	$controls['tisara_wc_checkout_button_background_hover'] = array(
		'label'				=> esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_button_background_hover',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover { background-color: [value] }',
	);

	$controls['tisara_wc_checkout_button_border_hover'] = array(
		'label'				=> esc_html__( 'Border Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_button_border_hover',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover { border-color: [value] }',
	);

	$controls['tisara_wc_checkout_button_color_hover'] = array(
		'label'				=> esc_html__( 'Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_checkout_button_color_hover',
		'section'			=> 'tisara_wc_section_checkout',
		'type'   			=> 'color',
		'style'    			=> '.woocommerce #payment #place_order:hover, .woocommerce-page #payment #place_order:hover { color: [value] }',
	);

	$controls['tisara_wc_heading_checkout_privacypolicy'] = array(
		'label'    			=> esc_html__( 'Privacy Policy', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.section( \'woocommerce_checkout\' ).focus();">'.esc_html__( 'CLICK HERE to setup Privacy Policy on checkout page', 'tisara-wp' ).'</a>
								</p>',
		'setting' 			=> 'tisara_wc_heading_checkout_privacypolicy',
		'section'			=> 'tisara_wc_section_checkout',
		'type'     			=> 'heading',
	);

	$controls['tisara_wc_heading_checkout_terms'] = array(
		'label'    			=> esc_html__( 'Terms And Conditions', 'tisara-wp' ),
		'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
								<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.section( \'woocommerce_checkout\' ).focus();">'.esc_html__( 'CLICK HERE to setup Terms And Conditions on checkout page', 'tisara-wp' ).'</a>
								</p>',
		'setting' 			=> 'tisara_wc_heading_checkout_terms',
		'section'			=> 'tisara_wc_section_checkout',
		'type'     			=> 'heading',
	);

	return $controls;
}

/**
 * WooCommerce - My Account Page
 */
add_filter( 'tisara_customize_controls', 'tisara_wc_customize_controls_myaccount' );
function tisara_wc_customize_controls_myaccount( $controls ) {

	$controls['tisara_wc_section_myaccount'] = array(
		'title'    => esc_html__( 'WC - My Account Page', 'tisara-wp' ),
		'description' => '<p class="tisara-alert tisara-alert-success tisara-alert-with-icon">
							<span class="dashicons dashicons-megaphone"></span> '.sprintf( esc_html__( 'Please edit "%s" page from WordPress Dashboard to customize the layout details using "%s" and "%s" metabox', 'tisara-wp' ), esc_html__( 'My Account', 'tisara-wp' ), esc_html__( 'Page Layout', 'tisara-wp' ), esc_html__( 'Site Header', 'tisara-wp' ) ).'
							</p>',
		'setting'  => 'tisara_wc_section_myaccount',
		'panel'    => 'tisara_wc_panel_settings',
		'type'     => 'section',
		'priority' => 60,
	);

	$controls['tisara_wc_heading_myaccount_redirect_page'] = array(
		'label'				=> esc_html__( 'Page Redirect After Login', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_heading_myaccount_redirect_page',
		'section'			=> 'tisara_wc_section_myaccount',
		'type'   			=> 'heading',
	);

	$controls['tisara_wc_myaccount_redirect_page'] = array(
		'label'				=> esc_html__( 'Redirect to a page after customer login', 'tisara-wp' ),
		'setting'  			=> 'tisara_wc_myaccount_redirect_page',
		'section'			=> 'tisara_wc_section_myaccount',
		'type'				=> 'dropdown-pages',
	);

	return $controls;
}

function tisara_wc_callback_header_product_is_active() {
	return ( tisara_theme_mod( 'tisara_header_hide' ) || tisara_theme_mod( 'tisara_wc_product_header_hide' ) ) ? false : true;
}

function tisara_wc_callback_shop_sidebar_is_active() {
	$layout = tisara_theme_mod( 'tisara_wc_shop_sidebar_layout' );
	return ( 'none' != $layout ) ? true : false;
}

function tisara_wc_callback_shop_sidebar_is_not_active() {
	$layout = tisara_theme_mod( 'tisara_wc_shop_sidebar_layout' );
	return ( 'none' == $layout ) ? true : false;
}

function tisara_wc_callback_product_sidebar_is_active() {
	$layout = tisara_theme_mod( 'tisara_wc_product_sidebar_layout' );
	return ( 'none' != $layout ) ? true : false;
}

function tisara_wc_callback_product_sidebar_is_not_active() {
	$layout = tisara_theme_mod( 'tisara_wc_product_sidebar_layout' );
	return ( 'none' == $layout ) ? true : false;
}

function tisara_wc_callback_shop_button_is_active() {
	return tisara_theme_mod( 'tisara_wc_shop_button_disable' ) ? false : true;
}

function tisara_wc_callback_shop_columns_mobile_is_active() {
	return tisara_theme_mod( 'tisara_wc_shop_columns' ) != 1 ? true : false;
}

function tisara_wc_callback_product_button_is_active() {
	return tisara_theme_mod( 'tisara_wc_product_button_disable' ) ? false : true;
}

function tisara_wc_callback_product_share_is_active() {
	return tisara_theme_mod( 'tisara_wc_product_share' ) ? true : false;
}

function tisara_wc_callback_product_upsells_is_active() {
	return tisara_theme_mod( 'tisara_wc_product_upsells_disable' ) ? false : true;
}

function tisara_wc_callback_product_related_is_active() {
	return tisara_theme_mod( 'tisara_wc_product_related_disable' ) ? false : true;
}

function tisara_wc_callback_cart_cross_sells_is_active() {
	return tisara_theme_mod( 'tisara_wc_cart_cross_sells_disable' ) ? false : true;
}

add_action( 'customize_controls_print_scripts', 'tisara_wc_customize_print_scripts', 30 );
function tisara_wc_customize_print_scripts() {
	$shop_page = wc_get_page_permalink( 'shop' );
	$cart_page = wc_get_page_permalink( 'cart' );
	$checkout_page = wc_get_page_permalink( 'checkout' );
	$myaccount_page = wc_get_page_permalink( 'myaccount' );

	$shop_section = apply_filters( 'tisara_wc_customize_preview_shop', array(
		'tisara_wc_section_general' => 'tisara_wc_section_general',
		'tisara_wc_section_shop' => 'tisara_wc_section_shop',
	) );
	$cart_section = apply_filters( 'tisara_wc_customize_preview_cart', array(
		'tisara_wc_section_cart' => 'tisara_wc_section_cart',
	) );
	$checkout_section = apply_filters( 'tisara_wc_customize_preview_checkout', array(
		'tisara_wc_section_checkout' => 'tisara_wc_section_checkout',
	) );
	$myaccount_section = apply_filters( 'tisara_wc_customize_preview_myaccount', array(
		'tisara_wc_section_myaccount' => 'tisara_wc_section_myaccount',
	) );
?>
<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
<?php if ( $shop_page && ! empty( $shop_section ) ) : foreach ( $shop_section as $section => $value ) : ?>
	wp.customize.section( '<?php echo esc_attr($section); ?>', function( section ) {
		section.expanded.bind( function( isExpanded ) {
			if ( isExpanded ) {
				wp.customize.previewer.previewUrl.set( '<?php echo esc_js( $shop_page ); ?>' );
			}
		} );
	} );
<?php endforeach; endif; ?>
<?php if ( $cart_page && ! empty( $cart_section )  ) : foreach ( $cart_section as $section => $value ) : ?>
	wp.customize.section( '<?php echo esc_attr($section); ?>', function( section ) {
		section.expanded.bind( function( isExpanded ) {
			if ( isExpanded ) {
				wp.customize.previewer.previewUrl.set( '<?php echo esc_js( $cart_page ); ?>' );
			}
		} );
	} );
<?php endforeach; endif; ?>
<?php if ( $checkout_page && ! empty( $checkout_section ) ) : foreach ( $checkout_section as $section => $value ) : ?>
	wp.customize.section( '<?php echo esc_attr($section); ?>', function( section ) {
		section.expanded.bind( function( isExpanded ) {
			if ( isExpanded ) {
				wp.customize.previewer.previewUrl.set( '<?php echo esc_js( $checkout_page ); ?>' );
			}
		} );
	} );
<?php endforeach; endif; ?>
<?php if ( $myaccount_page && ! empty( $myaccount_section ) ) : foreach ( $myaccount_section as $section => $value ) : ?>
	wp.customize.section( '<?php echo esc_attr($section); ?>', function( section ) {
		section.expanded.bind( function( isExpanded ) {
			if ( isExpanded ) {
				wp.customize.previewer.previewUrl.set( '<?php echo esc_js( $myaccount_page ); ?>' );
			}
		} );
	} );
<?php endforeach; endif; ?>
} );
</script>
<?php
}

add_action( 'customize_controls_print_scripts', 'tisara_wc_customize_scripts_preview_product', 30 );
function tisara_wc_customize_scripts_preview_product() {
	$product_ids = get_posts( array(
		'posts_per_page' => 1,
		'post_type' => 'product',
		'orderby' => 'date',
		'order' => 'ASC',
		'meta_query' => array(
			array(
				'key'     => '_layout_custom',
				'value'   => '',
				'compare' => 'NOT EXISTS',
			),
			array(
				'key'     => '_elementor_edit_mode',
				'value'   => '',
				'compare' => 'NOT EXISTS',
			),
			array(
				'key'     => '_wp_page_template',
				'value'   => '',
				'compare' => 'NOT EXISTS',
			),
		),
		'fields' => 'ids',
	) );
	$product_url = !empty( $product_ids ) ? get_permalink( reset( $product_ids ) ) : '';
	$product_section = apply_filters( 'tisara_wc_customize_preview_product', array(
		'tisara_wc_section_product' => 'tisara_wc_section_product',
	) );
	if ( empty( $product_url ) ) {
		return;
	}
	if ( empty( $product_section ) ) {
		return;
	}
?>
<script type="text/javascript">
jQuery( document ).ready( function( $ ) {
<?php foreach ( $product_section as $section => $value ) : ?>
	wp.customize.section( '<?php echo esc_attr($section); ?>', function( section ) {
		section.expanded.bind( function( isExpanded ) {
			if ( isExpanded ) {
				wp.customize.previewer.previewUrl.set( '<?php echo esc_js( $product_url ); ?>' );
			}
		} );
	} );
<?php endforeach; ?>
} );
</script>
<?php
}
