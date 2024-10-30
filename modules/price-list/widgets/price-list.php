<?php
namespace CpCompanion\Modules\PriceList\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use CpCompanion\Group_Control_Query;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Price_List extends Widget_Base {

    public function get_name() {
        return 'cp-price-list';
    }

    public function get_title() {
        return  esc_html__( 'Price List', 'cp-companion' );
    }

    public function get_icon() {
        return 'cp-ea-icons cp-price-list';
    }

    public function get_categories() {
        return [ 'cp-elements' ];
    }

    

    protected function _register_controls() {   

        $this->start_controls_section(
            'section_content_heading',
            [
                'label' => esc_html__( 'General Settings', 'cp-companion' ),
            ]
        );
        
      
        $this->add_control(
            'cp_multiple_price_data',
            [
                'type'      => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'fields' => [
                
                    [
                        'name'          => 'cp_price_title',
                        'label'         => esc_html__( 'Title', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXT,
                    ],
                 
                    [
                        'name'          => 'cp_desc',
                        'label'         => esc_html__( 'Description', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXTAREA,
                    ],

                    [
                        'name'          => 'cp_price',
                        'label'         => esc_html__( 'Price', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXT,
                    ],
                   
                ],
            ]
        );

        $this->end_controls_section();


     

        /**
        * Styling tab
        */
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__( 'Pricing Styles', 'cp-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-pricing-lists .text-wrapp h3' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-pricing-lists .text-wrapp h3',
                
            ]
        );

        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cp-pricing-lists p.desc' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'desc_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-pricing-lists p.desc',
                
            ]
        );


        $this->add_control(
            'price_color',
            [
                'label'     => esc_html__( 'Price Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cp-pricing-lists span.price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'price_typography_pl',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-pricing-lists span.price',
                
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'     => 'pricing_border',
                'label'    => esc_html__( 'Border', 'cp-companion' ),
                'separator'  => 'before',
                'selector' => '{{WRAPPER}} .cp-price-wrapp',
            ]
        );

        $this->add_responsive_control(
            'menu_offset',
            [
                'label' => esc_html__( 'Offset', 'cp-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'separator'  => 'before',
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 150,
                    ],
                ],
                'size_units' => [ 'px' ],
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .cp-price-wrapp' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


       

        $this->end_controls_section();//end for main slide style

        

        
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
     
        
        
        $this->add_render_attribute( 'cp-attr', 'class', 'cp-pricing-lists ' );
        
    ?>
    <div <?php echo $this->get_render_attribute_string('cp-attr')?> >
        
        <?php foreach( $settings['cp_multiple_price_data'] as $item ){ 

            $cp_price_title = $item['cp_price_title'];
            $cp_desc        = $item['cp_desc'];
            $cp_price       = $item['cp_price'];
            ?>
            <div class="cp-price-wrapp clearfix">
                
                <div class="text-wrapp">
                    <h3><?php echo esc_html($cp_price_title); ?></h3>
                    <p class="desc"><?php echo wp_kses_post($cp_desc); ?></p>
                </div>    

                <span class="price">
                    <?php echo esc_html($cp_price); ?>
                </span>

            </div>

                
        <?php } ?>


    </div>
    <?php   

    }

  
   

   

    /**
     * Render widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @access protected
     */
    protected function _content_template() {}

}