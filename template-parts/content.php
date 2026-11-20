<?php
/**
 * Post card for the blog grid.
 *
 * @package HedwigusJournal
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
	<a class="thumb" href="<?php the_permalink(); ?>" aria-label="<?php echo esc_attr( get_the_title() ); ?>">
		<?php hedwigus_thumbnail(); ?>
	</a>
	<div class="post-card-body">
		<?php hedwigus_category_pill(); ?>
		<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="excerpt"><?php the_excerpt(); ?></div>
		<footer>
			<?php hedwigus_post_meta(); ?>
		</footer>
	</div>
</article>
