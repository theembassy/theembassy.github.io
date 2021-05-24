<?php
/**
 * Template part for displaying image posts
 *
 * image – A single image. The first <img /> tag in the post could be considered the image.
 * Alternatively, if the post consists only of a URL, that will be the image URL
 * and the title of the post (post_title) will be the title attribute for the image.
 *
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package Log_Lolla
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'post post-format-image' ); ?>>
	<?php get_template_part( 'template-parts/post/parts/post', 'sticky' ); ?>
	<?php get_template_part( 'template-parts/post/parts/post', 'title' ); ?>
	<?php get_template_part( 'template-parts/post/parts/post', 'first-image' ); ?>
	<?php get_template_part( 'template-parts/post/parts/post', 'permalink-if-no-title' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
