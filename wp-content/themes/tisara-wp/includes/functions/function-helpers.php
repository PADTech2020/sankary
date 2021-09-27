<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

/**
 * Get Sidebar Layout
 */
function tisara_get_sidebar_layout( $mode = '' ) {
	$sidebar_layout = tisara_theme_mod( 'tisara_blog_sidebar_layout' );

	if ( is_active_sidebar( 'sidebar-1' ) && $sidebar_layout != 'none') {
		$sidebar_layout = 'right';
	} else {
		$sidebar_layout = 'none';
	}

	if ( ! empty( $mode ) ) {
		$sidebar_layout_mode = tisara_theme_mod( 'tisara_'.$mode.'_sidebar_layout' );
		if ( $sidebar_layout_mode != 'none' &&  is_active_sidebar( 'sidebar-1' )  ) {
			$sidebar_layout = $sidebar_layout_mode;
		} else{
			$sidebar_layout = 'none';
		}
	}
	if ( class_exists('Tisara_Metabox') ) {
		if ( in_array( $mode, array( 'single', 'page' ) ) ) {
			$sidebar_layout_meta = get_post_meta( get_the_ID(), '_sidebar_layout', true );
			if ( $sidebar_layout_meta ) {
				$sidebar_layout = $sidebar_layout_meta;
			}
		}
	}
	if ( empty( $sidebar_layout ) ) {
		if ( is_active_sidebar( 'sidebar-1' ) ) {
				$sidebar_layout = 'right';
		} else {
			$sidebar_layout = 'none';
		}
	}
	if ( class_exists( 'WooCommerce') ) {
		if ( is_cart() || is_checkout() || is_account_page() ) {
			$sidebar_layout = 'none';
		}
	}
	return $sidebar_layout;
}

/**
 * Entry meta - Sticky
 */
if ( ! function_exists( 'tisara_meta_sticky' ) ) :
function tisara_meta_sticky( $before = '', $after = '', $wrapper_before = '', $wrapper_after = '' ) {
	$output = '';
	if ( is_sticky() && is_home() ) {
		$output = $wrapper_before.'<span class="entry-meta-item entry-meta-sticky">'.$before.__( 'Sticky', 'tisara-wp' ).$after.'</span>'.$wrapper_after;
	}
	return $output;
}
endif;

/**
 * Entry meta - Post Type
 */
if ( ! function_exists( 'tisara_meta_type' ) ) :
function tisara_meta_type( $before = '', $after = '', $wrapper_before = '', $wrapper_after = '' ) {
	$output = '';
	$object = get_post_type_object( get_post_type() );
	if ( isset( $object->name ) ) $type = $object->name;
	if ( isset( $object->labels->name ) ) $type = $object->labels->name;
	if ( isset( $object->labels->singular_name ) ) $type = $object->labels->singular_name;
	if ( isset( $type ) ) {
		$output = $wrapper_before.'<span class="entry-meta-item entry-meta-type">'.$before.$type.$after.'</span>'.$wrapper_after;
	}
	return $output;
}
endif;

/**
 * Entry meta - Post Categories
 */
if ( ! function_exists( 'tisara_meta_categories' ) ) :
function tisara_meta_categories( $before = '', $after = '', $separator = ', ', $wrapper_before = '', $wrapper_after = '' ) {
	return get_the_term_list( get_the_ID(), 'category', $wrapper_before.'<span class="entry-meta-item entry-meta-categories">'.$before, $separator, $after.'</span>'.$wrapper_after );
}
endif;

/**
 * Entry meta - Post Tags
 */
if ( ! function_exists( 'tisara_meta_tags' ) ) :
function tisara_meta_tags( $before = '', $after = '', $separator = ', ', $wrapper_before = '', $wrapper_after = '' ) {
	return get_the_term_list( get_the_ID(), 'post_tag', $wrapper_before.'<span class="entry-meta-item entry-meta-tags">'.$before, $separator, $after.'</span>'.$wrapper_after );
}
endif;

/**
 * Entry meta - Date
 */
