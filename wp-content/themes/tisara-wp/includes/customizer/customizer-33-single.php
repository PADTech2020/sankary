<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_single' );
function tisara_customize_controls_single( $controls ) {

	$controls['tisara_section_single'] 	= array(
		'setting'	=> 'tisara_section_single',
		'title'		=> esc_html__( 'Single Post', 'tisara-wp' ),
		'panel'	    => 'tisara_panel_settings',
		'priority'	=> 33,
		'type' 		=> 'section'
	);

		$controls['tisara_heading_single_sidebar_layout'] = array(
			'label'    => esc_html__( 'Sidebar Layout', 'tisara-wp' ),
			'description' 		=> '<p class="tisara-alert tisara-alert-success tisara-alert-with-icon">
									<span class="dashicons dashicons-megaphone"></span> '.esc_html__( 'This layout can be overrided per single basis. If this setting does not work for specific single, please check "Page Layout" setting when editing this single post.', 'tisara-wp' ).'
									</p>
									<p class="tisara-alert tisara-alert-with-icon">
									<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.panel( \'widgets\' ).focus();">'.esc_html__( 'CLICK HERE to setup / manage widgets when sidebar is available', 'tisara-wp' ).'</a>
									</p>',
			'setting'  => 'tisara_heading_single_sidebar_layout',
			'section'  => 'tisara_section_single',
			'type'     => 'heading',
		);

		$controls['tisara_single_sidebar_layout'] = array(
			'setting'	=> 'tisara_single_sidebar_layout',
			'type'		=> 'radio',
			'label' 	=> esc_html__( 'Sidebar Layout', 'tisara-wp' ),
			'choices' 	=> array(
				'' 	=> esc_html__( 'Default Sidebar Layout', 'tisara-wp' ),
				'right' 	=> esc_html__( 'Right Sidebar', 'tisara-wp' ),
				'left'		=> esc_html__( 'Left Sidebar', 'tisara-wp' ),
				'none' 		=> esc_html__( 'No Sidebar (Full Width)', 'tisara-wp' ),
			),
			'section'	=> 'tisara_section_single',
		);

		$controls['tisara_heading_single_image'] = array(
			'label'    => esc_html__( 'Featured Image', 'tisara-wp' ),
			'setting'  => 'tisara_heading_single_image',
			'section'  => 'tisara_section_single',
			'type'     => 'heading',
		);

		$controls['tisara_single_image'] = array(
			'label'    => esc_html__( 'Show featured image (if available)', 'tisara-wp' ),
			'setting'  => 'tisara_single_image',
			'section'  => 'tisara_section_single',
			'type'     => 'checkbox',
		);

		$controls['tisara_heading_single_title'] = array(
			'label'    => esc_html__( 'Title', 'tisara-wp' ),
			'setting'  => 'tisara_heading_single_title',
			'section'  => 'tisara_section_single',
			'type'     => 'heading',
		);

		$controls['tisara_single_title_color'] = array(
			'label'    => esc_html__( 'Text Color', 'tisara-wp' ),
			'setting'  => 'tisara_single_title_color',
			'section'  => 'tisara_section_single',
			'type'     => 'color',
			'style'    => '.entry-single .entry-title { color: [value] }',
		);

		$controls['tisara_single_title_alignment'] = array(
			'label'    => esc_html__( 'Alignment', 'tisara-wp' ),
			'setting'  => 'tisara_single_title_alignment',
			'section'  => 'tisara_section_single',
			'type'     => 'radio-iconset',
			'choices'  => array(
				'left' => 'dashicons dashicons-editor-alignleft',
				'center' => 'dashicons dashicons-editor-aligncenter',
				'right' => 'dashicons dashicons-editor-alignright',
			),
			'style'  => array(
				'left' => '.entry-single .entry-title { text-align: left; }',
				'center' => '.entry-single .entry-title { text-align: center; }',
				'right' => '.entry-single .entry-title { text-align: right; }',
			),
		);

		$controls['tisara_single_title_font_size'] = array(
			'label'    => esc_html__( 'Font Size', 'tisara-wp' ),
			'setting'  => 'tisara_single_title_font_size',
			'section'  => 'tisara_section_single',
			'type'     => 'slider',
			'choices'  => array(
				'min' => 10,
				'max' => 50,
				'step' => 1,
				'unit' => 'px',
			),
			'style'    => '.entry-single .entry-title { font-size: [value]px }',
		);

		$controls['tisara_single_title_font_weight'] = array(
			'label'    => esc_html__( 'Font Weight', 'tisara-wp' ),
			'setting'  => 'tisara_single_title_font_weight',
			'section'  => 'tisara_section_single',
			'type'     => 'select',
			'choices'  => array(
				'' => '',
				'normal' => esc_html__( 'Normal', 'tisara-wp' ),
				'bold' => esc_html__( 'Bold', 'tisara-wp' ),
			),
			'style'  => array(
				'normal' => '.entry-single .entry-title { font-weight: normal; }',
				'bold' => '.entry-single .entry-title { font-weight: bold; }',
			),
		);

		$controls['tisara_single_title_font_style'] = array(
			'label'    => esc_html__( 'Font Style', 'tisara-wp' ),
			'setting'  => 'tisara_single_title_font_style',
			'section'  => 'tisara_section_single',
			'type'     => 'select',
			'choices'  => array(
				'' => '',
				'normal' => esc_html__( 'Normal', 'tisara-wp' ),
				'italic' => esc_html__( 'Italic', 'tisara-wp' ),
			),
			'style'  => array(
				'normal' => '.entry-single .entry-title { font-style: normal; }',
				'italic' => '.entry-single .entry-title { font-style: italic; }',
			),
		);

		$controls['tisara_single_title_text_transform'] = array(
			'label'    => esc_html__( 'Text Transform', 'tisara-wp' ),
			'setting'  => 'tisara_single_title_text_transform',
			'section'  => 'tisara_section_single',
			'type'     => 'select',
			'choices'  => array(
				'' => '',
				'none' => esc_html__( 'None', 'tisara-wp' ),
				'uppercase' => esc_html__( 'Uppercase', 'tisara-wp' ),
				'lowercase' => esc_html__( 'Lowercase', 'tisara-wp' ),
				'capitalize' => esc_html__( 'Capitalize', 'tisara-wp' ),
			),
			'style'  => array(
				'none' => '.entry-single .entry-title { text-transform: none; }',
				'uppercase' => '.entry-single .entry-title { text-transform: uppercase; }',
				'lowercase' => '.entry-single .entry-title { text-transform: lowercase; }',
				'capitalize' => '.entry-single .entry-title { text-transform: capitalize; }',
			),
		);

		$controls['tisara_heading_single_meta'] = array(
			'label'    => esc_html__( 'Post Meta', 'tisara-wp' ),
			'setting'  => 'tisara_heading_single_meta',
			'section'  => 'tisara_section_single',
			'type'     => 'heading',
		);

		$controls['tisara_single_meta'] = array(
			'label'    => esc_html__( 'Show single meta', 'tisara-wp' ),
			'setting'  => 'tisara_single_meta',
			'section'  => 'tisara_section_single',
			'type'     => 'checkbox',
		);

		$controls['tisara_single_meta_items'] = array(
			'label'    => esc_html__( 'Post Meta Items', 'tisara-wp' ),
			'setting'  => 'tisara_single_meta_items',
			'section'  => 'tisara_section_single',
			'type'     => 'sortable',
			'choices'  => array(
				'sticky' => esc_html__( 'Stiky Label', 'tisara-wp' ),
				'date' => esc_html__( 'Post Date', 'tisara-wp' ),
				'categories' => esc_html__( 'Post Categories', 'tisara-wp' ),
				'tags' => esc_html__( 'Post Tags', 'tisara-wp' ),
				'author' => esc_html__( 'Post Author', 'tisara-wp' ),
			),
			'active_callback' => 'tisara_callback_single_meta_is_active',
		);

		$controls['tisara_single_meta_color'] = array(
			'label'    => esc_html__( 'Text Color', 'tisara-wp' ),
			'setting'  => 'tisara_single_meta_color',
			'section'  => 'tisara_section_single',
			'type'     => 'color',
			'style'    => '.entry-single .entry-meta, .entry-single .entry-meta a { color: [value] }, .entry-single .entry-meta svg { fill: [value] }',
			'active_callback' => 'tisara_callback_single_meta_is_active',
		);

		$controls['tisara_single_meta_alignment'] = array(
			'label'    => esc_html__( 'Alignment', 'tisara-wp' ),
			'setting'  => 'tisara_single_meta_alignment',
			'section'  => 'tisara_section_single',
			'type'     => 'radio-iconset',
			'choices'  => array(
				'left' => 'dashicons dashicons-editor-alignleft',
				'center' => 'dashicons dashicons-editor-aligncenter',
				'right' => 'dashicons dashicons-editor-alignright',
			),
			'style'  => array(
				'left' => '.entry-single .entry-meta { text-align: left; } .entry-single .entry-meta .entry-meta-item { margin-left:0; margin-right: 1rem; }',
				'center' => '.entry-single .entry-meta { text-align: center; } .entry-single .entry-meta .entry-meta-item { margin-left:0.5rem; margin-right: 0.5rem; }',
				'right' => '.entry-single .entry-meta { text-align: right; } .entry-single .entry-meta .entry-meta-item { margin-left:1rem; margin-right: 0; }',
			),
			'active_callback' => 'tisara_callback_single_meta_is_active',
		);

		$controls['tisara_single_meta_font_size'] = array(
			'label'    => esc_html__( 'Font Size', 'tisara-wp' ),
			'setting'  => 'tisara_single_meta_font_size',
			'section'  => 'tisara_section_single',
			'type'     => 'slider',
			'choices'  => array(
				'min' => 10,
				'max' => 24,
				'step' => 1,
				'unit' => 'px',
			),
			'style'    => '.entry-single .entry-meta { font-size: [value]px }',
			'active_callback' => 'tisara_callback_single_meta_is_active',
		);

		$controls['tisara_heading_single_tags'] = array(
			'label'    => esc_html__( 'Tags', 'tisara-wp' ),
			'setting'  => 'tisara_heading_single_tags',
			'section'  => 'tisara_section_single',
			'type'     => 'heading',
		);

		$controls['tisara_single_tags_hide'] = array(
			'label'    => esc_html__( 'Hide post tags (if available) after post content', 'tisara-wp' ),
			'setting'  => 'tisara_single_tags_hide',
			'section'  => 'tisara_section_single',
			'type'     => 'checkbox',
		);

		$controls['tisara_heading_single_nav'] = array(
			'label'    => esc_html__( 'Prev & Next Posts Navigation', 'tisara-wp' ),
			'setting'  => 'tisara_heading_single_nav',
			'section'  => 'tisara_section_single',
			'type'     => 'heading',
		);

		$controls['tisara_single_nav_hide'] = array(
			'label'    => esc_html__( 'Hide prev & next posts navigation (if available) after post content', 'tisara-wp' ),
			'setting'  => 'tisara_single_nav_hide',
			'section'  => 'tisara_section_single',
			'type'     => 'checkbox',
		);

		$controls['tisara_heading_single_related'] = array(
			'label'    => esc_html__( 'Related Posts', 'tisara-wp' ),
			'setting'  => 'tisara_heading_single_related',
			'section'  => 'tisara_section_single',
			'type'     => 'heading',
		);

		$controls['tisara_single_related_hide'] = array(
			'label'    => esc_html__( 'Hide Related Posts', 'tisara-wp' ),
			'setting'  => 'tisara_single_related_hide',
			'section'  => 'tisara_section_single',
			'type'     => 'checkbox',
		);

		$controls['tisara_single_related_layout'] = array(
			'setting'	=> 'tisara_single_related_layout',
			'type'		=> 'radio',
			'label'		=> esc_html__( 'Related Posts Layout', 'tisara-wp' ),
			'choices'	=> array(
				'grid-2columns' => esc_html__( 'Grid View (2 Columns)', 'tisara-wp' ),
				'grid-3columns' => esc_html__( 'Grid View (3 Columns)', 'tisara-wp' ),
				'list-left' => esc_html__( 'List View (Left Image)', 'tisara-wp' ),
				'list-right' => esc_html__( 'List View (Right Image)', 'tisara-wp' ),
			),
			'section'	=> 'tisara_section_single',
		);

		$controls['tisara_single_related_number'] = array(
			'setting'	=> 'tisara_single_related_number',
			'type'		=> 'number',
			'label'		=> esc_html__( 'Number Related Posts To Show', 'tisara-wp' ),
			'section'	=> 'tisara_section_single',
		);

		$controls['tisara_heading_single_comments'] = array(
			'label'    => esc_html__( 'Comments', 'tisara-wp' ),
			'description' => '<p class="tisara-alert tisara-alert-with-icon">
							<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.section( \'tisara_section_comments\' ).focus();">'.esc_html__( 'CLICK HERE to change text on comments area.', 'tisara-wp' ).'</a>
							</p>',
			'setting'  => 'tisara_heading_single_comments',
			'section'  => 'tisara_section_single',
			'type'     => 'heading',
		);

		$controls['tisara_single_comments'] = array(
			'label'    => esc_html__( 'Show comments (if enabled on current page)', 'tisara-wp' ),
			'setting'  => 'tisara_single_comments',
			'section'  => 'tisara_section_single',
			'type'     => 'checkbox',
		);

		$controls['tisara_heading_single_sidebar'] = array(
			'setting'	=> 'tisara_heading_single_sidebar',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Sidebar Widgets', 'tisara-wp' ),
			'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
									<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.control( \'tisara_heading_blog_sidebar\' ).focus();">'.esc_html__( 'CLICK HERE to setup Sidebar widgets style', 'tisara-wp' ).'</a>
									</p>',
			'section'	=> 'tisara_section_single',
		);

	return $controls;
}

function tisara_callback_single_meta_is_active() {
	return tisara_theme_mod( 'tisara_single_meta' ) ? true : false;
}
