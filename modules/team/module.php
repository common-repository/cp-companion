<?php
namespace CpCompanion\Modules\Team;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-team';
	}

	public function get_widgets() {

		$widgets = [
			'Team'
		];

		return $widgets;
	}
}
