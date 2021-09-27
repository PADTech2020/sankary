<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>
<footer class="site-footer site-footer-style-2">
	<?php get_template_part( 'templates/footer/parts/widgets' ); ?>
	<?php if ( ! tisara_theme_mod( 'tisara_footer_bottom_hide' ) ) : ?>
	<div class="footer-bottom">
		<div class="container">
			<div class="footer-bottom-1">
				<?php get_template_part( 'templates/footer/parts/logo' ); ?>
				<?php get_template_part( 'templates/footer/parts/social' ); ?>
			</div>
			<div class="footer-bottom-2">
				<?php get_template_part( 'templates/footer/parts/menu' ); ?>
				<?php get_template_part( 'templates/footer/parts/text' ); ?>
			</div>
		</div>
	</div>
	<?php endif; ?>
</footer>
