<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_action( 'tgmpa_register', 'tisara_register_required_plugins' );
function tisara_register_required_plugins() {

	/* Plugins lists. */
	$plugins = array(
		array(
			'name' 		=> '01 - Elementor',
			'slug' 		=> 'elementor',
			'required' 	=> true,
		),
		array(
			'name' 		=> '02 - WooCommerce',
			'slug' 		=> 'woocommerce',
			'required' 	=> true
		),
		array(
			'name' 		=> '03 - TisaraWP Addons',
			'slug' 		=> 'tisara-wp-addons',
			'source'   	=> 'http://import.tokomoo.com/tokoo-plugins/tisara-wp-addons-v' . TISARA_THEME_ADDONS_VERSION . '.zip',
			'required' 	=> true,
			'version' 	=> TISARA_THEME_ADDONS_VERSION,
		),
		array(
			'name' 		=> '04 - One Click Demo Import',
			'slug' 		=> 'one-click-demo-import',
			'required' 	=> false,
		),
		array(
			'name' 		=> '05 - Regenerate Thumbnails',
			'slug' 		=> 'regenerate-thumbnails',
			'required' 	=> false,
		),
	);

	$theme_text_domain = 'tisara';
	$config = array(
		'domain'            => $theme_text_domain,          
		'default_path'      => '',                      
		'menu'              => 'tisara-install-plugins',
		'parent_slug'  		=> 'tisara_settings', 
		'capability'		=> 'edit_theme_options',
		'has_notices'       => true,                    
		'dismissable'       => true,                    
		'dismiss_msg'       => '',                      
		'is_automatic'      => true,                  
		'message'           => '',                          
	);

	tgmpa( $plugins, $config );

}
