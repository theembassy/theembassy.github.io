<?php
  /**
   * Displaying post permalink
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-permalink">
  <h3 hidden>
    <?php esc_html_e( 'Post permalink', 'log-lolla' ) ?>
  </h3>

  <?php log_lolla_post_permalink(); ?>
</aside>
