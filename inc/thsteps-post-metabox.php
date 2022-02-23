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

/* Hooks the metabox */
add_action( 'admin_init', 'thsteps_add_service', 1 );

/**
 * Add Metaboxes.
 */
function thsteps_add_service() {
	add_meta_box(
		'thsteps-service-url',
		__( 'Service details', 'thsteps' ),
		'thsteps_add_service_url_display',
		'thsteps',
		'normal'
	);
	add_meta_box(
		'thsteps-service-icon',
		__( 'Service icon', 'thsteps' ),
		'thsteps_add_servoice_icon_display',
		'thsteps',
		'normal'
	);
}

/**
 * Show the add/edit postpage in admin.
 *
 * @param object $post Post Obejct.
 */
function thsteps_add_service_url_display( $post ) {

	// get post meta data.
	$serviceurlpageid = (int) get_post_meta( $post->ID, '_thsteps_service_url_page_id', true );
	$serviceurlpostid = (int) get_post_meta( $post->ID, '_thsteps_service_url_post_id', true );
	$serviceurllink   = get_post_meta( $post->ID, '_thsteps_service_url_link', true );
	$url_text         = get_post_meta( $post->ID, '_thsteps_service_url_link_text', true );

	$serviceurlpageid = ( empty( $serviceurlpageid ) ) ? 0 : $serviceurlpageid;
	$serviceurlpostid = ( empty( $serviceurlpostid ) ) ? 0 : $serviceurlpostid;
	$serviceurllink   = ( empty( $serviceurllink ) ) ? '' : $serviceurllink;
	$url_text         = ( empty( $url_text ) ) ? '' : $url_text;

	// Hidden field.
	wp_nonce_field( 'thsteps_meta_box_nonce', 'thsteps_meta_box_nonce' );

	?>
	
	<div class="thsteps_field">
		<div class="thsteps_field_title">
			<?php echo __( 'More information URL', 'thsteps' ); ?>
		</div>
		<div class="thsteps_field_title">
			<?php echo __( 'Site', 'thsteps' ); ?>
		</div>
		<?php
		wp_dropdown_pages(
			array(
				'selected'          => $serviceurlpageid,
				'name'              => 'thsteps_info_url_page_id',
				'show_option_none'  => __( 'Please Choose', 'thsteps' ),
				'option_none_value' => 0,
				'hierarchical'      => true,
				'id'                => 'infoLinkInputId',
				'selected'          => $serviceurlpageid,
			)
		);
		?>
		<br>
		<small> - <?php echo __( 'or', 'thsteps' ); ?> - </small>
		<br>
		<div class="thsteps_field_title">
			<?php echo __( 'Post', 'thsteps' ); ?>
		</div>
		<select name="thsteps_info_url_post_id" id="page_id">
			<option value="0"><?php echo __( 'Please Choose', 'thsteps' ); ?></option>
			<?php

			global $post;
			$args  = array( 'numberposts' => -1 );
			$posts = get_posts( $args );
			foreach ( $posts as $post ) :
				setup_postdata( $post );
				if ( $serviceurlpostid == $post->ID ) {
					?>
					<option value="<?php echo $post->ID; ?>" selected><?php the_title(); ?></option>
					<?php
				} else {
					?>
				<option value="<?php echo $post->ID; ?>"><?php the_title(); ?></option>
					<?php
				}
			endforeach;
			?>
		</select>
		<br>
		<small> - <?php echo __( 'or', 'thsteps' ); ?> - </small>
		<br>
		<div class="thsteps_field_title">
			URL
		</div>
			<input class="thsteps-field regular-text" id="infoLinkInputLink" name="thsteps_info_url" type="text" value="<?php echo esc_url( $serviceurllink ); ?>" placeholder="<?php echo __( 'e.g. https://example.com', 'thsteps' ); ?>">
		</br>
		<div class="thsteps_field_title">
			Url Text
		</div>
		<input class="thsteps-field regular-text" id="infoLinkInputLinkName" name="thsteps_info_url_text" type="text" value="<?php echo esc_html( $url_text ); ?>" placeholder="<?php echo __( 'e.g. Link A', 'thsteps' ); ?>">
		<br>
		<em><?php echo __( 'Empty Value = No Link', 'thsteps' ); ?></em>
	</div>

	<?php
}

/**
 * Show the add/edit postpage in admin.
 *
 * @param object $post Post Obejct.
 */
function thsteps_add_servoice_icon_display( $post ) {

	// get post meta data.
	$serviceicon = get_post_meta( $post->ID, '_thsteps_service_icon', true );
	$serviceicon = ( empty( $serviceicon ) ) ? '' : $serviceicon;
	?>
	<div class="thsteps_field">
		<div class="thsteps_field_title">
			<?php echo __( 'Icon name', 'thsteps' ); ?><span style="color:red;">*</span>
		</div>
		<input class="thsteps-field regular-text" id="thsteps-icon" name="thsteps_info_icon" type="text" value="<?php echo esc_attr( $serviceicon ); ?>" placeholder="fas fa-sync">
		</br>
		<em>
		<?php
		/* translators: %s is replaced with the link */
		printf(
			__( 'By default the plugin used and needed the font awesome icon libary (%s). Choose one and copy the name in this field. Important! Without first css part (.fas).', 'thsteps' ),
			'<a target="_blank" href="https://fontawesome.com/">more infos</a>'
		);
		?>
		</em>
		<br>
		<div class="thiconReview">
		</div>
		<em><span style="color:red;">*</span> <?php echo __( 'Required fields', 'thsteps' ); ?></em>
	</div>

	<?php
}


