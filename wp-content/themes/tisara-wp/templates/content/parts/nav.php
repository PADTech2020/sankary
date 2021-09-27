<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( ! is_singular( 'post') ) {
	return;
}

if ( tisara_theme_mod( 'tisara_single_nav_hide' ) ) {
	return;
}

$previous_post 	= get_previous_post();
$next_post 		= get_next_post();
if ( ! $previous_post && ! $next_post ) {
	return;
}
?>
<div class="post-nav-area">
	<?php if ( $previous_post ) : ?>
		<div class="post-nav-prev">
			<span><?php esc_html_e( 'Previous', 'tisara-wp' ); ?></span>
			<?php previous_post_link('<p>%link</p>'); ?>
		</div>
	<?php endif; ?>
	<?php if ( $next_post ) : ?>
		<div class="post-nav-next">
			<span><?php esc_html_e( 'Next', 'tisara-wp' ); ?></span>
			<?php next_post_link('<p>%link</p>'); ?>
		</div>
	<?php endif; ?>
</div>
