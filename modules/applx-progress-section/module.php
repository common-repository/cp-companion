<?php
namespace CpCompanion\Modules\ApplxProgressSection;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'applx-progress-section';
	}

	public function get_widgets() {

		$widgets = [
			'Applx_Progress_Section'
		];

		return $widgets;
	}
}
