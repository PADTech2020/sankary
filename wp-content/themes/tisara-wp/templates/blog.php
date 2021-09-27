<?php
/**
 * Template Name: Blog Page
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$sidebar_layout = tisara_get_sidebar_layout('page');

$blog_layout = get_post_meta( get_the_ID(), '_blog_layout', true );
if ( empty( $blog_layout ) ) {
	$blog_layout = tisara_theme_mod( 'tisara_blog_layout' );
}

$blog_posts_per_page = get_post_meta( get_the_ID(), '_posts_per_page', true );
if ( empty( $blog_posts_per_page ) ) {
	$blog_posts_per_page = get_option( 'posts_per_page' );
}

if ( empty( $blog_layout ) ) {
	$blog_layout = 'default';
	$blog_template = 'content';
}
else {
	$blog_template = 'layout/'.$blog_layout;
}

get_header(); 
?>

<div id="content" class="site-content sidebar-layout-<?php echo esc_attr( $sidebar_layout ); ?>">
	<div class="container">
	
		<section id="primary" class="content-area">
			
			<?php 
			global $wp_query, $more;
			$orig_query = $wp_query;
			$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
			$args = array( 
				'post_type' => array('post'), 
				'posts_per_page' => $blog_posts_per_page, 
				'paged' => $paged 
			);
			query_posts( $args );
			$more = 0;
			?>
	
			<?php if ( have_posts() ) : ?>

				<div class="blog-layout-<?php echo esc_attr($blog_layout); ?>">

				<?php while ( have_posts() ) : the_post(); ?>
					
					<?php get_template_part( 'templates/content/'.$blog_template ); ?>

				<?php endwhile;// End while loop. ?>

				</div>

				<?php get_template_part( 'templates/content/parts/pagination' ); ?>

			<?php else : ?>

				<?php get_template_part( 'templates/content/content-notfound' ); ?>

			<?php endif; // End if check. ?>

			<?php wp_reset_query(); $orig_query = $wp_query; ?>
	
		</section>

		<?php if ( 'none' != $sidebar_layout ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
