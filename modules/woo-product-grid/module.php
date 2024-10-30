<?php
namespace CpCompanion\Modules\WooProductGrid;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-woo-product-grid';
	}

	public function get_widgets() {

		$widgets = [
			'Woo_Product_Grid'
		];

		return $widgets;
	}
}
