<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( tisara_theme_mod( 'tisara_footer_menu_hide' ) ) {
	return;
}

$menu_args = array(
	'theme_location'	=> 'footer',
	'depth' 			=> 1,
	'container'			=> 'nav',
	'container_class'	=> 'footer-menu',
	'container_id'	    => 'footer-menu',
	'menu_class'		=> 'menu-footer menu',
	'menu_id'	    	=> 'menu-footer',
	'fallback_cb'		=> ''
);
wp_nav_menu( $menu_args );
?>
