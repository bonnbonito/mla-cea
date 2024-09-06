<?php
/**
 * Theme Functions.
 *
 * @package Nova B2B
 */

require get_stylesheet_directory() . '/bonn-update-checker/plugin-update-checker.php';

$namespace = 'MLA_CEA';

use Bonn\PluginUpdateChecker\v5\PucFactory;

$mla_update_checker = PucFactory::buildUpdateChecker(
	'https://github.com/bonnbonito/mla-cea/',
	__FILE__,
	'nova-b2b'
);

add_filter(
	'ai1wm_exclude_themes_from_export',
	function ( $exclude_filters ) {
		$exclude_filters[] = '/node_modules';
		return $exclude_filters;
	}
);

$mla_update_checker->setBranch( 'master' );

if ( ! defined( 'MLA_CEA_DIR_PATH' ) ) {
	define( 'MLA_CEA_DIR_PATH', untrailingslashit( get_stylesheet_directory() ) );
}

if ( ! defined( 'MLA_CEA_CLASS_PATH' ) ) {
	define( 'MLA_CEA_CLASS_PATH', untrailingslashit( get_stylesheet_directory() . '/inc/class' ) );
}

if ( ! defined( 'MLA_CEA_DIR_URI' ) ) {
	define( 'MLA_CEA_DIR_URI', untrailingslashit( get_stylesheet_directory_uri() ) );
}

if ( ! defined( 'MLA_CEA_ARCHIVE_POST_PER_PAGE' ) ) {
	define( 'MLA_CEA_ARCHIVE_POST_PER_PAGE', 9 );
}

if ( ! defined( 'MLA_CEA_SEARCH_RESULTS_POST_PER_PAGE' ) ) {
	define( 'MLA_CEA_SEARCH_RESULTS_POST_PER_PAGE', 9 );
}

add_action( 'acf/init', 'cea_af_init', 1 );

/**
 * Add custom functions here
 */
function cea_af_init() {
	require MLA_CEA_DIR_PATH . '/inc/autoloader.php';
}



/**
 * Add custom functions here
 */
