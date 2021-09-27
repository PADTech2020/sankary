<?php
/**
 * Generate custom CSS for theme hovers
 *
 * @package WordPress
 * @subpackage CUSTOM_MADE
 * @since CUSTOM_MADE 1.0
 */

// Theme init priorities:
// 3 - add/remove Theme Options elements
if (!function_exists('custom_made_hovers_theme_setup3')) {
	add_action( 'after_setup_theme', 'custom_made_hovers_theme_setup3', 3 );
	function custom_made_hovers_theme_setup3() {
		// Add 'Menu hover' option
		custom_made_storage_set_array_before('options', 'search_style', array(
			'menu_hover' => array(
				"title" => esc_html__('Menu hover', 'custom-made'),
				"desc" => wp_kses_data( __('Select hover effect to decorate main menu', 'custom-made') ),
				"std" => 'fade',
				"options" => array(
					'fade'			=> esc_html__('Fade',		'custom-made'),
					'fade_box'		=> esc_html__('Fade Box',	'custom-made'),
					'slide_line'	=> esc_html__('Slide Line',	'custom-made'),
					'slide_box'		=> esc_html__('Slide Box',	'custom-made'),
					'zoom_line'		=> esc_html__('Zoom Line',	'custom-made'),
					'path_line'		=> esc_html__('Path Line',	'custom-made'),
					'roll_down'		=> esc_html__('Roll Down',	'custom-made'),
					'color_line'	=> esc_html__('Color Line',	'custom-made'),
				),
				"type" => "select"
				),
			'menu_animation_in' => array( 
				"title" => esc_html__('Submenu show animation', 'custom-made'),
				"desc" => wp_kses_data( __('Select animation to show submenu ', 'custom-made') ),
				"std" => "fadeInUpSmall",
				"options" => custom_made_get_list_animations_in(),
				"type" => "select"
				),
			'menu_animation_out' => array( 
				"title" => esc_html__('Submenu hide animation', 'custom-made'),
				"desc" => wp_kses_data( __('Select animation to hide submenu ', 'custom-made') ),
				"std" => "fadeOutDownSmall",
				"options" => custom_made_get_list_animations_out(),
				"type" => "select"
				)
			)
		);
		// Add 'Buttons hover' option
		custom_made_storage_set_array_before('options', 'sidebar_widgets', array(
			'button_hover' => array(
				"title" => esc_html__("Button's hover", 'custom-made'),
				"desc" => wp_kses_data( __('Select hover effect to decorate all theme buttons', 'custom-made') ),
				"std" => 'slide_left',
				"options" => array(
					'default'		=> esc_html__('Fade',				'custom-made'),
					'slide_left'	=> esc_html__('Slide from Left',	'custom-made'),
					'slide_right'	=> esc_html__('Slide from Right',	'custom-made'),
					'slide_top'		=> esc_html__('Slide from Top',		'custom-made'),
					'slide_bottom'	=> esc_html__('Slide from Bottom',	'custom-made'),
				),
				"type" => "select"
			),
			'image_hover' => array(
				"title" => esc_html__("Image's hover", 'custom-made'),
				"desc" => wp_kses_data( __('Select hover effect to decorate all theme images', 'custom-made') ),
				"std" => 'dots',
				"override" => array(
					'mode' => 'page',
					'section' => esc_html__('Content', 'custom-made')
				),
				"options" => array(
					'dots'	=> esc_html__('Dots',	'custom-made'),
					'icon'	=> esc_html__('Icon',	'custom-made'),
					'icons'	=> esc_html__('Icons',	'custom-made'),
					'zoom'	=> esc_html__('Zoom',	'custom-made'),
					'fade'	=> esc_html__('Fade',	'custom-made'),
					'slide'	=> esc_html__('Slide',	'custom-made'),
					'pull'	=> esc_html__('Pull',	'custom-made'),
					'border'=> esc_html__('Border',	'custom-made')
				),
				"type" => "select"
			) )
		);
	}
}

