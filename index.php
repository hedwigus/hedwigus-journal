<?php
/**
 * Main blog template.
 *
 * @package HedwigusJournal
 */

get_header();
?>

<main id="content" class="site-main">
	<?php if ( have_posts() ) : ?>

		<?php if ( ( is_home() || is_front_page() ) && ! is_paged() ) : ?>
			<?php the_post(); ?>
			<section class="hero">
				<div class="wrap hero-inner">
					<div>
						<span class="eyebrow"><span class="dot"></span> <span class="hero-eyebrow-text"><?php echo esc_html( hedwigus_hero_text( 'hedwigus_hero_eyebrow' ) ); ?></span></span>
						<h1><span class="hero-title-text"><?php echo esc_html( hedwigus_hero_text( 'hedwigus_hero_title' ) ); ?></span><br><em class="hero-accent-text"><?php echo esc_html( hedwigus_hero_text( 'hedwigus_hero_accent' ) ); ?></em></h1>
						<p class="lead"><?php echo esc_html( hedwigus_hero_text( 'hedwigus_hero_lead' ) ); ?></p>
						<a class="text-link" href="<?php the_permalink(); ?>"><?php esc_html_e( 'Baca tulisan terbaru', 'hedwigus-journal' ); ?> &rarr;</a>
						<div class="hero-meta">
							<span><?php echo esc_html( number_format_i18n( hedwigus_post_count() ) ); ?> <?php esc_html_e( 'artikel', 'hedwigus-journal' ); ?></span>
							<span><?php echo esc_html( number_format_i18n( hedwigus_category_count() ) ); ?> <?php esc_html_e( 'kategori', 'hedwigus-journal' ); ?></span>
							<?php if ( hedwigus_first_post_year() ) : ?>
								<span><?php echo esc_html( sprintf( /* translators: %d: year */ __( 'Sejak %d', 'hedwigus-journal' ), hedwigus_first_post_year() ) ); ?></span>
							<?php endif; ?>
						</div>
					</div>
					<article class="hero-card">
						<a class="thumb" href="<?php the_permalink(); ?>"><?php hedwigus_thumbnail(); ?></a>
						<div class="hero-card-body">
							<?php hedwigus_category_pill(); ?>
							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
							<p><?php the_excerpt(); ?></p>
							<?php hedwigus_post_meta(); ?>
						</div>
					</article>
				</div>
			</section>
		<?php endif; ?>

		<section class="section">
			<div class="wrap">
				<div class="section-head">
					<div>
						<h2><?php esc_html_e( 'Tulisan terbaru', 'hedwigus-journal' ); ?></h2>
						<p><?php esc_html_e( 'Catatan pilihan dari sudut pandang yang berbeda.', 'hedwigus-journal' ); ?></p>
					</div>
					<a class="text-link" href="<?php echo esc_url( home_url( '/semua-tulisan' ) ); ?>"><?php esc_html_e( 'Arsip', 'hedwigus-journal' ); ?> &rarr;</a>
				</div>

				<div class="category-nav">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="<?php echo ( is_home() ? 'current-cat' : '' ); ?>"><?php esc_html_e( 'Semua', 'hedwigus-journal' ); ?></a>
					<?php
					$hedwigus_cats = get_categories( array(
						'number'   => 7,
						'orderby'  => 'count',
						'order'    => 'DESC',
						'hide_empty' => true,
					) );
					foreach ( $hedwigus_cats as $hedwigus_cat ) {
						printf(
							'<a href="%1$s">%2$s</a>',
							esc_url( get_category_link( $hedwigus_cat->term_id ) ),
							esc_html( $hedwigus_cat->name )
						);
					}
					?>
				</div>

				<div class="post-grid">
					<?php
					while ( have_posts() ) :
						the_post();
						get_template_part( 'template-parts/content', get_post_format() );
					endwhile;
					?>
				</div>

				<?php
				the_posts_pagination( array(
					'mid_size'  => 2,
					'prev_text' => __( '&larr; Sebelumnya', 'hedwigus-journal' ),
					'next_text' => __( 'Berikutnya &rarr;', 'hedwigus-journal' ),
				) );
				?>
			</div>
		</section>

	<?php else : ?>
		<?php get_template_part( 'template-parts/content', 'none' ); ?>
	<?php endif; ?>
</main>

<?php get_footer(); ?>
