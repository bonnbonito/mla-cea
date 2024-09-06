<?php
/**
 * Autoloader for theme
 */
function autoloader( $mla_class ) {
	// Replace namespace separator with directory separator.

	$namespace = 'MLA_CEA';

	if ( strpos( $mla_class, $namespace ) !== 0 ) {
		return false;
	}

	$mla_class = str_replace( $namespace . '\\', '', $mla_class );

	// Construct the full path to the mla_class file.
	$mla_class_path = MLA_CEA_CLASS_PATH . '/class-' . $mla_class . '.php';

	// Check if the file exists before including.
	if ( file_exists( $mla_class_path ) ) {
		require $mla_class_path;
	}
}

spl_autoload_register( 'autoloader' );

$instances = array(
	'shortcodes',
	'scripts',
	'custom',
);

foreach ( $instances as $instance ) {
	$class = "MLA_CEA\\$instance";
	$class::get_instance();
}
