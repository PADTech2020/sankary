<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_header' );
function tisara_customize_controls_header( $controls ) {

	$controls['tisara_section_header'] = array(
		'title'		=> esc_html__( 'Header', 'tisara-wp' ),
		'setting'  	=> 'tisara_section_header',
		'panel'    	=> 'tisara_panel_settings',
		'type'     	=> 'section',
		'priority' 	=> 21,
	);

		$controls['tisara_header_elementor_before'] = array(
			'setting'	=> 'tisara_header_elementor_before',
			'label'     => esc_html__( 'Elementor Header Before', 'tisara-wp' ),
			'description' => esc_html__( 'Note: Before Theme Header', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type'      => 'select',
			'choices'	=> tisara_get_post_types( 'elementor_library', 50, esc_html__( '- Select Elementor Templates -', 'tisara-wp' ) ),
			'priority' 	=> 10,
		);

		$controls['tisara_header_layout'] = array(
			'setting'	=> 'tisara_header_layout',
			'label'     => esc_html__( 'Theme Header Layout', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type'      => 'radio',
			'choices'	=> array( 
						'style-1' => esc_html__( 'Header Style 1', 'tisara-wp' ),
						'style-2' => esc_html__( 'Header Style 2', 'tisara-wp' ),
						'style-3' => esc_html__( 'Header Style 3', 'tisara-wp' ),
						'style-4' => esc_html__( 'Header Style 4', 'tisara-wp' ),
						'style-5' => esc_html__( 'Header Style 5', 'tisara-wp' ),
						'style-6' => esc_html__( 'Header Style 6', 'tisara-wp' ),
						'style-7' => esc_html__( 'Header Style 7', 'tisara-wp' ),
						'style-8' => esc_html__( 'Header Style 8', 'tisara-wp' ),
						'hide' => esc_html__( 'Hide Theme Header', 'tisara-wp' ),
					),
			'priority' 	=> 10,
		);

		$controls['tisara_header_elementor_after'] = array(
			'setting'	=> 'tisara_header_elementor_after',
			'label'     => esc_html__( 'Elementor Header After', 'tisara-wp' ),
			'description' => esc_html__( 'Note: After Theme Header', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type'      => 'select',
			'choices'	=> tisara_get_post_types( 'elementor_library', 50, esc_html__( '- Select Elementor Templates -', 'tisara-wp' ) ),
			'priority' 	=> 10,
		);

		$controls['tisara_heading_header_sticky'] = array(
			'setting'	=> 'tisara_heading_header_sticky',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Sticky Header', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 20,
		);
		$controls['tisara_header_sticky_disable'] = array(
			'setting'	=> 'tisara_header_sticky_disable',
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'Disable Sticky Header', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 22,
		);

		$controls['tisara_heading_header_top'] = array(
			'setting'	=> 'tisara_heading_header_top',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Header Top (Contact & Social)', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 30,
		);

		$controls['tisara_header_top_hide'] = array(
			'setting'	=> 'tisara_header_top_hide',
			'label'		=> esc_html__( 'Hide Header Top (Contact & Social)', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_color_bg'] = array(
			'setting'	=> 'tisara_header_top_color_bg',
			'label'		=> esc_html__( 'Header Top - Background Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-top { background : [value]; }',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_color_text'] = array(
			'setting'	=> 'tisara_header_top_color_text',
			'label'		=> esc_html__( 'Header Top - Text Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-top { color : [value]; } .header-top svg { fill : [value]; }',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_color_link'] = array(
			'setting'	=> 'tisara_header_top_color_link',
			'label'		=> esc_html__( 'Header Top - Link Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-top a { color : [value]; } .header-top a svg { fill : [value]; }',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_color_link_hover'] = array(
			'setting'	=> 'tisara_header_top_color_link_hover',
			'label'		=> esc_html__( 'Header Top - Link Color (Hover)', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-top a:hover { color : [value]; } .header-top a:hover svg { fill : [value]; }',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_text_hide'] = array(
			'setting'	=> 'tisara_header_top_text_hide',
			'label'		=> esc_html__( 'Hide Header Text', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_text'] = array(
			'setting'	=> 'tisara_header_top_text',
			'type'		=> 'textarea',
			'label'		=> esc_html__( 'Header Text', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'Contact us',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_phone_hide'] = array(
			'setting'	=> 'tisara_header_top_phone_hide',
			'label'		=> esc_html__( 'Hide Header Phone', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_phone'] = array(
			'setting'	=> 'tisara_header_top_phone',
			'type'		=> 'text',
			'label'		=> esc_html__( 'Header Phone', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => '+1 2345 6789',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_email_hide'] = array(
			'setting'	=> 'tisara_header_top_email_hide',
			'label'		=> esc_html__( 'Hide Header Email', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_top_email'] = array(
			'setting'	=> 'tisara_header_top_email',
			'type'		=> 'text',
			'label'		=> esc_html__( 'Header Email', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'email@yourdomain',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 32,
		);

		$controls['tisara_header_social_hide'] = array(
			'setting'	=> 'tisara_header_social_hide',
			'label'		=> esc_html__( 'Hide Header Social Icons', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_header_social_icons'] = array(
			'setting'  => 'tisara_header_social_icons',
			'type'     => 'sortable',
			'label'    => esc_html__( 'Header Social Icons', 'tisara-wp' ),
			'choices'  => array(
				'facebook' => esc_html__( 'Facebook', 'tisara-wp' ),
				'twitter' => esc_html__( 'Twitter', 'tisara-wp' ),
				'youtube' => esc_html__( 'Youtube', 'tisara-wp' ),
				'instagram' => esc_html__( 'Instagram', 'tisara-wp' ),
				'pinterest' => esc_html__( 'Pinterest', 'tisara-wp' ),
				'rss' => esc_html__( 'RSS Feed', 'tisara-wp' ),
				'email' => esc_html__( 'Email', 'tisara-wp' ),
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_header_social_facebook'] = array(
			'setting' 	=> 'tisara_header_social_facebook',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Facebook URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_header_social_twitter'] = array(
			'setting' 	=> 'tisara_header_social_twitter',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Twitter URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_header_social_youtube'] = array(
			'setting' 	=> 'tisara_header_social_youtube',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Youtube URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_header_social_instagram'] = array(
			'setting' 	=> 'tisara_header_social_instagram',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Instagram URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_header_social_pinterest'] = array(
			'setting' 	=> 'tisara_header_social_pinterest',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Pinterest URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_header_social_rss'] = array(
			'setting' 	=> 'tisara_header_social_rss',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'RSS Feed URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_header_social_email'] = array(
			'setting' 	=> 'tisara_header_social_email',
			'type' 		=> 'text',
			'label' 	=> esc_html__( 'Email Address', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'email@yourdomain',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_top_support',
			'priority' 	=> 34,
		);

		$controls['tisara_heading_header_bottom'] = array(
			'setting'	=> 'tisara_heading_header_bottom',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Header Bottom (Logo & Menu)', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 40,
		);

		$controls['tisara_header_bottom_color_bg'] = array(
			'setting'	=> 'tisara_header_bottom_color_bg',
			'label'		=> esc_html__( 'Header Bottom - Background Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-bottom, .site-header-mobile { background : [value]; }',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 42,
		);

		$controls['tisara_header_bottom_color_link'] = array(
			'setting'	=> 'tisara_header_bottom_color_link',
			'label'		=> esc_html__( 'Header Bottom - Menu Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-logo .site-title, .header-logo .site-title a, .header-menu-primary a, .header-bottom-right a, .header-menu-secondary a { color : [value]; } .header-menu-primary svg, .header-bottom-right svg, .header-menu-secondary svg { fill : [value]; }',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 42,
		);

		$controls['tisara_header_bottom_color_link_hover'] = array(
			'setting'	=> 'tisara_header_bottom_color_link_hover',
			'label'		=> esc_html__( 'Header Bottom - Menu Color (Hover)', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-logo .site-title a:hover, .header-menu-primary a:hover, .header-bottom-right a:hover, .header-menu-secondary a:hover { color : [value]; } .header-menu-primary a:hover svg, .header-bottom-right a:hover svg, .header-menu-secondary a:hover svg { fill : [value]; }',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 42,
		);

		$controls['tisara_header_bottom_color_border_hover'] = array(
			'setting'	=> 'tisara_header_bottom_color_border_hover',
			'label'		=> esc_html__( 'Header Bottom - Menu Border (Hover)', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-menu-primary .menu > .menu-item:hover, .header-menu-primary .menu .sub-menu .menu-item:hover > a { border-color : [value]; }',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 42,
		);

		$controls['tisara_header_logo_type'] = array(
			'setting'	=> 'tisara_header_logo_type',
			'label'     => esc_html__( 'Header Logo Type', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type'      => 'radio',
			'choices'	=> array( 
						'image' => esc_html__( 'Logo Image', 'tisara-wp' ),
						'text' => esc_html__( 'Logo Text', 'tisara-wp' ),
					),
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 42,
		);

		$controls['tisara_shortcut_header_logo_image'] = array(
			'setting'	=> 'tisara_shortcut_header_logo_image',
			'type'		=> 'heading',
			'label'		=> '',
			'description' => '<p class="tisara-alert tisara-alert-with-icon"><span class="dashicons dashicons-admin-appearance"></span> <a href="javascript:wp.customize.control( \'custom_logo\' ).focus();">' . sprintf( esc_html__( 'CLICK HERE to setup %s', 'tisara-wp' ), esc_html__( 'Site Logo Image', 'tisara-wp' ) ) . '</a></p>',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_logo_is_image',
			'priority' 	=> 42,
		);

		$controls['tisara_shortcut_header_menu_primary'] = array(
			'setting'	=> 'tisara_shortcut_header_menu_primary',
			'type'		=> 'heading',
			'label'		=> '',
			'description' => '<p class="tisara-alert tisara-alert-with-icon"><span class="dashicons dashicons-admin-appearance"></span> <a href="javascript:wp.customize.section( \'menu_locations\' ).focus();">' . sprintf( esc_html__( 'CLICK HERE to setup %s', 'tisara-wp' ), esc_html__( 'Primary Menu', 'tisara-wp' ) ) . '</a></p>',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 42,
		);

		$controls['tisara_header_bottom_search_hide'] = array(
			'setting'	=> 'tisara_header_bottom_search_hide',
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'Hide Header Search', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_addon_support',
			'priority' 	=> 42,
		);

		$controls['tisara_header_bottom_cart_hide'] = array(
			'setting'	=> 'tisara_header_bottom_cart_hide',
			'type'		=> 'checkbox',
			'label'		=> esc_html__( 'Hide Header Cart', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_addon_support',
			'priority' 	=> 42,
		);

		$controls['tisara_header_bottom_cart_count_color'] = array(
			'setting'	=> 'tisara_header_bottom_cart_count_color',
			'label'		=> esc_html__( 'Header Cart Count Color', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type' 		=> 'color',
			'style'		=> '.header-cart .header-cart-count { background : [value]; }',
			'active_callback' => 'tisara_callback_header_addon_support',
			'priority' 	=> 42,
		);

		$controls['tisara_shortcut_header_menu_secondary'] = array(
			'setting'	=> 'tisara_shortcut_header_menu_secondary',
			'type'		=> 'heading',
			'label'		=> '',
			'description' => '<p class="tisara-alert tisara-alert-with-icon"><span class="dashicons dashicons-admin-appearance"></span> <a href="javascript:wp.customize.section( \'menu_locations\' ).focus();">' . sprintf( esc_html__( 'CLICK HERE to setup %s', 'tisara-wp' ), esc_html__( 'Secondary Menu', 'tisara-wp' ) ) . '</a></p>',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style4',
			'priority' 	=> 42,
		);

		$controls['tisara_header_banner_image'] = array(
			'setting'	=> 'tisara_header_banner_image',
			'type'		=> 'image',
			'label'		=> esc_html__( 'Banner Image', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style5',
			'priority' 	=> 42,
		);

		$controls['tisara_header_banner_url'] = array(
			'setting'	=> 'tisara_header_banner_url',
			'type'		=> 'text',
			'label'		=> esc_html__( 'Banner URL', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => 'https://',
			),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style5',
			'priority' 	=> 42,
		);

		$controls['tisara_heading_hero'] = array(
			'setting'	=> 'tisara_heading_hero',
			'type'		=> 'heading',
			'label'		=> esc_html__( 'Header Hero (Page Title)', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 50,
		);

		$controls['tisara_hero_hide'] = array(
			'setting'	=> 'tisara_hero_hide',
			'label'		=> esc_html__( 'Hide Header Hero (Page Title)', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_header_is_style',
			'priority' 	=> 52,
		);

		$controls['tisara_hero_title_blog'] = array(
			'setting'	=> 'tisara_hero_title_blog',
			'label'		=> esc_html__( 'Page Title For Blog Page', 'tisara-wp' ),
			'input_attrs' => array(
				'placeholder' => esc_html__( 'Blog', 'tisara-wp' ),
			),
			'type' 		=> 'text',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 54,
		);

		$controls['tisara_hero_color_bg'] = array(
			'setting'	=> 'tisara_hero_color_bg',
			'label'		=> esc_html__( 'Page Title Background Color', 'tisara-wp' ),
			'type' 		=> 'color',
			'style'		=> '.site-hero { background: [value]; }',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 54,
		);

		$controls['tisara_hero_color_text'] = array(
			'setting'	=> 'tisara_hero_color_text',
			'label'		=> esc_html__( 'Page Title Text Color', 'tisara-wp' ),
			'type' 		=> 'color',
			'style'		=> '.site-hero .page-title { color: [value]; }',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 54,
		);

		$controls['tisara_hero_font_size'] = array(
			'setting'	=> 'tisara_hero_font_size',
			'label'     => esc_html__( 'Page Title Font Size', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type'    => 'slider',
			'choices' => array(
				'min'  => 10,
				'max'  => 100,
				'step' => 1,
				'unit' => 'px',
			),
			'style'	=> '.site-hero .page-title { font-size: [value]px; }',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 54,
		);

		$controls['tisara_hero_padding_top'] = array(
			'setting'	=> 'tisara_hero_padding_top',
			'label'     => esc_html__( 'Page Title Top Padding', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type'    => 'slider',
			'choices' => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
				'unit' => 'px',
			),
			'style'	=> '.site-hero .container { padding-top: [value]px; }',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 54,
		);

		$controls['tisara_hero_padding_bottom'] = array(
			'setting'	=> 'tisara_hero_padding_bottom',
			'label'     => esc_html__( 'Page Title Bottom Padding', 'tisara-wp' ),
			'section'	=> 'tisara_section_header',
			'type'    => 'slider',
			'choices' => array(
				'min'  => 0,
				'max'  => 100,
				'step' => 1,
				'unit' => 'px',
			),
			'style'	=> '.site-hero .container { padding-bottom: [value]px; }',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 54,
		);

		$controls['tisara_heading_breadcrumb'] = array(
			'setting'	=> 'tisara_heading_breadcrumb',
			'label'		=> esc_html__( 'Breadcrumb', 'tisara-wp' ),
			'type' 		=> 'heading',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 60,
		);

		$controls['tisara_breadcrumb_hide'] = array(
			'setting'	=> 'tisara_breadcrumb_hide',
			'label'		=> esc_html__( 'Hide Breadcrumb', 'tisara-wp' ),
			'type' 		=> 'checkbox',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 62,
		);

		$controls['tisara_breadcrumb_color_text'] = array(
			'setting'	=> 'tisara_breadcrumb_color_text',
			'label'		=> esc_html__( 'Breadcrumb Text Color', 'tisara-wp' ),
			'type' 		=> 'color',
			'style'		=> '.breadcrumb { color: [value]; }',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 64,
		);

		$controls['tisara_breadcrumb_color_link'] = array(
			'setting'	=> 'tisara_breadcrumb_color_link',
			'label'		=> esc_html__( 'Breadcrumb Link Color', 'tisara-wp' ),
			'type' 		=> 'color',
			'style'		=> '.breadcrumb a { color: [value]; }',
			'section'	=> 'tisara_section_header',
			'active_callback' => 'tisara_callback_hero_is_active',
			'priority' 	=> 64,
		);

	return $controls;
}

function tisara_callback_header_is_style(){
	return !in_array( tisara_theme_mod( 'tisara_header_layout' ), array( 'hide' ) ) ? true : false;
}

function tisara_callback_header_is_style4(){
	return in_array( tisara_theme_mod( 'tisara_header_layout' ), array( 'style-4' ) ) ? true : false;
}

function tisara_callback_header_is_style5(){
	return in_array( tisara_theme_mod( 'tisara_header_layout' ), array( 'style-5' ) ) ? true : false;
}

function tisara_callback_header_top_support(){
	return in_array( tisara_theme_mod( 'tisara_header_layout' ), array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5' ) ) ? true : false;
}

function tisara_callback_header_addon_support(){
	return in_array( tisara_theme_mod( 'tisara_header_layout' ), array( 'style-1', 'style-2', 'style-3', 'style-4', 'style-5' ) ) ? true : false;
}

function tisara_callback_header_logo_is_image(){
	return !in_array( tisara_theme_mod( 'tisara_header_layout' ), array( 'hide' ) ) && 'text' != tisara_theme_mod( 'tisara_header_logo_type' ) ? true : false;
}

function tisara_callback_hero_is_active(){
	return !in_array( tisara_theme_mod( 'tisara_header_layout' ), array( 'hide' ) ) && !tisara_theme_mod( 'tisara_hero_hide' ) ? true : false;
}
