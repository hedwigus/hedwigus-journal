<?php
/**
 * Test: dark mode gives blockquotes explicit readable colors.
 * Run: php preview/tests/test-dark-blockquote.php
 */

$css = file_get_contents( dirname( __DIR__, 2 ) . '/style.css' );

if ( ! preg_match( '/html\[data-theme="dark"\]\s*\.entry-content blockquote\s*\{([^}]*)\}/', $css, $m ) ) {
	fwrite( STDERR, "FAIL: no dark-mode blockquote rule found\n" );
	exit( 1 );
}

$rule = $m[1];

if ( strpos( $rule, 'background:' ) === false || strpos( $rule, 'color:' ) === false ) {
	fwrite( STDERR, "FAIL: dark blockquote needs explicit background and color\nRule: {$rule}\n" );
	exit( 1 );
}

echo "PASS: dark blockquote has explicit background and color\n";
