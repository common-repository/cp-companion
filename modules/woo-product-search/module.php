<?php
namespace CpCompanion\Modules\WooProductSearch;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-woo-product-search';
	}

	public function get_widgets() {

		$widgets = [
			'Woo_Product_Search'
		];

		return $widgets;
	}
}
