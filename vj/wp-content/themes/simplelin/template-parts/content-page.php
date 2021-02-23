<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Simplelin
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-inner-content">
		<header class="entry-header">
			<?php the_title( '<h1 class="pages-title">', '</h1>') ?>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before'      => '<div class="page-links">' . __( 'Pages:', 'simplelin' ),
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