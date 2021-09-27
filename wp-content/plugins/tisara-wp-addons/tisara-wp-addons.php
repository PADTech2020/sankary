<?php
/**
Plugin Name: Tisara WP Addons
Plugin URI: https://tisara.selaraswp.com
Description: Required Plugins For Tisara WP Premium WordPress Theme
Version: 0.3.0
Author: SelarasWP
Author URI: https://www.selaraswp.com
*/ 

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( !defined( 'TISARA_ADDONS_PATH' ) ) {
	define( 'TISARA_ADDONS_PATH', plugin_dir_path( __FILE__ ) );
}
if ( !defined( 'TISARA_ADDONS_URL' ) ) {
	define( 'TISARA_ADDONS_URL', plugins_url( '', __FILE__ ) );
}
if ( !defined( 'TISARA_ADDONS_VERSION' ) ) {
	define( 'TISARA_ADDONS_VERSION', '0.2.0' );
}

if( !class_exists( 'Tisara_Addons_Init' ) ) {

class Tisara_Addons_Init {

	private static $instance;

	public static function get_instance() {
		return null === self::$instance ? ( self::$instance = new self ) : self::$instance;
	}

	public function __construct() {
		add_action( 'init', array( $this, 'load_textdomain' ) );
		$this->load_metabox();
		$this->load_mega_menus();
		$this->load_elementor_addons();
		$this->load_optimizations();
	}

	public function load_textdomain() {
		load_plugin_textdomain( 'tisara-wp-addons', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	public function load_metabox() {
		require_once( TISARA_ADDONS_PATH . '/metabox/metabox.php' );
		require_once( TISARA_ADDONS_PATH . '/metabox/setup-metabox.php' );
	}

	public function load_mega_menus() {
		define( 'TISARA_MEGA_MENUS_DIR', TISARA_ADDONS_PATH . '/mega-menus' );
		define( 'TISARA_MEGA_MENUS_URI', TISARA_ADDONS_URL . '/mega-menus' );
		define( 'TISARA_MEGA_MENUS_ASSETS_URI', get_template_directory_uri() . '/assets' );
		require_once( TISARA_ADDONS_PATH . '/mega-menus/mega-menus.php' );
		require_once( TISARA_ADDONS_PATH . '/mega-menus/mega-menus-walker.php' );
		require_once( TISARA_ADDONS_PATH . '/mega-menus/mega-menus-walker-edit.php' );
	}

	public function load_elementor_addons() {
		require_once( TISARA_ADDONS_PATH . '/elementor-addons/elementor-addons.php');
	}

	public function load_optimizations() {
		require_once( TISARA_ADDONS_PATH . '/optimizations/optimizations.php');
		require_once( TISARA_ADDONS_PATH . '/optimizations/customizer.php');
	}

}

}

add_action( 'plugins_loaded' , array( 'Tisara_Addons_Init' , 'get_instance' ), 0 );
