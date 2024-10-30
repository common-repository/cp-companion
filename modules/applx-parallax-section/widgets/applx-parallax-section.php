<?php
/**
 * Century Parallax Section
 *
 * @package    Century Plugin
 * @subpackage Century Parallax
 * @since      version 2.0.1
 */

namespace CpCompanion\Modules\ApplxParallaxSection\Widgets;

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


class Applx_Parallax_Section extends Widget_Base {

	/**
	 * Retrieve Century_Parallax_Elementor_Section widget name.
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'applx-parallax-section';
	}

	/**
	 * Retrieve Century_Parallax_Elementor_Section widget title.
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return esc_html__( 'CP: Parallax Section', 'cp-companion' );
	}

	/**
	 * Retrieve Century_Parallax_Elementor_Section widget icon.
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-section';
	}

	/**
	 * Retrieve the list of categories the Century_Parallax_Elementor_Section widget belongs to.
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
	 * Register Century_Parallax_Elementor_Section widget controls.
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
			'section_page',
			array(
				'label'       => esc_html__( 'Page:', 'cp-companion' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => century_parallax_page_lists()
			)
		);

        $this->add_control(
            'section_layout',
            [
                'label'     => esc_html__( 'Layout', 'cp-companion' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'layout1',
				'label_block' => true,
                'options'   => [
		            'default_template' => esc_html__( 'Default Template', 'cp-companion' ),
		            'service_template' => esc_html__( 'Service Template', 'cp-companion' ),
		            'team_template' => esc_html__( 'Team Template', 'cp-companion' ),
		            'portfolio_template' => esc_html__( 'Portfolio Template', 'cp-companion' ),
		            'testimonial_template' => esc_html__( 'Testimonial Template', 'cp-companion' ),
		            'blog_template' => esc_html__( 'Blog Template', 'cp-companion' ),
		            'action_template' => esc_html__( 'Action Template', 'cp-companion' ),
		            'googlemap_template' => esc_html__( 'Googlemap Template', 'cp-companion' ),
		            'blank_template' => esc_html__( 'Blank Template', 'cp-companion' ),
                ],
            ]
        );

		$this->add_control(
			'section_category',
			array(
				'label'       => esc_html__( 'Category:', 'cp-companion' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'options' => century_parallax_category_lists(),
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'section_layout',
                            'operator' => 'in',
                            'value' => [
					            'service_template',
					            'team_template',
					            'portfolio_template',
					            'testimonial_template',
					            'blog_template',
                            ],
                        ],
                    ],
                ],
			)
		);

		$this->add_control(
			'section_bgimage',
			array(
				'label'       => esc_html__( 'Background Image:', 'cp-companion' ),
                'type'        => Controls_Manager::MEDIA,
				'label_block' => true,
			)
		);

		$this->add_control(
			'section_overlay',
			array(
				'label'       => esc_html__( 'Overlay:', 'cp-companion' ),
				'type'        => Controls_Manager::SELECT,
				'label_block' => true,
				'default'	=> 'overlay0',
				'options' => [
		            'overlay0' => esc_html__( 'No Overlay', 'cp-companion' ),
		            'overlay1' => esc_html__( 'Small Dotted', 'cp-companion' ),
		            'overlay2' => esc_html__( 'Large Dotted', 'cp-companion' ),
		            'overlay3' => esc_html__( 'Light Black', 'cp-companion' ),
		            'overlay4' => esc_html__( 'Black Dotted', 'cp-companion' ),
                ],			)
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
            'section_title_color',
            [
                'label'     => esc_html__( 'Section Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mid-content h2' => 'color: {{VALUE}};',
                ],
            ]
        );

        //element title
        $this->add_control(
            'section_subtitle_color',
            [
                'label'     => esc_html__( 'Section Description Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mid-content .parallax-content .page-content' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'section_title_typography',
                'label'     => esc_html__( 'Section Title Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .mid-content h2',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'section_subtitle_typography',
                'label'     => esc_html__( 'Section Description Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .mid-content .parallax-content .page-content',
            ]
        );

        //element title
        $this->add_control(
            'content_title_color',
            [
                'label'     => esc_html__( 'Content Title Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-detail h3, {{WRAPPER}} .portfolio-list h3, {{WRAPPER}} .testimonial-list h3, {{WRAPPER}} .blog-excerpt h3' => 'color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'section_layout',
                            'operator' => 'in',
                            'value' => [
					            'service_template',
					            'team_template',
					            'portfolio_template',
					            'testimonial_template',
					            'blog_template',
                            ],
                        ],
                    ],
                ],
            ]
        );

        //element title
        $this->add_control(
            'content_subtitle_color',
            [
                'label'     => esc_html__( 'Content Description Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .service-detail .service-content, {{WRAPPER}} .testimonial-content, {{WRAPPER}} .blog-excerpt' => 'color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'section_layout',
                            'operator' => 'in',
                            'value' => [
					            'service_template',
					            'team_template',
					            'testimonial_template',
					            'blog_template',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_title_typography',
                'label'     => esc_html__( 'Content Title Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .service-detail h3, {{WRAPPER}} .portfolio-list h3, {{WRAPPER}} .testimonial-list h3, {{WRAPPER}} .blog-excerpt h3',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'section_layout',
                            'operator' => 'in',
                            'value' => [
					            'service_template',
					            'team_template',
					            'portfolio_template',
					            'testimonial_template',
					            'blog_template',
                            ],
                        ],
                    ],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'      => 'content_subtitle_typography',
                'label'     => esc_html__( 'Content Description Typography', 'cp-companion' ),
                'scheme'    => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}} .service-detail .service-content, {{WRAPPER}} .testimonial-content, {{WRAPPER}} .blog-excerpt',
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'section_layout',
                            'operator' => 'in',
                            'value' => [
					            'service_template',
					            'team_template',
					            'testimonial_template',
					            'blog_template',
                            ],
                        ],
                    ],
                ],
            ]
        );

        //element title
        $this->add_control(
            'content_button_color',
            [
                'label'     => esc_html__( 'Button Color', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-caption .caption-description a, {{WRAPPER}} .btn, {{WRAPPER}} .call-to-action a' => 'color: {{VALUE}};border-color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'section_layout',
                            'operator' => 'in',
                            'value' => [
					            'blog_template',
					            'action_template',
                            ],
                        ],
                    ],
                ],
            ]
        );

        //element title
        $this->add_control(
            'content_button_color_hover',
            [
                'label'     => esc_html__( 'Button Color: Hover', 'cp-companion' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slider-caption .caption-description a:hover, {{WRAPPER}} .btn:hover, {{WRAPPER}} .call-to-action a:hover' => 'background-color: {{VALUE}};border-color: {{VALUE}};',
                ],
                'conditions' => [
                    'terms' => [
                        [
                            'name' => 'section_layout',
                            'operator' => 'in',
                            'value' => [
					            'blog_template',
					            'action_template',
                            ],
                        ],
                    ],
                ],
            ]
        );


        $this->end_controls_section();//end for styling tab
	}
	/**
	 * Render Century_Parallax_Elementor_Section widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @access protected
	 */
	protected function render() {
        $settings = $this->get_settings();

        $this->add_render_attribute( 'century-parallax-element-section', 'class', 'century-parallax-element-section' );
        $page = isset( $settings[ 'section_page' ] )? $settings[ 'section_page' ] : '';
        $image = isset( $settings[ 'section_bgimage' ]['url'] )? $settings[ 'section_bgimage' ]['url'] : '';
        $layout = isset( $settings[ 'section_layout' ] )? $settings[ 'section_layout' ] : '';
        $category = isset( $settings[ 'section_category' ] )? $settings[ 'section_category' ] : '';
        $googlemapclass = $layout == "googlemap_template" ? " google-map" : "";
        $overlay = isset( $settings[ 'section_overlay' ] )? $settings[ 'section_overlay' ] : 'overlay0';
        $style = isset( $settings[ 'section_bgimage' ]['url'] )? $settings[ 'section_bgimage' ]['url'] : '';
        $style_class = 'style="background:url(' . $style . ')  no-repeat fixed top center;background-size:auto"';
        ?>
        <div <?php echo $this->get_render_attribute_string( 'century-parallax-element-section' ); ?>>
            <?php
	        if ( !empty( $page ) ) :
	            ?>
	            <section class="parallax-section clearfix<?php echo esc_attr( $googlemapclass ) . " " . esc_attr( $layout ); ?>" id="<?php echo "section-" . absint( $page ); ?>" <?php echo $style_class;?> >
	                <?php if ( !empty( $image ) && $overlay != "overlay0" ) : ?>
	                    <div class="overlay"></div>
	                <?php endif; ?>

	                <?php if ( $layout != "googlemap_template" ) : ?>
	                    <div class="mid-content">
	                    <?php endif;
	                    $query = new \WP_Query( 'page_id=' . $page );
	                    while ( $query->have_posts() ) : $query->the_post();

	                        if ( $layout != "action_template" && $layout != "blank_template" && $layout != "googlemap_template" ):
	                            ?>
	                            <h2><span><?php the_title(); ?></span></h2>

	                            <div class="parallax-content">
	                                <?php if ( get_the_content() != "" ) : ?>
	                                    <div class="page-content">
	                                        <?php the_content(); ?>
	                                    </div>
	                                <?php endif; ?>
	                            </div> 
	                            <?php
	                        endif;

	                    endwhile;
	                    ?>

	                    <?php
	                    switch ( $layout ) {
	                        case 'default_template':
	                               echo '<div class="content-area"></div>';
	                            break;

	                        case 'service_template':
	                               $this->service_section();
	                            break;

	                        case 'team_template':
	                                $this->team_section();
	                            break;

	                        case 'portfolio_template':
	                               $this->portfolio_section();
	                            break;

	                        case 'testimonial_template':
	                               $this->testimonial_section();
	                            break;

	                        case 'action_template':
	                            $this->action_section();
	                            break;

	                        case 'blank_template':
	                            echo '<div class="content-area blank-section"></div>';
	                            break;

	                        case 'googlemap_template':
	                               $this->google_map_section();
	                            break;

	                        case 'blog_template':
                                  $this->blog_section();
	                            break;

	                        default:
	                            echo '<div class="content-area"></div>';
	                            break;
	                    }
	                  
                        if ( $layout != "googlemap_template" ) : ?>
	                    </div>
	                <?php endif; ?>
	            </section>
	            <?php
	        endif;?>
        </div><!-- element main wrapper -->
<?php
	}



