<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_google_fonts', 'tisara_customize_google_fonts_filter' );
function tisara_customize_google_fonts_filter( $value ) {
	$value['Lato'] = 'Lato';
	$value['Playfair Display'] = 'Playfair Display';
	return $value;
}

add_filter( 'tisara_customize_font_weights', 'tisara_customize_font_weights_filter', 1 );
function tisara_customize_font_weights_filter( $value ) {
	return array('400','700');
}

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_panel_theme_settings' );
function tisara_customize_controls_panel_theme_settings( $controls ) {
	$controls['tisara_panel_settings'] = array(
		'title'    => esc_html__( 'Theme Settings - General', 'tisara-wp' ),
		'setting'  => 'tisara_panel_settings',
		'type'     => 'panel',
		'priority' => 5,
	);
	return $controls;
}

add_action( 'wp_head', 'tisara_output_style', 25 );
function tisara_output_style() {
	$style = apply_filters( 'tisara_style', '' );
	if ( $style ) {
		echo '<style type="text/css">'."\n".$style."\n".'</style>'."\n";
	}
}
add_action( 'customize_register', 'tisara_customize_reposition_options', 20 );
function tisara_customize_reposition_options( $wp_customize ) {
	$title = $wp_customize->get_section( 'title_tagline' )->title;
	$wp_customize->get_section( 'title_tagline' )->title = $title.' &amp; '.esc_html__( 'Favicon', 'tisara-wp' );
	$wp_customize->get_section( 'title_tagline' )->priority = 10;

	$wp_customize->get_section( 'static_front_page' )->priority = 12;

	$site_icon = $wp_customize->get_control( 'site_icon' )->label;
	$wp_customize->get_control( 'site_icon' )->label = $site_icon.' / '.esc_html__( 'Favicon', 'tisara-wp' );

	$wp_customize->get_section( 'background_image' )->title = esc_html__( 'Background', 'tisara-wp' );
	$wp_customize->get_control( 'background_color' )->section = 'background_image';
 
	$wp_customize->get_section( 'header_image' )->panel = 'tisara_panel_settings';
	$wp_customize->get_section( 'header_image' )->priority = 20;
	$wp_customize->remove_control( 'header_textcolor' );
	$wp_customize->remove_control( 'display_header_text' );
	$wp_customize->get_control( 'header_image' )->section = 'tisara_section_header';
	$wp_customize->get_control( 'header_image' )->priority = 53;
	if ( function_exists('tisara_callback_hero_is_active') ) {
		$wp_customize->get_control( 'header_image' )->active_callback = 'tisara_callback_hero_is_active';
	}
}

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_browser_color' );
function tisara_customize_controls_browser_color( $controls ) {

	$controls['tisara_heading_browser_color'] = array(
		'label'    => esc_html__( 'Mobile Browser Tab Color', 'tisara-wp' ),
		'setting'  => 'tisara_heading_browser_color',
		'section'  => 'title_tagline',
		'type'     => 'heading',
		'priority' => 51,
	);

	$controls['tisara_browser_theme_color'] = array(
		'label'    => esc_html__( 'Mobile Browser Tab Color', 'tisara-wp' ),
		'description' => 'Chrome, Firefox OS, Opera, Windows Phone',
		'setting'  => 'tisara_browser_theme_color',
		'section'  => 'title_tagline',
		'type'     => 'color',
		'priority' => 51,
	);

	$controls['tisara_browser_safari_uic_hide'] = array(
		'label'    => esc_html__( 'Hide Mobile Safari User Interface Components', 'tisara-wp' ),
		'setting'  => 'tisara_browser_safari_uic_hide',
		'section'  => 'title_tagline',
		'type'     => 'checkbox',
		'priority' => 51,
	);

	return $controls;
}

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_favicon' );
function tisara_customize_controls_favicon( $controls ) {

	$controls['tisara_heading_favicon'] = array(
		'label'    => esc_html__( 'Favicon', 'tisara-wp' ),
		'setting'  => 'tisara_heading_favicon',
		'section'  => 'title_tagline',
		'type'     => 'heading',
		'priority' => 59,
	);

	return $controls;
}

