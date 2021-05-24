<?php
/**
 * Custom template comment for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package showme
 */
 
function showme_list_comments($comment,$args,$depth){
  if ( $comment->comment_type=='pingback' || $comment->comment_type=='trackback' ){
?>
  <li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
    <div class="comment-body">
      <?php echo esc_html__( 'Pingback:', 'showme' ); ?> <?php comment_author_link(); ?>
      <?php edit_comment_link( esc_html__( '(Edit)', 'showme' ), '<div class="comment-meta"><span class="edit-link">', '</span></div>' ); ?>
    </div>
<?php
  }else{  
?>
  <li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ); ?>>
    <div id="div-comment-<?php comment_ID(); ?>" class="comment-body">
            <div class="comment-author">
        <?php echo get_avatar( $comment, 40 ); ?>
            </div>
            
            <div class="comment_wrap">
              <div class="fn"><?php echo get_comment_author_link();?></div>
                       
                <div class="comment-meta clearfix">
                  <time datetime="<?php comment_time( 'c' ); ?>"><?php printf( esc_html_x( '%1$s at %2$s', '1: date, 2: time', 'showme' ), get_comment_date(), get_comment_time() ); ?></time>
                  <?php edit_comment_link( esc_html__( 'Edit', 'showme' ), '<span class="comment-edit"><i class="fa fa-edit"></i> ', '</span>' ); ?>
                </div>

                <?php if ( '0' == $comment->comment_approved ) : ?>
                <p class="comment-awaiting-moderation"><?php echo esc_html__( 'Your comment is awaiting moderation.', 'showme' ); ?></p>
                <?php endif; ?>
                

              <div class="comment-content clearfix"><?php comment_text();?></div>

              <div class="reply"><?php comment_reply_link( array_merge( $args, array('add_below' => 'div-comment', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>


            </div>


    </div>
<?php 
  }
}

function showme_comment_form_default_fields( $fields ) {
  $req = get_option( 'require_name_email' );
  $commenter = wp_get_current_commenter();
  $aria_req = ( $req ? " aria-required='true'" : '' );
  $fields['author'] = '<div class="comment-item"><input id="author" type="text" aria-required="true" size="22" value="'.esc_attr($commenter['comment_author']).'" name="author" '.$aria_req.' placeholder="'.esc_attr__('Your Name','showme').' '.($req?'*':'').'" /></div>';
  $fields['email'] = '<div class="comment-item"><input id="email" type="text" aria-required="true" size="22" value="'.esc_attr($commenter['comment_author_email']).'" name="email" '.$aria_req.' placeholder="'.esc_attr__('Your Email','showme').' '.($req?'*':'').'" /></div>';
  $fields['url'] = '<div class="comment-item"><input id="url" type="text" aria-required="true" size="22" value="'.esc_url($commenter['comment_author_url']).'" name="url" placeholder="'.esc_attr__('Your Website','showme').'" /></div>';
  return $fields;
}
add_filter( 'comment_form_default_fields', 'showme_comment_form_default_fields' );

function showme_comment_form_field_comment( $comment_field ) {
  $req = get_option( 'require_name_email' );
  $comment_field = '<div class="comment-item"><textarea id="comment" name="comment" placeholder="'.esc_attr__('Your comment','showme').' '.($req?'*':'').'" /></textarea></div>';
  return $comment_field;
}
add_filter( 'comment_form_field_comment', 'showme_comment_form_field_comment' );

function showme_comment_form_defaults($defaults){
  $defaults['comment_notes_before'] = '';
  $defaults['comment_notes_after'] = '';
  return $defaults;
}
add_filter( 'comment_form_defaults', 'showme_comment_form_defaults' );
