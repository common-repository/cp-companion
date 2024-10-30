<?php
namespace CpCompanion\Modules\Testimonials\Widgets;

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

class Testimonials extends Widget_Base {

	public function get_name() {
		return 'cp-testimonials';
	}

	public function get_title() {
		return  esc_html__( 'Testimonials', 'cp-companion' );
	}

	public function get_icon() {
		return 'cp-ea-icons cp-testimonials';
	}

	public function get_categories() {
		return [ 'cp-elements' ];
	}

	
	protected function _register_controls() {

        $this->start_controls_section(
            'cp_layout_option',
            [
                'label' => esc_html__( 'Testimonial Layout', 'cp-companion' )
            ]
        );

        $this->add_control(
            'cp_multiple_layout', [
                'label'         => esc_html__( 'Layout', 'cp-companion' ),
                'default' => 'default',
                'type'          => Controls_Manager::SELECT,
                'options' => [
                    'default' => esc_html__('Default', 'cp-companion'),
                    'layout2' => esc_html__('Layout 2', 'cp-companion'),
                    'layout3' => esc_html__('Layout 3', 'cp-companion'),
                    'layout4' => esc_html__('Layout 4', 'cp-companion'),
                    'layout5' => esc_html__('Layout 5', 'cp-companion'),
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_controls',
            [
                'label' => esc_html__( 'Testimonial Options', 'cp-companion' )
            ]
        );
        

        $this->add_control(
            'cp_multiple_test_data',
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
                        'name'          => 'cp_multiple_test_title',
                        'label'         => esc_html__( 'Name', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXT,
                    ],
                    [
                        'name'          => 'cp_multiple_designation',
                        'label'         => esc_html__( 'Designation', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXT,
                    ],                    
                    [
                        'name'          => 'cp_multiple_desc',
                        'label'         => esc_html__( 'Description', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXTAREA,
                    ],

                ],
                // 'default' => [
                //     [ 'cp_multiple_test_title' => 'Testimonial Title' ],
                // ],
                // 'title_field' => '{{{ cp_multiple_test_title }}}',
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
                'label'     => esc_html__( 'Name Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,

                'selectors' => [
                    '{{WRAPPER}} .inner-wrapp .sl-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'name_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .inner-wrapp .sl-title',
                
            ]
        );

        $this->add_control(
            'desi_color',
            [
                'label'     => esc_html__( 'Designation Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .inner-wrapp .designation-wrapp' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'desi_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .inner-wrapp .designation-wrapp',
                
            ]
        );


        $this->add_control(
            'desc_color',
            [
                'label'     => esc_html__( 'Description Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .inner-wrapp .desc-wrapp' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'desc_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .inner-wrapp .desc-wrapp',
                
            ]
        );


        $this->end_controls_section();//end for styling tab



    }

    protected function render() {
        $settings         	= $this->get_settings_for_display();
        $cp_multiple_layout   = $settings['cp_multiple_layout'];

        $this->add_render_attribute( 'cp-companion-attr', 'class', 'cp-companion-testimonials' );
        $this->add_render_attribute( 'cp-companion-attr', 'class', $cp_multiple_layout );
        ?>
        <div <?php echo $this->get_render_attribute_string('cp-companion-attr')?> >
            <div class="slider-wrapp">
                <?php
                foreach( $settings['cp_multiple_test_data'] as $item ){
                    if( $cp_multiple_layout == 'layout2' ){
                        $this->testimonial_layout_two($item);
                    }elseif( $cp_multiple_layout == 'layout3' ){
                        $this->testimonial_layout_three($item);
                    }elseif( $cp_multiple_layout == 'layout4' ){
                        $this->testimonial_layout_four($item);
                    }elseif( $cp_multiple_layout == 'layout5' ){
                        $this->testimonial_layout_three($item);
                    }else{
                        $this->testimonial_layout_one($item);
                    }
                }
                ?>
            </div>
        </div>
        <?php 	
    }

    /**
    * Default layout
    */
    protected function testimonial_layout_one($item){

        $cp_multiple_img            = $item['cp_multiple_img'];
        $cp_multiple_test_title     = $item['cp_multiple_test_title'];
        $cp_multiple_designation    = $item['cp_multiple_designation'];
        $cp_multiple_desc           = $item['cp_multiple_desc'];
        ?>
        <div class="inner-wrapp">
            <?php
            if(!empty($cp_multiple_img['url'])){ ?>
                <img src="<?php echo esc_url($cp_multiple_img['url']);?>" />
            <?php } ?>
            <div class="contents-wrapp">
                <?php if(!empty($cp_multiple_test_title)){ ?>
                    <h2 class="sl-title">
                        <?php echo wp_kses_post($cp_multiple_test_title); ?>
                    </h2>
                <?php }
                if(!empty($cp_multiple_designation)){
                    ?>
                    <div class="designation-wrapp">
                        <?php echo wp_kses_post($cp_multiple_designation); ?>
                    </div>
                    <?php
                }
                if(!empty($cp_multiple_desc)){ ?>
                    <div class="desc-wrapp">
                        <?php echo esc_html($cp_multiple_desc); ?>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php
    }

    /**
    * layout 2
    */
    protected function testimonial_layout_two($item){

        $cp_multiple_img            = $item['cp_multiple_img'];
        $cp_multiple_test_title     = $item['cp_multiple_test_title'];
        $cp_multiple_designation    = $item['cp_multiple_designation'];
        $cp_multiple_desc           = $item['cp_multiple_desc'];
        ?>
        <div class="inner-wrapp">
            <div class="img-tit-wrap">
                <?php
                if(!empty($cp_multiple_img['url'])){ ?>
                    <img src="<?php echo esc_url($cp_multiple_img['url']);?>" >
                    <?php 
                }
                ?>
                <div class="tit-desc">
                    <?php
                    if(!empty($cp_multiple_test_title)){ ?>
                        <h2 class="sl-title">
                            <?php echo wp_kses_post($cp_multiple_test_title); ?>
                        </h2>
                    <?php }
                    if(!empty($cp_multiple_designation)){ ?>
                        <div class="designation-wrapp">
                            <?php echo wp_kses_post($cp_multiple_designation); ?>
                        </div>
                    <?php }
                    ?>
                </div>
            </div>
            <div class="contents-wrapp">
                <?php
                if(!empty($cp_multiple_desc)){ ?>
                    <div class="desc-wrapp">
                        <?php echo esc_html($cp_multiple_desc); ?>
                    </div>
                    <?php
                } ?>
            </div>
        </div>
        <?php
    }

    /**
    * 3 layout
    */
    protected function testimonial_layout_three($item){

        $cp_multiple_img            = $item['cp_multiple_img'];
        $cp_multiple_test_title     = $item['cp_multiple_test_title'];
        $cp_multiple_designation    = $item['cp_multiple_designation'];
        $cp_multiple_desc           = $item['cp_multiple_desc'];

        $settings           = $this->get_settings_for_display();
        $cp_multiple_layout   = $settings['cp_multiple_layout'];
        ?>
        <div class="inner-wrapp">
            <?php
            if(!empty($cp_multiple_desc)){ ?>
                <div class="desc-wrapp">
                    <?php if($cp_multiple_layout=='layout3'){ ?>
                        <div class="svg-wrapp">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="508.044px" height="508.044px" viewBox="0 0 508.044 508.044" style="enable-background:new 0 0 508.044 508.044;" xml:space="preserve"><g><g><path d="M0.108,352.536c0,66.794,54.144,120.938,120.937,120.938c66.794,0,120.938-54.144,120.938-120.938s-54.144-120.937-120.938-120.937c-13.727,0-26.867,2.393-39.168,6.61C109.093,82.118,230.814-18.543,117.979,64.303C-7.138,156.17-0.026,348.84,0.114,352.371C0.114,352.426,0.108,352.475,0.108,352.536z"/><path d="M266.169,352.536c0,66.794,54.144,120.938,120.938,120.938s120.938-54.144,120.938-120.938S453.9,231.599,387.106,231.599c-13.728,0-26.867,2.393-39.168,6.61C375.154,82.118,496.875-18.543,384.04,64.303C258.923,156.17,266.034,348.84,266.175,352.371C266.175,352.426,266.169,352.475,266.169,352.536z"/></g></g></svg>
                        </div>
                    <?php } ?>
                    <div class="text-wrapp">
                        <?php echo esc_html($cp_multiple_desc); ?>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="contents-wrapp">
                <?php
                if(!empty($cp_multiple_img['url'])){ ?>
                    <img src="<?php echo esc_url($cp_multiple_img['url']);?>" alt="" />
                <?php }
                ?>
                <div class="title-desc-wrap">
                    <?php
                    if(!empty($cp_multiple_test_title)){ ?>
                        <h2 class="sl-title">
                            <?php echo wp_kses_post($cp_multiple_test_title); ?>
                        </h2>
                    <?php }
                    if(!empty($cp_multiple_designation)){
                        ?>
                        <div class="designation-wrapp">
                            <?php echo wp_kses_post($cp_multiple_designation); ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
        <?php
    }

    /**
    * 4 layout
    */
    protected function testimonial_layout_four($item){

        $cp_multiple_img            = $item['cp_multiple_img'];
        $cp_multiple_test_title     = $item['cp_multiple_test_title'];
        $cp_multiple_designation    = $item['cp_multiple_designation'];
        $cp_multiple_desc           = $item['cp_multiple_desc'];
        ?>
        <div class="inner-wrapp">
            <?php
            if(!empty($cp_multiple_img['url'])){
                ?>
                <img src="<?php echo esc_url($cp_multiple_img['url']);?>" >
                <?php 
            }
            ?>
            <div class="contents-wrapp">
                <?php
                if(!empty($cp_multiple_desc)){ ?>
                    <div class="desc-wrapp">
                        <?php echo esc_html($cp_multiple_desc); ?>
                    </div>
                    <?php
                }
                if(!empty($cp_multiple_test_title)){ ?>
                    <h2 class="sl-title">
                        <?php echo wp_kses_post($cp_multiple_test_title); ?>
                    </h2>
                <?php }
                if(!empty($cp_multiple_designation)){
                    ?>
                    <div class="designation-wrapp">
                        <?php echo wp_kses_post($cp_multiple_designation); ?>
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