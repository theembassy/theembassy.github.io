<?php
/**
 * Template part for displaying video posts
 *
 * video – A single video. The first <video /> tag or object/embed in the post content
 * could be considered the video.
 * Alternatively, if the post consists only of a URL, that will be the video URL.
 * May also contain the video as an attachment to the post,
 * if video support is enabled on the blog (like via a plugin).
 *
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package Log_Lolla
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post post-format-video' ); ?>>
  <?php get_template_part( 'template-parts/post/parts/post', 'sticky' ); ?>
  <?php get_template_part( 'template-parts/post/parts/post', 'title' ); ?>
	<?php get_template_part( 'template-parts/post/parts/post', 'content' ); ?>
  <?php get_template_part( 'template-parts/post/parts/post', 'permalink-if-no-title' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
