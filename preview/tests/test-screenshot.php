<?php
/**
 * Test: WordPress theme screenshot exists at the required 1200x900 size.
 * Run: php preview/tests/test-screenshot.php
 */

$file = dirname( __DIR__, 2 ) . '/screenshot.png';

if ( ! file_exists( $file ) ) {
	fwrite( STDERR, "FAIL: screenshot.png is missing\n" );
	exit( 1 );
}

$size = getimagesize( $file );
if ( ! $size || $size[0] !== 1200 || $size[1] !== 900 ) {
	fwrite( STDERR, 'FAIL: screenshot must be 1200x900, got ' . ( $size ? $size[0] . 'x' . $size[1] : 'invalid image' ) . "\n" );
	exit( 1 );
}

echo "PASS: screenshot.png is 1200x900\n";
