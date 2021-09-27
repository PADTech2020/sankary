<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

get_header(); ?>

<div id="content" class="site-content sidebar-layout-none">
	<div class="container">

		<section id="primary" class="content-area">

			<?php get_template_part( 'templates/content/content-notfound' ); ?>

		</section>

	</div>
</div>

<?php get_footer(); ?>
