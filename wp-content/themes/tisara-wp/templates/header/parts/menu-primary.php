<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$menu_args = array(
	'theme_location'	=> 'primary',
	'container'			=> 'nav',
	'container_class'	=> 'header-menu-primary pull-left',
	'container_id'	    => 'header-menu-primary',
	'menu_class'		=> 'menu-primary menu',
	'menu_id'	    	=> 'menu-primary',
	'fallback_cb'		=> 'tisara_wp_menu_page_primary',
);
if ( class_exists( 'Tisara_Mega_Menus_Walker' ) ) {
	$menu_args['walker'] = new Tisara_Mega_Menus_Walker();
}
wp_nav_menu( $menu_args );
?>
