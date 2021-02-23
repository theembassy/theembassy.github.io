<?php
  /**
   * Displaying post date and time
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-date-and-time">
  <h3 hidden>
    <?php esc_html_e( 'Post date and time', 'log-lolla' ) ?>
  </h3>

  <?php log_lolla_post_date_and_time(); ?>
</aside>
