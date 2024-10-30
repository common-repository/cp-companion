<?php
namespace CpCompanion\Modules\Team\Widgets;

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

class Team extends Widget_Base {

	public function get_name() {
		return 'cp-team';
	}

	public function get_title() {
		return  esc_html__( 'Team', 'cp-companion' );
	}

	public function get_icon() {
		return 'cp-ea-icons cp-team';
	}

	public function get_categories() {
		return [ 'cp-elements' ];
	}

	
	protected function _register_controls() {

        $this->start_controls_section(
            'cp_layout_option',
            [
                'label' => esc_html__( 'Team Layout', 'cp-companion' )
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
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'slider_controls',
            [
                'label' => esc_html__( 'Team Options', 'cp-companion' )
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
                        'name'          => 'cp_multiple_team_title',
                        'label'         => esc_html__( 'Name', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXT,
                    ],
                    [
                        'name'          => 'cp_multiple_designation',
                        'label'         => esc_html__( 'Designation', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXT,
                    ],
                    [
                        'name'          => 'cp_multiple_phone',
                        'label'         => esc_html__( 'Phone', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXT,
                    ],
                    [
                        'name'          => 'cp_multiple_email',
                        'label'         => esc_html__( 'Email', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXT,
                    ],                    
                    [
                        'name'          => 'cp_multiple_desc',
                        'label'         => esc_html__( 'Description', 'cp-companion' ),
                        'type'          => Controls_Manager::TEXTAREA,
                    ],

                ],
                // 'default' => [
                //     [ 'cp_multiple_team_title' => 'Team Title' ],
                // ],
                // 'title_field' => '{{{ cp_multiple_team_title }}}',
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
            'phone_color',
            [
                'label'     => esc_html__( 'Phone Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .inner-wrapp .phone-wrapp' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'phone_typography',
                'label'     => esc_html__( 'Phone Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .inner-wrapp .phone-wrapp',
                
            ]
        );

        $this->add_control(
            'email_color',
            [
                'label'     => esc_html__( 'Email Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'separator'  => 'before',
                'selectors' => [
                    '{{WRAPPER}} .inner-wrapp .email-wrapp' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'email_typography',
                'label'     => esc_html__( 'Email Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .inner-wrapp .email-wrapp',
                
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
      $cp_multiple_layout           = $settings['cp_multiple_layout'];

      $this->add_render_attribute( 'cp-companion-attr', 'class', 'cp-companion-team' );
      $this->add_render_attribute( 'cp-companion-attr', 'class', $cp_multiple_layout );
      ?>
      <div <?php echo $this->get_render_attribute_string('cp-companion-attr')?> >

        <div class="slider-wrapp">
            <?php foreach( $settings['cp_multiple_test_data'] as $item ){

                $cp_multiple_img            = $item['cp_multiple_img'];
                $cp_multiple_team_title     = $item['cp_multiple_team_title'];
                $cp_multiple_designation    = $item['cp_multiple_designation'];
                $cp_multiple_phone    = $item['cp_multiple_phone'];
                $cp_multiple_email    = $item['cp_multiple_email'];
                $cp_multiple_desc           = $item['cp_multiple_desc'];
                
                ?>
                <div class="inner-wrapp">
                    <div class="team-single-wrapp">
                        <?php if(!empty($cp_multiple_img['url'])){ ?>
                            <img src="<?php echo esc_url($cp_multiple_img['url']);?>" >
                        <?php } ?>
                        <div class="contents-wrapp">
                            <?php if(!empty($cp_multiple_team_title)){ ?>
                                <h2 class="sl-title">
                                    <?php echo wp_kses_post($cp_multiple_team_title); ?>
                                </h2>
                            <?php } ?>
                            <?php if(!empty($cp_multiple_designation)){ ?>
                                <div class="designation-wrapp">
                                    <?php echo wp_kses_post($cp_multiple_designation); ?>
                                </div>
                            <?php } ?>
                            <?php
                            if('layout2'==$cp_multiple_layout){ echo '<div class="contact-wrap">';}
                            if(!empty($cp_multiple_phone)){ ?>
                                <div class="phone-wrapp">
                                    <?php echo wp_kses_post($cp_multiple_phone); ?>
                                </div>
                            <?php } ?>
                            <?php if(!empty($cp_multiple_email)){ ?>
                                <div class="email-wrapp">
                                    <?php echo wp_kses_post($cp_multiple_email); ?>
                                </div>
                            <?php }
                            if('layout2'==$cp_multiple_layout){ echo '</div>';}
                            ?>
                            <?php if(!empty($cp_multiple_desc)){ ?>
                                <div class="desc-wrapp">
                                    <?php echo esc_html($cp_multiple_desc); ?>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
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