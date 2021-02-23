<?php
/**
 * The template for displaying the home page
 *
 * If there is a `to-home-page` category with posts these posts will be displayed here
 * If not, the homepage will display the latest posts
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */

get_header(); ?>

	<section class="content content-home">
		<h3 hidden>
			<?php esc_html_e( 'Home', 'log-lolla' ); ?>
		</h3>

		<?php
      $query = new WP_Query( 'category_name=to-home-page' );

      if ( $query->have_posts() ) {

        /* Start the Loop */
  			while ( $query->have_posts() ) : $query->the_post();

  				/*
  				 * Include the Post-Format-specific template for the content.
  				 * If you want to override this in a child theme, then include a file
  				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
  				 */
  				get_template_part( 'template-parts/post/post-format', 'link' );

  			endwhile;

  			get_template_part( 'template-parts/navigation/navigation', 'posts' );

      } else {

				if ( have_posts() ) :

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

				else :

					get_template_part( 'template-parts/post/post', 'none' );

				endif;
			}

			wp_reset_postdata();
		?>
	</section>

	<?php get_template_part( 'template-parts/sidebar/sidebar' ); ?>

<?php
get_footer();
