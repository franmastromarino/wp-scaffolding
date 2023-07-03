<?php

namespace QuadLayers\{{plugin-namespace}};

class Setup {

	protected static $instance;

	public function __construct() {

		add_action(
			'qlxxx_activation',
			function() {
				flush_rewrite_rules();
				wp_cache_flush();
			}
		);

		add_action(
			'qlxxx_deactivation',
			function() {
				flush_rewrite_rules();
				wp_cache_flush();
			}
		);
	}

	public static function instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}


}
