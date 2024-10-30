<?php
namespace CpCompanion\Modules\Offcanvas\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Utils;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Offcanvas Widget
 * @since 1.2.0
 */
class Offcanvas extends Widget_Base {

	public function get_name() {
		return 'cp-offcanvas';
	}

	public function get_title() {
		return  esc_html__( 'Offcanvas', 'cp-companion' );
	}

	public function get_icon() {
		return 'cp-ea-icons cp-offcanvas';
	}

	public function get_categories() {
		return [ 'cp-elements' ];
	}

	public function get_script_depends() {
        return [ 'cp-frontend'];
    }

	

	protected function _register_controls() {

		$this->start_controls_section(
			'section_content_layout',
			[
				'label' => esc_html__( 'Layout', 'cp-companion' ),
			]
		);

	

		$this->add_control(
			'source',
			[
				'label'   => esc_html__( 'Select Source', 'cp-companion' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'sidebar',
				'options' => [
					'sidebar'   => esc_html__( 'Sidebar', 'cp-companion' ),
					'elementor' => esc_html__( 'Elementor Template', 'cp-companion' )
				],				
			]
		);

        $this->add_control(
            'template_id',
            [
                'label'       => __( 'Choose Template', 'cp-companion' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => cp_companion_get_elementor_templates(),
                'label_block' => 'true',
                'condition'   => ['source' => 'elementor'],
            ]
        );

        $this->add_control(
            'sidebars',
            [
                'label'       => esc_html__( 'Choose Sidebar', 'cp-companion' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => cp_companion_sidebar_options(),
                'label_block' => 'true',
                'condition'   => ['source' => 'sidebar'],
            ]
        );

        

		$this->add_responsive_control(
			'offcanvas_width',
			[
				'label'      => esc_html__( 'Width', 'cp-companion' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => [ 'px', 'vw' ],
				'range'      => [
					'px' => [
						'min' => 240,
						'max' => 1200,
					],
					'vw' => [
						'min' => 10,
						'max' => 100,
					]
				],
				'selectors' => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar' => 'width: {{SIZE}}{{UNIT}};',
				],
				
			]
		);

		$this->add_control(
			'custom_content_before_switcher',
			[
				'label' => esc_html__( 'Custom Content Before', 'cp-companion' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		$this->add_control(
			'custom_content_after_switcher',
			[
				'label' => esc_html__( 'Custom Content After', 'cp-companion' ),
				'type'  => Controls_Manager::SWITCHER,
			]
		);

		


		$this->end_controls_section();
		
		$this->start_controls_section(
			'section_content_custom_before',
			[
				'label'     => esc_html__( 'Custom Content Before', 'cp-companion' ),
				'condition' => [
					'custom_content_before_switcher' => 'yes',
				]
			]
		);

		$this->add_control(
			'custom_content_before',
			[
				'label'   => esc_html__( 'Custom Content Before', 'cp-companion' ),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => [ 'active' => true ],
				'default' => esc_html__( 'Custom content before your offcanvas.', 'cp-companion' ),
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_custom_after',
			[
				'label'     => esc_html__( 'Custom Content After', 'cp-companion' ),
				'condition' => [
					'custom_content_after_switcher' => 'yes',
				]
			]
		);


		$this->add_control(
			'custom_content_after',
			[
				'label'   => esc_html__( 'Custom Content After', 'cp-companion' ),
				'type'    => Controls_Manager::WYSIWYG,
				'dynamic' => [ 'active' => true ],
				'default' => esc_html__( 'Custom content after your offcanvas.', 'cp-companion' ),
			]
		);
		
		$this->end_controls_section();


		$this->start_controls_section(
			'section_content_offcanvas_button',
			[
				'label' => esc_html__( 'Button', 'cp-companion' ),
				
			]
		);

	

		$this->add_responsive_control(
			'button_align',
			[
				'label'   => esc_html__( 'Button Alignment', 'cp-companion' ),
				'type'    => Controls_Manager::CHOOSE,
				'options' => [
					'left'    => [
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
					'justify' => [
						'title' => esc_html__( 'Justified', 'cp-companion' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'prefix_class' => 'elementor%s-align-',
				'default'      => 'left',
			]
		);

		$this->add_responsive_control(
			'button_offset',
			[
				'label' => esc_html__( 'Offset', 'cp-companion' ),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => -150,
						'max' => 150,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .cp-offcanvas-button' => 'transform: translateX({{SIZE}}{{UNIT}});',
				],
			]
		);

		$this->add_control(
			'size',
			[
				'label'   => __( 'Size', 'cp-companion' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'sm',
				'options' => [
			        'xs' => esc_html__( 'Extra Small', 'cp-companion' ),
			        'sm' => esc_html__( 'Small', 'cp-companion' ),
			        'md' => esc_html__( 'Medium', 'cp-companion' ),
			        'lg' => esc_html__( 'Large', 'cp-companion' ),
			        'xl' => esc_html__( 'Extra Large', 'cp-companion' ),
			    ]
			]
		);

		$this->add_control(
			'button_icon',
			[
				'label'       => esc_html__( 'Button Icon', 'cp-companion' ),
				'type'        => Controls_Manager::ICON,
				'label_block' => true,
				'default'     => 'fa fa-bars',
			]
		);

		

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_offcanvas_content',
			[
				'label' => esc_html__( 'Offcanvas', 'cp-companion' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'offcanvas_content_color',
			[
				'label'     => esc_html__( 'Text Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_link_color',
			[
				'label'     => esc_html__( 'Link Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar a'   => 'color: {{VALUE}};',
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar a *' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_link_hover_color',
			[
				'label'     => esc_html__( 'Link Hover Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar a:hover' => 'color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_control(
			'offcanvas_content_background_color',
			[
				'label'     => esc_html__( 'Background Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar' => 'background-color: {{VALUE}} !important;',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'offcanvas_content_shadow',
				'selector'  => '#cp-offcanvas-{{ID}}.cp-offcanvas > div',
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'offcanvas_content_padding',
			[
				'label'      => esc_html__( 'Padding', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_offcanvas_widget',
			[
				'label'     => esc_html__( 'Widget', 'cp-companion' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => [
					'source' => 'sidebar',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'offcanvas_widget_border',
				'label'       => esc_html__( 'Border', 'cp-companion' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar .widget',
				'separator'   => 'before',
			]
		);

		$this->add_responsive_control(
			'widget_border_radius',
			[
				'label'      => esc_html__( 'Radius', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar .widget' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'offcanvas_widget_padding',
			[
				'label'      => esc_html__( 'Padding', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar .widget' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_responsive_control(
			'offcanvas_vertical_spacing',
			[
				'label'     => esc_html__( 'Vertical Spacing', 'cp-companion' ),
				'type'      => Controls_Manager::SLIDER,
				'selectors' => [
					'#cp-offcanvas-{{ID}}.cp-offcanvas .cp-offcanvas-bar .widget:not(:first-child)' => 'margin-top: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_style_offcanvas_button',
			[
				'label' => esc_html__( 'Button', 'cp-companion' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				
			]
		);

		$this->start_controls_tabs( 'tabs_offcanvas_button_style' );

		$this->start_controls_tab(
			'tab_offcanvas_button_normal',
			[
				'label' => esc_html__( 'Normal', 'cp-companion' ),
			]
		);

		
		$this->add_control(
			'offcanvas_button_color',
			[
				'label'     => esc_html__( 'Button Text Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-offcanvas-button' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_background_color',
			[
				'label'     => esc_html__( 'Button Background Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-offcanvas-button' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name'      => 'offcanvas_button_shadow',
				'selector'  => '{{WRAPPER}} .cp-offcanvas-button',
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name'        => 'offcanvas_button_border',
				'label'       => esc_html__( 'Border', 'cp-companion' ),
				'placeholder' => '1px',
				'default'     => '1px',
				'selector'    => '{{WRAPPER}} .cp-offcanvas-button',
				'separator'   => 'before',
			]
		);

		$this->add_control(
			'offcanvas_button_border_radius',
			[
				'label'      => esc_html__( 'Radius', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-offcanvas-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_padding',
			[
				'label'      => esc_html__( 'Padding', 'cp-companion' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .cp-offcanvas-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'      => 'offcanvas_button_typography',
				'label'     => esc_html__( 'Typography', 'cp-companion' ),
				'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
				'selector'  => '{{WRAPPER}} .cp-offcanvas-button',
				'separator' => 'before',
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'tab_offcanvas_button_hover',
			[
				'label' => esc_html__( 'Hover', 'cp-companion' ),
			]
		);

		$this->add_control(
			'offcanvas_button_hover_color',
			[
				'label'     => esc_html__( 'Button Text Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-offcanvas-button:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_background_hover_color',
			[
				'label'     => esc_html__( 'Button Background Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cp-offcanvas-button:hover' => 'background-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'offcanvas_button_hover_border_color',
			[
				'label'     => esc_html__( 'Button Border Color', 'cp-companion' ),
				'type'      => Controls_Manager::COLOR,
				'condition' => [
					'offcanvas_button_border_border!' => '',
				],
				'selectors' => [
					'{{WRAPPER}} .cp-offcanvas-button:hover' => 'border-color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'hover_animation',
			[
				'label' => esc_html__( 'Button Animation', 'cp-companion' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$id       = 'cp-offcanvas-' . $this->get_id();

		$this->add_render_attribute( 'offcanvas', 'class', 'cp-offcanvas' );
		$this->add_render_attribute( 'offcanvas', 'id', $id );
        $this->add_render_attribute(
        	[
        		'offcanvas' => [
        			'data-settings' => [
        				wp_json_encode(array_filter([
							'id'      =>  $id,
							'layout'  => 'default',
        		        ]))
        			]
        		]
        	]
        );
		

		?>

		
		<?php $this->render_button(); ?>

		
	    <div <?php echo $this->get_render_attribute_string( 'offcanvas' ); ?>>
	        <div class="cp-offcanvas-bar">
				
				
        		<button class="cp-offcanvas-close" type="button" cp-close>
        			<svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg" data-svg="close-icon"><line fill="none"  stroke-width="1.1" x1="1" y1="1" x2="13" y2="13"></line><line fill="none" stroke-width="1.1" x1="13" y1="1" x2="1" y2="13"></line></svg>
        		</button>
	        

	        	
				<?php if ($settings['custom_content_before_switcher'] or $settings['custom_content_after_switcher'] or !empty( $settings['source'] )) : ?>
		        	<?php if ($settings['custom_content_before_switcher'] === 'yes' and !empty($settings['custom_content_before'])) : ?>
		        	<div class="cp-offcanvas-custom-content-before widget">
		            	<?php echo wp_kses_post($settings['custom_content_before']); ?>		        		
		        	</div>
		        	<?php endif; ?>

		            <?php 
		            	if ( 'sidebar' == $settings['source'] and !empty( $settings['sidebars'] ) ) {
		            		dynamic_sidebar( $settings['sidebars'] );
		            	} elseif ('elementor' == $settings['source'] and !empty( $settings['template_id'] )) {
		            		echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display($settings['template_id']);
		            	}
		            ?>

	            	<?php if ($settings['custom_content_after_switcher'] === 'yes' and !empty($settings['custom_content_after'])) : ?>
	            	<div class="cp-offcanvas-custom-content-after widget">
	                	<?php echo wp_kses_post($settings['custom_content_after']); ?>		        		
	            	</div>
	            	<?php endif; ?>
	            <?php else: ?>
					<div class="cp-offcanvas-custom-content-after widget">
						<div class="cp-alert-warning" cp-alert><?php esc_html_e('Ops you don\'t select or enter any content! Add your offcanvas content from editor.', 'cp-companion'); ?></div>
					</div>
	            <?php endif; ?>
	        </div>
	    </div>

		<?php
	}

	protected function render_button() {
		$settings = $this->get_settings_for_display();
		$id       = 'cp-offcanvas-' . $this->get_id();

	

		$this->add_render_attribute( 'button', 'class', ['cp-offcanvas-button', 'elementor-button'] );

		if ( ! empty( $settings['size'] ) ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-size-' . $settings['size'] );
		}

		if ( $settings['hover_animation'] ) {
			$this->add_render_attribute( 'button', 'class', 'elementor-animation-' . $settings['hover_animation'] );
		}

		$this->add_render_attribute( 'button', 'cp-toggle', 'target: #' . esc_attr($id) );
		$this->add_render_attribute( 'button', 'href', 'javascript:void(0)' );

		$this->add_render_attribute( 'content-wrapper', 'class', 'elementor-button-content-wrapper' );
		$this->add_render_attribute( 'icon-align', 'class', 'cp-offcanvas-button-icon elementor-button-icon' );

		$this->add_render_attribute( 'text', 'class', 'elementor-button-text' );

		?>

		<div class="cp-offcanvas-button-wrapper">
			<a <?php echo $this->get_render_attribute_string( 'button' ); ?> >
			
				<span <?php echo $this->get_render_attribute_string( 'content-wrapper' ); ?>>
					<?php if ( ! empty( $settings['button_icon'] ) ) : ?>
					<span <?php echo $this->get_render_attribute_string( 'icon-align' ); ?>>
						<i class="<?php echo esc_attr( $settings['button_icon'] ); ?>" aria-hidden="true"></i>
					</span>
					<?php endif; ?>
					
				</span>

			</a>
		</div>
		<?php
	}
}
