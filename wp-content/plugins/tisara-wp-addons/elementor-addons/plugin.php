<?php
namespace ElementorTisara;

use ElementorTisara\Controls\KN_Group_Control_Background;

use ElementorTisara\Widgets\KN_Image_Slider;
use ElementorTisara\Widgets\KN_Content_Slider;
use ElementorTisara\Widgets\KN_Image_Gallery;
use ElementorTisara\Widgets\KN_Testimonials;
use ElementorTisara\Widgets\KN_Blog_Post;
use ElementorTisara\Widgets\KN_WC_Products;
use ElementorTisara\Widgets\KN_Contact_Form;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Main Plugin Class
 *
 * Register new elementor widget.
 *
 * @since 1.0.0
 */
class Plugin {

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {
		$this->add_actions();
	}

	private function add_actions() {
		add_action( 'elementor/init', [ $this, 'elementor_init' ] );
		add_action( 'elementor/elements/categories_registered', array( $this, 'elementor_categories_registered' ) );
		add_action( 'elementor/controls/controls_registered', [ $this, 'elementor_controls_registered' ] );
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'elementor_widgets_registered' ] );

		add_action( 'elementor/frontend/before_enqueue_scripts', [ $this, 'enqueue_scripts' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_styles' ] );

		if ( class_exists( 'woocommerce' ) && ! defined( 'ELEMENTOR_PRO_VERSION' ) ) {
			add_action( 'init', [ $this, 'register_wc_hooks' ], 9 );
		}
		add_action( 'init', [ $this, 'init' ], 10 );
	}

	public function elementor_init() {
	}

	public function elementor_categories_registered( $elements_manager ) {
		$elements_manager->add_category(
			'tisara',
			[
				'title' => __( 'Tisara', 'tisara-wp-addons' ),
				'icon' => 'font',
			]
		);
	}

	public function enqueue_styles() {
		wp_enqueue_style(
			'tisara-elementor',
			TISARA_ELEMENTOR_URL . '/assets/css/frontend.css',
			[],
			TISARA_ELEMENTOR_VERSION
		);
	}

	public function enqueue_scripts() {
		wp_enqueue_script(
			'tisara-elementor-frontend',
			TISARA_ELEMENTOR_URL . '/assets/js/frontend.js',
			[
				'jquery',
			],
			TISARA_ELEMENTOR_VERSION,
			true
		);
	}

	public function elementor_controls_registered() {
		$this->include_controls();
		$this->register_controls();
	}

	public function elementor_widgets_registered() {
		$this->include_widgets();
		$this->register_widgets();
	}

	public function init() {
		$template = get_template();
		$template = str_replace( '-wp', '', $template );
		if ( class_exists('woocommerce') ) {
			if ( function_exists( $template.'_wc_setup_shop_page' ) ) {
				call_user_func( $template.'_wc_setup_shop_page' );
			}
			if ( function_exists( $template.'_wc_setup_product_page' ) ) {
				call_user_func( $template.'_wc_setup_product_page' );
			}
			if ( function_exists( $template.'_wc_setup_cart_page' ) ) {
				call_user_func( $template.'_wc_setup_cart_page' );
			}
			if ( function_exists( $template.'_wc_setup_checkout_page' ) ) {
				call_user_func( $template.'_wc_setup_checkout_page' );
			}
		} 
	}

	public function register_wc_hooks() {
		wc()->frontend_includes();
	}

	private function include_controls() {
		require_once ( __DIR__ . '/controls/background.php' );
	}

	private function register_controls() {
		\Elementor\Plugin::$instance->controls_manager->add_group_control( 'kn_background', new KN_Group_Control_Background() );
	}

	private function include_widgets() {
		require_once ( __DIR__ . '/widgets/image-slider.php' );
		require_once ( __DIR__ . '/widgets/content-slider.php' );
		require_once ( __DIR__ . '/widgets/image-gallery.php' );
		require_once ( __DIR__ . '/widgets/testimonials.php' );
		require_once ( __DIR__ . '/widgets/blog-post.php' );
		require_once ( __DIR__ . '/widgets/contact-form.php' );
		if ( function_exists( 'WC' ) ) {
			require_once ( __DIR__ . '/widgets/wc-products.php' );
		}
	}

	private function register_widgets() {
		\Elementor\Plugin::$instance->widgets_manager->register_widget_type( new KN_Image_Slider() );
		\Elementor\Plugin::$instance->widgets_manager->register_widget_type( new KN_Content_Slider() );
		\Elementor\Plugin::$instance->widgets_manager->register_widget_type( new KN_Image_Gallery() );
		\Elementor\Plugin::$instance->widgets_manager->register_widget_type( new KN_Testimonials() );
		\Elementor\Plugin::$instance->widgets_manager->register_widget_type( new KN_Blog_Post() );
		\Elementor\Plugin::$instance->widgets_manager->register_widget_type( new KN_Contact_Form() );
		if ( function_exists( 'WC' ) ) {
			\Elementor\Plugin::$instance->widgets_manager->register_widget_type( new KN_WC_Products() );
		}
	}
}

new Plugin();
