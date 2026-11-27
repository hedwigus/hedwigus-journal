<?php
/**
 * Test: dark mode rewrites inline light-background callouts to readable colors.
 * Run: php preview/tests/test-dark-inline-callout.php
 */

$css = file_get_contents( dirname( __DIR__, 2 ) . '/style.css' );

$pattern = '/html\[data-theme="dark"\]\s*\.entry-content\s*\[style\*="background"\]\s*\{([^}]*)\}/';
if ( ! preg_match( $pattern, $css, $m ) ) {
	fwrite( STDERR, "FAIL: no dark-mode rule for inline-background callouts\n" );
	exit( 1 );
}

$rule = $m[1];
if ( strpos( $rule, 'background:' ) === false || strpos( $rule, 'color:' ) === false || strpos( $rule, '!important' ) === false ) {
	fwrite( STDERR, "FAIL: rule must force background and color with !important\nRule: {$rule}\n" );
	exit( 1 );
}

echo "PASS: dark inline callouts have forced readable colors\n";
