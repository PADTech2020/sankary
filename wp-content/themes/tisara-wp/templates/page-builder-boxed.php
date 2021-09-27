<?php
/**
 * Template Name: Page Builder (Boxed)
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

get_header(); ?>

<div id="content" class="site-content">
	<div class="container">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>

	<?php endif; ?>

	</div>
</div>

<?php get_footer(); ?>
