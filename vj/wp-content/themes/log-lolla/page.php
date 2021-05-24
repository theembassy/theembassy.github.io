<?php
/**
 * The template for displaying a page
 *
 * First of all displays the page. Then:
 * If there is a `to-<pagename>-page` category with posts these posts will be displayed here
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */

get_header(); ?>

	<section class="content content-page">
		<h3 hidden>Page</h3>

		<?php
			// Display the content of the page
			//
			if ( have_posts() ) {

        /* Start the Loop */
  			while ( have_posts() ) : the_post();

  				/*
  				 * Include the Post-Format-specific template for the content.
  				 * If you want to override this in a child theme, then include a file
  				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
  				 */
  				get_template_part( 'template-parts/post/post-format', get_post_format() );

  			endwhile;

  			get_template_part( 'template-parts/navigation/navigation', 'posts' );

      } else {

				get_template_part( 'template-parts/post/post', 'none' );
			}

			wp_reset_postdata();
		?>

		<?php
			// Display posts associated to the page
			//
			$slug = get_queried_object()->post_name;
      $query = new WP_Query( 'category_name=to-' . $slug . '-page' );

      if ( $query->have_posts() ) {

        /* Start the Loop */
  			while ( $query->have_posts() ) : $query->the_post();

  				/*
  				 * Include the Post-Format-specific template for the content.
  				 * If you want to override this in a child theme, then include a file
  				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
  				 */
  				get_template_part( 'template-parts/post/post', get_post_format() );

  			endwhile;

  			get_template_part( 'template-parts/navigation/navigation', 'posts' );

      }

			wp_reset_postdata();
		?>
	</section>

	<?php get_template_part( 'template-parts/sidebar/sidebar' ); ?>

<?php
get_footer();
