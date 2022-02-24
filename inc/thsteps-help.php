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

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add Menue.
add_action( 'admin_menu', 'thsteps_register_help_page' );

/**
 * Add help page function
 *
 * @return void
 */
function thsteps_register_help_page() {
	add_submenu_page(
		'edit.php?post_type=thsteps',
		__( 'How It Works?', 'thsteps' ),
		__( 'Help', 'thsteps' ),
		'manage_options',
		'thsteps_help',
		'thsteps_help_page'
	);
}

/**
 * Text HTML
 *
 * @return void
 */
function thsteps_help_page() { ?>
	<style type="text/css">
		.thsteps-shortcode-preview{background-color: #e7e7e7; font-weight: bold; padding: 2px 5px; display: inline-block; margin:0 0 2px 0;}
	</style>

	<div class="post-box-container">
		<div id="poststuff">
			<div id="post-body" class="metabox-holder columns-2">
				<!--How it workd HTML -->
				<div id="post-body-content">
					<div class="metabox-holder">
						<div class="meta-box-sortables ui-sortable">
							<div class="postbox">
								<h3 class="hndle">
									<span><?php esc_html_e( 'How It Works - Display and shortcode', 'thsteps' ); ?></span>
								</h3>
								<div class="inside">
									<table class="form-table">
										<tbody>
											<tr>
												<th>
													<label><?php esc_html_e( 'Getting Started with TH STEPS', 'thsteps' ); ?>:</label>
												</th>
												<td>
													<ul>
														<li><?php esc_html_e( 'Step 1. Go to "Step Categories --> Add New Category"', 'thsteps' ); ?></li>
														<li><?php esc_html_e( 'Step 2. Go to "All Steps --> Add New Step"', 'thsteps' ); ?></li>
														<li><?php esc_html_e( 'Step 3. Insert a title and text, choose an icon and a link.', 'thsteps' ); ?></li>
														<li><?php esc_html_e( 'Step 4. Choose a category and save the step.', 'thsteps' ); ?></li>
														<li><?php _e( 'Step 5. Copy-paste the shortcode <span class="thsteps-shortcode-preview">[thsteps category="&lt;slug-name&gt;"]</span> anywhere in your post or site for show the stepper.', 'thsteps' ); // phpcs:ignore ?></li>
													</ul>
												</td>
											</tr>

											<tr>
												<th>
													<label><?php esc_html_e( 'All Shortcodes', 'thsteps' ); ?>:</label>
												</th>
												<td>
													<span class="thsteps-shortcode-preview">[thsteps id=&lt;id&gt;]</span> – <?php esc_html_e( 'show a single step', 'thsteps' ); ?> <br />
													<span class="thsteps-shortcode-preview">[thsteps category=&lt;slug-name&gt;]</span> – <?php esc_html_e( 'Show all steps from the category in a stepper', 'thsteps' ); ?> <br />
												</td>
											</tr>			

											<tr>
												<th>
													<label><?php esc_html_e( 'All Shortcodes parameters', 'thsteps' ); ?>:</label>
												</th>
												<td>
													<span class="thsteps-shortcode-preview">orderby="date"</span> – <?php esc_html_e( 'orderby the atribute of steps Value=date, ID, title, name or rand, Default=date', 'thsteps' ); ?> <br />
													<span class="thsteps-shortcode-preview">order="asc"</span> – <?php esc_html_e( 'sort the teps in ascending or descending order. Value=asc or desc, Default=ASC', 'thsteps' ); ?> <br />
													<br />
													<?php esc_html_e( 'e.g.', 'thsteps' ); ?>
													<span class="thsteps-shortcode-preview">[thsteps category=&lt;slug-name&gt; orderby="date" order="desc"]</span>
												</td>
											</tr>
											<tr>
												<th>
													<label><?php esc_html_e( 'Need Support?', 'thsteps' ); ?></label>
												</th>
												<td>
													<p><?php esc_html_e( 'Check plugin document for shortcode parameters.', 'thsteps' ); ?></p> <br/>
													<a class="button button-primary" href="http://triopsi-hosting.com" target="_blank"><?php esc_html_e( 'Documentation', 'thsteps' ); ?></a>									
													<a class="button button-secondary" href="http://paypal.me/triopsihosting" target="_blank">❤️ <?php esc_html_e( 'Donate', 'thsteps' ); ?></a>
												</td>
											</tr>
										</tbody>
									</table>
								</div><!-- .inside -->
							</div><!-- #general -->
						</div><!-- .meta-box-sortables ui-sortable -->
					</div><!-- .metabox-holder -->
				</div><!-- #post-body-content -->
			</div><!-- #post-body -->
		</div><!-- #poststuff -->
	</div><!-- #post-box-container -->
	<?php
}
