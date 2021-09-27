<?php
/**
 * Template Name: Page Builder (Full Width)
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

get_header(); ?>

<div id="content" class="site-content">

	<?php if ( have_posts() ) : ?>

		<?php while ( have_posts() ) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>

	<?php endif; ?>

</div>

<?php get_footer(); ?>
