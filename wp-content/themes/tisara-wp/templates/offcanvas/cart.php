<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$header_cart = tisara_theme_mod( 'tisara_header_bottom_cart_hide' ) ? false : true;
if ( !$header_cart ) {
	return;
}
if ( !class_exists('WooCommerce') ) {
	return;
}
?>
<div class="offcanvas-side offcanvas-cart offcanvas-push-right">
	<button class="offcanvas-menu-close">
		<!-- <i class="ti-arrow-right"></i> -->
		<svg xmlns="https://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 448 512"><path d="M190.5 66.9l22.2-22.2c9.4-9.4 24.6-9.4 33.9 0L441 239c9.4 9.4 9.4 24.6 0 33.9L246.6 467.3c-9.4 9.4-24.6 9.4-33.9 0l-22.2-22.2c-9.5-9.5-9.3-25 .4-34.3L311.4 296H24c-13.3 0-24-10.7-24-24v-32c0-13.3 10.7-24 24-24h287.4L190.9 101.2c-9.8-9.3-10-24.8-.4-34.3z"/></svg>
	</button>
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<?php if ( class_exists( 'WC_Widget_Cart' ) ) : ?>
			<?php 
			the_widget( 
				'WC_Widget_Cart',
				array( 
					'title' => '',
				)
			); 
			?>
		<?php endif; ?>
	<?php endif; ?>
</div>
