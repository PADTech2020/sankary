<?php
namespace ElementorTisara\Widgets;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class KN_Image_Slider extends Widget_Base {

	public function get_name() {
		return 'kn_image_slider';
	}

	public function get_title() {
		return __( 'TS - Image Slider', 'tisara-wp-addons' );
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
				'label'	=> __( 'Slider Items', 'tisara-wp-addons' ),
			]
		);

			$repeater = new Repeater();

			$repeater->add_control(
				'image',
				[
					'label' 	=> __( 'Image', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::MEDIA,
					'default' 	=> [
						'url' 	=> Utils::get_placeholder_image_src(),
					],
				]
			);

			$repeater->add_control(
				'slider_caption',
				[
					'label'         => __( 'Caption', 'tisara-wp-addons' ),
					'type'          => Controls_Manager::TEXT,
					'default'       => __( 'Slider Caption', 'tisara-wp-addons' ),
					'label_block'	=> true,
				]
			);

			$repeater->add_control(
				'slider_link',
				[
					'label'         => __( 'Link', 'tisara-wp-addons' ),
					'type'          => Controls_Manager::URL,
					'placeholder'	=> __( 'http://your-link.com', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'slider',
				[
					'label'         => __( 'Slider Items', 'tisara-wp-addons' ),
					'type'          => Controls_Manager::REPEATER,
					'show_label'	=> true,
					'default'       => [
						[
							'image'             => [ 'url' => Utils::get_placeholder_image_src() ],
							'slider_caption'	=> __( 'Slider 1 Caption', 'tisara-wp-addons' ),
							'slider_link'       => '#',
						],
						[
							'image'             => [ 'url' => Utils::get_placeholder_image_src() ],
							'slider_caption'    => __( 'Slider 2 Caption', 'tisara-wp-addons' ),
							'slider_link'       => '#',
						],
						[
							'image'             => [ 'url' => Utils::get_placeholder_image_src() ],
							'slider_caption'    => __( 'Slider 3 Caption', 'tisara-wp-addons' ),
							'slider_link'       => '#',
						],
					],
					'fields'        => array_values( $repeater->get_controls() ),
					'title_field'   => '{{{ slider_caption }}}',
				]
			);

			$this->add_group_control(
				Group_Control_Image_Size::get_type(),
				[
					'name'      => 'image', // Actually its `image_size`
					'label'     => __( 'Image Size', 'tisara-wp-addons' ),
					'default'	=> 'large',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_options',
			[
				'label'	=> __( 'Slider Options', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'adaptive_height',
				[
					'label'     => __( 'Adaptive Height', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'yes',
					'options'   => [
						'yes'	=> __( 'Yes', 'tisara-wp-addons' ),
						'no'	=> __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'image_stretch',
				[
					'label'     => __( 'Image Stretch', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'yes',
					'options'   => [
						'yes'	=> __( 'Yes', 'tisara-wp-addons' ),
						'no'	=> __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'navigation',
				[
					'label'      => __( 'Navigation', 'tisara-wp-addons' ),
					'type'       => Controls_Manager::SELECT,
					'default'    => 'both',
					'options'    => [
						'both'      => __( 'Arrows and Dots', 'tisara-wp-addons' ),
						'arrows'	=> __( 'Arrows', 'tisara-wp-addons' ),
						'dots'      => __( 'Dots', 'tisara-wp-addons' ),
						'thumb'	    => __( 'Image Thumbnail', 'tisara-wp-addons' ),
						'none'      => __( 'None', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'pause_on_hover',
				[
					'label'     => __( 'Pause on Hover', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'yes',
					'options'   => [
						'yes'   => __( 'Yes', 'tisara-wp-addons' ),
						'no'    => __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'autoplay',
				[
					'label'     => __( 'Autoplay', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'yes',
					'options'	=> [
						'yes'	=> __( 'Yes', 'tisara-wp-addons' ),
						'no'	=> __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'autoplay_speed',
				[
					'label'     => __( 'Autoplay Speed', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::NUMBER,
					'default'	=> 5000,
				]
			);

			$this->add_control(
				'infinite',
				[
					'label'     => __( 'Infinite Loop', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'yes',
					'options'	=> [
						'yes'	=> __( 'Yes', 'tisara-wp-addons' ),
						'no'	=> __( 'No', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'effect',
				[
					'label'     => __( 'Effect', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'slide',
					'options'	=> [
						'slide'	=> __( 'Slide', 'tisara-wp-addons' ),
						'fade'	=> __( 'Fade', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'speed',
				[
					'label'     => __( 'Animation Speed', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::NUMBER,
					'default'	=> 500,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_slider_thumb_nav',
			[
				'label'	    => __( 'Thumbnail Image Options', 'tisara-wp-addons' ),
				'condition'	=> [
					'navigation'	=> [ 'thumb' ],
				],
			]	
		);

			$this->add_control(
				'columns',
				[
					'label'     => __( 'Columns', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '5',
					'options'	=> [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			[
				'label'	=> __( 'Image Caption', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'caption_horizontal_position',
				[
					'label'         => __( 'Horizontal Position', 'tisara-wp-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'   => false,
					'default'       => 'center',
					'options'       => [
						'left'      => [
							'title' => __( 'Left', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-h-align-left',
						],
						'center'	=> [
							'title' => __( 'Center', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-h-align-center',
						],
						'right'     => [
							'title' => __( 'Right', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-h-align-right',
						],
					],
					'prefix_class'  => 'kn-image-slider-caption-pos-h-',
				]
			);

			$this->add_control(
				'caption_vertical_position',
				[
					'label'         => __( 'Vertical Position', 'tisara-wp-addons' ),
					'type'          => Controls_Manager::CHOOSE,
					'label_block'	=> false,
					'default'       => 'bottom',
					'options'       => [
						'top'       => [
							'title'	=> __( 'Top', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-v-align-top',
						],
						'middle'    => [
							'title' => __( 'Middle', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-v-align-middle',
						],
						'bottom'    => [
							'title' => __( 'Bottom', 'tisara-wp-addons' ),
							'icon'	=> 'eicon-v-align-bottom',
						],
					],
					'prefix_class'	=> 'kn-image-slider-caption-pos-v-',
				]
			);

			$this->add_responsive_control(
				'caption_padding',
				[
					'label'         => __( 'Padding', 'tisara-wp-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'    => [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .kn-image-slider-wrapper .kn-slide-image-caption' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_responsive_control(
				'caption_margin',
				[
					'label'         => __( 'Margin', 'tisara-wp-addons' ),
					'type'          => Controls_Manager::DIMENSIONS,
					'size_units'	=> [ 'px', 'em', '%' ],
					'selectors'     => [
						'{{WRAPPER}} .kn-image-slider-wrapper .kn-slide-image-caption' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'caption_background',
				[
					'label'     => __( 'Background Color', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .kn-image-slider-wrapper .kn-slide-image-caption' => 'background-color: {{VALUE}}',
					],
				]
			);

			$this->add_control(
				'caption_color',
				[
					'label'     => __( 'Text Color', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .kn-image-slider-wrapper .kn-slide-image-caption' => 'color: {{VALUE}}',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'      => 'caption_typography',
					'label'     => __( 'Typography', 'tisara-wp-addons' ),
					'scheme'    => Scheme_Typography::TYPOGRAPHY_1,
					'selector'  => '{{WRAPPER}} .kn-image-slider-wrapper .kn-slide-image-caption',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Navigation', 'tisara-wp-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition'	=> [
					'navigation'	=> [ 'arrows', 'dots', 'both' ],
				],
			]
		);

			$this->add_control(
				'heading_style_arrows',
				[
					'label'     => __( 'Arrows', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::HEADING,
					'separator' => 'before',
					'condition'	=> [
						'navigation'	=> [ 'arrows', 'both' ],
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
						'inside'	=> __( 'Inside', 'tisara-wp-addons' ),
						'outside'	=> __( 'Outside', 'tisara-wp-addons' ),
					],
					'condition'	=> [
						'navigation'	=> [ 'arrows', 'both' ],
					],
				]
			);

			$this->add_control(
				'arrows_size',
				[
					'label'     => __( 'Arrows Size', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px'	=> [
							'min'	=> 20,
							'max'	=> 60,
						],
					],
					'selectors'	=> [
						'{{WRAPPER}} .kn-image-slider-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .kn-image-slider-wrapper .slick-slider .slick-next:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'navigation'	=> [ 'arrows', 'both' ],
					],
				]
			);

			$this->add_control(
				'arrows_color',
				[
					'label'     => __( 'Arrows Color', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .kn-image-slider-wrapper .slick-slider .slick-prev:before, {{WRAPPER}} .kn-image-slider-wrapper .slick-slider .slick-next:before' => 'color: {{VALUE}};',
					],
					'condition' => [
						'navigation'	=> [ 'arrows', 'both' ],
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
						'navigation'	=> [ 'dots', 'both' ],
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
						'inside'	=> __( 'Inside', 'tisara-wp-addons' ),
						'outside'	=> __( 'Outside', 'tisara-wp-addons' ),
					],
					'condition' => [
						'navigation'	=> [ 'dots', 'both' ],
					],
				]
			);

			$this->add_control(
				'dots_size',
				[
					'label'     => __( 'Dots Size', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::SLIDER,
					'range'     => [
						'px'	=> [
							'min'	=> 5,
							'max'	=> 10,
						],
					],
					'selectors'	=> [
						'{{WRAPPER}} .kn-image-slider-wrapper .kn-image-slider .slick-dots li button:before' => 'font-size: {{SIZE}}{{UNIT}};',
					],
					'condition' => [
						'navigation'	=> [ 'dots', 'both' ],
					],
				]
			);

			$this->add_control(
				'dots_color',
				[
					'label'     => __( 'Dots Color', 'tisara-wp-addons' ),
					'type'      => Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .kn-image-slider-wrapper .kn-image-slider .slick-dots li button:before' => 'color: {{VALUE}};',
					],
					'condition'	=> [
						'navigation'	=> [ 'dots', 'both' ],
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
		$slides_nav = [];
		foreach ( $settings['slider'] as $slider ) {
			
			$slide_html = '';

			if ( empty( $slider['image']['url'] ) ) {
				continue;
			}

			if ( isset($settings['image_size']) ) {
				$slider['image_size'] = $settings['image_size'];
			}

			if ( isset($settings['image_custom_dimension']) ) {
				$slider['image_custom_dimension'] = $settings['image_custom_dimension'];
			}

			$slide_html = Group_Control_Image_Size::get_attachment_image_html( $slider );

			if ( $slide_html ) {
				$slide_html = sprintf( '<div class="slick-slide-image">%s</div>', $slide_html );
			}

			if ( $slider['image']['id'] ) {
				$slide_nav_image = wp_get_attachment_image( $slider['image']['id'], 'thumbnail' );
			} else {
				$slide_nav_image = Group_Control_Image_Size::get_attachment_image_html( $slider );
			}

			if ( $slide_html ) {
				$slides_nav[] = '<div class="slick-slide"><div class="slick-slide-inner">' . $slide_nav_image . '</div></div>';
			}

			if ( $slide_caption = $slider['slider_caption'] ) {
				$slide_html .= '<div class="kn-slide-image-caption-box">';
				$slide_html .= '<div class="kn-slide-image-caption-inner">';
				$slide_html .= '<div class="kn-slide-image-caption">'.$slide_caption.'</div>';
				$slide_html .= '</div>';
				$slide_html .= '</div>';
			}

			if ( $slide_link = $slider['slider_link']['url'] ) {
				$target = '';
				if ( ! empty( $slider['slider_link']['is_external'] ) ) {
					$target = ' target="_blank"';
				}
				$slide_html = sprintf( '<a href="%s"%s>%s</a>', esc_url( $slide_link ), $target, $slide_html );
			}

			if ( $slide_html ) {
				$slides[] = '<div class="slick-slide"><div class="slick-slide-inner">' . $slide_html . '</div></div>';
			}

		}

		if ( empty( $slides ) ) {
			return;
		}

		if ( "yes" == $settings['image_stretch'] ) {
			$this->add_render_attribute( 'slider', [ 'class' => 'slick-image-stretch' ] );
		}

		$direction = is_rtl() ? true : false;

		$slider_base_options = [
			'autoplaySpeed'	    => absint( $settings['autoplay_speed'] ),
			'autoplay'          => ( 'no' !== $settings['autoplay'] ? true : false ),
			'infinite'          => ( 'no' !== $settings['infinite'] ? true : false ),
			'pauseOnHover'      => ( 'no' !== $settings['pause_on_hover'] ? true : false ),
			'speed'             => absint( $settings['speed'] ),
			'arrows'            => ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ? true : false ),
			'dots'              => ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ? true : false ),
			'fade'              => ( 'slide' !== $settings['effect'] ? true : false ),
			'adaptiveHeight'	=> ( 'no' !== $settings['adaptive_height'] ? true : false ),
			'rtl'               => $direction,
		];

		$slider_base_classes = [];
		// $slider_base_classes = [ 'elementor-slides' ];
		if ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ) {
			$slider_base_classes[] = 'slick-arrows-' . $settings['arrows_position'];
		}
		if ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ) {
			$slider_base_classes[] = 'slick-dots-' . $settings['dots_position'];
		}

		$slider_options = $slider_base_options;
		if ( "thumb" == $settings['navigation'] ) {
			$slider_options['asNavFor'] = '.kn-image-slider-nav';
		}
		$slider_options['sliderSyncing'] = ("thumb" == $settings['navigation'] ? true : false);
		$slider_options['slidesToShow'] = absint( 1 );

		$slider_classes = $slider_base_classes;
		$slider_classes[] = 'kn-image-slider';

		$this->add_render_attribute( 'slider', [
			'class' => $slider_classes,
			'data-slider_options' => wp_json_encode( $slider_options ),
			// 'data-animation' => $settings['content_animation'],
		] );

		// $slider_nav_options = $slider_base_options;
		$slider_nav_options['asNavFor'] = '.kn-image-slider';
		$slider_nav_options['slidesToShow'] = absint( $settings['columns'] );

		$slider_nav_classes = $slider_base_classes;
		$slider_nav_classes[] = 'kn-image-slider-nav';

		$this->add_render_attribute( 'slider_nav', [
			'class' => $slider_nav_classes,
			'data-slider_nav_options' => wp_json_encode( $slider_nav_options ),
			// 'data-animation' => $settings['content_animation'],
		] );

		?>
		<div class="kn-image-slider-wrapper elementor-slick-slider" dir="<?php echo $direction; ?>">
			<div <?php echo $this->get_render_attribute_string( 'slider' ); ?>>
				<?php echo implode( '', $slides ); ?>
			</div>

			<?php if ( "thumb" == $settings['navigation'] ) : ?>
				<div <?php echo $this->get_render_attribute_string( 'slider_nav' ); ?>>
					<?php echo implode( '', $slides_nav ); ?>
				</div>
			<?php endif; ?>
		</div>
		<?php
	}

	protected function _content_template() {}
}
