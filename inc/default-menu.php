<?php
/**
 * Default menu when no menu is assigned in Appearance > Menus.
 *
 * @package HedwigusJournal
 */
function hedwigus_default_menu() {
	/* Keep the header simple: only the two links every blog needs. */
	echo '<ul>';
	echo '<li class="current-menu-item"><a href="' . esc_url( home_url( '/' ) ) . '">' . esc_html__( 'Beranda', 'hedwigus-journal' ) . '</a></li>';
	echo '<li><a href="' . esc_url( home_url( '/about' ) ) . '">' . esc_html__( 'Tentang', 'hedwigus-journal' ) . '</a></li>';
	echo '</ul>';
}
