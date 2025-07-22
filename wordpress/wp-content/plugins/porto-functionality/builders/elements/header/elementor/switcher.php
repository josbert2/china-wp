<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Porto Header Builder Language/Currency Switcher widget
 *
 * @since 6.0
 */

use Elementor\Controls_Manager;

class Porto_Elementor_HB_Switcher_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'porto_hb_switcher';
	}

	public function get_title() {
		return __( 'Porto Switcher', 'porto-functionality' );
	}

	public function get_categories() {
		return array( 'porto-hb' );
	}

	public function get_keywords() {
		return array( 'language', 'switcher', 'currency' );
	}

	public function get_icon() {
		return 'porto-icon-us-dollar porto-elementor-widget-icon';
	}

	public function get_custom_help_url() {
		return 'https://www.portotheme.com/wordpress/porto/documentation/porto-view-switcher-element/';
	}

	public function has_widget_inner_wrapper(): bool {
		return ! Elementor\Plugin::$instance->experiments->is_feature_active( 'e_optimized_markup' );
	}
	
	protected function register_controls() {

		$this->start_controls_section(
			'section_hb_switcher',
			array(
				'label' => __( 'Switcher', 'porto-functionality' ),
			)
		);

			$this->add_control(
				'description_switcher',
				array(
					'type'            => Controls_Manager::RAW_HTML,
					'raw'             => sprintf( esc_html__( 'Please see %1$sTheme Options -> Header -> Language, Currency Switcher%2$s.', 'porto-functionality' ), '<a target="_blank" href="' . porto_get_theme_option_url( 'wpml-switcher' ) . '"><b>', '</b></a>' ),
					'content_classes' => 'elementor-panel-alert elementor-panel-alert-info',
				)
			);

			$this->add_control(
				'type',
				array(
					'type'    => Controls_Manager::SELECT,
					'label'   => __( 'Type', 'porto-functionality' ),
					'options' => array(
						'language-switcher' => __( 'Language Switcher', 'porto-functionality' ),
						'currency-switcher' => __( 'Currency Switcher', 'porto-functionality' ),
					),
				)
			);

			$this->add_group_control(
				Elementor\Group_Control_Typography::get_type(),
				array(
					'name'     => 'switcher_font',
					'label'    => __( 'Top Level Typography', 'porto-functionality' ),
					'selector' => '#header .elementor-element-{{ID}} .porto-view-switcher > li.menu-item > a',
				)
			);

			$this->add_control(
				'top_color',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Top Level Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .porto-view-switcher > li.menu-item > a' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'top_hover_color',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Top Level Hover Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .porto-view-switcher > li.menu-item:hover > a' => 'color: {{VALUE}};',
					),
					'separator' => 'after',
				)
			);

			$this->add_control(
				'top_bg_color',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Top Level Bg Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .porto-view-switcher > li.menu-item > a' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'top_hover_bg_color',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Top Level Hover BG Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .porto-view-switcher > li.menu-item:hover > a' => 'background-color: {{VALUE}};',
					),
					'separator' => 'after',
				)
			);	

			$this->add_group_control(
				Elementor\Group_Control_Typography::get_type(),
				array(
					'name'     => 'dropdown_font',
					'label'    => __( 'Dropdown Label Font', 'porto-functionality' ),
					'selector' => '#header .elementor-element-{{ID}} .narrow li.menu-item>a',
				)
			);

		$this->end_controls_section();
	
		$this->start_controls_section(
			'section_hb_dropdown',
			array(
				'label' => __( 'Menu Dropdown', 'porto-functionality' ),
			)
		);

			$this->add_control(
				'dropdown_item_padding',
				array(
					'label'       => esc_html__( 'Dropdown Label Padding', 'porto-functionality' ),
					'description' => esc_html__( 'Controls the padding of dropdown label.', 'porto-functionality' ),
					'type'        => Controls_Manager::DIMENSIONS,
					'size_units'  => array(
						'px',
						'em',
					),
					'selectors'   => array(
						'#header .elementor-element-{{ID}} .narrow li.menu-item>a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_control(
				'dropdown_padding',
				array(
					'label'       => esc_html__( 'Dropdown Padding', 'porto-functionality' ),
					'description' => esc_html__( 'Controls the padding of dropdown.', 'porto-functionality' ),
					'type'        => Controls_Manager::DIMENSIONS,
					'size_units'  => array(
						'px',
						'em',
					),
					'selectors'   => array(
						'#header .elementor-element-{{ID}} .narrow ul.sub-menu' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					),
				)
			);

			$this->add_control(
				'dropdown_color',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Dropdown Label Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .narrow li.menu-item > a' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'dropdown_hover_color',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Dropdown Label Hover Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .narrow li.menu-item:hover > a' => 'color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'dropdown_menu_bg',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Dropdown Menu Background Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .narrow ul.sub-menu' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'dropdown_bg',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Dropdown Label Background Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .narrow li.menu-item > a' => 'background-color: {{VALUE}};',
					),
				)
			);

			$this->add_control(
				'dropdown_hover_bg',
				array(
					'type'      => Controls_Manager::COLOR,
					'label'     => __( 'Dropdown Label Hover Background Color', 'porto-functionality' ),
					'selectors' => array(
						'#header .elementor-element-{{ID}} .narrow li.menu-item:hover > a, #header .elementor-element-{{ID}} .narrow li.menu-item > a.active' => 'background-color: {{VALUE}};',
					),
				)
			);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		if ( empty( $settings['type'] ) ) {
			echo sprintf( esc_html__( 'Select the %1$sSwitcher Type%2$s', 'porto' ), '<b class="ps-1">', '</b>' );
			return;
		}
		if ( function_exists( 'porto_header_elements' ) && ! empty( $settings['type'] ) ) {
			porto_header_elements( array( (object) array( $settings['type'] => '' ) ) );
		}
	}
}