    public function action_section(){
        $settings = $this->get_settings();
        ?>
        <div class="call-to-action">
            <?php
            $query = new \WP_Query( 'page_id=' . $settings[ 'section_page' ] );
            while ( $query->have_posts() ) : $query->the_post();
                ?>
                <h2><?php the_title(); ?></h2>

                <div class="parallax-content">
                    <?php if ( get_the_content() != "" ) : ?>
                        <div class="page-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <?php 
    }




    /**
    * Blog Section
    *
    */
    public function blog_section(){
        $settings = $this->get_settings();
        $category = isset( $settings[ 'section_category' ] )? $settings[ 'section_category' ] : '';
    ?>
    <div class="blog-listing clearfix">
        <?php
        $args = array(
            'cat' => $category,
            'posts_per_page' => 3
        );

        $query = new \WP_Query( $args );
        if ( $query->have_posts() ):
            $i = 0;
            while ( $query->have_posts() ): $query->the_post();
                $i = $i + 0.25;
                ?>

                <a href="<?php the_permalink(); ?>" class="blog-list wow fadeInDown" data-wow-delay="<?php echo esc_attr( $i ); ?>s">
                    <div class="blog-image">
                        <?php
                        if ( has_post_thumbnail() ) :
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'blog-thumbnail' );
                            ?>
                            <img src="<?php echo esc_url( $image[ 0 ] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                        <?php else: ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.jpg' ) ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="blog-excerpt">
                        <h3><?php the_title(); ?></h3>
                        <h4 class="posted-date"><i class="fa fa-calendar"></i><?php echo get_the_date(); ?></h4>
                        <?php echo century_letter_count( get_the_excerpt(), 200 );  // WPCS: XSS OK.   ?> <br />
                        <span><?php esc_html_e( 'Read More', 'cp-companion' ) ?>&nbsp;&nbsp;<i class="fa fa-angle-right"></i></span>
                    </div>
                </a>

                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>

