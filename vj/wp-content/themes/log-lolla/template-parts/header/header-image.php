<?php
/**
 * Template part for displaying the header image
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Log_Lolla
 */
?>
  <?php if ( get_header_image() ) : ?>
    <aside class="header-image">
      <h3 hidden>
        <?php esc_html_e( 'Header image', 'log-lolla' ); ?>
      </h3>

      <figure class="image">
        <?php the_header_image_tag(); ?>
      </figure>
    </aside>
  <?php endif; ?>
