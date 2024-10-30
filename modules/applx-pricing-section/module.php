<?php
namespace CpCompanion\Modules\ApplxPricingSection;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'applx-pricing-section';
	}

	public function get_widgets() {

		$widgets = [
			'Applx_Pricing_Section'
		];

		return $widgets;
	}
}
