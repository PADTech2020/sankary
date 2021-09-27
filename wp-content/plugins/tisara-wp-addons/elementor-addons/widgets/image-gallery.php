<?php
namespace ElementorTisara\Widgets;

use ElementorTisara\Controls\KN_Group_Control_Background;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class KN_Image_Gallery extends Widget_Base {

	public function get_name() {
		return 'kn_image_gallery';
	}

	public function get_title() {
		return __( 'TS - Image Gallery', 'tisara-wp-addons' );
	}

	public function get_icon() {
		return 'eicon-gallery-grid';
	}

	public function get_categories() {
		return [ 'tisara' ];
	}

	public function get_script_depends() {
		return [ 'jquery-slick' ];
	}

	protected function _register_controls() {
		$this->start_controls_section(
			'section_images',
			[
				'label' => __( 'Images', 'tisara-wp-addons' ),
			]
		);

		$this->add_responsive_control(
			'columns',
			[
				'label'           => __( 'Columns', 'tisara-wp-addons' ),
				'type'            => Controls_Manager::SELECT,
				'desktop_default' => '3',
				'tablet_default'  => '2',
				'mobile_default'  => '1',
				'options'         => [
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
			'image',
			[
				'label'   => __( 'Choose Image', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::MEDIA,
				'default' => [
					'url' => Utils::get_placeholder_image_src(),
				],
			]
		);

		$repeater->add_control(
			'link_to',
			[
				'label'   => __( 'Link to', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none'   => __( 'None', 'tisara-wp-addons' ),
					'file'   => __( 'Media File', 'tisara-wp-addons' ),
					'custom' => __( 'Custom URL', 'tisara-wp-addons' ),
				],
			]
		);

		$repeater->add_control(
			'link',
			[
				'label'       => __( 'Link to', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::URL,
				'placeholder' => __( 'http://your-link.com', 'tisara-wp-addons' ),
				'condition'   => [
					'link_to' => 'custom',
				],
				'show_label'  => false,
			]
		);

		$repeater->add_control(
			'caption',
			[
				'label'       => __( 'Caption', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your image caption', 'tisara-wp-addons' ),
				'title'       => __( 'Input image caption here', 'tisara-wp-addons' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'sub_caption',
			[
				'label'       => __( 'Sub Caption', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::TEXT,
				'placeholder' => __( 'Enter your image sub caption', 'tisara-wp-addons' ),
				'title'       => __( 'Input image sub caption here', 'tisara-wp-addons' ),
				'label_block' => true,
			]
		);

		$this->add_control(
			'images',
			[
				'label'      => __( 'Images', 'tisara-wp-addons' ),
				'type'       => Controls_Manager::REPEATER,
				'show_label' => true,
				'default'    => [
					[
						'image'       => [ 'url' => Utils::get_placeholder_image_src() ],
						'link_to'     => 'none',
						'link'        => '',
						'caption'     => '',
						'sub_caption' => '',
					],
					[
						'image'       => [ 'url' => Utils::get_placeholder_image_src() ],
						'link_to'     => 'none',
						'link'        => '',
						'caption'     => '',
						'sub_caption' => '',
					],
					[
						'image'       => [ 'url' => Utils::get_placeholder_image_src() ],
						'link_to'     => 'none',
						'link'        => '',
						'caption'     => '',
						'sub_caption' => '',
					],
					[
						'image'       => [ 'url' => Utils::get_placeholder_image_src() ],
						'link_to'     => 'none',
						'link'        => '',
						'caption'     => '',
						'sub_caption' => '',
					],
					[
						'image'       => [ 'url' => Utils::get_placeholder_image_src() ],
						'link_to'     => 'none',
						'link'        => '',
						'caption'     => '',
						'sub_caption' => '',
					],
					[
						'image'       => [ 'url' => Utils::get_placeholder_image_src() ],
						'link_to'     => 'none',
						'link'        => '',
						'caption'     => '',
						'sub_caption' => '',
					],
				],
				'fields'      => array_values( $repeater->get_controls() ),
				'title_field' => '{{{ caption }}}',
			]
		);

		$this->add_group_control(
			Group_Control_Image_Size::get_type(),
			[
				'name'    => 'image', // Actually its `image_size`
				'label'   => __( 'Image Size', 'tisara-wp-addons' ),
				'default' => 'thumbnail',
			]
		);

		$this->add_control(
			'view',
			[
				'label'   => __( 'View', 'tisara-wp-addons' ),
				'type'    => Controls_Manager::HIDDEN,
				'default' => 'traditional',
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
				'label'        => __( 'Carousel', 'tisara-wp-addons' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => __( 'Yes', 'tisara-wp-addons' ),
				'label_off'    => __( 'No', 'tisara-wp-addons' ),
				'return_value' => 'yes'
			]
		);

		$this->add_responsive_control(
			'slides_to_scroll',
			[
				'label'           => __( 'Slides To Scroll', 'tisara-wp-addons' ),
				'type'            => Controls_Manager::SELECT,
				'desktop_default' => '1',
				'tablet_default'  => '1',
				'mobile_default'  => '1',
				'options'         => [
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
					'6' => '6',
				],
				'condition'	      => [
					'carousel'	=> [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'adaptive_height',
			[
				'label'     => __( 'Adaptive Height', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'yes',
				'options'   => [
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
					'no' => __( 'No', 'tisara-wp-addons' ),
				],
				'condition'	=> [
					'carousel'	=> [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'navigation',
			[
				'label'     => __( 'Navigation', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'both',
				'options'   => [
					'both'   => __( 'Arrows and Dots', 'tisara-wp-addons' ),
					'arrows' => __( 'Arrows', 'tisara-wp-addons' ),
					'dots'   => __( 'Dots', 'tisara-wp-addons' ),
					'none'   => __( 'None', 'tisara-wp-addons' ),
				],
				'condition'	=> [
					'carousel'	=> [ 'yes' ],
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
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
					'no'  => __( 'No', 'tisara-wp-addons' ),
				],
				'condition'	=> [
					'carousel'	=> [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'     => __( 'Autoplay', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'yes',
				'options'   => [
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
					'no'  => __( 'No', 'tisara-wp-addons' ),
				],
				'condition'	=> [
					'carousel'	=> [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'autoplay_speed',
			[
				'label'     => __( 'Autoplay Speed', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 5000,
				'condition' => [
					'carousel'	=> [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'infinite',
			[
				'label'     => __( 'Infinite Loop', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'yes',
				'options'   => [
					'yes' => __( 'Yes', 'tisara-wp-addons' ),
					'no'  => __( 'No', 'tisara-wp-addons' ),
				],
				'condition'	=> [
					'carousel'	=> [ 'yes' ],
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label'     => __( 'Animation Speed', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::NUMBER,
				'default'   => 500,
				'condition' => [
					'carousel'	=> [ 'yes' ],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_image',
			[
				'label' => __( 'Image', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'item_gap',
			[
				'label'     => __( 'Item Gap', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 10,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery' => 'margin: 0 -{{SIZE}}px',
					'(desktop){{WRAPPER}} .kn-image-gallery-item' => 'width: calc( 100% / {{columns.SIZE}} ); border: {{SIZE}}px solid transparent',
					'(tablet){{WRAPPER}} .kn-image-gallery-item' => 'width: calc( 100% / {{columns_tablet.SIZE}} ); border: {{SIZE}}px solid transparent',
					'(mobile){{WRAPPER}} .kn-image-gallery-item' => 'width: calc( 100% / {{columns_mobile.SIZE}} ); border: {{SIZE}}px solid transparent',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover Animation', 'tisara-wp-addons' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'image_border',
				'label'    => __( 'Image Border', 'tisara-wp-addons' ),
				'selector' => '{{WRAPPER}} .kn-image-gallery-image img',
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label'      => __( 'Border Radius', 'tisara-wp-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .kn-image-gallery-image img, {{WRAPPER}} .kn-image-gallery-caption-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .kn-image-gallery-image img',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption_box',
			[
				'label' => __( 'Caption Box (Image Overlay)', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			KN_Group_Control_Background::get_type(),
			[
				'label'    => __( 'Background Type', 'tisara-wp-addons' ),
				'name'     => 'caption_box_background',
				'types'    => [ 'none', 'classic', 'gradient', 'video' ],
				'selector' => '{{WRAPPER}} .kn-image-gallery-caption-inner',
			]
		);

		$this->add_responsive_control(
			'caption_box_margin',
			[
				'label'      => __( 'Margin', 'tisara-wp-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .kn-image-gallery-caption-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'caption_box_padding',
			[
				'label'      => __( 'Padding', 'tisara-wp-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .kn-image-gallery-caption-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_caption',
			[
				'label' => __( 'Caption Text', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'caption_horizontal_position',
			[
				'label'       => __( 'Horizontal Position', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'center',
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'tisara-wp-addons' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'tisara-wp-addons' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'tisara-wp-addons' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'prefix_class' => 'kn-image-gallery-caption-pos-h-',
			]
		);

		$this->add_control(
			'caption_vertical_position',
			[
				'label'       => __( 'Vertical Position', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'default'     => 'middle',
				'options'     => [
					'top'    => [
						'title' => __( 'Top', 'tisara-wp-addons' ),
						'icon'  => 'eicon-v-align-top',
					],
					'middle' => [
						'title' => __( 'Middle', 'tisara-wp-addons' ),
						'icon'  => 'eicon-v-align-middle',
					],
					'bottom' => [
						'title' => __( 'Bottom', 'tisara-wp-addons' ),
						'icon'  => 'eicon-v-align-bottom',
					],
				],
				'prefix_class' => 'kn-image-gallery-caption-pos-v-',
			]
		);

		$this->add_control(
			'caption_text_align',
			[
				'label'       => __( 'Text Align', 'tisara-wp-addons' ),
				'type'        => Controls_Manager::CHOOSE,
				'label_block' => false,
				'options'     => [
					'left'   => [
						'title' => __( 'Left', 'tisara-wp-addons' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'tisara-wp-addons' ),
						'icon'  => 'fa fa-align-center',
					],
					'right'  => [
						'title' => __( 'Right', 'tisara-wp-addons' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'default'   => 'center',
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery-caption-text' => 'text-align: {{VALUE}}',
				],
			]
		);

		$this->add_control(
			'caption_background',
			[
				'label'     => __( 'Background Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery-caption-text' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'caption_padding',
			[
				'label'      => __( 'Padding', 'tisara-wp-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .kn-image-gallery-caption-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'caption_border_radius',
			[
				'label'      => __( 'Border Radius', 'tisara-wp-addons' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .kn-image-gallery-caption-text' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'heading_style_caption',
			[
				'label'     => __( 'Caption', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'caption_color',
			[
				'label'     => __( 'Text Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery-caption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'caption_typography',
				'selector' => '{{WRAPPER}} .kn-image-gallery-caption',
			]
		);

		$this->add_control(
			'heading_style_subcaption',
			[
				'label'     => __( 'Sub Caption', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'subcaption_color',
			[
				'label'     => __( 'Text Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery-subcaption' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'subcaption_typography',
				'selector' => '{{WRAPPER}} .kn-image-gallery-subcaption',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_navigation',
			[
				'label'     => __( 'Slider / Navigation', 'tisara-wp-addons' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'carousel'    => [ 'yes' ],
					'navigation!' => [ 'none' ],
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
			'arrows_color',
			[
				'label'     => __( 'Arrows Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery-wrapper .kn-image-gallery-carousel .slick-prev:before, {{WRAPPER}} .kn-image-gallery-wrapper .kn-image-gallery-carousel .slick-next:before' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_control(
			'arrows_position',
			[
				'label'     => __( 'Arrows Position', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'outside',
				'options'   => [
					'inside'  => __( 'Inside', 'tisara-wp-addons' ),
					'outside' => __( 'Outside', 'tisara-wp-addons' ),
				],
				'condition' => [
					// 'carousel'	=> [ 'yes' ],
					'navigation' => [ 'arrows', 'both' ],
				],
			]
		);

		$this->add_responsive_control(
			'arrows_size',
			[
				'label'     => __( 'Arrows Size', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'size' => 35,
				],
				'range'     => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery-wrapper .kn-image-gallery-carousel .slick-prev:before, {{WRAPPER}} .kn-image-gallery-wrapper .kn-image-gallery-carousel .slick-next:before' => 'font-size: {{SIZE}}px',
				],
				'condition'	=> [
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
			'dots_color',
			[
				'label'     => __( 'Dots Color', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery-wrapper .kn-image-gallery-carousel ul.slick-dots li button:before' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_active_color',
			[
				'label'     => __( 'Dots Color (active)', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .kn-image-gallery-wrapper .kn-image-gallery-carousel ul.slick-dots li.slick-active button:before' => 'color: {{VALUE}};',
				],
				'condition'	=> [
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->add_control(
			'dots_position',
			[
				'label'     => __( 'Dots Position', 'tisara-wp-addons' ),
				'type'      => Controls_Manager::SELECT,
				'default'   => 'outside',
				'options'   => [
					'outside' => __( 'Outside', 'tisara-wp-addons' ),
					'inside'  => __( 'Inside', 'tisara-wp-addons' ),
				],
				'condition' => [
					// 'carousel'	=> [ 'yes' ],
					'navigation' => [ 'dots', 'both' ],
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		if ( empty( $settings['images'] ) ) {
			return;
		}

		$this->add_render_attribute( 'wrapper', 'class', 'kn-image-gallery-wrapper' );
		if ( $settings['carousel'] == 'yes' ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-slick-slider' );
		}
		$this->add_render_attribute( 'wrapper', ['class' => 'grid-columns-' . $settings['columns']] );
		$this->add_render_attribute( 'wrapper', 'class', 'clearfix' );

		$carousel_options = [
			'slides_to_show_desktop' => $settings['columns'],
			'slides_to_show_tablet'	=> $settings['columns_tablet'],
			'slides_to_show_mobile'	=> $settings['columns_mobile'],
			'slides_to_scroll_desktop' => $settings['slides_to_scroll'],
			'slides_to_scroll_tablet' => $settings['slides_to_scroll_tablet'],
			'slides_to_scroll_mobile' => $settings['slides_to_scroll_mobile'],
			'adaptiveHeight' => ( 'no' !== $settings['adaptive_height'] ? true : false ),
			'autoplaySpeed' => absint( $settings['autoplay_speed'] ),
			'autoplay' => ( 'no' !== $settings['autoplay'] ? true : false ),
			'infinite' => ( 'no' !== $settings['infinite'] ? true : false ),
			'pauseOnHover' => ( 'no' !== $settings['pause_on_hover'] ? true : false ),
			'speed' => absint( $settings['speed'] ),
			'arrows' => ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ? true : false ),
			'dots' => ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ? true : false ),
			'fade' 						=> false,
			'rtl' => ( is_rtl() ? true : false ),
			
		];

		$carousel_classes = [];
		$carousel_classes[] = 'kn-image-gallery';
		$carousel_classes[] = 'clearfix';
		if ( $settings['carousel'] == 'yes' ) {
			$carousel_classes[] = 'kn-image-gallery-carousel';
		}

		if ( in_array( $settings['navigation'], [ 'arrows', 'both' ] ) ) {
			$carousel_classes[] = 'slick-arrows-' . $settings['arrows_position'];
		}

		if ( in_array( $settings['navigation'], [ 'dots', 'both' ] ) ) {
			$carousel_classes[] = 'slick-dots-' . $settings['dots_position'];
		}

		$this->add_render_attribute( 'carousel', ['class' => $carousel_classes] );

		if ( $settings['carousel'] == "yes" ) {
			$this->add_render_attribute( 'carousel', ['data-slider_options' => wp_json_encode( $carousel_options )] );
		}

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
		<div <?php echo $this->get_render_attribute_string( 'carousel' ); ?>>
		<?php 

		foreach ( $settings['images'] as $image ) {

			if ( empty( $image['image']['url'] ) ) {
				continue;
			}

			if ( isset($settings['image_size']) ) {
				$image['image_size'] = $settings['image_size'];
			}

			if ( isset($settings['image_custom_dimension']) ) {
				$image['image_custom_dimension'] = $settings['image_custom_dimension'];
			}

			$has_caption = ! empty( $image['caption'] );

			if ( ! empty( $settings['hover_animation'] ) ) {
				$this->add_render_attribute( 'wrapper', 'class', 'elementor-animation-'.$settings['hover_animation'] );
			}

			$link = $this->get_link_url( $image );
			?>

			<div class="kn-image-gallery-item <?php if ( ! empty( $settings['hover_animation'] ) ) echo 'elementor-animation-'.$settings['hover_animation']; ?>">

				<?php if ( $link ) : ?>
					<a href="<?php echo $link['url']; ?>" <?php if ( ! empty( $link['is_external'] ) ) echo 'target="_blank"'; ?>>
				<?php endif; ?>

				<div class="kn-image-gallery-image">
						<?php echo Group_Control_Image_Size::get_attachment_image_html( $image ); ?>
				</div>

				<?php if ( $has_caption ) : ?>
					<div class="kn-image-gallery-caption-box">
						<div class="kn-image-gallery-caption-inner">
							<div class="kn-image-gallery-caption-text">
								<?php if ( $image['caption'] ) : ?>
									<div class="kn-image-gallery-caption">
										<?php echo $image['caption']; ?>
									</div>
								<?php endif; ?>
								<?php if ( $image['sub_caption'] ) : ?>
									<div class="kn-image-gallery-subcaption">
										<?php echo $image['sub_caption']; ?>
									</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				<?php endif; ?>

				<?php if ( $link ) : ?>
					</a>
				<?php endif; ?>

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

	private function get_link_url( $instance ) {
		if ( 'none' === $instance['link_to'] ) {
			return false;
		}

		if ( 'custom' === $instance['link_to'] ) {
			if ( empty( $instance['link']['url'] ) ) {
				return false;
			}
			return $instance['link'];
		}

		return [
			'url' => $instance['image']['url'],
		];
	}
}
