<?php
/**
 * Archive template.
 *
 * @package HedwigusJournal
 */

get_header();
?>
<main id="content" class="site-main">
	<div class="wrap">
		<header class="page-header">
			<h1><?php the_archive_title(); ?></h1>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>
		</header>

		<div class="with-sidebar">
			<?php if ( have_posts() ) : ?>
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
					'prev_text' => __( '&larr; Sebelumnya', 'hedwigus-journal' ),
					'next_text' => __( 'Berikutnya &rarr;', 'hedwigus-journal' ),
				) );
				?>
			<?php else : ?>
				<?php get_template_part( 'template-parts/content', 'none' ); ?>
			<?php endif; ?>

			<?php get_sidebar(); ?>
		</div>
	</div>
</main>
<?php get_footer(); ?>
