<?php
  /**
   * Displaying post tags
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<?php if ( has_tag() ) { ?>
  <aside class="post-tags">
    <h3 hidden>
      <?php esc_html_e( 'Post tags', 'log-lolla' ) ?>
    </h3>

    <?php log_lolla_post_tags(); ?>
  </aside>
<?php } ?>
