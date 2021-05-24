<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post' ); ?>>
	<?php get_template_part( 'template-parts/post/parts/post', 'sticky' ); ?>
	<?php get_template_part( 'template-parts/post/parts/post', 'title' ); ?>
	<?php
		$has_title = the_title_attribute( 'echo=0');

		if (! $has_title ) {
			get_template_part( 'template-parts/post/parts/post', 'permalink' );
		}
	?>
	<?php get_template_part( 'template-parts/post/parts/post', 'date' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
