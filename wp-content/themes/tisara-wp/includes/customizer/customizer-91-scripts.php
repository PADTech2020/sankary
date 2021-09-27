<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_filter( 'tisara_customize_controls', 'tisara_customize_controls_scripts' );
function tisara_customize_controls_scripts( $controls ) {

	$controls['tisara_section_scripts'] = array(
		'setting'	=> 'tisara_section_scripts',
		'title'		=> esc_html__( 'Header & Footer Scripts', 'tisara-wp' ),
		'priority'	=> 91,
		'panel' 	=> 'tisara_panel_settings',
		'type' 		=> 'section'
	);

		$controls['tisara_header_scripts'] = array(
			'setting'	=> 'tisara_header_scripts',
			'type'		=> 'textarea-unfiltered',
			'label'		=> esc_html__( 'Custom Header Script', 'tisara-wp' ),
			'section'	=> 'tisara_section_scripts',
		);

		$controls['tisara_footer_scripts'] = array(
			'setting'	=> 'tisara_footer_scripts',
			'type'		=> 'textarea-unfiltered',
			'label'		=> esc_html__( 'Custom Footer Script', 'tisara-wp' ),
			'section'	=> 'tisara_section_scripts',
		);

	return $controls;
}