// Theme init priorities:
// 9 - register other filters (for installer, etc.)
if (!function_exists('custom_made_hovers_theme_setup9')) {
	add_action( 'after_setup_theme', 'custom_made_hovers_theme_setup9', 9 );
	function custom_made_hovers_theme_setup9() {
		add_action( 'wp_enqueue_scripts',		'custom_made_hovers_frontend_scripts', 1010 );
		add_filter( 'custom_made_filter_localize_script','custom_made_hovers_localize_script' );
		add_filter( 'custom_made_filter_merge_scripts',	'custom_made_hovers_merge_scripts' );
		add_filter( 'custom_made_filter_merge_styles',	'custom_made_hovers_merge_styles' );
		add_filter( 'custom_made_filter_get_css', 		'custom_made_hovers_get_css', 10, 3 );
	}
}
	
// Enqueue hover styles and scripts
if ( !function_exists( 'custom_made_hovers_frontend_scripts' ) ) {
	//Handler of the add_action( 'wp_enqueue_scripts', 'custom_made_hovers_frontend_scripts', 1010 );
	function custom_made_hovers_frontend_scripts() {
		if ( custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('includes/theme.hovers/jquery.slidemenu.js')) && in_array(custom_made_get_theme_option('menu_hover'), array('slide_line', 'slide_box')) )
			wp_enqueue_script( 'slidemenu', custom_made_get_file_url('includes/theme.hovers/jquery.slidemenu.js'), array('jquery') );
		if ( custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('includes/theme.hovers/theme.hovers.js')) )
			wp_enqueue_script( 'custom-made-hovers', custom_made_get_file_url('includes/theme.hovers/theme.hovers.js'), array('jquery') );
		if ( custom_made_is_on(custom_made_get_theme_option('debug_mode')) && file_exists(custom_made_get_file_dir('includes/theme.hovers/theme.hovers.css')) )
			wp_enqueue_style( 'custom-made-hovers',  custom_made_get_file_url('includes/theme.hovers/theme.hovers.css'), array(), null );
	}
}

// Merge hover effects into single js
if (!function_exists('custom_made_hovers_merge_scripts')) {
	//Handler of the add_filter( 'custom_made_filter_merge_scripts', 'custom_made_hovers_merge_scripts' );
	function custom_made_hovers_merge_scripts($list) {
		$list[] = 'includes/theme.hovers/jquery.slidemenu.js';
		$list[] = 'includes/theme.hovers/theme.hovers.js';
		return $list;
	}
}

// Merge hover effects into single css
if (!function_exists('custom_made_hovers_merge_styles')) {
	//Handler of the add_filter( 'custom_made_filter_merge_styles', 'custom_made_hovers_merge_styles' );
	function custom_made_hovers_merge_styles($list) {
		$list[] = 'includes/theme.hovers/theme.hovers.css';
		return $list;
	}
}

// Add hover effect's vars into localize array
if (!function_exists('custom_made_hovers_localize_script')) {
	//Handler of the add_filter( 'custom_made_filter_localize_script','custom_made_hovers_localize_script' );
	function custom_made_hovers_localize_script($arr) {
		$arr['menu_hover'] = custom_made_get_theme_option('menu_hover');
		$arr['menu_hover_color'] = custom_made_get_scheme_color('text_hover', custom_made_get_theme_option( 'menu_scheme' ));
		$arr['button_hover'] = custom_made_get_theme_option('button_hover');
		return $arr;
	}
}

