<?php
/**
 * Site footer.
 *
 * @package HedwigusJournal
 */
?>
<footer class="site-footer">
	<div class="wrap footer-grid">
		<div>
			<a class="site-title" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<p><?php echo esc_html( get_theme_mod( 'hedwigus_footer_text', __( 'Hedwigus, Me, Family and Fun.', 'hedwigus-journal' ) ) ); ?></p>
		</div>
		<div>
			<h3><?php esc_html_e( 'Jelajahi', 'hedwigus-journal' ); ?></h3>
			<?php
			wp_nav_menu( array(
				'theme_location' => 'footer',
				'menu_id'        => 'footer-menu',
				'fallback_cb'    => 'hedwigus_default_menu',
				'depth'          => 1,
			) );
			?>
		</div>
		<div>
			<h3><?php esc_html_e( 'Kategori', 'hedwigus-journal' ); ?></h3>
			<ul>
				<?php
				wp_list_categories( array(
					'title_li' => '',
					'number'   => 6,
					'orderby'  => 'count',
					'order'    => 'DESC',
				) );
				?>
			</ul>
		</div>
	</div>
	<div class="wrap footer-bottom">
		<span>&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'hedwigus-journal' ); ?></span>
		<span><?php esc_html_e( 'Hedwigus Journal theme', 'hedwigus-journal' ); ?></span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
