<?php
  /**
   * Displaying post content
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<aside class="post-content">
  <h3 hidden>
    <?php esc_html_e( 'Post content', 'log-lolla' ) ?>
  </h3>

  <div class="text">
    <?php
      the_content( log_lolla_add_readmore_to_content() );
    ?>
  </div>
</aside>
