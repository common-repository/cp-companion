<?php
namespace CpCompanion\Modules\BlogModule1;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-blog-module1';
	}

	public function get_widgets() {

		$widgets = [
			'Blog_Module1'
		];

		return $widgets;
	}
}
