<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */

get_header(); ?>

	<section class="content content-archive">
	  <?php the_archive_title( '<h3 class="archive-title">', '</h3>' ); ?>
    <?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

    <?php
		if ( have_posts() ) : ?>

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/*
				 * Include the Post-Format-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
				 */
				get_template_part( 'template-parts/post/post', 'search' );

			endwhile;

			get_template_part( 'template-parts/navigation/navigation', 'posts' );

		else :

			get_template_part( 'template-parts/post/post', 'none' );

		endif; ?>
	</section>

	<?php get_template_part( 'template-parts/sidebar/sidebar' ); ?>

<?php
get_footer();
