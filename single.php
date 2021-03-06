<?php

/**
 * Standard Single Post Template File
 *
 * @package MPH Starter
 * @since 0.1.0
 */

get_header();

?>

<div class="row">

	<section class="primary-content grid-8">

		<?php while ( have_posts() ) : the_post(); ?>

			<article <?php post_class( array( 'entry' ) ); ?>>

			    <?php

				get_template_part( 'parts/single/header' );

			    get_template_part( 'parts/single/content', get_post_format() );

			    get_template_part( 'parts/taxonomies' );

				comments_template();

				?>

			</article><!-- / .entry -->

		<?php endwhile; ?>

	</section><!-- / .primary-content -->

	<section class="sidebar grid-4" role="complementary">

		<?php get_sidebar(); ?>

	</section><!-- .secondary-content .widget-area -->

</div>

<?php get_footer(); ?>