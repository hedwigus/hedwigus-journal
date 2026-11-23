<?php
/**
 * Test: mobile header truncates the long site title instead of overflowing.
 * Run: php preview/tests/test-mobile-header.php
 */

$css = file_get_contents( dirname( __DIR__, 2 ) . '/style.css' );
$pos = strpos( $css, '@media (max-width:760px)' );

if ( $pos === false ) {
	fwrite( STDERR, "FAIL: mobile media query not found\n" );
	exit( 1 );
}

$block = substr( $css, $pos );

if ( ! preg_match( '/\.site-title\s*\{([^}]*)\}/', $block, $m ) || strpos( $m[1], 'text-overflow:ellipsis' ) === false ) {
	fwrite( STDERR, "FAIL: mobile .site-title must use text-overflow:ellipsis\n" );
	exit( 1 );
}

echo "PASS: mobile site title truncates\n";
