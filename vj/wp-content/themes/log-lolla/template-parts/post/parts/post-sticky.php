<?php
  /**
   * Displaying a sticky post
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>

<?php
  if ( is_sticky() ) { ?>
    <div class="post-sticky">
      <span class="text">
        <?php echo esc_attr( log_lolla_sticky_post_text() ); ?>
      </span>
    </div>
<?php } ?>
