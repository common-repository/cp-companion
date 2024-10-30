(function ($, elementor) {
  "use strict";
  var CpElements = {

    init: function () {

      var widgets = {
        'cp-slider.default': CpElements.cpSlider,
        'cp-slider2.default': CpElements.cpSlider2,
        'cp-testimonials.default': CpElements.cpTestimonials,
        'cp-team.default': CpElements.cpTeam,
        'cp-ytvideosl.default': CpElements.cpYtvideosl,
        'cp-services.default': CpElements.cpServices,
        'cp-blog-post.default': CpElements.cpBlogPosts,
        'cp-blog-slider.default': CpElements.cpBlogSlider,
        'cp-navbar.default': CpElements.cpNavbar,
        'cp-header-icon.default': CpElements.cpHeaderIcons,
        'cp-offcanvas.default': CpElements.cpOffcanvas,
        'cp-woo-categories.default': CpElements.cpWooCategories,
        'cp-jewellery-slider-product.default': CpElements.cpProductSlider

      };

      $.each(widgets, function (widget, callback) {
        elementor.hooks.addAction('frontend/element_ready/' + widget, callback);
      });
      elementor.hooks.addAction( 'frontend/element_ready/section', CpElements.elementorSection );

    },

    cpProductSlider: function( $scope ) {
        
        
        var $section   = $scope;
        $.each($section, function( index ) {
        var $element      = $(this),
        $elementFound = $element.find('.sml-jewellery-wrap .sml-jewell-products ul');

        if ($elementFound.length) {
          $elementFound.not('.slick-initialized').slick({
            infinite: true,
            slidesToShow: 3,
            slidesToScroll: 3,
            arrows: false,
            dots: true,
            responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
              },
              {
                breakpoint: 966,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                }
              },
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                }
              },
              ]
          });
        }
        });
           
    },


    cpSlider: function ($scope) {

      var arrowsVal = $('.cp-companion-slider .slider-wrapp').attr('data-arrow');
      var pagerVal  = $('.cp-companion-slider .slider-wrapp').attr('data-pager');

      if( arrowsVal === 'yes' ){
        arrowsVal = true;
      }else{
        arrowsVal = false;
      }

      if( pagerVal === 'yes' ){
        pagerVal = true;
      }else{
        pagerVal = false;
      }

      $('.cp-companion-slider .slider-wrapp').each(function () {
        $(this).not('.slick-initialized').slick({
          infinite: true,
          arrows: arrowsVal,
          dots: pagerVal
        });
      });

    },

        /**
        * slider 2
        */
        cpSlider2: function ($scope) {

          var arrowsVal = $('.cp-companion-slider2 .slider-wrapp').attr('data-arrow');
          var pagerVal  = $('.cp-companion-slider2 .slider-wrapp').attr('data-pager');

          if( arrowsVal === 'yes' ){
            arrowsVal = true;
          }else{
            arrowsVal = false;
          }

          if( pagerVal === 'yes' ){
            pagerVal = true;
          }else{
            pagerVal = false;
          }

          $('.cp-companion-slider2 .slider-wrapp').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: arrowsVal,
              dots: pagerVal
            });
          });

        },

         /**
        * testimonial slider
        */
        cpTestimonials: function ($scope) {

          $('.cp-companion-testimonials.default .slider-wrapp').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: false,
              dots: true,
              slidesToShow: 3,
              slidesToScroll: 3,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
              },
              {
                breakpoint: 769,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                }
              },
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                }
              },
              ]
            });
          });

          $('.cp-companion-testimonials.layout2 .slider-wrapp').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: false,
              dots: true,
              slidesToShow: 2,
              slidesToScroll: 1,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
              }
              ]
            });
          });
          $('.cp-companion-testimonials.layout4 .slider-wrapp').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: false,
              dots: true,
              slidesToShow: 1,
              slidesToScroll: 1
            });
          });
          $('.cp-companion-testimonials.layout3 .slider-wrapp').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: false,
              dots: true,
              slidesToShow: 2,
              slidesToScroll: 1,
              responsive: [
              {
                breakpoint: 500,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
              }
              ]
            });
          });
          $('.cp-companion-testimonials.layout5 .slider-wrapp').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: false,
              dots: true,
              slidesToShow: 1,
              slidesToScroll: 1,
            });
          });
        },

        cpTeam: function ($scope) {

          $('.cp-companion-team.default .slider-wrapp').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: true,
              dots: false,
              slidesToShow: 3,
              slidesToScroll: 3,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
              },
              {
                breakpoint: 769,
                settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                }
              },
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                  slidesToScroll: 3,
                }
              },
              ]
            });
          });

        },

        cpYtvideosl: function ($scope) {

          $('.cp-companion-ytvideosl.lay-slider .cp-companion-video-thumbnails').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: true,
              dots: false,
              slidesToShow: 2,
              slidesToScroll: 2,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                  slidesToScroll: 1,
                }
              },
              ]
            });
          });

        },

        cpServices: function ($scope) {

          $('.cp-companion-services.default .slider-wrapp').each(function () {
            
            var sliderCount = $(this).attr('data-count');

            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: true,
              dots: false,
              slidesToShow: sliderCount,
              slidesToScroll: 1,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                }
              },
              {
                breakpoint: 769,
                settings: {
                  slidesToShow: 2,
                }
              },
              {
                breakpoint: 1024,
                settings: {
                  slidesToShow: 3,
                }
              },
              ]
            });
          });

          $('.cp-companion-services.layout2 .slider-wrapp').each(function () {
            var sliderCount = $(this).attr('data-count');
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: false,
              dots: true,
              slidesToShow: sliderCount,
              slidesToScroll: 1,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                }
              },
              {
                breakpoint: 769,
                settings: {
                  slidesToShow: 2,
                }
              },
              ]
            });
          });

          $('.cp-companion-services.layout3 .slider-wrapp').each(function () {
            var sliderCount = $(this).attr('data-count');
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: true,
              dots: false,
              slidesToShow: sliderCount,
              slidesToScroll: 1,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                }
              },
              {
                breakpoint: 769,
                settings: {
                  slidesToShow: 2,
                }
              },
              ]
            });
          });
          $('.cp-companion-services.layout4 .slider-wrapp').each(function () {
            var sliderCount = $(this).attr('data-count');
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: true,
              dots: false,
              slidesToShow: sliderCount,
              slidesToScroll: 1,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                }
              },
              ]
            });
          });

        },

        cpBlogPosts: function ($scope) {

          $('.cp-blog-post-main-wrapp.style6').each(function () {
            $(this).not('.slick-initialized').slick({
              infinite: true,
              arrows: false,
              dots: true,
              slidesToShow: 3,
              slidesToScroll: 1,
              responsive: [
              {
                breakpoint: 426,
                settings: {
                  slidesToShow: 1,
                }
              },
              {
                breakpoint: 769,
                settings: {
                  slidesToShow: 2,
                }
              },
              ]
            });
          });

        },

        cpBlogSlider: function($scope){


          $('.cp-blog-slider .cp-slider-preview-wrapp').not('.slick-initialized').slick({
            slidesToShow: 1,
            slidesToScroll: 1,
            fade: true,
            asNavFor: '.cp-blog-slider .cp-slider-thumb-wrapp'
          })



          $('.cp-blog-slider .cp-slider-thumb-wrapp').not('.slick-initialized').slick({
            slidesToShow: 3,
            slidesToScroll: 3,
            asNavFor: '.cp-blog-slider .cp-slider-preview-wrapp',
            dots: false,
            centerMode: false,
            centerPadding: 0,
            focusOnSelect: true,
            vertical: true,
            responsive: [
            {
              breakpoint: 1366,
              settings: {
                slidesToShow: 3,
                slidesToScroll: 3,
                infinite: true,
              }
            },
            {
              breakpoint: 966,
              settings: {
                slidesToShow: 2,
                slidesToScroll: 1
              }
            },
            {
              breakpoint: 480,
              settings: {
                slidesToShow: 1,
                slidesToScroll: 1
              }
            }

            ]
          });
        },

        cpNavbar: function( $scope ) {

          jQuery(document).ready(function ($) {
            if ($('#cp-mob-side-nav').length > 0) {
              var $menu = $("#cp-mob-side-nav").mmenu({
                "extensions": [
                "pagedim-black",
                "border-full",
                "multiline",
                "effect-listitems-slide",
                "theme-dark"
                ]
              });
              var API = $menu.data("mmenu");

              var $icon = $(".cp-nav-icon");

              $icon.on("click", function () {
                $('.mm-page').removeAttr('style');
                API.open();
              });

              API.bind("opened", function () {
                setTimeout(function () {
                  $icon.addClass("is-active");

                }, 100);
              });

              API.bind("closed", function () {
                setTimeout(function () {
                  $icon.removeClass("is-active");
                  $('.mm-page').removeAttr('style');
                }, 100);
              });
            }
          });


        },

        cpHeaderIcons: function( $scope ) {

          $('body') .on('click','.cp-header-searchbox .searchbox-icon', function(){
            $('.cp-header-searchbox').toggleClass('active');
          });

          $('body') .on('click','.cp-header-searchbox .search-close', function(){
            $('.cp-header-searchbox').toggleClass('active');
          });

        },

        cpOffcanvas: function( $scope ) {

          $('body') .on('click','.cp-offcanvas-button,.cp-offcanvas-close', function(){
            $('.cp-offcanvas').toggleClass('active');
          });


        },


        cpWooCategories: function( $scope ) {

           var $section   = $scope;

            $.each($section, function( index ) {
            var $element      = $(this),
            $elementFound = $element.find('.cp-woo-categories .menu-title');

            if ($elementFound.length) {
               $elementFound.click(function(){
                
                $(this).toggleClass('active');
                $(this).next('.menus-wrapp').toggleClass('active');
              });
           }
            
          });


          


        },


        elementorSection: function( $scope ) {

          var $section   = $scope,
          instance   = null,
          sectionID  = $section.data('id');

          //sticky fixes for inner section.
          $.each($section, function( index ) {
            var $sticky      = $(this),
            $stickyFound = $sticky.find('.elementor-element.cp-sticky-bar');

            if ($stickyFound.length) {
              $stickyFound.stickySidebar({
                topSpacing: 10,
                bottomSpacing: 10
              });

            }
          });
        }

      


      };

      $(window).on('elementor/frontend/init', CpElements.init);

    }(jQuery, window.elementorFrontend));
