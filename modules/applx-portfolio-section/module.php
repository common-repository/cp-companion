<?php
namespace CpCompanion\Modules\ApplxPortfolioSection;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'applx-portfolio-section';
	}

	public function get_widgets() {

		$widgets = [
			'Applx_Portfolio_Section'
		];

		return $widgets;
	}
}
