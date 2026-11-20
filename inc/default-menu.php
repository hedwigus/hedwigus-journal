<?php
/**
 * Default menu when no menu is assigned in Appearance > Menus.
 *
 * @package HedwigusJournal
 */
function hedwigus_default_menu() {
	echo '<ul><li class="current-menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Beranda', 'hedwigus-journal' ) . '</a></li>';

	$categories = get_categories( array( 'number' => 5, 'hide_empty' => true ) );
	foreach ( $categories as $category ) {
		echo '<li><a href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
	}

	echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'Tentang', 'hedwigus-journal' ) . '</a></li></ul>';
}
