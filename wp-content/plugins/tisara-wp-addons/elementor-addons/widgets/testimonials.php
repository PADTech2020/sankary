<?php
namespace ElementorTisara\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class KN_Testimonials extends Widget_Base {
	
	public function get_name() {
		return 'kn_testimonials';
	}

	public function get_title() {
		return __( 'TS - Testimonials', 'tisara-wp-addons' );
	}

	public function get_icon() {
		return 'eicon-posts-ticker';
	}

	public function get_categories() {
		return [ 'tisara' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_testimonials',
			[
				'label' => __( 'Testimonials', 'tisara-wp-addons' ),
			]
		);

			$this->add_responsive_control(
				'columns',
				[
					'label' 			=> __( 'Columns', 'tisara-wp-addons' ),
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
				]
			);

			$repeater = new Repeater();

			$repeater->add_control(
				'quote',
				[
					'label' 		=> __( 'Testimonisl', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXTAREA,
					'placeholder' 	=> __( 'Your Quote', 'tisara-wp-addons' ),
					'label_block' 	=> true,
				]
			);

			$repeater->add_control(
				'name',
				[
					'label' 		=> __( 'Name', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> __( 'Your Name', 'tisara-wp-addons' ),
					'label_block' 	=> true,
				]
			);

			$repeater->add_control(
				'job',
				[
					'label' 		=> __( 'Job Position', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> __( 'Your Position', 'tisara-wp-addons' ),
					'label_block' 	=> true,
				]
			);

			$repeater->add_control(
				'avatar',
				[
					'label' 	=> __( 'Choose Image', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::MEDIA,
					'default' 	=> [
						'url'	=> Utils::get_placeholder_image_src(),
					],
				]
			);

			$this->add_control(
				'testimonials',
				[
					'label' 		=> __( 'Testimonial', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::REPEATER,
					'show_label' 	=> true,
					'default' 		=> [
						[
							'quote' 	=> 'Lorem ipsum dolor sit amet, vim primis bonorum te. Libris expetenda liberavisse ne pro, pro eirmod volumus at. Ex vix novum accommodare.',
							'name' 		=> 'John Doe',
							'job' 		=> 'Web Designer',
							'avatar' 	=> [ 'url' => Utils::get_placeholder_image_src() ],
						],
						[
							'quote' 	=> 'Lorem ipsum dolor sit amet, vim primis bonorum te. Libris expetenda liberavisse ne pro, pro eirmod volumus at. Ex vix novum accommodare.',
							'name' 		=> 'John Doe',
							'job' 		=> 'Web Designer',
							'avatar' 	=> [ 'url' => Utils::get_placeholder_image_src() ],
						],
						[
							'quote' 	=> 'Lorem ipsum dolor sit amet, vim primis bonorum te. Libris expetenda liberavisse ne pro, pro eirmod volumus at. Ex vix novum accommodare.',
							'name' 		=> 'John Doe',
							'job' 		=> 'Web Designer',
							'avatar' 	=> [ 'url' => Utils::get_placeholder_image_src() ],
						],
					],
					'fields' 		=> array_values( $repeater->get_controls() ),
					'title_field' 	=> '{{{ name }}}',
				]
			);

			$this->add_control(
				'avatar_position',
				[
					'label'		=> __( 'Image Position', 'tisara-wp-addons' ),
					'type'		=> Controls_Manager::CHOOSE,
					'default'	=> 'left',
					'options'	=> [
						'left'	=> [
							'title'	=> __( 'Left', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-h-align-left'
						],
						'top'	=> [
							'title'	=> __( 'Top', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-v-align-top'
						],
						'right'	=> [
							'title'	=> __( 'Right', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-h-align-right'
						],
					],
					'prefix_class' => 'kn-testimonial-avatar-',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider / Carousel Options', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'carousel',
				[
					'label'			=> __( 'Carousel', 'tisara-wp-addons' ),
					'type'			=> Controls_Manager::SWITCHER,
					'default'		=> 'yes',
					'label_on'		=> __( 'Yes', 'tisara-wp-addons' ),
					'label_off'		=> __( 'No', 'tisara-wp-addons' ),
					'return_value'	=> 'yes'
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
					'condition'	=> [
						'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
					],
				]
			);

			$this->add_control(
				'effect',
				[
					'label' 	=> __( 'Effect', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SELECT,
					'default' 	=> 'slide',
					'options' 	=> [
						'slide' => __( 'Slide', 'tisara-wp-addons' ),
						'fade' 	=> __( 'Fade', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_testimonials',
			[
				'label'	=> __( 'Testimonials', 'tisara-wp-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_responsive_control(
				'testimonials_align',
				[
					'label' 	=> __( 'Testimonials Alignment', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'options' 	=> [
						'left' 		=> [
							'title' => __( 'Left', 'tisara-wp-addons' ),
							'icon' 	=> 'fa fa-align-left',
						],
						'center' 	=> [
							'title' => __( 'Center', 'tisara-wp-addons' ),
							'icon' 	=> 'fa fa-align-center',
						],
						'right' 	=> [
							'title' => __( 'Right', 'tisara-wp-addons' ),
							'icon' 	=> 'fa fa-align-right',
						],
						'justify' => [
							'title' => __( 'Justified', 'tisara-wp-addons' ),
							'icon' => 'fa fa-align-justify',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .kn-testimonials-wrapper' => 'text-align: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'item_gap',
				[
					'label' 	=> __( 'Item Gap', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size' 	=> 10,
					],
					'range' 	=> [
						'px'	=> [
							'min'	=> 0,
							'max'	=> 100,
						],
					],
					'selectors'	=> [
						'{{WRAPPER}} .kn-testimonials' => 'margin: 0 -{{SIZE}}px',
						'(desktop){{WRAPPER}} .kn-testimonial-item' => 'width: calc( 100% / {{columns.SIZE}} ); padding: {{SIZE}}px',
						'(tablet){{WRAPPER}} .kn-testimonial-item' => 'width: calc( 100% / {{columns_tablet.SIZE}} ); padding: {{SIZE}}px',
						'(mobile){{WRAPPER}} .kn-testimonial-item' => 'width: calc( 100% / {{columns_mobile.SIZE}} ); padding: {{SIZE}}px',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_quote',
			[
				'label' => __( 'Testimonial', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'quote_color',
				[
					'label' 	=> __( 'Text Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-testimonials .kn-testimonial-text' => 'color: {{VALUE}};',
					],
					'scheme' 	=> [
						'type' 	=> Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_2,
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'quote_typography',
					'selector' 	=> '{{WRAPPER}} .kn-testimonials .kn-testimonial-text',
					'scheme' 	=> Scheme_Typography::TYPOGRAPHY_3,
				]
			);

			$this->add_responsive_control(
				'quote_box_margin',
				[
					'label' 		=> __( 'Margin', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .kn-testimonials .kn-testimonial-text' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_name_job',
			[
				'label' => __( 'Name & Job', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'heading_style_name',
				[
					'label' 	=> __( 'Name', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'quote_name_color',
				[
					'label' 	=> __( 'Text Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-testimonials .kn-testimonial-name' => 'color: {{VALUE}};',
					],
					'scheme' 	=> [
						'type' 	=> Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_2,
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'quote_name_typography',
					'selector' 	=> '{{WRAPPER}} .kn-testimonials .kn-testimonial-name',
					'scheme' 	=> Scheme_Typography::TYPOGRAPHY_1,
				]
			);

			$this->add_control(
				'heading_style_job',
				[
					'label' 	=> __( 'Job', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::HEADING,
					'separator' => 'before',
				]
			);

			$this->add_control(
				'quote_job_color',
				[
					'label' 	=> __( 'Text Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-testimonials .kn-testimonial-job' => 'color: {{VALUE}};',
					],
					'scheme' 	=> [
						'type' 	=> Scheme_Color::get_type(),
						'value' => Scheme_Color::COLOR_3,
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'quote_job_typography',
					'selector' 	=> '{{WRAPPER}} .kn-testimonials .kn-testimonial-job',
					'scheme' 	=> Scheme_Typography::TYPOGRAPHY_2,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_avatar',
			[
				'label'	=> __( 'Image', 'tisara-wp-addons' ),
				'tab'	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 		=> 'avatar_border',
					'label' 	=> __( 'Image Border', 'tisara-wp-addons' ),
					'selector' 	=> '{{WRAPPER}} .kn-testimonials .kn-testimonial-avatar img',
				]
			);

			$this->add_control(
				'avatar_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .kn-testimonials .kn-testimonial-avatar img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name' 		=> 'avatar_box_shadow',
					'selector' 	=> '{{WRAPPER}} .kn-testimonials .kn-testimonial-avatar img',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label' => __( 'Slider / Navigation', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
					],
				]
			);

			$this->add_control(
				'arrows_color',
				[
					'label' 	=> __( 'Arrows Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-testimonials-wrapper .kn-testimonials-carousel .slick-prev:before, {{WRAPPER}} .kn-testimonials-wrapper .kn-testimonials-carousel .slick-next:before' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'carousel'	=> [ 'yes' ],
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
					'condition' => [
						'carousel'	=> [ 'yes' ],
						'navigation'	=> [ 'arrows', 'both' ],
					],
				]
			);

			$this->add_responsive_control(
				'arrows_size',
				[
					'label' 	=> __( 'Arrows Size', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::SLIDER,
					'default' 	=> [
						'size'	=> 35,
					],
					'range' 	=> [
						'px' 	=> [
							'min'	=> 0,
							'max'	=> 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .kn-testimonials-wrapper .kn-testimonials-carousel .slick-prev:before, {{WRAPPER}} .kn-testimonials-wrapper .kn-testimonials-carousel .slick-next:before' => 'font-size: {{SIZE}}px',
					],
					'condition'	=> [
						'carousel'	=> [ 'yes' ],
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
						'carousel'	=> [ 'yes' ],
					],
				]
			);

			$this->add_control(
				'dots_color',
				[
					'label' 	=> __( 'Dots Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-testimonials-wrapper .kn-testimonials-carousel ul.slick-dots li button:before' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'carousel'	=> [ 'yes' ],
					],
				]
			);

			$this->add_control(
				'dots_active_color',
				[
					'label' 	=> __( 'Dots Color (active)', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .kn-testimonials-wrapper .kn-testimonials-carousel ul.slick-dots li.slick-active button:before' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'carousel'	=> [ 'yes' ],
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
						'outside'	=> __( 'Outside', 'tisara-wp-addons' ),
						'inside'	=> __( 'Inside', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'carousel'	=> [ 'yes' ],
						'navigation'	=> [ 'dots', 'both' ],
					],
				]
			);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['testimonials'] ) ) {
			return;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'kn-testimonials-wrapper' );

		$this->add_render_attribute( 'wrapper', 'class', 'grid-columns-' .$settings['columns'] );

		$this->add_render_attribute( 'carousel', 'class', 'kn-testimonials' );

		if ( 'yes' == $settings['carousel'] ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-slick-slider' );

			$carousel_options = [
				'slides_to_show_desktop' 	=> $settings['columns'],
				'slides_to_show_tablet'		=> $settings['columns_tablet'],
				'slides_to_show_mobile'		=> $settings['columns_mobile'],
				'slides_to_scroll_desktop' 	=> $settings['slides_to_scroll'],
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
				'fade' 						=> ( 'fade' == $settings['effect'] ? true : false ),
				'rtl' 						=> ( is_rtl() ? true : false ),
				
			];

			$carousel_classes 	= [];
			$carousel_classes[] = 'kn-testimonials-carousel';

			if ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ) {
				$carousel_classes[] = 'slick-arrows-' . $settings['arrows_position'];
			}

			if ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ) {
				$carousel_classes[] = 'slick-dots-' . $settings['dots_position'];
			}

			$this->add_render_attribute( 'carousel', [
				'class'	=> $carousel_classes,
				'data-slider_options' => wp_json_encode( $carousel_options ),
			] );
		} else {
			$this->add_render_attribute( 'carousel', 'class', 'clearfix' );
		}

		?>
			
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
				<?php
				foreach ( $settings['testimonials'] as $testimonial ) {
					?>
					<div class="kn-testimonial-item">
						<blockquote class="kn-testimonial-text">
							<?php echo wpautop( $testimonial['quote'] ); ?>
						</blockquote>
						<div class="kn-testimonial-details">

							<div class="kn-testimonial-avatar">
								<?php
									if ( $testimonial['avatar']['id'] ) {
										echo wp_get_attachment_image( $testimonial['avatar']['id'], array( 50,50 ) );
									} else {
										echo '<img width="50" height="50" src="' . Utils::get_placeholder_image_src() .'">';
									}
								?>
							</div>
							<div class="kn-testimonial-name-job">
								<div class="kn-testimonial-name">
									<?php echo esc_html( $testimonial['name'] ); ?>
								</div>
								<div class="kn-testimonial-job">
									<?php echo esc_html( $testimonial['job'] ); ?>
								</div>
							</div>

						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>

		<?php
	}

	protected function _content_template() {
	}

}