<?php
namespace CpCompanion\Modules\FeatureInfo;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-feature-info';
	}

	public function get_widgets() {

		$widgets = [
			'Feature_Info'
		];

		return $widgets;
	}
}
