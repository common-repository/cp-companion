<?php
namespace CpCompanion\Modules\WooCategories\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Icons_Manager;

use CpCompanion\Group_Control_Query;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Woo_Categories extends Widget_Base {

	public function get_name() {
		return 'cp-woo-categories';
	}

	public function get_title() {
		return  esc_html__( 'Woo Categories - Menu', 'cp-companion' );
	}

	public function get_icon() {
		return 'cp-ea-icons cp-woo-categories';
	}

	public function get_categories() {
		return [ 'cp-elements' ];
	}

	
	protected function _register_controls() {


        $this->start_controls_section(
            'cp_layout_option',
            [
                'label' => esc_html__( 'Title Options', 'cp-companion' )
            ]
        );

        $this->add_control(
            'cp_woo_cat_title', [
                'label'         => esc_html__( 'Item Label', 'cp-companion' ),
                'default'       => esc_html__('Categories','cp-companion'),
                'type'          => Controls_Manager::TEXT,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_controls',
            [
                'label' => esc_html__( 'Categories Options', 'cp-companion' )
            ]
        );
        

        $this->add_control(
            'cp_multiple_cat_data',
            [
                'type'      => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'fields' => [
                    [
                        'name'          => 'cp_multiple_icon',
                        'label'         => esc_html__( 'Icon', 'cp-companion' ),
                        'type'          => Controls_Manager::ICONS,
                        
                    ],
                            
                    [
                        'name'          => 'cp_woo_cat',
                        'label'         => esc_html__( 'Product Category', 'cp-companion' ),
                        'type'          => Controls_Manager::SELECT,
                        'options'       => cp_get_product_categories()
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
                'label' => esc_html__( 'General Styles', 'cp-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        
        $this->add_control(
            'menu_name_color',
            [
                'label'     => esc_html__( 'Menu Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-woo-categories .menu-title .text' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-woo-categories .menu-title .text' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'menu_icon_color',
            [
                'label'     => esc_html__( 'Icon Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-woo-categories .menu-title .icon-wrapp span' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'name_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-woo-categories .menu-title .text',
                
            ]
        );

        $this->add_control(
            'item_color',
            [
                'label'     => esc_html__( 'Item Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cp-woo-categories .menus-wrapp .item-wrapper .cat-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'item_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-woo-categories .menus-wrapp .item-wrapper .cat-name a',
                
            ]
        );


        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Icon Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cp-woo-categories .menus-wrapp .item-wrapper .icon-wrapp i' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .cp-woo-categories .menus-wrapp .item-wrapper .icon-wrapp svg' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_size',
            [
                'label' => esc_html__( 'Icon Size', 'cp-companion' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'size_units' => [ 'px' ],
                'selectors'  => [
                    '{{WRAPPER}} .cp-woo-categories .menus-wrapp svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .cp-woo-categories .menus-wrapp .item-wrapper .icon-wrapp i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );


        $this->end_controls_section();//end for styling tab



    }

    protected function render() {
        $settings         	= $this->get_settings_for_display();
        $cp_woo_cat_title   = $settings['cp_woo_cat_title'];

        $this->add_render_attribute( 'cp-companion-attr', 'class', 'cp-woo-categories' );
        ?>
        <div <?php echo $this->get_render_attribute_string('cp-companion-attr')?> >
            <div class="menu-title">
                <div class="icon-wrapp">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="text"><?php echo esc_html($cp_woo_cat_title); ?></div>
            </div>
            <ul class="menus-wrapp">
                <?php
                foreach( $settings['cp_multiple_cat_data'] as $item ){

                   $cp_multiple_icon    = $item['cp_multiple_icon'];
                   $cp_woo_cat          = $item['cp_woo_cat'];
                   $link                = get_category_link( $cp_woo_cat);
                   
                 

                   ?>
                   <li class="item-wrapper">
                        <?php if( !empty($cp_multiple_icon['value'])  ){ ?>
                            <span class="icon-wrapp">
                                <?php Icons_Manager::render_icon( $cp_multiple_icon ); ?>
                            </span>
                        <?php } ?>
                       <div class="cat-name">

                        <?php if( $term = get_term_by( 'id', $cp_woo_cat, 'product_cat' ) ){ ?>
                            <a href="<?php echo esc_url($link)?>"><?php echo esc_html($term->name);  ?></a>
                        <?php } ?>
                            
                        </div>   
                   </li>
                   <?php 
                }
                ?>
            </ul>
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