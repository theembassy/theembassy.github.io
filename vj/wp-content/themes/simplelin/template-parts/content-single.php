<?php
/**
 * Template part for displaying single posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 * @package Simplelin
 */
$simplelin_single_breadcrumb_section = get_theme_mod( 'simplelin_single_breadcrumb_section', '1' );
?>


<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
	<div class="post-inner-content">

		<header class="entry-header">

			<?php the_title( '<h1 class="entry-title">', '</h1>'); ?>

		

		</header><!-- .entry-header -->

		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-thumbnail">
				<?php the_post_thumbnail( 'simplelin-featured' ); ?>
			</div><!-- .post-thumbnail -->
		<?php endif; ?>

		<div class="entry-content">

			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links">' . __( 'Pages: ', 'simplelin' ),
					'after'       => '</div>',
					'link_before' => '<span class="page-number">',
					'link_after'  => '</span>',
				) );
			?>

		</div><!-- .entry-content -->

		<footer class="entry-footer">
			<?php simplelin_entry_footer(); ?>
		</footer><!-- .entry-meta -->
	</div><!-- .post-inner-content -->
</article><!-- #post-## -->