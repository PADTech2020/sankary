<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$more_link_text = tisara_theme_mod( 'tisara_blog_more_link_text' );
if ( ! $more_link_text ) {
	$more_link_text = esc_html__( 'Continue reading &hellip;', 'tisara-wp' );
}

$more_link = tisara_theme_mod( 'tisara_blog_more_link' );
if ( ! $more_link ) {
	$more_link_text = '';
}

add_filter( 'excerpt_length', 'tisara_excerpt_length_20' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-blog'); ?>>
	<div class="entry-blog-content">
		<header class="entry-header">
			<h2 class="entry-title">
				<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h2>
			<?php if ( tisara_theme_mod( 'tisara_blog_meta' ) ) : ?>
				<?php tisara_meta_output('blog'); ?>
			<?php endif; ?>
		</header>

		<div class="entry-summary">
			<?php the_excerpt(); ?>
			<?php if ( $more_link ) : ?>
				<p class="entry-more-link">
					<a href="<?php the_permalink(); ?>" class="entry-more-button more-link button">
						<?php echo esc_html( $more_link_text ); ?>
					</a>
				</p>
			<?php endif; ?>
		</div>
	</div>
</article>
