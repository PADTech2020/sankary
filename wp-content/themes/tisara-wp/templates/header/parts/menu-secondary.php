<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

$menu_args = array(
	'theme_location'	=> 'secondary',
	'depth' 			=> 1,
	'container'       	=> 'div',
	'container_class' 	=> 'header-menu-secondary',
	'container_id' 		=> 'header-menu-secondary',
	'menu_class'		=> 'menu-secondary menu',
	'menu_id'			=> 'menu-secondary',
	'fallback_cb'		=> false,
);
wp_nav_menu( $menu_args );
?>
