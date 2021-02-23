<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Log_Lolla
 */

get_header(); ?>

  <section class="content content-single">
    <h3 hidden>
      <?php esc_html_e( 'Content', 'log-lolla' ); ?>
    </h3>

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/post/post-format', get_post_type() );
      get_template_part( 'template-parts/post/parts/post', 'footer' );

			get_template_part( 'template-parts/navigation/navigation', 'post' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
  </section>

  <?php get_template_part( 'template-parts/sidebar/sidebar' ); ?>

<?php
get_footer();
