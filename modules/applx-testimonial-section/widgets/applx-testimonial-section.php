<?php
/**
 * Century Parallax Testimonial
 *
 * @package    Century Plugin
 * @subpackage Century Parallax
 * @since      version 2.0.1
 */

namespace CpCompanion\Modules\ApplxTestimonialSection\Widgets;

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




class Applx_Testimonial_Section extends Widget_Base {
    

	/**
	 * Retrieve Applx_Testimonial_Section widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'applx-testimonial-section';
	}

	/**
	 * Retrieve Applx_Testimonial_Section widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'CP: Testimonial', 'cp-companion' );
	}

	/**
	 * Retrieve Applx_Testimonial_Section widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-testimonial';
	}

	/**
	 * Retrieve the list of categories the Applx_Testimonial_Section widget belongs to.
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
	 * Register Applx_Testimonial_Section widget controls.
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
            'section_title',
            array(
                'label'       => esc_html__( 'Title:', 'cp-companion' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );

        $this->add_control(
            'section_designation',
            array(
                'label'       => esc_html__( 'Designation:', 'cp-companion' ),
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
            )
        );

        $this->add_control(
            'section_description',
            array(
                'label'       => esc_html__( 'Description:', 'cp-companion' ),
                'type'        => Controls_Manager::TEXTAREA,
                'label_block' => true,
            )
        );

        $this->add_control(
            'testimonial_image',
            array(
                'label'       => esc_html__( 'Image:', 'cp-companion' ),
                'type'        => Controls_Manager::MEDIA,
                'label_block' => true,
            )
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
            'content_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h4.testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_title_color_hover',
            [
                'label'     => esc_html__( 'Title Color: Hover', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .cp-testimonial-section h4.testimonial-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_description_color',
            [
                'label'     => esc_html__( 'Description Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_description_color_hover',
            [
                'label'     => esc_html__( 'Description Color: Hover', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .cp-testimonial-section .testimonial-description' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_designation_color',
            [
                'label'     => esc_html__( 'Designation Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-designation' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'content_designation_color_hover',
            [
                'label'     => esc_html__( 'Designation Color: Hover', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .cp-testimonial-section .testimonial-designation' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_quote_color',
            [
                'label'     => esc_html__( 'Quote Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .testimonial-description:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'testimonial_quote_color_hover',
            [
                'label'     => esc_html__( 'Quote Color:hover', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .elementor-widget-container:hover .cp-testimonial-section .testimonial-description:before' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'testimonial_title_typography',
                'label'     => esc_html__( 'Title Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} h4.testimonial-title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'testimonial_description_typography',
                'label'     => esc_html__( 'Description Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .testimonial-description',
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'testimonial_designation_typography',
                'label'     => esc_html__( 'Designation Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .testimonial-designation',
            ]
        );

        $this->end_controls_section();//end for styling tab
	}
	/**
	 * Render Applx_Testimonial_Section widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings();
        $this->add_render_attribute( 'cp-testimonial', 'class', 'cp-testimonial-section ' );
        $testimonial_image = isset( $settings[ 'testimonial_image' ] )? $settings[ 'testimonial_image' ] : '';
        //$layout = isset( $settings[ 'section_layout' ] )? $settings[ 'section_layout' ] : '';
        $title = isset( $settings[ 'section_title' ] )? $settings[ 'section_title' ] : '';
        $description = isset( $settings[ 'section_description' ] )? $settings[ 'section_description' ] : '';
        $designation = isset( $settings[ 'section_designation' ] )? $settings[ 'section_designation' ] : '';
        ?>
        <div <?php echo $this->get_render_attribute_string( 'cp-testimonial' ); ?>>
            <div class="cp-testimonial-wrapper">
                <div class="testimonial-post-wrap">
                    <div class="testimonial-description">
                        <?php echo esc_html($description); ?>
                    </div>
                    <div class="testimonial-title-wrap">                        
                        <?php  if( !empty($testimonial_image['url'])): ?>
                            <img src="<?php echo esc_url($testimonial_image['url']);?>" alt="<?php echo esc_html($title);?>" />
                        <?php endif;
                        if( !empty($title)): ?>
                            <h4 class="testimonial-title">
                                <?php echo esc_html($title); ?>
                            </h4>
                        <?php endif;
                        if( !empty($designation)): ?>
                            <h6 class="testimonial-designation">
                                <?php echo esc_html($designation); ?>
                            </h6>
                        <?php endif;?>
                    </div>
                </div>                
            </div>
        </div><!-- element main wrapper -->
<?php
	}
}