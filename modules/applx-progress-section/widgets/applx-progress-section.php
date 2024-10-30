<?php
/**
 * Century Parallax Progress
 *
 * @package    Century Plugin
 * @subpackage Century Parallax
 * @since      version 2.0.1
 */


namespace CpCompanion\Modules\ApplxProgressSection\Widgets;

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





class Applx_Progress_Section extends Widget_Base {
    

	/**
	 * Retrieve Applx_Progress_Section widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'applx-progress-section';
	}

	/**
	 * Retrieve Applx_Progress_Section widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'CP: Progress', 'cp-companion' );
	}

	/**
	 * Retrieve Applx_Progress_Section widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-call-to-action';
	}

	/**
	 * Retrieve the list of categories the Applx_Progress_Section widget belongs to.
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
	 * Register Applx_Progress_Section widget controls.
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
            'section_percentage',
            array(
                'label'       => esc_html__( 'Percentage:', 'cp-companion' ),
                'type'        => Controls_Manager::NUMBER,
                'label_block' => true,
                'min'   => 0,
                'max'   => 100,
                'step'  => 5,
            )
        );
        $this->add_control(
            'section_layout',
            array(
                'label'       => esc_html__( 'Section Layout:', 'cp-companion' ),
                'type'        => Controls_Manager::SELECT,
                'label_block' => true,
                'default'       =>  'layout1',
                'options'      => array(
                    'layout1'   => esc_html__('Layout 1','cp-companion'),
                    'layout2'   => esc_html__('Layout 2','cp-companion'),
                )
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
            'section_title_color',
            [
                'label'     => esc_html__( 'Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} h5.progress-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'section_currency_color',
            [
                'label'     => esc_html__( 'Percentage Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-progress-bar-percentage' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'section_bar_color',
            [
                'label'     => esc_html__( 'Bar Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-progress-bar-percentage' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .cp-progress-wrapper.layout1 .cp-progress-bar .cp-progress-bar-percentage .widget-percent' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .cp-progress-wrapper.layout1 .cp-progress-bar .cp-progress-bar-percentage .widget-percent:after' => 'border-right-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'section_title_typography',
                'label'     => esc_html__( 'Title Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} h5.progress-title, {{WRAPPER}} .widget-percent',
            ]
        );


        $this->end_controls_section();//end for styling tab
	}
	/**
	 * Render Applx_Progress_Section widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings();
        $layout = isset( $settings[ 'section_layout' ] )? $settings[ 'section_layout' ] : 'layout1';
        $this->add_render_attribute( 'cp-progress', 'class', 'cp-progress-section ' );
        $title = isset( $settings[ 'section_title' ] )? $settings[ 'section_title' ] : '';
        $percent = isset( $settings[ 'section_percentage' ] )? $settings[ 'section_percentage' ] : '';
        ?>
        <div <?php echo $this->get_render_attribute_string( 'cp-progress' ); ?>>
            <div class=" cp-progress-wrapper <?php echo esc_attr($layout);?>">
                <?php if( !empty($title)): ?>
                    <h5 class="progress-title"><?php echo esc_html($title); ?></h5>
                <?php endif;
                if (isset($percent)): ?>
                    <div class="cp-progress-bar">
                        <span class="cp-progress-bar-percentage" data-value="<?php echo esc_attr($percent); ?>">
                            <i class="widget-percent"><?php echo intval($percent); ?>%</i>
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- element main wrapper -->
<?php
	}
}