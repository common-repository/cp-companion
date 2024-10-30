<?php
namespace CpCompanion\Modules\WooCategoryCounter\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

use CpCompanion\Group_Control_Query;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Woo_Category_Counter extends Widget_Base {

	public function get_name() {
		return 'cp-woo-category-counter';
	}

	public function get_title() {
		return  esc_html__( 'Woo Category Counter', 'cp-companion' );
	}

	public function get_icon() {
		return 'cp-ea-icons cp-woo-category-counter';
	}

	public function get_categories() {
		return [ 'cp-elements' ];
	}

	
	protected function _register_controls() {

       

        $this->start_controls_section(
            'slider_controls',
            [
                'label' => esc_html__( 'Options', 'cp-companion' )
            ]
        );
        

        $this->add_control(
            'cp_multiple_cat_data',
            [
                'type'      => Controls_Manager::REPEATER,
                'seperator' => 'before',
                'fields' => [
                    [
                        'name'          => 'cp_multiple_img',
                        'label'         => esc_html__( 'Image', 'cp-companion' ),
                        'type'          => Controls_Manager::MEDIA,
                        'default' => [
                            'url' => \Elementor\Utils::get_placeholder_image_src(),
                        ],
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

        //slider title
        $this->add_control(
            'name_color',
            [
                'label'     => esc_html__( 'Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .cp-woo-cat-counter .slider-wrapp .item-wrapper .cat-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'name_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-woo-cat-counter .slider-wrapp .item-wrapper .cat-name',
                
            ]
        );

        $this->add_control(
            'pcount_color',
            [
                'label'     => esc_html__( 'Product Count Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .cp-woo-cat-counter .slider-wrapp .item-wrapper .product-count' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'pcount_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-woo-cat-counter .slider-wrapp .item-wrapper .product-count',
                
            ]
        );


        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Background Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-woo-cat-counter .slider-wrapp .item-wrapper .product-count' => 'background: {{VALUE}};',
                ],
            ]
        );

        


        $this->end_controls_section();//end for styling tab



    }

    protected function render() {
        $settings         	= $this->get_settings_for_display();

        $this->add_render_attribute( 'cp-companion-attr', 'class', 'cp-woo-cat-counter' );
        ?>
        <div <?php echo $this->get_render_attribute_string('cp-companion-attr')?> >
            <div class="slider-wrapp">
                <?php
                foreach( $settings['cp_multiple_cat_data'] as $item ){
                   $cp_multiple_img = $item['cp_multiple_img'];
                   $cp_woo_cat      = $item['cp_woo_cat'];
                   
                   $args = array(
                        'hide_empty'    => true,
                        'include'       =>  $cp_woo_cat
                    );
                    $product_categories = get_terms( 'product_cat', $args );

                    if(empty($product_categories[0])){
                        return;
                    }

                   ?>
                   <div class="item-wrapper">
                       <img src="<?php echo esc_url($cp_multiple_img['url'])?>">
                       <div class="product-count">
                        <?php echo absint($product_categories[0]->count) ?>
                        <?php esc_html_e('Products','cp-companion'); ?>    
                        </div>
                       <div class="cat-name">

                        <?php 
                        if( $term = get_term_by( 'id', $cp_woo_cat, 'product_cat' ) ){
                            $link                = get_category_link( $cp_woo_cat); ?>
                            <a href="<?php echo esc_url($link)?>"><?php echo $term->name;  ?></a>
                        <?php } ?>
                            
                        </div>   
                   </div>
                   <?php 
                }
                ?>
            </div>
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