<?php
  /**
   * Template part for displaying the header
   *
   * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
   *
   * @package Log_Lolla
   */
?>
  <?php
    if ( function_exists( 'log_lolla_header_class' ) ) {
      $klass = log_lolla_header_class();
    } else {
      $klass = '';
    }
  ?>

  <header class="header <?php echo esc_attr( $klass ); ?>">
    <?php get_template_part( 'template-parts/header/header', 'image' ); ?>
    <?php get_template_part( 'template-parts/header/header', 'logo' ); ?>
    <?php get_template_part( 'template-parts/header/header', 'title' ); ?>
    <?php get_template_part( 'template-parts/header/header', 'subtitle' ); ?>
    <?php get_template_part( 'template-parts/header/header', 'menu-hamburger' ); ?>
  </header>

  <?php get_template_part( 'template-parts/header/header', 'menu' ); ?>
