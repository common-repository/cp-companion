<?php
namespace CpCompanion\Modules\PriceList;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-price-list';
	}

	public function get_widgets() {

		$widgets = [
			'Price_List'
		];

		return $widgets;
	}
}
