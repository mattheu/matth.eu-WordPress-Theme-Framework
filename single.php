<?php

get_header();

have_posts();

the_post();

?>

<div class="row">

	<section class="primary-content grid-8">

		<article <?php post_class( array( 'entry' ) ); ?>>

		    <?php 
		    
			get_template_part( 'single/header' ); 

		    get_template_part( 'single/content', get_post_format() );

		    get_template_part( 'parts/taxonomies' );

			comments_template(); 

			?>

		</article><!-- / .article -->

	</section><!-- / .primary-content -->

	<section class="sidebar grid-4" role="complementary">
		<?php get_sidebar(); ?>
	</section><!-- .secondary-content .widget-area -->

</div>

<?php get_footer(); ?>