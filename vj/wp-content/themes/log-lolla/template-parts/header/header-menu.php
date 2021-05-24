<?php
/**
 * Displaying a navigation menu in the header
 * It is only displayed if there is a custom function to provide content for the header menu
 *
 * @package Log_Lolla
 */
?>
  <?php  if ( function_exists( 'log_lolla_header_menu_contents' ) ) { ?>
    <nav class="header-menu header-menu--closed">
      <h3 hidden>
        <?php esc_html_e( 'Header menu', 'log-lolla' ); ?>
      </h3>

      <?php log_lolla_header_menu_contents(); ?>
    </nav>
  <?php } ?>
