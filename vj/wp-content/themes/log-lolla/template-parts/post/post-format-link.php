<?php
/**
 * Template part for displaying link posts
 *
 * Themes may wish to use the first <a href=””> tag in the post content as the external link for that post.
 * An alternative approach could be if the post consists only of a URL,
 * then that will be the URL and the title (post_title) will be the name attached to the anchor for it.
 *
 * When the link points to another Wordpress site it is transformed to a widget by Wordpress.
 * Example: https://css-tricks.com/accessibility-testing-tools/
 *
 *
 * @link https://developer.wordpress.org/themes/functionality/post-formats/
 *
 * @package Log_Lolla
 */
?>

<?php
	$url = log_lolla_get_link_from_content();
	$klass = log_lolla_get_link_from_content_class( $url );
	$title = log_lolla_get_link_title_for_link_post_format( $url );
	$arrow = log_lolla_get_arrow_html( 'right' );
	$post_klass_array = array(
		'post',
		'post-format-link',
		$klass
	);
?>

<article id="post-<?php the_ID(); ?>" <?php post_class($post_klass_array); ?>>
	<?php get_template_part( 'template-parts/post/parts/post', 'sticky' ); ?>

	<h3 class="post-title">
		<a class="link <?php echo esc_attr( $klass ); ?>" title="<?php echo esc_attr( $title ); ?>" href="<?php echo esc_url( $url ); ?>">
			<?php echo wp_kses_post( $title . $arrow ); ?>
		</a>
	</h3>

	<?php get_template_part( 'template-parts/post/parts/post', 'permalink-if-link-is-external' ); ?>
</article><!-- #post-<?php the_ID(); ?> -->