if ( ! function_exists( 'tisara_meta_date' ) ) :
function tisara_meta_date( $before = '', $after = '', $wrapper_before = '', $wrapper_after = '' ) {
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$meta_time = '<time class="published" datetime="%1$s">%2$s</time>';
	}
	else {
		$meta_time = '<time class="published updated" datetime="%1$s">%2$s</time>';
	}
	$meta_time = $wrapper_before.'<span class="entry-meta-item entry-meta-time">'.$before.'<a href="%5$s" rel="bookmark">'.$meta_time.'</a>'.$after.'</span>'.$wrapper_after;
	return sprintf( $meta_time,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() ),
		esc_url( get_permalink() )
	);
}
endif;

/**
 * Entry meta - Author
 */
if ( ! function_exists( 'tisara_meta_author' ) ) :
function tisara_meta_author( $before = '', $after = '', $wrapper_before = '', $wrapper_after = '' ) {
	return $wrapper_before.'<span class="entry-meta-item entry-meta-author author vcard">'.$before.'<a href="' . get_author_posts_url( get_the_author_meta( 'ID' ) ) . '" class="post-author-link url fn n" rel="author"><span>'.get_the_author().'</span></a>'.$after.'</span>'.$wrapper_after; 
}
endif;

/**
 * Entry meta - Image Size
 */
if ( ! function_exists( 'tisara_meta_imagesize' ) ) :
function tisara_meta_imagesize( $before = '', $after = '', $wrapper_before = '', $wrapper_after = '' ) {
	$metadata = wp_get_attachment_metadata();
	return $wrapper_before.'<span class="entry-meta-item entry-meta-imagesize">'.$before.'<a href="'.esc_url( wp_get_attachment_url() ).'" title="' . esc_attr__( "Link to full-size image" , "tisara-wp" ) .'">'.$metadata['width'].' ' . esc_html__('&times', "tisara-wp" ) . ' '.$metadata['height'].'</a>'.$after.'</span>'.$wrapper_after;
}
endif;

/**
 * Entry meta - Parent
 */
if ( ! function_exists( 'tisara_meta_parent' ) ) :
function tisara_meta_parent( $before = '', $after = '', $wrapper_before = '', $wrapper_after = '' ) {
	global $post;
	return $wrapper_before.'<span class="entry-meta-item entry-meta-parent">'.$before.'<a href="'.esc_url( get_permalink( $post->post_parent ) ).'" title="' . esc_attr__( "Return to" , "tisara-wp" ) .' ' . esc_attr( strip_tags( get_the_title( $post->post_parent ) ) ).'" rel="gallery">'.get_the_title( $post->post_parent ).'</a>'.$after.'</span>'.$wrapper_after;
}
endif;

/**
 * Entry meta - Edit
 */
if ( ! function_exists( 'tisara_meta_edit' ) ) :
function tisara_meta_edit( $before = '', $after = '', $wrapper_before = '', $wrapper_after = '' ) {
	edit_post_link( esc_html__( 'Edit', 'tisara-wp' ), $wrapper_before.'<span class="entry-meta-item entry-meta-edit">'.$before, $after.'</span>'.$wrapper_after );
}
endif;

/**
 * Entry meta - Output
 */
