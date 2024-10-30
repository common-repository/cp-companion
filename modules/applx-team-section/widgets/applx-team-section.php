<?php
/**
 * Century Parallax Team
 *
 * @package    Century Plugin
 * @subpackage Century Parallax
 * @since      version 2.0.1
 */

namespace CpCompanion\Modules\ApplxTeamSection\Widgets;

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




class Applx_Team_Section extends Widget_Base {
    

	/**
	 * Retrieve Applx_Team_Section widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
	   return 'applx-team-section';
	}

	/**
	 * Retrieve Applx_Team_Section widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'CP: Team', 'cp-companion' );
	}

	/**
	 * Retrieve Applx_Team_Section widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-person';
	}

	/**
	 * Retrieve the list of categories the Applx_Team_Section widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'applx-elements' );
	}

	/**
	 * Register Applx_Team_Section widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @access protected
	 */
	protected function _register_controls() {

        // Widget title section
        $this->start_controls_section(
            'section_detail',
            array(
                'label' => esc_html__( 'Section Setting', 'cp-companion' ),
            )
        );

        $this->add_control(
            'section_layout',
            array(
                'label'       => esc_html__( 'Section Layout:', 'cp-companion' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'options'      => array(
                    'layout1'   => esc_html__('Layout 1','cp-companion'),
                    'layout2'   => esc_html__('Layout 2','cp-companion'),
                )
            )
        );

        $this->add_control(
            'team_image',
            array(
                'label'       => esc_html__( 'Image:', 'cp-companion' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            )
        );

        $this->add_control(
            'team_name',
            array(
                'label'       => esc_html__( 'Name:', 'cp-companion' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );

        $this->add_control(
            'team_details',
            array(
                'label'       => esc_html__( 'Team Details:', 'cp-companion' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            )
        );

        $this->add_control(
            'team_designation',
            array(
                'label'       => esc_html__( 'Team Designation:', 'cp-companion' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );

        $this->end_controls_section();
        // Widget title section
        $this->start_controls_section(
            'social_links',
            array(
                'label' => esc_html__( 'Social Links', 'cp-companion' ),
            )
        );
        $this->add_control(
            'facebook_link',
            [
                'label' => esc_html__( 'Facebook Link', 'cp-companion' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://facebook.com', 'cp-companion' ),
                'show_external' => false,               
            ]
        );
        $this->add_control(
            'twitter_link',
            [
                'label' => esc_html__( 'Twitter Link', 'cp-companion' ),
                'type' =>  Controls_Manager::URL,
                'placeholder' => __( 'https://twitter.com', 'cp-companion' ),
                'show_external' => false,                
            ]
        );
        $this->add_control(
            'youtube_link',
            [
                'label' => esc_html__( 'Youtube Link', 'cp-companion' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://youtube.com', 'cp-companion' ),
                'show_external' => false,                
            ]
        );
        $this->add_control(
            'instagram_link',
            [
                'label' => esc_html__( 'Instagram Link', 'cp-companion' ),
                'type' => Controls_Manager::URL,
                'placeholder' => __( 'https://instagram.com', 'cp-companion' ),
                'show_external' => false,                
            ]
        );
        $this->end_controls_section();

        //styling tab
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__( 'General Styles', 'cp-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'team_title_color',
            [
                'label'     => esc_html__( 'Name Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h4.team-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'team_description_color',
            [
                'label'     => esc_html__( 'Details Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-details' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'team_designation_color',
            [
                'label'     => esc_html__( 'Designation Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'overlay_background_color',
            [
                'label'     => esc_html__( 'Overlay Background Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-team-wrapper.layout1 .team-content-wrapper' => 'background-color: {{VALUE}};',
                ],
                'condition'         => [
                    'section_layout'     => 'layout1',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'team_title_typography',
                'label'     => esc_html__( 'Name Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} h4.team-name',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'team_details_typography',
                'label'     => esc_html__( 'Details Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .team-details',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'team_designation_typography',
                'label'     => esc_html__( 'Designation Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .team-designation',
            ]
        );


        $this->end_controls_section();//end for styling tab
	}
	/**
	 * Render Applx_Team_Section widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings();

        $this->add_render_attribute( 'cp-team', 'class', 'cp-team-section' );
        $team_image         = isset( $settings[ 'team_image' ] )? $settings[ 'team_image' ] : '';
        $layout             = isset( $settings[ 'section_layout' ] )? $settings[ 'section_layout' ] : '';
        $team_name          = isset( $settings[ 'team_name' ] )? $settings[ 'team_name' ] : '';
        $team_details       = isset( $settings[ 'team_details' ] )? $settings[ 'team_details' ] : '';
        $team_designation   = isset( $settings[ 'team_designation' ] )? $settings[ 'team_designation' ] : '';
        $facebook_link      = isset( $settings[ 'facebook_link' ] )? $settings[ 'facebook_link' ] : '';
        $twitter_link       = isset( $settings[ 'twitter_link' ] )? $settings[ 'twitter_link' ] : '';
        $youtube_link       = isset( $settings[ 'youtube_link' ] )? $settings[ 'youtube_link' ] : '';
        $instagram_link     = isset( $settings[ 'instagram_link' ] )? $settings[ 'instagram_link' ] : '';
        
        ?>
        <div <?php echo $this->get_render_attribute_string( 'cp-team' ); ?>>
            <div class=" cp-team-wrapper <?php echo esc_attr($layout);?>">
                <div class="team-single-wrap">
                    <?php if( $layout == 'layout2'):?>
                        <div class="team-image-wrap">
                            <?php 
                            if( !empty($team_image)): ?>
                            <img src="<?php echo esc_url($team_image['url']);?>" alt="<?php echo esc_attr($team_name);?>" />
                            <?php endif;?>
                            <div class="team-links">
                                <?php if( !empty($facebook_link['url'])): ?>
                                    <a href="<?php echo esc_url($facebook_link['url']);?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                <?php endif;
                                if( !empty($twitter_link['url'])): ?>
                                    <a href="<?php echo esc_url($twitter_link['url']);?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                <?php endif;
                                if( !empty($youtube_link['url'])): ?>
                                    <a href="<?php echo esc_url($youtube_link['url']);?>" target="_blank"><i class="fa fa-youtube"></i></a>
                                <?php endif;
                                if( !empty($instagram_link['url'])): ?>
                                    <a href="<?php echo esc_url($instagram_link['url']);?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                <?php endif;?>
                            </div>                            
                        </div>
                        <div class="team-content-wrapper">
                            <?php if( !empty($team_name)): ?>
                                <h4 class="team-name"><?php echo esc_html($team_name); ?></h4>
                            <?php endif;
                            if( !empty($team_designation)): ?>
                                <h6 class="team-designation">
                                    <?php echo esc_html($team_designation); ?>
                                </h6>
                            <?php endif;?>
                        </div>                        
                    <?php else: ?>
                        <?php
                        if( !empty($team_image)): ?>
                            <div class="team-image-wrap">
                                <img src="<?php echo esc_url($team_image['url']);?>" alt="<?php echo esc_attr($team_name);?>" />
                            </div>
                        <?php endif;?>
                        <div class="team-content-wrapper">
                            <?php if( !empty($team_name)): ?>
                                <h4 class="team-name"><?php echo esc_html($team_name); ?></h4>
                            <?php endif;
                            if( !empty($team_designation)): ?>
                                <h6 class="team-designation">
                                    <?php echo esc_html($team_designation); ?>
                                </h6>
                            <?php endif;?>
                            <div class="team-details">
                                <?php echo esc_html($team_details); ?>
                            </div>
                            <div class="team-links">
                                <?php if( !empty($facebook_link['url'])): ?>
                                    <a href="<?php echo esc_url($facebook_link['url']);?>" target="_blank"><i class="fa fa-facebook"></i></a>
                                <?php endif;
                                if( !empty($twitter_link['url'])): ?>
                                    <a href="<?php echo esc_url($twitter_link['url']);?>" target="_blank"><i class="fa fa-twitter"></i></a>
                                <?php endif;
                                if( !empty($youtube_link['url'])): ?>
                                    <a href="<?php echo esc_url($youtube_link['url']);?>" target="_blank"><i class="fa fa-youtube"></i></a>
                                <?php endif;
                                if( !empty($instagram_link['url'])): ?>
                                    <a href="<?php echo esc_url($instagram_link['url']);?>" target="_blank"><i class="fa fa-instagram"></i></a>
                                <?php endif;?>
                            </div>
                        </div>
                    <?php endif;?>
                </div>                
            </div>
        </div><!-- element main wrapper -->
<?php
	}
}