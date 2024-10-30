<?php
namespace CpCompanion\Modules\BlogSlider\Widgets;

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

class Blog_Slider extends Widget_Base {

    public function get_name() {
        return 'cp-blog-slider';
    }

    public function get_title() {
        return  esc_html__( 'Blog Slider', 'cp-companion' );
    }

    public function get_icon() {
        return 'cp-ea-icons cp-blog-slider';
    }

    public function get_categories() {
        return [ 'cp-elements' ];
    }

    public function get_script_depends() {
        return [ 'cp-frontend'];
    }

    

    protected function _register_controls() {   

        $this->start_controls_section(
            'section_content_heading',
            [
                'label' => esc_html__( 'General Settings', 'cp-companion' ),
            ]
        );
        
        $this->add_control(
            'no_of_post',
            [
                'label'         => esc_html__( 'Number Of Posts', 'cp-companion' ),
                'type'          => Controls_Manager::NUMBER,
                'default'       => 3
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'              => 'image_size_small',
                'label'             => esc_html__( 'Image Size', 'cp-companion' ),
                'default'           => 'large',
                'separator'         => 'before',
            ]
        );

        $this->add_control(
                'fallback_image', [
            'label' => esc_html__('Fallback Image', 'cp-companion'),
            'type' => Controls_Manager::SELECT,
            'options' => [
                '' => esc_html__('None', 'cp-companion'),
                'placeholder' => esc_html__('Placeholder', 'cp-companion'),
                'custom' => esc_html__('Custom', 'cp-companion'),
            ],
            'default' => '',
            'separator' => 'before',
            'label_block' => true
                ]
        );

        $this->add_control(
                'fallback_image_custom', [
            'label' => esc_html__('Fallback Image Custom', 'cp-companion'),
            'type' => Controls_Manager::MEDIA,
            'condition' => [
                'fallback_image' => 'custom'
            ],
            'label_block' => true
                ]
        );

        $this->end_controls_section();


        /**
        * Featured Image settings
        */
        $this->start_controls_section(
            'section_featured_block',
            [
                'label' => esc_html__( 'Large Image Settings', 'cp-companion' ),
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'              => 'image_size_large',
                'label'             => esc_html__( 'Image Size', 'cp-companion' ),
                'default'           => 'punte-1920x1080',
            ]
        );

        
        $this->end_controls_section();

        /**
         * Content Tab: Query
         */
        $this->start_controls_section(
            'section_post_query',
            [
                'label'             => esc_html__( 'Query', 'cp-companion' ),
            ]
        );
        $this->add_group_control(
                Group_Control_Query::get_type(), [
            'name' => 'posts',
            'label' => esc_html__( 'Posts', 'cp-companion' ),
                ]
        );

        $this->end_controls_section();

        /**
        * Styling tab
        */
        $this->start_controls_section(
            'section_general_style',
            [
                'label' => esc_html__( 'Featured Slider Styles', 'cp-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label'     => esc_html__( 'Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .cp-blog-slider .cp-slider-preview-wrapp .content-wrapp .post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-blog-slider .cp-slider-preview-wrapp .content-wrapp .post-title a',
                
            ]
        );


        $this->add_control(
            'cat_color',
            [
                'label'     => esc_html__( 'Category Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .cp-blog-slider .cp-slider-preview-wrapp .content-wrapp .cat-links a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'cat_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-blog-slider .cp-slider-preview-wrapp .content-wrapp .cat-links a',
                
            ]
        );


        $this->add_control(
            'btn_link_style_title',
            [
                'label'     => esc_html__( 'Button Styles', 'cp-companion' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        //slider button normal
        $this->start_controls_tabs('tabs_style_btn');

        $this->start_controls_tab(
            'tab_style_normal',
            [
                'label' => esc_html__('Normal', 'punte-el-addons'),
            ]
        );

        
        $this->add_control(
            'button_link_color',
            [
                'label'     => esc_html__( 'Link Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-slider-preview-wrapp .content-wrapp a.btn-read-more' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label'     => esc_html__( 'Background Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-slider-preview-wrapp .content-wrapp a.btn-read-more' => 'background: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_style_hover',
            [
                'label' => esc_html__('Hover', 'punte-el-addons')
            ]
        );
         $this->add_control(
            'button_link_color_hover',
            [
                'label'     => esc_html__( 'Link Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-slider-preview-wrapp .content-wrapp a.btn-read-more:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'     => esc_html__( 'Background Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .cp-slider-preview-wrapp .content-wrapp a.btn-read-more:hover' => 'background: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'btn_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-slider-preview-wrapp .content-wrapp a.btn-read-more',
            ]
        );

        $this->end_controls_section();//end for main slide style

        /**
        * Slider tabs stlyes
        */
        $this->start_controls_section(
            'section_general_style_sm',
            [
                'label' => esc_html__( 'Slider Tabs Styles', 'cp-companion' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color_sm',
            [
                'label'     => esc_html__( 'Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .cp-blog-slider .cp-slider-thumb-wrapp .item-wrapp .post-title a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'title_typography_sm',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-blog-slider .cp-slider-thumb-wrapp .item-wrapp .post-title a',
                
            ]
        );


        $this->add_control(
            'cat_color_sm',
            [
                'label'     => esc_html__( 'Category Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .cp-blog-slider .cp-slider-thumb-wrapp .item-wrapp .cat-links a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'cat_typography_sm',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-blog-slider .cp-slider-thumb-wrapp .item-wrapp .cat-links a',
                
            ]
        );

         $this->add_control(
            'author_color',
            [
                'label'     => esc_html__( 'Post Author Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
               
                'selectors' => [
                    '{{WRAPPER}} .cp-blog-slider .cp-slider-thumb-wrapp .item-wrapp .post-meta a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'author_typography',
                'label'     => esc_html__( 'Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector'  => '{{WRAPPER}} .cp-blog-slider .cp-slider-thumb-wrapp .item-wrapp .post-meta a',
                
            ]
        );

        
        $this->end_controls_section();

        
    }

    protected function render() {
        $settings           = $this->get_settings_for_display();
        $posts_category_ids = $settings['posts_category_ids'];
        $no_of_post         = $settings['no_of_post'];
        
        
        $this->add_render_attribute( 'cp-attr', 'class', 'cp-blog-slider ' );
        
    ?>
    <div <?php echo $this->get_render_attribute_string('cp-attr')?> >
    <div class="module-inner-wrapp">
    <?php 
    $args = cp_ea_query($settings, $first_id = '',$no_of_post);
    $featured_posts = new \WP_Query( $args ); 
    echo '<div class="cp-slider-preview-wrapp">';

        if ( $featured_posts->have_posts() ) : while ($featured_posts->have_posts()) : $featured_posts->the_post();
            
            $this->get_featured_module_contents();
            
        endwhile; endif; wp_reset_postdata();
    echo '</div>';

    echo '<div class="cp-slider-thumb-wrapp">';
        if ( $featured_posts->have_posts() ) : while ($featured_posts->have_posts()) : $featured_posts->the_post();
                
                $this->get_current_module_contents_sm();
                
        endwhile; endif; wp_reset_postdata();
    echo '</div>';
    
    ?>
    </div>
    </div>
    <?php   

    }

    protected function get_current_loop_img($img_sz){
        $settings           = $this->get_settings();

        $image_alt = '';
        if ( has_post_thumbnail() ) {
            $image_id   = get_post_thumbnail_id( get_the_ID() );
            $thumb_url  = Group_Control_Image_Size::get_attachment_image_src( $image_id, $img_sz, $settings );
            $image_alt  = get_post_meta( $image_id, '_wp_attachment_image_alt', true );
            
        } else {
            if ( $settings['fallback_image'] == 'placeholder' ) {
                $thumb_url = Utils::get_placeholder_image_src();
            } elseif ( $settings['fallback_image'] == 'custom' && !empty( $settings['fallback_image_custom']['url'] ) ) {

                $custom_image_id = $settings['fallback_image_custom']['id'];
                $thumb_url = Group_Control_Image_Size::get_attachment_image_src( $custom_image_id, $img_sz, $settings );
                
            } else {
                $thumb_url = '';
            }
        }

        
        if(empty($thumb_url)){
            return;
        }
        ?>
        <div class="post-thumb-wrapp">
            <img src="<?php echo esc_url($thumb_url)?>" alt="<?php echo esc_attr($image_alt); ?>">
        </div>

    <?php }

    /**
    * large block image
    */
    protected function get_featured_module_contents(){
        $settings           = $this->get_settings();
        $posted_on          = get_the_date();
        $image_size_large   = 'image_size_large';
        
        ?>
        
        <div class="item-wrapp">
            <?php $this->get_current_loop_img($image_size_large); ?>
            <div class="content-wrapp">
                <?php do_action('cp_ea_single_cat'); ?>
                <h2 class="post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <a href="<?php the_permalink()?>" class="btn-read-more">
                    <?php esc_html_e('Read More','cp-companion'); ?>
                </a>
            </div>
        </div>
    <?php }

    /**
    * Small images
    */
    protected function get_current_module_contents_sm(){
        $settings           = $this->get_settings();
        $posted_on          = get_the_date();
        $image_size_small   = 'image_size_small';
        ?>
        <div class="item-wrapp">
            <div class="content-wrapp">
                <?php do_action('cp_ea_single_cat'); ?>
                <h2 class="post-title">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
                <div class="post-meta">
                   <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="post-author">
                        <?php echo esc_html( get_the_author() ); ?>
                    </a>
                </div>
            </div>
            <?php $this->get_current_loop_img($image_size_small); ?>
        </div>
    <?php }

   

   

    /**
     * Render widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @access protected
     */
    protected function _content_template() {}

}