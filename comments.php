<?php
/**
 * Comments template.
 *
 * @package HedwigusJournal
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="comments-area">
	<h2><?php comments_number( esc_html__( 'Belum ada komentar', 'hedwigus-journal' ), esc_html__( '1 komentar', 'hedwigus-journal' ), esc_html__( '% komentar', 'hedwigus-journal' ) ); ?></h2>

	<?php if ( have_comments() ) : ?>
		<ol class="comment-list">
			<?php
			wp_list_comments( array(
				'style'       => 'ol',
				'short_page'  => true,
				'avatar_size' => 44,
			) );
			?>
		</ol>
		<?php
		the_comments_pagination( array(
			'prev_text' => __( '&larr; Sebelumnya', 'hedwigus-journal' ),
			'next_text' => __( 'Berikutnya &rarr;', 'hedwigus-journal' ),
		) );
		?>
	<?php endif; ?>

	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p class="no-comments"><?php esc_html_e( 'Komentar sudah ditutup.', 'hedwigus-journal' ); ?></p>
	<?php endif; ?>

	<?php
	comment_form( array(
		'title_reply'         => __( 'Tinggalkan komentar', 'hedwigus-journal' ),
		'comment_notes_after' => '',
	) );
	?>
</div>
