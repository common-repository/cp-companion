<?php
namespace CpCompanion\Modules\Navbar\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Navbar extends Widget_Base {

	public function get_name() {
		return 'cp-navbar';
	}

	public function get_title() {
		return esc_html__( 'Navbar', 'cp-companion' );
	}

	public function get_icon() {
		return 'cp-ea-icons cp-navbar';
	}

	public function get_categories() {
		return [ 'cp-elements' ];
	}


	protected function _register_controls() {
		
		$this->start_controls_section(
			'section_navbar_content',
			[
				'label' => esc_html__( 'Navbar', 'cp-companion' ),
			]
		);

		$this->add_control(
			'navbar',
			[
				'label'   => esc_html__( 'Select Menu', 'cp-companion' ),
				'type'    => Controls_Manager::SELECT,
				'options' => cp_get_menus(),
				'default' => 0,
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label'   => esc_html__( 'Alignment', 'cp-companion' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'flex-start' => [
						'title' => esc_html__( 'Left', 'cp-companion' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'cp-companion' ),
						'icon'  => 'eicon-h-align-center',
					],
					'flex-end'  => [
						'title' => esc_html__( 'Right', 'cp-companion' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-container > ul' => 'justify-content: {{VALUE}};',
					'{{WRAPPER}} .cp-mobile-nav-wrapper' => 'justify-content: {{VALUE}};',
					
				],
			]
		);

		$this->add_responsive_control(
			'menu_offset',
			[
				'label' => esc_html__( 'Offset', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
					],
				],
				'size_units' => [ 'px' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-nav' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_responsive_control(
			'text_padding',
			[
				'label'      => esc_html__( 'Padding', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_height',
			[
				'label' => esc_html__( 'Menu Height', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 20,
						'max' => 150,
					],
				],
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a' => 'min-height: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'menu_parent_arrow',
			[
				'label'        => __( 'Parent Indicator', 'cp-companion' ),
				'type'         => Controls_Manager::SWITCHER,
				'prefix_class' => 'cp-navbar-parent-indicator-',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_content',
			[
				'label' => esc_html__( 'Dropdown', 'cp-companion' ),
			]
		);

		$this->add_responsive_control(
			'dropdown_align',
			[
				'label'     => esc_html__( 'Dropdown Alignment', 'cp-companion' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'Left', 'cp-companion' ),
						'icon'  => 'eicon-h-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'cp-companion' ),
						'icon'  => 'eicon-h-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'Right', 'cp-companion' ),
						'icon'  => 'eicon-h-align-right',
					],
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_link_align',
			[
				'label'   => esc_html__( 'Item Alignment', 'cp-companion' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => esc_html__( 'Left', 'cp-companion' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'cp-companion' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'cp-companion' ),
						'icon'  => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_padding',
			[
				'label'      => esc_html__( 'Dropdown Padding', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-dropdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_width',
			[
				'label' => esc_html__( 'Dropdown Width', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 150,
						'max' => 350,
					],
				],
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-dropdown' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_additional',
			[
				'label' => esc_html__( 'Additional', 'cp-companion' ),
			]
		);

		$this->add_control(
			'dropdown_delay_show',
			[
				'label' => esc_html__( 'Delay Show', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
			]
		);

		$this->add_control(
			'dropdown_delay_hide',
			[
				'label' => esc_html__( 'Delay Hide', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'default' => ['size' => 800],
			]
		);

		$this->add_control(
			'dropdown_duration',
			[
				'label' => esc_html__( 'Dropdown Duration', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 2000,
					],
				],
				'default' => ['size' => 200],
			]
		);

		$this->add_control(
			'dropdown_offset',
			[
				'label' => esc_html__( 'Dropdown Offset', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 200,
					],
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_menu_style',
			[
				'label' => esc_html__( 'Navbar', 'cp-companion' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->start_controls_tabs( 'menu_link_styles' );

		$this->start_controls_tab( 'menu_link_normal', [ 'label' => esc_html__( 'Normal', 'cp-companion' ) ] );

		$this->add_control(
			'menu_link_color',
			[
				'label'     => esc_html__( 'Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_link_background',
			[
				'label'     => esc_html__( 'Background', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'menu_spacing',
			[
				'label' => esc_html__( 'Gap', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-nav' => 'margin-left: -{{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .cp-navbar-nav > li' => 'margin-left: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'menu_border',
				'label'    => esc_html__( 'Border', 'cp-companion' ),
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a',
			]
		);

		$this->add_control(
			'menu_border_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography_normal',
				'label'    => esc_html__( 'Typography', 'cp-companion' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a',
			]
		);

		$this->add_control(
			'menu_parent_arrow_color',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.cp-navbar-parent-indicator-yes .cp-navbar-nav > li.cp-parent a:after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'menu_link_hover', [ 'label' => esc_html__( 'Hover', 'cp-companion' ) ] );

		$this->add_control(
			'navbar_hover_style_color',
			[
				'label'     => esc_html__( 'Style Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-nav > li:hover > a:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .cp-navbar-nav > li:hover > a:after'  => 'background-color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'menu_link_color_hover',
			[
				'label'     => esc_html__( 'Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_background_hover',
			[
				'label'     => esc_html__( 'Background Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_border_color_hover',
			[
				'label'     => esc_html__( 'Border Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_border_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography_hover',
				'label'    => esc_html__( 'Typography', 'cp-companion' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-navbar-wrapper .cp-navbar-container.cp-navbar ul.cp-navbar-nav li a:hover',
			]
		);

		$this->add_control(
			'menu_parent_arrow_color_hover',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.cp-navbar-parent-indicator-yes .cp-navbar-nav > li.cp-parent a:hover::after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);


		$this->end_controls_tab();

		$this->start_controls_tab( 'menu_link_active', [ 'label' => esc_html__( 'Active', 'cp-companion' ) ] );

		$this->add_control(
			'navbar_active_style_color',
			[
				'label'     => esc_html__( 'Style Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-nav > li.cp-active > a:before' => 'background-color: {{VALUE}};',
					'{{WRAPPER}} .cp-navbar-nav > li.cp-active > a:after'  => 'background-color: {{VALUE}};',
				],
				
			]
		);

		$this->add_control(
			'menu_hover_color_active',
			[
				'label'     => esc_html__( 'Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-nav > li.cp-active > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'menu_hover_background_color_active',
			[
				'label'     => esc_html__( 'Background', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-nav > li.cp-active > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'menu_border_active',
				'label'    => esc_html__( 'Border', 'cp-companion' ),
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .cp-navbar-nav > li.cp-active > a',
			]
		);

		$this->add_control(
			'menu_border_radius_active',
			[
				'label'      => esc_html__( 'Border Radius', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-nav > li.cp-active > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'menu_typography_active',
				'label'    => esc_html__( 'Typography', 'cp-companion' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-navbar-nav > li.cp-active > a',
			]
		);

		$this->add_control(
			'menu_parent_arrow_color_active',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.cp-navbar-parent-indicator-yes .cp-navbar-nav > li.cp-parent.cp-active a:after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'dropdown_color',
			[
				'label' => esc_html__( 'Dropdown', 'cp-companion' ),
				'type'  => Controls_Manager::SECTION,
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'dropdown_background',
			[
				'label'     => esc_html__( 'Dropdown Background', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-dropdown' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->start_controls_tabs( 'dropdown_link_styles' );

		$this->start_controls_tab( 'dropdown_link_normal', [ 'label' => esc_html__( 'Normal', 'cp-companion' ) ] );

		$this->add_control(
			'dropdown_link_color',
			[
				'label'     => esc_html__( 'Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_link_background',
			[
				'label'     => esc_html__( 'Background', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'dropdown_link_spacing',
			[
				'label' => esc_html__( 'Gap', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 25,
					],
				],
				'size_units' => [ 'px'],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'dropdown_link_padding',
			[
				'label'      => esc_html__( 'Padding', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'     => 'dropdown_link_border',
				'label'    => esc_html__( 'Border', 'cp-companion' ),
				'default'  => '1px',
				'selector' => '{{WRAPPER}} .cp-navbar-dropdown-nav > li > a',
			]
		);

		$this->add_control(
			'dropdown_link_radius',
			[
				'label'      => esc_html__( 'Border Radius', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'dropdown_link_typography',
				'label'    => esc_html__( 'Typography', 'cp-companion' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-navbar-dropdown-nav > li > a',
			]
		);

		$this->add_control(
			'dropdown_parent_arrow_color',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.cp-navbar-parent-indicator-yes .cp-navbar-dropdown-nav > li.cp-parent a:after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'dropdown_link_hover', [ 'label' => esc_html__( 'Hover', 'cp-companion' ) ] );

		$this->add_control(
			'dropdown_link_hover_color',
			[
				'label'     => esc_html__( 'Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a:hover' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_control(
			'dropdown_link_hover_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_border_hover_color',
			[
				'label'     => esc_html__( 'Border Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'dropdown_radius_hover',
			[
				'label'      => esc_html__( 'Border Radius', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-navbar-dropdown-nav > li > a:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'dropdown_typography_hover',
				'label'    => esc_html__( 'Typography', 'cp-companion' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
				'selector' => '{{WRAPPER}} .cp-navbar-dropdown-nav > li > a:hover',
			]
		);

		$this->add_control(
			'dropdown_parent_arrow_color_hover',
			[
				'label'     => esc_html__( 'Parent Indicator Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}}.cp-navbar-parent-indicator-yes .cp-navbar-dropdown-nav > li.cp-parent a:hover::after' => 'color: {{VALUE}};',
				],
				'condition' => ['menu_parent_arrow' => 'yes'],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab( 'dropdown_link_active', [ 'label' => esc_html__( 'Active', 'cp-companion' ) ] );

			$this->add_control(
				'dropdown_active_color',
				[
					'label'     => esc_html__( 'Color', 'cp-companion' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .cp-navbar-dropdown-nav > li.cp-active > a' => 'color: {{VALUE}};',
					],
				]
			);

			$this->add_control(
				'dropdown_active_bg_color',
				[
					'label'     => esc_html__( 'Background', 'cp-companion' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .cp-navbar-dropdown-nav > li.cp-active > a' => 'background-color: {{VALUE}};',
					],
				]
			);

			$this->add_group_control(
				Group_Control_Border::get_type(),
				[
					'name'     => 'dropdown_active_border',
					'label'    => esc_html__( 'Border', 'cp-companion' ),
					'default'  => '1px',
					'selector' => '{{WRAPPER}} .cp-navbar-dropdown-nav > li.cp-active > a',
				]
			);

			$this->add_control(
				'dropdown_active_radius',
				[
					'label'      => esc_html__( 'Border Radius', 'cp-companion' ),
					'type'       => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .cp-navbar-dropdown-nav > li.cp-active > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'name'     => 'dropdown_typography_active',
					'label'    => esc_html__( 'Typography', 'cp-companion' ),
					'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
					'selector' => '{{WRAPPER}} .cp-navbar-dropdown-nav > li.cp-active > a',
				]
			);

			$this->add_control(
				'dropdown_parent_arrow_color_active',
				[
					'label'     => esc_html__( 'Parent Indicator Color', 'cp-companion' ),
					'type'      => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}}.cp-navbar-parent-indicator-yes .cp-navbar-dropdown-nav > li.cp-parent.cp-active a:after' => 'color: {{VALUE}};',
					],
					'condition' => ['menu_parent_arrow' => 'yes'],
				]
			);


		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();
	}

	protected function render() {

		$settings = $this->get_settings();
		$id       = 'cp-navbar-' . $this->get_id();
		$nav_menu = ! empty( $settings['navbar'] ) ? wp_get_nav_menu_object( $settings['navbar'] ) : false;

		if ( ! $nav_menu ) {
			return;
		}

		$nav_menu_args = array(
			'fallback_cb'    => false,
			'container'      => false,
			'menu_id'        => 'cp-navmenu',
			'menu_class'     => 'cp-navbar-nav',
			'theme_location' => 'default_navmenu',
			'menu'           => $nav_menu,
			'echo'           => true,
			'depth'          => 0,
			
		);

		$this->add_render_attribute(
			[
				'navbar-attr' => [
					'class' => [
						'cp-navbar-container',
						'cp-navbar'
					],
					
				]
			]
		);

		?>
		<div id="<?php echo esc_attr($id); ?>" class="cp-navbar-wrapper">
			<nav <?php echo $this->get_render_attribute_string( 'navbar-attr' ); ?>>
				<?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings ) ); ?>
			</nav>

			<div class="cp-mobile-nav-wrapper">
				<div class="cp-nav-toggle">
					  <div class="cp-nav-icon"><span></span></div>
				</div>
				<div class="side-nav cp-side-mobile-nav" id="cp-mob-side-nav">
					<?php wp_nav_menu( apply_filters( 'widget_nav_menu_args', $nav_menu_args, $nav_menu, $settings ) ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}