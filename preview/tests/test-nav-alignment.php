<?php
/**
 * Test: desktop primary navigation is right-aligned.
 * Run: php preview/tests/test-nav-alignment.php
 */

$css = file_get_contents( dirname( __DIR__, 2 ) . '/style.css' );

if ( ! preg_match( '/\.main-navigation\s*\{([^}]*)\}/', $css, $m ) ) {
	fwrite( STDERR, "FAIL: .main-navigation rule not found\n" );
	exit( 1 );
}

$rule = $m[1];

if ( strpos( $rule, 'margin-left:auto' ) === false ) {
	fwrite( STDERR, "FAIL: .main-navigation must use margin-left:auto to sit on the right\nRule: {$rule}\n" );
	exit( 1 );
}

if ( strpos( $rule, 'margin-right:auto' ) !== false ) {
	fwrite( STDERR, "FAIL: .main-navigation still pushes itself left with margin-right:auto\nRule: {$rule}\n" );
	exit( 1 );
}

echo "PASS: desktop nav is right-aligned\n";
