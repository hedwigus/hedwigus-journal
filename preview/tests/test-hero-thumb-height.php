<?php
/**
 * Test: hero card image never grows taller than the source image.
 * Run: php preview/tests/test-hero-thumb-height.php
 */

$css = file_get_contents( dirname( __DIR__, 2 ) . '/style.css' );

if ( ! preg_match( '/\.hero-card a\.thumb\s*\{([^}]*)\}/', $css, $m ) ) {
	fwrite( STDERR, "FAIL: .hero-card a.thumb rule not found\n" );
	exit( 1 );
}

$rule = $m[1];

if ( ! preg_match( '/max-height:\s*210px/', $rule ) ) {
	fwrite( STDERR, "FAIL: hero thumb needs max-height:210px\nRule: {$rule}\n" );
	exit( 1 );
}

echo "PASS: hero thumb is capped at 210px\n";
