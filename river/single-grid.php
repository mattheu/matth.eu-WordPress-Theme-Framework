<article <?php post_class( array( 'entry', 'clearfix' ) ); ?>>

	<?php if ( has_post_thumbnail() ) : ?>

   		<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail( 'thumbnail' ); ?></a>
		<h3 class="entry-title delta"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>

	<?php else : ?>

		<h3 class="entry-title delta"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<?php the_excerpt(); ?>

	<?php endif; ?>

</article><!-- / article -->