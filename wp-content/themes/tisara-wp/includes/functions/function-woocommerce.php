<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists('WooCommerce') ) {
	return;
}

/**
 * WooCommerce Wrapper Start
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
add_action( 'woocommerce_before_main_content', 'tisara_wc_wrapper_start', 10 );
function tisara_wc_wrapper_start() {
	get_template_part( 'templates/wc/wrapper-start' );
}

/**
 * WooCommerce Wrapper End
 */
remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );
add_action( 'woocommerce_after_main_content', 'tisara_wc_wrapper_end', 10 );
function tisara_wc_wrapper_end() {
	get_template_part( 'templates/wc/wrapper-end' );
}

/**
 * Breadcrumb - Move To Header
 */
remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

/**
 * Page Title - No Longer Needed
 */
add_filter( 'woocommerce_show_page_title', '__return_false' );

/**
 * Sidebar - Use Theme Sidebar
 */
remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

/**
 * Product Search Form
 */
add_filter( 'get_product_search_form', 'tisara_wc_get_product_search_form' );
function tisara_wc_get_product_search_form( $form ) {
	$form = preg_replace( '#<button(.*?)</button>#', '', $form );
	$form = str_replace( '</form>', '<button class="search-button" type="submit" value="'.esc_attr( 'Search', 'woocommerce' ).'"><svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg></button></form>', $form );
	return $form;
}

/**
 * Shop Catalog - Markup Open
 */
add_action( 'woocommerce_before_shop_loop_item', 'tisara_wc_shop_catalog_markup_open', 1 );
function tisara_wc_shop_catalog_markup_open() {
	echo '<div class="product-inner"><div class="product-image-box">';
}

/**
 * Shop Catalog - Markup Middle 1
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'tisara_wc_shop_catalog_markup_middle1', 998 );
function tisara_wc_shop_catalog_markup_middle1() {
	echo '</a></div><div class="product-detail-box">';
}

/**
 * Shop Catalog - Markup Middle 2
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'tisara_wc_shop_catalog_markup_middle2', 999 );
function tisara_wc_shop_catalog_markup_middle2() {
	echo '<a href="' . get_permalink() . '" class="product-detail-link">';
}

/**
 * Shop Catalog - Markup Close
 */
add_action( 'woocommerce_after_shop_loop_item', 'tisara_wc_shop_catalog_markup_close', 999 );
function tisara_wc_shop_catalog_markup_close() {
	echo '</div></div>';
}

/* Shop Page - Products Per Page */
add_filter( 'loop_shop_per_page', 'tisara_wc_shop_products_per_page', 20 );
function tisara_wc_shop_products_per_page( $per_page ) {
	$per_page = intval( tisara_theme_mod( 'tisara_wc_shop_per_page' ) );
	if ( $per_page < 1 ) $per_page = 12;
	return $per_page;
}

/* Shop Page - Number of Products Columns Per Row */
add_filter( 'loop_shop_columns', 'tisara_wc_shop_columns', 20 );
function tisara_wc_shop_columns( $columns ) {
	$columns = intval( tisara_theme_mod( 'tisara_wc_shop_columns' ) );
	if ( $columns < 1 ) $columns = 4;
	if ( $columns > 6 ) $columns = 6;
	return $columns;
}

/* Shop Page - Number of Products Columns Per Row (Mobile) */
add_filter( 'woocommerce_product_loop_start', 'tisara_wc_product_loop_start', 10 );
function tisara_wc_product_loop_start( $loop_start ) {
	$columns = intval( tisara_theme_mod( 'tisara_wc_shop_columns' ) );
	$columns_mobile = intval( tisara_theme_mod( 'tisara_wc_shop_columns_mobile' ) );
	if ( $columns_mobile < 1 ) $columns_mobile = 2;
	if ( $columns_mobile > 2 ) $columns_mobile = 2;
	if ( $columns == 1 ) $columns_mobile = 1;
	$loop_start = str_replace( 'class="products ', 'class="products columns-mobile-'.$columns_mobile.' ', $loop_start );
	return $loop_start;
}

