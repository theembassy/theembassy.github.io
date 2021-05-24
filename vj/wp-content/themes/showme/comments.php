<?php
/**
 * The template for displaying comments
 *
 * @package showme
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
  return;
}
?>



  <?php
  // You can start editing here -- including this comment!
  if ( have_comments() ) : ?>
      <div id="comments" class="comments-area">
    <h2 class="comments-title">
      <?php
      $comment_count = get_comments_number();
      if ( 1 === $comment_count ) {
        printf(
          /* translators: 1: title. */
          esc_html_e( 'One thought on &ldquo;%1$s&rdquo;', 'showme' ),
          '<span>' . get_the_title() . '</span>'
        );
      } else {
        printf( // WPCS: XSS OK.
          /* translators: 1: comment count number, 2: title. */
          esc_html( _nx( '%1$s thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'showme' ) ),
          number_format_i18n( $comment_count ),
          '<span>' . get_the_title() . '</span>'
        );
      }
      ?>
    </h2><!-- .comments-title -->

    <ol class="comment-list">
      <?php
        wp_list_comments( array(
          'callback'=>'showme_list_comments'
        ) );
      ?>
    </ol><!-- .comment-list -->

    <?php showme_comments_navigation();

    // If comments are closed and there are comments, let's leave a little note, shall we?
    if ( ! comments_open() ) : ?>
      <p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'showme' ); ?></p>
    <?php
    endif;
  ?>
</div>
<?php
  endif; // Check for have_comments().

comment_form();
