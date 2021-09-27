<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( is_product() ) {
	$sidebar_layout = tisara_theme_mod( 'tisara_wc_product_sidebar_layout' );
	if ( class_exists('Tisara_Metabox') ) {
		$sidebar_layout_meta = get_post_meta( get_the_ID(), '_sidebar_layout', true );
		if ( $sidebar_layout_meta ) {
			$sidebar_layout = $sidebar_layout_meta;
		}
	}
}
else {
	$sidebar_layout = tisara_theme_mod( 'tisara_wc_shop_sidebar_layout' );
}

if ( empty( $sidebar_layout ) ) {
	$sidebar_layout = 'none';
}
?>

<div id="content" class="site-content sidebar-layout-<?php echo esc_attr( $sidebar_layout ); ?>">
	<div class="container">
		<section id="primary" class="content-area">
