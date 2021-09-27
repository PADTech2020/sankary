<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_page' );
function tisara_customize_controls_page( $controls ) {

	$controls['tisara_section_page'] 	= array(
		'setting'		=> 'tisara_section_page',
		'title'		=> esc_html__( 'Single Page', 'tisara-wp' ),
		'panel'	    => 'tisara_panel_settings',
		'priority'	=> 35,
		'type' 		=> 'section'
	);

		$controls['tisara_heading_page_sidebar_layout'] = array(
			'label'    => esc_html__( 'Sidebar Layout', 'tisara-wp' ),
			'description' 		=> '<p class="tisara-alert tisara-alert-success tisara-alert-with-icon">
									<span class="dashicons dashicons-megaphone"></span> '.esc_html__( 'This layout can be overrided per single basis. If this setting does not work for specific single, please check "Page Layout" setting when editing this page.', 'tisara-wp' ).'
									</p>
									<p class="tisara-alert tisara-alert-with-icon">
									<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.panel( \'widgets\' ).focus();">'.esc_html__( 'CLICK HERE to setup / manage widgets when sidebar is available', 'tisara-wp' ).'</a>
									</p>',
			'setting'  => 'tisara_heading_page_sidebar_layout',
			'section'  => 'tisara_section_page',
			'type'     => 'heading',
		);

		$controls['tisara_page_sidebar_layout'] = array(
			'setting'	=> 'tisara_page_sidebar_layout',
			'type'		=> 'radio',
			'label' 	=> esc_html__( 'Sidebar Layout', 'tisara-wp' ),
			'choices' 	=> array(
				'' 	=> esc_html__( 'Default Sidebar Layout', 'tisara-wp' ),
				'right' 	=> esc_html__( 'Right Sidebar', 'tisara-wp' ),
				'left'		=> esc_html__( 'Left Sidebar', 'tisara-wp' ),
				'none' 		=> esc_html__( 'No Sidebar (Full Width)', 'tisara-wp' ),
			),
			'section'	=> 'tisara_section_page',
		);

		$controls['tisara_heading_page_image'] = array(
			'label'    => esc_html__( 'Featured Image', 'tisara-wp' ),
			'setting'  => 'tisara_heading_page_image',
			'section'  => 'tisara_section_page',
			'type'     => 'heading',
		);

		$controls['tisara_page_image'] = array(
			'label'    => esc_html__( 'Show featured image (if available)', 'tisara-wp' ),
			'setting'  => 'tisara_page_image',
			'section'  => 'tisara_section_page',
			'type'     => 'checkbox',
		);

		$controls['tisara_heading_page_comments'] = array(
			'label'    => esc_html__( 'Comments', 'tisara-wp' ),
			'description' => '<p class="tisara-alert tisara-alert-with-icon">
							<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.section( \'tisara_section_comments\' ).focus();">'.esc_html__( 'CLICK HERE to change text on comments area.', 'tisara-wp' ).'</a>
							</p>',
			'setting'  => 'tisara_heading_page_comments',
			'section'  => 'tisara_section_page',
			'type'     => 'heading',
		);

		$controls['tisara_page_comments'] = array(
			'label'    => esc_html__( 'Show comments (if enabled on current page)', 'tisara-wp' ),
			'setting'  => 'tisara_page_comments',
			'section'  => 'tisara_section_page',
			'type'     => 'checkbox',
		);

		$controls['tisara_heading_page_sidebar'] = array(
			'setting'	=> 'tisara_heading_page_sidebar',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Sidebar Widgets', 'tisara-wp' ),
			'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
									<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.control( \'tisara_heading_blog_sidebar\' ).focus();">'.esc_html__( 'CLICK HERE to setup Sidebar widgets style', 'tisara-wp' ).'</a>
									</p>',
			'section'	=> 'tisara_section_page',
		);

	return $controls;
}

