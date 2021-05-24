<?php
  /**
   * Displaying post gallery
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-gallery">
  <h3 hidden>
    <?php esc_html_e( 'Post gallery', 'log-lolla' ) ?>
  </h3>

  <?php
    if ( get_post_gallery() ) :
      echo get_post_gallery();
    endif;
  ?>
</aside>
