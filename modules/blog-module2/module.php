<?php
namespace CpCompanion\Modules\BlogModule2;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-blog-module2';
	}

	public function get_widgets() {

		$widgets = [
			'Blog_Module2'
		];

		return $widgets;
	}
}
