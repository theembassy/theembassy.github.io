<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Simplelin
 */

if ( ! function_exists( 'simplelin_entry_meta' ) ) :
/**
 * Displays the post meta.
 */
function simplelin_entry_meta() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
				$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated hide" datetime="%3$s">%4$s</time>';
			}
		
	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'on %s', 'post date', 'simplelin' ),
		'<a href="' . esc_url( home_url() ) . '/' . date( 'Y/m . ', strtotime( get_the_date() ) ) . '" rel="bookmark" class="meta-date">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'Published by %s ', 'post author', 'simplelin' ),
		'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
	);


	echo '<span class="byline">' . $byline . '</span><span class="posted-on">' . $posted_on . '</span>';
}
endif;



if ( ! function_exists( 'simplelin_new_excerpt_more' ) ) :
/**
 * Remove [...] string using Filters
 */
function simplelin_new_excerpt_more( $more ) {
	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip; ';
}
endif;
add_filter( 'excerpt_more', 'simplelin_new_excerpt_more' );



if ( ! function_exists( 'simplelin_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function simplelin_entry_footer() {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ', ', 'simplelin' ) );
		if ( $categories_list && simplelin_categorized_blog() ) {
			printf( '<span class="cat-links"><i class="fa fa-folder-open mycategories"></i><span>' .  $categories_list . '</span></span>' ); // WPCS: XSS OK.
		}

		/* translators: used between list items, there is a space after the comma */
		$tags_list = get_the_tag_list( '', esc_html__( ', ', 'simplelin' ) );
		if ( $tags_list ) {
			printf( '<span class="tags-links"><i class="fa fa-hashtag mytags"></i><span>' . $tags_list . '</span></span>' ); // WPCS: XSS OK.
		}
	}
}
endif;



/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function simplelin_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'simplelin_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array( 
			'fields'       => 'ids',
			'hide_empty'   => 1,
			// We only need to know if there is more than one category.
			'number'       => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'simplelin_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so simplelin_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so simplelin_categorized_blog should return false.
		return false;
	}
}



/**
 * Flush out the transients used in simplelin_categorized_blog.
 */
function simplelin_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'simplelin_categories' );
}
add_action( 'edit_category', 'simplelin_categoty_transient_flusher' );
add_action( 'save_post', 'simplelin_category_transient_flusher' );



if ( ! function_exists( 'simplelin_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own simplelin_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @return void
 */
function simplelin_comment( $comment, $args, $depth ) {
	switch( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments.
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<p><?php _e( 'Pingback:', 'simplelin' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'simplelin' ), '<span class="edit-link">', '</span>' ); ?></p>
		<?php
				break;
			default;
			// Proceed with normal comments.
			global $post;
		?>
		<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="comment-body">
				<footer class="comment-meta">
					<div class="comment-author vcard">
						<?php echo get_avatar( $comment, 70 ); ?>
						<?php
							printf( '<b class="fn">%1$s</b>',
								get_comment_author_link() );
						?>
					</div>
					<div class="comment-metadata">
						<?php
							printf( '<a class="comment-time" href="%1$s"<time datetime="%2$s">%3$s</time></a>',
								esc_url( get_comment_link( $comment->comment_ID ) ),
								get_comment_time( 'c' ),
								/* translators: 1: date, 2: time */
								get_comment_date()
							);
							edit_comment_link( __( 'Edit', 'simplelin' ), '<span class="edit-link">', '</span>' );
						?>
					</div><!-- .comment-metadata -->
				</footer><!-- .comment-meta -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'simplelin' ); ?></p>
				<?php endif; ?>

				<div class="comment-content">
					<?php comment_text(); ?>
				</div><!-- .comment-content -->

				<?php
					comment_reply_link( array_merge( $args, array(
						'add_below' => 'div-comment',
						'depth'     => $depth,
						'max_depth' => $args['max_depth'],
						'before'    => '<span class="reply">',
						'after'     => '</span>',
					) ) );
				?>

			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // end comment_type check
}
endif;



if ( ! function_exists( 'simplelin_footer_site_info' ) ) :
/**
 * Add Copyright and Credit text to footer
 */
function simplelin_footer_site_info() {
	$site_link = '<a href="' . esc_url( home_url( '/' ) ) . '">' . get_bloginfo( 'name', 'display' ) . '</a>';

	$cd_link = '<a href="' . 'http://wordpress.org/themes/simplelin' . '" target="_blank" title="' . esc_attr__( 'Theme for WordPress', 'simplelin' ) .'">' . __( 'Simplelin', 'simplelin' ) . '</a>';

	$tg_link = '<a href="' . 'http://mas-abdi.blogspot.com' . '" target="_blank" rel="designer">' . __( 'Mas Abdi', 'simplelin' ) . '</a>';

	$default_footer_value = '<div class="copyright">' . sprintf( __( 'Copyright &copy; %1$s %2$s', 'simplelin' ), date( 'Y' ), $site_link ) . '</div><div class="credit">' . sprintf( __( 'Theme %1$s', 'simplelin' ), $cd_link ) . ' ' . sprintf( __( 'by %1$s', 'simplelin' ), $tg_link ) . '</div>';

	echo $default_footer_value;
}
endif;