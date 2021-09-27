<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$header_logo_type = tisara_theme_mod( 'tisara_header_logo_type', 'image' );
$header_logo_title = get_bloginfo( 'name' );
if ( 'text' != $header_logo_type ) {
	if ( has_custom_logo() ) {
		$header_logo_image = wp_get_attachment_url( tisara_theme_mod( 'custom_logo' ) );
	}
	else {
		$header_logo_image = get_template_directory_uri().'/assets/img/logo.png';
	}
}
?>
<div class="header-logo">
	<?php if ( 'text' == $header_logo_type ) : ?>
		<div class="site-title">
			<a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_attr( $header_logo_title ); ?>">
				<?php echo esc_html( $header_logo_title ); ?>
			</a>
		</div>
	<?php else : ?>
		<div class="site-logo">
			<a href="<?php echo esc_url( get_home_url('/') ); ?>" title="<?php echo esc_attr( $header_logo_title ); ?>">
				<img src="<?php echo esc_url( $header_logo_image ); ?>" alt="<?php echo esc_attr( $header_logo_title ); ?>" />
			</a>
		</div>
	<?php endif; ?>
</div>
