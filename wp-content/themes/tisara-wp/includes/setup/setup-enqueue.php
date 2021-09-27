<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

add_action( 'wp_enqueue_scripts', 'tisara_enqueue_scripts', 1000 );
function tisara_enqueue_scripts() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	wp_enqueue_script( 'tisara-theme', get_template_directory_uri() . '/assets/js/theme.min.js', array( 'jquery' ), TISARA_THEME_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'tisara_enqueue_styles', 25 );
function tisara_enqueue_styles() {
	wp_enqueue_style( 'tisara-parent-style', get_template_directory_uri() . '/style.min.css', array(), TISARA_THEME_VERSION );
	if ( is_child_theme() ) {
		wp_enqueue_style( 'tisara-child-style', get_stylesheet_uri(), array() );
	}
}
