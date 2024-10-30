<?php
namespace CpCompanion\Modules\JewelleryTrending;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-jewellery-trending';
	}

	public function get_widgets() {

		$widgets = [
			'Jewellery_Trending'
		];

		return $widgets;
	}
}
