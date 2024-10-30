<?php
namespace CpCompanion\Modules\ApplxShopSlider;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'applx-shop-slider';
	}

	public function get_widgets() {

		$widgets = [
			'Applx_Shop_Slider'
		];

		return $widgets;
	}
}
