<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-single'); ?>>
	<header class="entry-header">
		<?php if ( tisara_theme_mod( 'tisara_single_image' ) ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
		<?php if ( tisara_theme_mod( 'tisara_single_title' ) == 'custom' ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php endif; ?>
		<?php if ( tisara_theme_mod( 'tisara_single_meta' ) ) : ?>
			<?php tisara_meta_output('single'); ?>
		<?php endif; ?>
	</header>

	<div class="entry-content">
		<?php the_content(); ?>
		<?php 
		edit_post_link( 
			esc_html__( 'Edit', 'tisara-wp' ), 
			'<p class="edit-link">', 
			'</p>' 
		); 
		?>
		<?php
		wp_link_pages(
			array(
				'before' => '<p class="page-links">' . esc_html__( 'Pages:', 'tisara-wp' ),
				'after'  => '</p>',
			)
		);
		?>
	</div>
</article>

<?php get_template_part( 'templates/content/parts/extra-tags' ); ?>
<?php get_template_part( 'templates/content/parts/nav' ); ?>
<?php get_template_part( 'templates/content/parts/related' ); ?>

<?php if ( tisara_theme_mod( 'tisara_single_comments' ) ) : ?>
	<?php if ( comments_open() || '0' != get_comments_number() ) : ?>
		<?php comments_template(); ?>
	<?php endif; ?>
<?php endif; ?>
