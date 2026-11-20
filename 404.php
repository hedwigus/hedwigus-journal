<?php
/**
 * 404 template.
 *
 * @package HedwigusJournal
 */

get_header();
?>
<main id="content" class="site-main">
	<div class="wrap not-found">
		<h1>404</h1>
		<h2><?php esc_html_e( 'Halaman tidak ditemukan', 'hedwigus-journal' ); ?></h2>
		<p><?php esc_html_e( 'Sepertinya catatan yang kamu cari sudah pindah rel.', 'hedwigus-journal' ); ?></p>
		<a class="btn" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php esc_html_e( 'Kembali ke beranda', 'hedwigus-journal' ); ?></a>
	</div>
</main>
<?php get_footer(); ?>
