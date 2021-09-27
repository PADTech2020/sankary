<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( tisara_theme_mod( 'tisara_footer_text_hide' ) ) {
	return;
}

$footer_text = tisara_theme_mod( 'tisara_footer_text' );
if ( empty( $footer_text ) ) {
	$footer_text = sprintf( esc_html__( 'Copyright &copy; %s', 'tisara-wp' ), date( 'Y' ) ) . ' <a class="site-link" href="' . esc_url( home_url("/") ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . get_bloginfo( 'name' ) . '</a>';
}
?>
<div class="footer-text">
	<?php echo wp_kses_post( $footer_text ); ?>
</div>