/* Shop Catalog - Sale Flash */
add_filter( 'woocommerce_sale_flash', 'tisara_wc_sale_flash', 10, 3 );
function tisara_wc_sale_flash( $sale_flash, $post, $product ) {
	$sale_flash_new = tisara_theme_mod( 'tisara_wc_saleflash_text' );
	if ( ! empty( $sale_flash_new ) ) {
		return '<span class="onsale">' . esc_html( $sale_flash_new ) . '</span>';
	}
	return $sale_flash;
}

/**
 * Shop Catalog - Soldout Flash
 */
add_action( 'woocommerce_before_shop_loop_item_title', 'tisara_wc_show_product_soldout_flash', 10 );
add_action( 'woocommerce_before_single_product_summary', 'tisara_wc_show_product_soldout_flash', 10 );
function tisara_wc_show_product_soldout_flash() {
	global $product;
	if ( ! $product->is_in_stock() ) {
		$soldout_text = tisara_theme_mod( 'tisara_wc_soldout_text' );
		if ( empty( $soldout_text ) ) {
			$soldout_text = esc_html__( 'Sold out!', 'tisara-wp' );
		}
		$soldout_text = apply_filters( 'tisara_wc_soldout_text', $soldout_text );
		echo '<span class="onsale soldout">'.esc_html( $soldout_text ).'</span>';
	}
}

/**
 * Shop Catalog - Remove Sale Flash When Soldout
 */
add_filter( 'woocommerce_sale_flash', 'tisara_wc_hide_sale_flash_soldout', 999 );
function tisara_wc_hide_sale_flash_soldout( $output ) {
	global $product;
	if ( ! $product->is_in_stock() ) {
		return false;
	}
	return $output;
}

/**
 * Shop Page - Product Title
 */
if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		if ( tisara_theme_mod( 'tisara_wc_shop_title_truncate' ) ) {
			echo '<h2 class="woocommerce-loop-product__title text-truncate">' . get_the_title() . '</h2>';
		}
		else {
			echo '<h2 class="woocommerce-loop-product__title">' . get_the_title() . '</h2>';
		}
	}
}

/**
 * Shop Page Setup
 */
add_action( 'wp', 'tisara_wc_setup_shop_page' );
function tisara_wc_setup_shop_page() {

	/* Shop Page - Results Count */
	if ( tisara_theme_mod( 'tisara_wc_shop_result_count_disable' ) ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
	}

	/* Shop Page - Catalog Ordering */
	if ( tisara_theme_mod( 'tisara_wc_shop_catalog_ordering_disable' ) ) {
		remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30 );
	}

	/* Shop Page - Sale Flash */
	if ( tisara_theme_mod( 'tisara_wc_shop_saleflash_disable' ) ) {
		remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
	}

	/* Shop Page - Product Title */
	if ( tisara_theme_mod( 'tisara_wc_shop_title_disable' ) ) {
		remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
	}

	/* Shop Page - Product Rating */
	if ( tisara_theme_mod( 'tisara_wc_shop_rating_disable' ) ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
	}

	/* Shop Page - Product Price */
	if ( tisara_theme_mod( 'tisara_wc_shop_price_disable' ) ) {
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
	}

	/* Shop Page - Product "Add To Cart" Button */
	if ( tisara_theme_mod( 'tisara_wc_shop_button_disable' ) ) {
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
	}
	else {
		add_filter ( 'woocommerce_loop_add_to_cart_args', 'tisara_wc_loop_add_to_cart_args' );
	}

	/* Shop Page - Hide Product Detail Link When All Hidden  */
	if ( tisara_theme_mod( 'tisara_wc_shop_title_disable' ) && tisara_theme_mod( 'tisara_wc_shop_rating_disable' ) && tisara_theme_mod( 'tisara_wc_shop_price_disable' ) ) {
		remove_action( 'woocommerce_before_shop_loop_item_title', 'tisara_wc_shop_catalog_markup_middle2', 999 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
	}

	do_action( 'tisara_wc_setup_shop_page' );
}

/**
 * Single Product - Markup Open
 */
add_action( 'woocommerce_before_single_product_summary', 'tisara_wc_product_markup_open', 1 );
function tisara_wc_product_markup_open() {
	echo '<div class="single-product-inner clearfix">';
}

