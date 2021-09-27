<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( tisara_theme_mod( 'tisara_footer_logo_hide' ) ) {
	return;
}

$footer_logo = tisara_theme_mod( 'tisara_footer_logo' );
$footer_logo_title = get_bloginfo( 'name' );
if ( empty( $footer_logo ) ) {
	$footer_logo = get_template_directory_uri().'/assets/img/logo-footer.png';
}
?>
<div class="footer-logo">
	<a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_attr( $footer_logo_title ); ?>">
		<img src="<?php echo esc_url( $footer_logo ); ?>" alt="<?php echo esc_attr( $footer_logo_title ); ?>" />
	</a>
</div>
