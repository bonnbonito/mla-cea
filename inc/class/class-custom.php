<?php
/**
 * Custom Functions
 *
 * @package category
 */

namespace MLA_CEA;

/**
 * Class Shortcodes
 *
 * @package MLA_CEA
 */
class Custom {
	/**
	 * Instance of this class
	 *
	 * @var null
	 */
	private static $instance = null;
	/**
	 * Instance Control
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}
		return self::$instance;
	}
	/**
	 * Class Constructor.
	 */
	public function __construct() {
		add_filter( 'kadence_blocks_pro_query_loop_query_vars', array( $this, 'related_events' ), 10, 3 );
	}

	public function related_events( $query, $ql_query_meta, $ql_id ) {

		// Check if we're dealing with the specific ID (29838)
		if ( $ql_id == 29838 ) {

			// Get the event categories for the current post
			$current_event_categories = get_the_terms( get_the_ID(), 'event-category' );

			if ( ! is_wp_error( $current_event_categories ) && ! empty( $current_event_categories ) ) {

				// Extract the category slugs
				$category_slugs = wp_list_pluck( $current_event_categories, 'slug' );

				// Build the tax_query array to filter by event-category and exclude the current post
				$query['tax_query'] = array(
					array(
						'taxonomy' => 'event-category',  // Assuming the correct taxonomy is 'event-category'
						'field'    => 'slug',
						'terms'    => $category_slugs,    // Use the slugs from the current event categories
						'operator' => 'IN',               // Match events within these categories
					),
				);

				// Exclude the current post from the results
				$query['post__not_in'] = array( get_the_ID() );
			}
		}

		return $query;
	}
}
