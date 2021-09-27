<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( tisara_theme_mod( 'tisara_single_social_hide' ) ) {
	return;
}

$social_active = tisara_theme_mod( 'tisara_single_social_icons', 
	array( 
		'facebook',
		'twitter',
		'linkedin',
		'pinterest',
		'tumblr',
	) 
);
if ( empty( $social_active ) ) {
	return;
}
