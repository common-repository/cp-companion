<?php
namespace CpCompanion\Modules\SiteLogo;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-site-logo';
	}

	public function get_widgets() {

		$widgets = [
			'Site_Logo'
		];

		return $widgets;
	}
}
