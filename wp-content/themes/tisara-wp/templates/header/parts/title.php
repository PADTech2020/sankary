<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 
?>

<?php if ( function_exists('is_woocommerce') && is_woocommerce() ) : ?>

	<?php if ( is_product() ) : ?>

		<div class="page-title h1">
			<?php woocommerce_page_title(); ?>
		</div>

	<?php else : ?>

		<h1 class="page-title h1">
			<?php woocommerce_page_title(); ?>
		</h1>

	<?php endif; ?>

<?php elseif ( is_singular() ) : ?>

	<?php 
	$post_type = get_post_type();
	if ( is_singular('post') || is_singular('attachment') ) {
		$title_mode = tisara_theme_mod( 'tisara_single_title' );
		$title_custom = tisara_theme_mod( 'tisara_single_title_custom' );
	}
	else {
		$title_mode = tisara_theme_mod( 'tisara_'.$post_type.'_title' );
		$title_custom = tisara_theme_mod( 'tisara_'.$post_type.'_title_custom' );
	}
	if ( empty( $title_custom ) ) {
		if ( is_page() || is_singular('post') || is_singular('attachment') ) {
			$title_custom = get_bloginfo( 'name' );
		}
		else {
			$post_type_object = get_post_type_object( get_post_type() );
			if ( isset( $post_type_object->labels->singular_name ) ) {
				$title_custom = $post_type_object->labels->singular_name;
			}
			elseif ( isset( $post_type_object->labels->name ) ) {
				$title_custom = $post_type_object->labels->name;
			}
		}
	}
	?>

	<?php if ( $title_mode == 'custom' && !empty( $title_custom ) ) : ?>

		<div class="page-title h1">
			<?php echo esc_html( $title_custom ); ?>
		</div>

	<?php else : ?>

		<h1 class="page-title h1">
			<?php single_post_title(); ?>
		</h1>

	<?php endif; ?>

<?php else : ?>
	
	<?php if ( ! is_404() ): ?>
		<h1 class="page-title h1">

			<?php if ( is_category() ) : ?>

				<?php single_cat_title(); ?>

			<?php elseif ( is_tag() ) : ?>

				<?php single_tag_title(); ?>

			<?php elseif ( is_tax() ) : ?>

				<?php single_term_title(); ?>

			<?php elseif ( is_post_type_archive() ) : ?>

				<?php post_type_archive_title(); ?>

			<?php elseif ( is_year() ) : ?>

				<?php echo get_the_time( 'Y', 'tisara-wp' ); ?>

			<?php elseif ( is_month() ) : ?>

				<?php echo get_the_time( 'F Y', 'tisara-wp' ); ?>

			<?php elseif ( is_day() ) : ?>

				<?php echo get_the_time( 'F d, Y', 'tisara-wp' ); ?>

			<?php elseif ( is_author() ) : ?>

				<?php the_author_meta( 'display_name', get_query_var( 'author' ) ); ?>

			<?php elseif ( is_search() ) : ?>

				<?php esc_html_e( 'Search Results', 'tisara-wp' ); ?>

			<?php else : ?>

				<?php echo get_bloginfo( 'name' ); ?>

			<?php endif; ?>

		</h1>
	<?php endif ?>

<?php endif; ?>
