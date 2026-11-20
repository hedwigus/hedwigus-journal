<?php
/**
 * Sidebar template.
 *
 * @package HedwigusJournal
 */
?>
<aside class="sidebar" id="secondary" aria-label="<?php esc_attr_e( 'Sidebar', 'hedwigus-journal' ); ?>">
	<?php if ( is_active_sidebar( 'sidebar-1' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-1' ); ?>
	<?php else : ?>
		<section class="widget">
			<h3 class="widget-title"><?php esc_html_e( 'Kategori', 'hedwigus-journal' ); ?></h3>
			<ul>
				<?php wp_list_categories( array( 'title_li' => '', 'number' => 8 ) ); ?>
			</ul>
		</section>
		<section class="widget">
			<h3 class="widget-title"><?php esc_html_e( 'Tulisan terbaru', 'hedwigus-journal' ); ?></h3>
			<ul>
				<?php
				$hedwigus_recent = new WP_Query( array( 'posts_per_page' => 5, 'ignore_sticky_posts' => true ) );
				while ( $hedwigus_recent->have_posts() ) :
					$hedwigus_recent->the_post();
					?>
					<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php
				endwhile;
				wp_reset_postdata();
				?>
			</ul>
		</section>
	<?php endif; ?>
</aside>
