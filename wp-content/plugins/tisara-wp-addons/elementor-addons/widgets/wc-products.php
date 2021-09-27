<?php
namespace ElementorTisara\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class KN_WC_Products extends Widget_Base {

	public function get_name() {
		return 'kn_wc_products';
	}

	public function get_title() {
		return __( 'TS - WooCommerce Products', 'tisara-wp-addons' );
	}

	public function get_icon() {
		return 'eicon-woocommerce';
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	public function get_categories() {
		return [ 'tisara' ];
	}

	public function wc_loop_start( $loop_start ) {
		$settings = $this->get_settings();
		$columns = $settings['columns'];
		$columns_mobile = $settings['columns_mobile'];
		if ( $columns == 1 ) $columns_mobile = 1;
		if ( $columns_mobile == 1 || $columns_mobile == 2 ) {
			$loop_start = str_replace( 'columns-mobile-1', '', $loop_start );
			$loop_start = str_replace( 'columns-mobile-2', '', $loop_start );
			$loop_start = str_replace( 'class="products ', 'class="products columns-mobile-'.$columns_mobile.' ', $loop_start );
		}
		return $loop_start;
	}

	public static function get_product_categories() {
		$categories = array( '' => __( '- All Categories -', 'tisara-wp-addons' ) );
		$terms = get_terms( array( 'taxonomy' => 'product_cat' ) );
		
		if ( !empty($terms) ) {
			foreach ( $terms as $term ) {
				$categories[$term->slug] = $term->name;
			}
		}
		
		return $categories;
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_products',
			[
				'label'	=> __( 'Products Setting', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'show',
				[
					'label'		    => __( 'Filter By', 'tisara-wp-addons' ),
					'type'		    =>Controls_Manager::SELECT,
					'default'	    => 'all',
					'options'	    => [
						'all'			=> __( 'All Products', 'tisara-wp-addons' ),
						'featured'		=> __( 'Featured Products', 'tisara-wp-addons' ),
						'onsale'		=> __( 'On-sale Products', 'tisara-wp-addons' ),
						'bestselling'	=> __( 'Best Selling Products', 'tisara-wp-addons' ),
						'toprated'		=> __( 'Top Rated Products', 'tisara-wp-addons' ),
						'incategory'	=> __( 'Products In A Category', 'tisara-wp-addons' ),
					],
					'label_block'	=> true,
				]
			);

			$this->add_control(
				'category',
				[
					'label' 	    => __( 'Category', 'tisara-wp-addons' ),
					'type' 		    => Controls_Manager::SELECT,
					'default' 	    => '',
					'options' 	    => self::get_product_categories(),
					'condition'	    => [
						'show' => 'incategory',
					],
					'label_block'	=> true,
				]
			);

			$options = array();
			for ($i=1; $i <=6; $i++) { 
				$options[$i] = $i;
			}

			$this->add_control(
				'columns',
				[
					'label' 	    => __( 'Number of Products Per Row', 'tisara-wp-addons' ),
					'type' 		    => Controls_Manager::SELECT,
					'default' 	    => '4',
					'options' 	    => $options,
					'condition'	    => [
						'carousel!' => 'yes',
					],
					'label_block'	=> true,
				]
			);
			
			$this->add_control(
				'columns_mobile',
				[
					'label' 	    => __( 'Number of Products Per Row (Mobile)', 'tisara-wp-addons' ),
					'description'   => __( 'For mobile only, when device viewport width <= 480px', 'tisara-wp-addons' ),
					'type' 		    => Controls_Manager::SELECT,
					'default' 	    => 'default',
					'options' 	    => [
						'default'	=> 'default',
						'1'         => '1',
						'2'         => '2',
					],
					'condition'	    => [
						'carousel!'	=> 'yes',
						'columns!'	=> '1',
					],
					'label_block'	=> true,
				]
			);
			
			for ($i=7; $i <=24; $i++) { 
				$options[$i] = $i;
			}

			$this->add_control(
				'per_page',
				[
					'label' 	    => __( 'Number of Products To Show', 'tisara-wp-addons' ),
					'type' 		    => Controls_Manager::SELECT,
					'default' 	    => '4',
					'options' 	    => $options,
					'label_block'	=> true,
				]
			);

			$this->add_control(
				'orderby',
				[
					'label' 		=> __( 'Order By', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'date',
					'options' 		=> [
						'date' 			=> __( 'Date', 'tisara-wp-addons' ),
						'title' 		=> __( 'Title', 'tisara-wp-addons' ),
						'price' 		=> __( 'Price', 'tisara-wp-addons' ),
						'popularity' 	=> __( 'Popularity', 'tisara-wp-addons' ),
						'rating' 		=> __( 'Rating', 'tisara-wp-addons' ),
						'rand' 			=> __( 'Random', 'tisara-wp-addons' ),
						'menu_order' 	=> __( 'Menu Order', 'tisara-wp-addons' ),
					],
					'condition'		=> [
						'show' => [ 'all', 'featured', 'onsale', 'incategory' ],
					],
					'label_block'	=> true,
				]
			);

			$this->add_control(
				'order',
				[
					'label' 		=> __( 'Order', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::SELECT,
					'default' 		=> 'desc',
					'options' 		=> [
						'desc'	=> __( 'Descending (Z - A)', 'tisara-wp-addons' ),
						'asc'	=> __( 'Ascending (A - Z)', 'tisara-wp-addons' ),
					],
					'condition'		=> [
						'show'		=> [ 'all', 'featured', 'onsale', 'incategory' ],
						'orderby!'	=> 'popularity',
					],
					'label_block' 	=> true,
				]
			);

			$this->add_control(
				'hide_free',
				[
					'label' 		=> __( 'Hide Free Products', 'tisara-wp-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'label_on'		=> __( 'Yes', 'tisara-wp-addons' ),
					'label_off'		=> __( 'No', 'tisara-wp-addons' ),
					'return_value'	=> 'yes'
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_pagination_options',
			[
				'label'	=> __( 'Pagination', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'pagination',
				[
					'label'	        => __( 'Show Pagination', 'tisara-wp-addons' ),
					'type'	        => Controls_Manager::SWITCHER,
					'label_on'	    => __( 'Yes', 'tisara-wp-addons' ),
					'label_off'	    => __( 'No', 'tisara-wp-addons' ),
					'return_value'	=> 'yes',
				]
			);

			$this->add_control(
				'pagination_align',
				[
					'label'     => __( 'Alignment', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::CHOOSE,
					'options'   => [
						'left'	    => [
							'title'	=> __( 'Left', 'tisara-wp-addons' ),
							'icon'  => 'fa fa-align-left',
						],
						'center'	=> [
							'title' => __( 'Center', 'tisara-wp-addons' ),
							'icon'  => 'fa fa-align-center',
						],
						'right'     => [
							'title' => __( 'Right', 'tisara-wp-addons' ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'default'   => 'center',
					'condition'	=> [
						'pagination' => 'yes'
					]
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_warning',
			[
				'label'     => __( 'Slider / Carousel Options', 'tisara-wp-addons' ),
				'condition'	=> [
					'pagination' => 'yes',
				]
			]
		);

		$this->add_control(
			'carousel_warning',
			[
				'type'              => Controls_Manager::RAW_HTML,
				'raw'               => __( 'Slider / Carousel Options are not available because Paginations is active!', 'tisara-wp-addons' ),
				'content_classes'	=> 'elementor-panel-alert elementor-panel-alert-info',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label'     => __( 'Slider / Carousel Options', 'tisara-wp-addons' ),
				'condition'	=> [
					'pagination' => '',
				]
			]
		);

			$this->add_control(
				'carousel',
				[
					'label'			=> __( 'Carousel', 'tisara-wp-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'label_on'		=> __( 'Yes', 'tisara-wp-addons' ),
					'label_off'		=> __( 'No', 'tisara-wp-addons' ),
					'return_value'	=> 'yes'
				]
			);

			$this->add_responsive_control(
				'slides_to_show',
				[
					'label' 			=> __( 'Slides To Show', 'tisara-wp-addons' ),
					'type' 				=> Controls_Manager::SELECT,
					'desktop_default' 	=> '4',
					'tablet_default' 	=> '2',
					'mobile_default' 	=> '1',
					'options' 			=> [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					],
					'condition'			=> [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_responsive_control(
				'slides_to_scroll',
				[
					'label' 			=> __( 'Slides To Scroll', 'tisara-wp-addons' ),
					'type' 				=> Controls_Manager::SELECT,
					'desktop_default' 	=> '1',
					'tablet_default' 	=> '1',
					'mobile_default' 	=> '1',
					'options' 			=> [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					],
					'condition'			=> [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'adaptive_height',
				[
					'label' 	=> __( 'Adaptive Height', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'yes' 	=> __( 'Yes', 'tisara-wp-addons' ),
						'no' 	=> __( 'No', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'navigation',
				[
					'label' 	=> __( 'Navigation', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'both',
					'options' 	=> [
						'both' 		=> __( 'Arrows and Dots', 'tisara-wp-addons' ),
						'arrows' 	=> __( 'Arrows', 'tisara-wp-addons' ),
						'dots' 		=> __( 'Dots', 'tisara-wp-addons' ),
						'none' 		=> __( 'None', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label' 	=> __( 'Pause on Hover', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'yes' 	=> __( 'Yes', 'tisara-wp-addons' ),
						'no' 	=> __( 'No', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label' 	=> __( 'Autoplay', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'yes' 	=> __( 'Yes', 'tisara-wp-addons' ),
						'no' 	=> __( 'No', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label' 	=> __( 'Autoplay Speed', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> 5000,
					'condition'	=> [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'infinite',
				[
					'label' 	=> __( 'Infinite Loop', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'yes',
					'options' 	=> [
						'yes' 	=> __( 'Yes', 'tisara-wp-addons' ),
						'no' 	=> __( 'No', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'carousel' => 'yes',
					],
				]
			);

			$this->add_control(
				'speed',
				[
					'label' 	=> __( 'Animation Speed', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::NUMBER,
					'default' 	=> 500,
					'condition'	=> [
						'carousel' => 'yes',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Slider / Navigation', 'tisara-wp-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'carousel' => 'yes',
				],
			]
		);

			$this->add_control(
				'heading_style_arrows',
				[
					'label' 	=> __( 'Arrows', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition'	=> [
						'navigation' => [ 'arrows', 'both' ],
					],
				]
			);

			$this->add_control(
				'arrows_color',
				[
					'label' 	=> __( 'Arrows Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tp-wc-products-wrapper .tp-wc-products-carousel .slick-prev:before, {{WRAPPER}} .tp-wc-products-wrapper .tp-wc-products-carousel .slick-next:before' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'navigation' => [ 'arrows', 'both' ],
					],
				]
			);

			$this->add_control(
				'arrows_position',
				[
					'label' 	=> __( 'Arrows Position', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'outside',
					'options' 	=> [
						'inside' 	=> __( 'Inside', 'tisara-wp-addons' ),
						'outside' 	=> __( 'Outside', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'navigation' => [ 'arrows', 'both' ],
					],
				]
			);

			$this->add_responsive_control(
				'arrows_size',
				[
					'label' 	=> __( 'Arrows Size', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default'	=> [
						'size'	=> 35,
					],
					'range' 	=> [
						'px'	=> [
							'min'	=> 0,
							'max'	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .tp-wc-products-wrapper .tp-wc-products-carousel .slick-prev:before, {{WRAPPER}} .tp-wc-products-wrapper .tp-wc-products-carousel .slick-next:before' => 'font-size: {{SIZE}}px',
					],
					'condition'	=> [
						'navigation' => [ 'arrows', 'both' ],
					],
				]
			);

			$this->add_control(
				'heading_style_dots',
				[
					'label' 	=> __( 'Dots', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
					'condition'	=> [
						'navigation' => [ 'dots', 'both' ],
					],
				]
			);

			$this->add_control(
				'dots_color',
				[
					'label' 	=> __( 'Dots Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .tp-wc-products-wrapper .tp-wc-products-carousel ul.slick-dots li button:before' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'navigation' => [ 'dots', 'both' ],
					],
				]
			);

			$this->add_control(
				'dots_active_color',
				[
					'label' 	=> __( 'Dots Color (active)', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .tp-wc-products-wrapper .tp-wc-products-carousel ul.slick-dots li.slick-active button:before' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'navigation' => [ 'dots', 'both' ],
					],
				]
			);

			$this->add_control(
				'dots_position',
				[
					'label' 	=> __( 'Dots Position', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'outside',
					'options'	=> [
						'outside' 	=> __( 'Outside', 'tisara-wp-addons' ),
						'inside' 	=> __( 'Inside', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'navigation' => [ 'dots', 'both' ],
					],
				]
			);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		global $woocommerce_loop;

		if ( $settings['show'] == 'incategory' && !$settings['category'] )
			return;

		if ( get_query_var( 'paged' ) ) {
			$page = get_query_var( 'paged' );
		}
		elseif ( get_query_var( 'page' ) ) {
			$page = get_query_var( 'page' );
		}
		else {
			$page = 1;
		}

		$offset = ( $page - 1 ) * $settings['per_page'];

		// default query args
		$query_args = array(
			'posts_per_page'	=> $settings['per_page'],
			'paged'			    => $page,
			'offset' 		    => $offset,
			'post_status'       => 'publish',
			'post_type'         => 'product',
			'meta_query'        => array()
		);

		if ( $settings['pagination'] == 'yes' ) {
			$query_args['no_found_rows'] = false;
		} else {
			$query_args['no_found_rows'] = 1;
		}

		// hidden free products
		if ( $settings['hide_free'] == 'yes' ) {
			$query_args['meta_query'][] = array(
				'key'     => '_price',
				'value'   => 0,
				'compare' => '>',
				'type'    => 'DECIMAL',
			);
		}

		// orderby query
		if ( $settings['show'] != 'toprated' ) {
			switch ( $settings['orderby'] ) {
				case 'price' :
					$query_args['meta_key'] = '_price';
					$query_args['orderby']  = 'meta_value_num';
					$query_args['order']  	= $settings['order'];
					break;
				case 'rand' :
					$query_args['orderby']  = 'rand';
					break;
				case 'sales' :
					$query_args['meta_key'] = 'total_sales';
					$query_args['orderby']  = 'meta_value_num';
					break;
				case 'rating' :
					$query_args['meta_key'] = '_wc_average_rating';
					$query_args['orderby'] = array(
						'meta_value_num' => $settings['order'],
						'ID'             => 'ASC',
					);
					break;
				case 'popularity' :
					$query_args['meta_key'] = 'total_sales';
					$query_args['orderby']  = 'meta_value_num';
					$query_args['order']  	= 'desc';
					break;
				default :
					$query_args['orderby']  = $settings['orderby'];
					$query_args['order']  	= $settings['order'];
			}
		}

		// filterby query
		switch ( $settings['show'] ) {
			case 'featured' :

				$meta_query  = \WC()->query->get_meta_query();
			    $tax_query   = \WC()->query->get_tax_query();
			    $tax_query[] = array(
			        'taxonomy' => 'product_visibility',
			        'field'    => 'name',
			        'terms'    => 'featured',
			        'operator' => 'IN',
			    );

				$query_args['meta_query'] = $meta_query;
				$query_args['tax_query']  = $tax_query;
				
				$query_args['order']  	  = $settings['order'];
				break;
			case 'onsale' :
				$product_ids_on_sale    = wc_get_product_ids_on_sale();
				$product_ids_on_sale[]  = 0;
				$query_args['post__in'] = $product_ids_on_sale;
				break;
			case 'bestselling' :
				$query_args['meta_key'] = 'total_sales';
				$query_args['orderby']  = 'meta_value_num';
				$query_args['order']  	= 'desc';
				break;
			case 'toprated' :
				$query_args['meta_key'] = '_wc_average_rating';
				$query_args['orderby']  = array(
					'meta_value_num' => 'DESC',
					'ID'             => 'ASC',
				);
				break;
			case 'incategory' :
				$query_args['tax_query'] = array(
					array(
						'taxonomy' 		=> 'product_cat',
						'terms' 		=> array_map( 'sanitize_title', explode( ',', $settings['category'] ) ),
						'field' 		=> 'slug',
						'operator' 		=> 'IN',
					)
				);
				break;
		}

		$query_args['meta_query'] = WC()->query->get_meta_query();

		$query_args['tax_query'][] = array(
			array(
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'exclude-from-catalog',
				'operator' => 'NOT IN',
			),
		);

		$this->query = new \WP_Query( $query_args );
		$query = $this->query;

		$woocommerce_loop['columns'] = $settings['columns'];

		$this->add_render_attribute( 'wrapper', 'class', 'tp-wc-products-wrapper' );
		if ( $settings['carousel'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-slick-slider' );
		}
		else {
			$this->add_render_attribute( 'wrapper', 'class', 'clearfix' );
		}

		$this->add_render_attribute( 'carousel', 'class', 'tp-wc-products' );
		$this->add_render_attribute( 'carousel', ['class' => 'woocommerce columns-' . $woocommerce_loop['columns']] );

		if ( $settings['pagination'] !== 'yes' ) {
			$direction = is_rtl() ? 'rtl' : 'ltr';
			$this->add_render_attribute( 'wrapper', 'dir', $direction );

			$carousel_options = [
				'slides_to_show_desktop' 	=> $settings['slides_to_show'],
				'slides_to_show_tablet'		=> $settings['slides_to_show_tablet'],
				'slides_to_show_mobile'		=> $settings['slides_to_show_mobile'],
				'slides_to_scroll_desktop'	=> $settings['slides_to_scroll'],
				'slides_to_scroll_tablet' 	=> $settings['slides_to_scroll_tablet'],
				'slides_to_scroll_mobile' 	=> $settings['slides_to_scroll_mobile'],
				'adaptiveHeight' 			=> ( 'no' !== $settings['adaptive_height'] ? true : false ),
				'autoplaySpeed' 			=> absint( $settings['autoplay_speed'] ),
				'autoplay' 					=> ( 'no' !== $settings['autoplay'] ? true : false ),
				'infinite' 					=> ( 'no' !== $settings['infinite'] ? true : false ),
				'pauseOnHover' 				=> ( 'no' !== $settings['pause_on_hover'] ? true : false ),
				'speed' 					=> absint( $settings['speed'] ),
				'arrows' 					=> ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ? true : false ),
				'dots' 						=> ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ? true : false ),
				'fade' 						=> false,
				'rtl' 						=> ( is_rtl() ? true : false ),
				
			];

			$carousel_classes = [];
			
			if ( $settings['carousel'] == "yes" ) {
				$carousel_classes[] = 'tp-wc-products-carousel';

				if ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ) {
					$carousel_classes[] = 'slick-arrows-' . $settings['arrows_position'];
				}

				if ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ) {
					$carousel_classes[] = 'slick-dots-' . $settings['dots_position'];
				}
				
			}

			$this->add_render_attribute( 'carousel', [
				'class' => $carousel_classes,
			] );

			if ( $settings['carousel'] == "yes" ) {
				$this->add_render_attribute( 'carousel', ['data-slider_options' => wp_json_encode( $carousel_options )] );
			}
		}

		if ( $query->have_posts() ) :
			$total_pages = $query->max_num_pages;
		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>

				<?php
				add_filter( 'woocommerce_product_loop_start', [ $this, 'wc_loop_start' ], 15 );

				woocommerce_product_loop_start();
				
				while ( $query->have_posts() ) {
					$query->the_post();
					
					wc_get_template_part( 'content', 'product' );
				}
				woocommerce_product_loop_end();
				
				woocommerce_reset_loop();

				if ( $settings['pagination'] == 'yes' ) {
					echo '<nav class="woocommerce-pagination">';
					echo paginate_links( apply_filters( 'woocommerce_pagination_args', array( // WPCS: XSS ok.
						'base'         => str_replace( 999999999, '%#%', esc_url( get_pagenum_link( 999999999 ) ) ),
						'format'       => '',
						'add_args'     => false,
						'current'      => max( 1, get_query_var( 'paged' ), get_query_var( 'page' ) ),
						'total'        => $total_pages,
						'prev_text'    => '&larr;',
						'next_text'    => '&rarr;',
						'type'         => 'list',
						'end_size'     => 3,
						'mid_size'     => 3,
					) ) );
					echo '</nav>';
				}

				wp_reset_postdata();

				remove_filter( 'woocommerce_product_loop_start', [ $this, 'wc_loop_start' ], 15 );
				?>
			</div>
		</div>
		<?php
		endif;


	}

	protected function _content_template() {}
}
