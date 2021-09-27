<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
?>

<article id="post-0" class="entry entry-page">
	<div class="entry-content">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( esc_html__( 'Ready to publish your first post? ', 'tisara-wp' ) . '<a href="%1$s">Get started here</a>.', esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'tisara-wp' ); ?></p>

			<?php get_search_form(); ?>

		<?php else : ?>
			 <h1 class="page-title h1">
			 	<?php esc_html_e( '404', 'tisara-wp' ); ?>
			 </h1>

			<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'tisara-wp' ); ?></p>

			<?php get_search_form(); ?>
			
			<p class="back-home">
				<a href="<?php echo esc_url( home_url('/') ); ?>" class="entry-more-button more-link button">
					<?php esc_html_e( 'HOME', 'tisara-wp' ); ?>
				</a>
			</p>
		<?php endif; ?>
	</div>
</article>
