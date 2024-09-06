<?php
/**
 * Shortcodes
 *
 * @package category
 */

namespace MLA_CEA;

/**
 * Class Shortcodes
 *
 * @package MLA_CEA
 */
class Shortcodes {
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
		add_shortcode( 'cea_filter', array( $this, 'cea_filter' ) );
		add_shortcode( 'resource_filter', array( $this, 'resource_filter' ) );
		add_shortcode( 'people_filter', array( $this, 'people_filter' ) );
		add_shortcode( 'guidance_docs', array( $this, 'guidance_docs' ) );
		add_shortcode( 'single_resource', array( $this, 'single_resource' ) );
	}

	public function single_resource() {
		ob_start();
		get_template_part( 'inc/shortcodes/single', 'resource' );
		return ob_get_clean();
	}

	public function guidance_docs() {

		ob_start();
		get_template_part( 'inc/shortcodes/guidance', 'docs' );

		wp_enqueue_style( 'fancybox' );
		wp_enqueue_script( 'fancybox' );

		add_action(
			'wp_footer',
			function () {
				?>
<script>
document.addEventListener('DOMContentLoaded', () => {
	Fancybox.bind("[data-fancybox]");
});
</script>

				<?php
			},
			9999
		);

		return ob_get_clean();
	}

	public function resource_filter() {

		ob_start();
		get_template_part( 'inc/shortcodes/resource', 'filter' );
		wp_enqueue_script( 'mla-cea-filter' );

		return ob_get_clean();
	}

	public function people_filter( $atts ) {

		$attributes = shortcode_atts(
			array(
				'type'  => 'people',
				'color' => '#c20201',
			),
			$atts
		);

		$args = array(
			'post_type' => $attributes['type'],
			'color'     => $attributes['color'],
		);

		ob_start();

		get_template_part( 'inc/shortcodes/people', 'filter', $args );

		wp_enqueue_style( 'fancybox' );
		wp_enqueue_script( 'fancybox' );
		wp_enqueue_script( 'mla-cea-filter' );
		add_action(
			'wp_footer',
			function () {
				?>
<script>
document.addEventListener('DOMContentLoaded', () => {
	Fancybox.bind("[data-fancybox]");
});
</script>

				<?php
			},
			9999
		);

		return ob_get_clean();
	}

	/**
	 * Filters the content of the post.
	 *
	 * @param array $atts The shortcode attributes.
	 * @return string The filtered content.
	 */
	public function cea_filter( $atts ) {

		$attributes = shortcode_atts(
			array(
				'type'  => '',
				'color' => '',
			),
			$atts
		);

		$args = array(
			'post_type' => $attributes['type'],
			'color'     => $attributes['color'],
		);

		ob_start();

		get_template_part( 'inc/shortcodes/cea', 'filter', $args );

		wp_enqueue_style( 'fancybox' );
		wp_enqueue_script( 'fancybox' );
		wp_enqueue_script( 'mla-cea-filter' );
		add_action(
			'wp_footer',
			function () {
				?>
<script>
document.addEventListener('DOMContentLoaded', () => {
	Fancybox.bind("[data-fancybox]");
});
</script>

				<?php
			},
			9999
		);

		return ob_get_clean();
	}
}
