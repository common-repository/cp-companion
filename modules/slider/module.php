<?php
namespace CpCompanion\Modules\Slider;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-slider';
	}

	public function get_widgets() {

		$widgets = [
			'Slider'
		];

		return $widgets;
	}
}
