<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$header_search = tisara_theme_mod( 'tisara_header_bottom_search_hide' ) ? false : true;
$header_cart = tisara_theme_mod( 'tisara_header_bottom_cart_hide' ) ? false : true;
if ( class_exists('WooCommerce') ) {
	if ( is_cart() || is_checkout() ) {
		$header_cart = false;		
	}
}
else {
	$header_cart = false;
}
?>
<ul class="header-menu-addon">
	<?php if ( $header_search ) : ?>
	<li class="header-search">
		<a href="javascript:void(0)" class="header-search-trigger">
			<!-- <i class="fa fa-search"></i> -->
			<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg>
		</a>
		<?php get_template_part( 'templates/header/parts/searchform' ); ?>
	</li>
	<?php endif; ?>
	<?php if ( $header_cart && class_exists('WooCommerce') ) : ?>
	<li class="header-cart">
		<a href="javascript:void(0)">
			<!-- <i class="fa fa-shopping-cart"></i> -->
			<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 576 512"><path d="M528.12 301.319l47.273-208C578.806 78.301 567.391 64 551.99 64H159.208l-9.166-44.81C147.758 8.021 137.93 0 126.529 0H24C10.745 0 0 10.745 0 24v16c0 13.255 10.745 24 24 24h69.883l70.248 343.435C147.325 417.1 136 435.222 136 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-15.674-6.447-29.835-16.824-40h209.647C430.447 426.165 424 440.326 424 456c0 30.928 25.072 56 56 56s56-25.072 56-56c0-22.172-12.888-41.332-31.579-50.405l5.517-24.276c3.413-15.018-8.002-29.319-23.403-29.319H218.117l-6.545-32h293.145c11.206 0 20.92-7.754 23.403-18.681z"/></svg>
			<span class="header-cart-count"><?php echo WC()->cart->cart_contents_count; ?></span> 
		</a>
	</li>
	<?php endif; ?>
</ul>