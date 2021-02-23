<?php
/**
 * Displaying a navigation menu icon in the header
 * It is only displayed if there is a custom function to provide content for the header menu
 *
 * @package Log_Lolla
 */
?>
  <?php  if ( function_exists( 'log_lolla_header_menu_contents' ) ) { ?>
    <nav class="menu-hamburger menu-hamburger--closed">
      <h3 hidden>
        <?php esc_html_e( 'Hamburger menu icon', 'log-lolla' ); ?>
      </h3>

      <div class="hamburger-icon hamburger-icon--closed">
        <?php
          if ( function_exists( 'log_lolla_hamburger_icon') ) {
            log_lolla_hamburger_icon();
          } else {
            echo '<span class="icon">&#x2630;</span>';
          }
        ?>
      </div>

      <div class="hamburger-icon hamburger-icon--opened">
        <?php
          if ( function_exists( 'log_lolla_hamburger_icon_x') ) {
            log_lolla_hamburger_icon_x();
          } else {
            echo '<span class="icon">&times;</span>';
          }
        ?>
      </div>
    </nav>
  <?php } ?>
