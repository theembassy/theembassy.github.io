<?php
  /**
   * Displaying post categories
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<?php if ( has_category() ) { ?>
  <aside class="post-categories">
    <h3 hidden>
      <?php esc_html_e( 'Post categories', 'log-lolla' ) ?>
    </h3>

    <?php log_lolla_post_categories(); ?>
  </aside>
<?php } ?>