// Add hover icons on the featured image
if ( !function_exists('custom_made_hovers_add_icons') ) {
	function custom_made_hovers_add_icons($hover, $args=array()) {

		// Additional parameters
		$args = array_merge(array(
			'image' => null
		), $args);
	
		// Hover style 'Icons and 'Zoom'
		if (in_array($hover, array('icons', 'zoom'))) {
			if ($args['image'])
				$large_image = $args['image'];
			else {
				$attachment = wp_get_attachment_image_src( get_post_thumbnail_id(), 'masonry-big' );
				if (!empty($attachment[0]))
					$large_image = $attachment[0];
			}
			?>
			<div class="icons">
				<a href="<?php the_permalink(); ?>" aria-hidden="true" class="icon-link<?php if (empty($large_image)) echo ' single_icon'; ?>"></a>
				<?php if (!empty($large_image)) { ?>
				<a href="<?php echo esc_url($large_image); ?>" aria-hidden="true" class="icon-search" title="<?php echo esc_attr(get_the_title()); ?>"></a>
				<?php } ?>
			</div>
			<?php
	
		// Hover style 'Shop'
		} else if ($hover == 'shop') {
			global $product;
			?>
			<div class="icons">
				<?php
				if ($product->is_purchasable() && $product->is_in_stock()) {
					echo apply_filters( 'woocommerce_loop_add_to_cart_link',
										'<a rel="nofollow" href="' . esc_url($product->add_to_cart_url()) . '" 
														aria-hidden="true" 
														data-quantity="1" 
														data-product_id="' . esc_attr( $product->is_type( 'variation' ) ? $product->get_parent_id() : $product->get_id() ) . '"
														data-product_sku="' . esc_attr( $product->get_sku() ) . '"
														class="shop_cart icon-cart-2 button add_to_cart_button'
																. ' product_type_' . $product->get_type()
																. ($product->supports( 'ajax_add_to_cart' ) ? ' ajax_add_to_cart' : '')
																. '"></a>',
										$product );
				}
				?>
				<a href="<?php the_permalink(); ?>" aria-hidden="true" class="shop_link icon-link"></a>
			</div>
			<?php

		// Hover style 'Icon'
		} else if ($hover == 'icon') {
			?><div class="icons"><a href="<?php the_permalink(); ?>" aria-hidden="true" class="icon-search-alt"></a></div><?php

		// Hover style 'Dots'
		} else if ($hover == 'dots') {
			?><a href="<?php the_permalink(); ?>" aria-hidden="true" class="icons"><span></span><span></span><span></span></a><?php

		// Hover style 'Fade', 'Slide', 'Pull', 'Border'
		} else if (in_array($hover, array('fade', 'pull', 'slide', 'border'))) {
			?>
			<div class="post_info">
				<div class="post_info_back">
					<h4 class="post_title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
					<div class="post_descr">
						<?php
						custom_made_show_post_meta(array(
									'categories' => false,
									'date' => true,
									'edit' => false,
									'seo' => false,
									'share' => false,
									'counters' => 'comments,views',
									'echo' => true
									));
						// Remove the condition below if you want display excerpt
						if (false) {
							?><div class="post_excerpt"><?php the_excerpt(); ?></div><?php
						}
						?>
					</div>
				</div>
			</div>
			<?php
		}
	}
}

