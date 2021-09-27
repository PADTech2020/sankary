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

class KN_Contact_Form extends Widget_Base {

	public function get_name() {
		return 'kn_contact_form';
	}

	public function get_title() {
		return __( 'TS - Contact Form', 'tisara-wp-addons' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal';
	}

	public function get_categories() {
		return [ 'tisara' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_form',
			[
				'label' => __( 'Contact Form', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'form_labels',
				[
					'label' 		=> __( 'Form Labels', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> __( 'Show', 'tisara-wp-addons' ),
					'label_off' 	=> __( 'Hide', 'tisara-wp-addons' ),
					'return_value' 	=> 'yes',
					'default' 		=> 'yes',
					'separator' 	=> 'none',
				]
			);

			$this->add_control(
				'form_placeholders',
				[
					'label' 		=> __( 'Form Placeholders', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::SWITCHER,
					'label_on' 		=> __( 'Show', 'tisara-wp-addons' ),
					'label_off' 	=> __( 'Hide', 'tisara-wp-addons' ),
					'return_value' 	=> 'yes',
					'separator' 	=> 'none',
				]
			);

			$this->add_control(
				'show_email_phone',
				[
					'label'       => __( 'Show Email & Phone', 'tisara-wp-addons' ),
					'type'        => Controls_Manager::SELECT,
					'label_block' => true,
					'default'     => 'email',
					'options'     => [
						'email_phone' => __( 'Email & Phone', 'tisara-wp-addons' ),
						'phone_email' => __( 'Phone & Email', 'tisara-wp-addons' ),
						'email'       => __( 'Email', 'tisara-wp-addons' ),
						'phone'       => __( 'Phone', 'tisara-wp-addons' ),
						'none'        => __( 'None', 'tisara-wp-addons' ),
					],
				]
			);

			$this->add_control(
				'inline_name_email',
				[
					'label'        => __( 'Inline Name & Email field', 'tisara-wp-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __( 'Yes', 'tisara-wp-addons' ),
					'label_off'    => __( 'No', 'tisara-wp-addons' ),
					'return_value' => 'yes',
					'condition'    => [
						'show_email_phone' => 'email',
					],
				]
			);

			$this->add_control(
				'inline_name_phone',
				[
					'label'        => __( 'Inline Name & Phone field', 'tisara-wp-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __( 'Yes', 'tisara-wp-addons' ),
					'label_off'    => __( 'No', 'tisara-wp-addons' ),
					'return_value' => 'yes',
					'condition'    => [
						'show_email_phone' => 'phone',
					],
				]
			);

			$this->add_control(
				'inline_email_phone',
				[
					'label'        => __( 'Inline Email & Phone field', 'tisara-wp-addons' ),
					'type'         => Controls_Manager::SWITCHER,
					'default'      => 'yes',
					'label_on'     => __( 'Yes', 'tisara-wp-addons' ),
					'label_off'    => __( 'No', 'tisara-wp-addons' ),
					'return_value' => 'yes',
					'condition'    => [
						'show_email_phone' => ['email_phone','phone_email'],
					],
				]
			);

			$this->add_control(
				'form_email_to',
				[
					'label' 		=> __( 'Email To', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> get_option( 'admin_email' ),
					'label_block' 	=> true,
					'separator' 	=> 'before',
				]
			);

			$this->add_control(
				'form_email_subject',
				[
					'label' 		=> __( 'Email Subject', 'tisara-wp-addons' ),
					'description' 	=> __( 'You can use %site%, %name%, %email%, %phone% to personalize email subject.', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> __( '[%site%] New message from %name% %email% %phone%', 'tisara-wp-addons' ),
					'label_block' 	=> true,
					'separator' 	=> 'none',
				]
			);

			$this->add_control(
				'form_email_success',
				[
					'label' 		=> __( 'Success Message', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> __( 'Your message was successfully sent.', 'tisara-wp-addons' ),
					'label_block' 	=> true,
					'separator' 	=> 'before',
				]
			);

			$this->add_control(
				'form_email_invalid',
				[
					'label' 		=> __( 'Validation Error Message', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> __( 'There were one or more errors while submitting the form.', 'tisara-wp-addons' ),
					'label_block' 	=> true,
					'separator' 	=> 'none',
				]
			);

			$this->add_control(
				'form_email_error',
				[
					'label' 		=> __( 'Technical Error Message (NOT SENT)', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'placeholder' 	=> __( 'There were technical error while submitting the form. Sorry for the inconvenience.', 'tisara-wp-addons' ),
					'label_block' 	=> true,
					'separator' 	=> 'none',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_name',
			[
				'label' => __( 'Name Field', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'field_name_label',
				[
					'label' 		=> __( 'Label', 'tisara-wp-addons' ),
					'type'			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Name', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Name', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_name_placeholder',
				[
					'label' 		=> __( 'Placeholder', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Name', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Name', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_name_invalid',
				[
					'label' 		=> __( 'Invalid Message', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Please enter your name', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Please enter your name', 'tisara-wp-addons' ),
					'label_block' 	=> true,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_email',
			[
				'label'     => __( 'Email Field', 'tisara-wp-addons' ),
				'condition' => [
					'show_email_phone' => ['email_phone','phone_email','email'],
				],
			]
		);

			$this->add_control(
				'field_email_label',
				[
					'label' 		=> __( 'Label', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Email', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Email', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_email_placeholder',
				[
					'label' 		=> __( 'Placeholder', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Email', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Email', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_email_invalid',
				[
					'label' 		=> __( 'Invalid Message', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Please enter your valid email address', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Please enter your valid email address', 'tisara-wp-addons' ),
					'label_block' 	=> true,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_phone',
			[
				'label'     => __( 'Phone Field', 'tisara-wp-addons' ),
				'condition' => [
					'show_email_phone' => ['email_phone','phone_email','phone'],
				],
			]
		);

			$this->add_control(
				'field_phone_label',
				[
					'label' 		=> __( 'Label', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Phone', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Email', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_phone_placeholder',
				[
					'label' 		=> __( 'Placeholder', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Phone', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Phone', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_phone_invalid',
				[
					'label' 		=> __( 'Invalid Phone Number', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Please enter your valid phone number', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Please enter your valid phone number', 'tisara-wp-addons' ),
					'label_block' 	=> true,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_message',
			[
				'label' => __( 'Message Field', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'field_message_label',
				[
					'label' 		=> __( 'Label', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Message', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Message', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_message_placeholder',
				[
					'label' 		=> __( 'Placeholder', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Message', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Message', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_message_invalid',
				[
					'label' 		=> __( 'Invalid Message', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::TEXT,
					'default' 		=> __( 'Please enter your message', 'tisara-wp-addons' ),
					'placeholder' 	=> __( 'Please enter your message', 'tisara-wp-addons' ),
					'label_block' 	=> true,
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_field_submit',
			[
				'label' => __( 'Submit Button', 'tisara-wp-addons' ),
			]
		);

			$this->add_control(
				'field_submit_text',
				[
					'label'       => __( 'Text', 'tisara-wp-addons' ),
					'type'        => Controls_Manager::TEXT,
					'default'     => __( 'Submit', 'tisara-wp-addons' ),
					'placeholder' => __( 'Submit', 'tisara-wp-addons' ),
				]
			);

			$this->add_control(
				'field_submit_align',
				[
					'label' 	=> __( 'Alignment', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::CHOOSE,
					'default' 	=> 'left',
					'options' 	=> [
						'left' 		=> [
							'title' => __( 'Left', 'tisara-wp-addons' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' 	=> [
							'title' => __( 'Center', 'tisara-wp-addons' ),
							'icon'  => 'fa fa-align-center',
						],
						'justify' 	=> [
							'title' => __( 'Justified', 'tisara-wp-addons' ),
							'icon'  => 'fa fa-align-justify',
						],
						'right' 	=> [
							'title' => __( 'Right', 'tisara-wp-addons' ),
							'icon'  => 'fa fa-align-right',
						],
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_form_style',
			[
				'label' => __( 'Contact Form', 'tisara-wp-addons' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'container_width',
			[
				'label'      => __( 'Container Max Width (px)', 'tisara-wp-addons' ),
				'type'       => Controls_Manager::SLIDER,
				'default'    => [
					'unit' => 'px',
				],
				'range'      => [
					'px' => [
						'min' => 300,
						'max' => 2000,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .elementor-kn-form-wrapper' => 'max-width: {{SIZE}}{{UNIT}};margin:0 auto;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_label_style',
			[
				'label' => __( 'Form Label (If Available)', 'tisara-wp-addons' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'label_text_color',
				[
					'label' 	=> __( 'Text Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .elementor-kn-form-wrapper label' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'label_typography',
					'label'    => __( 'Typography', 'tisara-wp-addons' ),
					'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .elementor-kn-form-wrapper label',
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_input_style',
			[
				'label' => __( 'Form Input / Textarea', 'tisara-wp-addons' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'input_text_color',
				[
					'label' 	=> __( 'Text Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors'	=> [
						'{{WRAPPER}} .elementor-kn-form-wrapper input[type="text"], {{WRAPPER}} .elementor-kn-form-wrapper input[type="email"], {{WRAPPER}} .elementor-kn-form-wrapper textarea' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name' 		=> 'input_typography',
					'label' 	=> __( 'Typography', 'tisara-wp-addons' ),
					'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
					'selector' 	=> '{{WRAPPER}} .elementor-kn-form-wrapper input[type="text"], {{WRAPPER}} .elementor-kn-form-wrapper input[type="email"], {{WRAPPER}} .elementor-kn-form-wrapper textarea',
				]
			);

			$this->add_control(
				'input_background_color',
				[
					'label' 	=> __( 'Background Color', 'tisara-wp-addons' ),
					'type' 		=> Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .elementor-kn-form-wrapper input[type="text"], {{WRAPPER}} .elementor-kn-form-wrapper input[type="email"], {{WRAPPER}} .elementor-kn-form-wrapper textarea' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name' 			=> 'input_border',
					'label' 		=> __( 'Border', 'tisara-wp-addons' ),
					'placeholder' 	=> '1px',
					'default' 		=> '1px',
					'selector' 		=> '{{WRAPPER}} .elementor-kn-form-wrapper input[type="text"], {{WRAPPER}} .elementor-kn-form-wrapper input[type="email"], {{WRAPPER}} .elementor-kn-form-wrapper textarea',
				]
			);

			$this->add_control(
				'input_border_radius',
				[
					'label' 		=> __( 'Border Radius', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-kn-form-wrapper input[type="text"], {{WRAPPER}} .elementor-kn-form-wrapper input[type="email"], {{WRAPPER}} .elementor-kn-form-wrapper textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'input_text_padding',
				[
					'label' 		=> __( 'Text Padding', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-kn-form-wrapper input[type="text"], {{WRAPPER}} .elementor-kn-form-wrapper input[type="email"], {{WRAPPER}} .elementor-kn-form-wrapper textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
				'input_text_margin',
				[
					'label' 		=> __( 'Field Margin', 'tisara-wp-addons' ),
					'type' 			=> Controls_Manager::DIMENSIONS,
					'size_units' 	=> [ 'px', 'em', '%' ],
					'selectors' 	=> [
						'{{WRAPPER}} .elementor-kn-form-wrapper input[type="text"], {{WRAPPER}} .elementor-kn-form-wrapper input[type="email"], {{WRAPPER}} .elementor-kn-form-wrapper textarea' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_button_style',
			[
				'label' => __( 'Form Button', 'tisara-wp-addons' ),
				'tab' 	=> Controls_Manager::TAB_STYLE,
			]
		);

			$this->start_controls_tabs( 'tabs_button_style' );

				$this->start_controls_tab(
					'tab_button_normal',
					[
						'label' => __( 'Normal', 'tisara-wp-addons' ),
					]
				);

				$this->add_control(
					'button_text_color',
					[
						'label' 	=> __( 'Text Color', 'tisara-wp-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"], {{WRAPPER}} .elementor-kn-form-wrapper button' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Typography::get_type(),
					[
						'name' 		=> 'typography',
						'label' 	=> __( 'Typography', 'tisara-wp-addons' ),
						'scheme' 	=> Scheme_Typography::TYPOGRAPHY_4,
						'selector' 	=> '{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"], {{WRAPPER}} .elementor-kn-form-wrapper button',
					]
				);

				$this->add_control(
					'background_color',
					[
						'label' 	=> __( 'Background Color', 'tisara-wp-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'scheme' 	=> [
							'type' 	=> Scheme_Color::get_type(),
							'value' => Scheme_Color::COLOR_4,
						],
						'selectors' => [
							'{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"], {{WRAPPER}} .elementor-kn-form-wrapper button' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_group_control(
					Group_Control_Border::get_type(),
					[
						'name' 			=> 'border',
						'label' 		=> __( 'Border', 'tisara-wp-addons' ),
						'placeholder' 	=> '1px',
						'default' 		=> '1px',
						'selector' 		=> '{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"], {{WRAPPER}} .elementor-kn-form-wrapper button',
					]
				);

				$this->add_control(
					'border_radius',
					[
						'label' 		=> __( 'Border Radius', 'tisara-wp-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"], {{WRAPPER}} .elementor-kn-form-wrapper button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->add_control(
					'text_padding',
					[
						'label' 		=> __( 'Text Padding', 'tisara-wp-addons' ),
						'type' 			=> Controls_Manager::DIMENSIONS,
						'size_units' 	=> [ 'px', 'em', '%' ],
						'selectors' 	=> [
							'{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"], {{WRAPPER}} .elementor-kn-form-wrapper button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
						],
					]
				);

				$this->end_controls_tab();

				$this->start_controls_tab(
					'tab_button_hover',
					[
						'label' => __( 'Hover', 'tisara-wp-addons' ),
					]
				);

				$this->add_control(
					'hover_color',
					[
						'label' 	=> __( 'Text Color', 'tisara-wp-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"]:hover, {{WRAPPER}} .elementor-kn-form-wrapper button:hover' => 'color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'button_background_hover_color',
					[
						'label' 	=> __( 'Background Color', 'tisara-wp-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"]:hover, {{WRAPPER}} .elementor-kn-form-wrapper button:hover' => 'background-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'button_hover_border_color',
					[
						'label' 	=> __( 'Border Color', 'tisara-wp-addons' ),
						'type' 		=> Controls_Manager::COLOR,
						'selectors' => [
							'{{WRAPPER}} .elementor-kn-form-wrapper input[type="submit"]:hover, {{WRAPPER}} .elementor-kn-form-wrapper button:hover' => 'border-color: {{VALUE}};',
						],
					]
				);

				$this->add_control(
					'hover_animation',
					[
						'label' => __( 'Animation', 'tisara-wp-addons' ),
						'type' 	=> Controls_Manager::HOVER_ANIMATION,
					]
				);

				$this->end_controls_tab();

			$this->end_controls_tabs();

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings();

		$form_email_success = __( 'Your message was successfully sent.', 'tisara-wp-addons' );
		if ( trim( $settings['form_email_success'] ) ) {
			$form_email_success = $settings['form_email_success'];
		}

		$form_email_error = __( 'There were technical error while submitting the form. Sorry for the inconvenience.', 'tisara-wp-addons' );
		if ( trim( $settings['form_email_error'] ) ) {
			$form_email_error = $settings['form_email_error'];
		}

		$form_email_invalid = __( 'There were one or more errors while submitting the form.', 'tisara-wp-addons' );
		if ( trim( $settings['form_email_invalid'] ) ) {
			$form_email_invalid = $settings['form_email_invalid'];
		}

		$labels_class = ! $settings['form_labels'] ? 'elementor-screen-only' : '';

		$show_email = in_array( $settings['show_email_phone'], [ 'email_phone', 'phone_email', 'email' ] ) ? true : false;
		$show_phone = in_array( $settings['show_email_phone'], [ 'email_phone', 'phone_email', 'phone' ] ) ? true : false;

		$field_name_label 			= $settings['field_name_label'];
		$field_name_placeholder 	= $settings['form_placeholders'] ? $settings['field_name_placeholder'] : '';
		$field_name_invalid 		= $settings['field_name_invalid'] ? $settings['field_name_invalid'] : __( 'Please enter your name', 'tisara-wp-addons' );
		$field_name_invalid_status 	= false;
		$field_name_value 			= '';

		if ( $show_email ) {
			$field_email_label 			= $settings['field_email_label'];
			$field_email_placeholder 	= $settings['form_placeholders'] ? $settings['field_email_placeholder'] : '';
			$field_email_invalid 		= $settings['field_email_invalid'] ? $settings['field_email_invalid'] : __( 'Please enter your valid email address', 'tisara-wp-addons' );
			$field_email_invalid_status = false;
			$field_email_value 			= '';
		}

		if ( $show_phone ) {
			$field_phone_label 			= $settings['field_phone_label'];
			$field_phone_placeholder 	= $settings['form_placeholders'] ? $settings['field_phone_placeholder'] : '';
			$field_phone_invalid 		= $settings['field_phone_invalid'] ? $settings['field_phone_invalid'] : __( 'Please enter your valid phone number', 'tisara-wp-addons' );
			$field_phone_invalid_status = false;
			$field_phone_value 			= '';
		}

		$field_message_label 			= $settings['field_message_label'];
		$field_message_placeholder 		= $settings['form_placeholders'] ? $settings['field_message_placeholder'] : '';
		$field_message_invalid 			= $settings['field_message_invalid'] ? $settings['field_message_invalid'] : __( 'Please enter your message', 'tisara-wp-addons' );
		$field_message_invalid_status 	= false;
		$field_message_value 			= '';

		$field_important_value 		= '';

		$field_submit_text = $settings['field_submit_text'];
		if ( !$field_submit_text ) {
			$field_submit_text = __( 'Submit', 'tisara-wp-addons' );
		}

		$form_invalid 	= false;
		$form_success 	= false;
		$form_error 	= false;
		if ( isset( $_POST['kn-form-id'] ) && $_POST['kn-form-id'] === $this->get_id() ) {
			// var_dump( $_POST );

			$form_email_from 		= 'noreply@'.str_ireplace( 'www.', '', parse_url( home_url('/'), PHP_URL_HOST ) );
			$form_email_from_name 	= get_option( 'blogname' );

			$field_name_value = isset( $_POST['kn-form-name'] ) ? esc_html( $_POST['kn-form-name'] ) : '';
			if ( !$field_name_value ) {
				$field_name_invalid_status = true;
				$form_invalid = true;
			}

			$field_email_value = '';
			if ( $show_email ) {
				$field_email_value = isset( $_POST['kn-form-email'] ) ? esc_html( $_POST['kn-form-email'] ) : '';
				if ( !$field_email_value ) {
					$field_email_invalid_status = true;
					$form_invalid = true;
				}
				else {
					if ( function_exists('is_email') && ! is_email( $field_email_value ) ) {
						$field_email_invalid_status = true;
						$form_invalid = true;
					}
				}
			}

			$field_phone_value = '';
			if ( $show_phone ) {
				$field_phone_value = isset( $_POST['kn-form-phone'] ) ? esc_html( $_POST['kn-form-phone'] ) : '';
				if ( !$field_phone_value ) {
					$field_phone_invalid_status = true;
					$form_invalid = true;
				}
				else {
					if ( strlen( $field_phone_value ) < 6 ) {
						$field_email_invalid_status = true;
						$form_invalid = true;
					}
				}
			}

			$field_message_value = isset( $_POST['kn-form-message'] ) ? esc_html( $_POST['kn-form-message'] ) : '';
			if ( !$field_message_value ) {
				$field_message_invalid_status = true;
				$form_invalid = true;
			}

			$field_important_value = isset( $_POST['kn-form-important'] ) ? esc_html( $_POST['kn-form-important'] ) : '';
			if ( $field_important_value ) {
				$form_invalid = true;
			}

			if ( !$form_invalid ) {

				$form_email_to = get_option( 'admin_email' );
				if ( trim( $settings['form_email_to'] ) ) {
					$form_email_to = $settings['form_email_to'];
				}

				$form_email_subject = __( '[%site%] New message from %name% %email% %phone%', 'tisara-wp-addons' );
				if ( trim( $settings['form_email_subject'] ) ) {
					$form_email_subject = $settings['form_email_subject'];
				}
				$form_email_subject = str_replace( '%site%', get_option( 'blogname' ), $form_email_subject );
				$form_email_subject = str_replace( '%name%', $field_name_value, $form_email_subject );
				$form_email_subject = str_replace( '%email%', $field_email_value, $form_email_subject );
				$form_email_subject = str_replace( '%phone%', $field_phone_value, $form_email_subject );

				$ipaddress = '';
				if ( isset($_SERVER['HTTP_CLIENT_IP']) && $_SERVER['HTTP_CLIENT_IP'] )
					$ipaddress = $_SERVER['HTTP_CLIENT_IP'];
				else if( isset($_SERVER['HTTP_X_FORWARDED_FOR']) && $_SERVER['HTTP_X_FORWARDED_FOR'] )
					$ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
				else if( isset($_SERVER['HTTP_X_FORWARDED']) && $_SERVER['HTTP_X_FORWARDED'] )
					$ipaddress = $_SERVER['HTTP_X_FORWARDED'];
				else if( isset($_SERVER['HTTP_FORWARDED_FOR']) && $_SERVER['HTTP_FORWARDED_FOR'] )
					$ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
				else if( isset($_SERVER['HTTP_FORWARDED']) && $_SERVER['HTTP_FORWARDED'] )
					$ipaddress = $_SERVER['HTTP_FORWARDED'];
				else if( isset($_SERVER['REMOTE_ADDR']) && $_SERVER['REMOTE_ADDR'] )
					$ipaddress = $_SERVER['REMOTE_ADDR'];
				else
					$ipaddress = 'UNKNOWN';
				$useragent = $_SERVER['HTTP_USER_AGENT'];

				$message_headers = array();
				$message_headers[] = 'From: '.$form_email_from_name.' <' . $form_email_from . '>';
				// $message_headers[] = 'Reply-To: '.$field_email_value;

				$message_body = '';
				$message_body .= $field_name_label . " \r\n". $field_name_value . "\r\n\r\n" ;
				if ( $show_email ) {
					$message_body .= $field_email_label . " \r\n". $field_email_value . "\r\n\r\n";
				}
				if ( $show_phone ) {
					$message_body .= $field_phone_label . " \r\n". $field_phone_value . "\r\n\r\n";
				}
				$message_body .= $field_message_label . " \r\n". $field_message_value . "\r\n\r\n";
				$message_body .= __( 'IP Address:', 'tisara-wp-addons' ) . " ". $ipaddress . "\r\n";
				$message_body .= __( 'User Agent:', 'tisara-wp-addons' ) . " ". $useragent . "\r\n";
				if ( isset( $_POST['kn-form-post-id'] ) && $post_id = esc_html( $_POST['kn-form-post-id'] ) ) {
					$message_body .= __( 'Page:', 'tisara-wp-addons' ) . " ". get_permalink($post_id) . "\r\n";
				}

				$message_sent = wp_mail( $form_email_to, $form_email_subject, $message_body, $message_headers );

				$cfdb_posted_data = array();
				$cfdb_posted_data[ $field_name_label ] = $field_name_value;
				if ( $show_email ) {
					$cfdb_posted_data[ $field_email_label ] = $field_email_value;
				}
				if ( $show_phone ) {
					$cfdb_posted_data[ $field_phone_label ] = $field_phone_value;
				}
				$cfdb_posted_data[ $field_message_label ] = $field_message_value;
				$cfdb_posted_data[ __( 'IP Address:', 'tisara-wp-addons' ) ] = $ipaddress;
				$cfdb_posted_data[ __( 'User Agent:', 'tisara-wp-addons' ) ] = $useragent;
				$cfdb_uploaded_files = array();
				$cfdb_data = (object) array(
					'title' => 'Contact Form',
					'posted_data' => $cfdb_posted_data,
					'uploaded_files' => $cfdb_uploaded_files,
				);

				// Call hook to submit data
				do_action_ref_array('cfdb_submit', array(&$cfdb_data));

				if( $message_sent == true ) {
					$form_success = true;
					$field_name_value = '';
					$field_email_value = '';
					$field_phone_value = '';
					$field_message_value = '';
					$field_important_value = '';
				}
				else {
					$form_error = true;
				}
			}
		}

		$this->add_render_attribute( 'wrapper', 'class', 'elementor-kn-form-wrapper' );
		// if ( ! empty( $settings['form_display'] ) ) {
		// 	$this->add_render_attribute( 'wrapper', 'class', 'elementor-kn-form-display-inline' );
		// }
		if ( ! empty( $settings['field_submit_align'] ) ) {
			$this->add_render_attribute( 'wrapper', 'class', 'elementor-kn-form-button-align-' . $settings['field_submit_align'] );
		}

		$this->add_render_attribute( 'field_name_label', 'for', 'kn-form-name-'.$this->get_id() );
		$this->add_render_attribute( 'field_name_label', 'class', $labels_class );
		$this->add_render_attribute( 'field_name', 'type', 'text' );
		$this->add_render_attribute( 'field_name', 'name', 'kn-form-name' );
		$this->add_render_attribute( 'field_name', 'id', 'kn-form-name-'.$this->get_id() );
		$this->add_render_attribute( 'field_name', 'placeholder', $field_name_placeholder );
		$this->add_render_attribute( 'field_name', 'required', '1' );
		$this->add_render_attribute( 'field_name', 'value', $field_name_value );
		$this->add_render_attribute( 'field_name_wrapper', 'class', 'kn-form-field-name' );
		if ( $settings['inline_name_email'] == 'yes' && in_array( $settings['show_email_phone'], ['email'] ) ) {
			$this->add_render_attribute( 'field_name_wrapper', 'class', 'kn-form-field-left' );
		}
		if ( $settings['inline_name_phone'] == 'yes' && in_array( $settings['show_email_phone'], ['phone'] ) ) {
			$this->add_render_attribute( 'field_name_wrapper', 'class', 'kn-form-field-left' );
		}

		if ( $show_email ) {
			$this->add_render_attribute( 'field_email_label', 'for', 'kn-form-email-'.$this->get_id() );
			$this->add_render_attribute( 'field_email_label', 'class', $labels_class );
			$this->add_render_attribute( 'field_email', 'type', 'email' );
			$this->add_render_attribute( 'field_email', 'name', 'kn-form-email' );
			$this->add_render_attribute( 'field_email', 'id', 'kn-form-email-'.$this->get_id() );
			$this->add_render_attribute( 'field_email', 'placeholder', $field_email_placeholder );
			$this->add_render_attribute( 'field_email', 'required', '1' );
			$this->add_render_attribute( 'field_email', 'value', $field_email_value );
			$this->add_render_attribute( 'field_email_wrapper', 'class', 'kn-form-field-email' );
			if ( $settings['inline_name_email'] == 'yes' && in_array( $settings['show_email_phone'], ['email'] ) ) {
				$this->add_render_attribute( 'field_email_wrapper', 'class', 'kn-form-field-right' );
			}
			if ( $settings['inline_email_phone'] == 'yes' && in_array( $settings['show_email_phone'], ['email_phone'] ) ) {
				$this->add_render_attribute( 'field_email_wrapper', 'class', 'kn-form-field-left' );
			}
			if ( $settings['inline_email_phone'] == 'yes' && in_array( $settings['show_email_phone'], ['phone_email'] ) ) {
				$this->add_render_attribute( 'field_email_wrapper', 'class', 'kn-form-field-right' );
			}
		}

		if ( $show_phone ) {
			$this->add_render_attribute( 'field_phone_label', 'for', 'kn-form-phone-'.$this->get_id() );
			$this->add_render_attribute( 'field_phone_label', 'class', $labels_class );
			$this->add_render_attribute( 'field_phone', 'type', 'text' );
			$this->add_render_attribute( 'field_phone', 'name', 'kn-form-phone' );
			$this->add_render_attribute( 'field_phone', 'id', 'kn-form-phone-'.$this->get_id() );
			$this->add_render_attribute( 'field_phone', 'placeholder', $field_phone_placeholder );
			$this->add_render_attribute( 'field_phone', 'required', '1' );
			$this->add_render_attribute( 'field_phone', 'value', $field_phone_value );
			$this->add_render_attribute( 'field_phone_wrapper', 'class', 'kn-form-field-phone' );
			if ( $settings['inline_name_phone'] == 'yes' && in_array( $settings['show_email_phone'], ['phone'] ) ) {
				$this->add_render_attribute( 'field_phone_wrapper', 'class', 'kn-form-field-right' );
			}
			if ( $settings['inline_email_phone'] == 'yes' && in_array( $settings['show_email_phone'], ['email_phone'] ) ) {
				$this->add_render_attribute( 'field_phone_wrapper', 'class', 'kn-form-field-right' );
			}
			if ( $settings['inline_email_phone'] == 'yes' && in_array( $settings['show_email_phone'], ['phone_email'] ) ) {
				$this->add_render_attribute( 'field_phone_wrapper', 'class', 'kn-form-field-left' );
			}
		}

		$this->add_render_attribute( 'field_message_label', 'for', 'kn-form-message-'.$this->get_id() );
		$this->add_render_attribute( 'field_message_label', 'class', $labels_class );
		$this->add_render_attribute( 'field_message', 'rows', '4' );
		$this->add_render_attribute( 'field_message', 'name', 'kn-form-message' );
		$this->add_render_attribute( 'field_message', 'id', 'kn-form-message-'.$this->get_id() );
		$this->add_render_attribute( 'field_message', 'placeholder', $field_message_placeholder );
		$this->add_render_attribute( 'field_message', 'required', '1' );
		$this->add_render_attribute( 'field_message_wrapper', 'class', 'kn-form-field-message' );

		$this->add_render_attribute( 'field_submit', 'class', 'kn-form-button' );
		$this->add_render_attribute( 'field_submit', 'type', 'submit' );
		$this->add_render_attribute( 'field_submit_wrapper', 'class', 'kn-form-field-submit' );

		?>
		<div <?php echo $this->get_render_attribute_string( 'wrapper' ); ?>>
			<?php if ( $form_success ) : ?>
				<div class="kn-form-alert kn-form-alert-success alert alert-success">
					<?php echo $form_email_success; ?>
				</div>
			<?php endif; ?>
			<?php if ( $form_invalid ) : ?>
				<div class="kn-form-alert kn-form-alert-error alert alert-danger">
					<?php echo $form_email_invalid; ?>
				</div>
			<?php endif; ?>
			<?php if ( $form_error ) : ?>
				<div class="kn-form-alert kn-form-alert-error alert alert-danger">
					<?php echo $form_email_error; ?>
				</div>
			<?php endif; ?>
			<form class="kn-form" method="post">
				<input type="hidden" name="kn-form-id" value="<?php echo $this->get_id() ?>" />
				<input type="hidden" name="kn-form-post-id" value="<?php echo get_the_ID() ?>" />
				<div class="kn-form-fields-wrapper">
					<div <?php echo $this->get_render_attribute_string( 'field_name_wrapper' ); ?>>
						<label <?php echo $this->get_render_attribute_string( 'field_name_label' ); ?>>
							<?php echo $field_name_label; ?>
						</label>
						<input <?php echo $this->get_render_attribute_string( 'field_name' ); ?>>
						<?php if ( $field_name_invalid_status ) : ?>
							<div class="kn-form-error"><?php echo $field_name_invalid; ?></div>
						<?php endif; ?>
					</div>
					<?php if ( in_array( $settings['show_email_phone'], [ 'email_phone', 'email' ] ) ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'field_email_wrapper' ); ?>>
						<label <?php echo $this->get_render_attribute_string( 'field_email_label' ); ?>>
							<?php echo $field_email_label; ?>
						</label>
						<input <?php echo $this->get_render_attribute_string( 'field_email' ); ?>>
						<?php if ( $field_email_invalid_status ) : ?>
							<div class="kn-form-error"><?php echo $field_email_invalid; ?></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ( in_array( $settings['show_email_phone'], [ 'email_phone', 'phone_email', 'phone' ] ) ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'field_phone_wrapper' ); ?>>
						<label <?php echo $this->get_render_attribute_string( 'field_phone_label' ); ?>>
							<?php echo $field_phone_label; ?>
						</label>
						<input <?php echo $this->get_render_attribute_string( 'field_phone' ); ?>>
						<?php if ( $field_phone_invalid_status ) : ?>
							<div class="kn-form-error"><?php echo $field_phone_invalid; ?></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<?php if ( in_array( $settings['show_email_phone'], [ 'phone_email' ] ) ) : ?>
					<div <?php echo $this->get_render_attribute_string( 'field_email_wrapper' ); ?>>
						<label <?php echo $this->get_render_attribute_string( 'field_email_label' ); ?>>
							<?php echo $field_email_label; ?>
						</label>
						<input <?php echo $this->get_render_attribute_string( 'field_email' ); ?>>
						<?php if ( $field_email_invalid_status ) : ?>
							<div class="kn-form-error"><?php echo $field_email_invalid; ?></div>
						<?php endif; ?>
					</div>
					<?php endif; ?>
					<div <?php echo $this->get_render_attribute_string( 'field_message_wrapper' ); ?>>
						<label <?php echo $this->get_render_attribute_string( 'field_message_label' ); ?>>
							<?php echo $field_message_label; ?>
						</label>
						<textarea <?php echo $this->get_render_attribute_string( 'field_message' ); ?>><?php echo $field_message_value; ?></textarea>
						<?php if ( $field_message_invalid_status ) : ?>
							<div class="kn-form-error"><?php echo $field_message_invalid; ?></div>
						<?php endif; ?>
					</div>
					<div class="kn-form-field-important">
						<label for="kn-form-important-<?php echo $this->get_id() ?>" class="<?php echo $labels_class; ?>">Important</label>
						<input type="text" name="kn-form-important" id="kn-form-important-<?php echo $this->get_id() ?>" class="" placeholder="Important">
					</div>
					<div class="kn-form-field-submit">
						<button <?php echo $this->get_render_attribute_string( 'field_submit' ); ?>>
							<?php echo $field_submit_text; ?>
						</button>
					</div>
				</div>
			</form>		
		</div>
		<?php 
	}

	protected function _content_template() {
	}
}