    <div class="clearfix btn-wrap">
        <a class="btn" href="<?php echo esc_url( get_category_link( $category ) ) ?>"><?php esc_html_e( 'Read All', 'cp-companion' ); ?></a>
    </div>
    <?php 
    }

    /**
    * Google Map Section
    *
    */
    public function google_map_section(){
        $settings = $this->get_settings();
        ?>
        <div class="content-area googlemap-section">
            <div class="googlemap-toggle"><?php esc_html_e( 'Map', 'cp-companion' ); ?></div>

            <?php
            $query = new \WP_Query( 'page_id=' . $settings[ 'section_page' ] );
            while ( $query->have_posts() ) : $query->the_post();
                ?>

                <div class="googlemap-content">
                    <?php the_content(); ?>
                </div>

                <?php
            endwhile;
            wp_reset_postdata();
            ?>
        </div>
        <?php 
    }




    /**
    * Portfolio section
    *
    *
    */
    public function portfolio_section(){
        $settings = $this->get_settings();
        $category = isset( $settings[ 'section_category' ] )? $settings[ 'section_category' ] : '';
    ?>
        <div class="portfolio-listing clearfix">
            <?php
            $args = array(
                'cat' => $category,
                'posts_per_page' => -1
            );

            $query = new \WP_Query( $args );
            if ( $query->have_posts() ):
                $i = 0;
                while ( $query->have_posts() ): $query->the_post();
                    $i = $i + 0.15;
                    ?>

                    <a href="<?php the_permalink(); ?>" class="portfolio-list wow fadeInUp" data-wow-delay="<?php echo esc_attr( $i ); ?>s">
                        <div class="portfolio-wrap">
                            <div class="portfolio-overlay"><span>+</span></div>
                            <div class="portfolio-image">
                                <?php
                                if ( has_post_thumbnail() ) :
                                    $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'portfolio-thumbnail' );
                                    ?>
                                    <img src="<?php echo esc_url( $image[ 0 ] ); ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                                <?php else: ?>
                                    <img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.jpg' ) ?>" alt="<?php echo esc_attr( get_the_title() ); ?>">
                                <?php endif; ?>
                            </div>
                            <h3><?php the_title(); ?></h3>
                        </div>
                    </a>

                    <?php
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>
    <?php 
    }



    /**
    * Service Section
    *
    *
    */
    public function service_section(){
        $settings = $this->get_settings();
        $category = isset( $settings[ 'section_category' ] )? $settings[ 'section_category' ] : '';
    ?>
    <div class="service-listing clearfix">
        <?php
        $args = array(
            'cat' => $category,
            'posts_per_page' => -1
        );
        $count_service = 0;
        $query = new \WP_Query( $args );
        if ( $query->have_posts() ):
            $i = 0;
            while ( $query->have_posts() ): $query->the_post();
                $i = $i + 0.25;
                $count_service++;
                $service_class = ($count_service % 2 == 0) ? "even wow fadeInRight" : "odd wow fadeInLeft";
                ?>

                <div class="clearfix service-list <?php echo esc_attr( $service_class ); ?>" data-wow-delay="<?php echo esc_attr( $i ); ?>s">
                    <div class="service-image">
                        <?php
                        if ( has_post_thumbnail() ) :
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                            ?>
                            <img src="<?php echo esc_url( $image[ 0 ] ); ?>" alt="<?php the_title(); ?>">
                        <?php else: ?>
                            <img src="<?php echo esc_url( get_template_directory_uri() . '/images/no-image.jpg' ) ?>" alt="<?php the_title(); ?>">
                        <?php endif; ?>
                    </div>

                    <div class="service-detail">
                        <h3><?php the_title(); ?></h3>
                        <div class="service-content"><?php the_content(); ?></div>
                    </div>
                </div>

                <?php if ( $count_service % 2 == 0 ): ?>
                    <div class="clearfix"></div>
                <?php endif;
                ?>

                <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <?php 
    }



    /***
    * Team Section
    *
    *
    */
    public function team_section(){
        $settings = $this->get_settings();
        $category = isset( $settings[ 'section_category' ] )? $settings[ 'section_category' ] : '';
    ?>
    <div class="team-listing clearfix">
        <?php
        $args = array(
            'cat' => $category,
            'posts_per_page' => -1
        );
        $query = new \WP_Query( $args );
        if ( $query->have_posts() ):
            ?>
            <div class="team-tab">
                <div class="team-slider">
                    <?php
                    $i = 0;
                    while ( $query->have_posts() ): $query->the_post();
                        $i = $i + 0.25;
                        ?>

                        <div class="clearfix team-image wow fadeInLeft" data-wow-delay="<?php echo esc_attr( $i ); ?>s">
                            <?php
                            if ( has_post_thumbnail() ) :
                                $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                                ?>
                                <img src="<?php echo esc_url( $image[ 0 ] ); ?>" alt="<?php the_title(); ?>">
                            <?php else: ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/dummy.png' ) ?>" alt="<?php the_title(); ?>">
                            <?php endif; ?>
                        </div>

                        <?php
                    endwhile;
                    wp_reset_postdata();
                    ?>
                </div>
            </div>
            <?php
        endif;
       
        $args = array(
            'cat' => $category,
            'posts_per_page' => -1
        );
        $query = new \WP_Query( $args );
        if ( $query->have_posts() ):
            ?>
            <div class="team-content wow fadeIn" data-wow-delay="1.5s">
                <?php
                while ( $query->have_posts() ): $query->the_post();
                    ?>

                    <div class="clearfix team-list team-<?php echo get_the_ID(); ?>">
                        <?php
                        if ( has_post_thumbnail() ) :
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'team-thumbnail' );
                            ?>
                            <div class="team-big-image">
                                <img src="<?php echo esc_url( $image[ 0 ] ); ?>" alt="<?php the_title(); ?>">
                            </div>
                        <?php endif; ?>

                        <div class="team-detail">
                            <h3><?php the_title(); ?></h3>
                            <?php the_content(); ?>
                        </div>
                    </div>

                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
            <?php endif; ?>
    </div>
    <?php 
    }

   

   /**
   * Testimonial Section
   *
   *
   */
   public function testimonial_section(){
    $settings = $this->get_settings();
    $category = isset( $settings[ 'section_category' ] )? $settings[ 'section_category' ] : '';
    ?>
    <div class="testimonial-listing clearfix wow fadeInUp">
        <?php
        $args = array(
            'cat' => $category,
            'posts_per_page' => -1
        );
        $query = new \WP_Query( $args );
        if ( $query->have_posts() ):
            ?>
            <div class="testimonial-slider">
                <?php
                while ( $query->have_posts() ): $query->the_post();
                    ?>

                    <div class="testimonial-list">

                        <div class="testimonial-content"><?php the_content(); ?></div>
                        <h3><?php the_title(); ?></h3>
                        <?php
                        if ( has_post_thumbnail() ) :
                            $image = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'thumbnail' );
                            ?>
                            <div class="testimonial-image">
                                <img src="<?php echo esc_url( $image[ 0 ] ); ?>" alt="<?php the_title(); ?>">
                            </div>
                        <?php endif; ?>

                    </div>

                    <?php
                endwhile;
                wp_reset_postdata();
                ?>
            </div>
        <?php endif; ?>
    </div>
    <?php
   }


} 