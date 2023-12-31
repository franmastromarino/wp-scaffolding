<?php

/**
 * Plugin Name:             {{plugin-title}}
 * Plugin URI:              https://quadlayers.com/portfolio/{{plugin-name}}
 * Description:             {{plugin-title}} description
 * Version:                 1.0.0
 * Text Domain:             {{plugin-name}}
 * Author:                  QuadLayers
 * Author URI:              https://quadlayers.com
 * License:                 GPLv3
 * Domain Path:             /languages
 * Request at least:        4.7.0
 * Tested up to:            6.4
 * Requires PHP:            5.6
 * WC requires at least:    4.0
 * WC tested up to:         8.3
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
*   Definition globals variables
*/

define( 'QLXXX_PLUGIN_NAME', '{{plugin-title}}' );
define( 'QLXXX_PLUGIN_VERSION', '1.0.0' );
define( 'QLXXX_PLUGIN_FILE', __FILE__ );
define( 'QLXXX_PLUGIN_DIR', __DIR__ . DIRECTORY_SEPARATOR );
define( 'QLXXX_DOMAIN', 'qlxxx' );
define( 'QLXXX_PREFIX', QLXXX_DOMAIN );
define( 'QLXXX_WORDPRESS_URL', 'https://wordpress.org/plugins/{{plugin-name}}/' );
define( 'QLXXX_REVIEW_URL', 'https://wordpress.org/support/plugin/{{plugin-name}}/reviews/?filter=5#new-post' );
define( 'QLXXX_DEMO_URL', 'https://quadlayers.com/demo/{{plugin-name}}/?utm_source=qlxxx_admin' );
define( 'QLXXX_PURCHASE_URL', 'https://quadlayers.com/portfolio/{{plugin-name}}/?utm_source=qlxxx_admin' );
define( 'QLXXX_SUPPORT_URL', 'https://quadlayers.com/account/support/?utm_source=qlxxx_admin' );
define( 'QLXXX_DOCUMENTATION_URL', 'https://quadlayers.com/documentation/{{plugin-name}}/?utm_source=qlxxx_admin' );
define( 'QLXXX_DOCUMENTATION_API_URL', 'https://quadlayers.com/documentation/{{plugin-name}}/api/?utm_source=qlxxx_admin' );
define( 'QLXXX_DOCUMENTATION_ACCOUNT_URL', 'https://quadlayers.com/documentation/{{plugin-name}}/account/?utm_source=qlxxx_admin' );
define( 'QLXXX_GROUP_URL', 'https://www.facebook.com/groups/quadlayers' );
define( 'QLXXX_DEVELOPER', false );
define( 'QLXXX_PREMIUM_SELL_URL', 'https://quadlayers.com/{{plugin-name}}-pro' );

/**
 * Load composer autoload
 */
require_once __DIR__ . '/vendor/autoload.php';
/**
 * Load vendor_packages packages
 */
require_once __DIR__ . '/vendor_packages/wp-i18n-map.php';
require_once __DIR__ . '/vendor_packages/wp-dashboard-widget-news.php';
require_once __DIR__ . '/vendor_packages/wp-plugin-table-links.php';
require_once __DIR__ . '/vendor_packages/wp-notice-plugin-required.php';
require_once __DIR__ . '/vendor_packages/wp-notice-plugin-promote.php';
/**
 * Load plugin classes
 */
require_once __DIR__ . '/lib/class-plugin.php';
/**
 * On plugin activation
 */
register_activation_hook(
	__FILE__,
	function() {
		do_action( 'qlxxx_activation' );
	}
);
/**
 * On plugin deactivation
 */
register_deactivation_hook(
	__FILE__,
	function() {
		do_action( 'qlxxx_deactivation' );
	}
);
