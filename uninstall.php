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

// if uninstall.php is not called by WordPress, die.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

delete_option( 'thsteps_plugin_version' );
delete_option( 'thsteps_settings_cdn_awesome' );
delete_option( 'thsteps_settings_class_wrapper' );
delete_option( 'thsteps_settings_step_style' );
delete_option( 'thsteps_settings_additional_step_css_classes' );
delete_option( 'thsteps_settings_step_icon_color' );
delete_option( 'thsteps_settings_additional_link_css_classes' );

// Delete metadata and posts.
$post_type_arg   = array(
	'post_type'      => 'thsteps',
	'posts_per_page' => -1,
);

$getpostsentries = get_posts( $post_type_arg );
foreach ( $getpostsentries as $delpost ) {
	wp_delete_post( $delpost->ID, true );
}
