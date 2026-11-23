<?php
/**
 * Hedwigus Journal — theme setup.
 *
 * @package HedwigusJournal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/default-menu.php';
require get_template_directory() . '/inc/integrations.php';

add_action( 'after_setup_theme', 'hedwigus_setup' );
/**
 * Core theme supports and menus.
 */
function hedwigus_setup() {
	load_theme_textdomain( 'hedwigus-journal', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'editor-styles' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo', array(
		'height'      => 80,
		'width'       => 80,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	add_theme_support( 'customize-selective-refresh-widgets' );
	add_theme_support( 'wp-block-styles' );

	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'hedwigus-journal' ),
		'footer'  => __( 'Footer Menu', 'hedwigus-journal' ),
	) );

	add_image_size( 'hedwigus-card', 900, 480, true );
}

add_action( 'wp_enqueue_scripts', 'hedwigus_assets' );
/**
 * Styles and scripts. No build step, no jQuery dependency.
 */
function hedwigus_assets() {
	wp_enqueue_style( 'hedwigus-style', get_stylesheet_uri(), array(), '1.0.1' );

	wp_enqueue_script(
		'hedwigus-theme',
		get_template_directory_uri() . '/assets/js/theme.js',
		array(),
		'1.0.0',
		true
	);

	wp_localize_script( 'hedwigus-theme', 'hedwigusTheme', array(
		'defaultDark' => (bool) get_theme_mod( 'hedwigus_dark_default', false ),
	) );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'widgets_init', 'hedwigus_widgets' );
/**
 * Widget areas.
 */
function hedwigus_widgets() {
	$args = array(
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	);

	register_sidebar( array_merge( $args, array(
		'name'        => __( 'Sidebar', 'hedwigus-journal' ),
		'id'          => 'sidebar-1',
		'description' => __( 'Widgets for the blog sidebar.', 'hedwigus-journal' ),
	) ) );

	foreach ( array( 'footer-1', 'footer-2', 'footer-3' ) as $id ) {
		register_sidebar( array_merge( $args, array(
			'name' => __( 'Footer', 'hedwigus-journal' ) . ' ' . absint( substr( $id, -1 ) ),
			'id'   => $id,
		) ) );
	}
}

add_filter( 'excerpt_length', 'hedwigus_excerpt_length' );
/**
 * Slightly longer excerpts for the card layout.
 *
 * @return int
 */
function hedwigus_excerpt_length() {
	return 24;
}

add_filter( 'excerpt_more', 'hedwigus_excerpt_more' );
/**
 * Cleaner excerpt ending.
 *
 * @return string
 */
function hedwigus_excerpt_more() {
	return '&hellip;';
}

add_filter( 'body_class', 'hedwigus_body_classes' );
/**
 * Add useful body classes.
 *
 * @param array $classes Existing classes.
 * @return array
 */
function hedwigus_body_classes( $classes ) {
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
	if ( is_singular() ) {
		$classes[] = 'single-article';
	}
	return $classes;
}
