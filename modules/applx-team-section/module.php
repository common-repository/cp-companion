<?php
namespace CpCompanion\Modules\ApplxTeamSection;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'applx-team-section';
	}

	public function get_widgets() {

		$widgets = [
			'Applx_Team_Section'
		];

		return $widgets;
	}
}
