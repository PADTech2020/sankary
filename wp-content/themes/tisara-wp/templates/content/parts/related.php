<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( ! is_singular( 'post') ) {
	return;
}

if ( tisara_theme_mod( 'tisara_single_related_hide' ) ) {
	return;
}

$related_layout = tisara_theme_mod( 'tisara_single_related_layout' );
$related_number = tisara_theme_mod( 'tisara_single_related_number' );
$related_more_link = tisara_theme_mod( 'tisara_single_related_more_link' );

if ( empty($related_layout) ) {
	$related_layout = 'grid-2columns';
}
if ( empty($related_number) ) {
	$related_number = 4;
}

$related_cats = wp_get_object_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );
$related_tags = wp_get_object_terms( get_the_ID(), 'post_tag', array( 'fields' => 'ids' ) );

if ( empty( $related_cats ) && empty( $related_tags ) ) {
	return;
}

$args = array(
	'post_type' 		=> 'post',
	'post_status' 		=> 'publish',
	'posts_per_page' 	=> $related_number, 
	'orderby' 			=> 'rand',
	'tax_query' 		=> array(
		'relation'		=> 'OR',
		array(
			'taxonomy' 	=> 'category',
			'field' 	=> 'id',
			'terms' 	=> $related_cats,
		),
		array(
			'taxonomy' 	=> 'post_tag',
			'field' 	=> 'id',
			'terms' 	=> $related_tags,
		),
	),
	'post__not_in' => array( get_the_ID() ) 
);

$related_items = new WP_Query( $args );
?>

<?php if ( $related_items->have_posts() ) : ?>

	<div class="related-area">

		<h3 class="related-title">
			<?php esc_html_e( 'Related Posts', 'tisara-wp' ); ?>
		</h3>

		<div class="blog-layout-<?php echo esc_attr($related_layout); ?>">

		<?php while ( $related_items->have_posts() ) : $related_items->the_post(); ?>

			<?php get_template_part( 'templates/content/layout/'.$related_layout ); ?>

		<?php endwhile;  ?>

		</div>

	</div>

<?php endif; ?>

<?php wp_reset_postdata(); ?>