/**
 * Post Data Form.
 */
add_action( 'save_post', 'thsteps_save_meta_box_data' );

/**
 * Save Function.
 *
 * @param integer $post_id Post ID.
 */
function thsteps_save_meta_box_data( $post_id ) {

	if ( ! isset( $_POST['thsteps_meta_box_nonce'] ) ) {
		return;
	}
	if ( ! wp_verify_nonce( wp_unslash( $_POST['thsteps_meta_box_nonce'] ), 'thsteps_meta_box_nonce' ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'thsteps' === $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}
	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}
	if ( ! isset( $_POST['thsteps_info_icon'] ) ) {
		return;
	}

	// Site Link.
	$service_url_page_id   = stripslashes( strip_tags( sanitize_text_field( wp_unslash( $_POST['thsteps_info_url_page_id'] ) ) ) );
	$service_url_post_id   = stripslashes( strip_tags( sanitize_text_field( wp_unslash( $_POST['thsteps_info_url_post_id'] ) ) ) );
	$service_url_link      = stripslashes( strip_tags( sanitize_text_field( wp_unslash( $_POST['thsteps_info_url'] ) ) ) );
	$service_url_link_text = stripslashes( strip_tags( sanitize_text_field( wp_unslash( $_POST['thsteps_info_url_text'] ) ) ) );

	if ( $service_url_page_id != 0 ) {
		update_post_meta( $post_id, '_thsteps_service_url_page_id', $service_url_page_id );
		update_post_meta( $post_id, '_thsteps_service_url_post_id', 0 );
		update_post_meta( $post_id, '_thsteps_service_url_link', '' );
	}

	if ( $service_url_post_id != 0 ) {
		update_post_meta( $post_id, '_thsteps_service_url_page_id', 0 );
		update_post_meta( $post_id, '_thsteps_service_url_post_id', $service_url_post_id );
		update_post_meta( $post_id, '_thsteps_service_url_link', '' );
	}

	if ( ! empty( $service_url_link ) ) {
		update_post_meta( $post_id, '_thsteps_service_url_page_id', 0 );
		update_post_meta( $post_id, '_thsteps_service_url_post_id', 0 );
		update_post_meta( $post_id, '_thsteps_service_url_link', $service_url_link );
	}

	if ( $service_url_page_id == 0 && $service_url_post_id == 0 && empty( $service_url_link ) ) {
		update_post_meta( $post_id, '_thsteps_service_url_page_id', 0 );
		update_post_meta( $post_id, '_thsteps_service_url_post_id', 0 );
		update_post_meta( $post_id, '_thsteps_service_url_link', '' );
	}

	update_post_meta( $post_id, '_thsteps_service_url_link_text', $service_url_link_text );

	// Save Icon.
	$serviceicon = stripslashes( strip_tags( sanitize_text_field( wp_unslash( $_POST['thsteps_info_icon'] ) ) ) );
	update_post_meta( $post_id, '_thsteps_service_icon', $serviceicon );
}


add_action( 'admin_init', 'thsteps_force_post_categ_init' );
add_action( 'edit_form_advanced', 'thsteps_force_post_categ' );

/**
 * Support JQuery.
 */
function thsteps_force_post_categ_init() {

	// Gets the post type.
	global $post_type;

	if ( 'thsteps' == $post_type ) {
		wp_enqueue_script( 'jquery' );
	}
}

/**
 * Add JQuery.
 */
function thsteps_force_post_categ() {
	// Gets the post type.
	global $post_type;

	if ( 'thsteps' === $post_type ) {
		echo "<script type='text/javascript'>\n";
		echo "
  jQuery('#publish').click(function() {
    var cats = jQuery('[id^=\"taxonomy\"]').find('.selectit').find('input');
	var icon_field = jQuery('#thsteps-icon');
    category_selected=false;

    for (counter=0; counter<cats.length; counter++) {
        if (cats.get(counter).checked==true) 
        {
            category_selected=true;
            break;
        }
    }

    if( false == category_selected || '' == icon_field.val() ) {
      alert('You have not selected any category or the icon field are empty. Please select post category and a icon.');
      setTimeout(\"jQuery('#ajax-loading').css('visibility', 'hidden');\", 100);
	  if( category_selected == false ) {
		jQuery('[id^=\"taxonomy\"]').find('.tabs-panel').css('background', '#F96');
	  }
	  if ( '' == icon_field.val() ) {
		icon_field.css('background', '#F96');
	  }
      setTimeout(\"jQuery('#publish').removeClass('button-primary-disabled');\", 100);
      return false;
    }
  });
  ";
		echo "</script>\n";
	}
}
