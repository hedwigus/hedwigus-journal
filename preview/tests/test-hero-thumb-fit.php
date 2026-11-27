<?php
/**
 * Test: hero thumbnail keeps auto width, max 210px height, centered.
 * Run: php preview/tests/test-hero-thumb-fit.php
 */

$css = file_get_contents( dirname( __DIR__, 2 ) . '/style.css' );

preg_match( '/\.hero-card a\.thumb\s*\{([^}]*)\}/', $css, $box );
preg_match( '/\.hero-card a\.thumb img\s*\{([^}]*)\}/', $css, $img );

$box_rule = $box[1] ?? '';
$img_rule = $img[1] ?? '';

if ( strpos( $box_rule, 'justify-content:center' ) === false ) {
	fwrite( STDERR, "FAIL: hero thumb container must center its image\nRule: {$box_rule}\n" );
	exit( 1 );
}

if ( strpos( $img_rule, 'width:auto' ) === false || strpos( $img_rule, 'max-height:210px' ) === false ) {
	fwrite( STDERR, "FAIL: hero image needs width:auto and max-height:210px\nRule: {$img_rule}\n" );
	exit( 1 );
}

if ( strpos( $img_rule, 'max-width:none' ) === false ) {
	fwrite( STDERR, "FAIL: global img{max-width:100%} would shrink the auto width\nRule: {$img_rule}\n" );
	exit( 1 );
}

echo "PASS: hero image is auto-width, height-capped and centered\n";
