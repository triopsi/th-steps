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

// Add Scripts.
add_action( 'wp_enqueue_scripts', 'add_admin_thsteps_style_js' );

// Shortcode on the Page.
add_shortcode( 'thsteps', 'thsteps_sh' );

/**
 * Undocumented function
 *
 * @return void
 */
function add_admin_thsteps_style_js() {

	wp_register_style( 'th-step-fronted-style', plugins_url( 'assets/css/front-style.css', THSTEPS_PLUGIN_FILE ), array(), THSTEPS_VERSION, 'all' );
	wp_enqueue_style( 'th-step-fronted-style' );

	$use_awesome_cdn = get_option( 'thsteps_settings_cdn_awesome' );

	if ( $use_awesome_cdn ) {

		// Font Awesome.
		wp_enqueue_style( 'thsteps-font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css', array(), '5.15.3', 'all' );
	}
}

/**
 * Show the Shortcode in the post/site/content.
 *
 * @param Array $atts All Attributes.
 * @return String HTML Code.
 */
function thsteps_sh( $atts ) {

	// Data of the current Post.
	global $post;

	// Shortcode Parameter.
	// phpcs:ignore
	extract(
		shortcode_atts(
			array(
				'orderby'  => 'date',
				'order'    => 'ASC',
				'id'       => '',
				'category' => '',
			),
			$atts
		)
	);

	$order    = ( strtolower( $order ) === 'asc' ) ? 'ASC' : 'DESC';
	$orderby  = ! empty( $orderby ) ? $orderby : 'date';
	$id       = ! empty( $id ) ? $id : '';
	$category = ! empty( $category ) ? $category : '';

	// WP Query Parameters.
	$query_args = array(
		'post_type'      => 'thsteps',
		'post_status'    => array( 'publish' ),
		'posts_per_page' => -1,
		'order'          => $order,
		'orderby'        => $orderby,
	);

	// search single faq.
	if ( ! empty( $id ) ) {
		$query_args['p'] = $id;
	}

	// Search with category.
	if ( ! empty( $category ) ) {
		$query_args['tax_query'] = array( // phpcs:ignore
			array(
				'taxonomy' => 'thstepss_categories',
				'field'    => 'name',
				'terms'    => $category,
			),
		);
	}

	// WP Query Parameters.
	$thsteps_query = new WP_Query( $query_args );

	// Default Output.
	$htmlout = '';

	if ( $thsteps_query->have_posts() ) {
		ob_start();
		thsteps_getcssblock();
		$o        = ob_get_clean();
		$htmlout .= thsteps_get_output_list( $thsteps_query, $post );
	}
	wp_reset_postdata(); // Reset WP Query.
	return $o . $htmlout;

}


/**
 * Get HTMl Code.
 *
 * @param Object  $thsteps_query Array of questions.
 * @param WC_Post $post Acutal Post.
 * @return String HTML Code.
 */
function thsteps_get_output_list( $thsteps_query, $post ) {

	$htmlout = '<!-- Start Triopsi Hosting Steps -->';

	$additional_wrapper_classes = get_option( 'thsteps_settings_class_wrapper', '' );
	$css_style_step             = get_option( 'thsteps_settings_step_style', 'flat' );
	$additional_classes_steps   = get_option( 'thsteps_settings_additional_step_css_classes', '' );
	$icon_color                 = get_option( 'thsteps_settings_step_icon_color', '#0b439e' );
	$link_css_classes           = get_option( 'thsteps_settings_additional_link_css_classes', 'btn btn-primary text-white' );

	if ( 'flat' === $css_style_step ) {
		$css_style_step = 'th-step-md th-step-centered';
	}

	$icon_style = 'color:' . $icon_color . ';';

	if ( $thsteps_query->have_posts() ) {

		$htmlout .= '<ul class="th-step ' . $css_style_step . ' ' . $additional_wrapper_classes . '">';

		// Outputt all Services.
		foreach ( $thsteps_query->get_posts() as $single_step ) :

			$iduid = uniqid();

			// Get the ID.
			$id_step = $iduid . $single_step->ID;

			// Get the title.
			$title_step = $single_step->post_title;

			// Get the body.
			$body_step = $single_step->post_content;

			// Get links.
			$service_url_page_id   = (int) get_post_meta( $single_step->ID, '_thsteps_service_url_page_id', true );
			$service_url_post_id   = (int) get_post_meta( $single_step->ID, '_thsteps_service_url_post_id', true );
			$service_url_link      = get_post_meta( $single_step->ID, '_thsteps_service_url_link', true );
			$service_url_link_text = get_post_meta( $single_step->ID, '_thsteps_service_url_link_text', true );
			$service_url_link_text = ( ! empty( $service_url_link_text ) ) ? $service_url_link_text : $title_step;

			// Default url.
			$htmlurl = '';

			// Set the url.
			if ( 0 !== $service_url_page_id ) {
				$htmlurl = get_page_link( $service_url_page_id );
			}

			if ( 0 !== $service_url_post_id ) {
				$htmlurl = get_page_link( $service_url_page_id );
			}

			if ( '' !== $service_url_link ) {
				$htmlurl = $service_url_link;
			}

			if ( 0 === $service_url_page_id && 0 === $service_url_post_id && empty( $service_url_link ) ) {
				$link = false;
			} else {
				$link = true;
			}

			// Get icon.
			$service_icon = get_post_meta( $single_step->ID, '_thsteps_service_icon', true );

			if ( $link ) {
				$htmllink = '<br><br><a class="' . $link_css_classes . '" href="' . $htmlurl . '">' . $service_url_link_text . '</a>';
			} else {
				$htmllink = '';
			}

			$htmlout .= '<li class="th-step-item ' . $additional_classes_steps . '">
			<div class="th-step-content-wrapper">
				<span class="th-step-icon" style="' . $icon_style . '">
					<i class="' . $service_icon . ' fa-3x" aria-hidden="true"></i>
				</span>
				<div class="th-step-content">
					<h3>' . $title_step . '</h3>
					<p>' . $body_step . '' . $htmllink . '</p>
					</p>
				</div>
			</div>
		</li>';

		endforeach;

		$htmlout .= '</ul>';
	}
	$htmlout .= '<!-- End Triopsi Hosting Steps -->';
	return $htmlout;
}


/**
 * Get CSS Code.
 */
function thsteps_getcssblock() {
	$line_color = get_option( 'thsteps_settings_step_icon_color', '#0b439e' );
	?>
<style>
	.th-step .th-step-icon::after {
		border-top: .125rem solid <?php echo esc_html( $line_color ); ?>;
	}
</style>
	<?php
}
