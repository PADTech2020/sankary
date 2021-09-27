<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( is_front_page() ) {
	return;
}

$breadcrumb_hide = tisara_theme_mod( 'tisara_breadcrumb_hide' ) ? true : false;
if ( $breadcrumb_hide ) {
	return;
}

if ( class_exists('Tisara_Metabox') ) {
	if ( is_page() || is_singular() ) {
		$breadcrumb_hide = get_post_meta( get_the_ID() , '_breadcrumb_hide', true );
		if ( $breadcrumb_hide ) {
			return;
		}
	}
}
?>

<?php if ( function_exists('is_woocommerce') && is_woocommerce() ) : ?>
	
	<?php 
	woocommerce_breadcrumb(
		array(
			'delimiter'   => ' <span class="breadcrumb-separator">&#47;</span> ',
			'wrap_before' => '<nav class="breadcrumbs breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => esc_html__( 'Home', 'tisara-wp' ),
		)
	);
	?>

<?php else : ?>
	
	<?php 
	tisara_breadcrumb(
		array(
			'delimiter'   => ' <span class="breadcrumb-separator">&#47;</span> ',
			'wrap_before' => '<nav class="breadcrumbs breadcrumb">',
			'wrap_after'  => '</nav>',
			'before'      => '',
			'after'       => '',
			'home'        => esc_html__( 'Home', 'tisara-wp' ),
		)
	);
	?>

<?php endif; ?>