/**
 * Single Product - Markup Close
 */
add_action( 'woocommerce_after_single_product_summary', 'tisara_wc_product_markup_close', 14 );
function tisara_wc_product_markup_close() {
	echo '</div>';
}

/**
 * Single Product Setup
 */
add_action( 'wp', 'tisara_wc_setup_product_page' );
function tisara_wc_setup_product_page() {

	/* Single Product - Sale Flash */
	if ( tisara_theme_mod( 'tisara_wc_product_saleflash_disable' ) ) {
		remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );
	}

	/* Single Product - Rating */
	if ( tisara_theme_mod( 'tisara_wc_product_rating_disable' ) ){
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10 );
	}

	/* Single Product - Price */
	if ( tisara_theme_mod( 'tisara_wc_product_price_disable' ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
	}

	/* Single Product - Short Description */
	if ( tisara_theme_mod( 'tisara_wc_product_excerpt_disable' ) ){
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
	}

	/* Single Product - Add To Cart */
	add_action( 'woocommerce_single_product_summary', 'tisara_wc_product_button_group_markup_open', 28 );
	if ( tisara_theme_mod( 'tisara_wc_product_button_disable' ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
	}
	else {
		add_action( 'woocommerce_after_add_to_cart_quantity', 'tisara_wc_product_button_markup_open_qty', 98 );
		add_action( 'woocommerce_before_add_to_cart_button', 'tisara_wc_product_button_markup_open_noqty', 98 );
		add_action( 'woocommerce_after_add_to_cart_button', 'tisara_wc_product_button_markup_close', 2 );
	}
	add_action( 'woocommerce_single_product_summary', 'tisara_wc_product_button_group_markup_close', 32 );

	/* Single Product - Meta */
	if ( tisara_theme_mod( 'tisara_wc_product_meta_disable' ) ) {
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
	}

	/* Single Product - Social Share */
	if ( tisara_theme_mod( 'tisara_wc_product_share' ) ) {
		add_action( 'woocommerce_single_product_summary', 'tisara_wc_product_social_share_output', 45 );
	}

	if ( is_product() ) {
		/* Single Product - Upsells */
		if ( tisara_theme_mod( 'tisara_wc_product_upsells_disable' ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
		}

		/* Single Product - Related */
		if ( tisara_theme_mod( 'tisara_wc_product_related_disable' ) ) {
			remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
		}
	}

	do_action( 'tisara_wc_setup_product_page' );
}

/**
 * Product Social Share
 */
function tisara_wc_product_social_share_output() {
	
}

/**
 * Product Tabs Filter
 */
add_filter( 'woocommerce_product_tabs', 'tisara_wc_product_tabs', 99 );
function tisara_wc_product_tabs( $tabs ) {

	/* Single Product - Tabs - Description */
	$title = tisara_theme_mod( 'tisara_wc_product_tab_description_title' );
	if ( ! empty( $title ) && isset( $tabs['description'] ) ) {
		$tabs['description']['title'] = $title;
	}

	if ( tisara_theme_mod( 'tisara_wc_product_tab_description_disable' ) ) {
		unset( $tabs['description'] );
	}

	/* Single Product - Tabs - Attributes */
	$title = tisara_theme_mod( 'tisara_wc_product_tab_attributes_title' );
	if ( ! empty( $title ) && isset( $tabs['additional_information'] ) ) {
		$tabs['additional_information']['title'] = $title;
	}

	if ( tisara_theme_mod( 'tisara_wc_product_tab_attributes_disable' ) ) {
		unset( $tabs['additional_information'] );
	}

	/* Single Product - Tabs - Reviews */
	$title = tisara_theme_mod( 'tisara_wc_product_tab_reviews_title' );
	if ( ! empty( $title ) && isset( $tabs['reviews'] ) ) {
		$tabs['reviews']['title'] = $title;
	}

	if ( tisara_theme_mod( 'tisara_wc_product_tab_reviews_disable' ) ) {
		unset( $tabs['reviews'] );
	}

	return $tabs;
}

/**
 * Upsell Products Filter
 */
add_filter( 'woocommerce_upsell_display_args', 'tisara_wc_upsell_display_args', 99 );
function tisara_wc_upsell_display_args( $args ) {
	$columns = intval( tisara_theme_mod( 'tisara_wc_product_upsells_columns' ) );
	if ( $columns > 6 ) $columns = 6;
	if ( $columns ) {
		$args['posts_per_page'] = $columns;
		$args['columns'] = $columns;
	}
	return $args;
}

/**
 * Related Products Filter
 */
add_filter( 'woocommerce_output_related_products_args', 'tisara_wc_related_products_args', 99 );
function tisara_wc_related_products_args( $args ) {
	$columns = intval( tisara_theme_mod( 'tisara_wc_product_related_columns' ) );
	if ( $columns > 6 ) $columns = 6;
	if ( $columns ) {
		$args['posts_per_page'] = $columns;
		$args['columns'] = $columns;
	}
	return $args;
}

/**
 * Remove Product Description Heading
 */
add_filter( 'woocommerce_product_description_heading', 'tisara_wc_product_description_heading' );
function tisara_wc_product_description_heading( $heading ) {
	return false;
}

/**
 * Cart Page Setup
 */
add_action( 'wp', 'tisara_wc_setup_cart_page' );
function tisara_wc_setup_cart_page() {
	/* Hide Coupon Form on Cart */
	if ( is_cart() && tisara_theme_mod( 'tisara_wc_cart_coupon_disable' ) ) {
		add_filter( 'woocommerce_coupons_enabled', '__return_false' );
	}
	/* Remove Cross Sells in Cart Page */
	if ( tisara_theme_mod( 'tisara_wc_cart_cross_sells_disable' ) ) {
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	}
}

/**
 * Cross Sells Products Filter
 */
add_filter( 'woocommerce_cross_sells_total', 'tisara_wc_cross_sells_total', 99 );
function tisara_wc_cross_sells_total( $limit ) {
	$limit_new = intval( tisara_theme_mod( 'tisara_wc_cart_cross_sells_limit' ) );
	if ( $limit_new > 0 ) {
		return $limit_new;
	}
	return $limit;
}

/* Checkout Page - Checkout Layout Class */
add_filter( 'body_class', 'tisara_wc_body_class_checkout' );
function tisara_wc_body_class_checkout( $classes ) {
	$checkout_layout = tisara_theme_mod( 'tisara_wc_checkout_layout' );
	if ( empty( $checkout_layout ) ) {
		$checkout_layout = 'default';
	}
	$classes[] = 'kn-checkout-' . trim( $checkout_layout );
	return $classes;
}

/**
 * Checkout Page Setup
 */
add_action( 'wp', 'tisara_wc_setup_checkout_page' );
function tisara_wc_setup_checkout_page() {
	/* Hide Login Form on Checkout */
	if ( tisara_theme_mod( 'tisara_wc_checkout_login_disable' ) ) {
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
	}
	/* Hide Coupon Form on Checkout */
	if ( tisara_theme_mod( 'tisara_wc_checkout_coupon_disable' ) ) {
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
	}
	/* Auto Hide Coupon Form */
	if ( is_cart() && is_checkout() ) {
		remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );
	}
}

/**
 * My Account - Login Redirect
 */
add_filter( 'woocommerce_login_redirect', 'tisara_wc_login_redirect' );
function tisara_wc_login_redirect( $redirect_to ) {
	if ( $page_id = tisara_theme_mod( 'tisara_wc_myaccount_redirect_page' ) ) {
		$redirect_to = get_permalink( $page_id );
	}
	return $redirect_to;
}

/**
 * Cart Fragments - MiniCart 
 */
add_filter('woocommerce_add_to_cart_fragments', 'tisara_wc_add_to_cart_fragment_minicart');
function tisara_wc_add_to_cart_fragment_minicart( $fragments ) {
	$cart_count = WC()->cart->get_cart_contents_count();
	$fragments['.header-cart-count'] = '<span class="header-cart-count">'.esc_html($cart_count).'</span>';
	return $fragments;
}

/**
 * Shop Catalog - AddToCart Button Text
 */
add_filter( 'woocommerce_product_add_to_cart_text' , 'tisara_wc_shop_button_text' );
function tisara_wc_shop_button_text( $text ) {
	global $product;
	if ( ! is_a( $product, 'WC_Product' ) ) {
		return $text;
	}
	if ( ! $product->is_in_stock() ) {
		if ( $text_new = tisara_theme_mod('tisara_wc_shop_button_text_outofstock') ) {
			return $text_new;
		}
		return $text;
	}
	$product_type = $product->get_type();
	switch ( $product_type ) {
		case 'external':
			return $text;
		break;
		case 'grouped':
			return $text;
		break;
		case 'simple':
			if ( $text_new = tisara_theme_mod('tisara_wc_shop_button_text_simple') ) {
				return $text_new;
			}
			return $text;
		break;
		case 'variable':
			if ( $text_new = tisara_theme_mod('tisara_wc_shop_button_text_variable') ) {
				return $text_new;
			}
			return $text;
		break;
		default:
			return $text;
	}
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'tisara_wc_product_button_text' ); 
function tisara_wc_product_button_text( $text ) {
	if ( $text_new = tisara_theme_mod('tisara_wc_product_button_text') ) {
		return $text_new;
	}
	return $text;
}

add_filter( 'woocommerce_product_single_add_to_cart_text', 'tisara_wc_product_button_text_external', 25 ); 
function tisara_wc_product_button_text_external( $text ) {
	global $product;
	if ( 'external' == $product->get_type() ) {
		if ( $text_new = $product->get_button_text() ) {
			return $text_new;
		}
	}
	return $text;
}

function woocommerce_button_proceed_to_checkout() {
	if ( $text_new = tisara_theme_mod('tisara_wc_cart_button_text') ) {
		echo '<a href="'.esc_url( wc_get_checkout_url() ).'" class="checkout-button button alt wc-forward">'.$text_new.'</a>';
	}
	else {
		wc_get_template( 'cart/proceed-to-checkout-button.php' );
	}
}

add_filter( 'woocommerce_order_button_text', 'tisara_wc_checkout_button_text' ); 
function tisara_wc_checkout_button_text( $text ) {
	if ( $text_new = tisara_theme_mod('tisara_wc_checkout_button_text') ) {
		return $text_new;
	}
	return $text;
}

function tisara_wc_product_button_group_markup_open() {
	$class = 'woocommerce-product-button-group';
	$class = apply_filters( 'tisara_wc_product_button_group_class', $class );
	echo '<div class="'.esc_attr($class).' clearfix">';
}

function tisara_wc_product_button_group_markup_close() {
	echo '</div>';
}

function tisara_wc_product_button_markup_open_qty() {
	global $product;
	if ( in_array( $product->get_type(), array( 'simple', 'variable' ) ) ) {
		echo '<div class="woocommerce-product-button clearfix">';
	}
}

function tisara_wc_product_button_markup_open_noqty() {
	global $product;
	if ( ! in_array( $product->get_type(), array( 'simple', 'variable' ) ) ) {
		echo '<div class="woocommerce-product-button clearfix">';
	}
}

function tisara_wc_product_button_markup_close() {
	echo '</div>';
}

function tisara_wc_loop_add_to_cart_args( $args ) {
	if ( isset( $args['class'] ) ) {
		$args['class'] .= ' button-shop-addtocart';
	}
	return $args;
}

add_filter( 'tisara_style', 'tisara_wc_inline_css' );
function tisara_wc_inline_css( $style ) {
	if ( true === wc_string_to_bool( get_option( 'woocommerce_checkout_highlight_required_fields', 'yes' ) ) ) {
		$style = $style.' .woocommerce form .form-row .required { visibility: visible; } ';
	} 
	else {
		$style = $style.' .woocommerce form .form-row .required { visibility: hidden; } ';
	}
	return $style;
}

add_filter( 'woocommerce_get_image_size_gallery_thumbnail', 'tisara_woocommerce_single_gallery_thumbnail_size' );
function tisara_woocommerce_single_gallery_thumbnail_size( $size ) {
	return array(
	'width' => 150,
	'height' => 150,
	'crop' => 1,
	);
}