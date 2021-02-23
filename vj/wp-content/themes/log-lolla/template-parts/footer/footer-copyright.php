<?php
  /**
   * Template part for displaying the footer copyrights
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>
<?php if ( get_theme_mod( 'footer_copyright_display' ) ) { ?>
  <aside class="footer-copyright">
    <h3 hidden>
      <?php esc_html_e( 'Footer copyright', 'log-lolla' ); ?>
    </h3>

    <div class="text">
      &copy;
      <?php echo esc_attr( date( 'Y' ) ) ?>
      <a class="link" href="<?php echo esc_url( get_theme_mod( 'footer_copyright_link' ) ); ?>" title="<?php esc_attr( get_theme_mod( 'footer_copyright' ) ) ?>">
        <?php echo esc_attr( get_theme_mod( 'footer_copyright' ) ) ?>
      </a>
    </div>
  </aside>
<?php }  ?>
