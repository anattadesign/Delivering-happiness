<?php

/**
 * Class TribeEventsFilter_Organizer
 */
class TribeEventsFilter_Organizer extends TribeEventsFilter {
	public $type = 'checkbox';

	protected function get_values() {
		/** @var wpdb $wpdb */
		global $wpdb;
		// get organizer IDs associated with published posts
		$organizer_ids = $wpdb->get_col($wpdb->prepare("SELECT DISTINCT m.meta_value FROM {$wpdb->postmeta} m INNER JOIN {$wpdb->posts} p ON p.ID=m.post_id WHERE p.post_type=%s AND p.post_status='publish' AND m.meta_key='_EventOrganizerID' AND m.meta_value > 0", TribeEvents::POSTTYPE));
		array_filter($organizer_ids);
		if ( empty($organizer_ids) ) {
			return array();
		}
		$organizers = get_posts(array(
			'post_type' => TribeEvents::ORGANIZER_POST_TYPE,
			'posts_per_page' => 200, // arbitrary limit
			'suppress_filters' => FALSE,
			'post__in' => $organizer_ids,
			'post_status' => 'publish',
			'orderby' => 'title',
			'order' => 'ASC',
		));

		$organizers_array = array();
		foreach( $organizers as $organizer ) {
			$organizers_array[] = array(
				'name' => $organizer->post_title,
				'value' => $organizer->ID,
			);
		}
		return $organizers_array;
	}

	protected function setup_join_clause() {
		global $wpdb;
		$this->joinClause = "LEFT JOIN {$wpdb->postmeta} AS organizer_filter ON ({$wpdb->posts}.ID = organizer_filter.post_id AND organizer_filter.meta_key = '_EventOrganizerID')";
	}

	protected function setup_where_clause() {
		$organizer_ids = implode(',', array_map('intval', $this->currentValue));
		$this->whereClause = " AND organizer_filter.meta_value IN ($organizer_ids) ";
	}
}
 