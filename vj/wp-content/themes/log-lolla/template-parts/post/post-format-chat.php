<?php
/**
 * Template part for displaying chat posts
 *
 * chat – A chat transcript, like so:
 * John: foo
 * Mary: bar
 * John: foo 2
 *
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package Log_Lolla
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post post-format-chat' ); ?>>
  <?php get_template_part( 'template-parts/post/parts/post', 'sticky' ); ?>
  <?php get_template_part( 'template-parts/post/parts/post', 'title' ); ?>
	<?php get_template_part( 'template-parts/post/parts/post', 'content' ); ?>
  <?php get_template_part( 'template-parts/post/parts/post', 'permalink-if-no-title' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
