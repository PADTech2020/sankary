<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

$sidebar_layout = tisara_get_sidebar_layout();

get_header(); 
?>

<div id="content" class="site-content sidebar-layout-<?php echo esc_attr( $sidebar_layout ); ?>">
	<div class="container">

		<section id="primary" class="content-area">

			<?php if ( have_posts() ) : ?>

				<?php while ( have_posts() ) : the_post(); ?>

					<?php get_template_part( 'templates/content/content-search' ); ?>

				<?php endwhile; // End while loop. ?>

			<?php else : ?>

				<?php get_template_part( 'templates/content/content-notfound' ); ?>

			<?php endif; // End if check. ?>

			<?php get_template_part( 'templates/content/parts/pagination' ); ?>

		</section>

		<?php if ( 'none' != $sidebar_layout ) : ?>
			<?php get_sidebar(); ?>
		<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
