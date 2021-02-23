<?php
/**
 * Template part for displaying posts
 *
 * We would like to display parts of a post in the same way like parts of a page
 * Therefore we add a new class `article` to both posts and pages and style them via this handle
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */
?>

<?php
	$post_klass = log_lolla_post_class();
	$post_klass_array = array(
		'post',
		'post-format-standard',
		$post_klass
	);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_klass_array); ?>>
	<?php get_template_part( 'template-parts/post/parts/post', 'sticky' ); ?>

	<?php
		if ( is_single() ) {
			get_template_part( 'template-parts/post/parts/post', 'title-without-link' );
		} else {
			get_template_part( 'template-parts/post/parts/post', 'title' );
		}
	?>

	<?php get_template_part( 'template-parts/post/parts/post', 'featured-image' ); ?>
	<?php
		if ( ! is_single() && has_excerpt() ) {
			get_template_part( 'template-parts/post/parts/post', 'excerpt' );
		} else {
			get_template_part( 'template-parts/post/parts/post', 'content' );
			get_template_part( 'template-parts/post/parts/post', 'paginated-content' );
		}
	?>
	<?php get_template_part( 'template-parts/post/parts/post', 'permalink-if-no-title' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
