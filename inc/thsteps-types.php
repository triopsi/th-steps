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

// Registers the teams post type.
add_action( 'init', 'register_thsteps_type' );

// Register new taxonomy.
add_action( 'init', 'register_thsteps_taxonomy' );

// Add update messages.
add_filter( 'post_updated_messages', 'thsteps_updated_messages' );

// Add new Column.
add_filter( 'manage_edit-thstepss_categories_columns', 'thsteps_custom_categories_add_new_columns' );

// Adds the shortcode column in the postslistbar.
add_filter( 'manage_thsteps_posts_columns', 'add_thsteps_columns' );

// Handles shortcode column display.
add_action( 'manage_thsteps_posts_custom_column', 'thsteps_custom_columns', 10, 2 );

// Add new Column.
add_action( 'manage_thstepss_categories_custom_column', 'thsteps_custom_categories_columns', 10, 3 );


/**
 * Function about the ini of the Plugin
 *
 * @return void
 */
function register_thsteps_type() {

	// Defines labels.
	$labels = array(
		'name'               => __( 'TH Steps', 'thsteps' ),
		'singular_name'      => __( 'Step', 'thsteps' ),
		'menu_name'          => __( 'TH Steps', 'thsteps' ),
		'name_admin_bar'     => __( 'TH Steps', 'thsteps' ),
		'add_new'            => __( 'Add New Steps', 'thsteps' ),
		'add_new_item'       => __( 'Add New Steps', 'thsteps' ),
		'new_item'           => __( 'New Steps', 'thsteps' ),
		'edit_item'          => __( 'Edit Steps', 'thsteps' ),
		'view_item'          => __( 'View Steps', 'thsteps' ),
		'all_items'          => __( 'All Stepss', 'thsteps' ),
		'search_items'       => __( 'Search Stepss', 'thsteps' ),
		'not_found'          => __( 'No Stepss found.', 'thsteps' ),
		'not_found_in_trash' => __( 'No Stepss found in Trash.', 'thsteps' ),
	);

	// Defines permissions.
	$args = array(
		'labels'             => $labels,
		'public'             => true,
		'publicly_queryable' => false,
		'show_ui'            => true,
		'show_in_admin_bar'  => true,
		'capability_type'    => 'post',
		'has_archive'        => false,
		'hierarchical'       => false,
		'supports'           => array( 'title', 'editor' ),
		'menu_icon'          => 'dashicons-leftright',
		'query_var'          => true,
		'rewrite'            => false,
	);

	// Registers post type.
	register_post_type( 'thsteps', $args );

}

/**
 * Function to register post taxonomies
 */
function register_thsteps_taxonomy() {

	$labels = array(
		'name'                       => __( 'Steps Categories', 'thsteps' ),
		'singular_name'              => __( 'Steps Category', 'thsteps' ),
		'search_items'               => __( 'Search Steps categories', 'thsteps' ),
		'all_items'                  => __( 'All Steps categories', 'thsteps' ),
		'parent_item'                => __( 'Parent Steps Category', 'thsteps' ),
		'parent_item_colon'          => __( 'Parent Steps Category:', 'thsteps' ),
		'edit_item'                  => __( 'Edit Steps Category', 'thsteps' ),
		'update_item'                => __( 'Update Steps Category', 'thsteps' ),
		'add_new_item'               => __( 'Add New Steps Category', 'thsteps' ),
		'new_item_name'              => __( 'New Steps Category Name', 'thsteps' ),
		'separate_items_with_commas' => __( 'Separate Steps categories with commas', 'thsteps' ),
		'add_or_remove_items'        => __( 'Add or remove Steps category', 'thsteps' ),
		'choose_from_most_used'      => __( 'Choose from the most used Steps categories', 'thsteps' ),
		'not_found'                  => __( 'No Steps category found.', 'thsteps' ),
		'menu_name'                  => __( 'Steps Categories', 'thsteps' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => true,
	);

	// Register Taxonomies.
	register_taxonomy( 'thstepss_categories', array( 'thsteps' ), $args );

}

/**
 * Update post message functions
 *
 * @param String $messages Message.
 * @return Array New Array with Message.
 */
function thsteps_updated_messages( $messages ) {
	$post              = get_post();
	$post_type         = get_post_type( $post );
	$post_type_object  = get_post_type_object( $post_type );
	$messages['thsteps'] = array(
		1  => __( 'Steps updated.', 'thsteps' ),
		4  => __( 'Steps updated.', 'thsteps' ),
		6  => __( 'Steps published.', 'thsteps' ),
		7  => __( 'Steps saved.', 'thsteps' ),
		10 => __( 'Steps draft updated.', 'thsteps' ),
	);
	return $messages;
}

/**
 * Shortcodestyle function.
 *
 * @param Array   $column Collumn.
 * @param Integer $post_id Post ID.
 */
function thsteps_custom_columns( $column, $post_id ) {
	switch ( $column ) {
		case 'thsteps_shortcode':
			global $post;
			$slug      = '';
			$slug      = $post->ID;
			$shortcode = '<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value="[thsteps id=&quot;' . $slug . '&quot;]" class="large-text code"></span>';
			echo $shortcode; // phpcs:ignore
			break;
	}
}


/**
 * Shortcodestyle function.
 *
 * @param String  $string Content.
 * @param Array   $columns Collumn.
 * @param Integer $term_id Post ID.
 */
function thsteps_custom_categories_columns( $string, $columns, $term_id ) {
	switch ( $columns ) {
		case 'thsteps_cat_shortcode':
			$slug      = get_term( $term_id, 'thstepss_categories' );
			$shortcode = '<span class="shortcode"><input type="text" onfocus="this.select();" readonly="readonly" value="[thsteps category=' . $slug->slug . ']" class="large-text code"></span>';
			echo $shortcode; // phpcs:ignore
			break;
	}
}

/**
 * Add New collumn.
 *
 * @param Array $columns All Columns.
 * @return Array All Columns with new col.
 */
function thsteps_custom_categories_add_new_columns( $columns ) {

	$columns['thsteps_cat_shortcode'] = __( 'Shortcode', 'thsteps' );
	return $columns;
}

/**
 * AdminCollumnBar function.
 *
 * @param Array $columns Collumn.
 * @return Array Arraymerge.
 */
function add_thsteps_columns( $columns ) {
	$columns['title'] = __( 'Question', 'thsteps' );
	unset( $columns['author'] );
	unset( $columns['date'] );
	return array_merge( $columns, array( 'thsteps_shortcode' => __( 'Shortcode', 'thsteps' ) ) );
}

