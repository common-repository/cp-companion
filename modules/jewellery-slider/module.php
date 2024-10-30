<?php
namespace CpCompanion\Modules\JewellerySlider;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-jewellery-slider-product';
	}

	public function get_widgets() {

		$widgets = [
			'Jewellery_Slider'
		];

		return $widgets;
	}
}
