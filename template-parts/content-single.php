<?php
/**
 * Single post content.
 *
 * @package HedwigusJournal
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php hedwigus_category_pill(); ?>
		<h1><?php the_title(); ?></h1>
		<?php hedwigus_post_meta(); ?>
	</header>

	<?php if ( has_post_thumbnail() ) : ?>
		<div class="entry-thumb"><?php the_post_thumbnail( 'full' ); ?></div>
	<?php endif; ?>

	<div class="entry-content">
		<?php
		the_content(
			sprintf(
				/* translators: %s: post title */
				__( 'Baca selengkapnya %s &rarr;', 'hedwigus-journal' ),
				'<span class="screen-reader-text">' . get_the_title() . '</span>'
			)
		);
		wp_link_pages( array(
			'before' => '<div class="page-links">' . esc_html__( 'Halaman:', 'hedwigus-journal' ),
			'after'  => '</div>',
		) );
		?>
	</div>

	<footer class="entry-footer">
		<?php hedwigus_categories_plain(); ?>
		<?php the_tags( '<span class="tag-links">', '', '</span>' ); ?>
	</footer>
</article>

<div class="author-box">
	<?php echo get_avatar( get_the_author_meta( 'ID' ), 64 ); ?>
	<div>
		<h4><?php the_author_posts_link(); ?></h4>
		<p><?php echo esc_html( get_the_author_meta( 'description' ) ?: __( 'Penulis catatan di Hedwigus.', 'hedwigus-journal' ) ); ?></p>
	</div>
</div>
