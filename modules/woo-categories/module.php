<?php
namespace CpCompanion\Modules\WooCategories;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-woo-categories';
	}

	public function get_widgets() {

		$widgets = [
			'Woo_Categories'
		];

		return $widgets;
	}
}
