<?php
/**
 * Template part for displaying the header title
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */
?>
  <?php if ( display_header_text() ) { ?>
    <h3 class="header-title">
      <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="link" title="<?php echo bloginfo( 'name' ) ?>">
        <span class="text">
          <?php bloginfo( 'name' ) ?>
        </span>
      </a>
    </h3>
  <?php }  ?>
