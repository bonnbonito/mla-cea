<?php
/**
 * Scripts
 *
 * @package MLA_CEA
 */

namespace MLA_CEA;

/**
 * Class Scripts
 */
class Scripts {
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
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue styles
	 */
	public function enqueue_styles() {
		wp_enqueue_style(
			'mla-cea-styles',
			get_stylesheet_directory_uri() . '/assets/css/dist/output.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);
		wp_register_style( 'fancybox', '//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.css', array(), '5.0' );
	}

	/** Enqueue scripts */
	public function enqueue_scripts() {
		wp_register_script(
			'mla-cea-filter',
			get_stylesheet_directory_uri() . '/assets/js/filter.js',
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
		wp_register_script(
			'fancybox',
			'//cdn.jsdelivr.net/npm/@fancyapps/ui@5.0/dist/fancybox/fancybox.umd.js',
			array(),
			'5.0',
			true
		);
	}
}
