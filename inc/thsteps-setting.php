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

// Register our thsteps_options_page to the admin_menu action hook.
add_action( 'admin_menu', 'thsteps_option_menue' );

/**
 * Register thsteps_settings_init to the admin_init action hook.
 */
add_action( 'admin_init', 'thsteps_settings_init' );


/**
 * Init setting setup
 *
 * @return void
 */
function thsteps_settings_init() {

	// register new settings.
	register_setting( 'thsteps', 'thsteps_settings_cdn_awesome' );
	register_setting( 'thsteps', 'thsteps_settings_class_wrapper' );
	register_setting( 'thsteps', 'thsteps_settings_step_style' );
	register_setting( 'thsteps', 'thsteps_settings_additional_step_css_classes' );
	register_setting( 'thsteps', 'thsteps_settings_step_icon_color' );
	register_setting( 'thsteps', 'thsteps_settings_additional_link_css_classes' );

	/*********** Sections *************/
	// Font Awesome CDN Section.
	add_settings_section(
		'thsteps_settings_section_font_cdn',
		'Font Awesome CDN',
		'thsteps_settings_cdn_section_cb',
		'thsteps'
	);

	// Font Awesome Section.
	add_settings_section(
		'thsteps_settings_section_css_styles',
		'CSS Settings',
		'thsteps_settings_section_css_sytles_cb',
		'thsteps'
	);


	/*********** FIELDS *************/
	// Social Media Style CDN Field.
	add_settings_field(
		'thsteps_settings_cdn_awesome',
		__( 'Use Font Awesome CDN?', 'thsteps' ),
		'thsteps_settings_field_cdn_cb',
		'thsteps',
		'thsteps_settings_section_font_cdn'
	);

	// Style CSS Wrapper Class Field.
	add_settings_field(
		'thsteps_settings_class_wrapper',
		__( 'Additional CSS classes for wrapper', 'thsteps' ),
		'thsteps_settings_field_css_classes_cb',
		'thsteps',
		'thsteps_settings_section_css_styles'
	);

	// Style CSS Wrapper Class Field.
	add_settings_field(
		'thsteps_settings_step_style',
		__( 'Style of the step', 'thsteps' ),
		'thsteps_settings_field_style_step_cb',
		'thsteps',
		'thsteps_settings_section_css_styles'
	);

	// Additional style CSS Step Class Field.
	add_settings_field(
		'thsteps_settings_additional_step_css_classes',
		__( 'Additional CSS classes for steps', 'thsteps' ),
		'thsteps_settings_field_css_classes_steps_cb',
		'thsteps',
		'thsteps_settings_section_css_styles'
	);

	// Additional style CSS Step Class Field.
	add_settings_field(
		'thsteps_settings_step_icon_color',
		__( 'Icon Color', 'thsteps' ),
		'thsteps_settings_field_icon_color_cb',
		'thsteps',
		'thsteps_settings_section_css_styles'
	);

	// Additional style CSS Link Class Field.
	add_settings_field(
		'thsteps_settings_additional_link_css_classes',
		__( 'Additional CSS classes for links', 'thsteps' ),
		'thsteps_settings_field_css_classes_link_cb',
		'thsteps',
		'thsteps_settings_section_css_styles'
	);
}

/**
 * Setting Field CDN Fonts/Icon.
 */
function thsteps_settings_field_cdn_cb() {
	$old_setting_value = ( ! empty( get_option( 'thsteps_settings_cdn_awesome' ) ) ? get_option( 'thsteps_settings_cdn_awesome' ) : 'yes' );
	?>
	<input type="checkbox" id="thsteps_settings_cdn_awesome" name="thsteps_settings_cdn_awesome" value="1" <?php echo checked( 1, $old_setting_value, false ); ?>/>
	<label for="thsteps_settings_cdn_awesome"><?php esc_html_e( 'Enable', 'thsteps' ); ?></label>
	<?php
}

/**
 * Setting Field CSS Wrapper Classes.
 */
function thsteps_settings_field_css_classes_cb() {
	$old_setting_value = get_option( 'thsteps_settings_class_wrapper', '' );
	?>
	<input type="text" id="thsteps_settings_class_wrapper" name="thsteps_settings_class_wrapper" value="<?php echo $old_setting_value; ?>" />
	<?php
}

/**
 * Setting Field Step Style Classes.
 */
function thsteps_settings_field_style_step_cb() {
	$old_setting_value = get_option( 'thsteps_settings_step_style', 'flat' );
	?>
	<select name="thsteps_settings_step_style" id="thsteps_settings_step_style">
		<option value="flat" <?php echo selected( 'flat', $old_setting_value, false ); ?>>Flat</option>
		<option value="downstairs" <?php echo selected( 'downstairs', $old_setting_value, false ); ?>>Downstairs</option>
	</select>
	<?php
}

/**
 * Setting Field Steps CSS Classes.
 */
function thsteps_settings_field_css_classes_steps_cb() {
	$old_setting_value = get_option( 'thsteps_settings_additional_step_css_classes', '' );
	?>
	<input type="text" id="thsteps_settings_additional_step_css_classes" name="thsteps_settings_additional_step_css_classes" value="<?php echo $old_setting_value; ?>" />
	<?php
}

