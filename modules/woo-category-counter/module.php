<?php
namespace CpCompanion\Modules\WooCategoryCounter;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-woo-category-counter';
	}

	public function get_widgets() {

		$widgets = [
			'Woo_Category_Counter'
		];

		return $widgets;
	}
}
