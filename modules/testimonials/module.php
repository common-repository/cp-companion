<?php
namespace CpCompanion\Modules\Testimonials;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-testimonials';
	}

	public function get_widgets() {

		$widgets = [
			'Testimonials'
		];

		return $widgets;
	}
}