/**
 * Setting Field Icon Color.
 */
function thsteps_settings_field_icon_color_cb() {
	$old_setting_value = get_option( 'thsteps_settings_step_icon_color', '#0b439e' );
	?>
	<input type="text" id="thsteps_settings_step_icon_color" class="thsteps_settings_step_icon_color" name="thsteps_settings_step_icon_color" value="<?php echo esc_attr( $old_setting_value ); ?>">
	<?php
}

/**
 * Setting Field Steps CSS Classes.
 */
function thsteps_settings_field_css_classes_link_cb() {
	$old_setting_value = get_option( 'thsteps_settings_additional_link_css_classes', 'btn btn-primary text-white' );
	?>
	<input type="text" id="thsteps_settings_additional_link_css_classes" name="thsteps_settings_additional_link_css_classes" value="<?php echo $old_setting_value; ?>" />
	<?php
}


/**
 * Font Awesome library CDN Header.
 */
function thsteps_settings_cdn_section_cb() {
	esc_html_e( 'Want to use the CDN for Font Awesome Icons?', 'thsteps' );
}

/**
 * CSS Style Header.
 */
function thsteps_settings_section_css_sytles_cb() {
	esc_html_e( 'Style settings for steps.', 'thsteps' );
}


/**
 * Add Top level menue.
 */
function thsteps_option_menue() {

	add_options_page(
		__( 'TH Steps Options', 'thsteps' ),
		__( 'TH Steps Options', 'thsteps' ),
		'manage_options',
		'thsteps',
		'thsteps_options_page_html'
	);
}

/**
 *  Page content.
 *
 * @return void
 */
function thsteps_options_page_html() {
	// Check user capabilities.
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	?>
	<div class="wrap">
		<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
		<form action="options.php" method="post">
			<?php
				// output security fields for the registered setting "thsteps".
				settings_fields( 'thsteps' );

				// output setting sections and their fields.
				// (sections are registered for "thsteps", each field is registered to a specific section).
				do_settings_sections( 'thsteps' );

				// output save settings button.
				submit_button( __( 'Save Settings', 'thsteps' ) );
			?>
		</form>
		<div id="post-body-content">
			<div id="thsteps-admin-page" class="meta-box-sortabless">
				<div id="thsteps-shortcode" class="postbox">
					<div class="inside">
						<h3 class="wp-pic-title"><?php esc_html_e( 'Supports', 'thsteps' ); ?></h3>
						<div class="thsteps-wrap-option-page">
							<a href="https://paypal.me/triopsihosting" target="_blank" class="button button-secondary">❤️ <?php esc_html_e( 'Donate', 'thsteps' ); ?></a> 
							<a href="edit.php?post_type=thsteps&page=thsteps_help" target="_self" class="button button-secondary">ℹ️ <?php esc_html_e( 'Help', 'thsteps' ); ?></a> 
						</div>
					</div>
				</div>
			</div>
		<?php if ( WP_DEBUG ) { ?>
			<div class="debug-info">
				<h3><?php esc_html_e( 'Debug information', 'thsteps' ); ?></h3>
				<p><?php esc_html_e( 'You are seeing this because your WP_DEBUG variable is set to true.', 'thsteps' ); ?></p>
				<pre>thsteps_plugin_version: <?php print_r( get_option( 'thsteps_plugin_version' ) ); // phpcs:ignore ?></pre>
				<pre>thsteps_settings_cdn_awesome: <?php print_r( get_option( 'thsteps_settings_cdn_awesome' ) ); // phpcs:ignore ?></pre>
				<pre>thsteps_settings_class_wrapper: <?php print_r( get_option( 'thsteps_settings_class_wrapper' ) ); // phpcs:ignore ?></pre>
				<pre>thsteps_settings_step_style: <?php print_r( get_option( 'thsteps_settings_step_style' ) ); // phpcs:ignore ?></pre>
				<pre>thsteps_settings_additional_step_css_classes: <?php print_r( get_option( 'thsteps_settings_additional_step_css_classes' ) ); // phpcs:ignore ?></pre>
				<pre>thsteps_settings_step_icon_color: <?php print_r( get_option( 'thsteps_settings_step_icon_color' ) ); // phpcs:ignore ?></pre>
				<pre>thsteps_settings_additional_link_css_classes: <?php print_r( get_option( 'thsteps_settings_additional_link_css_classes' ) ); // phpcs:ignore ?></pre>
				<pre><?php esc_html_e( 'All Stepss', 'thsteps' ); ?>: <?php print_r( thsteps_show_all_faqs() ); // phpcs:ignore ?></pre>
			</div><!-- /.debug-info -->
		<?php } ?>
	</div>
	<?php
}

/**
 * Find all faqs.
 *
 * @return Object All Stepss.
 */
function thsteps_show_all_faqs() {
	$post_type_arg   = array(
		'post_type'      => 'thsteps',
		'posts_per_page' => -1,
	);
	$getpostsentries = get_posts( $post_type_arg );
	return $getpostsentries;
}
