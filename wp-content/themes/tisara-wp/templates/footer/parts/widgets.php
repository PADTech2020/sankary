<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( tisara_theme_mod( 'tisara_footer_top_hide' ) ) {
	return;
}

?>

<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) || is_active_sidebar( 'footer-4' ) ) : ?>
<div class="footer-top">
	<div class="container">
		<div class="footer-widgets-row">
			<div class="footer-widgets">
				<?php dynamic_sidebar( 'footer-1' ); ?>
			</div>
			<div class="footer-widgets">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div>
			<div class="footer-widgets">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div>
			<div class="footer-widgets">
				<?php dynamic_sidebar( 'footer-4' ); ?>
			</div>
		</div>
	</div>
</div>
<?php endif; ?>
