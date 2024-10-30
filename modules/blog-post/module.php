<?php
namespace CpCompanion\Modules\BlogPost;

use CpCompanion\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'cp-blog-post';
	}

	public function get_widgets() {

		$widgets = [
			'Blog_Post'
		];

		return $widgets;
	}
}
