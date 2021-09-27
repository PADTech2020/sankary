<?php 

add_filter( 'tisara_customize_controls', 'tisara_optimization_settings_data' );
function tisara_optimization_settings_data( $controls ) {

	$controls['tisara_optimization_settings'] = array(
		'setting'	=> 'tisara_optimization_settings',
		'title'		=> esc_html__( 'Optimizations', 'tisara-wp-addons' ),
		'priority'	=> 93,
		'panel' 	=> 'tisara_panel_settings',
		'type' 		=> 'section'
	);

		$controls['tisara_disable_responsive_images'] = array(
			'setting'	=> 'tisara_disable_responsive_images',
			'type' 		=> 'checkbox',
		    'default'	=> true,
			'label' 	=> esc_html__( 'Disable WordPress Responsive Images', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
		);

		$controls['tisara_disable_emojis'] = array(
			'setting'	=> 'tisara_disable_emojis',
			'type' 		=> 'checkbox',
		    'default'	=> true,
			'label' 	=> esc_html__( 'Disable WordPress Emojis', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
		);

		$controls['tisara_disable_wp_generator'] = array(
			'setting'	=> 'tisara_disable_wp_generator',
			'type' 		=> 'checkbox',
		    'default'	=> true,
			'label' 	=> esc_html__( 'Disable WordPress generator on document header', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
		);

		$controls['tisara_disable_wlwmanifest'] = array(
			'setting'	=> 'tisara_disable_wlwmanifest',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Disable Windows Live Writer link on document header', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
		);

		$controls['tisara_disable_rsd'] = array(
			'setting'	=> 'tisara_disable_rsd',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Disable Really Simple Discovery link on document header', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
		);

		$controls['tisara_disable_shortlink'] = array(
			'setting'	=> 'tisara_disable_shortlink',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Disable Shortlink on document header', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
		);

		$controls['tisara_disable_relational'] = array(
			'setting'	=> 'tisara_disable_relational',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Disable Relational Links on document header', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
			'transport' => 'refresh',
		);

		$controls['tisara_disable_feed'] = array(
			'setting'	=> 'tisara_disable_feed',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Disable Automatic Feed Links on document header', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
			'transport' => 'refresh',
		);

		$controls['tisara_disable_rest'] = array(
			'setting'	=> 'tisara_disable_rest',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Disable REST API Links on document header', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
			'transport' => 'refresh',
		);

		$controls['tisara_disable_oembed'] = array(
			'setting'	=> 'tisara_disable_oembed',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Disable oEmbed discovery links on document header', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
			'transport' => 'refresh',
		);

		$controls['tisara_enable_defer_parsing'] = array(
			'setting'	=> 'tisara_enable_defer_parsing',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Enable Defer Parsing Javascript', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
		);

		$controls['tisara_remove_query_string'] = array(
			'setting'	=> 'tisara_remove_query_string',
			'type' 		=> 'checkbox',
		    'default'	=> false,
			'label' 	=> esc_html__( 'Remove Query String', 'tisara-wp-addons' ),
			'section'	=> 'tisara_optimization_settings',
		);

	return $controls;
}
