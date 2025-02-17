<?php

class DH_Metabox {

	const TEAM_LOCATION_EVERYWHERE = 0;
	const TEAM_LOCATION_WORK = 1;
	const TEAM_LOCATION_LIST = 2;
	const TEAM_LOCATION_NONE = 3;

	function __construct() {
		add_action( 'add_meta_boxes_team_member', array( $this, 'add_team_member_meta_box' ) );
		add_action( 'add_meta_boxes_team_member', array( $this, 'add_work_order_meta_box' ) );
		add_action( 'save_post_team_member', array( $this, 'save_team_member' ) );
	}

	function add_team_member_meta_box() {
		add_meta_box( 'dh_location_metabox',
			'Team Member Display Location',
			array( $this, 'team_member_meta_box' )
		);
	}

	function team_member_meta_box( $post ) {
		wp_nonce_field( 'dh_location_meta_box', 'dh_location_meta_box_nonce' );
		$value = absint( get_post_meta( $post->ID, '_dh_location', true ) );
		?>
		<select id="dh_location" name="dh_location">
			<option value="<?php echo self::TEAM_LOCATION_EVERYWHERE; ?>"<?php selected( $value, self::TEAM_LOCATION_EVERYWHERE ); ?>>Display Everywhere</option>
			<option value="<?php echo self::TEAM_LOCATION_WORK; ?>"<?php selected( $value, self::TEAM_LOCATION_WORK ); ?>>Display only on the work page</option>
			<option value="<?php echo self::TEAM_LOCATION_LIST; ?>"<?php selected( $value, self::TEAM_LOCATION_LIST ); ?>>Display only on the team listing page</option>
			<option value="<?php echo self::TEAM_LOCATION_NONE; ?>"<?php selected( $value, self::TEAM_LOCATION_NONE ); ?>>Don't display on the site</option>
		</select>
	<?php
	}

	function add_work_order_meta_box() {
		add_meta_box( 'dh_work_order_metabox',
			'Work Page Order',
			array( $this, 'work_order_meta_box' )
		);
	}

	function work_order_meta_box( $post ) {
		wp_nonce_field( 'dh_work_order_metabox', 'dh_work_order_metabox_nonce' );
		$value = absint( get_post_meta( $post->ID, '_dh_work_order', true ) );
		?>
		<input id="dh_work_order" name="dh_work_order" value="<?php echo $value; ?>"/>
	<?php
	}

	function save_team_member( $id ) {
		// If this is an autosave, our form has not been submitted, so we don't want to do anything.
		if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check the user's permissions.
		if( !current_user_can( 'edit_post', $id ) ) {
			return;
		}

		if( isset( $_POST['dh_location_meta_box_nonce'] ) && wp_verify_nonce( $_POST['dh_location_meta_box_nonce'], 'dh_location_meta_box' ) ) {
			if( isset( $_POST['dh_location'] ) && in_array( absint( $_POST['dh_location'] ), array( self::TEAM_LOCATION_WORK, self::TEAM_LOCATION_LIST, self::TEAM_LOCATION_NONE ), true ) ) {
				$location = absint( $_POST['dh_location'] );
			} else {
				$location = self::TEAM_LOCATION_EVERYWHERE;
			}

			// Update the meta field in the database.
			update_post_meta( $id, '_dh_location', $location );
		}

		if( isset( $_POST['dh_work_order_metabox_nonce'] ) && wp_verify_nonce( $_POST['dh_work_order_metabox_nonce'], 'dh_work_order_metabox' ) && isset( $_POST['dh_work_order'] ) ) {
			$order = absint( $_POST['dh_work_order'] );

			if( 0 == $order ) {
				$order = 100;
			}

			// Update the meta field in the database.
			update_post_meta( $id, '_dh_work_order', $order );
		}
	}
}

add_action( 'after_setup_theme', create_function( '', 'new DH_Metabox();' ) );