if ( ! function_exists( 'tisara_meta_output' ) ) :
function tisara_meta_output( $view = 'blog' ) {
	if ( ! $view ) {
		return;
	}
	if ( 'blog' == $view ) {
		$meta_items = tisara_theme_mod( 'tisara_blog_meta_items' );
	}
	elseif ( 'single' == $view ) {
		$meta_items = tisara_theme_mod( 'tisara_single_meta_items' );
	}
	elseif ( 'search' == $view ) {
		$meta_items = array( 'type', 'date', 'categories' );
	}
	if ( ! empty( $meta_items ) ) {
		echo '<div class="entry-meta">';
		foreach ( $meta_items as $meta_item ) {
			if ( 'sticky' == $meta_item ) {
				echo tisara_meta_sticky( '<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 384 512"><path d="M298.028 214.267L285.793 96H328c13.255 0 24-10.745 24-24V24c0-13.255-10.745-24-24-24H56C42.745 0 32 10.745 32 24v48c0 13.255 10.745 24 24 24h42.207L85.972 214.267C37.465 236.82 0 277.261 0 328c0 13.255 10.745 24 24 24h136v104.007c0 1.242.289 2.467.845 3.578l24 48c2.941 5.882 11.364 5.893 14.311 0l24-48a8.008 8.008 0 0 0 .845-3.578V352h136c13.255 0 24-10.745 24-24-.001-51.183-37.983-91.42-85.973-113.733z"/></svg> ', ' ' );
			}
			elseif ( 'date' == $meta_item ) {
				echo tisara_meta_date( '<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200zm61.8-104.4l-84.9-61.7c-3.1-2.3-4.9-5.9-4.9-9.7V116c0-6.6 5.4-12 12-12h32c6.6 0 12 5.4 12 12v141.7l66.8 48.6c5.4 3.9 6.5 11.4 2.6 16.8L334.6 349c-3.9 5.3-11.4 6.5-16.8 2.6z"/></svg> ', ' ' );
			}
			elseif ( 'categories' == $meta_item ) {
				echo tisara_meta_categories( '<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path d="M464 128H272l-54.63-54.63c-6-6-14.14-9.37-22.63-9.37H48C21.49 64 0 85.49 0 112v288c0 26.51 21.49 48 48 48h416c26.51 0 48-21.49 48-48V176c0-26.51-21.49-48-48-48zm0 272H48V112h140.12l54.63 54.63c6 6 14.14 9.37 22.63 9.37H464v224z"/></svg> ', ' ' );
			}
			elseif ( 'tags' == $meta_item ) {
				echo tisara_meta_tags( '<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 512 512"><path d="M0 252.118V48C0 21.49 21.49 0 48 0h204.118a48 48 0 0 1 33.941 14.059l211.882 211.882c18.745 18.745 18.745 49.137 0 67.882L293.823 497.941c-18.745 18.745-49.137 18.745-67.882 0L14.059 286.059A48 48 0 0 1 0 252.118zM112 64c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48z"/></svg>', ' ' );
			}
			elseif ( 'author' == $meta_item ) {
				echo tisara_meta_author( '<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 448 512"><path d="M313.6 304c-28.7 0-42.5 16-89.6 16-47.1 0-60.8-16-89.6-16C60.2 304 0 364.2 0 438.4V464c0 26.5 21.5 48 48 48h352c26.5 0 48-21.5 48-48v-25.6c0-74.2-60.2-134.4-134.4-134.4zM400 464H48v-25.6c0-47.6 38.8-86.4 86.4-86.4 14.6 0 38.3 16 89.6 16 51.7 0 74.9-16 89.6-16 47.6 0 86.4 38.8 86.4 86.4V464zM224 288c79.5 0 144-64.5 144-144S303.5 0 224 0 80 64.5 80 144s64.5 144 144 144zm0-240c52.9 0 96 43.1 96 96s-43.1 96-96 96-96-43.1-96-96 43.1-96 96-96z"/></svg> ', ' ' );
			}
			elseif ( 'type' == $meta_item ) {
				echo tisara_meta_type( '<svg xmlns="https://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 384 512"><path d="M288 248v28c0 6.6-5.4 12-12 12H108c-6.6 0-12-5.4-12-12v-28c0-6.6 5.4-12 12-12h168c6.6 0 12 5.4 12 12zm-12 72H108c-6.6 0-12 5.4-12 12v28c0 6.6 5.4 12 12 12h168c6.6 0 12-5.4 12-12v-28c0-6.6-5.4-12-12-12zm108-188.1V464c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V48C0 21.5 21.5 0 48 0h204.1C264.8 0 277 5.1 286 14.1L369.9 98c9 8.9 14.1 21.2 14.1 33.9zm-128-80V128h76.1L256 51.9zM336 464V176H232c-13.3 0-24-10.7-24-24V48H48v416h288z"/></svg> ', ' ' );
			}
		}
		echo '</div>';
	}
}
endif;

/**
 * Excerpt Length
 */
function tisara_excerpt_length_20( $length ) {
	return 20;
}
function tisara_excerpt_length_50( $length ) {
	return 50;
}
