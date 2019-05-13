<?php
/**
 * Template part for displaying Author Bio.
 *
 * @package Magazine_Power
 */

?>
<div class="authorbox <?php echo ( get_option( 'show_avatars' ) ) ? '' : 'no-author-avatar'; ?>">
	<?php if ( get_option( 'show_avatars' ) ) : ?>
		<div class="author-avatar">
			<?php echo get_avatar( get_the_author_meta( 'user_email' ), '60', '' ); ?>
		</div>
	<?php endif; ?>
	<div class="author-info">
		<h4 class="author-header">
			<?php esc_html_e( 'Written by', 'magazine-power' ); ?>&nbsp;<?php the_author_posts_link(); ?>
		</h4>
		<div class="author-content"><p><?php the_author_meta( 'description' ); ?></p></div>
		<?php $magazine_power_user_url = get_the_author_meta( 'user_url' ); ?>
		<?php if ( ! empty( $magazine_power_user_url ) ) : ?>
			<div class="author-footer">
				<a href="<?php echo esc_url( $magazine_power_user_url ); ?>"><?php esc_html_e( 'Visit Website', 'magazine-power' ); ?></a>
			</div><!-- .author-footer -->
		<?php endif; ?>
	</div><!-- .author-info -->

	<?php
	$author_bio_show_recent_posts   = magazine_power_get_option( 'author_bio_show_recent_posts' );
	$author_bio_recent_posts_number = magazine_power_get_option( 'author_bio_recent_posts_number' );
	?>

	<?php if ( true === $author_bio_show_recent_posts && absint( $author_bio_recent_posts_number ) > 0 ) : ?>

		<?php
		$custom_args = array(
			'author'         => get_the_author_meta( 'ID' ),
			'post_type'      => 'post',
			'post__not_in'   => array( get_the_ID() ),
			'posts_per_page' => absint( $author_bio_recent_posts_number ),
		);

		$the_query = new WP_Query( $custom_args );
		?>

		<?php if ( $the_query->have_posts() ) : ?>

			<div class="author-bio-posts-content">
				<p><strong><?php esc_html_e( 'Other posts by author', 'magazine-power' ); ?></strong></p>

				<ul class="author-bio-posts-list">
					<?php
					while ( $the_query->have_posts() ) :
						$the_query->the_post();
						?>
						<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
					<?php endwhile; ?>
				</ul><!-- .author-bio-posts-list -->
			</div><!-- .author-bio-posts-content -->

			<?php wp_reset_postdata(); ?>

		<?php endif; ?>

	<?php endif; ?>
</div><!-- .authorbox -->
