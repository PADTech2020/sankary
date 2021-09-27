<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

function tisara_get_terms( $taxonomy = 'category', $id = false ) {
	$term_query = new WP_Term_Query( array( 'taxonomy' => $taxonomy, 'hide_empty' => false ) );
	$results 	= array();
	if ( ! empty( $term_query->terms ) ) {
		foreach ( $term_query->terms as $term ) {
			if ( true == $id ) {
				$results[$term->term_id] = $term->name;
			} else {
				$results[$term->slug] = $term->name;
			}
		}
	}
	return $results;
}

function tisara_get_categories( $default_label = '' ) {

	$cats 		= get_categories( array( 'hide_empty' => 0 ) );

	if ( empty( $default_label ) ) {
		$default_label = esc_html__( '- Select Category -', 'tisara-wp' );
	}

	$result 	= array();
	$result[''] = $default_label;
	foreach ( $cats as $cat ) {
		$result[$cat->cat_ID] = $cat->name;
	}

	return $result;
}

function tisara_get_users( $default_label = '' ) {
	$users 		= get_users();

	if ( empty( $default_label ) ) {
		$default_label = esc_html__( '- Select User -', 'tisara-wp' );
	}

	$result 	= array();
	$result[''] = $default_label;
	foreach ( $users as $user ) {
		$result[] = array( 'value' => $user['id'], 'label' => $user['display_name'] );
	}
	return $result;
}

function tisara_get_posts( $posts_per_page = -1, $default_label = '' ) {

	$posts = get_posts( array(
		'posts_per_page' => $posts_per_page,
	));

	if ( empty( $default_label ) ) {
		$default_label = esc_html__( '- Select Post -', 'tisara-wp' );
	}

	$result 	= array();
	$result[''] = $default_label;
	foreach ( $posts as $post )	{
		$result[$post->ID] = $post->post_title;
	}
	return $result;
}

function tisara_get_post_types( $post_type = 'post', $posts_per_page = -1, $default_label = '' ) {

	$posts = get_posts( array(
		'posts_per_page' 	=> $posts_per_page,
		'post_type' 		=> $post_type,
	));

	if ( empty( $default_label ) ) {
		$default_label = esc_html__( '- Select Item -', 'tisara-wp' );
	}

	$result 	= array();
	$result[''] = $default_label;
	foreach ( $posts as $post )	{
		$result[$post->ID] = $post->post_title;
	}
	return $result;
}

function tisara_get_pages( $default_label = '' ) {
	$pages 		= get_pages();

	if ( empty( $default_label ) ) {
		$default_label = esc_html__( '- Select Page -', 'tisara-wp' );
	}

	$result 	= array();
	$result[''] = $default_label;
	foreach ( $pages as $page ) {
		$result[$page->ID] = $page->post_title;
	}
	return $result;
}

function tisara_get_tags( $default_label = '' ) {
	$tags 		= get_tags( array( 'hide_empty' => 0 ) );

	if ( empty( $default_label ) ) {
		$default_label = esc_html__( '- Select Tag -', 'tisara-wp' );
	}

	$result 	= array();
	$result[''] = $default_label;
	foreach ( $tags as $tag ) {
		$result[$tag->term_id] = $tag->name;
	}
	return $result;
}

function tisara_get_registered_post_types( $default_label = '' ) {

	$types 		= get_post_types( array( 'public'   => true, ), 'objects' );

	if ( empty( $default_label ) ) {
		$default_label = esc_html__( '- Select -', 'tisara-wp' );
	}

	$results 	= array();
	$result[''] = $default_label;
	foreach ( $types as $type ) {
		$result[$type->name] = $type->labels->singular_name;
	}

	return $results;
}
