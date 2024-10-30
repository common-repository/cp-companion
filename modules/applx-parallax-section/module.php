<?php
namespace CpCompanion\Modules\ApplxParallaxSection;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'applx-parallax-section';
	}

	public function get_widgets() {

		$widgets = [
			'Applx_Parallax_Section'
		];

		return $widgets;
	}
}
