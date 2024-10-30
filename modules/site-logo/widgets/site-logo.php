<?php
namespace CpCompanion\Modules\SiteLogo\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;



// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}



class Site_Logo extends Widget_Base {

	public function get_name() {
		return 'cp-site-logo';
	}

	public function get_title() {
		return __( 'Site Logo', 'cp-companion' );
	}

	public function get_icon() {
		return 'cp-ea-icons cp-site-logo';
	}

	public function get_categories() {
		return [ 'cp-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Site Logo', 'cp-companion' ),
			]
		);

		$this->add_control(
			'display_type',
			[
				'label' => __( 'Display Type', 'cp-companion' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'logo' => esc_html__('Site Logo','cp-companion'),
					'tagline' 	=> esc_html__('Site Title & Tagline','cp-companion'),
					
				],
				'default' => 'site-logo',
			]
		);

		$this->add_control(
			'html_tag',
			[
				'label' => __( 'HTML Tag', 'cp-companion' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p' => 'p',
					'div' => 'div',
					'span' => 'span',
				],
				'default' => 'div',
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'cp-companion' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'cp-companion' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'cp-companion' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'cp-companion' ),
						'icon' => 'fa fa-align-right',
					],
					'justify' => [
						'title' => __( 'Justified', 'cp-companion' ),
						'icon' => 'fa fa-align-justify',
					],
				],
				'default' => '',
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'link_to',
			[
				'label' => __( 'Link to', 'cp-companion' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'cp-companion' ),
					'home' => __( 'Home URL', 'cp-companion' ),
					'custom' => __( 'Custom URL', 'cp-companion' ),
				],
			]
		);

		$this->add_control(
			'link',
			[
				'label' => __( 'Link', 'cp-companion' ),
				'type' => Controls_Manager::URL,
				'placeholder' => __( 'https://your-link.com', 'cp-companion' ),
				'condition' => [
					'link_to' => 'custom',
				],
				'default' => [
					'url' => '',
				],
				'show_label' => false,
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style',
			[
				'label' => __( 'Site Logo', 'cp-companion' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'space',
			[
				'label' => __( 'Size (%)', 'cp-companion' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 100,
					'unit' => '%',
				],
				'size_units' => [ '%' ],
				'range' => [
					'%' => [
						'min' => 1,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cp-site-logo img' => 'max-width: {{SIZE}}{{UNIT}};',
				],
				'condition' => [
					'display_type' => 'logo',
				],
				
			]
		);

		$this->add_control(
			'opacity',
			[
				'label' => __( 'Opacity (%)', 'cp-companion' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 1,
				],
				'range' => [
					'px' => [
						'max' => 1,
						'min' => 0.10,
						'step' => 0.01,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cp-site-logo img' => 'opacity: {{SIZE}};',
				],
				'condition' => [
					'display_type' => 'logo',
				],
			]
		);

		$this->add_control(
			'angle',
			[
				'label' => __( 'Angle (deg)', 'cp-companion' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'deg' ],
				'default' => [
					'unit' => 'deg',
					'size' => 0,
				],
				'range' => [
					'deg' => [
						'max' => 360,
						'min' => -360,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cp-site-logo img' => '-webkit-transform: rotate({{SIZE}}deg); -moz-transform: rotate({{SIZE}}deg); -ms-transform: rotate({{SIZE}}deg); -o-transform: rotate({{SIZE}}deg); transform: rotate({{SIZE}}deg);',
				],
				'condition' => [
					'display_type' => 'logo',
				],
			]
		);

	

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'image_border',
				'label' => __( 'Image Border', 'cp-companion' ),
				'selector' => '{{WRAPPER}} .cp-site-logo img',
				'condition' => [
					'display_type' => 'logo',
				],
			]
		);

		$this->add_control(
			'image_border_radius',
			[
				'label' => __( 'Border Radius', 'cp-companion' ),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .cp-site-logo img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'condition' => [
					'display_type' => 'logo',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'image_box_shadow',
				'selector' => '{{WRAPPER}} .cp-site-logo img',
				'condition' => [
					'display_type' => 'logo',
				],
			]
		);

		$this->add_control(
            'site_title_color',
            [
                'label'     => esc_html__( 'Site Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .cp-site-branding .cp-site-logo a' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
					'display_type' => 'tagline',
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'site_title_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-site-branding .cp-site-logo a',
                'condition' => [
					'display_type' => 'tagline',
				],
            ]
        );

        $this->add_control(
            'site_tagline_color',
            [
                'label'     => esc_html__( 'Tagline Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .cp-site-branding p' => 'color: {{VALUE}};',
                ],
                'separator' => 'before',
                'condition' => [
					'display_type' => 'tagline',
				],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'site_tagline_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-site-branding p',
                'condition' => [
					'display_type' => 'tagline',
				],
            ]
        );

		$this->end_controls_section();

	}

	protected function render() {

		$settings = $this->get_settings();

		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image 			= $custom_logo_id ? wp_get_attachment_image( $custom_logo_id , 'full' ) : '';
		$logo 			= has_custom_logo() ? $image : '';
		$display_type 	= $settings['display_type'];

		if ( empty( $logo || get_bloginfo( 'name' ) ) )
			return;

		switch ( $settings['link_to'] ) {
			case 'custom' :
				if ( ! empty( $settings['link']['url'] ) ) {
					$link = esc_url( $settings['link']['url'] );
				} else {
					$link = false;
				}
				break;

			case 'home' :
				$link = esc_url( get_home_url() );
				break;

			case 'none' :
			default:
				$link = false;
				break;
		}
		$target = $settings['link']['is_external'] ? 'target="_blank"' : '';

		$html = '<div class="cp-site-branding">';
		$html .= sprintf( '<%1$s class="cp-site-logo">', $settings['html_tag'] );
		if ( $link && $display_type == 'logo' ) {
			$html .= sprintf( '<a href="%1$s" %2$s>%3$s</a>', $link, $target, $logo );
			$html .= sprintf( '</%s>', $settings['html_tag'] );
		} else if($link && $display_type == 'tagline' ){
			$html .= sprintf( '<a href="%1$s" %2$s>%3$s</a>', $link, $target, get_bloginfo('name') );
			$html .= sprintf( '</%s>', $settings['html_tag'] );
			$html .= sprintf( '<p>%1$s</p>', get_bloginfo( 'description', 'display' ) );
		} elseif( ($settings['link_to'] == 'none') && $display_type == 'tagline' ){
			$html .= sprintf( '<a href="%1$s" %2$s>%3$s</a>', $link, $target, get_bloginfo('name') );
			$html .= sprintf( '</%s>', $settings['html_tag'] );
			$html .= sprintf( '<p>%1$s</p>', get_bloginfo( 'description', 'display' ) );
		} elseif( ($settings['link_to'] == 'none') && $display_type == 'logo' ){
			$html .= $logo;
			$html .= sprintf( '</%s>', $settings['html_tag'] );
		} else {
			$html .= $logo;
			$html .= sprintf( '</%s>', $settings['html_tag'] );
		}
		
		$html .= '</div>';

		echo $html;
	}

	 /**
     * Render widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @access protected
     */
	protected function _content_template() {

	}

}


