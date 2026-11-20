<?php
/**
 * Single post template.
 *
 * @package HedwigusJournal
 */

get_header();
?>
<main id="content" class="site-main single">
	<?php
	while ( have_posts() ) :
		the_post();
		get_template_part( 'template-parts/content', 'single' );

		if ( comments_open() || get_comments_number() ) {
			comments_template();
		}
	endwhile;
	?>
</main>
<?php get_footer(); ?>
