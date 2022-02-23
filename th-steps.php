<?php
/**
 * Plugin Name: TH Steps
 * Plugin URI: https://triopsi-hosting.com
 * Description: A simple HTML stepper that works with categories and is also easy to use.
 * Version: 1.0.0
 * Author: triopsi
 * Author URI: https://triopsi-hosting.com
 * Text Domain: thsteps
 * Domain Path: /lang/
 * License: GPL3
 * License URI: https://www.gnu.org/licenses/gpl-3.0
 *
 * ThSteps is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 2 of the License, or
 * any later version.
 *
 * ThSteps is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with thsteps. If not, see https://www.gnu.org/licenses/gpl-3.0.
 *
 * @package thsteps
 **/

// Definie plugin version.
if ( ! defined( 'THSTEPS_VERSION' ) ) {
	define( 'THSTEPS_VERSION', '1.0.0' );
}

define( 'THSTEPS_PLUGIN_FILE', __FILE__ );

/* Loads plugin's text domain. */
add_action( 'init', 'thsteps_load_plugin_textdomain' );

// Add Admin Actions.
require_once 'inc/thsteps-admin.php';
require_once 'inc/thsteps-types.php';
require_once 'inc/thsteps-post-metabox.php';
require_once 'inc/thsteps-setting.php';

// Shortcode.
require_once 'inc/thsteps-shortcode.php';

/**
 * Init Script. Load languages
 *
 * @return void
 */
function thsteps_load_plugin_textdomain() {
	load_plugin_textdomain( 'thsteps', '', 'th-faq/lang/' );
}
