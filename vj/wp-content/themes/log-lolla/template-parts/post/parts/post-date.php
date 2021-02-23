<?php
  /**
   * Displaying post date
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-date">
  <h3 hidden>
    <?php esc_html_e( 'Post date', 'log-lolla' ) ?>
  </h3>

  <?php log_lolla_post_date(); ?>
</aside>
