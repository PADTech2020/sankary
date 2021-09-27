<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>

<aside id="secondary" class="sidebar-area sidebar-product">
	<?php if ( is_active_sidebar( 'product' ) ) : ?>
		<?php dynamic_sidebar( 'product' ); ?>
	<?php else : ?>
		<div class="widget widget_search">
			<?php get_search_form(); ?>
		</div>
		<div class="widget widget_search">
			<h3 class="widget-title">
				<?php esc_html_e( 'Archives', 'tisara-wp' ); ?>
			</h3>
			<ul>
				<?php wp_get_archives( 'type=monthly' ); ?>
			</ul>
		</div>
		<div class="widget widget_search">
			<h3 class="widget-title">
				<?php esc_html_e( 'Meta', 'tisara-wp' ); ?>
			</h3>
			<ul>
				<?php wp_register(); ?>
				<li><?php wp_loginout(); ?></li>
				<?php wp_meta(); ?>
			</ul>
		</div>
	<?php endif; ?>
</aside>
