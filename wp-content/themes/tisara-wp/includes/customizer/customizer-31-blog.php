<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_blog' );
function tisara_customize_controls_blog( $controls ) {

	$controls['tisara_section_blog'] 	= array(
		'setting'	=> 'tisara_section_blog',
		'title'		=> esc_html__( 'Blog Page', 'tisara-wp' ),
		'panel'	    => 'tisara_panel_settings',
		'priority'	=> 31,
		'type' 		=> 'section'
	);

		$controls['tisara_heading_blog_sidebar_layout'] = array(
			'label'    => esc_html__( 'Sidebar Layout', 'tisara-wp' ),
			'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
									<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.panel( \'widgets\' ).focus();">'.esc_html__( 'CLICK HERE to setup / manage widgets when sidebar is available', 'tisara-wp' ).'</a>
									</p>',
			'setting'  => 'tisara_heading_blog_sidebar_layout',
			'section'  => 'tisara_section_blog',
			'type'     => 'heading',
		);

		$controls['tisara_blog_sidebar_layout'] = array(
			'setting'	=> 'tisara_blog_sidebar_layout',
			'type'		=> 'radio',
			'label' 	=> esc_html__( 'Default Sidebar Layout', 'tisara-wp' ),
			'choices' 	=> array(
				'right' 	=> esc_html__( 'Right Sidebar', 'tisara-wp' ),
				'left'		=> esc_html__( 'Left Sidebar', 'tisara-wp' ),
				'none' 		=> esc_html__( 'No Sidebar (Full Width)', 'tisara-wp' ),
			),
			'section'	=> 'tisara_section_blog',
		);

		$controls['tisara_blog_layout'] = array(
			'setting'	=> 'tisara_blog_layout',
			'type'		=> 'radio',
			'label'		=> esc_html__( 'Blog Layout', 'tisara-wp' ),
			'choices'	=> array(
				'list-left' => esc_html__( 'List View (Left Image)', 'tisara-wp' ),
				'list-right' => esc_html__( 'List View (Right Image)', 'tisara-wp' ),
				'grid-2columns' => esc_html__( 'Grid View (2 Columns)', 'tisara-wp' ),
				'grid-3columns' => esc_html__( 'Grid View (3 Columns)', 'tisara-wp' ),
				'excerpt-image' => esc_html__( 'Featured Image + Excerpt (Summary)', 'tisara-wp' ),
				'excerpt' => esc_html__( 'Excerpt (Summary)', 'tisara-wp' ),
				'content-image' => esc_html__( 'Featured Image + Full Content', 'tisara-wp' ),
				'content' => esc_html__( 'Full Content', 'tisara-wp' ),
			),
			'section'	=> 'tisara_section_blog',
		);

		$controls['tisara_heading_blog_title'] = array(
			'label'    => esc_html__( 'Title', 'tisara-wp' ),
			'setting'  => 'tisara_heading_blog_title',
			'section'  => 'tisara_section_blog',
			'type'     => 'heading',
		);

		$controls['tisara_blog_title_color'] = array(
			'label'    => esc_html__( 'Text Color', 'tisara-wp' ),
			'setting'  => 'tisara_blog_title_color',
			'section'  => 'tisara_section_blog',
			'type'     => 'color',
			'style'    => '.entry-blog .entry-title, .entry-blog .entry-title a { color: [value] }',
		);

		$controls['tisara_blog_title_alignment'] = array(
			'label'    => esc_html__( 'Alignment', 'tisara-wp' ),
			'setting'  => 'tisara_blog_title_alignment',
			'section'  => 'tisara_section_blog',
			'type'     => 'radio-iconset',
			'choices'  => array(
				'left' => 'dashicons dashicons-editor-alignleft',
				'center' => 'dashicons dashicons-editor-aligncenter',
				'right' => 'dashicons dashicons-editor-alignright',
			),
			'style'  => array(
				'left' => '.entry-blog .entry-title { text-align: left; }',
				'center' => '.entry-blog .entry-title { text-align: center; }',
				'right' => '.entry-blog .entry-title { text-align: right; }',
			),
		);

		$controls['tisara_blog_title_font_size'] = array(
			'label'    => esc_html__( 'Font Size', 'tisara-wp' ),
			'setting'  => 'tisara_blog_title_font_size',
			'section'  => 'tisara_section_blog',
			'type'     => 'slider',
			'choices'  => array(
				'min' => 10,
				'max' => 50,
				'step' => 1,
				'unit' => 'px',
			),
			'style'    => '.entry-blog .entry-title { font-size: [value]px }',
		);

		$controls['tisara_blog_title_font_weight'] = array(
			'label'    => esc_html__( 'Font Weight', 'tisara-wp' ),
			'setting'  => 'tisara_blog_title_font_weight',
			'section'  => 'tisara_section_blog',
			'type'     => 'select',
			'choices'  => array(
				'' => '',
				'normal' => esc_html__( 'Normal', 'tisara-wp' ),
				'bold' => esc_html__( 'Bold', 'tisara-wp' ),
			),
			'style'  => array(
				'normal' => '.entry-blog .entry-title { font-weight: normal; }',
				'bold' => '.entry-blog .entry-title { font-weight: bold; }',
			),
		);

		$controls['tisara_blog_title_font_style'] = array(
			'label'    => esc_html__( 'Font Style', 'tisara-wp' ),
			'setting'  => 'tisara_blog_title_font_style',
			'section'  => 'tisara_section_blog',
			'type'     => 'select',
			'choices'  => array(
				'' => '',
				'normal' => esc_html__( 'Normal', 'tisara-wp' ),
				'italic' => esc_html__( 'Italic', 'tisara-wp' ),
			),
			'style'  => array(
				'normal' => '.entry-blog .entry-title { font-style: normal; }',
				'italic' => '.entry-blog .entry-title { font-style: italic; }',
			),
		);

		$controls['tisara_blog_title_text_transform'] = array(
			'label'    => esc_html__( 'Text Transform', 'tisara-wp' ),
			'setting'  => 'tisara_blog_title_text_transform',
			'section'  => 'tisara_section_blog',
			'type'     => 'select',
			'choices'  => array(
				'' => '',
				'none' => esc_html__( 'None', 'tisara-wp' ),
				'uppercase' => esc_html__( 'Uppercase', 'tisara-wp' ),
				'lowercase' => esc_html__( 'Lowercase', 'tisara-wp' ),
				'capitalize' => esc_html__( 'Capitalize', 'tisara-wp' ),
			),
			'style'  => array(
				'none' => '.entry-blog .entry-title { text-transform: none; }',
				'uppercase' => '.entry-blog .entry-title { text-transform: uppercase; }',
				'lowercase' => '.entry-blog .entry-title { text-transform: lowercase; }',
				'capitalize' => '.entry-blog .entry-title { text-transform: capitalize; }',
			),
		);

		$controls['tisara_heading_blog_content'] = array(
			'label'    => esc_html__( 'Content / Excerpt', 'tisara-wp' ),
			'setting'  => 'tisara_heading_blog_content',
			'section'  => 'tisara_section_blog',
			'type'     => 'heading',
		);

		$controls['tisara_blog_content_alignment'] = array(
			'label'    => esc_html__( 'Alignment', 'tisara-wp' ),
			'setting'  => 'tisara_blog_content_alignment',
			'section'  => 'tisara_section_blog',
			'type'     => 'radio-iconset',
			'choices'  => array(
				'left' => 'dashicons dashicons-editor-alignleft',
				'center' => 'dashicons dashicons-editor-aligncenter',
				'right' => 'dashicons dashicons-editor-alignright',
			),
			'style'  => array(
				'left' => '.entry-blog .entry-content { text-align: left; }',
				'center' => '.entry-blog .entry-content { text-align: center; }',
				'right' => '.entry-blog .entry-content { text-align: right; }',
			),
		);

		$controls['tisara_heading_blog_more_link'] = array(
			'label'    => esc_html__( 'More Link', 'tisara-wp' ),
			'setting'  => 'tisara_heading_blog_more_link',
			'section'  => 'tisara_section_blog',
			'type'     => 'heading',
		);

		$controls['tisara_blog_more_link'] = array(
			'label'    => esc_html__( 'Show "Continue Reading &rarr;" more link (if available on current layout)', 'tisara-wp' ),
			'setting'  => 'tisara_blog_more_link',
			'section'  => 'tisara_section_blog',
			'type'     => 'checkbox',
		);

		$controls['tisara_blog_more_link_text'] = array(
			'label'    => sprintf( esc_html__( 'Change Text: "%s"', 'tisara-wp' ), esc_html__( 'Continue reading &rarr;', 'tisara-wp' ) ),
			'setting'  => 'tisara_blog_more_link_text',
			'section'  => 'tisara_section_blog',
			'type'     => 'text',
			'active_callback' => 'tisara_callback_blog_more_link_is_active',
		);

		$controls['tisara_blog_more_link_alignment'] = array(
			'label'    => esc_html__( 'Alignment', 'tisara-wp' ),
			'setting'  => 'tisara_blog_more_link_alignment',
			'section'  => 'tisara_section_blog',
			'type'     => 'radio-iconset',
			'choices'  => array(
				'left' => 'dashicons dashicons-editor-alignleft',
				'center' => 'dashicons dashicons-editor-aligncenter',
				'right' => 'dashicons dashicons-editor-alignright',
			),
			'style'  => array(
				'left' => '.entry-blog .entry-more-link { text-align: left; }',
				'center' => '.entry-blog .entry-more-link { text-align: center; }',
				'right' => '.entry-blog .entry-more-link { text-align: right; }',
			),
		);

		$controls['tisara_blog_more_link_background'] = array(
			'label'    => esc_html__( 'Background Color', 'tisara-wp' ),
			'setting'  => 'tisara_blog_more_link_background',
			'section'  => 'tisara_section_blog',
			'type'     => 'color',
			'style'    => '.entry-blog a.more-link { background-color: [value] }',
			'active_callback' => 'tisara_callback_blog_more_link_is_active',
		);

		$controls['tisara_blog_more_link_border'] = array(
			'label'    => esc_html__( 'Border Color', 'tisara-wp' ),
			'setting'  => 'tisara_blog_more_link_border',
			'section'  => 'tisara_section_blog',
			'type'     => 'color',
			'style'    => '.entry-blog a.more-link { border-color: [value] }',
			'active_callback' => 'tisara_callback_blog_more_link_is_active',
		);

		$controls['tisara_blog_more_link_color'] = array(
			'label'    => esc_html__( 'Text Color', 'tisara-wp' ),
			'setting'  => 'tisara_blog_more_link_color',
			'section'  => 'tisara_section_blog',
			'type'     => 'color',
			'style'    => '.entry-blog a.more-link { color: [value] }',
			'active_callback' => 'tisara_callback_blog_more_link_is_active',
		);

		$controls['tisara_blog_more_link_background_hover'] = array(
			'label'    => esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
			'setting'  => 'tisara_blog_more_link_background_hover',
			'section'  => 'tisara_section_blog',
			'type'     => 'color',
			'style'    => '.entry-blog a.more-link:hover { background-color: [value] }',
			'active_callback' => 'tisara_callback_blog_more_link_is_active',
		);

		$controls['tisara_blog_more_link_border_hover'] = array(
			'label'    => esc_html__( 'Border Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
			'setting'  => 'tisara_blog_more_link_border_hover',
			'section'  => 'tisara_section_blog',
			'type'     => 'color',
			'style'    => '.entry-blog a.more-link:hover { border-color: [value] }',
			'active_callback' => 'tisara_callback_blog_more_link_is_active',
		);

		$controls['tisara_blog_more_link_color_hover'] = array(
			'label'    => esc_html__( 'Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
			'setting'  => 'tisara_blog_more_link_color_hover',
			'section'  => 'tisara_section_blog',
			'type'     => 'color',
			'style'    => '.entry-blog a.more-link:hover { color: [value] }',
			'active_callback' => 'tisara_callback_blog_more_link_is_active',
		);

		$controls['tisara_heading_blog_meta'] = array(
			'label'    => esc_html__( 'Post Meta', 'tisara-wp' ),
			'setting'  => 'tisara_heading_blog_meta',
			'section'  => 'tisara_section_blog',
			'type'     => 'heading',
		);

		$controls['tisara_blog_meta'] = array(
			'label'    => esc_html__( 'Show post meta', 'tisara-wp' ),
			'setting'  => 'tisara_blog_meta',
			'section'  => 'tisara_section_blog',
			'type'     => 'checkbox',
		);

		$controls['tisara_blog_meta_items'] = array(
			'label'    => esc_html__( 'Post Meta Items', 'tisara-wp' ),
			'setting'  => 'tisara_blog_meta_items',
			'section'  => 'tisara_section_blog',
			'type'     => 'sortable',
			'choices'  => array(
				'sticky' => esc_html__( 'Stiky Label', 'tisara-wp' ),
				'date' => esc_html__( 'Post Date', 'tisara-wp' ),
				'categories' => esc_html__( 'Post Categories', 'tisara-wp' ),
				'tags' => esc_html__( 'Post Tags', 'tisara-wp' ),
				'author' => esc_html__( 'Post Author', 'tisara-wp' ),
			),
			'active_callback' => 'tisara_callback_blog_meta_is_active',
		);

		$controls['tisara_blog_meta_color'] = array(
			'label'    => esc_html__( 'Text Color', 'tisara-wp' ),
			'setting'  => 'tisara_blog_meta_color',
			'section'  => 'tisara_section_blog',
			'type'     => 'color',
			'style'    => '.entry-blog .entry-meta, .entry-blog .entry-meta a { color: [value] }, .entry-blog .entry-meta svg { fill: [value] }',
			'active_callback' => 'tisara_callback_blog_meta_is_active',
		);

		$controls['tisara_blog_meta_alignment'] = array(
			'label'    => esc_html__( 'Alignment', 'tisara-wp' ),
			'setting'  => 'tisara_blog_meta_alignment',
			'section'  => 'tisara_section_blog',
			'type'     => 'radio-iconset',
			'choices'  => array(
				'left' => 'dashicons dashicons-editor-alignleft',
				'center' => 'dashicons dashicons-editor-aligncenter',
				'right' => 'dashicons dashicons-editor-alignright',
			),
			'style'  => array(
				'left' => '.entry-blog .entry-meta { text-align: left; } .entry-blog .entry-meta .entry-meta-item { margin-left:0; margin-right: 1rem; }',
				'center' => '.entry-blog .entry-meta { text-align: center; } .entry-blog .entry-meta .entry-meta-item { margin-left:0.5rem; margin-right: 0.5rem; }',
				'right' => '.entry-blog .entry-meta { text-align: right; } .entry-blog .entry-meta .entry-meta-item { margin-left:1rem; margin-right: 0; }',
			),
			'active_callback' => 'tisara_callback_blog_meta_is_active',
		);

		$controls['tisara_blog_meta_font_size'] = array(
			'label'    => esc_html__( 'Font Size', 'tisara-wp' ),
			'setting'  => 'tisara_blog_meta_font_size',
			'section'  => 'tisara_section_blog',
			'type'     => 'slider',
			'choices'  => array(
				'min' => 10,
				'max' => 24,
				'step' => 1,
				'unit' => 'px',
			),
			'style'    => '.entry-blog .entry-meta { font-size: [value]px }',
			'active_callback' => 'tisara_callback_blog_meta_is_active',
		);

		$controls['tisara_heading_blog_pagination'] = array(
			'label'    => esc_html__( 'Pagination Style', 'tisara-wp' ),
			'description' => '<p class="tisara-alert tisara-alert-with-icon"><span class="dashicons dashicons-admin-appearance"></span> <a href="javascript:wp.customize.control( \'tisara_heading_pagination\' ).focus();">' . sprintf( esc_html__( 'CLICK HERE to setup %s', 'tisara-wp' ), esc_html__( 'Pagination Style', 'tisara-wp' ) ) . '</a></p>',
			'setting'  => 'tisara_heading_blog_pagination',
			'section'  => 'tisara_section_blog',
			'type'     => 'heading',
		);

		$controls['tisara_heading_blog_sidebar'] = array(
			'setting'	=> 'tisara_heading_blog_sidebar',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Sidebar Widgets', 'tisara-wp' ),
			'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
									<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.panel( \'widgets\' ).focus();">'.esc_html__( 'CLICK HERE to setup / manage widgets when sidebar is available', 'tisara-wp' ).'</a>
									</p>',
			'section'	=> 'tisara_section_blog',
		);

		$controls['tisara_blog_sidebar_color_title'] = array(
			'setting'	=> 'tisara_blog_sidebar_color_title',
			'label'		=> esc_html__( 'Sidebar - Widget Title Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_blog',
			'type' 		=> 'color',
			'style'		=> '.sidebar-area .widget .widget-title, .sidebar-area .widget .widget-title a { color : [value]; }',
		);

		$controls['tisara_blog_sidebar_color_text'] = array(
			'setting'	=> 'tisara_blog_sidebar_color_text',
			'label'		=> esc_html__( 'Sidebar - Widget Text Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_blog',
			'type' 		=> 'color',
			'style'		=> '.sidebar-area .widget, .sidebar-area .widget a, .sidebar-area .widget ul li a { color : [value]; }',
		);

		$controls['tisara_blog_sidebar_color_link'] = array(
			'setting'	=> 'tisara_blog_sidebar_color_link',
			'label'		=> esc_html__( 'Sidebar - Widget Link Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_blog',
			'type' 		=> 'color',
			'style'		=> '.sidebar-area .widget a, .sidebar-area .widget ul li a { color : [value]; }',
		);

	return $controls;
}

function tisara_callback_blog_more_link_is_active() {
	return tisara_theme_mod( 'tisara_blog_more_link' ) ? true : false;
}

function tisara_callback_blog_meta_is_active() {
	return tisara_theme_mod( 'tisara_blog_meta' ) ? true : false;
}
