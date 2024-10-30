<?php
namespace CpCompanion\Modules\BlogSlider;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-blog-slider';
	}

	public function get_widgets() {

		$widgets = [
			'Blog_Slider'
		];

		return $widgets;
	}
}
