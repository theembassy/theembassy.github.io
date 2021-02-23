<?php
  /**
   * Displaying post edit link
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-edit-link">
  <h3 hidden>
    <?php esc_html_e( 'Post edit link', 'log-lolla' ) ?>
  </h3>

  <?php log_lolla_post_edit_link(); ?>
</aside>
