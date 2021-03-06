<?php

if ( ! function_exists( 'get_post_format_meta' ) ) {
	get_template_part( 'parts/index/single' );
	return;
}

$meta = get_post_format_meta( $post->ID );

?>

<article <?php post_class( array( 'entry' ) ); ?>>

	<?php if ( ! empty( $meta['quote'] ) ) : ?>

		<figure class="quote">

			<blockquote>
				<?php echo wpautop( $meta['quote'] ); ?>
			</blockquote>

			<?php

			if ( ! empty( $meta['quote_source'] ) ) {
				$source = ( empty( $meta['url'] ) ) ? $meta['quote_source'] : sprintf( '<a href="%s">%s</a>', esc_url( $meta['url'] ), $meta['quote_source'] );
				echo sprintf( '<figcaption class="quote-caption">%s</figcaption>', $source );
			}

			?>

		</figure>

	<?php else : ?>

		<?php the_content(); ?>

	<?php endif; ?>

	<?php get_template_part( 'parts/post-meta' ); ?>

</article><!-- / .article -->
