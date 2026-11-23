<?php
/**
 * Test: theme version is bumped so updated CSS gets a fresh cache URL.
 * Run: php preview/tests/test-cache-bust.php
 */

$root = dirname( __DIR__, 2 );
$css  = file_get_contents( $root . '/style.css' );
$func = file_get_contents( $root . '/functions.php' );
$read = file_get_contents( $root . '/readme.txt' );

preg_match( '/^Version:\s*(\S+)/m', $css, $css_v );
preg_match( "/wp_enqueue_style\(\s*'hedwigus-style'.*?'([0-9.]+)'\s*\);/s", $func, $func_v );
preg_match( '/^Stable tag:\s*(\S+)/m', $read, $read_v );

$css_v  = $css_v[1] ?? '';
$func_v = $func_v[1] ?? '';
$read_v = $read_v[1] ?? '';

if ( $css_v === '' || $css_v !== $func_v || $css_v !== $read_v ) {
	fwrite( STDERR, "FAIL: versions disagree — style.css={$css_v}, functions.php={$func_v}, readme.txt={$read_v}\n" );
	exit( 1 );
}

if ( $css_v === '1.0.0' ) {
	fwrite( STDERR, "FAIL: version still 1.0.0 — browsers will reuse cached CSS\n" );
	exit( 1 );
}

echo "PASS: theme version {$css_v} busts the CSS cache\n";
