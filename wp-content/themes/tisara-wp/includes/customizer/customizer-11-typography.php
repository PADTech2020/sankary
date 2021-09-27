<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_typography' );
function tisara_customize_controls_typography( $controls ) {

	$controls['tisara_section_typography'] = array(
		'title'    => esc_html__( 'Basic Fonts & Colors / Typography', 'tisara-wp' ),
		'setting'  => 'tisara_section_typography',
		'panel'    => 'tisara_panel_settings',
		'type'     => 'section',
		'priority' => 11,
	);

	$controls['tisara_heading_body'] = array(
		'label'    => esc_html__( 'Body Text', 'tisara-wp' ),
		'setting'  => 'tisara_heading_body',
		'section'  => 'tisara_section_typography',
		'type'     => 'heading',
	);

	$controls['tisara_body_color'] = array(
		'label'    => esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  => 'tisara_body_color',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'body, button, input, select, textarea { color: [value] }',
	);

	$controls['tisara_body_font'] = array(
		'label'    => esc_html__( 'Body Font Family', 'tisara-wp' ),
		'setting'  => 'tisara_body_font',
		'section'  => 'tisara_section_typography',
		'type'     => 'font',
		'selector' => 'body,.site-description',
		'default'  => 'Karla (sans-serif)',
	);

	$controls['tisara_body_font_size'] = array(
		'label'    => esc_html__( 'Body Font Size', 'tisara-wp' ),
		'setting'  => 'tisara_body_font_size',
		'section'  => 'tisara_section_typography',
		'type'     => 'slider',
		'choices'  => array(
			'min' => 10,
			'max' => 24,
			'step' => 1,
			'unit' => 'px',
		),
		'style'    => 'body { font-size: [value]px; }',
	);

	$controls['tisara_body_font_weight'] = array(
		'label'    => esc_html__( 'Body Font Weight', 'tisara-wp' ),
		'setting'  => 'tisara_body_font_weight',
		'section'  => 'tisara_section_typography',
		'type'     => 'select',
		'choices'  => array(
			''     => esc_html__( 'default', 'tisara-wp' ),
			'100'  => '100',
			'200'  => '200',
			'300'  => '300',
			'400'  => '400',
			'500'  => '500',
		),
		'style'    => 'body { font-weight: [value]; }',
		'transport' => 'refresh'
	);

	$controls['tisara_heading_link'] = array(
		'label'    => esc_html__( 'Link Text', 'tisara-wp' ),
		'setting'  => 'tisara_heading_link',
		'section'  => 'tisara_section_typography',
		'type'     => 'heading',
	);

	$controls['tisara_link_color'] = array(
		'label'    => esc_html__( 'Link Text Color', 'tisara-wp' ),
		'setting'  => 'tisara_link_color',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'a { color: [value] }',
	);

	$controls['tisara_link_color_hover'] = array(
		'label'    => esc_html__( 'Link Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  => 'tisara_link_color_hover',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'a:hover { color: [value] }',
	);

	$controls['tisara_heading_heading'] = array(
		'label'    => esc_html__( 'Heading Text', 'tisara-wp' ),
		'setting'  => 'tisara_heading_heading',
		'section'  => 'tisara_section_typography',
		'type'     => 'heading',
	);

	$controls['tisara_heading_color'] = array(
		'label'    => esc_html__( 'Heading Text Color', 'tisara-wp' ),
		'setting'  => 'tisara_heading_color',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'h1,h2,h3,h4,h5 { color: [value] }',
	);

	$controls['tisara_heading_font'] = array(
		'label'    => esc_html__( 'Heading Font Family', 'tisara-wp' ),
		'setting'  => 'tisara_heading_font',
		'section'  => 'tisara_section_typography',
		'type'     => 'font',
		'selector' => '.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6',
		'default'  => 'El Messiri (sans-serif)',
	);

	$font_weight_options = array(
			''     => esc_html__( 'default', 'tisara-wp' ),
			'100'  => '100',
			'200'  => '200',
			'300'  => '300',
			'400'  => '400',
			'500'  => '500',
			'600'  => '600',
			'700'  => '700',
			'800'  => '800',
			'900'  => '900',
			'1000'  => '1000',
		);

	$controls['tisara_heading_font_weight'] = array(
		'label'    => esc_html__( 'Heading Font Weight', 'tisara-wp' ),
		'setting'  => 'tisara_heading_font_weight',
		'section'  => 'tisara_section_typography',
		'type'     => 'select',
		'choices'  => $font_weight_options,
		'style'    => '.h1,.h2,.h3,.h4,.h5,.h6,h1,h2,h3,h4,h5,h6 { font-weight: [value]; }',
		'transport' => 'refresh'
	);

	$controls['tisara_heading1_font_size'] = array(
		'label'    => esc_html__( 'Heading H1 Font Size', 'tisara-wp' ),
		'setting'  => 'tisara_heading1_font_size',
		'section'  => 'tisara_section_typography',
		'type'     => 'slider',
		'choices'  => array(
			'min' => 12,
			'max' => 100,
			'step' => 1,
			'unit' => 'px',
		),
		'style'    => '.h1, h1 { font-size: [value]px }',
	);

	$controls['tisara_heading2_font_size'] = array(
		'label'    => esc_html__( 'Heading H2 Font Size', 'tisara-wp' ),
		'setting'  => 'tisara_heading2_font_size',
		'section'  => 'tisara_section_typography',
		'type'     => 'slider',
		'choices'  => array(
			'min' => 12,
			'max' => 100,
			'step' => 1,
			'unit' => 'px',
		),
		'style'    => '.h2, h2 { font-size: [value]px }',
	);

	$controls['tisara_heading3_font_size'] = array(
		'label'    => esc_html__( 'Heading H3 Font Size', 'tisara-wp' ),
		'setting'  => 'tisara_heading3_font_size',
		'section'  => 'tisara_section_typography',
		'type'     => 'slider',
		'choices'  => array(
			'min' => 12,
			'max' => 100,
			'step' => 1,
			'unit' => 'px',
		),
		'style'    => '.h3, h3 { font-size: [value]px }',
	);

	$controls['tisara_heading4_font_size'] = array(
		'label'    => esc_html__( 'Heading H4 Font Size', 'tisara-wp' ),
		'setting'  => 'tisara_heading4_font_size',
		'section'  => 'tisara_section_typography',
		'type'     => 'slider',
		'choices'  => array(
			'min' => 12,
			'max' => 100,
			'step' => 1,
			'unit' => 'px',
		),
		'style'    => '.h4, h4 { font-size: [value]px }',
	);

	$controls['tisara_heading5_font_size'] = array(
		'label'    => esc_html__( 'Heading H5 Font Size', 'tisara-wp' ),
		'setting'  => 'tisara_heading5_font_size',
		'section'  => 'tisara_section_typography',
		'type'     => 'slider',
		'choices'  => array(
			'min' => 12,
			'max' => 100,
			'step' => 1,
			'unit' => 'px',
		),
		'style'    => '.h5, h5 { font-size: [value]px }',
	);

	$controls['tisara_heading6_font_size'] = array(
		'label'    => esc_html__( 'Heading H6 Font Size', 'tisara-wp' ),
		'setting'  => 'tisara_heading6_font_size',
		'section'  => 'tisara_section_typography',
		'type'     => 'slider',
		'choices'  => array(
			'min' => 12,
			'max' => 100,
			'step' => 1,
			'unit' => 'px',
		),
		'style'    => '.h6, h6 { font-size: [value]px }',
	);

	$controls['tisara_wc_heading_button_basic'] = array(
		'label'    => esc_html__( 'Basic Button Style', 'tisara-wp' ),
		'setting'  => 'tisara_wc_heading_button_basic',
		'section'  => 'tisara_section_typography',
		'type'     => 'heading',
	);

	$controls['tisara_button_basic_background'] = array(
		'label'    => esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  => 'tisara_button_basic_background',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'button, input[type="button"], input[type="reset"], input[type="submit"] { background-color: [value] }',
	);

	$controls['tisara_button_basic_border'] = array(
		'label'    => esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  => 'tisara_button_basic_border',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'button, input[type="button"], input[type="reset"], input[type="submit"] { border-color: [value] }',
	);

	$controls['tisara_button_basic_color'] = array(
		'label'    => esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  => 'tisara_button_basic_color',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'button, input[type="button"], input[type="reset"], input[type="submit"] { color: [value] }',
	);

	$controls['tisara_button_basic_background_hover'] = array(
		'label'    => esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  => 'tisara_button_basic_background_hover',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { background-color: [value] }',
	);

	$controls['tisara_button_basic_border_hover'] = array(
		'label'    => esc_html__( 'Border Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  => 'tisara_button_basic_border_hover',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { border-color: [value] }',
	);

	$controls['tisara_button_basic_color_hover'] = array(
		'label'    => esc_html__( 'Text Color', 'tisara-wp' ).' '.esc_html__( '(Hover)', 'tisara-wp' ),
		'setting'  => 'tisara_button_basic_color_hover',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => 'button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover { color: [value] }',
	);

	$controls['tisara_heading_searchform'] = array(
		'label'    => esc_html__( 'Search Form', 'tisara-wp' ),
		'setting'  => 'tisara_heading_searchform',
		'section'  => 'tisara_section_typography',
		'type'     => 'heading',
	);

	$controls['tisara_searchform_background'] = array(
		'label'    => esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  => 'tisara_searchform_background',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.search-form .search-field { background-color: [value] }',
	);

	$controls['tisara_searchform_border'] = array(
		'label'    => esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  => 'tisara_searchform_border',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.search-form .search-field { border-color: [value] }',
	);

	$controls['tisara_searchform_color'] = array(
		'label'    => esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  => 'tisara_searchform_color',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.search-form .search-field { color: [value] }',
	);

	$controls['tisara_searchform_placeholder'] = array(
		'label'    => esc_html__( 'Placeholder Color', 'tisara-wp' ),
		'setting'  => 'tisara_searchform_placeholder',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.search-form .search-field::-webkit-input-placeholder { color: [value] } .search-form .search-field:-ms-input-placeholder { color: [value] } .search-form .search-field::-ms-input-placeholder { color: [value] } .search-form .search-field::placeholder { color: [value] }',
	);

	$controls['tisara_searchform_button_background'] = array(
		'label'    => esc_html__( 'Button', 'tisara-wp' ).' '.esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  => 'tisara_searchform_button_background',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.search-form .search-submit, .search-form .search-submit:hover { background-color: [value]; border-color: [value] }',
	);

	$controls['tisara_searchform_button_color'] = array(
		'label'    => esc_html__( 'Button', 'tisara-wp' ).' '.esc_html__( 'Text Color', 'tisara-wp' ),
		'setting'  => 'tisara_searchform_button_color',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.search-form .search-submit, .search-form .search-submit:hover { color: [value] }',
	);

	$controls['tisara_heading_pagination'] = array(
		'label'    => esc_html__( 'Pagination Style', 'tisara-wp' ),
		'setting'  => 'tisara_heading_pagination',
		'section'  => 'tisara_section_typography',
		'type'     => 'heading',
	);

	$controls['tisara_pagination_alignment'] = array(
		'label'    => esc_html__( 'Alignment', 'tisara-wp' ),
		'setting'  => 'tisara_pagination_alignment',
		'section'  => 'tisara_section_typography',
		'type'     => 'radio-iconset',
		'choices'  => array(
			'left' => 'dashicons dashicons-editor-alignleft',
			'center' => 'dashicons dashicons-editor-aligncenter',
			'right' => 'dashicons dashicons-editor-alignright',
		),
		'style'    => array(
			'left' => '.blog-pagination, .woocommerce nav.woocommerce-pagination { text-align: left; }',
			'center' => '.blog-pagination, .woocommerce nav.woocommerce-pagination { text-align: center; }',
			'right' => '.blog-pagination, .woocommerce nav.woocommerce-pagination { text-align: right; }',
		),
	);

	$controls['tisara_pagination_link_color'] = array(
		'label'    => esc_html__( 'Link Color', 'tisara-wp' ),
		'setting'  => 'tisara_pagination_link_color',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.blog-pagination ul li a, .blog-pagination ul li span, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span { color: [value] }',
	);

	$controls['tisara_pagination_link_background'] = array(
		'label'    => esc_html__( 'Background Color', 'tisara-wp' ),
		'setting'  => 'tisara_pagination_link_background',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.blog-pagination ul li a, .blog-pagination ul li span, .woocommerce nav.woocommerce-pagination ul li a, .woocommerce nav.woocommerce-pagination ul li span { background-color: [value] }',
	);

	$controls['tisara_pagination_link_border'] = array(
		'label'    => esc_html__( 'Border Color', 'tisara-wp' ),
		'setting'  => 'tisara_pagination_link_border',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.blog-pagination ul, .woocommerce nav.woocommerce-pagination ul, .blog-pagination ul li, .woocommerce nav.woocommerce-pagination ul li { border-color: [value] }',
	);

	$controls['tisara_pagination_link_color_active'] = array(
		'label'    => esc_html__( 'Link Color', 'tisara-wp' ).' '.esc_html__( '(Active & Hover)', 'tisara-wp' ),
		'setting'  => 'tisara_pagination_link_color_active',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.blog-pagination ul li span.current, .blog-pagination ul li a:hover, .blog-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus { color: [value] }',
	);

	$controls['tisara_pagination_link_background_active'] = array(
		'label'    => esc_html__( 'Background Color', 'tisara-wp' ).' '.esc_html__( '(Active & Hover)', 'tisara-wp' ),
		'setting'  => 'tisara_pagination_link_background_active',
		'section'  => 'tisara_section_typography',
		'type'     => 'color',
		'style'    => '.blog-pagination ul li span.current, .blog-pagination ul li a:hover, .blog-pagination ul li a:focus, .woocommerce nav.woocommerce-pagination ul li span.current, .woocommerce nav.woocommerce-pagination ul li a:hover, .woocommerce nav.woocommerce-pagination ul li a:focus { background-color: [value] }',
	);

	return $controls;
}
