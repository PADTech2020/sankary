<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

global $tisara_search_form_index;
if ( empty( $tisara_search_form_index ) ) {
	$tisara_search_form_index = 0;
}
$tisara_search_form_index++;
?>
<div class="header-search-form">
	<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
		<label class="screen-reader-text" for="search-form-field-<?php echo isset( $tisara_search_form_index ) ? absint( $tisara_search_form_index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'tisara-wp' ); ?></label>
		<input type="search" id="search-form-field-<?php echo isset( $tisara_search_form_index ) ? absint( $tisara_search_form_index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'Type a keywords and hit Enter &hellip;', 'tisara-wp' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
		<?php if ( class_exists( 'WooCommerce' ) ) : ?>
			<input type="hidden" name="post_type" value="product" />
		<?php endif; ?>
		<button class="search-button" type="submit" value="<?php echo esc_attr( 'Search', 'tisara-wp' ); ?>"><svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path d="M505 442.7L405.3 343c-4.5-4.5-10.6-7-17-7H372c27.6-35.3 44-79.7 44-128C416 93.1 322.9 0 208 0S0 93.1 0 208s93.1 208 208 208c48.3 0 92.7-16.4 128-44v16.3c0 6.4 2.5 12.5 7 17l99.7 99.7c9.4 9.4 24.6 9.4 33.9 0l28.3-28.3c9.4-9.4 9.4-24.6.1-34zM208 336c-70.7 0-128-57.2-128-128 0-70.7 57.2-128 128-128 70.7 0 128 57.2 128 128 0 70.7-57.2 128-128 128z"/></svg></button>
	</form>
</div>
