<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( !defined( 'TISARA_ELEMENTOR__FILE__' ) ) {
	define( 'TISARA_ELEMENTOR__FILE__', __FILE__ );
}
if ( !defined( 'TISARA_ELEMENTOR_PATH' ) ) {
	define( 'TISARA_ELEMENTOR_PATH', plugin_dir_path( TISARA_ELEMENTOR__FILE__ ) );
}
if ( !defined( 'TISARA_ELEMENTOR_URL' ) ) {
	define( 'TISARA_ELEMENTOR_URL', plugins_url( '/', TISARA_ELEMENTOR__FILE__ ) );
}
if ( !defined( 'TISARA_ELEMENTOR_VERSION' ) ) {
	define( 'TISARA_ELEMENTOR_VERSION', '0.1.0' );
}

function tisara_elementor_load() {

	// Notice if the Elementor is not active
	if ( ! did_action( 'elementor/loaded' ) ) {
		add_action( 'admin_notices', 'tisara_elementor_fail_load' );
		return;
	}

	// Check version required
	$elementor_version_required = '1.0.0';
	if ( ! version_compare( ELEMENTOR_VERSION, $elementor_version_required, '>=' ) ) {
		add_action( 'admin_notices', 'tisara_elementor_fail_load_out_of_date' );
		return;
	}

	// Require the main plugin file
	require( __DIR__ . '/plugin.php' );
}
add_action( 'plugins_loaded', 'tisara_elementor_load' );

function tisara_elementor_fail_load() {
	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	$installed_plugins = get_plugins();
	$plugin = 'elementor/elementor.php';

	if ( isset( $installed_plugins[ $plugin ] ) ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );

		$message = '<p>' . __( 'Tisara Elementor Addons not working because you need to activate the Elementor plugin.', 'tisara-wp-addons' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'tisara-wp-addons' ) ) . '</p>';
	} 
	else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );

		$message = '<p>' . __( 'Tisara Elementor Addons not working because you need to install the Elementor plugin', 'tisara-wp-addons' ) . '</p>';
		$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'tisara-wp-addons' ) ) . '</p>';
	}

	echo '<div class="error"><p>' . $message . '</p></div>';
}

function tisara_elementor_fail_load_out_of_date() {
	if ( ! current_user_can( 'update_plugins' ) ) {
		return;
	}

	$file_path = 'elementor/elementor.php';

	$upgrade_link = wp_nonce_url( self_admin_url( 'update.php?action=upgrade-plugin&plugin=' ) . $file_path, 'upgrade-plugin_' . $file_path );
	$message = '<p>' . __( 'Tisara Elementor Addons working because you are using an old version of Elementor.', 'tisara-wp-addons' ) . '</p>';
	$message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $upgrade_link, __( 'Update Elementor Now', 'tisara-wp-addons' ) ) . '</p>';

	echo '<div class="error">' . $message . '</div>';
}

/**
 * Paginate links - BootStrap-ed
 */
if ( ! function_exists( 'tisara_elementor_paginate_links' ) ) {
	function tisara_elementor_paginate_links( $args = '' ) {
		$defaults = array(
			'base' => '%_%', // http://example.com/all_posts.php%_% : %_% is replaced by format (below)
			'format' => '?page=%#%', // ?page=%#% : %#% is replaced by the page number
			'total' => 1,
			'current' => 0,
			'show_all' => false,
			'prev_next' => true,
			'prev_text' => '&#8592;',
			'next_text' => '&#8594;',
			'end_size' => 1,
			'mid_size' => 2,
			'type' => 'list',
			'add_args' => false, // array of query args to add
			'add_fragment' => ''
		);

		$args = wp_parse_args( $args, $defaults );
		extract($args, EXTR_SKIP);

		// Who knows what else people pass in $args
		$total = (int) $total;
		if ( $total < 2 )
			return;
		$current  = (int) $current;
		$end_size = 0  < (int) $end_size ? (int) $end_size : 1; // Out of bounds?  Make it the default.
		$mid_size = 0 <= (int) $mid_size ? (int) $mid_size : 2;
		$add_args = is_array($add_args) ? $add_args : false;
		$r = '';
		$page_links = array();
		$n = 0;
		$dots = false;

		if ( $prev_next && $current && 1 < $current ) :
			$link = str_replace('%_%', 2 == $current ? '' : $format, $base);
			$link = str_replace('%#%', $current - 1, $link);
			if ( $add_args )
				$link = add_query_arg( $add_args, $link );
			$link .= $add_fragment;
			$page_links[] = '<li class="pagination-prev"><a class="prev page-numbers" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $prev_text . '</a></li>';
		endif;
		for ( $n = 1; $n <= $total; $n++ ) :
			$n_display = number_format_i18n($n);
			if ( $n == $current ) :
				$page_links[] = "<li class='pagination-list active'><span class='page-numbers current'>$n_display</span></li>";
				$dots = true;
			else :
				if ( $show_all || ( $n <= $end_size || ( $current && $n >= $current - $mid_size && $n <= $current + $mid_size ) || $n > $total - $end_size ) ) :
					$link = str_replace('%_%', 1 == $n ? '' : $format, $base);
					$link = str_replace('%#%', $n, $link);
					if ( $add_args )
						$link = add_query_arg( $add_args, $link );
					$link .= $add_fragment;
					$page_links[] = "<li class='pagination-list'><a class='page-numbers' href='" . esc_url( apply_filters( 'paginate_links', $link ) ) . "'>$n_display</a></li>";
					$dots = true;
				elseif ( $dots && !$show_all ) :
					$page_links[] = '<li class="pagination-dots disabled"><span class="page-numbers dots">' . esc_html__( '&hellip;', 'tisara-wp-addons' ) . '</span></li>';
					$dots = false;
				endif;
			endif;
		endfor;
		if ( $prev_next && $current && ( $current < $total || -1 == $total ) ) :
			$link = str_replace('%_%', $format, $base);
			$link = str_replace('%#%', $current + 1, $link);
			if ( $add_args )
				$link = add_query_arg( $add_args, $link );
			$link .= $add_fragment;
			$page_links[] = '<li class="pagination-next"><a class="next page-numbers" href="' . esc_url( apply_filters( 'paginate_links', $link ) ) . '">' . $next_text . '</a></li>';
		endif;
		/* always return list */
		$r .= "<ul class='pagination text-center'>";
		$r .= join("", $page_links);
		$r .= "</ul>\n";
		return $r;
	}
}