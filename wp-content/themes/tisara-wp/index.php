<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sidebar_layout = tisara_get_sidebar_layout();

$blog_layout = tisara_theme_mod( 'tisara_blog_layout' );
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

		</section>

		<?php if ( 'none' != $sidebar_layout ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
