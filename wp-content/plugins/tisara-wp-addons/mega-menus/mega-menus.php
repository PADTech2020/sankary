<?php

class Tisara_Mega_Menus {

	protected $has_custom_walker = null;

	/**
	 * Initializes the plugin by setting localization, filters, and administration functions.
	 */
	function __construct() {
		add_action( 'admin_enqueue_scripts', array( $this, 'custom_menu_script' ), 10 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_font_icons' ), 10 );

		add_filter( 'wp_setup_nav_menu_item', array( $this, 'tisara_add_custom_nav_fields' ) );
		add_action( 'wp_update_nav_menu_item', array( $this, 'tisara_update_custom_nav_fields' ), 10, 3 );
		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'tisara_edit_walker' ), 10, 2 );

		// @TO DO  == Add Custom Menu Item
		// add_action( 'admin_init', array( $this, 'add_nav_menu_meta_boxes' ) );
	} // end constructor

	/**
	 * Enqueue Script for admin page menus
	 *
	 * @return void
	 * @author tokoo
	 **/
	function custom_menu_script() {

		$theme 			= wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );
		wp_enqueue_media();
		wp_enqueue_style( 'custom-menu-style',   TISARA_MEGA_MENUS_URI . '/css/custom-menu.css' );
		wp_enqueue_style( 'font-picker',         TISARA_MEGA_MENUS_URI . '/css/jquery.fonticonpicker.min.css' );
		wp_enqueue_style( 'font-picker-theme',   TISARA_MEGA_MENUS_URI . '/css/jquery.fonticonpicker.grey.min.css' );
		// wp_enqueue_style( 'megamenus-icons',     TISARA_MEGA_MENUS_ASSETS_URI . '/css/megamenus-icons.min.css' );
		// wp_enqueue_style( 'tisara-font-icons',     TISARA_MEGA_MENUS_ASSETS_URI . '/css/font-icons.min.css' );
		wp_enqueue_script( 'font-picker',        TISARA_MEGA_MENUS_URI . '/js/jquery.fonticonpicker.min.js', array('jquery'), '20150526', true );
		wp_enqueue_script( 'custom-menu-script', TISARA_MEGA_MENUS_URI . '/js/custom-menu.js', array('jquery','font-picker'), '20150526', true );

	}

	/**
	 * Enqueue Scripts frontend
	 *
	 * @return void
	 * @author tokoo
	 **/
	function load_font_icons(){

		// $theme 			= wp_get_theme( get_template(), get_theme_root( get_template_directory() ) );
		// wp_enqueue_style( 'megamenus-icons', TISARA_MEGA_MENUS_ASSETS_URI . '/css/megamenus-icons.min.css' );
		// wp_enqueue_style( 'tisara-font-icons', TISARA_MEGA_MENUS_ASSETS_URI . '/css/font-icons.min.css' );
	}

	/**
	 * Add custom fields to $item nav object
	 * in order to be used in custom Walker
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function tisara_add_custom_nav_fields( $menu_item ) {

		$menu_item->mega_menu       = get_post_meta( $menu_item->ID, '_menu_item_mega_menu', true );
		$menu_item->mega_fullwidth  = get_post_meta( $menu_item->ID, '_menu_item_mega_fullwidth', true );
		$menu_item->background_url  = get_post_meta( $menu_item->ID, '_menu_item_background_url', true );
		$menu_item->mm_bg_pos 		= get_post_meta( $menu_item->ID, '_menu_item_mm_bg_pos', true );
		$menu_item->icon_code       = get_post_meta( $menu_item->ID, '_menu_item_icon_code', true );

		return $menu_item;
	}

	/**
	 * Save menu custom fields
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function tisara_update_custom_nav_fields( $menu_id, $menu_item_db_id, $args ) {


		if ( isset( $_REQUEST['menu-item-mega_menu'] ) && is_array( $_REQUEST['menu-item-mega_menu'] ) ) {
			$mega_menu_value = $_REQUEST['menu-item-mega_menu'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_mega_menu', $mega_menu_value );
		}

		if ( isset( $_REQUEST['menu-item-background_url'] ) && is_array( $_REQUEST['menu-item-background_url'] ) ) {
			$background_url_value = $_REQUEST['menu-item-background_url'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_background_url', $background_url_value );
		}

		if ( isset( $_REQUEST['menu-item-mm_bg_pos'] ) && is_array( $_REQUEST['menu-item-mm_bg_pos'] ) ) {
			$bg_pos_value = $_REQUEST['menu-item-mm_bg_pos'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_mm_bg_pos', $bg_pos_value );
		}

		if ( isset( $_REQUEST['menu-item-mega_fullwidth'] ) && is_array( $_REQUEST['menu-item-mega_fullwidth'] ) ) {
			$mega_fullwidth_value = $_REQUEST['menu-item-mega_fullwidth'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_mega_fullwidth', $mega_fullwidth_value );
		}

		if ( isset( $_REQUEST['menu-item-icon_code'] ) && is_array( $_REQUEST['menu-item-icon_code'] ) ) {
			$menu_item_value = $_REQUEST['menu-item-icon_code'][$menu_item_db_id];
			update_post_meta( $menu_item_db_id, '_menu_item_icon_code', $menu_item_value );
		}

	}

	/**
	 * Define new Walker edit
	 *
	 * @access      public
	 * @since       1.0
	 * @return      void
	*/
	function tisara_edit_walker( $walker, $menu_id ) {
		return 'Tisara_Mega_Menus_Walker_Edit';
	}

}

$GLOBALS['tisara_mega_menus'] = new Tisara_Mega_Menus();


