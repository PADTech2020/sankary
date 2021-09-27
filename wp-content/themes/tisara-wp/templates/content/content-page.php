<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class('entry-page'); ?>>
	<header class="entry-header">
		<?php if ( tisara_theme_mod( 'tisara_page_image' ) ) : ?>
			<?php the_post_thumbnail(); ?>
		<?php endif; ?>
		<?php if ( tisara_theme_mod( 'tisara_page_title' ) == 'custom' ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
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

<?php if ( tisara_theme_mod( 'tisara_page_comments' ) && comments_open() ) : ?>
	<?php comments_template(); ?>
<?php endif; ?>
