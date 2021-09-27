<?php 

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists('Tisara_Metabox') ) {
	return;
}

if ( ! is_admin() ) {
	return;
}

function tisara_metabox_get_post_types( $post_type = 'post', $posts_per_page = -1, $default_label = '' ) {

	$posts = get_posts( array(
		'posts_per_page' 	=> $posts_per_page,
		'post_type' 		=> $post_type,
	));

	if ( empty( $default_label ) ) {
		$default_label = esc_html__( '- Select Item -', 'tisara-wp-addons' );
	}

	$result 	= array();
	$result[''] = $default_label;
	foreach ( $posts as $post )	{
		$result[$post->ID] = $post->post_title;
	}
	return $result;
}

new Tisara_Metabox( array(
	'id' => 'tisara_page_layout', 
	'title' => esc_html__( 'Page Layout', 'tisara-wp-addons' ), 
	'screen' => array( 'post', 'page', 'product' ), 
	'context' => 'side',
	'priority' => 'low',
	'fields' => array( 
		array(
			'id' => '_sidebar_layout',
			'label' => esc_html__( 'Sidebar Layout', 'tisara-wp-addons' ),
			'type' => 'radio',
			'options' => array(
				'' 	=> esc_html__( 'Default', 'tisara-wp-addons' ),
				'right' 	=> esc_html__( 'Right Sidebar', 'tisara-wp-addons' ),
				'left'		=> esc_html__( 'Left Sidebar', 'tisara-wp-addons' ),
				'none' 		=> esc_html__( 'No Sidebar (Full Width)', 'tisara-wp-addons' ),
			),
		),
	),
) );

new Tisara_Metabox( array(
	'id' => 'tisara_header_layout', 
	'title' => esc_html__( 'Header Layout', 'tisara-wp-addons' ), 
	'screen' => array( 'post', 'page' ), 
	'context' => 'side',
	'priority' => 'low',
	'fields' => array( 
		array(
			'id' => '_header_elementor_before',
			'label' => esc_html__( 'Elementor Header Before Theme Header', 'tisara-wp-addons' ),
			'type' => 'select',
			'options' => tisara_metabox_get_post_types( 'elementor_library', 50, esc_html__( '- Select Elementor Templates -', 'tisara-wp-addons' ) ),
		),
		array(
			'id' => '_header_layout',
			'label' => esc_html__( 'Theme Header Layout', 'tisara-wp-addons' ),
			'type' => 'select',
			'options' => array(
				'' 	=> esc_html__( 'Default', 'tisara-wp-addons' ),
				'style-1' => esc_html__( 'Header Style 1', 'tisara-wp-addons' ),
				'style-2' => esc_html__( 'Header Style 2', 'tisara-wp-addons' ),
				'style-3' => esc_html__( 'Header Style 3', 'tisara-wp-addons' ),
				'style-4' => esc_html__( 'Header Style 4', 'tisara-wp-addons' ),
				'style-5' => esc_html__( 'Header Style 5', 'tisara-wp-addons' ),
				'style-6' => esc_html__( 'Header Style 6', 'tisara-wp-addons' ),
				'style-7' => esc_html__( 'Header Style 7', 'tisara-wp-addons' ),
				'style-8' => esc_html__( 'Header Style 8', 'tisara-wp-addons' ),
				'hide' => esc_html__( 'Hide Theme Header', 'tisara-wp-addons' ),
			),
		),
		array(
			'id' => '_header_elementor_after',
			'label' => esc_html__( 'Elementor Header After Theme Header', 'tisara-wp-addons' ),
			'type' => 'select',
			'options' => tisara_metabox_get_post_types( 'elementor_library', 50, esc_html__( '- Select Elementor Templates -', 'tisara-wp-addons' ) ),
		),
		array(
			'id' => '_hero_hide',
			'label' => esc_html__( 'Header Hero / Page Title', 'tisara-wp-addons' ),
			'label2' => sprintf( esc_html__( 'HIDE %s', 'tisara-wp-addons' ), esc_html__( 'Header Hero / Page Title', 'tisara-wp-addons' ) ),
			'type' => 'checkbox',
		),
		array(
			'id' => '_breadcrumb_hide',
			'label' => esc_html__( 'Breadcrumb', 'tisara-wp-addons' ),
			'label2' => sprintf( esc_html__( 'HIDE %s', 'tisara-wp-addons' ), esc_html__( 'Breadcrumb', 'tisara-wp-addons' ) ),
			'type' => 'checkbox',
		),
	),
) );

