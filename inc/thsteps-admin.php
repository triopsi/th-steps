<?php
/**
 * Author: triopsi
 * Author URI: http://triopsi-hosting.com
 * License: GPLv2
 * License URI: https://www.gnu.org/licenses/gpl-2.0
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
 * along with thsteps. If not, see https://www.gnu.org/licenses/gpl-2.0.
 *
 * @package thsteps
 **/

// Loaded Plugin.
add_action( 'plugins_loaded', 'thsteps_check_version' );

/**
 * Version Check.
 */
function thsteps_check_version() {
	if ( THSTEPS_VERSION !== get_option( 'thsteps_plugin_version' ) ) {
		thsteps_activation();
	}
}

/**
 * Update Version Number.
 */
function thsteps_activation() {
	update_option( 'thsteps_plugin_version', THSTEPS_VERSION );
}

// Enqueue Scripts for Add/Edit Post type.
add_action( 'admin_enqueue_scripts', 'thsteps_load_scripts_css' );

/**
 * Load JS and CSS.
 */
function thsteps_load_scripts_css() {

	/* Gets the post type. */
	global $post_type;

	if ( 'thsteps' === $post_type ) {

		// Remove Attachment/Media Button.
		remove_action( 'media_buttons', 'media_buttons' );

		// Add all JS, CSS and settings for the media js.
		wp_enqueue_media();

		// Load JS for metaboxes.
		wp_enqueue_script( 'logic-form', plugins_url( '../assets/js/logic-form.js', __FILE__ ), array(), THSTEPS_VERSION, false );

		// Load Font Awesome.
		wp_enqueue_style( 'font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.css', array(), THSTEPS_VERSION, 'all' );

	}else {

		// WP color picker Style and scripts.
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );

		// JS for metaboxes.
		wp_enqueue_script( 'thsteps-admin-form', plugins_url( '../assets/js/admin-form.js', __FILE__ ), array(), THSTEPS_VERSION, true );

	}
}
