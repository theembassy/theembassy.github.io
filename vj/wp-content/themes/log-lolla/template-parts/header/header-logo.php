<?php
/**
 * Template part for displaying the header logo
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */
?>
  <?php if ( has_custom_logo() ) { ?>
    <aside class="header-logo">
      <h3 hidden>
        <?php esc_html_e( 'Header logo', 'log-lolla' ); ?>
      </h3>

      <figure class="logo">
        <?php
          if ( function_exists( 'the_custom_logo' ) ) {
            the_custom_logo();
          }
        ?>
      </figure>
    </aside>
  <?php } ?>
