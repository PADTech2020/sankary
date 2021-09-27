<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_footer' );
function tisara_customize_controls_footer( $controls ) {

	$controls['tisara_section_footer'] = array(
		'setting'	=> 'tisara_section_footer',
		'title'		=> esc_html__( 'Footer', 'tisara-wp' ),
		'panel'	    => 'tisara_panel_settings',
		'priority'	=> 23,
		'type' 		=> 'section'
	);

		$controls['tisara_footer_elementor_before'] = array(
			'setting'	=> 'tisara_footer_elementor_before',
			'label'     => esc_html__( 'Elementor Footer Before', 'tisara-wp' ),
			'description' => esc_html__( 'Note: Before Theme Footer', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type'      => 'select',
			'choices'	=> tisara_get_post_types( 'elementor_library', 50, esc_html__( '- Select Elementor Templates -', 'tisara-wp' ) ),
		);

		$controls['tisara_footer_layout'] = array(
			'setting'	=> 'tisara_footer_layout',
			'label'     => esc_html__( 'Theme Footer Layout', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type'      => 'radio',
			'choices'	=> array( 
						'style-1' => esc_html__( 'Footer Style 1', 'tisara-wp' ),
						'style-2' => esc_html__( 'Footer Style 2', 'tisara-wp' ),
						'style-3' => esc_html__( 'Footer Style 3', 'tisara-wp' ),
						'style-4' => esc_html__( 'Footer Style 4', 'tisara-wp' ),
						'style-5' => esc_html__( 'Footer Style 5', 'tisara-wp' ),
						'style-6' => esc_html__( 'Footer Style 6', 'tisara-wp' ),
						'hide' => esc_html__( 'Hide Theme Footer', 'tisara-wp' ),
					),
		);

		$controls['tisara_footer_elementor_after'] = array(
			'setting'	=> 'tisara_footer_elementor_after',
			'label'     => esc_html__( 'Elementor Footer After', 'tisara-wp' ),
			'description' => esc_html__( 'Note: After Theme Footer', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type'      => 'select',
			'choices'	=> tisara_get_post_types( 'elementor_library', 50, esc_html__( '- Select Elementor Templates -', 'tisara-wp' ) ),
		);

		$controls['tisara_heading_footer_top'] = array(
			'setting'	=> 'tisara_heading_footer_top',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Footer Top (Widgets Area)', 'tisara-wp' ),
			'description' 		=> '<p class="tisara-alert tisara-alert-with-icon">
									<span class="dashicons dashicons-admin-tools"></span> <a href="javascript:wp.customize.panel( \'widgets\' ).focus();">'.esc_html__( 'CLICK HERE to setup / manage widgets when footer widgets is available', 'tisara-wp' ).'</a>
									</p>',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_top_hide'] = array(
			'setting'	=> 'tisara_footer_top_hide',
			'label'		=> esc_html__( 'Hide Footer Top (Widgets Area)', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_top_color_bg'] = array(
			'setting'	=> 'tisara_footer_top_color_bg',
			'label'		=> esc_html__( 'Footer Top - Background Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-top { background : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_top_color_title'] = array(
			'setting'	=> 'tisara_footer_top_color_title',
			'label'		=> esc_html__( 'Footer Top - Widget Title Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-top .widget .widget-title, .footer-top .widget .widget-title a { color : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_top_color_text'] = array(
			'setting'	=> 'tisara_footer_top_color_text',
			'label'		=> esc_html__( 'Footer Top - Widget Text Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-top .widget, .footer-top .widget a, .footer-top .widget ul li a { color : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_top_color_link'] = array(
			'setting'	=> 'tisara_footer_top_color_link',
			'label'		=> esc_html__( 'Footer Top - Widget Link Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-top .widget a, .footer-top .widget ul li a { color : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_heading_footer_bottom'] = array(
			'setting'	=> 'tisara_heading_footer_bottom',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Footer Bottom (Credits & Info)', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_bottom_hide'] = array(
			'setting'	=> 'tisara_footer_bottom_hide',
			'label'		=> esc_html__( 'Hide Footer Bottom (Credits & Info)', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_bottom_color_bg'] = array(
			'setting'	=> 'tisara_footer_bottom_color_bg',
			'label'		=> esc_html__( 'Footer Bottom - Background Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-bottom { background : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_bottom_color_text'] = array(
			'setting'	=> 'tisara_footer_bottom_color_text',
			'label'		=> esc_html__( 'Footer Bottom - Text Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-bottom { color : [value]; } .footer-bottom svg { fill : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_bottom_color_link'] = array(
			'setting'	=> 'tisara_footer_bottom_color_link',
			'label'		=> esc_html__( 'Footer Bottom - Link Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-bottom a { color : [value]; } .footer-bottom a svg { fill : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_bottom_color_link_hover'] = array(
			'setting'	=> 'tisara_footer_bottom_color_link_hover',
			'label'		=> esc_html__( 'Footer Bottom - Link Color (Hover)', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-bottom a:hover { color : [value]; } .footer-bottom a:hover svg { fill : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_bottom_color_border'] = array(
			'setting'	=> 'tisara_footer_bottom_color_border',
			'label'		=> esc_html__( 'Footer Bottom - Separator Line Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_footer',
			'type' 		=> 'color',
			'style'		=> '.footer-bottom-2 { border-color : [value]; }',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_logo_hide'] = array(
			'setting'	=> 'tisara_footer_logo_hide',
			'label'		=> esc_html__( 'Hide Footer Logo', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_logo'] = array(
			'setting'	=> 'tisara_footer_logo',
			'label'		=> esc_html__( 'Footer Logo', 'tisara-wp' ),
			'type' 		=> 'image',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_menu_hide'] = array(
			'setting'	=> 'tisara_footer_menu_hide',
			'label'		=> esc_html__( 'Hide Footer Menu', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_shortcut_footer_menu_footer'] = array(
			'setting'	=> 'tisara_footer_header_menu_footer',
			'type'		=> 'heading',
			'label'		=> '',
			'description' => '<p class="tisara-alert tisara-alert-with-icon"><span class="dashicons dashicons-admin-appearance"></span> <a href="javascript:wp.customize.section( \'menu_locations\' ).focus();">' . sprintf( esc_html__( 'CLICK HERE to setup %s', 'tisara-wp' ), esc_html__( 'Footer Menu', 'tisara-wp' ) ) . '</a></p>',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_text_hide'] = array(
			'setting'	=> 'tisara_footer_text_hide',
			'label'		=> esc_html__( 'Hide Footer Text', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_text'] = array(
			'setting'	=> 'tisara_footer_text',
			'type'		=> 'textarea',
			'label'		=> esc_html__( 'Footer Text', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => sprintf( esc_attr__( 'Copyright &copy; %s %s', 'tisara-wp' ), date( 'Y' ), '<a class="site-link" href="' . home_url("/") . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . '">' . get_bloginfo( 'name' ) . '</a>' ),
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_hide'] = array(
			'setting'	=> 'tisara_footer_social_hide',
			'label'		=> esc_html__( 'Hide Footer Social Icons', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_icons'] = array(
			'setting'  => 'tisara_footer_social_icons',
			'type'     => 'sortable',
			'label'    => esc_html__( 'Footer Social Icons', 'tisara-wp' ),
			'choices'  => array(
				'facebook' => esc_html__( 'Facebook', 'tisara-wp' ),
				'twitter' => esc_html__( 'Twitter', 'tisara-wp' ),
				'youtube' => esc_html__( 'Youtube', 'tisara-wp' ),
				'instagram' => esc_html__( 'Instagram', 'tisara-wp' ),
				'pinterest' => esc_html__( 'Pinterest', 'tisara-wp' ),
				'rss' => esc_html__( 'RSS Feed', 'tisara-wp' ),
				'email' => esc_html__( 'Email', 'tisara-wp' ),
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_facebook'] = array(
			'setting' 	=> 'tisara_footer_social_facebook',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Facebook URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_twitter'] = array(
			'setting' 	=> 'tisara_footer_social_twitter',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Twitter URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_youtube'] = array(
			'setting' 	=> 'tisara_footer_social_youtube',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Youtube URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_instagram'] = array(
			'setting' 	=> 'tisara_footer_social_instagram',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Instagram URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_pinterest'] = array(
			'setting' 	=> 'tisara_footer_social_pinterest',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Pinterest URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_rss'] = array(
			'setting' 	=> 'tisara_footer_social_rss',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'RSS Feed URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

		$controls['tisara_footer_social_email'] = array(
			'setting' 	=> 'tisara_footer_social_email',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Email Address', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'email@yourdomain',
			),
			'section'	=> 'tisara_section_footer',
			'active_callback' => 'tisara_callback_footer_is_style',
		);

	return $controls;
}

function tisara_callback_footer_is_style(){
	return !in_array( tisara_theme_mod( 'tisara_footer_layout' ), array( 'hide' ) ) ? true : false;
}
