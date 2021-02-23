<?php
  /**
   * Displaying post author
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-author">
  <h3 hidden>
    <?php esc_html_e( 'Post author', 'log-lolla' ) ?>
  </h3>

  <?php log_lolla_post_author(); ?>
</aside>
