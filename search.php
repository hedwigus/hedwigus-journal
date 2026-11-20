<?php
/**
 * Search results template.
 *
 * @package HedwigusJournal
 */

get_header();
?>
<main id="content" class="site-main">
	<div class="wrap">
		<header class="page-header">
			<h1>
			<?php
			printf(
				/* translators: %s: search query */
				esc_html__( 'Hasil untuk: %s', 'hedwigus-journal' ),
				'<span>' . esc_html( get_search_query() ) . '</span>'
			);
			?>
			</h1>
		</header>

		<?php if ( have_posts() ) : ?>
			<div class="post-grid">
				<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'template-parts/content', get_post_format() );
				endwhile;
				?>
			</div>
			<?php the_posts_pagination(); ?>
		<?php else : ?>
			<?php get_template_part( 'template-parts/content', 'none' ); ?>
		<?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
