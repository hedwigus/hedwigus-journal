<?php
/**
 * Test: the default primary menu stays minimal.
 * Run: php preview/tests/test-menu.php
 */

require_once dirname( __DIR__ ) . '/wp-stub.php';
require_once dirname( __DIR__, 2 ) . '/inc/default-menu.php';

ob_start();
hedwigus_default_menu();
$html = ob_get_clean();

$count = substr_count( $html, '<li' );
$max   = 3;

if ( $count > $max ) {
	fwrite( STDERR, "FAIL: expected at most {$max} menu items, got {$count}\n{$html}\n" );
	exit( 1 );
}

echo "PASS: default menu has {$count} items (max {$max})\n";
