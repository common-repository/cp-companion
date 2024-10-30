<?php
namespace CpCompanion\Modules\BlogModule3;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-blog-module3';
	}

	public function get_widgets() {

		$widgets = [
			'Blog_Module3'
		];

		return $widgets;
	}
}