// Add styles into CSS
if ( !function_exists( 'custom_made_hovers_get_css' ) ) {
	//Handler of the add_filter( 'custom_made_filter_get_css', 'custom_made_hovers_get_css', 10, 3 );
	function custom_made_hovers_get_css($css, $colors, $fonts) {
		if (isset($css['fonts']) && $fonts) {
			$css['fonts'] .= <<<CSS
CSS;
		}

		if (isset($css['colors']) && $colors) {
			$css['colors'] .= <<<CSS

/* ================= MAIN MENU ITEM'S HOVERS ==================== */

/* fade box */
.menu_hover_fade_box .menu_main_nav > a:hover,
.menu_hover_fade_box .menu_main_nav > li > a:hover,
.menu_hover_fade_box .menu_main_nav > li.sfHover > a {
	color: {$colors['alter_link']};
	background-color: {$colors['alter_bg_color']};
}

/* slide_line */
.menu_hover_slide_line .menu_main_nav > li#blob {
	background-color: {$colors['text_link']};
}

/* slide_box */
.menu_hover_slide_box .menu_main_nav > li#blob {
	background-color: {$colors['alter_bg_color']};
}

/* zoom_line */
.menu_hover_zoom_line .menu_main_nav > li > a:before {
	background-color: {$colors['text_link']};
}

/* path_line */
.menu_hover_path_line .menu_main_nav > li:before,
.menu_hover_path_line .menu_main_nav > li:after,
.menu_hover_path_line .menu_main_nav > li > a:before,
.menu_hover_path_line .menu_main_nav > li > a:after {
	background-color: {$colors['text_link']};
}

/* roll_down */
.menu_hover_roll_down .menu_main_nav > li > a:before {
	background-color: {$colors['text_link']};
}

/* color_line */
.menu_hover_color_line .menu_main_nav > li > a:before {
	background-color: {$colors['text_dark']};
}
.menu_hover_color_line .menu_main_nav > li > a:after,
.menu_hover_color_line .menu_main_nav > li.menu-item-has-children > a:after {
	background-color: {$colors['text_link']};
}
.menu_hover_color_line .menu_main_nav > li.sfHover > a,
.menu_hover_color_line .menu_main_nav > li > a:hover,
.menu_hover_color_line .menu_main_nav > li > a:focus {
	color: {$colors['text_link']};
}


/* ================= BUTTON'S HOVERS ==================== */

/* Slide */
.sc_button_hover_slide_left {	background: linear-gradient(to right,	{$colors['bg_color']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_link']} !important; border-color: {$colors['text_link']};}
.sc_button_hover_slide_right {  background: linear-gradient(to left,	{$colors['bg_color']} 50%, {$colors['text_link']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['text_link']} !important; border-color: {$colors['text_link']};}
.sc_button_hover_slide_top {	background: linear-gradient(to bottom,	{$colors['bg_color']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['text_link']} !important; border-color: {$colors['text_link']};}
.sc_button_hover_slide_bottom {	background: linear-gradient(to top,		{$colors['bg_color']} 50%, {$colors['text_link']} 50%) no-repeat scroll right top / 100% 210% {$colors['text_link']} !important; border-color: {$colors['text_link']};}

.sc_button_hover_style_dark.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['text_link']} 50%, {$colors['text_dark']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_dark']} !important; }
.sc_button_hover_style_dark.sc_button_hover_slide_right {		background: linear-gradient(to left,	{$colors['text_link']} 50%, {$colors['text_dark']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['text_dark']} !important; }
.sc_button_hover_style_dark.sc_button_hover_slide_top {			background: linear-gradient(to bottom,	{$colors['text_link']} 50%, {$colors['text_dark']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['text_dark']} !important; }
.sc_button_hover_style_dark.sc_button_hover_slide_bottom {		background: linear-gradient(to top,		{$colors['text_link']} 50%, {$colors['text_dark']} 50%) no-repeat scroll right top / 100% 210% {$colors['text_dark']} !important; }

.sc_button_hover_style_inverse.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['inverse_text']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_style_inverse.sc_button_hover_slide_right {	background: linear-gradient(to left,	{$colors['inverse_text']} 50%, {$colors['text_link']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_style_inverse.sc_button_hover_slide_top {		background: linear-gradient(to bottom,	{$colors['inverse_text']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['text_link']} !important; }
.sc_button_hover_style_inverse.sc_button_hover_slide_bottom {	background: linear-gradient(to top,		{$colors['inverse_text']} 50%, {$colors['text_link']} 50%) no-repeat scroll right top / 100% 210% {$colors['text_link']} !important; }

.sc_button_hover_style_hover.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['text_hover']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_style_hover.sc_button_hover_slide_right {		background: linear-gradient(to left,	{$colors['text_hover']} 50%, {$colors['text_link']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['text_link']} !important; }
.sc_button_hover_style_hover.sc_button_hover_slide_top {		background: linear-gradient(to bottom,	{$colors['text_hover']} 50%, {$colors['text_link']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['text_link']} !important; }
.sc_button_hover_style_hover.sc_button_hover_slide_bottom {		background: linear-gradient(to top,		{$colors['text_hover']} 50%, {$colors['text_link']} 50%) no-repeat scroll right top / 100% 210% {$colors['text_link']} !important; }

.sc_button_hover_style_alter.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['alter_dark']} 50%, {$colors['alter_link']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['alter_link']} !important; }
.sc_button_hover_style_alter.sc_button_hover_slide_right {		background: linear-gradient(to left,	{$colors['alter_dark']} 50%, {$colors['alter_link']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['alter_link']} !important; }
.sc_button_hover_style_alter.sc_button_hover_slide_top {		background: linear-gradient(to bottom,	{$colors['alter_dark']} 50%, {$colors['alter_link']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['alter_link']} !important; }
.sc_button_hover_style_alter.sc_button_hover_slide_bottom {		background: linear-gradient(to top,		{$colors['alter_dark']} 50%, {$colors['alter_link']} 50%) no-repeat scroll right top / 100% 210% {$colors['alter_link']} !important; }

.sc_button_hover_style_alterbd.sc_button_hover_slide_left {		background: linear-gradient(to right,	{$colors['alter_link']} 50%, {$colors['alter_bd_color']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['alter_bd_color']} !important; }
.sc_button_hover_style_alterbd.sc_button_hover_slide_right {	background: linear-gradient(to left,	{$colors['alter_link']} 50%, {$colors['alter_bd_color']} 50%) no-repeat scroll left bottom / 210% 100% {$colors['alter_bd_color']} !important; }
.sc_button_hover_style_alterbd.sc_button_hover_slide_top {		background: linear-gradient(to bottom,	{$colors['alter_link']} 50%, {$colors['alter_bd_color']} 50%) no-repeat scroll right bottom / 100% 210% {$colors['alter_bd_color']} !important; }
.sc_button_hover_style_alterbd.sc_button_hover_slide_bottom {	background: linear-gradient(to top,		{$colors['alter_link']} 50%, {$colors['alter_bd_color']} 50%) no-repeat scroll right top / 100% 210% {$colors['alter_bd_color']} !important; }

.sc_item_button .sc_button_hover_slide_left.sc_button_dark,
.sc_button_hover_slide_left.sc_button_dark { 
	border-color: {$colors['text_dark']};
	background: linear-gradient(to right,	{$colors['bg_color']} 50%, {$colors['text_dark']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['text_dark']} !important; 
}
.sc_item_button .sc_button_hover_slide_left.sc_button_dark:hover,
.sc_button_hover_slide_left.sc_button_dark:hover { 
	background-position: left bottom !important;
}

.sc_button_hover_slide_left:hover,
.sc_button_hover_slide_left.active,
.ui-state-active .sc_button_hover_slide_left,
.vc_active .sc_button_hover_slide_left,
.vc_tta-accordion .vc_tta-panel-title:hover .sc_button_hover_slide_left,
li.active .sc_button_hover_slide_left {		
	background-position: left bottom !important; 
	border-color: {$colors['text_dark']};
	color: {$colors['text_dark']};
}

.sc_button_hover_slide_right:hover,
.sc_button_hover_slide_right.active,
.ui-state-active .sc_button_hover_slide_right,
.vc_active .sc_button_hover_slide_right,
.vc_tta-accordion .vc_tta-panel-title:hover .sc_button_hover_slide_right,
li.active .sc_button_hover_slide_right {	background-position: right bottom !important; }

.sc_button_hover_slide_top:hover,
.sc_button_hover_slide_top.active,
.ui-state-active .sc_button_hover_slide_top,
.vc_active .sc_button_hover_slide_top,
.vc_tta-accordion .vc_tta-panel-title:hover .sc_button_hover_slide_top,
li.active .sc_button_hover_slide_top {		background-position: right top !important; }

.sc_button_hover_slide_bottom:hover,
.sc_button_hover_slide_bottom.active,
.ui-state-active .sc_button_hover_slide_bottom,
.vc_active .sc_button_hover_slide_bottom,
.vc_tta-accordion .vc_tta-panel-title:hover .sc_button_hover_slide_bottom,
li.active .sc_button_hover_slide_bottom {	background-position: right bottom !important; }


a.sc_button_border:not(.sc_button_bg_image),
.sc_item_button a.sc_button_border:not(.sc_button_bg_image),
.sc_form button.sc_button_border:not(.sc_button_bg_image),
.sc_price_lin.sc_button_border:not(.sc_button_bg_image),
.sc_action_item_link.sc_button_border:not(.sc_button_bg_image){
	color: {$colors['text_dark']};
	border-color: {$colors['text_dark']};
	background: linear-gradient(to right,	{$colors['text_link']} 50%, {$colors['bg_color']} 50%) no-repeat scroll right bottom / 210% 100% {$colors['bg_color']} !important;
}
a.sc_button_border:not(.sc_button_bg_image):hover,
.sc_item_button a.sc_button_border:not(.sc_button_bg_image):hover,
.sc_form button.sc_button_border:not(.sc_button_bg_image):hover,
.sc_price_lin.sc_button_border:not(.sc_button_bg_image):hover,
.sc_action_item_link.sc_button_border:not(.sc_button_bg_image):hover{
	color: {$colors['bg_color']} !important;
	border-color: {$colors['text_link']};
	background-position: left bottom !important;
}

/* ================= IMAGE'S HOVERS ==================== */

/* Common styles */
.post_featured .mask {
	background-color: {$colors['text_dark_07']};
}

/* Dots */
.post_featured.hover_dots:hover .mask {
	background-color: {$colors['text_dark_07']};
}
.post_featured.hover_dots .icons span {
	background-color: {$colors['text_link']};
}
.post_featured.hover_dots .post_info {
	color: {$colors['inverse_text']};
}

/* Icon */
.post_featured.hover_icon .icons a {
	color: {$colors['text_link']};
}
.post_featured.hover_icon a:hover {
	color: {$colors['inverse_text']};
}

/* Icon and Icons */
.post_featured.hover_icons .icons a {
	background-color: {$colors['bg_color_07']};
	color: {$colors['text_dark']};
}
.post_featured.hover_icons a:hover {
	background-color: {$colors['bg_color']};
	color: {$colors['text_link']};
}

/* Fade */
.post_featured.hover_fade .post_info,
.post_featured.hover_fade .post_info a,
.post_featured.hover_fade .post_info .post_meta_item,
.post_featured.hover_fade .post_info .post_meta .post_meta_item:before,
.post_featured.hover_fade .post_info .post_meta .post_meta_item:hover:before {
	color: {$colors['inverse_text']};
}
.post_featured.hover_fade .post_info a:hover {
	color: {$colors['text_link']};
}

/* Slide */
.post_featured.hover_slide .post_info,
.post_featured.hover_slide .post_info a,
.post_featured.hover_slide .post_info .post_meta_item,
.post_featured.hover_slide .post_info .post_meta .post_meta_item:before,
.post_featured.hover_slide .post_info .post_meta .post_meta_item:hover:before {
	color: {$colors['inverse_text']};
}
.post_featured.hover_slide .post_info a:hover {
	color: {$colors['text_link']};
}
.post_featured.hover_slide .post_info .post_title:after {
	background-color: {$colors['inverse_text']};
}

/* Pull */
.post_featured.hover_pull .post_info,
.post_featured.hover_pull .post_info a {
	color: {$colors['inverse_text']};
}
.post_featured.hover_pull .post_info a:hover {
	color: {$colors['text_link']};
}
.post_featured.hover_pull .post_info .post_descr {
	background-color: {$colors['text_dark']};
}

/* Border */
.post_featured.hover_border .post_info,
.post_featured.hover_border .post_info a,
.post_featured.hover_border .post_info .post_meta_item,
.post_featured.hover_border .post_info .post_meta .post_meta_item:before,
.post_featured.hover_border .post_info .post_meta .post_meta_item:hover:before {
	color: {$colors['inverse_text']};
}
.post_featured.hover_border .post_info a:hover {
	color: {$colors['text_link']};
}
.post_featured.hover_border .post_info:before,
.post_featured.hover_border .post_info:after {
	border-color: {$colors['inverse_text']};
}

/* Shop */
.post_featured.hover_shop .icons a {
	color: {$colors['bg_color']};
	border-color: {$colors['bg_color']} !important;
	background-color: transparent;
}
.post_featured.hover_shop .icons a:hover {
	color: {$colors['inverse_text']};
	border-color: {$colors['text_link']} !important;
	background-color: {$colors['text_link']};
}

CSS;
		}
		
		return $css;
	}
}
?>