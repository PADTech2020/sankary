<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

function tisara_wp_menu_page_primary() {
	$menu = wp_page_menu( 
		array(
			'menu_id'      => 'header-menu-primary',
			'menu_class'   => 'header-menu-primary pull-left',
			'container'    => 'nav',
			'echo'         => false,
			'before'       => '<ul id="menu-primary" class="menu-primary menu">',
			'after'        => '</ul>',
		) 
	);
	/* Match markup output from wp_menu_page with wp_nav_menu output */
	echo str_replace( 
		array( 'page_item', 'page-item', 'children', '_has_children', '_has_sub-menu' ), 
		array( 'menu-item', 'menu-item', 'sub-menu', '-has-children', '-has-children' ), 
		$menu 
	);
}