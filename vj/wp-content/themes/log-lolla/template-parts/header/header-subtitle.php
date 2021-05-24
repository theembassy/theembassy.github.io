<?php
/**
 * Template part for displaying the header subtitle
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */
?>
  <?php if ( display_header_text() ) { ?>
    <h4 class="header-subtitle">
      <span class="text">
        <?php bloginfo( 'description' ) ?>
      </span>
    </h4>
  <?php }  ?>
