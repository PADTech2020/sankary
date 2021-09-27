<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$hero_hide = tisara_theme_mod( 'tisara_hero_hide' ) ? true : false;
if ( $hero_hide ) {
	return;
}

if ( class_exists('Tisara_Metabox') ) {
	if ( is_page() || is_singular() ) {
		$hero_hide = get_post_meta( get_the_ID() , '_hero_hide', true );
		if ( $hero_hide ) {
			return;
		}
	}
}
?>

<div class="site-hero">
	<div class="container">
		<?php get_template_part( 'templates/header/parts/title' ); ?>
		<?php get_template_part( 'templates/header/parts/breadcrumb' ); ?>
	</div>
</div>
