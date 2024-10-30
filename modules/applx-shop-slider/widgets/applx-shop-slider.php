<?php
/**
 * Century Parallax Blog
 *
 * @package    Century Plugin
 * @subpackage Century Parallax
 * @since      version 2.0.1
 */

namespace CpCompanion\Modules\ApplxShopSlider\Widgets;

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



class Applx_Shop_Slider extends Widget_Base {


	/**
	 * Retrieve Applx_Shop_Section widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'applx-shop-slider';
	}

	/**
	 * Retrieve Applx_Shop_Section widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'CP: Shop Slider', 'cp-companion' );
	}

	/**
	 * Retrieve Applx_Shop_Section widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-carousel';
	}

	/**
	 * Retrieve the list of categories the Applx_Shop_Section widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return ['applx-elements'];
	}

	/**
	 * Register Applx_Shop_Section widget controls.
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
            'categories',
            [
                'label'             => esc_html__( 'Product Categories', 'cp-companion' ),
                'type'              => Controls_Manager::SELECT2,
                'label_block'       => true,
                'multiple'          => true,
                'options'           => century_parallax_get_product_categories(),
            ]
        );

        $this->add_control(
            'showposts',
            [
                'label'             => esc_html__( 'Posts To Show', 'cp-companion' ),
                'type'              => Controls_Manager::NUMBER,
                'default'           => '-1'
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

        //element title
        $this->add_control(
            'content_title_color',
            [
                'label'     => esc_html__( 'Product Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}}  .cp-product-wrapper .woocommerce-loop-product__title' => 'color: {{VALUE}};',
                ],
            ]
        );

        //element title
        $this->add_control(
            'content_price_color',
            [
                'label'     => esc_html__( 'Product price Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .price' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_addtocart_color',
            [
                'label'     => esc_html__( 'Add to Cart Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add_to_cart_button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'content_addtocart_color_hover',
            [
                'label'     => esc_html__( 'Add to Cart Color: Hover', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .add_to_cart_button:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_title_typography',
                'label'     => esc_html__( 'Product Title Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}}  .cp-product-wrapper .woocommerce-loop-product__title',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_price_typography',
                'label'     => esc_html__( 'Product Price Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .price',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_addtocart_typography',
                'label'     => esc_html__( 'Add to Cart', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .add_to_cart_button, {{WRAPPER}} li.product a.added_to_cart',
            ]
        );

        $this->end_controls_section();//end for styling tab
	}
	/**
	 * Render Applx_Shop_Section widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings();

        $this->add_render_attribute( 'cp-shop', 'class', 'cp-shop-section' );
        $showposts = isset( $settings[ 'showposts' ] )? $settings[ 'showposts' ] : '-1';
        $categories = isset( $settings[ 'categories' ] )? $settings[ 'categories' ] : array();
        $block_args = array( 
                        'post_type' => 'product',
                        'posts_per_page' => $showposts,
                    );
        if( $categories ){
            $block_args['tax_query']  = array(
                            array(
                                'taxonomy'  => 'product_cat',
                                'field'     => 'id', 
                                'terms'     => $categories
                            )
                        );
        }
        $query = new \WP_Query( $block_args );
        ?>
        <div <?php echo $this->get_render_attribute_string( 'cp-shop' ); ?>>
            <div class="cp-shop-wrapper">
                <ul class="cp-product-wrapper">
                    <?php 
                    if($query->have_posts()):
                        $count = 1;
                        while($query->have_posts()):$query->the_post();
                        $image_id = get_post_thumbnail_id();
                        $image = wp_get_attachment_image_src($image_id, 'thumbnail', 'true');
                        wc_get_template_part( 'content', 'product' ); 
                        $count+=0.5;
                        endwhile;
                    endif;
                    ?>
                </ul>
            </div>
        </div><!-- element main wrapper -->
<?php
	}
}