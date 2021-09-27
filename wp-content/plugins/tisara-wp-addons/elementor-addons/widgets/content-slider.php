<?php
namespace ElementorTisara\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class KN_Content_Slider extends Widget_Base {

	public function get_name() {
		return 'kn_content_slider';
	}

	public function get_title() {
		return __( 'TS - Content Slider', 'tisara-wp-addons' );
	}

	public function get_icon() {
		return 'eicon-slideshow';
	}

	public function get_categories() {
		return [ 'tisara' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_slider',
			[
				'label' => __( 'Slider Items', 'tisara-wp-addons' ),
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'slider_heading',
			[
				'label'       => __( 'Heading', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Slider Heading', 'tisara-wp-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_description',
			[
				'label'       => __( 'Description', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => __( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', 'tisara-wp-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'slider_button',
			[
				'label'   => __( 'Button', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::TEXT,
				'default' => __( 'Click Me', 'tisara-wp-addons' ),
			]
		);

		$repeater->add_control(
			'slider_link',
			[
				'label'       => __( 'Link', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'tisara-wp-addons' ),
			]
		);

		$repeater->add_control(
			'slider_image',
			[
				'label'   => __( 'Image', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$this->add_control(
			'slider',
			[
				'label'      => __( 'Slider Items', 'tisara-wp-addons' ),
				'type'       => Controls_Manager::REPEATER,
				'show_label' => true,
				'default'    => [
					[
						'slider_heading'     => __( 'Slider 1 Heading', 'tisara-wp-addons' ),
						'slider_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
						'slider_button'      => __( 'Click Me', 'tisara-wp-addons' ),
						'slider_link'        => '#',
						'slider_image'       => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[
						'slider_heading'     => __( 'Slider 2 Heading', 'tisara-wp-addons' ),
						'slider_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
						'slider_button'      => __( 'Click Me', 'tisara-wp-addons' ),
						'slider_link'        => '#',
						'slider_image'       => [ 'url' => Utils::get_placeholder_image_src() ],
					],
					[
						'slider_heading'     => __( 'Slider 3 Heading', 'tisara-wp-addons' ),
						'slider_description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
						'slider_button'      => __( 'Click Me', 'tisara-wp-addons' ),
						'slider_link'        => '#',
						'slider_image'       => [ 'url' => Utils::get_placeholder_image_src() ],
					],
				],
				'fields'      => array_values( $repeater->get_controls() ),
				'title_field' => '{{{ slider_heading }}}',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label' => __( 'Slider Options', 'tisara-wp-addons' ),
			]
		);

		$this->add_control(
			'adaptive_height',
			[
				'label'   => __( 'Adaptive Height', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'  => __( 'No', 'tisara-wp-addons' ),
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
				],
			]
		);

		$this->add_control(
			'image_stretch',
			[
				'label'   => __( 'Image Stretch', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'no',
				'options' => [
					'no'  => __( 'No', 'tisara-wp-addons' ),
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'   => __( 'Navigation', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'dots',
				'options' => [
					'arrows' => __( 'Arrows', 'tisara-wp-addons' ),
					'dots'   => __( 'Dots', 'tisara-wp-addons' ),
					'both'   => __( 'Arrows and Dots', 'tisara-wp-addons' ),
					'none'   => __( 'None', 'tisara-wp-addons' ),
				],
			]
		);

		$this->add_control(
			'pause_on_hover',
			[
				'label'   => __( 'Pause on Hover', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
					'no'  => __( 'No', 'tisara-wp-addons' ),
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'   => __( 'Autoplay', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
					'no'  => __( 'No', 'tisara-wp-addons' ),
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'   => __( 'Autoplay Speed', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 5000,
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'   => __( 'Infinite Loop', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'yes',
				'options' => [
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
					'no'  => __( 'No', 'tisara-wp-addons' ),
				],
			]
		);

		$this->add_control(
			'effect',
			[
				'label'   => __( 'Effect', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => __( 'Slide', 'tisara-wp-addons' ),
					'fade'  => __( 'Fade', 'tisara-wp-addons' ),
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label'   => __( 'Animation Speed', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 500,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_heading',
			[
				'label' => __( 'Slide Heading', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'slide_heading_color',
			[
				'label'     => __( 'Text Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-slider-heading' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slide_heading_typography',
				'label'    => __( 'Typography', 'tisara-wp-addons' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .kn-slider-heading',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_description',
			[
				'label' => __( 'Slide Description', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'slide_description_color',
			[
				'label'     => __( 'Text Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-slider-description' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slide_description_typography',
				'label'    => __( 'Typography', 'tisara-wp-addons' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
				'selector' => '{{WRAPPER}} .kn-slider-description',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_button',
			[
				'label' => __( 'Slide Button', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'slide_button_color',
			[
				'label'     => __( 'Text Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button, {{WRAPPER}} .elementor-button.kn-slider-button:hover, {{WRAPPER}} .elementor-button.kn-slider-button:focus, {{WRAPPER}} .elementor-button.kn-slider-button:visited' => 'color: {{VALUE}}',
					'{{WRAPPER}} .elementor-button.kn-slider-button' => 'border-color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'slide_button_typography',
				'label'    => __( 'Typography', 'tisara-wp-addons' ),
				'selector' => '{{WRAPPER}} .elementor-button.kn-slider-button',
			]
		);

		$this->add_control(
			'slide_button_border_width',
			[
				'label'     => __( 'Border Width', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 20,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button' => 'border-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'slide_button_border_radius',
			[
				'label'     => __( 'Border Radius', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
				'separator'  => 'after',
			]
		);

		$this->start_controls_tabs( 'slide_button_tabs' );

		$this->start_controls_tab( 'slide_button_normal', [ 'label' => __( 'Normal', 'tisara-wp-addons' ) ] );

		$this->add_control(
			'slide_button_text_color',
			[
				'label'     => __( 'Text Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button, {{WRAPPER}} .elementor-button.kn-slider-button:visited' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_button_border_color',
			[
				'label'     => __( 'Border Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button, {{WRAPPER}} .elementor-button.kn-slider-button:visited' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_button_background_color',
			[
				'label'     => __( 'Background Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button, {{WRAPPER}} .elementor-button.kn-slider-button:visited' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'slide_button_hover', [ 'label' => __( 'Hover', 'tisara-wp-addons' ) ] );

		$this->add_control(
			'slide_button_hover_text_color',
			[
				'label'     => __( 'Text Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_button_hover_border_color',
			[
				'label'     => __( 'Border Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'slide_button_hover_background_color',
			[
				'label'     => __( 'Background Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .elementor-button.kn-slider-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Navigation', 'tisara-wp-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'navigation' => [ 'arrows', 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_arrows',
			[
				'label'     => __( 'Arrows', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'     => __( 'Arrows Position', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'inside',
				'options'   => [
					'inside'  => __( 'Inside', 'tisara-wp-addons' ),
					'outside' => __( 'Outside', 'tisara-wp-addons' ),
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_size',
			[
				'label'     => __( 'Arrows Size', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 20,
						'max' => 60,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .kn-content-slider-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .kn-content-slider-wrapper .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_color',
			[
				'label'     => __( 'Arrows Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-content-slider-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .kn-content-slider-wrapper .slick-slider .slick-next:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'heading_style_dots',
			[
				'label'     => __( 'Dots', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'     => __( 'Dots Position', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'inside',
				'options'   => [
					'inside'  => __( 'Inside', 'tisara-wp-addons' ),
					'outside' => __( 'Outside', 'tisara-wp-addons' ),
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_size',
			[
				'label'     => __( 'Dots Size', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => [
					'px' => [
						'min' => 5,
						'max' => 10,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .kn-content-slider-wrapper .kn-content-slider .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_color',
			[
				'label'     => __( 'Dots Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-content-slider-wrapper .kn-content-slider .slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition' => [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['slider'] ) )
			return;

		$slides = [];
		foreach ( $settings['slider'] as $slider ) {
			$slide_left = '';
			if ( $slide_heading = $slider['slider_heading'] ) {
				$slide_left .= '<div class="kn-slider-heading">'.$slide_heading.'</div>';
			}
			if ( $slider_description = $slider['slider_description'] ) {
				$slide_left .= '<div class="kn-slider-description">'.$slider_description.'</div>';
			}
			if ( $slider_button = $slider['slider_button'] ) {
				$slide_link = $slider['slider_link']['url'] ? esc_url( $slider['slider_link']['url'] ) : '#';
				$slide_left .= '<a href="'.$slide_link.'" class="kn-slider-button elementor-button elementor-size-sm">'.$slider_button.'</a>';
			}
			if ( $slide_left ) {
				$slide_left = '<div class="kn-slider-content">'.$slide_left.'</div>';
			}
			$slide_right = '';
			if ( $slide_image = $slider['slider_image']['url'] ) {
				$slide_right .= '<img class="slick-slide-image" src="' . esc_url( $slide_image ) . '" alt="" />';
			}
			$slides[] = '<div class="slick-slide"><div class="slick-slide-inner">
			<div class="elementor-section-content-middle elementor-reverse-mobile">
				<div class="elementor-container elementor-column-gap-no">
					<div class="elementor-row">
						<div class="elementor-column elementor-col-50">
							<div class="elementor-column-wrap">
								'.$slide_left.'
							</div>
						</div>
						<div class="elementor-column elementor-col-50">
							<div class="elementor-column-wrap">
								'.$slide_right.'
							</div>
						</div>
					</div>
				</div>
			</div>
			</div></div>';
		}

		if ( empty( $slides ) ) {
			return;
		}

		$direction = is_rtl() ? 'rtl' : 'ltr';

		$slider_options = [
			'slidesToShow' => absint( 1 ),
			'autoplaySpeed' => absint( $settings['autoplay_speed'] ),
			'autoplay' => ( 'no' !== $settings['autoplay'] ? true : false ),
			'infinite' => ( 'no' !== $settings['infinite'] ? true : false ),
			'pauseOnHover' => ( 'no' !== $settings['pause_on_hover'] ? true : false ),
			'speed' => absint( $settings['speed'] ),
			'arrows' => ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ? true : false ),
			'dots' => ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ? true : false ),
			'fade' => ( 'slide' !== $settings['effect'] ? true : false ),
			'adaptiveHeight' => ( 'no' !== $settings['adaptive_height'] ? true : false ),
			'rtl' => ( is_rtl() ? true : false ),
		];

		$slider_classes = [ 'kn-content-slider', 'elementor-slides' ];

		if ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ) {
			$slider_classes[] = 'slick-arrows-' . $settings['arrows_position'];
		}

		if ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ) {
			$slider_classes[] = 'slick-dots-' . $settings['dots_position'];
		}

		$this->add_render_attribute( 'slider', [
			'class' => $slider_classes,
			'data-slider_options' => wp_json_encode( $slider_options ),
		] );

		?>
		<div class="kn-content-slider-wrapper elementor-slick-slider" dir="<?php echo $direction; ?>">
			<div <?php echo $this->get_render_attribute_string( 'slider' ); ?>>
				<?php echo implode( '', $slides ); ?>
			</div>
		</div>
		<?php
	}

	protected function _content_template() {
	}
}