new Tisara_Metabox( array(
	'id' => 'tisara_footer_layout', 
	'title' => esc_html__( 'Footer Layout', 'tisara-wp-addons' ), 
	'screen' => array( 'post', 'page' ), 
	'context' => 'side',
	'priority' => 'low',
	'fields' => array( 
		array(
			'id' => '_footer_elementor_before',
			'label' => esc_html__( 'Elementor Footer Before Theme Footer', 'tisara-wp-addons' ),
			'type' => 'select',
			'options' => tisara_metabox_get_post_types( 'elementor_library', 50, esc_html__( '- Select Elementor Templates -', 'tisara-wp-addons' ) ),
		),
		array(
			'id' => '_footer_layout',
			'label' => esc_html__( 'Theme Footer Layout', 'tisara-wp-addons' ),
			'type' => 'select',
			'options' => array(
				'' 	=> esc_html__( 'Default', 'tisara-wp-addons' ),
				'style-1' => esc_html__( 'Footer Style 1', 'tisara-wp-addons' ),
				'style-2' => esc_html__( 'Footer Style 2', 'tisara-wp-addons' ),
				'style-3' => esc_html__( 'Footer Style 3', 'tisara-wp-addons' ),
				'style-4' => esc_html__( 'Footer Style 4', 'tisara-wp-addons' ),
				'style-5' => esc_html__( 'Footer Style 5', 'tisara-wp-addons' ),
				'style-6' => esc_html__( 'Footer Style 6', 'tisara-wp-addons' ),
				'hide' => esc_html__( 'Hide Theme Footer', 'tisara-wp-addons' ),
			),
		),
		array(
			'id' => '_footer_elementor_after',
			'label' => esc_html__( 'Elementor Footer After Theme Footer', 'tisara-wp-addons' ),
			'type' => 'select',
			'options' => tisara_metabox_get_post_types( 'elementor_library', 50, esc_html__( '- Select Elementor Templates -', 'tisara-wp-addons' ) ),
		),
	),
) );

new Tisara_Metabox( array(
	'id' => 'tisara_blog_template', 
	'title' => esc_html__( 'Blog Page Template', 'tisara-wp-addons' ), 
	'screen' => array( 'page' ), 
	'context' => 'side',
	'priority' => 'low',
	'fields' => array( 
		array(
			'id' => '_blog_layout',
			'label' => esc_html__( 'Blog Layout', 'tisara-wp-addons' ),
			'type' => 'select',
			'options' => array(
				'' 	=> esc_html__( 'Default', 'tisara-wp-addons' ),
				'list-left' => esc_html__( 'List View (Left Image)', 'tisara-wp-addons' ),
				'list-right' => esc_html__( 'List View (Right Image)', 'tisara-wp-addons' ),
				'grid-2columns' => esc_html__( 'Grid View (2 Columns)', 'tisara-wp-addons' ),
				'grid-3columns' => esc_html__( 'Grid View (3 Columns)', 'tisara-wp-addons' ),
				'excerpt-image' => esc_html__( 'Featured Image + Excerpt (Summary)', 'tisara-wp-addons' ),
				'excerpt' => esc_html__( 'Excerpt (Summary)', 'tisara-wp-addons' ),
				'content-image' => esc_html__( 'Featured Image + Full Content', 'tisara-wp-addons' ),
				'content' => esc_html__( 'Full Content', 'tisara-wp-addons' ),
			),
		),
		array(
			'id' => '_posts_per_page',
			'label' => esc_html__( 'Number of Posts Per Page', 'tisara-wp-addons' ),
			'type' => 'number',
		),
	),
) );
