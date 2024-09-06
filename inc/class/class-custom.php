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
	}
}
