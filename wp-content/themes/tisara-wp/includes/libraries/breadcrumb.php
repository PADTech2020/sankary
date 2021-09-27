<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

function tisara_breadcrumb( $args = array() ) {
	echo tisara_get_breadcrumb( $args );
}

function tisara_get_breadcrumb( $args = array() ) {
	$defaults = apply_filters( 'tisara_breadcrumb_defaults', array(
		'delimiter'   => ' <span class="breadcrumb-separator">&#47;</span> ',
		'wrap_before' => '<nav class="breadcrumbs breadcrumb">',
		'wrap_after'  => '</nav>',
		'before'      => '',
		'after'       => '',
		'before_last' => '',
		'after_last'  => '',
		'home'        => esc_html__( 'Home', 'tisara-wp' ),
	) );

	$args = wp_parse_args( $args, $defaults );

	extract( $args );

	global $post, $wp_query;

	if ( get_query_var( 'paged' ) ) {
		$after_last = ' (' . esc_html__( 'Page', 'tisara-wp' ) . ' ' . get_query_var( 'paged' ) . ')' . $after_last;
	}
	elseif ( get_query_var( 'page' ) ) {
		$after_last = ' (' . esc_html__( 'Page', 'tisara-wp' ) . ' ' . get_query_var( 'page' ) . ')' . $after_last;
	}

	$crumbs = array();

	if ( ! empty( $home ) ) {
		$crumbs[] = $before . '<a class="breadcrumb-home" href="' . apply_filters( 'tisara_breadcrumb_home_url', home_url('/') ) . '">' . $home . '</a>' . $after . $delimiter;
	}

	if ( is_home() && !is_front_page() ) {
		$page_id = get_option('page_for_posts');
		if ( 0 < $page_id ) {
			$crumbs[] = $before_last . get_the_title( $page_id ) . $after_last;
		}
	}

	if ( is_singular('post') || is_category() || is_tag() || is_day() || is_month() || is_year() ) {
		if ( get_option('show_on_front') == 'page' && $page_id = get_option('page_for_posts') ) {
			if ( 0 < $page_id ) {
				$crumbs[] = $before . '<a href="' . get_permalink($page_id) . '">' . get_the_title( $page_id ) . '</a>' . $after . $delimiter;
			}
		}
	}

	if ( is_category() ) {

		$cat_obj = $wp_query->get_queried_object();
		$this_category = get_category( $cat_obj->term_id );

		if ( $this_category->parent != 0 ) {
			$parent_category = get_category( $this_category->parent );
			$crumbs[] = get_category_parents($parent_category, TRUE, $delimiter );
		}

		$crumbs[] = $before_last . single_cat_title( '', false ) . $after_last;

	} 
	elseif ( is_tag() ) {

		$crumbs[] = $before_last . single_tag_title( '', false ) . $after_last;
	
	}
	elseif ( is_tax() ) {

		$crumbs[] = $before_last . single_term_title( '', false ) . $after_last;
	
	}
	elseif ( is_author() ) {

		$author = get_queried_object();
		if ( $author ) {
			$crumbs[] = $before_last . $author->display_name . $after_last;
		}

	}
	elseif ( is_day() ) {

		$crumbs[] = $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
		$crumbs[] = $before . '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a>' . $after . $delimiter;
		$crumbs[] = $before_last . get_the_time('d') . $after_last;

	} 
	elseif ( is_month() ) {

		$crumbs[] = $before . '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a>' . $after . $delimiter;
		$crumbs[] = $before_last . get_the_time('F') . $after_last;

	} 
	elseif ( is_year() ) {

		$crumbs[] = $before_last . get_the_time('Y') . $after_last;

	} 
	elseif ( is_search() ) {

		$crumbs[] = $before_last . esc_html__( 'Search results for &ldquo;', 'tisara-wp' ) . get_search_query() . '&rdquo;' . $after_last;

	} 
	elseif ( is_404() ) {

		$crumbs[] = $before_last . esc_html__( '404 - Not Found', 'tisara-wp' ) . $after_last;

	} 
	elseif ( is_single() && !is_attachment() ) {

		if ( get_post_type() != 'post' ) {

			if ( get_post_type_archive_link( get_post_type() ) ) {
				$post_type = get_post_type_object( get_post_type() );
				$slug = $post_type->rewrite;
					$crumbs[] = $before . '<a href="' . get_post_type_archive_link( get_post_type() ) . '">' . $post_type->labels->singular_name . '</a>' . $after . $delimiter;
			}

		} 
		else {

			$cat = current( get_the_category() );
			if ( !empty($cat) ) {
				$crumbs[] = $before . get_category_parents( $cat, true, $delimiter ) . $after;
			}

		}
		
		$crumbs[] = $before_last . get_the_title() . $after_last;

	} 
	elseif ( is_attachment() ) {

		$parent = get_post( $post->post_parent );
		$crumbs[] = $before . '<a href="' . get_permalink( $parent ) . '">' . $parent->post_title . '</a>' . $after . $delimiter;
		$crumbs[] = $before_last . single_post_title( '', false ) . $after_last;

	} 
	elseif ( is_page() && !$post->post_parent ) {

		$crumbs[] = $before_last . single_post_title( '', false ) . $after_last;

	} 
	elseif ( is_page() && $post->post_parent ) {

		$parent_id  = $post->post_parent;
		$breadcrumbs = array();

		while ( $parent_id ) {
			$page = get_page( $parent_id );
			$breadcrumbs[] = $before . '<a href="' . get_permalink($page->ID) . '">' . get_the_title( $page->ID ) . '</a>' . $after . $delimiter;
			$parent_id  = $page->post_parent;
		}

		$breadcrumbs = array_reverse( $breadcrumbs );

		foreach ( $breadcrumbs as $crumb ) {
			$crumbs[] = $crumb;
		}

		$crumbs[] = $before_last . single_post_title( '', false ) . $after_last;

	} 
	elseif ( is_post_type_archive() ) {

		$post_type = get_post_type_object( get_post_type() );

		if ( $post_type )
			$crumbs[] = $before . $post_type->labels->singular_name . $after;

	} 

	return $wrap_before.implode( '', $crumbs ).$wrap_after;

}
