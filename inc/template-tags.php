<?php
/**
 * Template tags.
 *
 * @package HedwigusJournal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Print the posted-on date with a human-readable format.
 */
function hedwigus_posted_on() {
	printf(
		'<time datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date( 'j F Y' ) )
	);
}

/**
 * Print the first category as a small pill.
 */
function hedwigus_category_pill() {
	$categories = get_the_category();
	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		return;
	}
	$category = $categories[0];
	printf(
		'<a class="cat-pill" href="%1$s">%2$s</a>',
		esc_url( get_category_link( $category->term_id ) ),
		esc_html( $category->name )
	);
}

/**
 * Print all categories as plain text links.
 */
function hedwigus_categories_plain() {
	$categories = get_the_category();
	if ( empty( $categories ) || is_wp_error( $categories ) ) {
		return;
	}
	$links = array();
	foreach ( $categories as $category ) {
		$links[] = sprintf(
			'<a href="%1$s">%2$s</a>',
			esc_url( get_category_link( $category->term_id ) ),
			esc_html( $category->name )
		);
	}
	echo implode( '<span class="sep"></span>', $links ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

/**
 * Print shared post meta: author, date, reading time.
 */
function hedwigus_post_meta() {
	echo '<div class="post-meta">';
	echo '<span>' . esc_html( get_the_author() ) . '</span>';
	echo '<span class="sep"></span>';
	hedwigus_posted_on();
	echo '<span class="sep"></span>';
	echo '<span>' . esc_html( hedwigus_reading_time() ) . '</span>';
	echo '</div>';
}

/**
 * Estimate reading time in Indonesian.
 *
 * @return string
 */
function hedwigus_reading_time() {
	$content   = get_post_field( 'post_content', get_the_ID() );
	$words     = str_word_count( strip_tags( $content ) );
	$minutes   = max( 1, (int) ceil( $words / 200 ) );

	/* translators: %d: estimated minutes */
	return sprintf( __( '%d menit baca', 'hedwigus-journal' ), $minutes );
}

/**
 * Print a post thumbnail with a fallback.
 *
 * @param string $size Registered image size.
 */
function hedwigus_thumbnail( $size = 'hedwigus-card' ) {
	if ( ! has_post_thumbnail() ) {
		echo '<img src="' . esc_url( get_template_directory_uri() . '/assets/images/placeholder.svg' ) . '" alt="">';
		return;
	}
	the_post_thumbnail( $size, array( 'loading' => 'lazy' ) );
}
