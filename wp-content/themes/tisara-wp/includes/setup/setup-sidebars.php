<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_action( 'widgets_init', 'tisara_register_sidebars' );
function tisara_register_sidebars() {
	
	register_sidebar(
		array(
			'name'			=> esc_html__( 'Main Sidebar', 'tisara-wp' ),
			'id'			=> 'sidebar-1',
			'description'	=> esc_html__( 'Appears on posts and pages, when enabled. If you want to leave it empty, add empty Text Widget here.', 'tisara-wp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Footer #1', 'tisara-wp' ),
			'id'			=> 'footer-1',
			'description'	=> esc_html__( 'Appears on footer widgets area (1st column), when enabled. If you want to leave it empty, add empty Text Widget here.', 'tisara-wp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Footer #2', 'tisara-wp' ),
			'id'			=> 'footer-2',
			'description'	=> esc_html__( 'Appears on footer widgets area (2nd column), when enabled. If you want to leave it empty, add empty Text Widget here.', 'tisara-wp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Footer #3', 'tisara-wp' ),
			'id'			=> 'footer-3',
			'description'	=> esc_html__( 'Appears on footer widgets area (3rd column), when enabled. If you want to leave it empty, add empty Text Widget here.', 'tisara-wp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);

	register_sidebar(
		array(
			'name'			=> esc_html__( 'Footer #4', 'tisara-wp' ),
			'id'			=> 'footer-4',
			'description'	=> esc_html__( 'Appears on footer widgets area (4th column), when enabled.', 'tisara-wp' ),
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		)
	);
}
