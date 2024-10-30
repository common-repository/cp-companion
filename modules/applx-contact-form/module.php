<?php
namespace CpCompanion\Modules\ApplxContactForm;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'applx-contact-form';
	}

	public function get_widgets() {

		$widgets = [
			'Applx_Contact_Form'
		];

		return $widgets;
	}
}
