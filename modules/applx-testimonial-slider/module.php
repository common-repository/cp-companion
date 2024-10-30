<?php
namespace CpCompanion\Modules\ApplxTestimonialSlider;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'applx-testimonial-slider';
	}

	public function get_widgets() {

		$widgets = [
			'Applx_Testimonial_Slider'
		];

		return $widgets;
	}
}
