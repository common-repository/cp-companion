<?php
namespace CpCompanion\Modules\HeaderIcons\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Header_Icons extends Widget_Base {

   
  public function get_name() {
      return 'cp-header-icon';
   }

  public function get_title() {
      return esc_html__( 'Header Icons', 'cp-companion' );
   }

   public function get_icon() {
      return 'cp-ea-icons cp-header-icon';
   }
   public function get_categories() {
      return [ 'cp-elements' ];
   }
   


   protected function _register_controls() {

      $this->start_controls_section(
         'opstore_sections_list',
         [
            'label' => esc_html__( 'Display Settings', 'cp-companion' )
         ]
      ); 

      $this->add_control(
         'icon_type',
         [
            'label' => esc_html__( 'Icon Type', 'cp-companion' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
                       'search'   => esc_html__('Search','cp-companion'),
                       'cart'     => esc_html__('Cart','cp-companion'),
                       'wishlist' => esc_html__('Wishlist','cp-companion'),
                       'compare'  => esc_html__('Compare','cp-companion'),
                       'user'     => esc_html__('User Account','cp-companion'),
            ],
            'default' => 'search'
         ]
      );


      $this->add_control(
         'header_icon',
      [
      'label' => esc_html__( 'Choose Icon', 'cp-companion' ),
      'type' => Controls_Manager::ICONS,
      'default' => [
          'value'=>'fas fa-search',
          'library'=>'solid',
      ],      
      ]
      );


      $this->end_controls_section();



      $this->start_controls_section(
         'icon_styles',
         [
            'label' => esc_html__( 'Icon Styles', 'cp-companion' ),
            'tab' => Controls_Manager::TAB_STYLE
         ]
      );

  $this->add_control(
    'align_items',
    [
      'label'                 => __( 'Align', 'cp-companion' ),
      'type'                  => Controls_Manager::CHOOSE,
      'label_block'           => false,
      'options'               => [
        'text-left' => [
          'title' => __( 'Left', 'cp-companion' ),
          'icon' => 'eicon-h-align-left',
        ],
        'text-center' => [
          'title' => __( 'Center', 'cp-companion' ),
          'icon' => 'eicon-h-align-center',
        ],
        'text-right' => [
          'title' => __( 'Right', 'cp-companion' ),
          'icon' => 'eicon-h-align-right',
        ],
      ],
      'default' => 'text-center'
    ]
  );

      $this->add_responsive_control(
         'font_size',
         [
         'label' => esc_html__( 'Font Size', 'cp-companion' ),
         'type' => Controls_Manager::NUMBER,
         'default' => 20,
        'selectors' => [
           '{{WRAPPER}} .icon' => 'font-size: {{VALUE}}px',
        ]
         ]
      );

      $this->start_controls_tabs( 'icon_colors' );

      $this->start_controls_tab( 'normal', [ 'label' => esc_html__( 'Normal', 'cp-companion' ) ] );
      $this->add_control(
         'icon_color',
         [
            'label' => esc_html__( 'Icon Color', 'cp-companion' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#000',
            'selectors' => [
               '{{WRAPPER}} .icon, {{WRAPPER}} .total-price' => 'color: {{VALUE}}',
            ]

         ]
      );

      $this->end_controls_tab();

      $this->start_controls_tab( 'hover', [ 'label' => esc_html__( 'Hover', 'cp-companion' ) ] );
      $this->add_control(
         'icon_hover_color',
         [
            'label' => esc_html__( 'Hover Color', 'cp-companion' ),
            'type' => Controls_Manager::COLOR,
            'default' => '#89c350',
            'selectors' => [
               '{{WRAPPER}} .icon:hover' => 'color: {{VALUE}}',
               '{{WRAPPER}} span.wishlist-count.wishlist-rounded, {{WRAPPER}} .cart-icon .count, {{WRAPPER}} .compare-icon' => 'background: {{VALUE}}'
            ]

         ]
      );

      $this->end_controls_tab();

      $this->end_controls_tabs();      
      $this->end_controls_section();
   }

   protected function render( ) {

      // get our input from the widget settings.
      $settings = $this->get_settings();

        $icon_type    = $settings['icon_type'];
        $icon         = $settings['header_icon'];
        $align_items  = $settings['align_items'];
        

        global $woocommerce;  

        if($icon_type == 'cart'){
            if( function_exists('WC')): ?>
              <div class="cp-site-header-cart menu <?php echo esc_attr($class);?>">
                <div class="header-cart cart-icon <?php echo esc_attr($align_items);?>">
                    <a href="#" data-toggle="dropdown" title="<?php echo esc_attr__('cart','cp-companion'); ?>">
                        <span class="count rounded-crcl"></span>
                        <?php Icons_Manager::render_icon( $icon ); ?>
                    </a>
                </div>
              </div>
            <?php endif;
        }elseif( ($icon_type == 'compare') && class_exists('YITH_WOOCOMPARE') ){
          global $yith_woocompare;
          
          $sm_yith_count = isset($yith_woocompare->obj->products_list) ? $yith_woocompare->obj->products_list : 0;
          $sm_yith_count = count($sm_yith_count);
          ?>
          <div class="cp-header-compare-btn <?php echo esc_attr($align_items);?>">
              <a class="yith-contents yith-woocompare-open" href="#" title="<?php esc_attr_e('My Compare','opstore')?>">
                  <?php Icons_Manager::render_icon( $icon ); ?>
                  <span class="compare-icon">
                      <?php echo absint($sm_yith_count); ?>
                  </span>
              </a>
          </div>
          <?php

        }elseif($icon_type == 'wishlist'){
            if( function_exists('yith_wishlist_constructor') ):
                $wishlist_page = get_option('yith_wcwl_wishlist_page_id');
                $link = '#';
                if( $wishlist_page ) {
                    $link = get_permalink( $wishlist_page );
                }
                $wishlist_count = YITH_WCWL()->count_products();
                ?>
                <div class="cp-header-wishlist-icon <?php echo esc_attr($align_items);?>">
                    <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr__('wishlist','cp-companion');?>">
                        <?php  ?>
                        <span class="wishlist-count wishlist-rounded"><?php echo esc_attr( $wishlist_count ); ?></span>
                        <?php  Icons_Manager::render_icon( $icon ); ?>
                    </a>
                </div>
                <?php
            endif;
        }elseif($icon_type == 'user'){
            if( function_exists( 'WC' ) ){  ?>
                    <div class="cp-header-login <?php echo esc_attr($align_items);?>"> 
                        <a href="<?php echo esc_url( get_permalink( get_option('woocommerce_myaccount_page_id') ) ); ?>" class="btn-login" >
                            <?php Icons_Manager::render_icon( $icon ); ?>
                            </a>
                    </div>
            <?php }   
        }elseif($icon_type == 'search'){ ?>

            <div class="cp-header-searchbox <?php echo esc_attr($align_items);?>">
              <span class="searchbox-icon">
                <?php  Icons_Manager::render_icon( $icon ); ?>
              </span>
              <div class="search-form-wrapp">
                <div class="search-close"><i class="fa fa-times-circle-o" aria-hidden="true"></i></div>
                <?php  get_search_form();?>
              </div>
            </div>
        <?php
        }
   }

   /**
     * Render widget output in the editor.
     *
     * Written as a Backbone JavaScript template and used to generate the live preview.
     *
     * @access protected
     */
  protected function _content_template() {

  }



   

}