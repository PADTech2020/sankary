<?php

/**
 * Custom Walker
 *
 * @access      public
 * @since       1.0 
 * @return      void
*/
class Tisara_Mega_Menus_Walker extends Walker_Nav_Menu {
	
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {		   
	   
		global $wp_query;

		$indent 		= ( $depth ) ? str_repeat( "\t", $depth ) : '';
		$class_names 	= $value = '';
		$classes 		= empty( $item->classes ) ? array() : (array) $item->classes;

		if ( isset( $item->mega_menu) && $item->mega_menu == "on" ) {
			array_push( $classes, "mega-menu" );
		}
		if ( isset( $item->mega_fullwidth ) && $item->mega_fullwidth == "on" ) {
			array_push( $classes, "mega-fullwidth" );
		}

		$class_names 	 = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) );
		$class_names 	 = ' class="'. esc_attr( $class_names ) . '"';
		$output 		.= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		$attributes  	 = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes 	.= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes 	.= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes 	.= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
	
		// $prepend     	 = ! empty( $item->icon_code) ? '<i class="'. esc_attr($item->icon_code) .'"></i>': '';
		$prepend     	 = '';
		$append 		 = '';

		if ( ! empty( $args ) ) {
			$item_output  = $args->before;
			$item_output .= '<a'. $attributes .'>';
			$item_output .= $args->link_before .$prepend.apply_filters( 'the_title', $item->title, $item->ID ).$append;
			$item_output .= '</a>';
			$item_output .= $args->after;
		}	
	
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		
		$background_url = isset( $item->background_url ) ? $item->background_url : '';
		$mm_bg_pos = isset( $item->mm_bg_pos ) ? $item->mm_bg_pos : '';

		apply_filters( 'walker_nav_menu_start_lvl', $item_output, $depth, $args->background_url = $background_url, $args->mm_bg_pos = $mm_bg_pos );
	 }
	 
	 function start_lvl( &$output, $depth = 0, $args = array() ) {
		$background_url = isset( $args->background_url ) ? $args->background_url : '';
		$mm_bg_pos = isset( $args->mm_bg_pos ) ? $args->mm_bg_pos : '';

		$bg_class = "";
		$bg_style = "";
		if ( ! empty( $background_url ) || ! empty( $mm_bg_pos ) ) {
			if ( ! empty( $mm_bg_pos ) ) {
				$bg_class = "with_bg_image " . $mm_bg_pos;
			}
			if ( ! empty( $background_url ) ) {
				$bg_style = 'style="background-image:url('.$background_url.');"';
			}
		} 

		$indent  = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"sub-menu ".$bg_class." level-".$depth."\" ".$bg_style.">\n";
	}
}