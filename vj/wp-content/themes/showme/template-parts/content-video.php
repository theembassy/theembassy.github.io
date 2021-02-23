<?php
/**
 * Template part for displaying posts
 *
 * @package showme
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <?php if (has_post_thumbnail()) {?> 
  <div class="post-media">
    <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute();?>"><?php the_post_thumbnail();?></a>
  </div>
  <?php }?>
    
  <div class="post-content clearfix">
    <?php showme_entry_header(); ?>

    <div class="entry-content clearfix">
      <?php
      $content = apply_filters( 'the_content', get_the_content() );
      $video = false;

      if ( false === strpos( $content, 'wp-playlist-script' ) ) {
        $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );
      }

      if ( ! empty( $video ) ) {
        foreach ( $video as $video_html ) {
          echo '<div class="entry-video">';
            echo $video_html;
          echo '</div>';
        }
      };

        wp_link_pages( array(
          'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'showme' ),
          'after'  => '</div>',
        ) );
      ?>
    </div><!-- .entry-content -->

    <?php showme_entry_footer(); ?>
  </div>
</article><!-- #post-<?php the_ID(); ?> -->
