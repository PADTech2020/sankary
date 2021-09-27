<?php 
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly 

if ( ! is_singular( 'post') ) {
	return;
}

if ( tisara_theme_mod( 'tisara_single_tags_hide' ) ) {
	return;
}

echo tisara_meta_tags( 
	'', 
	'', 
	' ', 
	'<div class="tags-area">
		<div class="tags-title">
			'.esc_html__( 'Tags', 'tisara-wp' ).'
		</div>
		<div class="tagcloud">', 
	'	</div>
	</div>'
);

?>
