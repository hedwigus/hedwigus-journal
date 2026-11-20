<?php
/**
 * Minimal WordPress stub — renders the REAL theme templates with real hedwigus.com
 * post data so the theme can be verified without a WordPress install.
 * Development-only; never ship this file inside a production theme.
 */

define( 'ABSPATH', __DIR__ . '/' );

$theme_dir  = dirname( __DIR__ );
$theme_uri  = '';
$posts_data = json_decode( file_get_contents( __DIR__ . '/posts.json' ), true );
$post_index = -1;
$post_total = count( $posts_data );

function hstub_post() {
	global $posts_data, $post_index;
	return $posts_data[ $post_index ] ?? null;
}

function get_template_directory() { return dirname( __DIR__ ); }
function get_template_directory_uri() { return ''; }
function get_stylesheet_uri() { return '/style.css'; }
function bloginfo( $key ) {
	echo array(
		'charset'       => 'UTF-8',
		'name'          => 'Hedwigus, Me, Family and Fun',
		'description'   => 'Regular Me',
		'pingback_url'  => 'https://www.hedwigus.com/xmlrpc.php',
	)[ $key ] ?? '';
}
function language_attributes() { echo 'lang="id"'; }
function body_class() { echo 'class="home blog"'; }
function wp_body_open() {}
function wp_head() {
	echo '<title>Hedwigus, Me, Family and Fun &ndash; Regular Me</title>' . "\n";
	echo '<link rel="stylesheet" href="/style.css">' . "\n";
	echo '<script src="/assets/js/theme.js" defer></script>' . "\n";
}
function wp_footer() {}
function get_theme_mod( $name, $default = '' ) { return $default; }
function is_home() { return true; }
function is_front_page() { return true; }
function is_paged() { return false; }
function is_singular() { return false; }
function is_active_sidebar( $id ) { return false; }
function comments_open() { return false; }
function get_option( $key ) { return false; }
function has_custom_logo() { return false; }
function the_custom_logo() {}
function home_url( $path = '/' ) { return 'https://www.hedwigus.com' . ( $path === '/' ? '/' : $path ); }
function esc_url( $u ) { return htmlspecialchars( $u, ENT_QUOTES ); }
function esc_html( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES ); }
function esc_attr( $s ) { return htmlspecialchars( (string) $s, ENT_QUOTES ); }
function esc_html_e( $s, $d = '' ) { echo esc_html( $s ); }
function esc_attr_e( $s, $d = '' ) { echo esc_attr( $s ); }
function esc_html__( $s, $d = '' ) { return esc_html( $s ); }
function __( $s, $d = '' ) { return $s; }

function wp_nav_menu( $args = array() ) {
	$items = array( 'Beranda', 'Teknologi', 'Sport', 'Hobby', 'Komunitas', 'Tentang' );
	echo '<ul id="' . esc_attr( $args['menu_id'] ?? 'menu' ) . '">';
	foreach ( $items as $i => $label ) {
		echo '<li class="' . ( $i === 0 ? 'current-menu-item' : '' ) . '"><a href="#">' . esc_html( $label ) . '</a></li>';
	}
	echo '</ul>';
}
function get_search_form() {
	echo '<form role="search" method="get" action="#"><input type="search" placeholder="Cari tulisan…" aria-label="Cari"><button type="submit">Cari</button></form>';
}

function have_posts() {
	global $post_index, $post_total;
	return $post_index + 1 < $post_total;
}
function the_post() {
	global $post_index;
	$post_index++;
}
function rewind_posts() { global $post_index; $post_index = -1; }
function the_ID() { global $post_index; echo $post_index + 1; }
function get_the_ID() { global $post_index; return $post_index + 1; }
function get_the_title() { $p = hstub_post(); return $p['title'] ?? ''; }
function the_title() { echo esc_html( get_the_title() ); }
function the_permalink() { $p = hstub_post(); echo esc_url( $p['url'] ?? '#' ); }
function the_excerpt() { $p = hstub_post(); echo '<p>' . esc_html( $p['excerpt'] ?? '' ) . '</p>'; }
function the_content() { the_excerpt(); }
function post_class( $extra = '' ) { echo 'class="' . esc_attr( trim( 'post-card ' . $extra ) ) . '"'; }
function has_post_thumbnail() { $p = hstub_post(); return ! empty( $p['img'] ); }
function the_post_thumbnail( $size = '', $attrs = array() ) {
	$p = hstub_post();
	echo '<img src="' . esc_url( $p['img'] ?? '' ) . '" alt="' . esc_attr( get_the_title() ) . '" loading="lazy">';
}
function get_the_date( $format = '' ) {
	$p = hstub_post();
	return $format === 'c' ? '2026-11-20T08:00:00+07:00' : ( $p['date'] ?? '' );
}
function get_the_author() { return 'Sofia WP'; }
function get_the_author_meta( $key ) { return ''; }
function get_the_author_posts_link() { return '<a href="#">Sofia WP</a>'; }
function get_avatar( $id, $size = 64 ) { return '<img src="/assets/images/placeholder.svg" alt="">'; }
function get_post_field( $key, $id ) { return str_repeat( 'kata ', 420 ); }
function get_the_category() {
	$p = hstub_post();
	$out = array();
	foreach ( ( $p['cats'] ?? array() ) as $i => $name ) {
		$out[] = (object) array( 'term_id' => $i + 1, 'name' => $name );
	}
	return $out;
}
function get_category_link( $id ) { return '#kategori-' . (int) $id; }
function get_categories( $args = array() ) {
	$names = array( 'Teknologi' => 5, 'Sport' => 3, 'Hobby' => 3, 'Komunitas' => 1, 'Personal' => 2, 'Cerita' => 1 );
	$out = array();
	$i = 1;
	foreach ( $names as $name => $count ) {
		$out[] = (object) array( 'term_id' => $i++, 'name' => $name, 'count' => $count );
	}
	return $out;
}
function wp_list_categories( $args = array() ) {
	foreach ( get_categories() as $cat ) {
		echo '<li><a href="' . esc_url( get_category_link( $cat->term_id ) ) . '">' . esc_html( $cat->name ) . '</a></li>';
	}
}
function wp_count_posts() { return (object) array( 'publish' => 128 ); }
function the_posts_pagination( $args = array() ) {
	echo '<nav class="pagination"><span class="current">1</span><a href="#">2</a><a href="#">3</a><a href="#">&rarr;</a></nav>';
}
function get_template_part( $slug, $name = '' ) {
	$file = dirname( __DIR__ ) . '/' . $slug . ( $name ? '-' . $name : '' ) . '.php';
	if ( file_exists( $file ) ) {
		include $file;
	}
}
function get_header() {
	static $done = false;
	if ( $done ) { return; }
	$done = true;
	include dirname( __DIR__ ) . '/header.php';
}
function get_footer() {
	static $done = false;
	if ( $done ) { return; }
	$done = true;
	include dirname( __DIR__ ) . '/footer.php';
}
function get_sidebar() {
	$file = dirname( __DIR__ ) . '/sidebar.php';
	if ( file_exists( $file ) ) { include $file; }
}
function get_post_format() { return false; }
function wp_reset_postdata() {}
function get_search_query() { return ''; }
function pings_open() { return false; }
function get_queried_object() { return null; }
function is_wp_error( $thing ) { return false; }

/* Load the theme's real template tags into the stub environment. */
require_once dirname( __DIR__ ) . '/inc/template-tags.php';
