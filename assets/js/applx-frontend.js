(function ($) {
    "use strict";
  var isEditMode = false;

 	

  var rtoleft = false;
  if($('body').hasClass('rtl')){
      var rtoleft = true;
  }

/* --------------------------------------------------------------------------------------------------------------------------- */
/**
* Century Parallax Shop
*/
var APPshop = function( $scope, $){
  console.log('lasjdflasdjkl;asdjf');
	$('.cp-shop-wrapper .cp-product-wrapper').each(function (){
		$('.cp-shop-wrapper .cp-product-wrapper').not('.slick-initialized').slick({
		  	infinite: true,
		  	slidesToShow: 3,
		  	slidesToScroll: 3,
		  	arrows: false,
	  		rtl: rtoleft,
		  	dots: true,
		  	responsive: [
		    {
		      breakpoint: 768,
		      settings: {
		        slidesToShow: 2,
		        slidesToScroll: 2
		      }
		    },
		    {
		      breakpoint: 500,
		      settings: {
		        slidesToShow: 1,
		        slidesToScroll: 1
		      }
		    }
		  ]
		});
	});	
}

/* --------------------------------------------------------------------------------------------------------------------------- */
/**
* Century Parallax Progress Bar
*/
var APPprogress = function( $scope, $){
    $('.cp-progress-section').each(function() { 
        $(this).waypoint(function() {
            var progressWidth = $(this).find('.cp-progress-bar-percentage').data('value') + '%';
            $(this).find('.cp-progress-bar-percentage').css('width',0).animate({width: progressWidth}, 2000);
            $(this).find('.widget-percent').prop('Counter',0).animate({
               Counter: progressWidth,
            }, {
                duration: 2000,
                easing: 'swing',
                step: function (now) {
                   $(this).text(Math.ceil(now)+ '%');
                }
            });
        }, {
        offset: '100%',
        });
    }); 
}

var APPtestimonial = function( $scope, $){
    $('.cp-testimonial-slider-section').each(function() { 
        $(this).find('.cp-testimonial-slider-wrapper').not('.slick-initialized').slick({
          infinite: true,
          slidesToShow: 1,
          slidesToScroll: 1,
          arrows: false,
          rtl: rtoleft,
          dots: true,
      });
    }); 
}



 	$(window).on('elementor/frontend/init', function () {
        if(elementorFrontend.isEditMode()) {
            isEditMode = true;
        }        
        elementorFrontend.hooks.addAction('frontend/element_ready/applx-shop-slider.default', APPshop);
        elementorFrontend.hooks.addAction('frontend/element_ready/applx-progress-section.default', APPprogress);
        elementorFrontend.hooks.addAction('frontend/element_ready/applx-testimonial-slider.default', APPtestimonial);       
    });

}(jQuery));